<?php

namespace Front\YxBundle\Controller;

use Front\YxBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class GenresController extends BaseController {

    private $_viewData = array(), $data = array(), $_conn;
    
    //  Admin Section 
    
    /**
     * @Route("/admin/add_genre")
     * @Route("/admin/add_genre/")
     * @return type 
     */
    public function admin_addAction(){
        //  Do Init
        $this->_viewData['base_url'] = '/admin/genres';
        
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $extraParam = array();
        
        if ( $request->request->get('gname') ){
            set_time_limit(0);
        
            $genreDetail = new \Front\YxBundle\Entity\Genres();

            if (is_uploaded_file( $_FILES['image']['tmp_name'])){
                set_time_limit(0);
                // set path for file uploading in /img/PRODUCT folder
                $imgpath = WWW_ROOT . "img". '/' ."genres";
                @chmod($imgpath, 0777);

                $filename = time() . '_' . $_FILES['image']["name"];
                $uploadfile = $imgpath .'/'. $filename;
//echo '<pre>' . $filename;     print_r( $_FILES );die;
                if ( !move_uploaded_file( $_FILES['image']['tmp_name'], $uploadfile ) ){
                        $this->get('session')->getFlashBag()->add( 'notice', 'Oops. File is invalid, or, the permissions got bad.');
                        return $this->redirect('/admin/add_genre');
                        
                        exit;
                }

                //	set main song file name
                $genreDetail->setImage( $filename );
            }else{
                $genreDetail->setImage( '' );
            }
            
            $genreDetail->setGname( $request->request->get('gname') );
            $em->persist( $genreDetail );
            $em->flush();
            
            $this->get('session')->getFlashBag()->add( 'notice', 'Successfully Added.');
            return $this->redirect('/admin/genres');
        }
        
        //$genres = $em->getRepository('YxBundle:Genres')->findById( $id );
        //$genreDetail = current($genres);
        
        return $this->render('YxBundle:Genres:admin_add.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/genres/edit")
     * @Route("/admin/genres/edit/")
     * @Route("/admin/genres/edit/{id}")
     * @return type 
     */
    public function admin_editAction( $id = false ){
        //  Do Init
        $this->_viewData['base_url'] = '/admin/genres';
        
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $extraParam = array();
        
        if ( ! $id )
            $id = $_POST['Genre']['id'];
        
        $genres = $em->getRepository('YxBundle:Genres')->findById( $id );
        
        $genreDetail = current($genres);
        
        if ( ! $genreDetail ){
            $this->get('session')->getFlashBag()->add( 'notice', 'Record doesnot exist.');
            return $this->redirect('/admin/genres');
        }
        $this->_viewData['genre'] = $genreDetail;
        
        //echo '<pre>'; print_r( $_FILES ); die;
        
        if( $request->request->get('id')  ){
            if (is_uploaded_file( $_FILES['image']['tmp_name'])){
                set_time_limit(0);
                // set path for file uploading in /img/PRODUCT folder
                $imgpath = WWW_ROOT . "img". '/' ."genres";
                @chmod($imgpath, 0777);

                $delFileName = $imgpath .'/'. $genreDetail->getImage();
                @unlink($delFileName);

                $filename = $_POST['id'] . '_' . $_FILES['image']["name"];
                $uploadfile = $imgpath .'/'. $filename;

                if ( !move_uploaded_file( $_FILES['image']['tmp_name'], $uploadfile ) ){
                        $this->get('session')->getFlashBag()->add( 'notice', 'Oops. File is invalid, or, the permissions got bad.');
                        return $this->redirect('/admin/genres');
                        exit;
                }

                //	set main song file name
                $genreDetail->setImage( $filename );
            }else{
                $genreDetail->setImage( $genreDetail->getImage() );
            }
            
            $genreDetail->setGname( $_POST['gname'] );
            
            $em->persist( $genreDetail );
            $em->flush();
            
            $this->get('session')->getFlashBag()->add( 'notice', 'Successfully Updated.');
            return $this->redirect('/admin/genres');
        }
        
        return $this->render('YxBundle:Genres:admin_edit.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/genres")
     * @Route("/admin/genres/")
     * @return type 
     */
    public function admin_indexAction( $page = 1 ){
        if (! $this->session_checkadmin() )
            return $this->redirect($this->generateUrl('admin_login'), 302);

        //  Do Init
        $this->_viewData['base_url'] = '/admin/genres';
        
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
        
        $order = ' Order By Genre.id';
        $limitClause = " Limit $offset, $limit";
        
        if( ! $request->query->get('char') ){
            $addQuery="";
        }else{
            $extraParam['char'] = $request->query->get('char');
            $addQuery=" WHERE Genre.gname LIKE '".$request->query->get('char')."%'" ;
        }

        $sql = "Select Genre.* from genres as Genre 
                " . $addQuery . $order . $limitClause ;
        $users = $this->_conn->fetchAll( $sql );
        $this->_viewData['genres'] = $users;
        
        
        //  Get All user count
        $sql = "Select count(Genre.id) as num from genres as Genre " . $addQuery;
        $items = $this->_conn->fetchAll( $sql );//$em->getRepository('YxBundle:Users')->findAll();

        $itemsCount = $items[0]['num'];
        
        $paginator = new \Front\YxBundle\Helper\Paginator($itemsCount, $page , $limit, $midrange);
        
        $this->_viewData['paginator'] = $paginator;
        
        $this->_viewData['extraParam'] = $extraParam;
        
        return $this->render('YxBundle:Genres:admin_index.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/delete_genre")
     * @Route("/admin/delete_genre/")
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
                    $data = $em->getRepository('YxBundle:Genres')->find($id);
                    
                    $em->remove($data);
                    $em->flush();
                }
            }
        }
        
        echo 'Successfully deleted.';
        
        return new \Symfony\Component\HttpFoundation\Response();
        
    }

}
