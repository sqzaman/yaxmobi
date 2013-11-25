<?php

namespace Front\YxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class RingtonesController extends BaseController {
    /**
     * @Route("/ringtones/ringtonelist")
     * @Route("/ringtones/ringtonelist/")
     * @Route("/ringtones/ringtonelist/{chr}")
     * @Route("/ringtones/ringtonelist/{chr}/")
     */
    public function ringtonelistAction( $chr = 1 ){
        $errMsg = '';
        
        $this->_session = $this->getRequest()->getSession();
        
        $em = $this->getDoctrine()->getEntityManager();
        $ringcat = $em->getRepository('YxBundle:Ringtonecategories')->findById($chr);
        
        $this->_viewData['ringcat'] = $ringcat[0]->getTitle();//['title'];
        
        $user_id = $this->_session->get('Users.userid');
        
        $displayName = $this->_session->get('Users.name');
        $this->_viewData['displayName'] = $displayName;
        
        if($user_id == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        //  Init pagination.
        $request = $this->getRequest();
        
        $extraParam = array();
        $this->_viewData['base_url'] = '/ringtones/ringtonelist/' . $chr;
        
        $page = $request->query->get('page');
        $page = $page ? $page : 1;
        $limit = 10;
        $midrange = 7;
        $offset = ($page - 1) * $limit;
        
        $limitClause = " Limit $offset, $limit";

        $conditions ="Ringtone.category = '".$chr."' AND Ringtone.status = '1'";
        $order = "Ringtone.type ASC ";

        $this->_conn = $this->get('database_connection');
        
        $sql = "SELECT * from ringtones as Ringtone
                WHERE ". $conditions ."
                ORDER BY ". $order ." " . $limitClause;
        
        $ringtone = $this->_conn->fetchAll( $sql );

        foreach($ringtone as $k => $v){
            $jokeId = $v['id'];
            $this->get_song_rating($jokeId);
        }

        //  Get All user count
        $sql = "Select count(Ringtone.id) as num from ringtones as Ringtone WHERE " . $conditions ;
        
        $items = $this->_conn->fetchAll( $sql );

        $itemsCount = $items[0]['num'];
        
        $paginator = new \Front\YxBundle\Helper\Paginator($itemsCount, $page , $limit, $midrange);
        
        $this->_viewData['paginator'] = $paginator;
        
        $this->_viewData['extraParam'] = $extraParam;
        

        $this->_viewData['songRating'] = $this->songRating;
        $this->_viewData['ringtones'] = $ringtone;
              
        return $this->render('YxBundle:Ringtones:ringtonelist.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/ringtones")
     * @Route("/ringtones/")
     * @Route("/ringtones/index")
     * @Route("/ringtones/index/")
     * @Route("/ringtones/index/{chr}")
     */
    public function indexAction($chr = '1'){
        $errMsg = '';

        if ($chr == 1 )
            $errMsg = "Your account balance is low. Please select different ringtone.";
        
        $this->_viewData['errMsg'] = $errMsg;
        
        $this->_session = $this->getRequest()->getSession();
        $user_id = $this->_session->get('Users.userid');
        $this->_viewData['user_id'] = $user_id;
        
        $displayName = $this->_session->get('Users.name');
        $this->_viewData['displayName'] = $displayName;
        
        if($user_id == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;

        $conditions="";
        $conditions .="Ringtone.status = '1'";
        $order = "Ringtone.type ASC ";
        $conn = $this->get('database_connection');
        
        echo $sql = "SELECT * from ringtones as Ringtone
                WHERE ". $conditions ."
                ORDER BY ". $order ."
                limit 10
                ";
        
        $ringtone = $conn->fetchAll( $sql );
        
        foreach($ringtone as $k => $v){
            $jokeId = $v['id'];
            $this->get_song_rating($jokeId);
        }
        
        $this->_viewData['songRating'] = $this->songRating;
        $this->_viewData['ringtones'] = $ringtone;
        
        return $this->render('YxBundle:Ringtones:index.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/ringtones/preview")
     * @Route("/ringtones/preview/")
     * @Route("/ringtones/preview/{chr}")
     * @Route("/ringtones/preview/{chr}/")
     */
    public function previewAction( $chr = null ){
        $this->_session = $this->getRequest()->getSession();
        $user_id = $this->_session->get('Users.userid');
        $this->_viewData['user_id'] = $user_id;
        
        $displayName = $this->_session->get('Users.name');
        $this->_viewData['displayName'] = $displayName;
        
        if($user_id == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        $conditions ="Ringtone.id = '".$chr."' AND Ringtone.status = '1'";
        $conn = $this->get('database_connection');
        
        $sql = "SELECT * from ringtones as Ringtone
                WHERE ". $conditions ."
                ";
        
        $ringtone = $conn->fetchAll( $sql );
//echo '<pre>'; print_r( $ringtone );die;
        foreach($ringtone as $k => $v){
            $jokeId = $v['id'];
            $this->get_song_rating($jokeId);
        }

        $this->_viewData['songRating'] = $this->songRating;
        $this->_viewData['ringtones'] = $ringtone;
                
        return $this->render('YxBundle:Ringtones:preview.html.php', $this->_viewData);
    }


    /**
     * @Route("/ringtones/download")
     * @Route("/ringtones/download/")
     */
    public function downloadAction(){
        if (!$this->session_check()){
            $this->get('session')->setFlash('notice', 'Please sign in to download this ringtone.!');
            return $this->redirect($this->generateUrl('user_login'), 302);
        }
            
        $user_id = $this->_session->get('Users.userid');
        
        //	Initialize variable
        $downloadSite = '';

        if (isset( $_POST['type'] ) && $_POST['type'] == '1'){
            if(!empty($_POST)){
                if(isset($_POST['idf']) &&(intval($_POST['idf'])!=0)){
                    $em = $this->getDoctrine()->getEntityManager();
                    $userBalance = $em->getRepository('YxBundle:Userbalances')->findByUserId($user_id);

                    if ($userBalance){
                        $userBalance = $userBalance[0]->getAmount();
                    }

                    $conn = $this->get('database_connection');

                    $sql = "select sum(ringtones.price) as basketPrice from ringtones where ringtones.id = '".$_POST['idf']."' limit 1";
                    $basketPrice = $conn->fetchAll( $sql );

                    if ($basketPrice){
                        $basketPrice = $basketPrice[0]['basketPrice'];
                    }

                    if (($basketPrice > 0) && ($basketPrice > $userBalance)){
                        $this->get('session')->getFlashBag()->add( 'notice', 'Insufficient Balance.!');
                        return $this->redirect('/ringtonecategory');
                        die;
                    }
                    
                    $sql = "update userbalances SET amount = (amount-". $basketPrice .") WHERE user_id = '". $user_id ."'";
                    $conn->query( $sql );

                    $sql = "insert into cartitems set
                            song_id	=  ".$_POST['idf'].",	 	 	 	 	 	 	 
                            user_id	= ".$user_id.",	 	 	 	 	 
                            created	='".date('Y-m-d H:i:s')."', 	 	 	 	 	 	 
                            modified='".date('Y-m-d H:i:s')."', 	 	 	 	 	 	 
                            status='1',
                            type='r'";

                    $conn->query( $sql );
                }
            }
                $this->_viewData['textansw'] = 'Thanks for your ringtone purchase. Please go to <a href="/users/">Recent Downloads</a> to retrieve your item(s).<br><br>
                <a href="/ringtonecategory/">Back To Ringtones Categories</a>';
        }else{
            $downloadSite = 2;
            $this->_viewData['myxer_tag'] = $_POST['myxer_tag'];
        }

        $user_id        = $this->_session->get('Users.id');
        $displayName    = $this->_session->get('Users.name');
        $this->_viewData['displayName'] = $displayName;
        
        if($user_id == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
                
        $this->_viewData['downloadSite'] = $downloadSite;
		
        //	set ringtone file
        if (isset($_POST['ringtone_file']) && !empty($_POST['ringtone_file'])){
            /*$em = $this->getDoctrine()->getEntityManager();
            $countries = $em->getRepository('YxBundle:Countries')->findAll();
            
            $this->_viewData['countries'] = $countries;*/

            $file = $_POST['ringtone_file'];
            $fileTitle = $_POST['ringtone_title'];

            $this->_viewData['file'] = $file;
            $this->_viewData['fileTitle'] = $fileTitle;
        }else{
            return $this->redirect('/ringtones/index');
        }

        return $this->render('YxBundle:Ringtones:download.html.php', $this->_viewData);
    }
    
    //  Admin Section 
    
    /**
     * @Route("/admin/ringtones/add")
     * @Route("/admin/ringtones/add/")
     * @return type 
     */
    public function admin_addAction(){
        //  Do Init
        $this->_viewData['base_url'] = '/admin/ringtones';
        
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $extraParam = array();
        
        if ( $request->request->get('title') ){
            $data = $request->request->all();
            
            $record = new \Front\YxBundle\Entity\Ringtones();

            $record->setCategory( $data['category'] );
            $record->setTitle( $data['title'] );
            $record->setDescription( $data['description'] );
            $record->setStatus( $data['status'] );
            $record->setType( $data['type'] );
            $record->setPrice( $data['price'] );
            $record->setMyxerTag( $data['myxer_tag'] );
            $record->setStatPc(0);
            $record->setStatPhone(0);
            $record->setPrewRingtone('');
            
            $files = $request->files->all();

            foreach ( $files as $key => $file ){
                if ( $file ){
                    // set path for file uploading in /img/PRODUCT folder
                    $imgpath = WWW_ROOT."tone";
                    @chmod($imgpath, 0777);
                
                    //$delFileName = $imgpath .'/'. $song->getPath();
                    //@unlink($delFileName);
                    
                    $path_info = pathinfo( $file->getClientOriginalName() );
                
                    $filename = time().mt_rand(1,100000).".".$path_info['extension'];

                    //echo $destination = preg_replace('/app$/si', 'web' . $request->request->get('folder'), $this->get('kernel')->getRootDir());;

                    $file->move( $imgpath, $filename);

                    //echo $destination = preg_replace('/app$/si', 'web' . $request->request->get('folder'), $this->get('kernel')->getRootDir());;
                    //die;
                    //$file->move( $imgpath, $filename);
                    
                    switch ( $key ){
                        case 'ringtone':
                            $record->setRingtone($filename);
                            break;
                        case 'prew_ringtone':
                            $record->setPrewRingtone($filename);
                            break;
                    }
                }
            }
            
            $em->persist( $record );
            $em->flush();
            
            $this->get('session')->getFlashBag()->add( 'notice', 'Successfully Added.');
            return $this->redirect('/admin/ringtones');
        }
        
        $ringtoneCat = $em->getRepository('YxBundle:Ringtonecategories')->findAll();
        $this->_viewData['ringtoneCat'] = $ringtoneCat;
        
        return $this->render('YxBundle:Ringtones:admin_add.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/ringtones/edit")
     * @Route("/admin/ringtones/edit/")
     * @Route("/admin/ringtones/edit/{id}")
     * @return type 
     */
    public function admin_editAction( $id = false ){
        //  Do Init
        $this->_viewData['base_url'] = '/admin/ringtones';
        
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $extraParam = array();
        
        if ( ! $id )
            $id = $request->request->get('id');
        
        $records = $em->getRepository('YxBundle:Ringtones')->findById( $id );
        $record = current( $records );

        if ( ! $record ){
            $this->get('session')->getFlashBag()->add( 'notice', 'Record not Found.');
            return $this->redirect('/admin/ringtones');
        }
        $this->_viewData['record'] = $record;
        
        if ( $request->request->get('id') ){
            set_time_limit(0);
        
            $data = $request->request->all();

            $record->setCategory( $data['category'] );
            $record->setTitle( $data['title'] );
            $record->setDescription( $data['description'] );
            $record->setStatus( $data['status'] );
            $record->setType( $data['type'] );
            $record->setPrice( $data['price'] );
            $record->setMyxerTag( $data['myxer_tag'] );
            
            $files = $request->files->all();

            foreach ( $files as $key => $file ){
                if ( $file ){
                    // set path for file uploading in /img/PRODUCT folder
                    $imgpath = WWW_ROOT."tone";
                    @chmod($imgpath, 0777);
                
                    $path_info = pathinfo( $file->getClientOriginalName() );
                
                    $filename = time().mt_rand(1,100000).".".$path_info['extension'];

                    //echo $destination = preg_replace('/app$/si', 'web' . $request->request->get('folder'), $this->get('kernel')->getRootDir());;

                    $file->move( $imgpath, $filename);

                    //echo $destination = preg_replace('/app$/si', 'web' . $request->request->get('folder'), $this->get('kernel')->getRootDir());;
                    //die;
                    //$file->move( $imgpath, $filename);
                    
                    switch ( $key ){
                        case 'ringtone':
                            $delFileName = $imgpath .'/'. $record->getRingtone();
                            @unlink($delFileName);
                    
                            $record->setRingtone($filename);
                            break;
                        case 'prew_ringtone':
                            $delFileName = $imgpath .'/'. $record->getPrewRingtone();
                            @unlink($delFileName);
                            
                            $record->setPrewRingtone($filename);
                            break;
                    }
                }
            }
            
            $em->persist( $record );
            $em->flush();
            
            $this->get('session')->getFlashBag()->add( 'notice', 'Successfully Updated.');
            return $this->redirect('/admin/ringtones');
        }
        
        $ringtoneCat = $em->getRepository('YxBundle:Ringtonecategories')->findAll();
        $this->_viewData['ringtoneCat'] = $ringtoneCat;
        
        return $this->render('YxBundle:Ringtones:admin_edit.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/ringtones")
     * @Route("/admin/ringtones/")
     * @return type 
     */
    public function admin_indexAction( $page = 1 ){
        if (! $this->session_checkadmin() )
            return $this->redirect($this->generateUrl('admin_login'), 302);

        //  Do Init
        $this->_viewData['base_url'] = '/admin/ringtones';
        
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
        
        $order = ' Order By Ringtone.id';
        $limitClause = " Limit $offset, $limit";
        
        if( ! $request->query->get('char') ){
            $addQuery="";
        }else{
            $extraParam['char'] = $request->query->get('char');
            $addQuery=" WHERE Ringtone.title LIKE '".$request->query->get('char')."%'" ;
        }
        
        $sql = "Select Ringtone.* from ringtones as Ringtone 
                " . $addQuery . $order . $limitClause ;
        $records = $this->_conn->fetchAll( $sql );
        $this->_viewData['records'] = $records;
        
        //  Get All item count
        $sql = "Select count(Ringtone.id) as num from ringtones as Ringtone " . $addQuery;
        $items = $this->_conn->fetchAll( $sql );

        $itemsCount = $items[0]['num'];
        
        $paginator = new \Front\YxBundle\Helper\Paginator($itemsCount, $page , $limit, $midrange);
        
        $this->_viewData['paginator'] = $paginator;
        
        $this->_viewData['extraParam'] = $extraParam;

        return $this->render('YxBundle:Ringtones:admin_index.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/delete_ringtone")
     * @Route("/admin/delete_ringtone/")
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
                    $data = $em->getRepository('YxBundle:Ringtones')->find($id);
                    
                    $imgpath = WWW_ROOT."tone";
                    @chmod($imgpath, 0777);

                    $delFileName = $imgpath .'/'. $data->getRingtone();
                    @unlink($delFileName);
                    
                    $delFileName = $imgpath .'/'. $data->getPrewRingtone();
                    @unlink($delFileName);
                    
                    $em->remove($data);
                    $em->flush();
                }
            }
        }
        
        echo 'Record deleted.';
        return new \Symfony\Component\HttpFoundation\Response();
        
    }
}
