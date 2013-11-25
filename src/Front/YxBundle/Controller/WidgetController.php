<?php

namespace Front\YxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class WidgetController extends BaseController {
    /**
     * @Route("/widget")
     * @Route("/widget/")
     * @Route("/widget/index")
     */
    function indexAction($flag = ''){
        $this->_conn = $this->get('database_connection');
        $this->_session = $this->getRequest()->getSession();
        
        //	Free Demo audio jokes
        $sql = "Select Song.*, Singer.sname, Genre.gname 
            from songs as Song
            LEFT JOIN singers as Singer ON Song.singer_id = Singer.id
            LEFT JOIN genres as Genre ON Song.genre_id = Genre.id
            WHERE Song.paid = 'N'";
        $freeSong = $this->_conn->fetchAll($sql);
        
        $this->_viewData['freeSong'] = $freeSong;
        
        $user_id = $this->_session->get('Users.userid');
        $this->_viewData['user_id'] = $user_id;
        
        $displayName = $this->_session->get('Users.name');
        $this->_viewData['displayName'] = $displayName;
        
        if($user_id == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        
        //$content = file_get_contents("http://www.develop.yaxmobi.com/app/webroot/widget_h/index.html");
        //$this->set('content',$content);

        return $this->render('YxBundle:page:widget.html.php', $this->_viewData);
    }
    
}
