<?php

namespace Front\YxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class YomamaController extends BaseController {
    
    /**
     * @Route("/yomama/")
     * @Route("/yomama/{id}")
     * @Route("/yomama/{id}/")
     * @return type 
     */
    public function yomamaAction( $id = 1 ){
        //  Do Init
        $this->_session = $this->getRequest()->getSession();
        
        $em = $this->getDoctrine()->getEntityManager();
        $category = $em->getRepository('YxBundle:Yomamacategories')->findById( $id );
        
        $this->_viewData['category'] = $category[0]->getCatname();//['title'];
        
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
        
        $this->_viewData['base_url'] = '/yomama/index/' . $id;
        
        $page = $request->query->get('page');
        $page = $page ? $page : 1;
        $limit = 10;
        $midrange = 7;
        $offset = ($page - 1) * $limit;
        
        $limitClause = " Limit $offset, $limit";

        $conditions ="Yomama.category = '".$id."' AND Yomama.status = '1'";
        $order = "Yomama.title ASC ";

        $this->_conn = $this->get('database_connection');
        
        $sql = "SELECT * from yomama as Yomama
                WHERE ". $conditions ."
                ORDER BY ". $order ." " . $limitClause;
        
        $records = $this->_conn->fetchAll( $sql );
        //echo '<pre>'; print_r( $records );die;
        
        //  Get All user count
        $sql = "Select count(Yomama.id) as num from yomama as Yomama WHERE " . $conditions ;
        
        $items = $this->_conn->fetchAll( $sql );

        $itemsCount = $items[0]['num'];
        
        $paginator = new \Front\YxBundle\Helper\Paginator($itemsCount, $page , $limit, $midrange);
        
        $this->_viewData['paginator'] = $paginator;
        
        $this->_viewData['extraParam'] = $extraParam;
        
        $this->_viewData['records'] = $records;
              
        return $this->render('YxBundle:Yomama:yomamalist.html.php', $this->_viewData);
    }
    
    
    //  Admin Section 
    
    /***  Yomama Section */
    /**
     * @Route("/admin/yomama/add")
     * @Route("/admin/yomama/add/")
     * @return type 
     */
    public function admin_yomamaAddAction(){
        //  Do Init
        $this->_viewData['base_url'] = '/admin/yomama';
        
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $records = $em->getRepository('YxBundle:Yomamacategories')->findAll( );
        $this->_viewData['category'] = $records;
        
        $extraParam = array();
        
        if ( $request->request->get('title') ){

            $data = $request->request->all();
            
            $record = new \Front\YxBundle\Entity\Yomama();

            $record->setCategory( $data['category'] );
            $record->setTitle( $data['title'] );
            $record->setDescription( $data['description'] );
            $record->setStatus( $data['status'] );
            $record->setYear( $data['year'] );
            $record->setDuration( $data['duration'] );
            $record->setRate( $data['rate'] );
            $record->setType( $data['type'] );
            $record->setPaid( $data['paid'] );
            $record->setMyxerTag( $data['myxer_tag'] );
            $record->setTag( $data['tag'] );
            
            if (is_uploaded_file( $_FILES['yomama_file']['tmp_name'])){
                set_time_limit(0);
                // set path for file uploading in /img/PRODUCT folder
                $imgpath = WWW_ROOT . "img". '/' ."yomama/file";
                @chmod($imgpath, 0777);
                
                $filename = time() . '_' . $_FILES['yomama_file']["name"];
                $uploadfile = $imgpath .'/'. $filename;

                if ( !move_uploaded_file( $_FILES['yomama_file']['tmp_name'], $uploadfile ) ){
                        $this->get('session')->getFlashBag()->add( 'notice', 'Oops. File is invalid, or, the permissions got bad.');
                        return $this->redirect('/admin/yomama/add');
                        
                        exit;
                }

                //	set main song file name
                $record->setYomamaFile( $filename );
            }else{
                $record->setYomamaFile( '' );
            }
                        
            $em->persist( $record );
            $em->flush();
            
            $this->get('session')->getFlashBag()->add( 'notice', 'Successfully Added.');
            return $this->redirect('/admin/yomama');
        }
        
        return $this->render('YxBundle:Yomama:admin_yomama_add.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/yomama/edit")
     * @Route("/admin/yomama/edit/")
     * @Route("/admin/yomama/edit/{id}")
     * @return type 
     */
    public function admin_yomamaEditAction( $id = false ){
        //  Do Init
        $this->_viewData['base_url'] = '/admin/yomama';
        
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $records = $em->getRepository('YxBundle:Yomamacategories')->findAll( );
        $this->_viewData['category'] = $records;
        
        $extraParam = array();
        
        if ( ! $id )
            $id = $request->request->get('id');
        
        $records = $em->getRepository('YxBundle:Yomama')->findById( $id );
        $record = current( $records );

        if ( ! $record ){
            $this->get('session')->getFlashBag()->add( 'notice', 'Record not Found.');
            return $this->redirect('/admin/yomama');
        }
        $this->_viewData['record'] = $record;
        
        if ( $request->request->get('id') ){
            set_time_limit(0);
        
            $data = $request->request->all();

            $record->setCategory( $data['category'] );
            $record->setTitle( $data['title'] );
            $record->setDescription( $data['description'] );
            $record->setStatus( $data['status'] );
            $record->setYear( $data['year'] );
            $record->setDuration( $data['duration'] );
            $record->setRate( $data['rate'] );
            $record->setType( $data['type'] );
            $record->setPaid( $data['paid'] );
            $record->setMyxerTag( $data['myxer_tag'] );
            $record->setTag( $data['tag'] );
            
            if (is_uploaded_file( $_FILES['yomama_file']['tmp_name'])){
                set_time_limit(0);
                // set path for file uploading in /img/PRODUCT folder
                $imgpath = WWW_ROOT . "img". '/' ."yomama/file";
                @chmod($imgpath, 0777);

                $delFileName = $imgpath .'/'. $record->getYomamaFile();
                @unlink($delFileName);

                $filename = $_POST['id'] . '_' . $_FILES['yomama_file']["name"];
                $uploadfile = $imgpath .'/'. $filename;

                if ( !move_uploaded_file( $_FILES['yomama_file']['tmp_name'], $uploadfile ) ){
                        $this->get('session')->getFlashBag()->add( 'notice', 'Oops. File is invalid, or, the permissions got bad.');
                        return $this->redirect('/admin/yomama');
                        exit;
                }

                //	set main song file name
                $record->setYomamaFile( $filename );
            }else{
                $record->setYomamaFile( $record->getYomamaFile() );
            }
            
            $em->persist( $record );
            $em->flush();
            
            $this->get('session')->getFlashBag()->add( 'notice', 'Successfully Updated.');
            return $this->redirect('/admin/yomama');
        }
        
        return $this->render('YxBundle:Yomama:admin_yomama_edit.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/yomama")
     * @Route("/admin/yomama/")
     * @return type 
     */
    public function admin_yomamaAction( $page = 1 ){
        if (! $this->session_checkadmin() )
            return $this->redirect($this->generateUrl('admin_login'), 302);

        //  Do Init
        $this->_viewData['base_url'] = '/admin/yomama';
        
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
        
        $order = ' Order By Yomama.id';
        $limitClause = " Limit $offset, $limit";
        
        if( ! $request->query->get('char') ){
            $addQuery="";
        }else{
            $extraParam['char'] = $request->query->get('char');
            $addQuery=" WHERE Yomama.title LIKE '".$request->query->get('char')."%'" ;
        }
        
        $sql = "Select Yomama.* from yomama as Yomama 
                " . $addQuery . $order . $limitClause ;
        $records = $this->_conn->fetchAll( $sql );
        $this->_viewData['records'] = $records;
        
        //  Get All item count
        $sql = "Select count(Yomama.id) as num from yomama as Yomama " . $addQuery;
        $items = $this->_conn->fetchAll( $sql );

        $itemsCount = $items[0]['num'];
        
        $paginator = new \Front\YxBundle\Helper\Paginator($itemsCount, $page , $limit, $midrange);
        
        $this->_viewData['paginator'] = $paginator;
        
        $this->_viewData['extraParam'] = $extraParam;

        return $this->render('YxBundle:Yomama:admin_yomama.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/delete_yomama")
     * @Route("/admin/delete_yomama/")
     * @return type 
     */
    public function admin_yomamaDeleteAction(){
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
                    $data = $em->getRepository('YxBundle:Yomama')->find($id);
                    
                    $imgpath = WWW_ROOT."img/yomama/file";
                    @chmod($imgpath, 0777);
                    
                    $delFileName = $imgpath .'/'. $data->getYomamaFile();
                    @unlink($delFileName);
                    
                    $em->remove($data);
                    $em->flush();
                }
            }
        }
        
        echo 'Record deleted.';
        return new \Symfony\Component\HttpFoundation\Response();
        
    }
    
    
    /***  Yomama Section */
    
    
    
    /***  Yomama Category Section */
    /**
     * @Route("/admin/yomamacategories/add")
     * @Route("/admin/yomamacategories/add/")
     * @return type 
     */
    public function admin_addAction(){
        //  Do Init
        $this->_viewData['base_url'] = '/admin/yomamacategories';
        
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $extraParam = array();
        
        if ( $request->request->get('catname') ){

            $data = $request->request->all();
            
            $record = new \Front\YxBundle\Entity\Yomamacategories();

            $record->setCatname( $data['catname'] );
            
            if (is_uploaded_file( $_FILES['image']['tmp_name'])){
                set_time_limit(0);
                // set path for file uploading in /img/PRODUCT folder
                $imgpath = WWW_ROOT . "img". '/' ."yomama";
                @chmod($imgpath, 0777);

                $filename = time() . '_' . $_FILES['image']["name"];
                $uploadfile = $imgpath .'/'. $filename;

                if ( !move_uploaded_file( $_FILES['image']['tmp_name'], $uploadfile ) ){
                        $this->get('session')->getFlashBag()->add( 'notice', 'Oops. File is invalid, or, the permissions got bad.');
                        return $this->redirect('/admin/yomamacategories/add');
                        
                        exit;
                }

                //	set main song file name
                $record->setImage( $filename );
            }else{
                $record->setImage( '' );
            }
                        
            $em->persist( $record );
            $em->flush();
            
            $this->get('session')->getFlashBag()->add( 'notice', 'Successfully Added.');
            return $this->redirect('/admin/yomamacategories');
        }
        
        return $this->render('YxBundle:Yomama:admin_add.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/yomamacategories/edit")
     * @Route("/admin/yomamacategories/edit/")
     * @Route("/admin/yomamacategories/edit/{id}")
     * @return type 
     */
    public function admin_editAction( $id = false ){
        //  Do Init
        $this->_viewData['base_url'] = '/admin/yomamacategories';
        
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $extraParam = array();
        
        if ( ! $id )
            $id = $request->request->get('id');
        
        $records = $em->getRepository('YxBundle:Yomamacategories')->findById( $id );
        $record = current( $records );

        if ( ! $record ){
            $this->get('session')->getFlashBag()->add( 'notice', 'Record not Found.');
            return $this->redirect('/admin/yomamacategories');
        }
        $this->_viewData['record'] = $record;
        
        if ( $request->request->get('id') ){
            set_time_limit(0);
        
            $data = $request->request->all();

            $record->setCatname( $data['catname'] );
            
            if (is_uploaded_file( $_FILES['image']['tmp_name'])){
                set_time_limit(0);
                // set path for file uploading in /img/PRODUCT folder
                $imgpath = WWW_ROOT . "img". '/' ."yomama";
                @chmod($imgpath, 0777);

                $delFileName = $imgpath .'/'. $record->getImage();
                @unlink($delFileName);

                $filename = $_POST['id'] . '_' . $_FILES['image']["name"];
                $uploadfile = $imgpath .'/'. $filename;

                if ( !move_uploaded_file( $_FILES['image']['tmp_name'], $uploadfile ) ){
                        $this->get('session')->getFlashBag()->add( 'notice', 'Oops. File is invalid, or, the permissions got bad.');
                        return $this->redirect('/admin/yomamacategories');
                        exit;
                }

                //	set main song file name
                $record->setImage( $filename );
            }else{
                $record->setImage( $record->getImage() );
            }
            
            $em->persist( $record );
            $em->flush();
            
            $this->get('session')->getFlashBag()->add( 'notice', 'Successfully Updated.');
            return $this->redirect('/admin/yomamacategories');
        }
        
        return $this->render('YxBundle:Yomama:admin_edit.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/yomamacategories")
     * @Route("/admin/yomamacategories/")
     * @return type 
     */
    public function admin_indexAction( $page = 1 ){
        if (! $this->session_checkadmin() )
            return $this->redirect($this->generateUrl('admin_login'), 302);

        //  Do Init
        $this->_viewData['base_url'] = '/admin/yomamacategories';
        
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
        
        $order = ' Order By Yomamacategories.id';
        $limitClause = " Limit $offset, $limit";
        
        if( ! $request->query->get('char') ){
            $addQuery="";
        }else{
            $extraParam['char'] = $request->query->get('char');
            $addQuery=" WHERE Yomamacategories.catname LIKE '".$request->query->get('char')."%'" ;
        }
        
        $sql = "Select Yomamacategories.* from yomamacategories as Yomamacategories 
                " . $addQuery . $order . $limitClause ;
        $records = $this->_conn->fetchAll( $sql );
        $this->_viewData['records'] = $records;
        
        //  Get All item count
        $sql = "Select count(Yomamacategories.id) as num from yomamacategories as Yomamacategories " . $addQuery;
        $items = $this->_conn->fetchAll( $sql );

        $itemsCount = $items[0]['num'];
        
        $paginator = new \Front\YxBundle\Helper\Paginator($itemsCount, $page , $limit, $midrange);
        
        $this->_viewData['paginator'] = $paginator;
        
        $this->_viewData['extraParam'] = $extraParam;

        return $this->render('YxBundle:Yomama:admin_index.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/delete_yomamacategory")
     * @Route("/admin/delete_yomamacategory/")
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
                    $data = $em->getRepository('YxBundle:Yomamacategories')->find($id);
                    
                    $imgpath = WWW_ROOT."img/yomama";
                    @chmod($imgpath, 0777);
                    
                    $delFileName = $imgpath .'/'. $data->getImage();
                    @unlink($delFileName);
                    
                    $em->remove($data);
                    $em->flush();
                }
            }
        }
        
        echo 'Record deleted.';
        return new \Symfony\Component\HttpFoundation\Response();
        
    }
    
    /***  Yomama Category Section */
}
