<?php

namespace Front\YxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class WishesController extends BaseController {
    /**
     * @Route("/wishes")
     * @Route("/wishes/")
     * @Route("/wishes/index")
     * @Route("/wishes/index/")
     */
    public function indexAction(){
        $this->_session = $this->getRequest()->getSession();
        $user_id = $this->_session->get('Users.userid');
        $this->_viewData['user_id'] = $user_id;
        
        $displayName = $this->_session->get('Users.name');
        $this->_viewData['displayName'] = $displayName;
        
        if($user_id == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        $this->_conn = $this->get('database_connection');
        
        //  Get All songs added in wishlist
        $sql = "select w.id as wish_id, w.*, s.composition as ringtone, s.rate as price, g.gname as title 
                    from wishes as w 
                    INNER JOIN songs as s ON w.song_id = s.id
                    INNER JOIN genres as g ON s.genre_id = g.id
                    where w.user_id= '".$user_id."'"; 

        $userCartItems1 = $this->_conn->fetchAll($sql);
        
        //  Get All Ringtones added in wishlist
        $sql = "select w.id as wish_id, w.*, r.title as ringtone, r.price,
                    r.ringtone, r.prew_ringtone, 
                    c.title 
                    from wishes as w 
                    INNER JOIN ringtones as r ON w.ringtone_id = r.id
                    INNER JOIN ringtonecategories as c ON r.category = c.id
                    where w.user_id= '".$user_id."'"; 

        $userCartItems2 = $this->_conn->fetchAll($sql);
        
        
        //
        
        $userCartItems = array_merge( $userCartItems1, $userCartItems2 );
        //echo '<pre>'; print_r( $userCartItems );die;
        //  Cleanup
        unset( $userCartItems1, $userCartItems2);
        
        $this->_viewData['userCartItems'] = $userCartItems;
        
        //echo '<pre>'; print_r( $userCartItems ); die;
        
        return $this->render('YxBundle:Wishes:index.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/wishes/emptyw")
     * @Route("/wishes/emptyw/")
     */
    public function emptyAction(){
        //  Do Init
        $this->_session = $this->getRequest()->getSession();
        $userId = $this->_session->get('Users.userid');
        $this->_viewData['user_id'] = $userId;
        
        $this->_conn = $this->get('database_connection');
        
        $boxes = $_POST['box_'];
            
        //  Deleted all posted wishlist
        if ( $boxes ){
            foreach( $boxes as $id ){
                $sql = "delete from wishes where id = '".$id."'"; 
                $this->_conn->query( $sql );
            }
        }
        
        $this->get('session')->getFlashBag()->add( 'notice', 'Record deleted.');
        return $this->redirect('/wishes');
    }
    
    /**
     * @Route("/wishes/add")
     * @Route("/wishes/add/")
     */
    public function addAction(){
        if (!$this->session_check())
            die('e');
        
        $userId = $this->_session->get('Users.userid');
        $request = $this->getRequest();
        
        $this->_conn = $this->get('database_connection');
        
        if ( $request->request->get('song_id') ){
            $type = $request->request->get('type');
            
            $this->data = array(
               'user_id' =>  $userId,
                $type .'_id'   => $request->request->get('song_id'),
                'created'   => date('Y-m-d H:i:s'),
            );
            
            //  Check for duplicate record
            $typeS = $type .'_id';
            $sql = "SELECT id from wishes WHERE user_id = '". $userId ."' AND ". $typeS ." = '". $request->request->get('song_id') ."' ";
            
            $record = $this->_conn->fetchAll($sql);
            
            if ( $record ){
                echo 'Record Exists.';
            }else{
                $this->_conn->insert( 'wishes', $this->data );
                echo 'Added to Wishlist.';
            }
        }
        
        return new \Symfony\Component\HttpFoundation\Response();
    }
    
    /**
     * @Route("/wishes/buy")
     * @Route("/wishes/buy/")
     */
    public function buyWishlistAction(){
        if (!$this->session_check()){
            $this->get('session')->setFlash('notice', 'Please sign in to download this ringtone.!');
            return $this->redirect($this->generateUrl('user_login'), 302);
        }
        
        $userId = $this->_session->get('Users.userid');
        $displayName = $this->_session->get('Users.name');
        
        if( $userId == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        $this->_viewData['displayName'] = $displayName;
        
        $request = $this->getRequest();
        
        $this->_conn = $this->get('database_connection');
        //echo '<pre>'; print_r( $_POST );die;
        if(!empty($_POST)){
            //  Get Userbalance
            $em = $this->getDoctrine()->getEntityManager();
            $userBalance = $em->getRepository('YxBundle:Userbalances')->findOneByUserId( $userId );

            $userBalance = $userBalance->getAmount();

            $basketPrice = 0;
            
            $boxes = $_POST['box_'];
            
            //  Calculate total price
            foreach( $boxes as $box ){
                $basketPrice += $_POST['price'][$box];
            }
            
            // Check Account Balance
            if (($basketPrice > 0) && ($basketPrice > $userBalance)){
                //$this->get('session')->setFlash('notice', 'Insufficient Balance.!');
                $this->get('session')->getFlashBag()->add( 'notice', 'Insufficient Balance.');
                return $this->redirect('/ringtonecategory');
                die;
            }
            
            //  Update Userbalance
            $sql = "update userbalances SET amount = (amount-". $basketPrice .") WHERE user_id = '". $userId ."'";
            $this->_conn->query( $sql );
            
            foreach( $boxes as $box ){
                $sql = "insert into cartitems set
                            song_id	= ". $_POST['song_id'][$box]. ",	 	 	 	 	 	 	 
                            user_id	= ". $userId .",	 	 	 	 	 
                            created	= '". date('Y-m-d H:i:s') ."', 	 	 	 	 	 	 
                            modified    = '". date('Y-m-d H:i:s') ."', 	 	 	 	 	 	 
                            status='1',
                            type        = '". $_POST['type'][$box] ."'";
                $this->_conn->query( $sql );
                
                $sql = "delete from wishes where id = '" . $box . "' ";
                $this->_conn->query( $sql );
            }
            
        }
        return $this->render('YxBundle:Songs:buy.html.php', $this->_viewData);
    }
    
    
}
