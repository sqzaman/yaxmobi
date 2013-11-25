<?php

namespace Front\YxBundle\Controller;

use Front\YxBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Front\YxBundle\Helper\PS_Pagination;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class AlbumsController extends BaseController {

    private $_viewData = array(), $data = array(), $_conn;
    
    //  Admin Section 
    
    /**
     * @Route("/admin/albums/add")
     * @Route("/admin/albums/add/")
     * @return type 
     */
    public function admin_addAction(){
        //  Do Init
        $this->_viewData['base_url'] = '/admin/albums';
        
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $extraParam = array();
        
        
        if ( $request->request->get('aname') ){
            set_time_limit(0);
        
            $data = $request->request->all();
            
            $files = $request->files->all();
            
            //echo '<pre>'; print_r( $files );die;
            
            $album = new \Front\YxBundle\Entity\Albums();

            $album->setAname( $data['aname'] );
            $album->setDescription( $data['description'] );
            $album->setPrice( $data['price'] );

            $file = $request->files->get('image');
            if ( $file ){
                // set path for file uploading in /img/PRODUCT folder
                $imgpath = WWW_ROOT."img/album";
                @chmod($imgpath, 0777);

                $path_info = pathinfo( $file->getClientOriginalName() );
                
                $filename = time().mt_rand(1,100000).".".$path_info['extension'];
                
                //echo $destination = preg_replace('/app$/si', 'web' . $request->request->get('folder'), $this->get('kernel')->getRootDir());;

                $file->move( $imgpath, $filename);
                
                $album->setImage($filename);
            }
            
            $em->persist( $album );
            $em->flush();
            
            $this->get('session')->getFlashBag()->add( 'notice', 'Successfully Added.');
            return $this->redirect('/admin/albums');
        }
        
        //$genres = $em->getRepository('YxBundle:Genres')->findById( $id );
        //$genreDetail = current($genres);
        
        return $this->render('YxBundle:Albums:admin_add.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/albums/edit")
     * @Route("/admin/albums/edit/")
     * @Route("/admin/albums/edit/{id}")
     * @return type 
     */
    public function admin_editAction( $id = false ){
        //  Do Init
        $this->_viewData['base_url'] = '/admin/albums';
        
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $extraParam = array();
        
        if ( ! $id )
            $id = $request->request->get('id');
        
        $albums = $em->getRepository('YxBundle:Albums')->findById( $id );
        
        $album = current( $albums );
        
        if ( ! $album ){
            $this->get('session')->getFlashBag()->add( 'notice', 'Record not Found.');
            return $this->redirect('/admin/albums');
        }
        $this->_viewData['album'] = $album;
        
        if ( $request->request->get('id') ){
            set_time_limit(0);
        
            $data = $request->request->all();
            
            $files = $request->files->all();
            
            $album->setAname( $data['aname'] );
            $album->setDescription( $data['description'] );
            $album->setPrice( $data['price'] );

            $file = $request->files->get('image');
            if ( $file ){
                // set path for file uploading in /img/PRODUCT folder
                $imgpath = WWW_ROOT."img/album";
                @chmod($imgpath, 0777);
                
                $delFileName = $imgpath .'/'. $album->getImage();
                @unlink($delFileName);

                $path_info = pathinfo( $file->getClientOriginalName() );
                
                $filename = time().mt_rand(1,100000).".".$path_info['extension'];
                
                //echo $destination = preg_replace('/app$/si', 'web' . $request->request->get('folder'), $this->get('kernel')->getRootDir());;

                $file->move( $imgpath, $filename);
                
                $album->setImage($filename);
            }
            
            $em->persist( $album );
            $em->flush();
            
            $this->get('session')->getFlashBag()->add( 'notice', 'Successfully Updated.');
            return $this->redirect('/admin/albums');
        }
        
        return $this->render('YxBundle:Albums:admin_edit.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/albums")
     * @Route("/admin/albums/")
     * @return type 
     */
    public function admin_indexAction( $page = 1 ){
        if (! $this->session_checkadmin() )
            return $this->redirect($this->generateUrl('admin_login'), 302);

        //  Do Init
        $this->_viewData['base_url'] = '/admin/albums';
        
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
        
        $order = ' Order By Album.id';
        $limitClause = " Limit $offset, $limit";
        
        if( ! $request->query->get('char') ){
            $addQuery="";
        }else{
            $extraParam['char'] = $request->query->get('char');
            $addQuery=" WHERE Album.aname LIKE '".$request->query->get('char')."%'" ;
        }

        $sql = "Select Album.* from albums as Album 
                " . $addQuery . $order . $limitClause ;
        $users = $this->_conn->fetchAll( $sql );
        $this->_viewData['albums'] = $users;
        
        
        //  Get All user count
        $sql = "Select count(Album.id) as num from albums as Album " . $addQuery;
        $items = $this->_conn->fetchAll( $sql );//$em->getRepository('YxBundle:Users')->findAll();

        $itemsCount = $items[0]['num'];
        
        $paginator = new \Front\YxBundle\Helper\Paginator($itemsCount, $page , $limit, $midrange);
        
        $this->_viewData['paginator'] = $paginator;
        
        $this->_viewData['extraParam'] = $extraParam;

        return $this->render('YxBundle:Albums:admin_index.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/delete_album")
     * @Route("/admin/delete_album/")
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
                    $data = $em->getRepository('YxBundle:Albums')->find($id);
                    
                    $imgpath = WWW_ROOT."img/album";
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
    
        
       public function listingAction(Request $request){

       $this->_conn = $this->get('database_connection');
       $data= $request->query->get('genre');
       
       $q= "SELECT category from catmemory WHERE id=1 ";
       $cat = $this->_conn->fetchColumn($q);
      
 
       if($cat == 'long_jokes' || $cat=='yo_mama' || $cat== 'videos' || $cat== 'cartoons' ){
        $sql = "select Song.*,Genre.gname from `songs` AS `Song` 
       INNER JOIN `genres` AS `Genre` ON Song.genre_id = Genre.id WHERE Genre.id = '".$data."'";
        $query = "select Genre.gname from `genres` AS `Genre` WHERE Genre.id = '".$data."'"; 
       if($cat=='yo_mama'){
       $query = "select Genre.catname from `yomamacategories` AS `Genre` WHERE Genre.id = '".$data."'";    
       }
       if($cat=='videos'){
       $query = "select Genre.title from `videos` AS `Genre` WHERE Genre.id = '".$data."'";    
       }
       if($cat=='cartoons'){
       $query = "select Genre.title from `cartoons` AS `Genre` WHERE Genre.id = '".$data."'";    
       }
       
       
       }elseif($cat == 'short_jokes'){
        $sql = "select Song.* from `ringtones` AS `Song` 
       INNER JOIN `ringtonecategories` AS `Genre` ON Song.category = Genre.id WHERE Genre.id = '".$data."'";
        $query = "select Genre.title from `ringtonecategories` AS `Genre` WHERE Genre.id = '".$data."'";
       } else{
         $sql = "select Song.*,Genre.gname from `songs` AS `Song` 
       INNER JOIN `genres` AS `Genre` ON Song.genre_id = Genre.id WHERE Genre.id = '".$data."'";   
       $query = "select Genre.gname from `genres` AS `Genre` WHERE Genre.id = '".$data."'";
       }
       
  
        $subcat = $this->_conn->fetchColumn($query);
        $pendingSongs = $this->_conn->fetchAll($sql);
        
        

        

      
        $this->_conn->query("update catmemory set subcat = '".$subcat."' where id=1"); 
        $this->_conn->query("update catmemory set genre = '".$data."' where id=1");
  
        $pager = new \Front\YxBundle\Helper\pagination( $this->_conn, $sql, 12, 3, null,$data);

        //our pagination class will render new
        //recordset (search results now are limited
        //for pagination)
        
        $rs = $pager->paginate(); 
  

    
        $num = count($rs);
  
        
        
        return $this->render('YxBundle:Box:listing.html.php', array(
                'pendingSongs'=> $pendingSongs,  
                'num' => $num,
                'rs'  => $rs,
                'pager'=> $pager,
                'data' => $data,
                'subcat'=> $subcat,
                'cat'=> $cat,
             ));
    }

   public function checkingcategoryAction(Request $request){

       $this->_conn = $this->get('database_connection');
       $data= $request->query->get('c');
       
       $q= "select Category.category, Category.genre from `catmemory` AS `Category`  WHERE id=1 ";
       $category = $this->_conn->fetchArray($q);

        $cat = $category['0'];
        $subcat = $category['1'];    
 
     
     
       if($cat == 'long_jokes' || $cat=='yomama' || $cat== 'videos' || $cat== 'cartoons' ){
        $sql = "select Song.* from `songs` AS `Song` WHERE Song.id = '".$data."' AND Song.genre_id = '".$subcat."'";  
       }
       
       if($cat == 'short_jokes'){
       $sql = "select Song.* from `ringtones` AS `Song` WHERE Song.id = '".$data."' AND Song.category = '".$subcat."'";  
       } 
 
        
        $pendingSongs = $this->_conn->fetchAll($sql);
        
        if ($pendingSongs){
            echo 'true';
        }  else {
            echo 'false';
        }
        
        return $this->render('YxBundle:Box:checkingcategory.html.php', array(
         
             ));
    }

}