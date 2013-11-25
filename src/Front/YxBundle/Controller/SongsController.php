<?php

namespace Front\YxBundle\Controller;

use Front\YxBundle\Controller\BaseController;
use Front\YxBundle\Form\UserType;
use Front\YxBundle\Form\EnquiryType;

use Front\YxBundle\Entity\Users;

use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class SongsController extends BaseController {

    private $_viewData = array(), $data = array(), $_conn;
//    private $songRating = array();
//    private $counter = 0;

    public function __construct(){
        
    }



    /**
     * @Route("/songs/genre")
     * @Route("/songs/genre/")
     * @Route("/songs/genre/{char}")
     * @Route("/songs/genre/{char}/")
     * @param type $char
     * @param type $type 
     */
    public function genreAction($char = null){
        
        $this->_session = $this->getRequest()->getSession();
        
        $em = $this->getDoctrine();
        
        $loginuserEmail = $this->_session->get('Users.id');
        $displayName = $this->_session->get('Users.name');
        
        $this->_viewData['displayName'] = $displayName;
        
        if($loginuserEmail==""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        //  Init pagination.
        $request = $this->getRequest();
        
        $this->_viewData['base_url'] = '/songs/genre/' . $char;
        
        $page = $request->query->get('page');
        $page = $page ? $page : 1;
        $limit = 10;
        $midrange = 7;
        $offset = ($page - 1) * $limit;
        
        //$freeSongs        = $this->Song->findAll($condition,"Song.*,Genre.gname",$order, $limit, $page);
        $songcat = $em->getRepository('YxBundle:Genres')->findOneById($char);
        $this->_viewData['songcat'] = $songcat;
        
        //$tenUsers = $em->getRepository('MyProject\Domain\User')->findBy(array('age' => 20), array('name' => 'ASC'), 10, 0);
        $freeSongs        = $em->getRepository('YxBundle:Songs')->findBy( array('genreId' => $char) );
        $itemsCount = count( $freeSongs );
        
        //$limitClause = " Limit $offset, $limit";
        
        $freeSongs        = $em->getRepository('YxBundle:Songs')->findBy( array('genreId' => $char), array(), $limit, $offset );//->setMaxResults(5) ;
        $this->_viewData['freeSongs'] = $freeSongs;
        
        foreach($freeSongs as $k => $v){
                $songId = $v->getID();
                $this->get_song_rating($songId);
        }

        $this->_viewData['songRating'] = $this->songRating;
        
		
        $this->_viewData['limit'] = '';//,$this->morelimit);
	$this->_viewData['recCount'] = count($freeSongs);
        
        $paginator = new \Front\YxBundle\Helper\Paginator($itemsCount, $page , $limit, $midrange);
        $this->_viewData['paginator'] = $paginator;

        return $this->render('YxBundle:Songs:genre.html.php', $this->_viewData);
    }

    /**
     * @Route("/songs/addtocart")
     * @Route("/songs/addtocart/")
     * This function adds a item to cart
     * @return type 
     */
    public function addtocartAction (){
        if (!$this->session_check())
            return $this->redirect($this->generateUrl('user_login'), 302);
        //echo '<pre>'; print_r( $_POST );die;
        $user_id = $this->_session->get('Users.userid');
	 
        $request = $this->getRequest();
        
	if(! empty($_POST)){
            if( $request->request->get('box_') ){
                $box = $request->request->get('box_');
                
                foreach ( $box as $k => $val){
                    $song_id = $val;
                    $this->_addCartItem( $song_id, $user_id, 0, 5, 1);
                }
            }
            
            if( $request->request->get('box2_') ){
                $box = $request->request->get('box2_');
                
                foreach ( $box as $k => $val){
                    $song_id = $val;
                    $this->_addCartItem( $song_id, $user_id, 0, 5, 2);
                }
            }
        }
        $this->get('session')->getFlashBag()->add( 'notice', 'Added to Cart.');
	return $this->redirect("/songs/mybasket");
    }
    
    /**
     * @Route("/songs/mybasket")
     * @Route("/songs/mybasket/") 
     */
    public function mybasketAction(){
        if (!$this->session_check())
            return $this->redirect($this->generateUrl('user_login'), 302);
        
        $loginuserEmail = $this->_session->get('Users.id');
        $displayName = $this->_session->get('Users.name');
        
        $this->_viewData['displayName'] = $displayName;
        
        if($loginuserEmail==""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        //$basketPrice1 = 0;
        $userBalance1 = 0;
	
        $user_id = $this->_session->get('Users.userid');
        
        //$sql = "select sum(Userbalance.balance) as balance from useramounts as Useramount group by Useramount.user_id";
        $em = $this->getDoctrine();
        $userBalance = $em->getRepository('YxBundle:Userbalances')->findByUserId( $user_id );
        
        if ( $userBalance)
            $userBalance1 = $userBalance[0]->getAmount();
        
        $this->_conn = $this->get('database_connection');
        
        //$users = $this->get('database_connection')->fetchAll($sql);
        /*
        // fetch basket price
        $sql = "select sum(Song.rate) as basketPrice from songs as Song
        INNER JOIN cartitems as Cartitem ON Cartitem.song_id = Song.id
        WHERE Cartitem.user_id = '".$user_id."' AND Cartitem.status='5'
        group by Cartitem.user_id";
        
        $basketPrice = $this->_conn->fetchAll($sql);
        
        $basketPrice1=0;
        //pr($basketPrice);
	if ($basketPrice){
            $basketPrice1 = $basketPrice1 + $basketPrice[0]['basketPrice'];
	}
                
        $sql = "select sum(Song.ratepc) as basketPrice from songs as Song
		INNER JOIN cartitems as  Cartitem ON Cartitem.song_id = Song.id
		WHERE Cartitem.user_id = '".$user_id."' AND Cartitem.statuspc='5'
		group by Cartitem.user_id";

        $basketPrice = $this->_conn->fetchAll($sql);
        
        //pr($basketPrice);
	if ($basketPrice){
            $basketPrice1 = $basketPrice1+$basketPrice[0]['basketPrice'];
        }*/
                
        $sql = "select cartitems.type_upl, cartitems.id as cart_id,
                songs.*, songs.id as song_id, 
                genres.gname, genres.id as gener_id  
                from songs 
                INNER JOIN cartitems ON cartitems.song_id = songs.id 
                left JOIN genres ON songs.genre_id = genres.id
		WHERE cartitems.user_id = '".$user_id."' 
                AND ((cartitems.statuspc='5')) 
                group by cartitems.song_id";
		
        $userCartItems = $this->_conn->fetchAll($sql);
        
        $basketprice = 0;
        foreach ($userCartItems as $song){
            if ($song['type_upl']==1)
                $basketprice = $basketprice + $song['rate'];
            if ($song['type_upl']==2)
                $basketprice = $basketprice + $song['ratepc'];
        }
                
        if ($basketprice > $userBalance1)
            $this->_viewData['errMessage'] = "Your account balance is insufficient to complete this purchase.  Either remove a few items from the shopping cart OR <a href='../users/balance'>Click here</a> to refill your balance.";
        
        $this->_viewData['userBalance'] = $userBalance1;
        $this->_viewData['userCartItems'] = $userCartItems;

        return $this->render('YxBundle:Songs:mybasket.html.php', $this->_viewData);
    }

    /**
     * @Route("/songs/basketdelete")
     * @Route("/songs/basketdelete/") 
     * Function to delete the item from basket.
     */
    public function basketdeleteAction(){
        if (!$this->session_check())
            return $this->redirect($this->generateUrl('user_login'), 302);
        
        $request = $this->getRequest();
        
        
        if(!empty($_POST)){
            //$em = $this->getDoctrine();
            $em = $this->getDoctrine()->getEntityManager();
            
            if( $request->request->get('boxpcp_') ){
                $box = $request->request->get('boxpcp_');
                
                foreach ( $box as $k => $val){
                    $item = $em->getRepository('YxBundle:Cartitems')->find( $val );
                    if ( $item){
                        $em->remove( $item );
                        $em->flush();
                    }
                }
            }
        
            if( $request->request->get('boxpc_') ){
                $box = $request->request->get('boxpc_');
                
                foreach ( $box as $k => $val){
                    $item = $em->getRepository('YxBundle:Cartitems')->find( $val );
                    if ( $item){
                        $em->remove( $item );
                        $em->flush();
                    }
                }
            }
        }
        
        echo 'Removed from Cart.';
        return $this->redirect('/songs/mybasket');

    }

    /**
     * @Route("/songs/preview")
     * @Route("/songs/preview/") 
     * @Route("/songs/preview/{char}") 
     * @param type $char
     * @return type 
     */
    public function previewAction( $char = null ){
        $request = $this->getRequest();
        
        //echo $request->getUri();// getRequestUri();// getBaseUrl() ;
        $this->_session = $this->getRequest()->getSession();
        
        $loginuserEmail = $this->_session->get('Users.id');
        $displayName = $this->_session->get('Users.name');
        
        $this->_viewData['displayName'] = $displayName;
        
        if($loginuserEmail==""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        $condition="Song.id = '".$char."'" ;
        
        $em = $this->getDoctrine()->getEntityManager();
        $joke = $em->getRepository('YxBundle:Songs')->findById( $char );
        
        foreach($joke as $k => $v){
            $songId = $v->getId();
            $this->get_song_rating($songId);
        }

        $this->_viewData['songRating'] = $this->songRating;
        $this->_viewData['joke'] = $joke;
                
        return $this->render('YxBundle:Songs:preview.html.php', $this->_viewData);
    }

    /**
     * @Route("/songs/buy")
     * @Route("/songs/buy/") 
     * @Route("/songs/buy/{chr1}/{chr2}") 
     * @param type $chr1
     * @param type $chr2 
     */
    public function buyAction($chr1 = null, $chr2 = null){
        
        if ($chr1 == 'download' && $chr2 != null){
            $this->download($chr2);
        }
        
        if (!$this->session_check())
            return $this->redirect($this->generateUrl('user_login'), 302);

        $user_id = $this->_session->get('Users.userid');
        $displayName = $this->_session->get('Users.name');
        
        $this->_viewData['displayName'] = $displayName;
        
        if($user_id == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        $userBalance  = 0;
        
        $em = $this->getDoctrine()->getEntityManager();
        $userBalance = $em->getRepository('YxBundle:Userbalances')->findByUserId( $user_id );
        
        if ( $userBalance)
            $userBalance = $userBalance[0]->getAmount();
        
        $this->_conn = $this->get('database_connection');
		

        $basketPrice1 = 0;
        $del = array();
        
        $request = $this->getRequest();
        
        $box = array();
        if (isset($_POST['box_'])) 
            $box = $request->request->get('box_'); 
        
	
        $boxpc = array();
	$boxpcp = array();

        if ( $box ){ 
            foreach( $box as $doc){
                $del[] = $doc;
                $sql = "select sum(abs(Song.ratepc-Song.rate)) as basketPrice from songs as Song
                INNER JOIN cartitems as  Cartitem ON Cartitem.song_id = Song.id
                WHERE Cartitem.user_id = '".$user_id."' 
                group by Cartitem.user_id and Cartitem.id = ".$doc;

                $basketPrice = $this->_conn->fetchAll($sql);
                
                if ($basketPrice[1]){
                    $basketPrice = $basketPrice[1][0]['basketPrice'];
                    $basketPrice1 = $basketPrice1 + $basketPrice;
                }
            }
        }
        
        if ( (isset($_POST['boxpc_'])) ){
            $box = $request->request->get('boxpc_'); 
            foreach($box as $doc){
                if ( ! in_array($doc, $del) ){
                    $status = 'ok';
					
                    $boxpc[] = $doc;
                    $del[] = $doc;
                    $sql = "select sum(Song.ratepc) as basketPrice, Song.id as songid, Song.drm as songdrm 
                            from songs as Song
                            INNER JOIN cartitems as  Cartitem ON Cartitem.song_id = Song.id
                            WHERE Cartitem.user_id = '".$user_id."' 
                            group by Cartitem.user_id and Cartitem.id = ".$doc;
						
                    $basketPrice = $this->_conn->fetchAll($sql);
                    
                    if ($basketPrice[1]){
                        if ($pos = strrpos($basketPrice[1]['songdrm'], '.mp3')){
                        }else{
                            $lic_md5 = md5($user_id . $basketPrice[1]['songid'] . time());
                            $sql1 = "insert into user_licenses (user_id,song_id,lic_md5) values ($user_id,{$basketPrice[1]['songid']},'$lic_md5')";
                            //$this->_conn->query($sql1);
                        }
                        $basketPrice = $basketPrice[1]['basketPrice'];
                        $basketPrice1 = $basketPrice1 + $basketPrice;
                    }
                    
                }
            }
        }

        if ( isset($_POST['boxpcp_']) ){
            $box = $request->request->get('boxpcp_'); 
            foreach($box as $doc){
                if ( ! in_array($doc,$del) ){
                    $status = 'ok';
					
                    $boxpcp[] = $doc;
                    $del[] = $doc;
                    $sql = "select sum(Song.rate) as basketPrice, Song.id as songid, Song.drm as songdrm from songs as Song
                        INNER JOIN cartitems as  Cartitem ON Cartitem.song_id = Song.id
                        WHERE Cartitem.user_id = '".$user_id."' 
                        group by Cartitem.user_id and Cartitem.id = ".$doc;
						
                    $basketPrice = $this->_conn->fetchAll($sql);
				
                    if ($basketPrice[1]){
                        if ($pos = strrpos($basketPrice[1]['songdrm'], '.mp3')){
                        }else{
                            $lic_md5 = md5($user_id . $basketPrice[1]['songid'] . time());
                            $sql1 = "insert into user_licenses (user_id,song_id,lic_md5) values ($user_id,{$basketPrice[1]['songid']},'$lic_md5')";
                            //$this->_conn->query($sql1);
                        }
                        $basketPrice = $basketPrice[1]['basketPrice'];
                        $basketPrice1 = $basketPrice1 + $basketPrice;
                    }
	    					
                }
            }
        }
        

        if (($basketPrice1 > 0)&& ($basketPrice1 > $userBalance)){
            $this->get('session')->getFlashBag()->add( 'notice', 'Insufficient Balance.');
            return $this->redirect("/songs/mybasket");
        }

        //if ($basketPrice1 > 0)
        //{
        foreach($boxpcp as $doc){
            $sql = "update cartitems SET status =1,created='".date("Y-m-d H:i:s")."' WHERE id = ".$doc."";
            $this->_conn->query($sql);

            $sql = "update cartitems SET statuspc =1,created='".date("Y-m-d H:i:s")."' WHERE id = ".$doc."";
            $this->_conn->query($sql);
        }

        foreach($boxpc as $doc){
            $sql = "update cartitems SET statuspc =1,created='".date("Y-m-d H:i:s")."' WHERE id = ".$doc."";
            $this->_conn->query($sql);
        }
            
        $sql = "update userbalances SET amount = (amount-".$basketPrice1.") WHERE user_id = '".$user_id."'";
        $this->_conn->query($sql);

        //echo '<pre>'; print_r( $box ); print_r( $boxpc ); print_r($boxpcp);die;
            
            //$userCartItems = $this->Cartitem->findAll('Cartitem.user_id='.$user_id.' AND Cartitem.status=\'0\'', Null, null, null, null, 2);

            //$this->Cartitem->updateCartStatusToPurchased($user_id,$box,,);
        //}

			//$userCartItems = $this->User->findAll('User.id='.$user_id, null, null, null, null, 2);
			//$userCartItems = $this->Cartitem->findAll('Cartitem.user_id='.$user_id.' AND Cartitem.status=\'1\'', Null, null, null, null, 2);

			//$this->set('userCartItems',$userCartItems);
                        
        return $this->render('YxBundle:Songs:buy.html.php', $this->_viewData);
    }

    /**
     * Public function download
     * @param type $chr 
     */
    public function download($chr){
        $file = "http://yaxmobi.com/".$this->webroot."img/songs/".$chr;

        header("Content-Type: application/x-octet-stream");
        header("Content-Disposition: attachment; filename=".basename($file));
        header("Content-Transfer-Encoding: binary");
        readfile($file);
        exit;
    }


    /**
     * This method adds a item to cart in DB
     * @param type $song_id
     * @param type $user_id
     * @param type $pc
     * @param type $pcp
     * @param type $type 
     */
    private function _addCartItem($song_id, $user_id, $pc, $pcp, $type = 0){
        $this->_conn = $this->get('database_connection');
        
        $sql = "SELECT * 
                from cartitems as Cartitem
                WHERE Cartitem.user_id = '". $user_id ."' and Cartitem.song_id = '". $song_id ."'";
        
        $userCartItems = $this->_conn->fetchAll( $sql );
        
        if ( count($userCartItems) == 0 ){
            $this->data = array(
               'type_upl' =>  $type,
                'song_id'   => $song_id,
                'user_id'   => $user_id,
                'status'    => $pc,
                'statuspc'  => $pcp,
                'created'   => date('Y-m-d H:i:s'),
            );
            
            $this->_conn->insert( 'cartitems', $this->data );
            
            /*$sql = "insert into  cartitems 
                set type_upl = '". $type ."',
                song_id = '". $song_id ."',
                user_id = '". $user_id ."',
                status = '". $pc ."',
                statuspc = '". $pcp ."'";
            
            $this->_conn->query( $sql );*/
            
        }
    }


    /**
     * @Route("/users/song_category")
     * @Route("/users/song_category/")
     * Show jokes category
     * @return type 
     */
    public function song_categoryAction(){
        if (!$this->session_check())
            return $this->redirect($this->generateUrl('user_login'), 302);
        
        $repository = $this->getDoctrine()->getRepository('YxBundle:Genres');
        $songcat    = $repository->findAll();
        
        $loginuserEmail = $this->_session->get('Users.id');
        $displayName = $this->_session->get('Users.name');
        
        $this->_viewData['displayName'] = $displayName;
        
        if($loginuserEmail==""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        $this->_viewData['songcat'] = $songcat;

        
        $repository = $this->getDoctrine()->getRepository('YxBundle:Songs');
        $freeSongs = $repository->findByPaid('N');
        
        $this->_viewData['songcat'] = $songcat;
        
        if (!is_array($freeSongs))
        $freeSongs=array();

        foreach($freeSongs as $k => $v){
                $songId = $v->getId();
                $this->get_song_rating($songId);
        }

        //echo '<pre>'; print_r( $this->songRating );die;
        $this->_viewData['freeSongs'] = $freeSongs;
        $this->_viewData['songRating'] = $this->songRating;
        
        return $this->render('YxBundle:Users:song_category.html.php', $this->_viewData);
    }
    
    /*** ADMIN SECTION */
    
    /**
     * @Route("/admin/songs")
     * @Route("/admin/songs/")
     
     * @return type 
     */
    public function admin_indexAction(){
        if (! $this->session_checkadmin() )
            return $this->redirect($this->generateUrl('admin_login'), 302);

        //  Do Init
        $this->_viewData['base_url'] = '/admin/songs';
        
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $extraParam = array();
        
        //  Init pagination.
        $page = $request->query->get('page');
        $page = $page ? $page : 1;
        
        $limit = 20;
        $midrange = 7;
        $offset = ($page - 1) * $limit;
        
        $order = ' Order By Song.id';
        $limitClause = " Limit $offset, $limit";
        
        if( ! $request->query->get('char') ){
            $addQuery="";
        }else{
            $extraParam['char'] = $request->query->get('char');
            $addQuery=" WHERE Song.composition LIKE '".$request->query->get('char')."%'" ;
        }

        $sql = "select genres.gname, 
                singers.sname, albums.aname,
                Song.*  
                from songs as Song
                left JOIN singers ON Song.singer_id = singers.id
                left JOIN albums ON Song.album_id = albums.id
                left JOIN genres ON Song.genre_id = genres.id
		" . $addQuery . $order . $limitClause;

        
        $songs = $this->_conn->fetchAll( $sql );
        $this->_viewData['songs'] = $songs;
        
        
        //  Get All user count
        $sql = "Select count(Song.id) as num from songs as Song " . $addQuery;
        $items = $this->_conn->fetchAll( $sql );

        $itemsCount = $items[0]['num'];
        
        $paginator = new \Front\YxBundle\Helper\Paginator($itemsCount, $page , $limit, $midrange);
        
        $this->_viewData['paginator'] = $paginator;
        
        $this->_viewData['extraParam'] = $extraParam;
        
        return $this->render('YxBundle:Songs:admin_index.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/songs/edit")
     * @Route("/admin/songs/edit/")
     * @Route("/admin/songs/edit/{id}")
     * * @Route("/admin/songs/edit/{id}/")
     * @return type 
     */
    public function admin_editAction( $id = null ){
        if (! $this->session_checkadmin() )
            return $this->redirect($this->generateUrl('admin_login'), 302);

        //  Do Init
        $this->_viewData['base_url'] = '/admin/songs/genre/'.$id;
        
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $addQuery="";
        
        if ( is_null( $id ) ){
            $this->get('session')->getFlashBag()->add( 'notice', 'Record not Found.');
            return $this->redirect('/admin/songs', 302);
        }
        
        if ( ! $id )
            $id = $_POST['id'];
        
        $songs = $em->getRepository('YxBundle:Songs')->findByid( $id );
        $song = current( $songs );
        
        //echo $song->getMyxerTag();
        
        if ( ! $song ){
            $this->get('session')->getFlashBag()->add( 'notice', 'Record not Found.');
            return $this->redirect('/admin/songs');
        }
        
        $this->_viewData['data'] = $song;
        
        if( $request->request->get('id') ){
            set_time_limit(0);
            
            $data = $request->request->all();

            //  Set data to SOng object
            $song->setComposition( $data['composition'] );
            $song->setYear( $data['year'] );
            
            $song->setDuration( $data['duration'] );
            $song->setRate( $data['rate'] );
            $song->setRatepc( $data['ratepc'] );
            $song->setType( $data['type'] );
            $song->setTag( $data['tag'] ); 
            $song->setSingerid( $data['singer_id'] ); 
            $song->setAlbumid( $data['album_id'] ); 
            $song->setGenreid( $data['genre_id'] ); 
            
            $song->setPaid( $data['paid'] );
            $song->setMyxertag( $data['myxer_tag'] );
           
            $files = $request->files->all();
            
            foreach ( $files as $key => $file ){
                
                if ( $file ){
                    // set path for file uploading in /img/PRODUCT folder
                    $imgpath = WWW_ROOT."img/songs";
                    @chmod($imgpath, 0777);
                
                    $filename = $this->_find_newfilename( $file->getClientOriginalName() , $imgpath);
                    $uploadfile = $imgpath .'/'. $filename;
                    
                    
                    //echo $destination = preg_replace('/app$/si', 'web' . $request->request->get('folder'), $this->get('kernel')->getRootDir());;
                    //die;
                    $file->move( $imgpath, $filename);
                    
                    switch ( $key ){
                        case 'path':
                            $delFileName = $imgpath .'/'. $song->getPath();
                            @unlink($delFileName);
                            
                            $delFileName = $imgpath .'/'. $song->getOrfile();
                            @unlink($delFileName);
                            
                            $song->setOrfile( basename( $filename ) );
                            $song->setPath($filename);
                            break;
                        case 'drm':
                            $delFileName = $imgpath .'/'. $song->getDrm();
                            @unlink($delFileName);
                            
                            $song->setDrm($filename);
                            break;
                        case 'sample_file':
                            $delFileName = $imgpath .'/'. $song->getSamplefile();
                            @unlink($delFileName);
                            
                            $song->setSamplefile($filename);
                            break;
                        case 'sample_file_before':
                            $delFileName = $imgpath .'/'. $song->getSamplefilebefore();
                            @unlink($delFileName);
                            
                            $song->setSamplefilebefore($filename);
                            break;
                    }
                }
            }
            
            
            $em->persist( $song );
            $em->flush();
            
            $this->get('session')->getFlashBag()->add( 'notice', 'Successfully Updated.');
            return $this->redirect("/admin/songs");
        }
        
        //  Get Singer
        $this->_viewData['singers']  = $em->getRepository('YxBundle:Singers')->findAll();
        //  Get Album
        $this->_viewData['albums']   = $em->getRepository('YxBundle:Albums')->findAll();
        //  Get Genre
        $this->_viewData['genres']   = $em->getRepository('YxBundle:Genres')->findAll();
        
        return $this->render('YxBundle:Songs:admin_edit.html.php', $this->_viewData);
    }
    
    
    /**
     * @Route("/admin/songs/add")
     * @Route("/admin/songs/add/")
     * @return type 
     */
    public function admin_addAction(){
        if (! $this->session_checkadmin() )
            return $this->redirect($this->generateUrl('admin_login'), 302);

        //  Do Init
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $song = new \Front\YxBundle\Entity\Songs();

        
        
        if( $request->request->get('composition') ){
            set_time_limit(0);
            
            $data = $request->request->all();

            //  Set data to SOng object
            $song->setComposition( $data['composition'] );
            $song->setYear( $data['year'] );
            $song->setDuration( $data['duration'] );
            $song->setPaid( $data['paid'] );
            $song->setRate( $data['rate'] );
            $song->setRatepc( $data['ratepc'] );
            $song->setType( $data['type'] );
            $song->setTag( $data['tag'] ); 
            $song->setSingerid( $data['singer_id'] ); 
            $song->setAlbumid( $data['album_id'] ); 
            $song->setGenreid( $data['genre_id'] ); 
            $song->setGrade( 0 ); 
            $song->setStatPc( 0 ); 
            $song->setStatPhone( 0 ); 
            $song->setView( 0 ); 
            
            $song->setOrfile('');
            $song->setPath('');
            $song->setDrm('');
            $song->setSamplefile('');
            $song->setSamplefilebefore('');
            
           
            $files = $request->files->all();
            //echo '<pre>'; print_r( $files );die;
            
            foreach ( $files as $key => $file ){
                if ( $file ){
                    // set path for file uploading in /img/PRODUCT folder
                    $imgpath = WWW_ROOT."img/songs";
                    @chmod($imgpath, 0777);
                
                    $filename = $this->_find_newfilename( $file->getClientOriginalName() , $imgpath);
                    $uploadfile = $imgpath .'/'. $filename;
                    
                    
                    //echo $destination = preg_replace('/app$/si', 'web' . $request->request->get('folder'), $this->get('kernel')->getRootDir());;
                    //die;
                    $file->move( $imgpath, $filename);
                    
                    switch ( $key ){
                        case 'path':
                            $song->setOrfile( basename( $filename ) );
                            $song->setPath($filename);
                            break;
                        case 'drm':
                            $song->setDrm($filename);
                            break;
                        case 'sample_file':
                            $song->setSamplefile($filename);
                            break;
                        case 'sample_file_before':
                            $song->setOrfile( basename( $filename ) );
                            $song->setPath($filename);
                            $song->setDrm($filename);
                            $song->setSamplefile($filename);
                            $song->setSamplefilebefore($filename);
                            break;
                    }
                }
            }
            
            //echo '<pre>'; print_r( $song );die;
            $em->persist( $song );
            $em->flush();
            
            $this->get('session')->getFlashBag()->add( 'notice', 'Successfully Added.');
            return $this->redirect("/admin/songs");
        }
        
        //  Get Singer
        $this->_viewData['singers']  = $em->getRepository('YxBundle:Singers')->findAll();
        //  Get Album
        $this->_viewData['albums']   = $em->getRepository('YxBundle:Albums')->findAll();
        //  Get Genre
        $this->_viewData['genres']   = $em->getRepository('YxBundle:Genres')->findAll();
                
        return $this->render('YxBundle:Songs:admin_add.html.php', $this->_viewData);
    }
    
    /***
     * private function find_newfilename
     * This method returns the new valid filename.
     */
    private function _find_newfilename($filename, $folder) {
        $path_info = pathinfo($filename);
        $basename = trim($path_info['basename']);

        $ext = '.'.$path_info['extension'];

        $name = basename($basename, $ext);
        $name = str_replace(" ","_",$name);
        $name = str_replace("\'","",$name);
        $name = str_replace("\&","",$name);
        $name = str_replace("\^","",$name);
        $name = str_replace("\?","",$name);
        $name = str_replace("\!","",$name);
        $name = strtolower($name);

        if($ext != '.') {
                $basename = $name . $ext;
                $dest = $folder .'/'. $basename;

        } else {
                $basename = $name;
                $dest = $folder .'/'. $basename;
        }

        if(file_exists($dest)) {
                $counter = 0;
                do {
                        $counter++;
                        if($ext != '.') $basename = $name .'_'. $counter . $ext;
                        else $basename = $name .'_'. $counter;
                        /*          $basename = $name .'_'. $counter . $ext; */
                        $dest = $folder .'/'. $basename;
                        if ($counter > 1000) break;
                } while (file_exists($dest));
        }

        return $basename;
    }
    
    /**
     * @Route("/admin/songs/singer")
     * @Route("/admin/songs/singer/")
     * @Route("/admin/songs/singer/{id}")
     * * @Route("/admin/songs/singer/{id}/")
     * @return type 
     */
    public function admin_singerAction( $id = null ){
        if (! $this->session_checkadmin() )
            return $this->redirect($this->generateUrl('admin_login'), 302);

        //  Do Init
        $this->_viewData['base_url'] = '/admin/songs/singer/'.$id;
        
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $extraParam = array();
        $addQuery="";
        
        //  Init pagination.
        $page = $request->query->get('page');
        $page = $page ? $page : 1;
        
        
        $limit = 20;
        $midrange = 7;
        $offset = ($page - 1) * $limit;
        
        $order = ' Order By Song.id';
        $limitClause = " Limit $offset, $limit";
        
        if( $request->query->get('char') ){
            $extraParam['char'] = $request->query->get('char');
            $addQuery =" WHERE Song.composition LIKE '".$request->query->get('char')."%'" ;
        }

        if ( ! is_null( $id ) ){
            if ( $addQuery == '' )
                $addQuery = " WHERE Song.singer_id =".$id."";
            else
                $addQuery = " AND Song.singer_id =".$id."";
        }
        
                
        $sql = "select genres.gname, 
                singers.sname, albums.aname,
                Song.id, Song.year, Song.album_id, Song.genre_id, Song.composition
                from songs as Song
                left JOIN singers ON Song.singer_id = singers.id
                left JOIN albums ON Song.album_id = albums.id
                left JOIN genres ON Song.genre_id = genres.id
		" . $addQuery . $order . $limitClause;

        $songs = $this->_conn->fetchAll( $sql );
        $this->_viewData['songs'] = $songs;
        
        
        //  Get All user count
        $sql = "Select count(Song.id) as num from songs as Song " . $addQuery;
        
        $items = $this->_conn->fetchAll( $sql );

        $itemsCount = $items[0]['num'];
        
        $paginator = new \Front\YxBundle\Helper\Paginator($itemsCount, $page , $limit, $midrange);
        
        $this->_viewData['paginator'] = $paginator;
        
        $this->_viewData['extraParam'] = $extraParam;
        
        return $this->render('YxBundle:Songs:admin_singer.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/songs/album")
     * @Route("/admin/songs/album/")
     * @Route("/admin/songs/album/{id}")
     * * @Route("/admin/songs/album/{id}/")
     * @return type 
     */
    public function admin_albumAction( $id = null ){
        if (! $this->session_checkadmin() )
            return $this->redirect($this->generateUrl('admin_login'), 302);

        //  Do Init
        $this->_viewData['base_url'] = '/admin/songs/album/'.$id;
        
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $extraParam = array();
        $addQuery="";
        
        //  Init pagination.
        $page = $request->query->get('page');
        $page = $page ? $page : 1;
        
        
        $limit = 20;
        $midrange = 7;
        $offset = ($page - 1) * $limit;
        
        $order = ' Order By Song.id';
        $limitClause = " Limit $offset, $limit";
        
        if( $request->query->get('char') ){
            $extraParam['char'] = $request->query->get('char');
            $addQuery =" WHERE albums.aname LIKE '".$request->query->get('char')."%'" ;
        }

        if ( ! is_null( $id ) ){
            if ( $addQuery == '' )
                $addQuery = " WHERE Song.album_id =".$id."";
            else
                $addQuery = " AND Song.album_id =".$id."";
        }
        
                
        $sql = "select genres.gname, 
                singers.sname, albums.aname,
                Song.id, Song.year, Song.album_id, Song.genre_id, Song.composition
                from songs as Song
                left JOIN singers ON Song.singer_id = singers.id
                left JOIN albums ON Song.album_id = albums.id
                left JOIN genres ON Song.genre_id = genres.id
		" . $addQuery . $order . $limitClause;

        $songs = $this->_conn->fetchAll( $sql );
        $this->_viewData['songs'] = $songs;
        
        
        //  Get All user count
        $sql = "Select count(Song.id) as num from songs as Song " . $addQuery;
        
        $items = $this->_conn->fetchAll( $sql );

        $itemsCount = $items[0]['num'];
        
        $paginator = new \Front\YxBundle\Helper\Paginator($itemsCount, $page , $limit, $midrange);
        
        $this->_viewData['paginator'] = $paginator;
        
        $this->_viewData['extraParam'] = $extraParam;
        
        return $this->render('YxBundle:Songs:admin_album.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/songs/genre")
     * @Route("/admin/songs/genre/")
     * @Route("/admin/songs/genre/{id}")
     * * @Route("/admin/songs/genre/{id}/")
     * @return type 
     */
    public function admin_genreAction( $id = null ){
        if (! $this->session_checkadmin() )
            return $this->redirect($this->generateUrl('admin_login'), 302);

        //  Do Init
        $this->_viewData['base_url'] = '/admin/songs/genre/'.$id;
        
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $extraParam = array();
        $addQuery="";
        
        //  Init pagination.
        $page = $request->query->get('page');
        $page = $page ? $page : 1;
        
        
        $limit = 20;
        $midrange = 7;
        $offset = ($page - 1) * $limit;
        
        $order = ' Order By Song.id';
        $limitClause = " Limit $offset, $limit";
        
        if ( ! is_null( $id ) ){
            if ( $addQuery == '' )
                $addQuery = " WHERE Song.genre_id =".$id."";
            else
                $addQuery = " AND Song.genre_id =".$id."";
        }
        
                
        $sql = "select genres.gname, 
                singers.sname, albums.aname,
                Song.id, Song.year, Song.album_id, Song.genre_id, Song.composition
                from songs as Song
                left JOIN singers ON Song.singer_id = singers.id
                left JOIN albums ON Song.album_id = albums.id
                left JOIN genres ON Song.genre_id = genres.id
		" . $addQuery . $order . $limitClause;

        $songs = $this->_conn->fetchAll( $sql );
        $this->_viewData['songs'] = $songs;
        
        
        //  Get All user count
        $sql = "Select count(Song.id) as num from songs as Song " . $addQuery;
        
        $items = $this->_conn->fetchAll( $sql );

        $itemsCount = $items[0]['num'];
        
        $paginator = new \Front\YxBundle\Helper\Paginator($itemsCount, $page , $limit, $midrange);
        
        $this->_viewData['paginator'] = $paginator;
        
        $this->_viewData['extraParam'] = $extraParam;
        
        return $this->render('YxBundle:Songs:admin_genre.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/delete_song")
     * @Route("/admin/delete_song/")
     * @return type 
     */
    public function admin_deleteAction(){
        if (! $this->session_checkadmin() )
            return $this->redirect($this->generateUrl('admin_login'), 302);
        
        //  Do Init
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        if( $request->request->get('act') && $request->request->get('act') == 'delete_me' ){
            $ids = explode(',', $request->request->get('ids'));
            
            foreach ( $ids as $id ){
                if ( $id != '' ){
                    $data = $em->getRepository('YxBundle:Songs')->find($id);
                    
                    //  Delete main song file
                    $path = $data->getPath();
                    $imgpath = WWW_ROOT."img/". "songs/";
                    $imgpath = $imgpath . $path;
                    
                    if (is_file($imgpath)){
                        @chmod($imgpath, 0777);
                        @unlink($imgpath);
                        
                    }
                        
                    //  Delete preview file
                    $path = $data->getSampleFile();
                    $imgpath = WWW_ROOT."img/songs/sample_file/";
                    $imgpath = $imgpath . $path;
                    
                    if (is_file($imgpath)){
                        @chmod($imgpath, 0777);
                        @unlink($imgpath);
                    }
                    
                    $em->remove($data);
                    $em->flush();
                }
            }
        }
        
        echo 'Record deleted.';
        return new \Symfony\Component\HttpFoundation\Response();
        
    }
    

}
