<?php

namespace Front\YxBundle\Controller;

use Front\YxBundle\Entity\Users;
use Front\YxBundle\Entity\Songs;

use Front\YxBundle\Entity\Admins;
use Front\YxBundle\Helper\PS_Pagination;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

///use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class TabsController extends Controller
{
    public function ringtoneAction(){
            $perPage = 12;

            if (isset($_REQUEST['tab_page'])){
                $tab_page = $_REQUEST['tab_page'];
            }else{
                $tab_page = 1;
            }
            
            $conditions = "Ringtonecategory.status='1'";
            $order = "Ringtonecategory.title ASC ";

            $sql = "SELECT count(*) as count
		FROM `ringtonecategories` AS `Ringtonecategory`
		WHERE $conditions
		";
        
            $conn = $this->get('database_connection');
            $songcat = $conn->fetchAll($sql);
            
            $num = $songcat[0]['count'];
            
            $totalPage = ceil($num/$perPage);

            $offset = ($tab_page - 1) * $perPage;
            $sql = "SELECT Ringtonecategory.title, Ringtonecategory.id, Ringtonecategory.image
		FROM `ringtonecategories` AS `Ringtonecategory`
		WHERE $conditions
		LIMIT $offset,$perPage";
            
            $songcat = $conn->fetchAll($sql);
            
            if ($totalPage == $tab_page || $totalPage == 0)
                    $nextPage = "#";//#";///tabs/index/?page=$page#";
            else
                    $nextPage = "/tabs/ringtone/?tab_page=" . ($tab_page+1);	

            if ($tab_page == 1)
                    $prevPage = "#";//"#";///tabs/index/?page=$page#";
            else
                    $prevPage = "/tabs/ringtone/?tab_page=" . ($tab_page-1);	

            return $this->render('YxBundle:Box:ringtone.html.php', array(
                'nextPage' => $nextPage,
                'prevPage'=> $prevPage,
                'ringtonecat' => $songcat,
            ));
	}
    
       
        
        
        
        
    public function indexAction(){
        //echo "<pre>";
        //print_r($_SERVER);
        $perPage = 12;

        if (isset($_REQUEST['tab_page'])){
            $tab_page = $_REQUEST['tab_page'];
        }else{
            $tab_page = 1;
        }

        $repository = $this->getDoctrine()->getRepository('YxBundle:Genres');
        $results = $repository->findAll();
        
        $num = count($results);

        $totalPage = ceil($num/$perPage);
        
        $offset = ($tab_page - 1) * $perPage;
        $sql = "SELECT Genre.gname, Genre.id, Genre.image
		FROM `genres` AS `Genre`
		
		LIMIT $offset,$perPage";
        
        $conn = $this->get('database_connection');
        $songcat = $conn->fetchAll($sql);

        if ($totalPage == $tab_page || $totalPage == 0)
                $nextPage = "#";///tabs/index/?page=$page#";
        else
                $nextPage = "/tabs/index/?tab_page=" . ($tab_page+1);	

        if ($tab_page == 1)
                $prevPage = "#";///tabs/index/?page=$page#";
        else
                $prevPage = "/tabs/index/?tab_page=" . ($tab_page-1);	

        return $this->render('YxBundle:Box:home_tabs.html.php', array(
                'songcat' => $songcat,
                'nextPage'=> $nextPage,
                'prevPage'=> $prevPage,
            ));
    }
    
    
    public function videoAction(){
        $perPage = 12;

        if (isset($_REQUEST['tab_page'])){
            $tab_page = $_REQUEST['tab_page'];
        }else{
            $tab_page = 1;
        }

        $repository = $this->getDoctrine()->getRepository('YxBundle:Videos');
        $results = $repository->findAll();
        
        $num = count($results);

        $totalPage = ceil($num/$perPage);
        
        $offset = ($tab_page - 1) * $perPage;
        $sql = "SELECT Video.title, Video.id, Video.image
		FROM `videos` AS `Video`
		Order By Video.title ASC
		LIMIT $offset,$perPage";
        
        $conn = $this->get('database_connection');
        $songcat = $conn->fetchAll($sql);
//echo '<pre>';print_r( $songcat );die;
        if ($totalPage == $tab_page || $totalPage == 0)
                $nextPage = "#";///tabs/index/?page=$page#";
        else
                $nextPage = "/tabs/index/?tab_page=" . ($tab_page+1);	

        if ($tab_page == 1)
                $prevPage = "#";///tabs/index/?page=$page#";
        else
                $prevPage = "/tabs/index/?tab_page=" . ($tab_page-1);	

        return $this->render('YxBundle:Box:video.html.php', array(
                'video' => $songcat,
                'nextPage'=> $nextPage,
                'prevPage'=> $prevPage,
            ));
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
    
    
    public function home_page_ringtoneAction(){
        $conn = $this->get('database_connection');
        
        $conditions ="Ringtone.status = '1' and (Ringtone.type = 0 or Ringtone.type = '')";
        $sql = "SELECT * from ringtones as Ringtone
                WHERE ". $conditions ."
                LIMIT 6
                ";
        
        $ringtone = $conn->fetchAll($sql);
        //pr($ringtone);
        if ( $ringtone ){
            $songFileArr = array();
            foreach ($ringtone as $k => $v){
                $sampleFile =  $v['prew_ringtone'];
				
                if(is_file(WWW_ROOT . 'tone/' . $sampleFile)){
                    $songFile = $sampleFile;
                }elseif (is_file(WWW_ROOT . 'tone/preview_'.$v['ringtone'])){
                    $songFile = 'preview_'.$v['ringtone']; 
                }else{
                    $songFile = $v['ringtone']; 
                }
				
                $songFileArr[] = $songFile;
				//array_push($songFileArr, $songFile);
            }
            $this->_viewData['songFile'] = $songFileArr;
        }
                
        return $this->render('YxBundle:Box:home_page_ringtone.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/{type}", name="tabbed")
     * @param type $type
     */   
       public function tabbedAction($type = null){

           
        $conn = $this->get('database_connection');
       
        
        if ($type == "long_jokes"){
        $sql = "SELECT Genre.gname, Genre.id, Genre.image
		FROM `genres` AS `Genre` "; 
        $conn->query("update catmemory set category = '".$type."' where id=1");  
        }
        
        if ($type == "short_jokes"){
        $sql = "SELECT Shortjokes.title, Shortjokes.id, Shortjokes.image
		FROM `ringtonecategories` AS `Shortjokes` "; 
       $conn->query("update catmemory set category = '".$type."' where id=1");  
        }
        
        if ($type == "videos"){
        $sql = "SELECT Video.title, Video.id, Video.image
		FROM `videos` AS `Video`
		Order By Video.title ASC";    
        $conn->query("update catmemory set category = '".$type."' where id=1");  
        }
        
        if ($type == "yo_mama"){
        $sql = "SELECT * from yomamacategories as Yomama
                Order By Yomama.catname ASC";
        $conn->query("update catmemory set category = '".$type."' where id=1");  
        }
        
        if ($type == "cartoons"){
        $sql = "SELECT Cartoon.title, Cartoon.id, Cartoon.image
		FROM `cartoons` AS `Cartoon`
		Order By Cartoon.title ASC"; 
        $conn->query("update catmemory set category = '".$type."' where id=1");  
        }
        
        
        $results = $conn->fetchAll($sql);
  
        return $this->render('YxBundle:Box:tabbed.html.php', array(
                'type'    => $type,
                'results' => $results,
            ));
    }

}
