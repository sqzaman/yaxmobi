<?php

namespace Front\YxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class TickersController extends BaseController {
    /**
     * @Route("/tickers/index")
     * @Route("/tickers/index/")
     * @Route("/tickers/index/{flag}")
     */
    function indexAction($flag = ''){
        $em = $this->get('doctrine')->getEntityManager();
        $item = $em->getRepository('YxBundle:Tickers')->findAll();
        
        $item1 = '';
        foreach ($item as $ticker1){
            $item1 .= $this->remove_char_from_str( $ticker1->getTicker())."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        }
		
        $this->_viewData['tickerItem'] = $item1;
        $this->_viewData['width'] = $flag;

        return $this->render('YxBundle:Tickers:index.html.php', $this->_viewData);
    }
    
    //	This function removes any special characters
    private function remove_char_from_str($str){
        $undefinedCharacters = array('<p>','</p>','�', '�', '�', '�','�','�','�','�','�');
        $line = str_replace($undefinedCharacters, '', $str);
        return $line;
    }
    
    
    /*** Admin Section */
    /**
     * @Route("/admin/tickers")
     * @Route("/admin/tickers/")
     */
    public function admin_indexAction(){
        if (! $this->session_checkadmin() )
            return $this->redirect($this->generateUrl('admin_login'), 302);
        
        //  Do Init
        $this->_viewData['base_url'] = '/admin/tickers';
        
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
        
        $order = ' Order By Ticker.id';
        $limitClause = " Limit $offset, $limit";
        
        if( ! $request->query->get('char') ){
            $addQuery="";
        }else{
            $extraParam['char'] = $request->query->get('char');
            $addQuery=" WHERE Ticker.ticker LIKE '".$request->query->get('char')."%'" ;
        }
        
        $sql = "Select Ticker.* from tickers as Ticker 
                " . $addQuery . $order . $limitClause ;
        
        $records = $this->_conn->fetchAll( $sql );
        $this->_viewData['records'] = $records;
        
        //echo '<pre>'; print_r( $records );die;
        //  Get All item count
        $sql = "Select count(Ticker.id) as num from tickers as Ticker " . $addQuery;
        $items = $this->_conn->fetchAll( $sql );

        $itemsCount = $items[0]['num'];
        
        $paginator = new \Front\YxBundle\Helper\Paginator($itemsCount, $page , $limit, $midrange);
        
        $this->_viewData['paginator'] = $paginator;
        
        $this->_viewData['extraParam'] = $extraParam;

        return $this->render('YxBundle:Tickers:admin_index.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/tickers/add")
     * @Route("/admin/tickers/add/")
     * @return type 
     */
    public function admin_addAction(){
        //  Do Init
        $this->_viewData['base_url'] = '/admin/tickers';
        
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $extraParam = array();
        
        if ( $request->request->get('ticker') ){
            $data = $request->request->all();
            $record = new \Front\YxBundle\Entity\Tickers();

            $record->setTicker( $data['ticker'] );
            $record->setStatus( 1 );
            
            $em->persist( $record );
            $em->flush();
            
            $this->get('session')->getFlashBag()->add( 'notice', 'Successfully Added.');
            return $this->redirect('/admin/tickers');
        }
        
        return $this->render('YxBundle:Tickers:admin_add.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/tickers/edit")
     * @Route("/admin/tickers/edit/")
     * @Route("/admin/tickers/edit/{id}")
     * @return type 
     */
    public function admin_editAction( $id = false ){
        //  Do Init
        $this->_viewData['base_url'] = '/admin/tickers';
        
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $extraParam = array();
        
        if ( ! $id )
            $id = $request->request->get('id');
        
        $records = $em->getRepository('YxBundle:Tickers')->findById( $id );
        $record = current( $records );

        if ( ! $record ){
            $this->get('session')->getFlashBag()->add( 'notice', 'Record not Found.');
            return $this->redirect('/admin/tickers');
        }
        $this->_viewData['record'] = $record;
        
        if ( $request->request->get('id') ){
            
            $data = $request->request->all();

            $record->setTicker( $data['ticker'] );
            
            $em->persist( $record );
            $em->flush();
            
            $this->get('session')->getFlashBag()->add( 'notice', 'Successfully Updated.');
            return $this->redirect('/admin/tickers');
        }
        
        return $this->render('YxBundle:Tickers:admin_edit.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/delete_ticker")
     * @Route("/admin/delete_ticker/")
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
                    $data = $em->getRepository('YxBundle:Tickers')->find($id);
                    
                    $em->remove($data);
                    $em->flush();
                }
            }
        }
        
        echo 'Record deleted.';
        return new \Symfony\Component\HttpFoundation\Response();
        
    }
    
}
