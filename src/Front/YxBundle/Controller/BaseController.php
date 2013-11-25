<?php

namespace Front\YxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

define ('MY_SITE_URL', "http://symfony.yaxmobi.com/");

define ('PAYMENT_LOG_PATH', "../web/payments/log/");

define('FEEDBACK_EMAIL', 'feedback@yaxmobi.com');
define('FEEDBACK_NAME', 'Jean');
define('SUPPORT_EMAIL', 'support@yaxmobi.com');
define('SUPPORT_NAME', 'Jean');
define('CONTACT_US_EMAIL', 'info@yaxmobi.com');
define('CONTACT_US_NAME', 'Jean');

if (!defined('WWW_ROOT')) {
    define('WWW_ROOT', './web/');
}

class BaseController extends Controller{
    protected $_session;
    
    protected $songRating = array();
    protected $counter = 0;
    
    protected function init(){
        

      //  $this->_session = $this->getRequest()->getSession();
        //parent::__construct();
    }

    protected function session_check($redirect = true) {
        $this->_session = $this->getRequest()->getSession();
        
        $userid = $this->_session->get('Users.id');
        
        if( ! $userid ){
            
            $url = '/users/login/';
            $ref = $_SERVER['REQUEST_URI'];
            if ($ref != ''){
                $this->_session->set('Redirect.url', $ref);
            }
            return FALSE;
        }
        return true;
        
    }
    
    protected function get_song_rating($songId, $jokeType = 1){
        $condition = "joke_id = ". $songId . " AND joke_type = '". $jokeType ."'";

        $sql = "select (sum(Rating.user_rating)/count(Rating.user_rating)) as points, Rating.joke_id as id, count(Rating.user_rating) as vote from ratings AS Rating WHERE " . $condition ." GROUP BY Rating.joke_id";
        $conn = $this->get('database_connection');
        
        $temp = $conn->fetchAll($sql);

        $points = 0;
        $vote = 0;
        if (($temp)){
            $points = round($temp[0]['points']);
            $vote = round($temp[0]['vote']);
        }

        $this->songRating[$this->counter]['id'][] = $songId;
        $this->songRating[$this->counter]['points'][] = $points;
        $this->songRating[$this->counter]['vote'][] = $vote;

        switch ($points)
        {
                case '0':
                        $this->songRating[$this->counter]['image'][] = "00star.gif";
                        break;
                case '1':
                        $this->songRating[$this->counter]['image'][] = "1star.gif";
                        break;
                case '2':
                        $this->songRating[$this->counter]['image'][] = "2star.gif";
                        break;
                case '3':
                        $this->songRating[$this->counter]['image'][] = "3star.gif";
                        break;
                case '4':
                        $this->songRating[$this->counter]['image'][] = "4star.gif";
                        break;
                case '5':
                        $this->songRating[$this->counter]['image'][] = "5star.gif";
                        break;
        }
        $this->counter++;
    }

    protected function session_checkadmin(){
        $this->_session = $this->getRequest()->getSession();
        
        if( ! $this->_session->get('admin_id') ){
            
            $url = '/admin/login/';
            return FALSE;
        }
        
        return true;
    }
    
}
