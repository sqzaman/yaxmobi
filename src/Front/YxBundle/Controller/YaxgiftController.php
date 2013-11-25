<?php

namespace Front\YxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class YaxgiftController extends BaseController {
    /**
     * @Route("/yaxgift")
     * @Route("/yaxgift/")
     * @Route("/yaxgift/index")
     * @Route("/yaxgift/index/")
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
        
        return $this->render('YxBundle:Yaxgift:index.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/yaxgift/redeem")
     * @Route("/yaxgift/redeem/")
     */
    public function redeemAction (){
        $this->_session = $this->getRequest()->getSession();
        $user_id = $this->_session->get('Users.userid');
        $this->_viewData['user_id'] = $user_id;
        
        $displayName = $this->_session->get('Users.name');
        $this->_viewData['displayName'] = $displayName;
        
        if($user_id == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        return $this->render('YxBundle:Yaxgift:redeem.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/yaxgift/apply_redeem")
     * @Route("/yaxgift/apply_redeem/")
     */
    public function apply_redeemAction(){
        
        $this->_session = $this->getRequest()->getSession();
        $user_id = $this->_session->get('Users.userid');
        $this->_viewData['user_id'] = $user_id;
        
        $displayName = $this->_session->get('Users.name');
        $this->_viewData['displayName'] = $displayName;
        
        if($user_id == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        $login  = $_POST['login'];
        $code   = $_POST['code'];

        $status = '';
        if ($login && $code){
            
            $conn = $this->get('database_connection');
            $sql = "select id from users where firstname='$login'";
            $user = $conn->fetchAll( $sql );
            
            if (count($user) == 1){
                $user_id = $user[0]['id'];
                
                $sql = "select price from giftsert where code='$code' and status='1'";
                $code_sert = $conn->fetchAll( $sql );
                
                if (count($code_sert) == 1){
                    $price = $code_sert[0]['price'];
                    
                    $sql = "select * from userbalances where user_id='$user_id'";
                    $balanse = $conn->fetchAll( $sql );
                    if (count($balanse) == 1){
                        $sql = "update userbalances set amount=amount+$price where user_id='$user_id'"; 
                        $conn->query( $sql );
                        $sql = "update giftsert set status='2' where code='$code'";
                        $conn->query($sql);
                        $status = "Balance changed"; 
                    }else if (count($balanse) == 0){
                        $sql = "insert into userbalances (user_id,amount) values ($user_id,$price)"; 
                        $conn->query($sql);
                        $sql = "update giftsert set status='2' where code='$code'"; 
                        $conn->query($sql);
                        $status = "Balance changed";   
                    } 
                }else{
                    $status = "Invalid code";
                }
            }else{
                $status = "Invalid login";
            }
        }else{
            $status = "Invalid data";    
        }
        $this->_viewData['status'] = $status;
        
        return $this->render('YxBundle:Yaxgift:apply_redeem.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/yaxgift/success")
     * @Route("/yaxgift/success/")
     */
    public function successAction(){
        $this->_session = $this->getRequest()->getSession();
        $user_id = $this->_session->get('Users.userid');
        $this->_viewData['user_id'] = $user_id;
        
        $displayName = $this->_session->get('Users.name');
        $this->_viewData['displayName'] = $displayName;
        
        if($user_id == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        $path = PAYMENT_LOG_PATH . date("h-i-s").".txt";
        $file = fopen($path,"w+");
        $mass = 'POST = ';
        foreach ($_POST as $key => $value){
            if (is_array($value)){
                $mass .= $key.'=array( ';
                foreach ($value as $keys => $values)
                    $mass .= $keys.' = '.$values.' ';
                $mass .= ')';
            }else
                $mass .= $key.'='.$value.' ';
        }
        
        $mass .= 'GET = ';
        foreach ($_GET as $key => $value){
            if (is_array($value)){
                $mass .= $key.'=array( ';
                foreach ($value as $keys => $values)
                    $mass .= $keys.' = '.$values.' ';
                $mass .= ')';
            }else
                $mass .= $key.'='.$value.' ';
        }
        
        fwrite($file,$mass);
        fflush($file);
        
        /*echo "I am in success.";
        echo "<pre>";
        print_r($_POST);
        print_r($_GET);
        print_r($_COOKIE);
        print_r($_SESSION);

        die;*/

        return $this->render('YxBundle:Yaxgift:success.html.php', $this->_viewData);
    }
}
