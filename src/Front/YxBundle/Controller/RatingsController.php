<?php

namespace Front\YxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class RatingsController extends BaseController {
    /**
     * @Route("/ratings/add")
     * @Route("/ratings/add/")
     * @Route("/ratings/add/{chr}")
     */
    public function addAction($chr = null){
        //$this->session_check();
		
        $this->_session = $this->getRequest()->getSession();
        $user_id = $this->_session->get('Users.userid');
        $errorMessage = '';
        
        $label = 'Joke';

        $findChar = strpos($chr,',');
        if($findChar==true){
            $str = explode(',',$chr);
            $jokeType = $str[1];

            if ( $jokeType == 3){
                $label = 'Ringtone';
            }elseif ($jokeType == 5){
                $label = 'Video';
            }
        }

        $request = $this->getRequest();
        
        if ( $request->getMethod() == 'POST' ){
            $this->data = $request->request->get('Rating');
            
            $findChar = strpos($this->data['joke_id'],',');
            if($findChar==true){
                $str = explode(',',$this->data['joke_id']);
                $this->data['joke_id'] = $str[0];
                $this->data['joke_type'] = $str[1];
            }
            
            

            $this->_conn = $this->get('database_connection');
            
            $sql = " Select * from ratings
                    WHERE user_id = '". $this->data['user_id'] ."'
                    AND joke_id = '". $this->data['joke_id'] ."'
                    AND joke_type = '". $this->data['joke_type'] ."'
                ";
            
            $data = $this->_conn->fetchAll($sql);
            //echo '<pre>'; print_r( $data );die;
            
            if (!$data){
                $this->_conn->insert( 'ratings', $this->data );
                
                $errorMessage = "Your rating has been successfully recodred..";
                echo "<script>alert('".$errorMessage."');window.close();</script>";//
                die;
            }else{
                $errorMessage = "You have already rated to this joke.";
                echo "<script>alert('".$errorMessage."');window.close();</script>";//
                die;
            }
        }
		
        $this->_viewData['errorMessage'] = $errorMessage;
        $this->_viewData['id' ]     = $chr;
        $this->_viewData['user_id'] = $user_id;
        $this->_viewData['label']   = $label;

        return $this->render('YxBundle:Ratings:add.html.php', $this->_viewData);
        
	}
}
