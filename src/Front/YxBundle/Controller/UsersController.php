<?php

namespace Front\YxBundle\Controller;

use Front\YxBundle\Controller\BaseController;
use Front\YxBundle\Form\UserType;
use Front\YxBundle\Form\EnquiryType;

use Front\YxBundle\Entity\Users;

use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class UsersController extends BaseController {

    private $_viewData = array(), $data = array(), $_conn;
//    private $songRating = array();
//    private $counter = 0;

    public function __construct(){
        
    }



    /**
     * @Route("/users/welcome")
     * @Route("/users/welcome/")
     * Landing page after user loggs in
     * @param type $char
     * @param type $char2
     * @return type 
     */
    public function welcomeAction($char=null, $char2 = null) {
        return $this->redirect('/users/index');
    }

    private function download($chr, $filename = '',$db='', $type = ''){
        if ($db != 'no'){
            $user_id = $this->_session->get('Users.userid');
            echo "select * from songs where path='".$chr."'";
            $tmp = $this->_conn->fetchAll("select * from songs where path='".$chr."'");
            
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


    /**
     * @Route("/users/send")
     * @Route("/users/send/")
     * @Route("/users/send/{char}/{id}")
     * @Route("/users/send/{char}/{id}/{type}")
     * @param type $char
     * @param type $id
     * @param type $type 
     */
    public function send($char = null, $id = null, $type = 0){
        
        if (!$this->session_check())
            return $this->redirect($this->generateUrl('user_login'), 302);
        
        $user_id = $this->_session->get('Users.userid');

        $displayName = $this->_session->get('Users.name');
        
        $this->_viewData['displayName'] = $displayName;
        
        if($user_id == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        $this->_viewData['id'] = $user_id;
        
        $this->_viewData['via_myxer_Code'] = FALSE;
        
        $request = $this->getRequest();
        //echo '<pre>I m here'; print_r( $_REQUEST );die;
                
        //if ((!empty($this->data))&&($char == null))
            //$this->User->save($this->data);
                
        $condition = 'WHERE id = '.$user_id;
	
        //  Get Connection
        $this->_conn = $this->get('database_connection');
        
        //  Get EM
        $em = $this->get('doctrine')->getEntityManager();
        $mass_users = $em->getRepository('YxBundle:Users')->findById($user_id);

        $carriers = $em->getRepository('YxBundle:Carriers')->findAll();
        $this->_viewData['carriers'] = $carriers;
        
        $this->_viewData['users']   = $mass_users;
        $this->_viewData['char']    = $char;
        //$char = null;
        
        if ($char == null){
            $temp = $em->getRepository('YxBundle:Carriers')->findById( $mass_users[0]->getCarrier() );
            
            $carr = $temp[0]->getCarriername();
            
            if( $this->sendfile( $mass_users[0]->getMobilePhone(), $carr, 'Test message from yaxmobi.com for '.$carr, 'test' ) )
                $this->_viewData['message'] = 'The message was successfully sent';
            else
                $this->_viewData['message'] = 'Error at sending. Check up correctness of your number and carrier';
        }
        
        //echo '<pre>I m here'; print_r( $mass_users ); die;

        if ($char == 'form'){
            if ($type == 0){
                
                $this->_viewData['message'] =  '';
                
                $sql = "select Song.*,Genre.gname,Cartitem.created 
                        from `cartitems` AS `Cartitem`
                        INNER JOIN songs as Song  ON `Cartitem`.`song_id` = `Song`.`id` 
                        INNER JOIN `genres` AS `Genre` ON Song.genre_id = Genre.id
                        WHERE `Cartitem`.`song_id`=".$id." and (Cartitem.status='2' or Cartitem.status='1')
                        LIMIT 1";

                $freeSongs = $this->_conn->fetchAll($sql);

                if(count($freeSongs) == 0){
                    $sql = "select Song.*,Genre.gname from songs as Song
                            left JOIN `genres` AS `Genre` ON Song.genre_id = Genre.id
                            WHERE `Song`.`id`=".$id." and (Song.paid='N')
                            LIMIT 1";

                    $freeSongs = $this->_conn->fetchAll($sql);
                    
                    if ( $freeSongs[0]['myxer_tag'] != '' ){
                        $this->_viewData['message'] =  'To download ringtone, please send the following text message code:
                                                    '. $freeSongs[0]['myxer_tag'] .' to 69937
                                                    from your mobile phone, and then follow the instructions.
                                                    Standard text messaging fees may be applied by your carrier.
                                                    NOTE: currently, this feature works only in the U.S., 
                                                    and requires that your mobile phone must have web browsing capability. 
                                                    Please stay tuned for future changes ';
                    }else{
                        $this->_viewData['message'] = 'Sorry code doesnt exist.';
                    }
                    //  Free Song. Render the download link via myxer code
                    
                    
                    $this->_viewData['via_myxer_Code'] = TRUE;
                }

                if(count($freeSongs) > 0){
                    $songId = $freeSongs[0]['id'];
                    $this->get_song_rating($songId );

                    $this->_viewData['freeSongs'] = $freeSongs;
                    $this->_viewData['file_path'] = 'Joke'.$id.substr($freeSongs[0]['path'],strpos($freeSongs[0]['path'],"."),strlen($freeSongs[0]['path']));
                    $this->_viewData['file_id'] = $freeSongs[0]['id'];

                }else
                    $this->_viewData['message'] = 'You can not download this song';
            }
                //echo '<pre>'; print_r( $freeSongs );die;
            if ($type == 1){
                $sql = "select ringtones.* 
                    from ringtones 
                    INNER JOIN `cartitems` ON cartitems.song_id = ringtones.id  
                    where ringtones.id =". $id . " and (ringtones.type='0' or cartitems.status='1') 
                    LIMIT 1";
                
                
		$freering = $this->_conn->fetchAll($sql);

                if (count($freering) > 0){

                    $songId = $freering[0]['id'];
                    $typer  = $freering[0]['type'];
                    
                    $this->_viewData['freering'] = $freering;
                    $this->_viewData['file_path'] = 'Ring'.$id.substr($freering[0]['ringtone'],strpos($freering[0]['ringtone'],"."),strlen($freering[0]['ringtone']));
                    $this->_viewData['file_id'] = $freering[0]['id'];
                    $this->_viewData['message'] = '';
                    $this->_viewData['types'] = '11';
                }else
                    $this->_viewData['message'] = 'Sorry. You can not send this ringtone';
            }
        }
        
        if ($char == 'result'){
            $this->data = $request->request->get('user');
            if (!empty($this->data)){
                $phone = $this->data['mobilephone'];
		$carr_id = $this->data['carrier'];
            }

            //$temp = $this->Cartitem->query("select * from carriers where id=".$carr_id);
            $temp = $em->getRepository('YxBundle:Carriers')->findById( $carr_id );
            
            if ( $temp )
                $carr = $temp[0]->getCarriername();
            else
                $carr = '';
            
            $result = $this->sendfile($phone,$carr,$_POST['file']['path'],$_POST['typ'],$id);
            
            if($result){
                $sql = "update cartitems set status='2' where song_id =".$id." and user_id = ".$user_id;  
                $tmp = $this->_conn->query($sql);

		$this->_viewData['message'] = 'The message was successfully sent. File ID - '.$result;
		$this->_viewData['linkback'] = '/users/';
            }else{
                $this->_viewData['linkback'] = $_SERVER['HTTP_REFERER'];
		$this->_viewData['message'] = 'Error at sending. Check up correctness of your number and carrier';
            }
        }

        return $this->render('YxBundle:Users:send.html.php', $this->_viewData);
    }


    
    /**
     * @Route("/users")
     * @Route("/users/")
     * @Route("/users/index")
     * @Route("/users/index/")
     * @Route("/users/welcome/{char}/{char2}")
     * Landing page after user loggs in
     * @param type $char
     * @param type $char2
     * @return type 
     */
    public function indexAction( $char=null, $char2 = null ) {
        if (!$this->session_check())
            return $this->redirect($this->generateUrl('user_login'), 302);

        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        
        $user_id = $this->_session->get('Users.userid');
        if (count($_POST) > 0){
            for ($i = 0; $i < count($_POST['boxdel_']); $i++) {
                $sql = "delete from cartitems WHERE song_id = '" . $_POST['boxdel_'][$i] . "' AND user_id = '" . $user_id . "'";
                $this->Cartitem->query($sql);
            }
        }

        if ($char == 'download' && $char2 != null) {

            $str = explode(',', $char2);

            $sql = "update cartitems set statuspc = '2' WHERE song_id = '" . $str[1] . "' AND user_id = '" . $user_id . "'";
            $this->_conn->query( $sql );
            
            $sql = "update songs set stat_pc = stat_pc+1 where id=" . $str[1];
            //$this->_conn->query($sql);
            
            if ($str[0] != '') {

                $tmp = $this->_conn->fetchAll("select * from songs where id=" . $str[1]);
                $tmp = $tmp[0];
                if ($tmp['paid'] == 'Y'){
                    $sql = "insert into statistic set gdate='" . date("Y-m-d") . "',date='" . date("Y-m") . "', id_user=" . $user_id . ",result='pc',type='pcpj',time=" . time();
                    //$this->_conn->query( $sql );
                }else {
                    $sql = "insert into statistic set gdate='" . date("Y-m-d") . "',date='" . date("Y-m") . "', id_user=" . $user_id . ",result='pc',type='pcfj',time=" . time();
                    //$this->_conn->query( $sql );
                }

                $filedownload = pathinfo($str[0]);

                if (strtolower($filedownload['extension']) == 'wma' or strtolower($filedownload['extension']) == 'wmv') {
                    $filename = pathinfo($tmp['or_file']);
                    $basename = substr($tmp['or_file'], 0, strlen($tmp['or_file']) - strlen($filename['extension']) - 1);

                    $this->download('drm_' . $str[0], $basename . '.' . $filedownload['extension'], 'no');
                    //echo '<pre>'; print_r( $tmp );die;
                }
                $this->download($str[0], '', 'no');
            }
            $str = '';
        }
        
        $findChar = strpos($char, '&');
        
        if ($findChar == true) {
            $str = explode('&', $char);
            if ($str[0] == 'singer') {
                $condition = "Song.singer_id =" . $str[1] . ' ';
            }
            if ($str[0] == 'year') {
                $condition = "Song.year =" . $str[1] . ' ';
            }
            if ($str[0] == 'genre') {
                $condition = "Song.genre_id =" . $str[1] . ' ';
            }
            if ($str[0] == 'more') {
                $this->morelimit = '20';
            }
        } else {
            if ($char == null) {
                $condition = "";
            } else {
                $condition = "Song.composition like '" . $char . "%'";
            }
            $loginuserEmail = $this->_session->get('Users.id');
            if ( ! $loginuserEmail ) {
                $this->get('session')->getFlashBag()->add( 'notice', 'Please Login.');
                $this->redirect('/users/login');
            }
        }


        $condition = "Cartitem.user_id='" . $user_id . "'"; //AND Cartitem.status!='0'";
        
        //list($order, $limit, $page) = $this->Pagination->init($condition . " AND Cartitem.status!='0' AND Song.id != NULL", null, array('modelClass' => 'Cartitem'));
        //$this->Pagination->init(null);
        //$condition  =  $condition . "group by Album.aname";
        
        $limit = '5';
        
        $loginuserEmail = $this->_session->get('Users.id');
        $displayName = $this->_session->get('Users.name');
        $this->_viewData['displayName'] = $displayName;
        
        if($loginuserEmail==""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        //$freeSongs  = $this->Song->findAll($condition,null,null,$limit,$page,0);
        ///// ringtones
        $sql = "select ringtones.*,ringtonecategories.title as catname, cartitems.id as cart_id from `ringtones` 
            INNER JOIN cartitems ON `cartitems`.`song_id` = `ringtones`.`id`
            INNER JOIN ringtonecategories ON `ringtonecategories`.`id` = `ringtones`.`category`
            WHERE cartitems.user_id=" . $user_id . " AND cartitems.status='1' and cartitems.statuspc<>'1' and cartitems.type='r'";

        $pendingringtone = $this->_conn->fetchAll($sql);

        //Peanding jokes
        $sql = "select Song.*,Genre.gname,Cartitem.created,Cartitem.id as cart_id,Cartitem.status,Cartitem.statuspc from `cartitems` AS `Cartitem`
  INNER JOIN songs as Song  ON `Cartitem`.`song_id` = `Song`.`id` 
  INNER JOIN `genres` AS `Genre` ON Song.genre_id = Genre.id
  WHERE " . $condition . " AND ((Cartitem.status='1')or(Cartitem.statuspc='1'))  and  Cartitem.type<>'r'
  LIMIT " . $limit;
        
        //die;

        $pendingSongs = $this->_conn->fetchAll($sql);
        

        //	Initialize pending songs name list
        $pendingSongArr = array();

        foreach ($pendingSongs as $k => $v) {
            $songId = $v['id'];
            $this->get_song_rating($songId);
            if (!($pos = strrpos($v['drm'], '.mp3')))
                $pendingSongArr[] = $v['drm'];
        }

        //	set pending songs list
        $this->_viewData['pendingSongArr'] = $pendingSongArr;
        
        // Purchased songs
        $sql = "select Song.*,Genre.gname,Cartitem.created,Cartitem.id as cart_id,Cartitem.status,Cartitem.statuspc from `cartitems` AS `Cartitem`
  INNER JOIN songs as Song  ON `Cartitem`.`song_id` = `Song`.`id` 
  INNER JOIN `genres` AS `Genre` ON Song.genre_id = Genre.id
  WHERE " . $condition . " AND ((Cartitem.status='2')or(Cartitem.statuspc='2')) and  Cartitem.type<>'r'
  LIMIT " . $limit;

        $freeSongs = $this->_conn->fetchAll($sql);
        
        //echo '<pre>'; print_r( $freeSongs );die;
        //$freeSongs = $this->Cartitem->findAll($condition, Null, null, $limit,$page, 2);
        //pr ($freeSongs);
        foreach ($freeSongs as $k => $v) {
            $songId = $v['id'];
            $this->get_song_rating($songId);
        }
        
        //  Playlist section
        $items = $em->getRepository('YxBundle:Playlists')->findByUserId( $user_id );
        
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
        
        $this->_viewData['playlist']    = $playlist;
        
        //$this->User->getPurchasedSomgs();
        //pr($this->songRating);
        //fecho($this->morelimit);
        $this->_viewData['songRating'] = $this->songRating;
        
        $this->_viewData['pendingSongs'] = $pendingSongs;
        $this->_viewData['freeSongs'] = $freeSongs;
        $this->_viewData['pendingringtone'] = $pendingringtone;

        //$this->_viewData['limit'] = $this->morelimit;
        $this->_viewData['recCount'] = count($freeSongs);
        
        return $this->render('YxBundle:Users:index.html.php', $this->_viewData);
    }

    /**
     * @Route("/users/login")
     * @Route("/users/login/")
     * User login
     * @return type 
     */
    public function loginAction() {
        //  Do Init
        $loggedIn = '';
        $displayName = '';
        
        $this->_viewData = array(
            'error' => FALSE,
            'ref' => getenv("HTTP_REFERER"),
            'foo' => 'Neeraj'
        );

        $session = $this->getRequest()->getSession();

        if (isset($_SERVER['HTTP_REFERER'])) {
            preg_match('/\/users\/search/', $_SERVER['HTTP_REFERER'], $matches);

            if ($matches) {
                $session->set('Redirect.url', $_SERVER['HTTP_REFERER']);
            }
        }

        // If a user has submitted form data:
        $request = $this->getRequest(); //->getMethod();

        if ($request->getMethod() == 'POST') {
            $this->data = $request->request->get('data');

            $em = $this->get('doctrine')->getEntityManager();
            $userinfo = $em->getRepository('YxBundle:Users')->findByEmail($this->data['User']['email']);

            // Now compare the form-submitted password with the one in the database.

            if ($userinfo) {
                $userinfo = current($userinfo);

                if ($userinfo->getPassword() == $this->data['User']['password'] && $userinfo->getStatus() == 'A') {

                    $session->set('Users.id', $userinfo->getEmail());
                    $session->set('Users.name', $userinfo->getFirstname());
                    $session->set('Users.userid', $userinfo->getId());

                    $loggedIn = TRUE;
                    $displayName = $userinfo->getFirstname();
                    
                    $redirectUrl = $session->get('Redirect.url');

                    if ($redirectUrl != '') {
                        return $this->redirect("/users");
                        preg_match('/\/users\/search/', $redirectUrl, $matches);

                        if ($matches) {
                            $redirectUrl = $redirectUrl;
                        } else {
                            $redirectUrl = " http://" . $_SERVER['HTTP_HOST'] . $redirectUrl;
                        }

                        $session->remove('Redirect.url');
                        
                        $this->get('session')->getFlashBag()->add( 'notice', 'Successfully Logged in.');
                        return $this->redirect($redirectUrl);
                        //$this->redirect($redirectUrl);
                    } else {
                        return $this->redirect("/users");
                        //echo '<pre>'; print_r( $_POST );die;
                        //if ($_POST['ref'] != '' && ereg("\/users\/login\/",$_POST['ref']))
                        preg_match('/users\/login/', $_POST['ref'], $matches);
                        //echo '<pre>'; print_r( $matches  );die;
                        if ($_POST['ref'] != '' && !$matches) {
                            $this->get('session')->getFlashBag()->add( 'notice', 'Successfully Logged in.');
                            return $this->redirect($_POST['ref']);
                        } else {
                            $this->get('session')->getFlashBag()->add( 'notice', 'Successfully Logged in.');
                            return $this->redirect("/users");
                        }
                    }
                } else {
                    $this->_viewData['error'] = TRUE;
                }
            } else {
                $this->_viewData['error'] = TRUE;
            }
        }

        $this->_viewData['loggedIn'] = $loggedIn;
        $this->_viewData['displayName'] = $displayName;
        
        return $this->render('YxBundle:Users:login.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/users/logout")
     * @Route("/users/logout/")
     * User logout
     * @return type 
     */
    public function logoutAction(){
        if (!$this->session_check())
            return $this->redirect($this->generateUrl('user_login'), 302);
        
        $this->_session->clear();
        
        $this->get('session')->getFlashBag()->add( 'notice', 'Successfully Logged out.');
        return $this->redirect('/');
    }
    
   /**
     * @Route("/users/song_category1")
     * @Route("/users/song_category1/")
     * Show jokes category
     * @return type 
     */
    public function song_category1Action(){
   
        
    $this->_conn = $this->get('database_connection');
        
 
       $term = 'long_jokes';
       $this->_conn->query("update catmemory set category = '".$term."' where id=1"); 
   
       $sql = "select Song.*,Genre.gname,Cartitem.created,Cartitem.id as cart_id,Cartitem.status,Cartitem.statuspc from `cartitems` AS `Cartitem`
  INNER JOIN songs as Song  ON `Cartitem`.`song_id` = `Song`.`id` 
  INNER JOIN `genres` AS `Genre` ON Song.genre_id = Genre.id";
        
        //die;

        $pendingSongs = $this->_conn->fetchAll($sql);
        
        $query = "SELECT Genre.gname, Genre.id, Genre.image
		FROM `genres` AS `Genre` "; 
        $results = $this->_conn->fetchAll($query);
   
        
        return $this->render('YxBundle:Users:song_category1.html.php', array(
                'pendingSongs'         => $pendingSongs,  
                'results'             => $results,
            ));
    }
    
    /**
     * @Route("/users/search")
     * @Route("/users/search/")
     * @Route("/users/search/{char}")
     * @Route("/users/search/{char}/")
     * Search jokes on various conditions
     * @param type $char
     * @return type 
     */
    public function searchAction($char = null){
        
        // Initialize variable
        $conditions_r = '';
        $condition = '';
        $ringtone = array();
        $freeSongs = array();
        $paidSongs = array();
        
        $extraParam = array();
        $request = $this->getRequest();

        if($char==null){
                $condition="";
        }else{
                $condition="Song.composition like '". trim($char, '/') ."%'" ;
                //$extraParam['char'] = $request->query->get('char');
        }
        
        $this->_session = $this->getRequest()->getSession();

        $loginuserEmail = $this->_session->get('Users.id');
        $displayName = $this->_session->get('Users.name');

        $this->_viewData['displayName'] = $displayName;
        
        if($loginuserEmail==""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        $this->_conn = $this->get('database_connection');

        $data = $request->request->all();
        
        if ( ! $data ){
            $data = $request->query->all();
        }
        
        //  Init pagination.
        $this->_viewData['base_url'] = '/users/search' . ( is_null($char) ? '' : '/' . $char );

        $page = $request->query->get('page');
        $page = $page ? $page : 1;
        $limit = 10;
        $midrange = 7;
        $offset = ($page - 1) * $limit;
        
        if ( !empty( $data['what']) && $data['what'] == 'ringtone'){
            if ( ! isset( $data['searchkeyworld']) )
                $data['searchkeyworld'] = '';
            
            $conditions="";
            $conditions .="Ringtone.status = '1' AND Ringtone.title LIKE '". $data['searchkeyworld']."%'";
                
            $extraParam['what'] = $data['what'];
            $extraParam['searchkeyworld'] = $data['searchkeyworld'];
            
            $limitClause = " Limit $offset, $limit";

            $sql = "Select count(Ringtone.id) as num from ringtones as Ringtone WHERE " . $conditions;
            $items = $this->_conn->fetchAll( $sql );//$em->getRepository('YxBundle:Users')->findAll();

            $itemsCount = $items[0]['num'];
                    
            $sql = "SELECT Ringtone.*
                    FROM `ringtones` AS `Ringtone`
                    WHERE $conditions 
                    $limitClause
                    ";

            $ringtone = $this->_conn->fetchAll($sql);

            foreach($ringtone as $k => $v){
                    $jokeId = $v['id'];
                    $this->get_song_rating($jokeId, 3);
            }

            $this->_viewData['songRating'] = $this->songRating;
            $this->_viewData['ringtones'] = $ringtone;

            $paginator = new \Front\YxBundle\Helper\Paginator($itemsCount, $page , $limit, $midrange);
            $this->_viewData['paginator_r'] = $paginator;

            $this->_viewData['extraParam'] = $extraParam;
            
            return $this->render('YxBundle:Users:search_ringtone.html.php', $this->_viewData);
        }else{
                
                if ( isset( $data['what']) ){
                    if ( ! isset( $data['searchkeyworld']) )
                        $data['searchkeyworld'] = '';
                    
                    $extraParam['what'] = $data['what'];
                    $extraParam['searchkeyworld'] = $data['searchkeyworld'];
                        if($data['what']=='all'){
                                $condition=" (Singer.sname like '".$data['searchkeyworld']."%' or Album.aname like '".$data['searchkeyworld']."%' or Song.composition like '".$data['searchkeyworld']."%' )" ;
                                $conditions_r="Ringtone.status = '1' AND ( Ringtone.title LIKE '". $data['searchkeyworld']."%' or Ringtone.category LIKE '%". $data['searchkeyworld']."%')";
                        }

                        if($data['what']=='comp'){
                                $condition="Song.composition like '".$data['searchkeyworld']."%'" ;
                                //$conditions_r="Ringtone.status = '1' AND Ringtone.title LIKE '%". $_POST['searchkeyworld']."%'";
                        }
                        if($data['what']=='category'){
                                $condition="Genre.gname like '".$data['searchkeyworld']."%'" ;
                                $conditions_r="Ringtone.status = '1' AND Ringtone.category LIKE '". $data['searchkeyworld']."%'";
                        }
                        if($data['what']=='singer'){
                                $condition="Singer.sname like '".$data['searchkeyworld']."%'" ;
                        }
                        if($data['what']=='album'){
                                $condition="Album.aname like '".$data['searchkeyworld']."%'" ;
                        }
                }
                //ringtones
                if (strlen($conditions_r)>0){
                    
                    //  Init pagination.
                    if ( isset ( $data['page_ringtone']) ){
                        $limitClause = " Limit $offset, $limit";
                        $pageR = $page;
                    }
                        
                    else{
                        $pageR = 0;
                        $limitClause = " Limit 0, $limit";
                    }
                        
                    //$limitClause = " Limit $offset, $limit";
                    
                    $sql = "Select count(Ringtone.id) as num from ringtones as Ringtone WHERE " . $conditions_r;
                    $items = $this->_conn->fetchAll( $sql );//$em->getRepository('YxBundle:Users')->findAll();

                    $itemsCount = $items[0]['num'];
        
                    $sql = "SELECT Ringtone.*
                        FROM `ringtones` AS `Ringtone`
                        WHERE $conditions_r  
                        $limitClause 
                        ";
                        $ringtone = $this->_conn->fetchAll($sql);
                        foreach($ringtone as $k => $v){
                                $jokeId = $v['id'];
                                $this->get_song_rating($jokeId, 3);
                        }
                        
                        $extraParamR = $extraParam;
                        $extraParamR['page_ringtone'] = TRUE;
                        
                        $paginator = new \Front\YxBundle\Helper\Paginator($itemsCount, $pageR , $limit, $midrange);
                        
                        $this->_viewData['paginator_r'] = $paginator;
                        $this->_viewData['extraParamR'] = $extraParamR;
                }
                
                if ( $condition != '' )
                    $where = $condition . "AND  Song.paid='N'";
                else
                    $where = "Song.paid='N'";
                
                //  Free Jokes
                $sql = "SELECT Song.*
                        FROM `songs` AS `Song`
                        LEFT JOIN genres as Genre ON Song.genre_id = Genre.id
                        LEFT JOIN singers as Singer ON Song.singer_id = Singer.id
                        LEFT JOIN albums as Album ON Song.album_id = Album.id
                        WHERE $where 
                        ";

                $freeSongs = $this->_conn->fetchAll($sql);
                
                
                if (!is_array($freeSongs))
                    $freeSongs=array();

                foreach($freeSongs as $k => $v){
                        $songId = $v['id'];
                        $this->get_song_rating($songId);
                }
                
                $where = '';
                if ( $condition != '' )
                    $where = 'WHERE ' . $condition ;
                
                //  Paid Jokes
                
                //  Init pagination.
                if ( isset ( $data['page_joke']) )
                    $limitClause = " Limit $offset, $limit";
                else{
                        $page = 0;
                        $limitClause = " Limit 0, $limit";
                    }
                    
                $sql = "Select count(Song.id) as num from songs as Song 
                        LEFT JOIN genres as Genre ON Song.genre_id = Genre.id
                        LEFT JOIN singers as Singer ON Song.singer_id = Singer.id
                        LEFT JOIN albums as Album ON Song.album_id = Album.id
                        " . $where;
                $items = $this->_conn->fetchAll( $sql );//$em->getRepository('YxBundle:Users')->findAll();

                $itemsCount = $items[0]['num'];
                    
                $sql = "SELECT Song.*
                        FROM `songs` AS `Song`
                        LEFT JOIN genres as Genre ON Song.genre_id = Genre.id
                        LEFT JOIN singers as Singer ON Song.singer_id = Singer.id
                        LEFT JOIN albums as Album ON Song.album_id = Album.id
                        $where
                        $limitClause
                        ";

                // paid song
                $paidSongs = $this->_conn->fetchAll($sql);
                
                if (!is_array($paidSongs))
                    $paidSongs=array();

                foreach($paidSongs as $k => $v){
                        $songId = $v['id'];
                        $this->get_song_rating($songId);
                }

                $extraParam['page_joke'] = TRUE;
                $paginator = new \Front\YxBundle\Helper\Paginator($itemsCount, $page , $limit, $midrange);
                $this->_viewData['paginator_p'] = $paginator;
        }
        
        $this->_viewData['songRating'] = $this->songRating;
        $this->_viewData['freeSongs'] = $freeSongs;
        $this->_viewData['paidSongs'] = $paidSongs;
        $this->_viewData['ringtones'] = $ringtone;
        
        $this->_viewData['extraParam'] = $extraParam;
                
        return $this->render('YxBundle:Users:search.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/users/myprofile")
     * @Route("/users/myprofile/")
     * User profile for the logged in user
     * @return type 
     */
    public function profileAction(){
        if (!$this->session_check())
            return $this->redirect($this->generateUrl('user_login'), 302);
        
        $user_id = $this->_session->get('Users.userid');

        $displayName = $this->_session->get('Users.name');
        
        $this->_viewData['displayName'] = $displayName;
        
        if($user_id == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        $this->_viewData['loggedIn'] = TRUE;
        
        $condition = 'WHERE id = '.$user_id;
        
        $this->_viewData['id'] = $user_id;
        
        $em = $this->get('doctrine')->getEntityManager();
        $user = $em->getRepository('YxBundle:Users')->find($user_id);//getLatestPosts();
        
        $this->_viewData['users'] = $user;
        
        //  Get Countries
        $country = $em->getRepository('YxBundle:Countries')->findAll();
        $this->_viewData['country'] = $country;
        
        //  Get carriers
        $carriers = $em->getRepository('YxBundle:Carriers')->findAll();
        $this->_viewData['carriers'] = $carriers;
        
        $form   = $this->createForm(new UserType(), $user);

        // Altering the input field name attribute
        $formView = $form->createView();
        
        $this->_viewData['form']   = $formView;

        $request = $this->getRequest();
        
        if ($request->getMethod() == 'POST'){
            $form->bindRequest($request);
            
            $err = $form->getErrors();
            //echo '<pre>'; print_r( $err );die;
            if ($form->isValid()) {
                //echo '<pre>'; print_r( $user );die;
                
                $user->setModified( new \DateTime ); 
                    
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($user);
                $em->flush();
                
                $this->get('session')->setFlash('notice', 'User is updated.!');
                // perform some action, such as saving the task to the database
                return $this->redirect($this->generateUrl('user_profile'));
            }
        }
        
        if (!empty($this->data)){
                $this->User->save($this->data);
                $this->set('msg', true);
                $this->redirect('/users/welcome');

        }
        return $this->render('YxBundle:Users:profile.html.php', $this->_viewData);
    }

    /**
     * @Route("/users/mybalance")
     * @Route("/users/mybalance/")
     * User balance for the logged in user
     * @return type 
     */
    public function mybalanceAction(){
        if (!$this->session_check())
            return $this->redirect($this->generateUrl('user_login'), 302);
        
        $user_id = $this->_session->get('Users.userid');

        $displayName = $this->_session->get('Users.name');
        
        $this->_viewData['displayName'] = $displayName;
        
        if($user_id == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        $condition = 'WHERE id = '.$user_id;
        
        $this->_viewData['id'] = $user_id;
        
        //$em = $this->get('doctrine')->getEntityManager();
        //$user = $em->getRepository('YxBundle:Users')->find($user_id);//getLatestPosts();
        
        $sql = "select users.*,userbalances.* 
                from users 
                inner join userbalances on  users.id = userbalances.user_id  
                where  users.id=".$user_id;

        $users = $this->get('database_connection')->fetchAll($sql);
        $this->_viewData['users'] = $users;
        //echo '<pre>'; print_r( $users);die;
        return $this->render('YxBundle:Users:balance.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/users/register")
     * @Route("/users/register/")
     * // Function to register on the site. 
     */
    public function registerAction(){

        $em = $this->get('doctrine')->getEntityManager();
        $user = new Users();
        
        $this->_viewData['users'] = $user;
        
        //  Get Countries
        $country = $em->getRepository('YxBundle:Countries')->findAll();
        $this->_viewData['country'] = $country;
        
        //  Get carriers
        $carriers = $em->getRepository('YxBundle:Carriers')->findAll();
        $this->_viewData['carriers'] = $carriers;
        
        $form   = $this->createForm(new UserType(), $user);
        $formView = $form->createView();
        
        $request = $this->getRequest();
        
        if ($request->getMethod() == 'POST'){
            $form->bindRequest($request);
            
            // Altering the input field name attribute
            $formView = $form->createView();
            
            $this->data = $request->request->get('user');
            $cor = 3;
            
            if ($form->isValid()){
                if (!empty($this->data) && $cor == 3){
                    // check for existing email id
                    $userinfo = $em->getRepository('YxBundle:Users')->findByEmail( $this->data['email'] );
                    
                    if (!$userinfo){
                        
                        // Generate an activation key to be sent with the mail.
                        $activationnumber = md5(rand());
                        
                        
                        
                        $user->setActivationkey( $activationnumber );
                        
                        $bday = $request->request->get('bYear')."-".$request->request->get('bMonth')."-".$request->request->get('bDay');
                        $d = new \DateTime( $bday );
                        
                        
                        $user->setBirthdate( $d );
                        
                        $user->setCarrier('');
//                        $user->setCountJoke('');
//                        $user->setCountRing('');
//                        $user->setIdSubscript('');
                        
                        $em->persist($user);
                        $em->flush();
                        
                        if( $user->getId() ){
                            //  Send mail
                            $to = $this->data['email'];
                            $toName = $this->data['firstname'];

                            $from = 'alert@yaxmobi.com';
                            $fromName = 'Account Confirmation';
                            
                            //$mailFrom = $this->container->getParameter('px_mail_from');//20;
                            $activationnumber = '12345678';
                            $link = MY_SITE_URL . "users/confirm/".$activationnumber."/".$this->data['email'];
                            
                            $msg = "Dear ". $toName ."\n\n";
                            $msg .= "Thanks for registering on Yaxmobi.com.". "\n\n";
                            $msg .= "You need to activate your account by clicking the link provided below"."\n";
                            $msg .= "<a href='". $link ."' target='_blank'>Click here to activate </a>"."\n\n";
                            $msg .= "Thanks, \n\n Support Team\n Yaxmobi.com \n";
                            
                            $msg = nl2br( $msg );
                            
                            // Subject of mail
                            $subject = "Your Yaxmobi account confirmation";
                            
                            $message = \Swift_Message::newInstance()
                                ->setSubject( $subject )
                                ->setFrom( array($from => $fromName))
                                ->setTo( array($to => $toName)  )
                                ->setBody( $msg );
                            
                            $this->get('mailer')->send($message);
                            //$this->get('session')->setFlash('notice', 'Thank you for contacting us!');
                            //$errMessage = 'Your message has been succefully sent.';

                            return $this->redirect('/users/congratulations/');
                        }
                    }else{
                            $errMessage = "This email already exists.";
                    }

                    $this->_viewData['errMessage'] = $errMessage;
                }
            }
        }

        $this->_viewData['form']   = $formView;
        
        if(count($_POST)>0){
            $session = $this->getRequest()->getSession();
            //echo '<pre>'; print_r( $_SESSION );die;
            /*if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] == $_POST['captcha']){
                    $cor = 3;
            }else{
                    $cor = 0;
                    $this->_viewData['capch'] = 'Enter correct captcha';
            }*/
        }
        //unset($_SESSION['captcha_keystring']);

        return $this->render('YxBundle:Users:register.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/users/confirm")
     * @Route("/users/confirm/")
     * @Route("/users/confirm/{key}")
     * @param type $key
     * @return type 
     */
    public function confirmAction($key = null){
        $key = explode('/', $key);

        if ( count($key) < 2 ){
            $this->_viewData['msg'] = 'We are sorry. This activation key doesnot exist';
            return $this->render('YxBundle:Users:confirm.html.php', $this->_viewData);
        }
        
        /*   print 'ok'; */
	/*   exit; */
	$addQuery = "User.email = '".$key[1]."' and User.activationkey='".$key[0]."' and User.status != 'A'";
        
        $sql = "select User.*
            from users as User
        WHERE ". $addQuery ."
        ";

        $this->_conn = $this->get('database_connection');
        $user = $this->_conn->fetchAll($sql);
        
        if( $user ){
            $sql = "Update users as User SET `status` = 'A' WHERE User.id = '". $user[0]['id']."'";
                
            $this->_conn->query( $sql );

            $userbalance = new \Front\YxBundle\Entity\Userbalances();

            $userbalance->setUserId( $user[0]['id'] );
            $userbalance->setAmount(0);

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist( $userbalance );
            $em->flush();

            $this->_viewData['msg'] = 'Congratulations. You have successfully activated your account.';
        }else{
            $this->_viewData['msg'] = 'Activation key doesnot exist or has been expired.';
        }
        
        return $this->render('YxBundle:Users:confirm.html.php', $this->_viewData);
    }


    /**
     * @Route("/users/congratulations")
     * @Route("/users/congratulations/")
     * Function to render congratulations page
     * @return type 
     */
    public function congratulationsAction (){
        $this->_session = $this->getRequest()->getSession();
        //echo "<pre>"; print_r( $session );die;
        
        $user_id = $this->_session->get('Users.userid');

        $displayName = $this->_session->get('Users.name');
        
        $this->_viewData['displayName'] = $displayName;
        
        if($user_id == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        return $this->render('YxBundle:Users:congratulation.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/users/benef")
     * @Route("/users/benef/")
     * Function to render benifit page
     * @return type 
     */
    public function benefAction(){
        return $this->render('YxBundle:Users:benefit.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/users/support")
     * @Route("/users/support/")
     * Function to render support page
     * @return type 
     */
    public function supportAction(){
        
        $this->_session = $this->getRequest()->getSession();
        //echo "<pre>"; print_r( $session );die;
        
        $user_id = $this->_session->get('Users.userid');

        $displayName = $this->_session->get('Users.name');
        
        $this->_viewData['displayName'] = $displayName;
        
        if($user_id == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        $errMessage = '';
        
        $form = $this->createForm(new EnquiryType());
    
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            
            if ($form->isValid()) {
                $this->data = $request->request->get('contact');
                
                $to = 'neerajbg@gmail.com';//SUPPORT_EMAIL;
                $toName = SUPPORT_NAME;
                
                $fromName = $this->data['name'];
                $fromEmail = $this->data['email'];
                
                $message = \Swift_Message::newInstance()
                    ->setSubject( $this->data['subject'] )
                    ->setFrom( array($fromEmail => $fromName))
                    ->setTo( array($to => $toName)  )
                    ->setBody( $this->data['body'] );
                $this->get('mailer')->send($message);

                $this->get('session')->setFlash('notice', 'Thank you for contacting us!');

                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page
                return $this->redirect($this->generateUrl('user_support'));
            }
        }
        
        $this->_viewData['form'] = $form->createView();
        
        return $this->render('YxBundle:Users:support.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/users/faq")
     * @Route("/users/faq/")
     * Function to render faq page
     * @return type 
     */
    public function faqAction(){
        $this->_session = $this->getRequest()->getSession();
        //echo "<pre>"; print_r( $session );die;
        
        $user_id = $this->_session->get('Users.userid');

        $displayName = $this->_session->get('Users.name');
        
        $this->_viewData['displayName'] = $displayName;
        
        if($user_id == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;

        return $this->render('YxBundle:Users:faq.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/users/credits")
     * @Route("/users/credits/")
     * Function to render credit page
     * @return type 
     */
    public function creditsAction(){
        $this->_session = $this->getRequest()->getSession();
        //echo "<pre>"; print_r( $session );die;
        
        $user_id = $this->_session->get('Users.userid');

        $displayName = $this->_session->get('Users.name');
        
        $this->_viewData['displayName'] = $displayName;
        
        if($user_id == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;

        return $this->render('YxBundle:Users:credits.html.php', $this->_viewData);

    }
    
    /**
     * @Route("/users/license")
     * @Route("/users/license/")
     * @Route("/users/license/{id}")
     * @param type $id
     * @return type 
     */
    public function license($id = null){
        if (!$this->session_check())
            return $this->redirect($this->generateUrl('user_login'), 302);
        
        $user_id = $this->_session->get('Users.userid');

        $displayName = $this->_session->get('Users.name');
        
        $this->_viewData['displayName'] = $displayName;
        
        if($user_id == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        $this->_conn = $this->get('database_connection');
        
        //$id = '354';
        $sql = "SELECT license FROM license where iduser='". $user_id ."' and idfile='". $id ."' and license<>'' limit 1";
	//$id = '317';
        
        $license = $this->_conn->fetchAll( $sql );
        
        if ( $license )
            $text_license = $license[0]['license'];
	else 
            $text_license = '';

        $this->_viewData['license'] = $text_license;
        
        //$id = '317';
        $sql    = "select * from user_licenses where user_id=".$user_id." and song_id='".$id."' order by id desc limit 1";
        $mass   = $this->_conn->fetchAll( $sql );
        
        if ( $mass )
            $this->_viewData['user_licenses'] = $mass[0]['lic_md5'];
        else
            $this->_viewData['user_licenses'] = '';
        
        return $this->render('YxBundle:Users:license.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/users/balance")
     * @Route("/users/balance/")
     */
    public function balanceAction(){
        if (!$this->session_check())
            return $this->redirect($this->generateUrl('user_login'), 302);
        
        $user_id = $this->_session->get('Users.userid');
        $this->_viewData['user_id'] = $user_id;
        
        $displayName = $this->_session->get('Users.name');
        $this->_viewData['displayName'] = $displayName;
        
        if($user_id == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        $this->_conn = $this->get('database_connection');
        
        $itemNumber = $user_id;
	
        if(!empty($_POST['paynow']) && isset($_POST) && $_POST['paynow']==1){
            $request = $this->getRequest();
            
            $this->data = $request->request->get('data');
            $tempAmt = $this->data['useramount']['amount'];
            $tempAmt == '' ? $tempAmt = '10' : $tempAmt = $tempAmt;
            $this->data['useramount']['amount'] = $tempAmt;
            
            //echo "<pre>"; print_r($_POST);die();
            //$this->Useramount->save($this->data);
            
            //$this->_session->set('Useramount.paypalid', $this->Useramount->getLastInsertID());

            /*********/
            //$paypalUrl = "https://www.sandbox.paypal.com/cgi-bin/webscr"; // test server
            $paypalUrl = "https://www.paypal.com/cgi-bin/webscr"; // live paypal
            //$paypalId = 'webguruofindia@yahoo.com'; // test email id
            $paypalId = 'marlonjean72@yahoo.com'; //live email id

            echo "Redirecting to the payment gateway...";
        ?>
            <form name="Donation" action="https://www.paypal.com/cgi-bin/webscr" method="POST">
                <input type=hidden name="cmd" value="_xclick"> 
                <input type=hidden name="business" value="<?=$paypalId?>"> 
                <input type=hidden name="item_name" value="Top-up Balance"> 
                <input type=hidden name="item_number" value="<?=$itemNumber?>"> 
                <input type=hidden name="amount" value="<?=$tempAmt?>"> 
                <input type=hidden name="no_shipping" value="0"> 
                <input type="hidden" name="no_note" value="1"> 
                <input type=hidden name="return" value="http://www.yaxmobi.com/users/mybalance"> 
                <input type=hidden name="rm" value="2"> 
                <input type=hidden name="cancel_return" value="http://www.yaxmobi.com/users/cancelled"> 
                <input type="hidden" name="notify_url" value="http://www.yaxmobi.com/users/success"> 
                <input type=hidden name="currency_code" value="USD">
            </form>
            <script language='javascript'>document.Donation.submit()</script>
	<?php
			/*******************/
			//echo "I am here";  die;
	}
        return $this->render('YxBundle:Users:fill_balance.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/users/cancelled")
     * @Route("/users/cancelled/")
     * @return type 
     */
    public function cancelledAction(){
        if (!$this->session_check())
            return $this->redirect($this->generateUrl('user_login'), 302);
        
        $user_id = $this->_session->get('Users.userid');
        $this->_viewData['user_id'] = $user_id;
        
        $displayName = $this->_session->get('Users.name');
        $this->_viewData['displayName'] = $displayName;
        
        if($user_id == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        
        $postdata = "#####################Error occurred on " . date('d-m-Y H-i-s') . "##################\r\n" . $user_id;
        foreach ($_POST as $key=>$value) 
            $postdata.=$key."=".urlencode($value)."&";

        $file_name = 'cancel'.date('H-i-s').'.txt';
        
        $path = PAYMENT_LOG_PATH;
        
        
        $file_hendle = fopen($path . $file_name, "w ");
        
        fwrite($file_hendle,$postdata);
        fclose($file_hendle);
        
        $this->_session->remove('Useramount.paypalid');
        
        return $this->render('YxBundle:Users:cancelled.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/users/success")
     * @Route("/users/success/")
     * @return type 
     */
    public function successAction(){
        if (!$this->session_check())
            return $this->redirect($this->generateUrl('user_login'), 302);
        
        $user_id = $this->_session->get('Users.userid');
        $this->_viewData['user_id'] = $user_id;
        
        $displayName = $this->_session->get('Users.name');
        $this->_viewData['displayName'] = $displayName;
        
        if($user_id == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        $this->_viewData['errMessage'] = '';
        
        return $this->render('YxBundle:Users:success.html.php', $this->_viewData);
    }

    /**
     * @Route("/users/player")
     * @Route("/users/player/{songid}")
     * @Route("/users/player/{songid}/")
     * @Route("/users/player/{songid}/{folder}")
     * @Route("/users/player/{songid}/{folder}/")
     * @return type 
     */
    public function playerAction($songid = '',$folder=''){
        $paind = 0;
        if ($folder=='pending'){
            $paind = 1;
            $folder = '';
        }
        
        $this->_conn = $this->get('database_connection');
        $this->_session = $this->getRequest()->getSession();
        
        if ($folder == 'ring'){
            //$songid;
            if (trim($songid) != 'ticker_space.gif')
            {
                    $this->_session->set('Relatedjoke.myjokeid', $songid);
                    $this->_session->set('Relatedjoke.type', "ring");
            }
            $folder = '';
            $sql = "select * from ringtones where id=$songid";
            
            //$result = mysql_query($sql);
            //$object = mysql_fetch_array($result);
            
            $object = $this->_conn->fetchAll($sql);
            //echo '<pre>'; print_r( $object );die;
            $this->_viewData['songRec'] = current($object);
            $this->_viewData['type'] = 'ring';
            
            $songFile = $object[0]['prew_ringtone'];
            $this->_viewData['songFile'] = $songFile;

            $cat_id = $object[0]['category'];
            $sql = "select title from ringtonecategories where id=$cat_id";
            
            $object = $this->_conn->fetchAll($sql);
            
            $cat_name = $object[0]['title'];
            $this->_viewData['catName'] = $cat_name;
            
        }else{
            $folder = '';

            if (trim($songid) != 'ticker_space.gif'){
                $this->_session->set('Relatedjoke.myjokeid', $songid);
                $this->_session->set('Relatedjoke.type', "Joke");
            }
				

            // Update view times for song id
            $sql = "update songs SET view = (view+1) WHERE id = '". $songid ."'";
            $this->_conn->Query($sql);
	
            $sql = "Select Song.*, Singer.sname, Genre.gname from songs as Song
                    LEFT JOIN singers as Singer ON Song.singer_id = Singer.id
                    LEFT JOIN genres as Genre ON Song.genre_id = Genre.id
                    WHERE Song.id = '". $songid ."'
                ";
            $songRec = $this->_conn->fetchAll($sql);
            //echo '<pre>'; print_r( $songRec );die;
            
            $this->_viewData['songRec'] = $songRec;

            $songFile = "";
            if ( $songRec ){
                $sampleFile =  $songRec[0]['sample_file'];
                $sampleFile_b =  $songRec[0]['sample_file_before'];
                $mainFile =  $songRec[0]['path'];

                
                if ($folder != ''){

                    $file = WWW_ROOT . 'img/songs/' . $sampleFile;

                    if ( is_file($file) && ($_SERVER['HTTP_REFERER'] == 'http://www.yaxmobi.com/users/welcome' || $_SERVER['HTTP_REFERER'] == 'http://www.yaxmobi.com/users/send/form/'.$songid)){
							
                        $songFile = $folder . '/' . $sampleFile;
                    }else if ( is_file(WWW_ROOT . 'img/songs/' . $sampleFile_b) &&  $_SERVER['HTTP_REFERER'] != 'http://www.yaxmobi.com/users/welcome'){

                        $songFile = $sampleFile_b;
                    }else if ( is_file(WWW_ROOT . 'img/songs/' . $mainFile) ){

                        $songFile = '';
                    }else{

                        $songFile = "";
                    }

                }else{
                    $referrer = '';
                    if (isset($_SERVER['HTTP_REFERER']))
                        $referrer = $_SERVER['HTTP_REFERER'];

                    if ( is_file( WWW_ROOT . 'img/songs/' . $sampleFile ) &&  ($referrer == MY_SITE_URL . 'users/welcome' || $referrer == MY_SITE_URL . 'users/send/form/'.$songid || $paind)){
                        $songFile = $sampleFile;
                    }else if ( is_file(WWW_ROOT . 'img/songs/' . $sampleFile_b) &&  $referrer != MY_SITE_URL . 'users/welcome'){
                        $songFile = $sampleFile_b;
                    }else{
                        if(is_file(WWW_ROOT . 'img/songs/' . $sampleFile_b)) {
                            $songFile = $sampleFile_b;
                        } elseif(is_file(WWW_ROOT . 'img/songs/' . $sampleFile)) {
                            $songFile = $sampleFile;
                        } else {
                            $songFile = "";
							/*                  print 'ok4'; */
                        }
                    }
                }
            }

            $this->_viewData['songFile'] = $songFile;

            $path  = WWW_ROOT ."img/player/";
            $this->_viewData['path'] = $path;
        }
        return $this->render('YxBundle:Users:player.html.php', $this->_viewData);
    }
    
   
  
    /**
     * @Route("/users/player1")
     * @Route("/users/player1/{songid}")
     * @Route("/users/player1/{songid}/")
     * @Route("/users/player1/{songid}/{folder}")
     * @Route("/users/player1/{songid}/{folder}/")
     * @return type 
     */
    public function player1Action($songid = '',$folder=''){
        $paind = 0;
        if ($folder=='pending'){
            $paind = 1;
            $folder = '';
        }
 
        $this->_conn = $this->get('database_connection');
        $this->_session = $this->getRequest()->getSession();
        
        $q= "SELECT category from catmemory WHERE id=1 ";
        $cat = $this->_conn->fetchColumn($q);
        
        if ($folder == 'ring'){
            //$songid;
            if (trim($songid) != 'ticker_space.gif')
            {
                    $this->_session->set('Relatedjoke.myjokeid', $songid);
                    $this->_session->set('Relatedjoke.type', "ring");
            }
            $folder = '';
//            $sql = "select * from ringtones where id=$songid";
            
            //$result = mysql_query($sql);
            //$object = mysql_fetch_array($result);
            
            $object = $this->_conn->fetchAll($sql);
            //echo '<pre>'; print_r( $object );die;
            $this->_viewData['songRec'] = current($object);
            $this->_viewData['type'] = 'ring';
       

            $cat_id = $object[0]['category'];
            $sql = "select title from ringtonecategories where id=$cat_id";
            
            $object = $this->_conn->fetchAll($sql);
            
            $cat_name = $object[0]['title'];
            $this->_viewData['catName'] = $cat_name;
            
        }else{
            $folder = '';
            
            if (trim($songid) != 'ticker_space.gif'){
                $this->_session->set('Relatedjoke.myjokeid', $songid);
                $this->_session->set('Relatedjoke.type', "Joke");
            }
				

            // Update view times for song id
            $sql = "update songs SET view = (view+1) WHERE id = '". $songid ."'";
            $this->_conn->Query($sql);
            
                        
            if($cat == 'long_jokes' || $cat=='yo_mama' || $cat== 'videos' || $cat== 'cartoons' ){
  
             $q = "select Song.tag from songs as Song WHERE Song.id = $songid";   
             
             $sql = "Select Song.*, Singer.sname, Genre.gname from songs as Song
                    LEFT JOIN singers as Singer ON Song.singer_id = Singer.id
                    LEFT JOIN genres as Genre ON Song.genre_id = Genre.id
                    WHERE Song.id = '". $songid ."'
                ";
            $songRec = $this->_conn->fetchAll($sql);
            //echo '<pre>'; print_r( $songRec );die;
            
            $this->_viewData['songRec'] = $songRec;
     
            }
            
            if($cat == 'short_jokes' ){
             $q = "select Song.* from ringtones as Song WHERE Song.id = $songid";   
             $object = $this->_conn->fetchAll($q);
             $this->_viewData['songRec'] = current($object);

             $cat_id = $object[0]['category'];
             $sql = "select title from ringtonecategories where id=$cat_id";
             $object = $this->_conn->fetchAll($sql);
             $cat_name = $object[0]['title'];
             $this->_viewData['catName'] = $cat_name; 
            }
            
                $tag = $this->_conn->fetchAll($q);
    
                $jokeTag = $tag[0]['tag'];
              
                $temp = explode(',', $jokeTag);

                if (count($temp) > 0){
                    $jokeTag = '(';
                    $jokeTag1 = '';
                    foreach ($temp as $v){
                            $jokeTag1 .= " Song.tag like '%".trim($v)."%' ||";
                    }
                    $jokeTag1 = substr($jokeTag1,0,-2);
                    $jokeTag .= $jokeTag1 . ')';

                }
                
                if($cat == 'long_jokes' || $cat=='yomama' || $cat== 'videos' || $cat== 'cartoons' ){
                 $sql = "select `Song`.`composition` , `Song`.`id` from songs as Song WHERE ".$jokeTag;   
                }

                if($cat == 'short_jokes' ){
                 $sql = "select `Song`.* , `Song`.`id` from ringtones as Song WHERE ".$jokeTag;   
                }
         
                $this->_viewData['type'] = $cat;
                $audioJokes  = $this->_conn->fetchAll($sql);
          
                $this->_viewData["audioJokes"] = $audioJokes;
                
        }
        return $this->render('YxBundle:Users:player1.html.php', $this->_viewData);
    }
    
    //  Admin Section 
    
    /**
     * @Route("/admin")
     * @Route("/admin/")
     * @Route("/admins")
     * @Route("/admins/")
     * @Route("/admins/index")
     * @Route("/admins/index/")
     * @return type 
     */
    public function admin_indexAction(){
        if (! $this->session_checkadmin() )
            return $this->redirect($this->generateUrl('admin_login'), 302);

        return $this->render('YxBundle:Users:admin_index.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/users")
     * @Route("/admin/users/")
     * @return type 
     */
    public function admin_usersAction(){
        if (! $this->session_checkadmin() )
            return $this->redirect($this->generateUrl('admin_login'), 302);
        
        //  Do Init
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
        
        $order = ' Order By User.id';
        $limitClause = " Limit $offset, $limit";
        
        
        if( ! $request->query->get('char') ){
            $addQuery="";
        }else{
            $extraParam['char'] = $request->query->get('char');
            $addQuery=" WHERE User.firstname LIKE '".$request->query->get('char')."%'" ;
        }

        if(!empty($_POST['search']) && $_POST['search'] == 'search'){
            $addQuery .= "User.firstname LIKE '%". $_POST['searchkeyworld']."%'";
        }
        
        $sql = "Select User.*, FORMAT(IFNULL(userbalances.amount,0), 2) as amount , IFNULL(subscriptions.name,'') as name from users as User 
                LEFT JOIN userbalances ON User.id = userbalances.user_id
                LEFT JOIN subscriptions ON User.id_subscript = subscriptions.id
                " . $addQuery . $order . $limitClause ;
        $users = $this->_conn->fetchAll( $sql );
        $this->_viewData['users'] = $users;
        
        //  Get All user count
        $sql = "Select count(User.id) as num from users as User " . $addQuery;
        $items = $this->_conn->fetchAll( $sql );//$em->getRepository('YxBundle:Users')->findAll();

        $itemsCount = $items[0]['num'];
        
        $paginator = new \Front\YxBundle\Helper\Paginator($itemsCount, $page , $limit, $midrange);
        $this->_viewData['paginator'] = $paginator;
        
        $this->_viewData['extraParam'] = $extraParam;
        
        return $this->render('YxBundle:Users:admin_users.html.php', $this->_viewData);
    }
    
    
    /**
     * @Route("/admin/update_user")
     * @Route("/admin/update_user/")
     * @return type 
     */
    public function admin_updateAction(){
        if (! $this->session_checkadmin() )
            return $this->redirect($this->generateUrl('admin_login'), 302);
        
        //  Do Init
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        if( $request->request->get('num') && $request->request->get('id') ){
            if ( $request->request->get('num') > 0 ){
                $userBalance = $em->getRepository('YxBundle:Userbalances')->findByUserId( $request->request->get('id') );
                
                if ( $userBalance ){
                    $sql = "UPDATE userbalances SET amount = '". $request->request->get('num') ."'
                    WHERE user_id = '". $request->request->get('id') ."'";
                }else{
                    $sql = "INSERT INTO userbalances (amount,user_id) VALUES (
                        '". $request->request->get('num') ."',
                        '". $request->request->get('id') ."'    
                        )";
                }
                $this->_conn->query( $sql );
            }
        }
        
        if( $request->request->get('act') && $request->request->get('act') == 'update_status' ){
            $ids = explode(',', $request->request->get('ids'));
            
            foreach ( $ids as $userId ){
                if ( $userId != '' ){
                    $user = $em->getRepository('YxBundle:Users')->find($userId);
                    
                    $user->setStatus( $request->request->get('status') );
                    $em->persist($user);
                    $em->flush();
                }
            }
        }
        
        if( $request->request->get('act') && $request->request->get('act') == 'delete_user' ){
            $ids = explode(',', $request->request->get('ids'));
            
            foreach ( $ids as $userId ){
                if ( $userId != '' ){
                    $user = $em->getRepository('YxBundle:Users')->find($userId);
                    
                    $em->remove($user);
                    $em->flush();
                }
            }
        }
        
        echo 'User Updated.';
        return new \Symfony\Component\HttpFoundation\Response();
        
    }

    
    public function admin_logoutAction(){
        $this->session_checkadmin();
        
        $this->_session->remove('admin_id');
        
        $this->get('session')->getFlashBag()->add( 'notice', 'Successfully Logged out.');
        return $this->redirect('/admin/login');
    }
    
    public function admin_loginAction(){
        $this->_viewData['error'] = FALSE;
        $this->_viewData['left'] = false;
        
        // If a user has submitted form data:
        $request = $this->getRequest(); //->getMethod();

        if ($request->getMethod() == 'POST') {
            //$this->data = $request->request->get('data');
            
            //echo '<pre>'; print_r( $_POST);die;

            $em = $this->get('doctrine')->getEntityManager();
            $userinfo = $em->getRepository('YxBundle:Admins')->findByUsername($_POST['username']);

            // Now compare the form-submitted password with the one in the database.

            if ($userinfo) {
                $userinfo = current($userinfo);
                
                if ($userinfo->getPassword() == $_POST['password'] ) {
                    
                    $session = $this->getRequest()->getSession();

                    $session->set('admin_id', $userinfo->getEmail());
                    $session->set('adminid', $userinfo->getId());

                    $this->get('session')->getFlashBag()->add( 'notice', 'Successfully Logged in.');
                    return $this->redirect('/admins/');
                } else {
                    $this->_viewData['error'] = TRUE;
                }
            } else {
                $this->_viewData['error'] = TRUE;
            }
        }

        return $this->render('YxBundle:Users:admin_login.html.php', $this->_viewData);
        
        
        // If a user has submitted form data:
        if (!empty($this->data)){
            // First, let's see if there are any admin users in the database
            // with the username supplied by the user using the form:
            
            // Now compare the form-submitted password with the one in 
            // the database.
            if(!empty($userinfo['Admin']['password']) && $userinfo['Admin']['password'] == $this->data['Admin']['password']){
                // This means they were the same. We can now build some basic
                // session information to remember this user as 'logged-in'.
                $this->Session->write('admin_id', $userinfo['Admin']['email']);
                $this->Session->write('adminid', $userinfo['Admin']['id']);
                //$this->checkSession();

                $this->redirect('/'.CAKE_ADMIN.'/admins/');
            }else{
                $this->set('error', true);
            }
        }
    }


    /**
     * @Route("/admin/users/stat")
     * @Route("/admin/users/stat/")
     * @return type 
     */
    public function admin_statAction(){
        if (! $this->session_checkadmin() )
            return $this->redirect($this->generateUrl('admin_login'), 302);
        
        //  Do Init
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $month = array();
        for ($i=0;$i<=30;$i++){
            $date =  mktime(0,0,0,date("m"),date("d")-$i,date("Y"));
            $month[date("F d, Y", $date)]['fj'] = 0;
            $month[date("F d, Y", $date)]['pj'] = 0;
            $month[date("F d, Y", $date)]['pr'] = 0;
            $month[date("F d, Y", $date)]['pcpj'] = 0;
            $month[date("F d, Y", $date)]['pcfj'] = 0;

        }
        
        
        $year = array();
        
        for ($i = 0; $i <= 24; $i++){
            $date =  mktime(0,0,0,date("m")-$i,date("d"),date("Y"));
            
            //echo '<br>' . date("F Y", $date);
            
            $year[date("F Y", $date)]['fj'] = 0;
            $year[date("F Y", $date)]['pj'] = 0;
            $year[date("F Y", $date)]['pr'] = 0;
            $year[date("F Y", $date)]['pcpj'] = 0;
            $year[date("F Y", $date)]['pcfj'] = 0;

        }
        //echo '<pre>'; print_r( $year);die;
        /***
         * Months
         */
        
        $sql = "select count(*) as num,statistic.* from statistic where gdate > (NOW() - interval 1 month) and type='pr' group by gdate order by gdate desc";
        $temp_month = $this->_conn->fetchAll( $sql );
        
        foreach($temp_month as $doc){
            $month[date("F d, Y", $doc['time'])]['pr'] = $doc['num'];
        }
        
        $sql = "select count(*) as num,statistic.* from statistic where gdate > (NOW() - interval 1 month) and type='pj' group by gdate order by gdate desc";
        $temp_month = $this->_conn->fetchAll( $sql );
        
        foreach($temp_month as $doc){
            $month[date("F d, Y", $doc['time'])]['pj'] = $doc['num'];
        }

        
        $sql = "select count(*) as num,statistic.* from statistic where gdate > (NOW() - interval 1 month) and type='fj' group by gdate order by gdate desc";
        $temp_month = $this->_conn->fetchAll( $sql );

        foreach($temp_month as $doc){
            $month[date("F d, Y", $doc['time'])]['fj'] = $doc['num'];
        }
                
        $sql = "select count(*) as num,statistic.* from statistic where gdate > (NOW() - interval 1 month) and type='pcpj' group by gdate order by gdate desc";
        $temp_month = $this->_conn->fetchAll( $sql );

        foreach($temp_month as $doc){
            $month[date("F d, Y", $doc['time'])]['pcpj'] = $doc['num'];
        }
		
        $sql = "select count(*) as num,statistic.* from statistic where gdate > (NOW() - interval 1 month) and type='pcfj' group by gdate order by gdate desc";
        $temp_month = $this->_conn->fetchAll( $sql );

        foreach($temp_month as $doc){
            $month[date("F d, Y", $doc['time'])]['pcfj'] = $doc['num'];
        }
		

        ///////////////////////////////////////////
        // Years 
        //////////////////////////////////////////
                
        $sql = "select count(*) as num,statistic.* from statistic where gdate > (NOW() - interval 24 month) and type='pr' group by date order by gdate desc";
        $temp_years = $this->_conn->fetchAll( $sql );
        
        foreach($temp_years as $doc){
            $year[date("F Y", $doc['time'])]['pr'] = $doc['num'];
        }
		
        $sql = "select count(*) as num,statistic.* from statistic where gdate > (NOW() - interval 24 month) and type='pj' group by date order by gdate desc";
        $temp_years = $this->_conn->fetchAll( $sql );
        foreach($temp_years as $doc){
            $year[date("F Y", $doc['time'])]['pj'] = $doc['num'];
        }
        
	$sql = "select count(*) as num,statistic.* from statistic where gdate > (NOW() - interval 24 month) and type='fj' group by date order by gdate desc";
        $temp_years = $this->_conn->fetchAll( $sql );
        foreach($temp_years as $doc){
            $year[date("F Y", $doc['time'])]['fj'] = $doc['num'];
        }
        
	$sql = "select count(*) as num,statistic.* from statistic where gdate > (NOW() - interval 24 month) and type='pcpj' group by date order by gdate desc";
        $temp_years = $this->_conn->fetchAll( $sql );
        foreach($temp_years as $doc){
            $year[date("F Y", $doc['time'])]['pcpj'] = $doc['num'];
        }
        
        $sql = "select count(*) as num,statistic.* from statistic where gdate > (NOW() - interval 24 month) and type='pcfj' group by date order by gdate desc";
        $temp_years = $this->_conn->fetchAll( $sql );
        foreach($temp_years as $doc){
            $year[date("F Y", $doc['time'])]['pcfj'] = $doc['num'];
        }
		

        //echo '<pre>'; print_r( $month ); print_r( $year);die;
        
        $this->_viewData['month'] = $month;
        $this->_viewData['years'] = $year ;
        
        return $this->render('YxBundle:Users:admin_stat.html.php', $this->_viewData);
    }

    /**
     * @Route("/admin/users/change_password")
     * @Route("/admin/users/change_password/")
     * @return type 
     */
    public function admin_change_passwordAction(){
        if (! $this->session_checkadmin() )
            return $this->redirect($this->generateUrl('admin_login'), 302);
        
        //  Do Init
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $errMsg = '';
        
        if ( $request->request->get('old_password') ){
            $data = $request->request->all();
            
            $user = $em->getRepository('YxBundle:Admins')->findById( $this->_session->get('adminid') );
            
            $userinfo = current( $user );
            //echo '<pre>'; print_r( $_POST );die;
            
            if ( ! $userinfo ){
                $this->get('session')->getFlashBag()->add( 'notice', 'User not Found.');
                return $this->redirect('/admin/users/change_password');
            }
            
            if( $userinfo->getPassword() == $data['old_password'] ){
                    $new_pass = $data['new_pass'];
                    $confirm_pass = $data['confirm_pass'];
                    
                    if($new_pass != $confirm_pass){
                        $errMsg = 'Please Enter same New and Confirm Password';
                    }else{
			$userinfo->setPassword( $new_pass );
                        $em->persist( $userinfo );
                        $em->flush();

                        $errMsg = 'Your Password has been successfully Changed.';
                    }
			
            }else{
                $errMsg = 'Current password doesnot match.';
            }
        }
        
        $this->_viewData['msg'] = $errMsg;
        
        return $this->render('YxBundle:Users:admin_change_password.html.php', $this->_viewData);
    }

    
    /**
     * @Route("/admin/users/my_preferences")
     * @Route("/admin/users/my_preferences/")
     * @return type 
     */
    public function admin_my_preferencesAction(){
        if (! $this->session_checkadmin() )
            return $this->redirect($this->generateUrl('admin_login'), 302);
        
        //  Do Init
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        $errMsg = '';
        
        $user = $em->getRepository('YxBundle:Admins')->findById( $this->_session->get('adminid') );
            
        $userinfo = current( $user );

        $this->_viewData['record'] = $userinfo;
        
        if ( ! $userinfo ){
            $this->get('session')->getFlashBag()->add( 'notice', 'User not Found.');
            return $this->redirect('/admin/users/my_preferences');
        }
        
        if ( $request->request->get('email') ){
            $data = $request->request->all();
            
            $userinfo->setEmail( $data['email'] );
            $em->persist( $userinfo );
            $em->flush();

            $errMsg = 'Your Preferences has been successfully Changed.';
        }
        
        $this->_viewData['msg'] = $errMsg;
        
        return $this->render('YxBundle:Users:admin_my_preferences.html.php', $this->_viewData);
    }
    
    private function sendfile($number,$carrier,$text, $type = 'pr',$iden = null){
		
        if ($text != 'Test message from yaxmobi.com for '.$carrier){
            $number = urlencode($number);
            $carrier = urlencode($carrier);
            $text = urlencode($text);
            $posting_host = 'stp.yaxmobi.com';
            $posting_port = '80';
            $posting_path = '/api.send.php?';
            $posting_path.="num=$number&";
            $posting_path.="clientname=YAXMO-LH06-619N-J7L1&";
            $posting_path.="operator=$carrier&";
            $posting_path.="url=http://yaxmobi.com/get/".$text;

            $sock=fsockopen($posting_host,$posting_port,$errno,$errstr,5);

            if($sock){

                $snif = "GET $posting_path HTTP/1.0\r\n";
                $snif.= "Host: $posting_host\r\n";
                $snif.= "Accept: */*" . "\r\n";
                $snif.= "\r\n";

                fwrite($sock, $snif);

                $return="";
                while (!feof($sock)) {
                        $return.=  @fgets($sock, 1024);
                }
                
                $return_new = '';
                for($izz=5;$izz<strlen($return);$izz++){
                        if(substr($return,$izz-3,4)=="\r\n\r\n")
                        {
                                $vis=true;
                                $return_new =  substr($return,$izz+1);
                                $izz = strlen($return);
                        }
                }
                $return_new = nl2br($return_new);
                $regexp = "/ID=(.+)\<br/";
                preg_match($regexp, $return_new, $matches);
                if (isset($matches[1]))
                $id = trim($matches[1]);
                else
                $id = 0;


                $user_id = $this->_session->get('Users.userid');
                
                
                $sql = "insert into statistic set gdate='".date("Y-m-d")."',date='".date("Y-m")."', id_user=".$user_id.",result='".$id."',type='".$type."',time=".time();
                $this->_conn->query( $sql );
                
                
                if($type == 'pr'){
                    $this->_conn->query( "update ringtones set stat_phone = stat_phone+1 where id=".$iden );
                }

                if($type == 'pj' || $type == 'fj' ){
                    $this->_conn->query( "update songs set stat_phone = stat_phone+1 where id=".$iden );
                }

                if ($id>0)
                    return $id;
		else
		return false;

            }else
                return false;
        }else{
            $number = urlencode($number);
            $carrier = urlencode($carrier);
            $text = urlencode($text);
            $posting_host = 'stp.yaxmobi.com';
            $posting_port = '80';
            $posting_path = '/api.text.php?';
            $posting_path.="num=$number&";
            $posting_path.="clientname=YAXMO-LH06-619N-J7L1&";
            $posting_path.="operator=$carrier&";
            $posting_path.="message=$text";

            $sock=fsockopen($posting_host,$posting_port,$errno,$errstr,5);

            if($sock){
                $snif = "GET $posting_path HTTP/1.0\r\n";
                $snif.= "Host: $posting_host\r\n";
                $snif.= "Accept: */*" . "\r\n";
                $snif.= "\r\n";

                fwrite($sock, $snif);

		$return="";
                while (!feof($sock)) {
                        $return.=  @fgets($sock, 1024);
                }
                
                $return_new = '';
                for($izz=5;$izz<strlen($return);$izz++){
                        if(substr($return,$izz-3,4)=="\r\n\r\n"){
                                $vis=true;
                                $return_new =  substr($return,$izz+1);
                                $izz = strlen($return);
                        }
                }
                
                $return_new = nl2br($return_new);
                $regexp = "/ID=(.+)\<br/";
                preg_match($regexp, $return_new, $matches);
                if (isset($matches[1]))
                $id = trim($matches[1]);
                else
                $id = 0;

                return true;


            }else
                return false;
        }

    }
    

}
