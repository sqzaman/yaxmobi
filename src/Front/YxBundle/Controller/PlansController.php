<?php

namespace Front\YxBundle\Controller;

use Front\YxBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PlansController extends BaseController {

    private $_viewData = array(), $data = array(), $_conn;
    
    //  Admin Section 
    
    /**
     * @Route("/admin/plans/add")
     * @Route("/admin/plans/add/")
     * @return type 
     */
    public function admin_addAction(){
        //  Do Init
        $this->_viewData['base_url'] = '/admin/plans';
        
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $extraParam = array();
        
        if ( $request->request->get('planname') ){
            $data = $request->request->all();
            
            $record = new \Front\YxBundle\Entity\Plans();

            $record->setPlanname( $data['planname'] );
            $record->setPlancost( $data['plancost'] );
            $record->setStatus('A');
            
            $em->persist( $record );
            $em->flush();
            
            $this->get('session')->getFlashBag()->add( 'notice', 'Successfully Added.');
            return $this->redirect('/admin/plans');
        }
        
        //$genres = $em->getRepository('YxBundle:Genres')->findById( $id );
        //$genreDetail = current($genres);
        
        return $this->render('YxBundle:Plans:admin_add.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/plans/edit")
     * @Route("/admin/plans/edit/")
     * @Route("/admin/plans/edit/{id}")
     * @return type 
     */
    public function admin_editAction( $id = false ){
        //  Do Init
        $this->_viewData['base_url'] = '/admin/plans';
        
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $extraParam = array();
        
        if ( ! $id )
            $id = $request->request->get('id');
        
        $records = $em->getRepository('YxBundle:Plans')->findById( $id );
        $record = current( $records );
        
        if ( ! $record ){
            $this->get('session')->getFlashBag()->add( 'notice', 'Record not Found.');
            return $this->redirect('/admin/plans');
        }
        $this->_viewData['record'] = $record;
        
        if ( $request->request->get('id') ){
            set_time_limit(0);
        
            $data = $request->request->all();

            $record->setPlanname( $data['planname'] );
            $record->setPlancost( $data['plancost'] );
            
            $em->persist( $record );
            $em->flush();
            
            $this->get('session')->getFlashBag()->add( 'notice', 'Successfully Updated.');
            return $this->redirect('/admin/plans');
        }
        
        return $this->render('YxBundle:Plans:admin_edit.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/update_plan")
     * @Route("/admin/update_plan/")
     * @return type 
     */
    public function update_planAction(){
        if (! $this->session_checkadmin() )
            return $this->redirect($this->generateUrl('admin_login'), 302);
        
        //  Do Init
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $ids = explode(',', $request->request->get('ids'));
        foreach ( $ids as $id ){
            if ( $id != '' ){
                $data = $em->getRepository('YxBundle:Plans')->find($id);
                $data->setStatus( $request->request->get('status') );
            
                $em->persist( $data );
                $em->flush();
            }
        }
        
        echo 'Record Updated.';
        return new \Symfony\Component\HttpFoundation\Response();
    }


    /**
     * @Route("/admin/plans")
     * @Route("/admin/plans/")
     * @return type 
     */
    public function admin_indexAction( $page = 1 ){
        if (! $this->session_checkadmin() )
            return $this->redirect($this->generateUrl('admin_login'), 302);

        //  Do Init
        $this->_viewData['base_url'] = '/admin/plans';
        
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
        
        $order = ' Order By Plan.id';
        $limitClause = " Limit $offset, $limit";
        
        $addQuery="";
        
        $sql = "Select Plan.* from plans as Plan 
                " . $addQuery . $order . $limitClause ;
        $records = $this->_conn->fetchAll( $sql );
        $this->_viewData['records'] = $records;
        
        //echo '<pre>'; print_r( $records );die;
        
        //  Get All item count
        $sql = "Select count(Plan.id) as num from plans as Plan " . $addQuery;
        $items = $this->_conn->fetchAll( $sql );

        $itemsCount = $items[0]['num'];
        
        $paginator = new \Front\YxBundle\Helper\Paginator($itemsCount, $page , $limit, $midrange);
        
        $this->_viewData['paginator'] = $paginator;
        
        $this->_viewData['extraParam'] = $extraParam;

        return $this->render('YxBundle:Plans:admin_index.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/delete_plan")
     * @Route("/admin/delete_plan/")
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
                    $data = $em->getRepository('YxBundle:Plans')->find($id);
                    
                    $em->remove($data);
                    $em->flush();
                }
            }
        }
        
        echo 'Record deleted.';
        return new \Symfony\Component\HttpFoundation\Response();
        
    }

}
