<?php

namespace Front\YxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class MailinglistsController extends BaseController {
    
    /*** Admin Section */
    /**
     * @Route("/admin/mailinglists")
     * @Route("/admin/mailinglists/")
     */
    public function admin_indexAction(){
        if (! $this->session_checkadmin() )
            return $this->redirect($this->generateUrl('admin_login'), 302);
        
        //  Do Init
        $this->_viewData['base_url'] = '/admin/mailinglists';
        
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
        
        $order = ' Order By Mailinglist.id';
        $limitClause = " Limit $offset, $limit";
        
        if( ! $request->query->get('char') ){
            $addQuery="";
        }else{
            $extraParam['char'] = $request->query->get('char');
            $addQuery=" WHERE Mailinglist.email LIKE '".$request->query->get('char')."%'" ;
        }
        
        $sql = "select Mailinglist.* from mailinglists as Mailinglist 
                " . $addQuery . $order . $limitClause ;
                ;
        
        $records = $this->_conn->fetchAll( $sql );
        $this->_viewData['records'] = $records;
        
        //echo '<pre>'; print_r( $records );die;
        
        //  Get All item count
        $sql = "Select count(Mailinglist.id) as num from mailinglists as Mailinglist 
                " . $addQuery;
        
        $items = $this->_conn->fetchAll( $sql );

        $itemsCount = $items[0]['num'];
        
        $paginator = new \Front\YxBundle\Helper\Paginator($itemsCount, $page , $limit, $midrange);
        
        $this->_viewData['paginator'] = $paginator;
        
        $this->_viewData['extraParam'] = $extraParam;

        return $this->render('YxBundle:Mailinglists:admin_index.html.php', $this->_viewData);
    }
    
    
    
    /**
     * @Route("/admin/update_status")
     * @Route("/admin/update_status/")
     * @return type 
     */
    public function admin_updateAction(){
        if (! $this->session_checkadmin() )
            return $this->redirect($this->generateUrl('admin_login'), 302);
        
        //  Do Init
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        if( $request->request->get('act') && $request->request->get('act') == 'update_status' ){
            $ids = explode(',', $request->request->get('ids'));
            
            foreach ( $ids as $id ){
                if ( $id != '' ){
                    $data = $em->getRepository('YxBundle:Mailinglists')->find( $id );
                    
                    $data->setStatus( $request->request->get('status') );
                    $em->persist($data);
                    $em->flush();
                }
            }
        }
        
        echo 'Record Updated.';
        return new \Symfony\Component\HttpFoundation\Response();
        
    }
    
    /**
     * @Route("/admin/delete_mailinglist")
     * @Route("/admin/delete_mailinglist/")
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
