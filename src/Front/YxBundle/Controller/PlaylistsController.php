<?php

namespace Front\YxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PlaylistsController extends BaseController{
    //private $songRating = array();
    //private $counter = 0;
    
    /**
     * @Route("/playlists")
     * @Route("/playlists/")
     */
    public function indexAction(){
        if (!$this->session_check())
            return $this->redirect($this->generateUrl('user_login'), 302);
        
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        
        $userId = $this->_session->get('Users.userid');
        
        $this->_viewData['user_id'] = $userId;
        
        $displayName = $this->_session->get('Users.name');
        $this->_viewData['displayName'] = $displayName;
        
        if($userId == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        $items = $em->getRepository('YxBundle:Playlists')->findByUserId( $userId );
        
        //  Create playlist Files
        $songFile = array();
        $playlist = '';
        
        if ( $items ){
            foreach ( $items as $k => $item ){
                if ( $item->getSongId() ){
                    $record     = $em->getRepository('YxBundle:Songs')->findOneById( $item->getSongId() );
                    $songFile[$k] = "img/songs/" . $record->getPath();
                    //$items[$k]  = "img/songs/" . $record->getPath();
                }elseif ( $item->getRingtoneId() ){
                    $record     = $em->getRepository('YxBundle:Ringtones')->findOneById( $item->getRingtoneId() );
                    $songFile[$k] = "tone/" . $record->getRingtone();
                    //$items[$k]  = "tone/" . $record->getRingtone();
                }
            }
            
            foreach ($songFile as $v){
                $playlist .= MY_SITE_URL .  $v . "|";	
            }

            $playlist = substr($playlist,0,-1);
        }
        
        $this->_viewData['song_file']       = $songFile;
        $this->_viewData['items']       = $items;
        $this->_viewData['playlist']    = $playlist;
        
        return $this->render('YxBundle:Playlists:index.html.php', $this->_viewData);
    }

    /**
     * @Route("/playlists/delete")
     * @Route("/playlists/delete/")
     */
    public function deleteAction(){
        if (!$this->session_check())
            return $this->redirect($this->generateUrl('user_login'), 302);
        
        
        
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        
        $userId = $this->_session->get('Users.userid');

        $request = $this->getRequest();
        
        $id = $request->request->get('id');
        
        $sql = "DELETE FROM playlists where id = '". $id ."'";
        
        $this->_conn->query( $sql );
        
        echo 'Record deleted.';
        exit;
    }

    /**
     * @Route("/playlists/add")
     * @Route("/playlists/add/")
     * @param type $char
     * @param type $char2
     */
    public function addAction(){
        
        //$this->_session = $this->getRequest()->getSession();
        
        if (!$this->session_check())
            return $this->redirect($this->generateUrl('user_login'), 302);
        
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        
        $userId = $this->_session->get('Users.userid');

        $request = $this->getRequest();
        
        $id = $request->request->get('id');
        //  Get the cart detail
        $cart = $em->getRepository('YxBundle:Cartitems')->findOneById( $id );
        
        if ( ! $cart )
            exit('Record not Found.');
        
        $id = $cart->getSongId();
        $type = $cart->getType();
        
        $type = ($type == 'r' ? 'ringtone' : 'song');
        
//         $data['playlist']['user_id'] = $userId;
//        $data['playlist'][$type .'_id'] = $id;
        
        $typeId = $type .'_id';
        
            
        //  Check for duplicate record
        $sql = "Select playlists.id from playlists
                WHERE user_id = '". $userId ."' 
                AND " . $typeId ." = '". $id ."'";
                 
             
        $record = $this->_conn->fetchAll( $sql );
        
        if ( $record ){
            echo 'Already in playlist.';
        }else{
            //  Record not found. Add new item in playlist
            $this->data = array(
               'user_id' =>  $userId,
               $typeId  => $id
            );
            
            $this->_conn->insert( 'playlists', $this->data );
            echo 'Added to playlist.';
        }
        exit;
    }
    
}
