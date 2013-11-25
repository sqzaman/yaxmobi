<?php

namespace Front\YxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CelebritynewsController extends BaseController {
    /**
     * @Route("/celebritynews")
     * @Route("/celebritynews/")
     * @Route("/celebritynews/index")
     * @Route("/celebritynews/index/")
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
        
        return $this->render('YxBundle:Celebritynews:index.html.php', $this->_viewData);
    }
}
