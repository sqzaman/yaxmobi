<?php

namespace Front\YxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class VideosController extends BaseController {
    
    //  Admin Section 
    
    /**
     * @Route("/admin/videos/add")
     * @Route("/admin/videos/add/")
     * @return type 
     */
    public function admin_addAction(){
        //  Do Init
        $this->_viewData['base_url'] = '/admin/videos';
        
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $extraParam = array();
        
        if ( $request->request->get('title') ){
            $data = $request->request->all();
            
            $record = new \Front\YxBundle\Entity\Videos();

            //echo '<pre>'; print_r( $record );die;
            
            $record->setTitle( $data['title'] );
            $record->setDescription( $data['description'] );
            $record->setView(0);
            
            $files = $request->files->all();

            foreach ( $files as $key => $file ){
                if ( $file ){
                    // set path for file uploading in /img/PRODUCT folder
                    $imgpath = WWW_ROOT."img/video/image";
                    @chmod($imgpath, 0777);
                
                    $path_info = pathinfo( $file->getClientOriginalName() );
                
                    $filename = time().mt_rand(1,100000).".".$path_info['extension'];

                    //echo $destination = preg_replace('/app$/si', 'web' . $request->request->get('folder'), $this->get('kernel')->getRootDir());;

                    $file->move( $imgpath, $filename);

                    //echo $destination = preg_replace('/app$/si', 'web' . $request->request->get('folder'), $this->get('kernel')->getRootDir());;
                    //die;
                    //$file->move( $imgpath, $filename);
                    
                    switch ( $key ){
                        case 'image':
                            $record->setImage($filename);
                            break;
                        case 'video_file':
                            $record->setVideoFile($filename);
                            break;
                    }
                }
            }
            
            $em->persist( $record );
            $em->flush();
            
            $this->get('session')->getFlashBag()->add( 'notice', 'Successfully Added.');
            return $this->redirect('/admin/videos');
        }
        
        return $this->render('YxBundle:Videos:admin_add.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/videos/edit")
     * @Route("/admin/videos/edit/")
     * @Route("/admin/videos/edit/{id}")
     * @return type 
     */
    public function admin_editAction( $id = false ){
        //  Do Init
        $this->_viewData['base_url'] = '/admin/videos';
        
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $extraParam = array();
        
        if ( ! $id )
            $id = $request->request->get('id');
        
        $records = $em->getRepository('YxBundle:Videos')->findById( $id );
        $record = current( $records );

        if ( ! $record ){
            $this->get('session')->getFlashBag()->add( 'notice', 'Record not Found.');
            return $this->redirect('/admin/videos');
        }
        $this->_viewData['record'] = $record;
        
        if ( $request->request->get('id') ){
            set_time_limit(0);
        
            $data = $request->request->all();

            $record->setTitle( $data['title'] );
            $record->setDescription( $data['description'] );
            
            $files = $request->files->all();

            foreach ( $files as $key => $file ){
                if ( $file ){
                    // set path for file uploading in /img/PRODUCT folder
                    $imgpath = WWW_ROOT."img/video/image";
                    @chmod($imgpath, 0777);
                
                    $path_info = pathinfo( $file->getClientOriginalName() );
                
                    $filename = time().mt_rand(1,100000).".".$path_info['extension'];

                    $file->move( $imgpath, $filename);

                    //echo $destination = preg_replace('/app$/si', 'web' . $request->request->get('folder'), $this->get('kernel')->getRootDir());;
                    //die;
                    //$file->move( $imgpath, $filename);
                    
                    switch ( $key ){
                        case 'image':
                            $delFileName = $imgpath .'/'. $record->getImage();
                            @unlink($delFileName);
                            
                            $record->setImage($filename);
                            break;
                        case 'video_file':
                            $delFileName = $imgpath .'/'. $record->getVideoFile();
                            @unlink($delFileName);
                            
                            $record->setVideoFile($filename);
                            break;
                    }
                }
            }
            
            $em->persist( $record );
            $em->flush();
            
            $this->get('session')->getFlashBag()->add( 'notice', 'Successfully Updated.');
            return $this->redirect('/admin/videos');
        }
        
        return $this->render('YxBundle:Videos:admin_edit.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/videos")
     * @Route("/admin/videos/")
     * @return type 
     */
    public function admin_indexAction( $page = 1 ){
        if (! $this->session_checkadmin() )
            return $this->redirect($this->generateUrl('admin_login'), 302);

        //  Do Init
        $this->_viewData['base_url'] = '/admin/videos';
        
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
        
        $order = ' Order By Video.id';
        $limitClause = " Limit $offset, $limit";
        
        if( ! $request->query->get('char') ){
            $addQuery="";
        }else{
            $extraParam['char'] = $request->query->get('char');
            $addQuery=" WHERE Video.title LIKE '".$request->query->get('char')."%'" ;
        }
        
        $sql = "Select Video.* from videos as Video 
                " . $addQuery . $order . $limitClause ;
        $records = $this->_conn->fetchAll( $sql );
        $this->_viewData['records'] = $records;
        
        //  Get All item count
        $sql = "Select count(Video.id) as num from videos as Video " . $addQuery;
        $items = $this->_conn->fetchAll( $sql );

        $itemsCount = $items[0]['num'];
        
        $paginator = new \Front\YxBundle\Helper\Paginator($itemsCount, $page , $limit, $midrange);
        
        $this->_viewData['paginator'] = $paginator;
        
        $this->_viewData['extraParam'] = $extraParam;

        return $this->render('YxBundle:Videos:admin_index.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/delete_video")
     * @Route("/admin/delete_video/")
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
                    $data = $em->getRepository('YxBundle:Videos')->find($id);
                    
                    $imgpath = WWW_ROOT."img/video/image";
                    @chmod($imgpath, 0777);
                    
                    $delFileName = $imgpath .'/'. $data->getImage();
                    @unlink($delFileName);
                            
                    $delFileName = $imgpath .'/'. $data->getVideoFile();
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
