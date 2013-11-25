<?php

namespace Front\YxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class SubscriptionsController extends BaseController {
    /**
     * @Route("/subscriptions")
     * @Route("/subscriptions/")
     * @Route("/subscriptions/index")
     * @Route("/subscriptions/index/")
     */
    public function indexAction( $chr = null ){
        $this->_session = $this->getRequest()->getSession();
        $user_id = $this->_session->get('Users.userid');
        $this->_viewData['user_id'] = $user_id;
        
        $displayName = $this->_session->get('Users.name');
        $this->_viewData['displayName'] = $displayName;
        
        if($user_id == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        $this->_viewData['planName'] = "";
        
        return $this->render('YxBundle:Subscriptions:index.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/subscriptions/a_la_carte")
     * @Route("/subscriptions/a_la_carte/")
     */
    public function a_la_carteAction(){
        $this->_session = $this->getRequest()->getSession();
        $user_id = $this->_session->get('Users.userid');
        $this->_viewData['user_id'] = $user_id;
        
        $displayName = $this->_session->get('Users.name');
        $this->_viewData['displayName'] = $displayName;
        
        if($user_id == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        $this->_viewData['planName'] = "A La Carte";
        
        return $this->render('YxBundle:Subscriptions:a_la_carte.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/subscriptions/ringtone")
     * @Route("/subscriptions/ringtone/")
     */
    public function ringtoneAction(){
        $this->_session = $this->getRequest()->getSession();
        $user_id = $this->_session->get('Users.userid');
        $this->_viewData['user_id'] = $user_id;
        
        $displayName = $this->_session->get('Users.name');
        $this->_viewData['displayName'] = $displayName;
        
        if($user_id == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        $this->_viewData['planName'] = "Ringtone Plans";
        
        return $this->render('YxBundle:Subscriptions:ringtone.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/subscriptions/audio_joke")
     * @Route("/subscriptions/audio_joke/")
     */
    public function audio_jokeAction(){
        $this->_session = $this->getRequest()->getSession();
        $user_id = $this->_session->get('Users.userid');
        $this->_viewData['user_id'] = $user_id;
        
        $displayName = $this->_session->get('Users.name');
        $this->_viewData['displayName'] = $displayName;
        
        if($user_id == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        $this->_viewData['planName'] = "Audio Jokes Plans";
        
        return $this->render('YxBundle:Subscriptions:audio_joke.html.php', $this->_viewData);
    }
    
    
    /**
     * @Route("/subscriptions/combo_plan")
     * @Route("/subscriptions/combo_plan/")
     */
    public function combo_planAction(){
        $this->_session = $this->getRequest()->getSession();
        $user_id = $this->_session->get('Users.userid');
        $this->_viewData['user_id'] = $user_id;
        
        $displayName = $this->_session->get('Users.name');
        $this->_viewData['displayName'] = $displayName;
        
        if($user_id == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        $this->_viewData['planName'] = "Combo Plans";
        
        return $this->render('YxBundle:Subscriptions:combo_plan.html.php', $this->_viewData);
    }

    /**
     * @Route("/subscriptions/all")
     * @Route("/subscriptions/all/")
     */
    public function allAction(){
        $this->_session = $this->getRequest()->getSession();
        $user_id = $this->_session->get('Users.userid');
        $this->_viewData['user_id'] = $user_id;
        
        $conn = $this->get('database_connection');
        $user = $conn->fetchAll("select * from users where id=".$user_id);
        $this->_viewData['user'] = $user[0];
        $this->_viewData['users'] = $user[0];
    
        $types = $conn->fetchAll("select * from subscriptions where id=".$user[0]['id_subscript']);
		
        if (count($types) > 0)
            $this->_viewData['types'] = $types[0];
        else
            $this->_viewData['types'] = '';
			
        $subscriptions = $conn->fetchAll("select * from subscriptions ");
        $this->_viewData['subscriptions'] = $subscriptions;
        
        return $this->render('YxBundle:Subscriptions:all.html.php', $this->_viewData);
    }


    /**
     * @Route("/subscriptions/ringtone_subscription")
     * @Route("/subscriptions/ringtone_subscription/")
     * @Route("/subscriptions/ringtone_subscription/{chr}")
     * @Route("/subscriptions/ringtone_subscription/{chr}/")
     * @param type $chr
     * @return type 
     */
    public function ringtone_subscriptionAction( $chr = '1'){
        $conn = $this->get('database_connection');
        switch ($chr){
            case 1:
                    $condition = "Subscription.count_ring > 0 AND Subscription.count_joke = 0 AND Subscription.name = 'Tickle'";
                    $fields = "Subscription.id, Subscription.name, Subscription.count_ring, Subscription.price, Subscription.per_ring, Subscription.delivery_mail, Subscription.delivery_phone";
                    
                    $sql = "SELECT ". $fields ." from
                        subscriptions as Subscription
                        WHERE ". $condition ."
                    ";
                    
                    $plan = $conn->fetchAll($sql);

                    $this->_viewData['plan'] = $plan;
                    $this->_viewData['planTitle'] = 'Tickle';
                    $htmlView = 'tickel';
            break;
            case 2:
                    $condition = "Subscription.count_ring > 0 AND Subscription.count_joke = 0 AND Subscription.name = 'Blast'";
                    $fields = "Subscription.id, Subscription.name, Subscription.count_ring, Subscription.price, Subscription.per_ring, Subscription.delivery_mail, Subscription.delivery_phone";
                    $sql = "SELECT ". $fields ." from
                        subscriptions as Subscription
                        WHERE ". $condition ."
                    ";
                    
                    
                    $plan = $conn->fetchAll($sql);
                    
                    $this->_viewData['plan'] = $plan;
                    $this->_viewData['planTitle'] = 'Blast';
                    
                    $htmlView = 'blast';
            break;
        }
        $this->_session = $this->getRequest()->getSession();
        
        $user_id = $this->_session->get('Users.userid');
        
        $user = $conn->fetchAll("select * from users where id=".$user_id);
        
        $this->_viewData['user'] = $user[0];
        $this->_viewData['users'] = $user[0];
        
        
        return $this->render('YxBundle:Subscriptions:'.$htmlView.'_ringtone.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/subscriptions/combo_plan_subscription")
     * @Route("/subscriptions/combo_plan_subscription/")
     * @Route("/subscriptions/combo_plan_subscription/{chr}")
     * @Route("/subscriptions/combo_plan_subscription/{chr}/")
     * @param type $chr
     * @return type 
     */
    public function combo_plan_subscriptionAction( $chr = '1'){
        $conn = $this->get('database_connection');
        switch ($chr){
            case 1:
                    $condition = "Subscription.count_ring > 0 AND Subscription.count_joke > 0 AND Subscription.name = 'Tickle'";
                    $sql = "SELECT * from
                        subscriptions as Subscription
                        WHERE ". $condition ."
                    ";
                    
                    $plan = $conn->fetchAll($sql);

                    $this->_viewData['plan'] = $plan;
                    $this->_viewData['planTitle'] = 'Tickle';
                    $htmlView = 'tickel';
            break;
            case 2:
                    $condition = "Subscription.count_ring > 0 AND Subscription.count_joke > 0 AND Subscription.name = 'Tickle + Send to Phone Option'";
                    $sql = "SELECT * from
                        subscriptions as Subscription
                        WHERE ". $condition ."
                    ";
                    
                    
                    $plan = $conn->fetchAll($sql);
                    
                    $this->_viewData['plan'] = $plan;
                    $this->_viewData['planTitle'] = 'Tickle + Send to Phone Option';
                    
                    $htmlView = 'tickle1';
            break;
        }
        $this->_session = $this->getRequest()->getSession();
        
        $user_id = $this->_session->get('Users.userid');
        
        $user = $conn->fetchAll("select * from users where id=".$user_id);
        
        $this->_viewData['user'] = $user[0];
        $this->_viewData['users'] = $user[0];
        
        
        return $this->render('YxBundle:Subscriptions:'.$htmlView.'_combo_plan.html.php', $this->_viewData);
    }
    

    /**
     * @Route("/subscriptions/audio_joke_subscription")
     * @Route("/subscriptions/audio_joke_subscription/")
     * @Route("/subscriptions/audio_joke_subscription/{chr}")
     * @Route("/subscriptions/audio_joke_subscription/{chr}/")
     * @param type $chr
     * @return type 
     */
    public function audio_joke_subscriptionAction($chr = 1){
        $conn = $this->get('database_connection');
        switch ($chr){
            case 1:
                $condition = "Subscription.count_joke > 0 AND Subscription.count_ring = 0 AND Subscription.name = 'Tickle'";
                
                $sql = "SELECT * from
                    subscriptions as Subscription
                    WHERE ". $condition ."
                ";

                $plan = $conn->fetchAll($sql);
                
                $this->_viewData['plan'] = $plan;
                $this->_viewData['planTitle'] = 'Tickle';
                $htmlView = 'tickel';
                break;
            case 2:
                $condition = "Subscription.count_joke > 0 AND Subscription.count_ring = 0 AND Subscription.name = 'Blast'";
                
                $sql = "SELECT * from
                    subscriptions as Subscription
                    WHERE ". $condition ."
                ";

                $plan = $conn->fetchAll($sql);
                
                $this->_viewData['plan'] = $plan;
                $this->_viewData['planTitle'] = 'Blast';
                $htmlView = 'blast';
                break;
            case 3:
                $condition = "Subscription.count_joke > 0 AND Subscription.count_ring = 0 AND Subscription.name = 'Tickle + Send to Phone Option'";
                
                $sql = "SELECT * from
                    subscriptions as Subscription
                    WHERE ". $condition ."
                ";

                $plan = $conn->fetchAll($sql);
                
                $this->_viewData['plan'] = $plan;
                $this->_viewData['planTitle'] = 'Tickle + Send to Phone Option';
                $htmlView = 'tickel1';
                break;
            case 4:
                $condition = "Subscription.count_joke > 0 AND Subscription.count_ring = 0 AND Subscription.name = 'Blast + Send to Phone Option'";
                
                $sql = "SELECT * from
                    subscriptions as Subscription
                    WHERE ". $condition ."
                ";

                $plan = $conn->fetchAll($sql);
                
                $this->_viewData['plan'] = $plan;
                $this->_viewData['planTitle'] = 'Blast + Send to Phone Option';
                $htmlView = 'blast1';
                break;
            case 5:
                $condition = "Subscription.count_joke > 0 AND Subscription.count_ring = 0 AND Subscription.name = 'Happy Mondays'";
                
                $sql = "SELECT * from
                    subscriptions as Subscription
                    WHERE ". $condition ."
                ";

                $plan = $conn->fetchAll($sql);
                
                $this->_viewData['plan'] = $plan;
                $this->_viewData['planTitle'] = 'Happy Mondays';
                $htmlView = 'happy_mondays';
                break;
        }
		
        $this->_session = $this->getRequest()->getSession();

        $user_id = $this->_session->get('Users.userid');

        $user = $conn->fetchAll("select * from users where id=".$user_id);

        $this->_viewData['user'] = $user[0];
        $this->_viewData['users'] = $user[0];
                
        return $this->render('YxBundle:Subscriptions:'.$htmlView.'_a_joke.html.php', $this->_viewData);
    }


    /*** Admin Section */
    /**
     * @Route("/admin/subscriptions")
     * @Route("/admin/subscriptions/")
     */
    public function admin_indexAction(){
        if (! $this->session_checkadmin() )
            return $this->redirect($this->generateUrl('admin_login'), 302);
        
        //  Do Init
        $this->_viewData['base_url'] = '/admin/subscriptions';
        
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
        
        $order = ' Order By Subscription.id';
        $limitClause = " Limit $offset, $limit";
        
        if( ! $request->query->get('char') ){
            $addQuery="";
        }else{
            $extraParam['char'] = $request->query->get('char');
            $addQuery=" WHERE Subscription.name LIKE '".$request->query->get('char')."%'" ;
        }
        
        $sql = "select Subscription.*, count(User.id_subscript) as num from 
                subscriptions as Subscription 
                left join users as User on User.id_subscript = Subscription.id 
                " . $addQuery . " group by Subscription.id " . $order . $limitClause ;
                ;
        
        $records = $this->_conn->fetchAll( $sql );
        $this->_viewData['records'] = $records;
        
        //  Get All item count
        $sql = "Select count(Subscription.id) as num from subscriptions as Subscription 
                left join users as User on User.id_subscript = Subscription.id 
                " . $addQuery;// . " group by Subscription.id ";
        
        $items = $this->_conn->fetchAll( $sql );

        $itemsCount = $items[0]['num'];
        
        $paginator = new \Front\YxBundle\Helper\Paginator($itemsCount, $page , $limit, $midrange);
        
        $this->_viewData['paginator'] = $paginator;
        
        $this->_viewData['extraParam'] = $extraParam;

        return $this->render('YxBundle:Subscriptions:admin_index.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/subscriptions/add")
     * @Route("/admin/subscriptions/add/")
     * @return type 
     */
    public function admin_addAction(){
        //  Do Init
        $this->_viewData['base_url'] = '/admin/subscriptions';
        
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $extraParam = array();
        
        if ( $request->request->get('name') ){
            
            $data = $request->request->all();
            $record = new \Front\YxBundle\Entity\Subscriptions();

            $record->setName( $data['name'] );
            $record->setCountJoke( $data['count_joke'] );
            $record->setCountRing( $data['count_ring'] );
            $record->setPrice( $data['price'] );
            $record->setPerJoke( $data['per_joke'] );
            $record->setPerRing( $data['per_ring'] );
            $record->setDeliveryMail( $data['delivery_mail'] );
            $record->setDeliveryPhone( $data['delivery_phone'] );
            
            $em->persist( $record );
            $em->flush();
            
            $this->get('session')->getFlashBag()->add( 'notice', 'Successfully Added.');
            return $this->redirect('/admin/subscriptions');
        }
        
        return $this->render('YxBundle:Subscriptions:admin_add.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/subscriptions/edit")
     * @Route("/admin/subscriptions/edit/")
     * @Route("/admin/subscriptions/edit/{id}")
     * @return type 
     */
    public function admin_editAction( $id = false ){
        //  Do Init
        $this->_viewData['base_url'] = '/admin/subscriptions';
        
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $extraParam = array();
        
        if ( ! $id )
            $id = $request->request->get('id');
        
        $records = $em->getRepository('YxBundle:Subscriptions')->findById( $id );
        $record = current( $records );

        if ( ! $record ){
            $this->get('session')->getFlashBag()->add( 'notice', 'Record not Found.');
            return $this->redirect('/admin/subscriptions');
        }
        $this->_viewData['record'] = $record;
        
        if ( $request->request->get('id') ){
            
            $data = $request->request->all();

            $record->setName( $data['name'] );
            $record->setCountJoke( $data['count_joke'] );
            $record->setCountRing( $data['count_ring'] );
            $record->setPrice( $data['price'] );
            $record->setPerJoke( $data['per_joke'] );
            $record->setPerRing( $data['per_ring'] );
            $record->setDeliveryMail( $data['delivery_mail'] );
            $record->setDeliveryPhone( $data['delivery_phone'] );
            
            $em->persist( $record );
            $em->flush();
            
            $this->get('session')->getFlashBag()->add( 'notice', 'Successfully Updated.');
            return $this->redirect('/admin/subscriptions');
        }
        
        return $this->render('YxBundle:Subscriptions:admin_edit.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/delete_subscription")
     * @Route("/admin/delete_subscription/")
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
                    $data = $em->getRepository('YxBundle:Subscriptions')->find($id);
                    
                    $em->remove($data);
                    $em->flush();
                }
            }
        }
        
        echo 'Record deleted.';
        return new \Symfony\Component\HttpFoundation\Response();
        
    }
    

}
