<?php

namespace Front\YxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class JokesController extends BaseController {
    /**
     * @Route("/jokes/all_joke_category")
     * @Route("/jokes/all_joke_category/")
     */
    public function alljokecategoryAction(){
        $this->_session = $this->getRequest()->getSession();
        $user_id = $this->_session->get('Users.userid');
        $this->_viewData['user_id'] = $user_id;
        
        $displayName = $this->_session->get('Users.name');
        $this->_viewData['displayName'] = $displayName;
        
        if($user_id == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        $em = $this->get('doctrine')->getEntityManager();
        $jokes = $em->getRepository('YxBundle:Jokecategories')->findAll();
        
        $this->_viewData['jokes'] = $jokes;
        $this->_viewData['pageHeading'] = 'Written Jokes Categories';
        
        
        return $this->render('YxBundle:Jokes:all_joke_category.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/jokes/jokes")
     * @Route("/jokes/jokes/")
     * @Route("/jokes/jokes/{chr}")
     */
    public function jokesAction( $chr = null ){
        $this->_session = $this->getRequest()->getSession();
        $user_id = $this->_session->get('Users.userid');
        $this->_viewData['user_id'] = $user_id;
        
        $displayName = $this->_session->get('Users.name');
        $this->_viewData['displayName'] = $displayName;
        
        if($user_id == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        $em = $this->get('doctrine')->getEntityManager();
        
        $jokes = $em->getRepository('YxBundle:Jokes')->findByJokecategory_id( $chr );
        
        foreach($jokes as $k => $v){
                $jokeId = $v->getId();
                $this->get_song_rating($jokeId, 2);
        }
        
        //echo '<pre>'; print_r( $this->songRating );
        
        $this->_viewData['songRating'] = $this->songRating;
        $this->_viewData['joke'] = $jokes;

        $jokeCat = $em->getRepository('YxBundle:Jokecategories')->findById( $chr );
        //echo '<pre>'; print_r( $jokeCat );die;
        //pr($jokeCat);
        
        $this->_viewData['pageHeading'] = 'Written Jokes - ' . $jokeCat[0]->getCatname();
        
        
        return $this->render('YxBundle:Jokes:jokes.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/jokes")
     * @Route("/admin/jokes/")
     */
    public function admin_indexAction(){
        if (! $this->session_checkadmin() )
            return $this->redirect($this->generateUrl('admin_login'), 302);
        
        //  Do Init
        $this->_viewData['base_url'] = '/admin/jokes';
        
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
        
        $order = ' Order By Joke.id';
        $limitClause = " Limit $offset, $limit";
        
        if( ! $request->query->get('char') ){
            $addQuery="";
        }else{
            $extraParam['char'] = $request->query->get('char');
            $addQuery=" WHERE Joke.title LIKE '".$request->query->get('char')."%'" ;
        }
        
        $sql = "Select Joke.*, jokecategories.catname  from jokes as Joke 
                LEFT JOIN jokecategories ON Joke.jokecategory_id = jokecategories.id
                " . $addQuery . $order . $limitClause ;
        
        $records = $this->_conn->fetchAll( $sql );
        $this->_viewData['records'] = $records;
        
        //  Get All item count
        $sql = "Select count(Joke.id) as num from jokes as Joke " . $addQuery;
        $items = $this->_conn->fetchAll( $sql );

        $itemsCount = $items[0]['num'];
        
        $paginator = new \Front\YxBundle\Helper\Paginator($itemsCount, $page , $limit, $midrange);
        
        $this->_viewData['paginator'] = $paginator;
        
        $this->_viewData['extraParam'] = $extraParam;

        return $this->render('YxBundle:Jokes:admin_index.html.php', $this->_viewData);
    }
    
    
    /**
     * @Route("/admin/jokes/add")
     * @Route("/admin/jokes/add/")
     * @return type 
     */
    public function admin_addAction(){
        //  Do Init
        $this->_viewData['base_url'] = '/admin/jokes';
        
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $extraParam = array();
        
        if ( $request->request->get('title') ){
            $data = $request->request->all();
            $record = new \Front\YxBundle\Entity\Jokes();

            $record->setTitle( $data['title'] );
            $record->setDescription( $data['description'] );
            $record->setJokecategoryId( $data['jokecategory_id'] );
            $record->setUserId(0);
            
            $em->persist( $record );
            $em->flush();
            
            $this->get('session')->getFlashBag()->add( 'notice', 'Successfully Added.');
            return $this->redirect('/admin/jokes');
        }
        
        $jokeCat = $em->getRepository('YxBundle:Jokecategories')->findAll();
        $this->_viewData['jokeCat'] = $jokeCat;
        
        return $this->render('YxBundle:Jokes:admin_add.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/jokes/edit")
     * @Route("/admin/jokes/edit/")
     * @Route("/admin/jokes/edit/{id}")
     * @return type 
     */
    public function admin_editAction( $id = false ){
        //  Do Init
        $this->_viewData['base_url'] = '/admin/jokes';
        
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $extraParam = array();
        
        if ( ! $id )
            $id = $request->request->get('id');
        
        $records = $em->getRepository('YxBundle:Jokes')->findById( $id );
        $record = current( $records );

        if ( ! $record ){
            $this->get('session')->getFlashBag()->add( 'notice', 'Record not Found.');
            return $this->redirect('/admin/jokes');
        }
        $this->_viewData['record'] = $record;
        
        if ( $request->request->get('id') ){
            set_time_limit(0);
        
            $data = $request->request->all();

            $record->setTitle( $data['title'] );
            $record->setDescription( $data['description'] );
            $record->setJokecategoryId( $data['jokecategory_id'] );
            
            $em->persist( $record );
            $em->flush();
            
            $this->get('session')->getFlashBag()->add( 'notice', 'Successfully Updated.');
            return $this->redirect('/admin/jokes');
        }
        
        $jokeCat = $em->getRepository('YxBundle:Jokecategories')->findAll();
        $this->_viewData['jokeCat'] = $jokeCat;
        
        return $this->render('YxBundle:Jokes:admin_edit.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/delete_joke")
     * @Route("/admin/delete_joke/")
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
                    $data = $em->getRepository('YxBundle:Jokes')->find($id);
                    
                    $em->remove($data);
                    $em->flush();
                }
            }
        }
        
        echo 'Record deleted.';
        return new \Symfony\Component\HttpFoundation\Response();
        
    }
    

}
