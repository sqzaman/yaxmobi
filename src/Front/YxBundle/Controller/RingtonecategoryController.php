<?php

namespace Front\YxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class RingtonecategoryController extends BaseController {
    /**
     * @Route("/ringtonecategory")
     * @Route("/ringtonecategory/")
     * @Route("/ringtonecategory/index")
     * @Route("/ringtonecategory/index/")
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
        
        $conditions = "Ringtonecategory.status='1'";
        $order = "Ringtonecategory.date ASC ";

        $conn = $this->get('database_connection');
        $sql = "SELECT * from ringtonecategories as Ringtonecategory
                WHERE ". $conditions ."
                ORDER BY ". $order ."    
                ";
        
        $ringtoneCategory = $conn->fetchAll( $sql );
        $this->_viewData['ringtoneCategory'] = $ringtoneCategory;
        
        $conditions ="Ringtone.status = '1' and (Ringtone.type = 0 or Ringtone.type = '')";
        $sql = "SELECT * from ringtones as Ringtone
                WHERE ". $conditions ."
                LIMIT 6
                ";
        
        $ringtone = $conn->fetchAll( $sql );
        
        foreach($ringtone as $k => $v){
            $jokeId = $v['id'];
            $this->get_song_rating($jokeId);
        }
//echo '<pre>'; print_r( $this->songRating );die;
        $this->_viewData['songRating'] = $this->songRating;

        $this->_viewData['ringtones'] = $ringtone;
        
        return $this->render('YxBundle:Ringtonecategory:index.html.php', $this->_viewData);
    }
    
    //  Admin Section 
    
    /**
     * @Route("/admin/ringtonecategory/add")
     * @Route("/admin/ringtonecategory/add/")
     * @return type 
     */
    public function admin_addAction(){
        //  Do Init
        $this->_viewData['base_url'] = '/admin/ringtonecategory';
        
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $extraParam = array();
        
        if ( $request->request->get('title') ){
            $data = $request->request->all();
            //echo '<pre>'; print_r( $data );die;
            $record = new \Front\YxBundle\Entity\Ringtonecategories();

            $record->setTitle( $data['title'] );
            $record->setStatus( $data['status'] );
            
            $file = $request->files->get('image');
            
            if ( $file ){
                // set path for file uploading in /img/PRODUCT folder
                $imgpath = WWW_ROOT."img/ringtonecategory";
                @chmod($imgpath, 0777);

                $path_info = pathinfo( $file->getClientOriginalName() );
                
                $filename = time().mt_rand(1,100000).".".$path_info['extension'];
                
                //echo $destination = preg_replace('/app$/si', 'web' . $request->request->get('folder'), $this->get('kernel')->getRootDir());;

                $file->move( $imgpath, $filename);
                
                $record->setImage($filename);
            }
            
            $em->persist( $record );
            $em->flush();
            
            $this->get('session')->getFlashBag()->add( 'notice', 'Successfully Added.');
            return $this->redirect('/admin/ringtonecategory');
        }
        
        //$genres = $em->getRepository('YxBundle:Genres')->findById( $id );
        //$genreDetail = current($genres);
        
        return $this->render('YxBundle:Ringtonecategory:admin_add.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/ringtonecategory/edit")
     * @Route("/admin/ringtonecategory/edit/")
     * @Route("/admin/ringtonecategory/edit/{id}")
     * @return type 
     */
    public function admin_editAction( $id = false ){
        //  Do Init
        $this->_viewData['base_url'] = '/admin/ringtonecategory';
        
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $extraParam = array();
        
        if ( ! $id )
            $id = $request->request->get('id');
        
        $records = $em->getRepository('YxBundle:Ringtonecategories')->findById( $id );
        $record = current( $records );
        
        if ( ! $record ){
            $this->get('session')->getFlashBag()->add( 'notice', 'Record not Found.');
            return $this->redirect('/admin/ringtonecategory');
        }
        $this->_viewData['record'] = $record;
        
        if ( $request->request->get('id') ){
            set_time_limit(0);
        
            $data = $request->request->all();

            $record->setTitle( $data['title'] );
            $record->setStatus( $data['status'] );
            
            $file = $request->files->get('image');
            if ( $file ){
                // set path for file uploading in /img/PRODUCT folder
                $imgpath = WWW_ROOT."img/ringtonecategory";
                @chmod($imgpath, 0777);
                
                $delFileName = $imgpath .'/'. $record->getImage();
                @unlink($delFileName);

                $path_info = pathinfo( $file->getClientOriginalName() );
                
                $filename = time().mt_rand(1,100000).".".$path_info['extension'];
                
                //echo $destination = preg_replace('/app$/si', 'web' . $request->request->get('folder'), $this->get('kernel')->getRootDir());;

                $file->move( $imgpath, $filename);
                
                $record->setImage($filename);
            }
            
            
            $em->persist( $record );
            $em->flush();
            
            $this->get('session')->getFlashBag()->add( 'notice', 'Successfully Updated.');
            return $this->redirect('/admin/ringtonecategory');
        }
        
        return $this->render('YxBundle:Ringtonecategory:admin_edit.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/ringtonecategory")
     * @Route("/admin/ringtonecategory/")
     * @return type 
     */
    public function admin_indexAction( $page = 1 ){
        if (! $this->session_checkadmin() )
            return $this->redirect($this->generateUrl('admin_login'), 302);

        //  Do Init
        $this->_viewData['base_url'] = '/admin/ringtonecategory';
        
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
        
        $order = ' Order By Ringtonecategory.id';
        $limitClause = " Limit $offset, $limit";
        
        $addQuery="";
        
        $sql = "Select Ringtonecategory.* from ringtonecategories as Ringtonecategory 
                " . $addQuery . $order . $limitClause ;
        $records = $this->_conn->fetchAll( $sql );
        $this->_viewData['records'] = $records;
        
        //echo '<pre>'; print_r( $records );die;
        
        //  Get All item count
        $sql = "Select count(Ringtonecategory.id) as num from ringtonecategories as Ringtonecategory " . $addQuery;
        $items = $this->_conn->fetchAll( $sql );

        $itemsCount = $items[0]['num'];
        
        $paginator = new \Front\YxBundle\Helper\Paginator($itemsCount, $page , $limit, $midrange);
        
        $this->_viewData['paginator'] = $paginator;
        
        $this->_viewData['extraParam'] = $extraParam;

        return $this->render('YxBundle:Ringtonecategory:admin_index.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/delete_ringtonecategory")
     * @Route("/admin/delete_ringtonecategory/")
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
                    $data = $em->getRepository('YxBundle:Ringtonecategories')->find($id);
                    
                    $imgpath = WWW_ROOT."img/ringtonecategory";
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
}
