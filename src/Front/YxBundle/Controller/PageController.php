<?php

namespace Front\YxBundle\Controller;

use Front\YxBundle\Entity\Users;
use Front\YxBundle\Entity\Songs;

use Front\YxBundle\Entity\Admins;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PageController extends Controller
{
    private $songRating = array();
    private $counter = 0;
    
    /**
     * @Route("/")
     * @Route("/users/index/{char}/{char2}")
     * @param type $char
     * @param type $char2
     */
    public function indexAction($char = null, $char2 = null){
        //$em = $this->get('doctrine')->getEntityManager();
        //$posts = $em->getRepository('AdminBundle:Post')->getAllPosts();
        
        $sql = "SELECT *
		FROM `songs` AS `Song`
		
		";
        
        $conn = $this->get('database_connection');
        $jokes = $conn->fetchAll($sql);
        
        //echo '<pre>'; print_r( $jokes );die;
        
        
        if ($char == 'download' && $char2 != null){
            $str = explode(',',$char2);
            if ($str[0] != ''){
                    $song1 = $conn->fetchAll("select * from songs where id=".$str[1]);

                    $original_file_name = '';
                    if($song1[0]['paid'] == 'N') {
                            $path = $song1[0]['sample_file_before'];
                            if($path != '') {
                                $str[0] = $song1[0]['sample_file_before'];
                                $filedownload = pathinfo($path);
                                $filename = pathinfo($song1[0]['or_file']);
                                $basename = $song1[0]['or_file'];
                                if($filename['extension'] != '') 
                                    $basename = substr($song1[0]['or_file'], 0, strlen($song1[0]['or_file']) - strlen($filename['extension'])-1);
                                $original_file_name = $basename . '.' . $filedownload['extension'];
                            }
                    }

                    $conn->query("update songs set stat_pc = stat_pc+1 where id=".$str[1]);
                    $this->download($str[0], $original_file_name, '', $str[2]);
            }
            $str = '';
        }
        
        
        
        $repository = $this->getDoctrine()->getRepository('YxBundle:Songs');
        $freeSongs = $repository->findByPaid('N');
        
        foreach($freeSongs as $k => $v){
            $this->get_song_rating($v->getId());
        }
        
        return $this->render('YxBundle:page:home.html.php', array(
                'freeSongs'     => $freeSongs,
                'songRating'    => $this->songRating,
            
            ));
    }
    
        
    /**
     * @Route("/home")
     * @Route("/users/index/{char}/{char2}")
     * @param type $char
     * @param type $char2
     */
    public function index1Action($char = null, $char2 = null){
        //$em = $this->get('doctrine')->getEntityManager();
        //$posts = $em->getRepository('AdminBundle:Post')->getAllPosts();
        
        $sql = "SELECT *
		FROM `songs` AS `Song`
		
		";
        
        $conn = $this->get('database_connection');
        $jokes = $conn->fetchAll($sql);
        
        //echo '<pre>'; print_r( $jokes );die;
        
        
        if ($char == 'download' && $char2 != null){
            $str = explode(',',$char2);
            if ($str[0] != ''){
                    $song1 = $conn->fetchAll("select * from songs where id=".$str[1]);

                    $original_file_name = '';
                    if($song1[0]['paid'] == 'N') {
                            $path = $song1[0]['sample_file_before'];
                            if($path != '') {
                                $str[0] = $song1[0]['sample_file_before'];
                                $filedownload = pathinfo($path);
                                $filename = pathinfo($song1[0]['or_file']);
                                $basename = $song1[0]['or_file'];
                                if($filename['extension'] != '') 
                                    $basename = substr($song1[0]['or_file'], 0, strlen($song1[0]['or_file']) - strlen($filename['extension'])-1);
                                $original_file_name = $basename . '.' . $filedownload['extension'];
                            }
                    }

                    $conn->query("update songs set stat_pc = stat_pc+1 where id=".$str[1]);
                    $this->download($str[0], $original_file_name, '', $str[2]);
            }
            $str = '';
        }
        
        $repository = $this->getDoctrine()->getRepository('YxBundle:Songs');
        $freeSongs = $repository->findByPaid('N');
        
        foreach($freeSongs as $k => $v){
            $this->get_song_rating($v->getId());
        }
        
        $query = "SELECT Genre.gname, Genre.id, Genre.image
		FROM `genres` AS `Genre` ";
        $results = $conn->fetchAll($query);
        
        $q= "SELECT * FROM `playlists` AS `Playlist` ";
                
        $em = $this->get('doctrine')->getEntityManager();
        $items = $conn->fetchAll($q);
        
        //  Create playlist Files
        $songFile = array();
        $title= array();
        
        if ( $items ){
            foreach ( $items as $k => $item ){
                if ( $item['song_id']){
                    $record     = $em->getRepository('YxBundle:Songs')->findOneById( $item['song_id'] );
                    $songFile[$k] = "img/songs/" . $record->getPath();
                    $title[$k]  =  $record->getComposition();
                }elseif ( $item['ringtone_id'] ){
                    $record     = $em->getRepository('YxBundle:Ringtones')->findOneById( $item['ringtone_id'] );
                    $songFile[$k] = "tone/" . $record->getRingtone();
                    $title[$k]  =  $record->getTitle();
                }
            }
        
        }
        
        return $this->render('YxBundle:page:home1.html.php', array(
                'items'         => $items,
                'songFile'      => $songFile,
                'title'         => $title,
                'results'       => $results,
                'freeSongs'     => $freeSongs,
                'songRating'    => $this->songRating,
            
            ));
    }
    
    private function download($chr, $filename = '',$db='', $type = ''){
        $conn = $this->get('database_connection');
        if ($db != 'no'){
            $session = $this->getRequest()->getSession();
            $user_id = $session->get('Users.userid');
            
            $tmp = $conn->fetchAll("select * from songs where path='".$chr."'");
            
            if ( $tmp ){
                $tmp = $tmp[0];
                
                if ($tmp['paid'] == 'Y'){
                    $sql = "insert into statistic set gdate='".date("Y-m-d")."',date='".date("Y-m")."', id_user=".$user_id.",result='pc',type='pcpj',time=".time();
                    $this->_conn->query( $sql );
                }else{
                    if ($type == 'free'){
                        $sql = "insert into statistic set gdate='".date("Y-m-d")."',date='".date("Y-m")."', result='pc',type='pcfj',time=".time();
                        $this->_conn->query( $sql );
                    }else{
                        $sql = "insert into statistic set gdate='".date("Y-m-d")."',date='".date("Y-m")."', id_user=".$user_id.",result='pc',type='pcfj',time=".time();
                        $this->_conn->query( $sql );
                    }
                }
            }
        }
            
        //echo $ref = $_SERVER['REQUEST_URI'];die;
        //if ($type != 'free')
        //    $this->session_check(false);

        $file = "http://yaxmobi.com/app/webroot/img/songs/".$chr;

        /*   print filesize($file); */
        /*   exit; */
        header("Content-Type: application/x-octet-stream");
        if($filename != '') {
            //$filename = str_replace(' ', '_', $filename);
            //header("Content-Disposition: attachment; filename=".basename($filename));
            header('Content-Disposition: attachment; filename="' . $filename. '"');
        } else {
            header("Content-Disposition: attachment; filename=".basename($file));
        }
        header("Content-Transfer-Encoding: binary");
        @readfile($file);
        exit;
    }
    
    private function get_song_rating($songId, $jokeType = 1){
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
}
