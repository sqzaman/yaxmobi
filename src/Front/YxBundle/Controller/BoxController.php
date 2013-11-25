<?php

namespace Front\YxBundle\Controller;

use Front\YxBundle\Entity\Users;
use Front\YxBundle\Entity\Songs;

use Front\YxBundle\Entity\Admins;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BoxController extends Controller
{
    
    public function mycartAction(){
        $session = $this->getRequest()->getSession();
        
        $user_id = $session->get ('Users.userid');//$this->Session->read('Users.userid');

        $sql = "SELECT count(user_id) as cartCount FROM `cartitems` WHERE `user_id` = '".$user_id."' AND cartitems.statuspc='5'";
        
        $conn = $this->get('database_connection');
        $result = $conn->fetchAll($sql);
        
        $countCart = $result[0]['cartCount'];

        return $this->render('YxBundle:Box:mycart.html.php', array(
                'countCart' => $countCart,
        ));
    }
    
    /**
     * Public function relatedAction
     * Renders the related items in right box
     */
    public function relatedAction($size = ''){
   
        $this->_viewData['size'] = $size;
        
        $session = $this->getRequest()->getSession();
        $conn = $this->get('database_connection');
        
        $relatedJoke = $session->get('Relatedjoke.myjokeid');
        $relatedType = $session->get('Relatedjoke.type');
        
        $relatedJoke = 2;
        $relatedType ="Joke";
        
        if ( $relatedType == 'Joke' ){
                $audioJokes = '';
                $sql = "select Song.tag from songs as Song WHERE Song.id = $relatedJoke";
                $tag = $conn->fetchAll($sql);
                
                $jokeTag = $tag[0]['tag'];
                $temp = explode(',', $jokeTag);

                if (count($temp) > 0){
                    $jokeTag = 'AND (';
                    $jokeTag1 = '';
                    foreach ($temp as $v){
                            $jokeTag1 .= " Song.tag like '%".trim($v)."%' ||";
                    }
                    $jokeTag1 = substr($jokeTag1,0,-2);
                    $jokeTag .= $jokeTag1 . ')';

                }

                $sql = "select `Song`.`composition` , `Song`.`id` from songs as Song WHERE Song.id != '".$relatedJoke."'  ".$jokeTag." order by rand() limit 20";
                $audioJokes  = $conn->fetchAll($sql);
                $this->_viewData["audioJokes"] = $audioJokes;

        }else{
            $audioJokes = array();
            $this->_viewData["audioJokes"] = $audioJokes;
        }
        
        return $this->render('YxBundle:Box:related.html.php', $this->_viewData);
    }
    
    /**
     * Public function jokesAction
     * Renders the top 10 jokes and ringtones in right box
     * @return type 
     */
    public function jokesAction()
    {
        //$em = $this->get('doctrine')->getEntityManager();
        //$cats = $em->getRepository('YxBundle:')->findAll();
        
        $sql = "SELECT `Song`.`composition` , `Song`.`id` , sum( user_rating ) AS rating, count(user_id) as vote
		FROM `songs` AS `Song`
		INNER JOIN `ratings` AS `Rating` ON `Song`.`id` = `Rating`.`joke_id` AND `Rating`.`joke_type` != '3'
		GROUP BY Rating.joke_id
		ORDER BY rating DESC, vote DESC 
		LIMIT 10";
        
        $conn = $this->get('database_connection');
        $jokes = $conn->fetchAll($sql);
        
        $condition = "Ringtone.status = '1' AND Ringtone.type = '1'";
        $sql = "SELECT `Ringtone`.`title` , `Ringtone`.`id` , sum( user_rating ) AS rating, count(user_id) as vote
		FROM `ringtones` AS `Ringtone`
		INNER JOIN `ratings` AS `Rating` ON `Ringtone`.`id` = `Rating`.`joke_id` AND `Rating`.`joke_type` = '3'
		WHERE Ringtone.status = '1' 
		GROUP BY Rating.joke_id
		ORDER BY rating DESC, vote DESC 
		LIMIT 10"; 
        
        $ringTone = $conn->fetchAll($sql);
        
        //$repository = $this->getDoctrine()->getRepository('YxBundle:Admins');

        //$products = $repository->findAll();
        
        return $this->render('YxBundle:Box:hotandfunny.html.php', array(
                'audioJokes' => $jokes,
                'ringtone'=> $ringTone,
            ));
    }
}
