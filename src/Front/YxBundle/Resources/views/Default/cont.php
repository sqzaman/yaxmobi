<?php

class UsersController extends AppController
{
	var $name = 'Users';
	var $herefor = '';
	var $helpers = array('Pagination','Html','Javascript','Ajax', 'Cache');
	var $components = array ('Pagination', 'Mailer');
	var $uses = array('User','Useramount', 'Ringtone', 'Country','Song','Jokecategory','Genre', 'Cartitem', 'Userbalance', 'Rating','Carrier');
	var $morelimit = 10;
	// Array to hold song ratings
	var $songRating = array();
	var $counter = 0;

	function session_check($redirect = true) {
		$userid = $this->Session->read('Users.id');
		if(empty($userid))
		{
			$url = '/users/login/';
			$ref = $_SERVER['REQUEST_URI'];
			if ($ref != '')
			{
				$this->Session->write('Redirect.url', $ref);
			}
			$this->redirect($url);
			die;
		}
	}

	function session_checkadmin(){
		if(!isset($_SESSION['admin_id'])){
			$this->redirect('/admin/admins/login');
		}
	}

	function faq(){
		//$this->session_check();
		$user_id = $this->Session->read('Users.userid');
		$loginuserEmail = $this->Session->read('Users.id');
		if($loginuserEmail==""){
			$loggedIn=true;
		}else { $loggedIn=false; }

		$this->set('loggedIn',$loggedIn);

		$displayName = $this->Session->read('Users.name');
		$this->set('displayName',$displayName);
		//$this->set('users', $this->User->findById($user_id));

		$errMessage = '';

		$this->set('errMessage',$errMessage);

	} // ported

	function credits(){ // ported
		//$this->session_check();
		$user_id = $this->Session->read('Users.userid');
		$loginuserEmail = $this->Session->read('Users.id');
		if($loginuserEmail==""){
			$loggedIn=true;
		}else { $loggedIn=false; }

		$this->set('loggedIn',$loggedIn);

		$displayName = $this->Session->read('Users.name');
		$this->set('displayName',$displayName);
		//$this->set('users', $this->User->findById($user_id));

		$errMessage = '';

		$this->set('errMessage',$errMessage);

	}// ported

	function benef(){
		//$this->session_check();
		$user_id = $this->Session->read('Users.userid');
		$loginuserEmail = $this->Session->read('Users.id');
		if($loginuserEmail==""){
			$loggedIn=true;
		}else { $loggedIn=false; }

		$this->set('loggedIn',$loggedIn);

		$displayName = $this->Session->read('Users.name');
		$this->set('displayName',$displayName);
		//$this->set('users', $this->User->findById($user_id));

		$errMessage = '';

		$this->set('errMessage',$errMessage);

	} // ported

	// This function writes rating array
	function get_song_rating($songId, $jokeType = 1)
	{
		$condition = "joke_id = ". $songId . " AND joke_type = '". $jokeType ."'";

		$sql = "select (sum(Rating.user_rating)/count(Rating.user_rating)) as points, Rating.joke_id as id, count(Rating.user_rating) as vote from ratings AS Rating WHERE " . $condition ." GROUP BY Rating.joke_id";
		$temp = $this->Rating->query($sql);

		$points = 0;
		$vote = 0;
		if (($temp))
		{
			$points = round($temp[0][0]['points']);
			$vote = round($temp[0][0]['vote']);
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

	// Search page
	function search($char=null)// ported
	{
		// Initialize variable
		$conditions_r = '';
		$condition = '';
		$ringtone = array();
		$freeSongs = array();
		$paidSongs = array();

		if($char==null)
		{
			$condition="";
		}
		else
		{
			$condition="Song.composition like '".$char."%'" ;
		}

		$loginuserEmail = $this->Session->read('Users.id');
		$displayName = $this->Session->read('Users.name');

		if($loginuserEmail==""){
			$loggedIn=true;
		}else { $loggedIn=false; }

		$this->set('displayName',$displayName);
		$this->set('loggedIn',$loggedIn);


		if ( !empty($_POST['what']) && $_POST['what'] == 'ringtone')
		{
			$conditions="";
			$conditions .="Ringtone.status = '1' AND Ringtone.title LIKE '". $_POST['searchkeyworld']."%'";
				
			$ringtone = $this->Ringtone->findAll($conditions, NULL, null, 50, null);

			//$ringtone = $this->Ringtone->findAll($conditions,null,null,20);

			foreach($ringtone as $k => $v)
			{
				$jokeId = $v['Ringtone']['id'];
				$this->get_song_rating($jokeId, 3);
			}

			$this->set('songRating', $this->songRating);
			$this->set('ringtones', $ringtone);
			$this->render('search_ringtone');
		}else
		{
			if ( !empty ($_POST))
			{
				if($_POST['what']=='all')
				{
					$condition=" (Singer.sname like '".$_POST['searchkeyworld']."%' or Album.aname like '".$_POST['searchkeyworld']."%' or Song.composition like '".$_POST['searchkeyworld']."%' )" ;
					$conditions_r="Ringtone.status = '1' AND ( Ringtone.title LIKE '". $_POST['searchkeyworld']."%' or Ringtone.category LIKE '%". $_POST['searchkeyworld']."%')";
				}

				if($_POST['what']=='comp')
				{

					$condition="Song.composition like '".$_POST['searchkeyworld']."%'" ;
					//$conditions_r="Ringtone.status = '1' AND Ringtone.title LIKE '%". $_POST['searchkeyworld']."%'";
				}
				if($_POST['what']=='category')
				{
					$condition="Genre.gname like '".$_POST['searchkeyworld']."%'" ;
					$conditions_r="Ringtone.status = '1' AND Ringtone.category LIKE '". $_POST['searchkeyworld']."%'";
				}
				if($_POST['what']=='singer')
				{
					$condition="Singer.sname like '".$_POST['searchkeyworld']."%'" ;
				}
				if($_POST['what']=='album')
				{
					$condition="Album.aname like '".$_POST['searchkeyworld']."%'" ;
				}
			}
			//ringtones
			if (strlen($conditions_r)>0)
			{
				$ringtone = $this->Ringtone->findAll($conditions_r, null, null, 50);

				foreach($ringtone as $k => $v)
				{
					$jokeId = $v['Ringtone']['id'];
					$this->get_song_rating($jokeId, 3);
				}

				$this->set('songRating', $this->songRating);

			}
			// free songs
			$freeSongs = $this->Song->findAll($condition ." and Song.paid='N'",null,null, 50, null, null);
			if (!is_array($freeSongs))
			$freeSongs=array();

			foreach($freeSongs as $k => $v)
			{
				$songId = $v['Song']['id'];
				$this->get_song_rating($songId);
			}


			// paid song
			$paidSongs = $this->Song->findAll($condition,null,null,50);
			if (!is_array($paidSongs))
			$paidSongs=array();

			foreach($paidSongs as $k => $v)
			{
				$songId = $v['Song']['id'];
				$this->get_song_rating($songId);
			}

			$this->set('songRating', $this->songRating);
			$this->set('freeSongs',$freeSongs);
			$this->set('paidSongs',$paidSongs );
			$this->set('ringtones', $ringtone);
			//pr($_POST);die;
		}
	}

	// index page
	function index($char=null, $char2 = null){

		if(count($_POST) > 0)
		for($i=0; $i<count($_POST['boxdel_']); $i++)
		$this->Cartitem->del($_POST['boxdel_'][$i]);

		if ($char == 'download' && $char2 != null)
		{
			$str = explode(',',$char2);
			if ($str[0] != '')
			{
				$song1 = $this->Song->query("select * from songs where id=".$str[1]);

				$original_file_name = '';
				if($song1[0]['songs']['paid'] == 'N') {
					$path = $song1[0]['songs']['sample_file_before'];
					if($path != '') {
						$str[0] = $song1[0]['songs']['sample_file_before'];
						$filedownload = pathinfo($path);
						$filename = pathinfo($song1[0]['songs']['or_file']);
						$basename = $song1[0]['songs']['or_file'];
						if($filename['extension'] != '') $basename = substr($song1[0]['songs']['or_file'], 0, strlen($song1[0]['songs']['or_file']) - strlen($filename['extension'])-1);
						$original_file_name = $basename . '.' . $filedownload['extension'];
					}
				}

				$this->Cartitem->query("update songs set stat_pc = stat_pc+1 where id=".$str[1]);
				$this->download($str[0], $original_file_name, '', $str[2]);

			}
			$str = '';
		}
		if ($this->Session->read('Users.id') != '')
		{
			$this->redirect('/users/welcome');
		}
		if($char==null)
		{
			$condition="";
		}
		else
		{
			$condition="Song.composition like '".$char."%'" ;
		}

		if(!empty($_POST))
		{
			if($_POST['what']=='all')
			{
				$condition=" (Singer.sname like '".$_POST['searchkeyworld']."%' or Album.aname like '".$_POST['searchkeyworld']."%' or Song.composition like '".$_POST['searchkeyworld']."%')" ;
			}
			if($_POST['what']=='comp')
			{
				$condition="Song.composition like '".$_POST['searchkeyworld']."%'" ;
			}
			if($_POST['what']=='category')
			{
				$condition="Genre.gname like '".$_POST['searchkeyworld']."%'" ;
			}
			if($_POST['what']=='singer')
			{
				$condition="Singer.sname like '".$_POST['searchkeyworld']."%'" ;
			}
			if($_POST['what']=='album')
			{
				$condition="Album.aname like '".$_POST['searchkeyworld']."%'" ;
			}
		}
		$loginuserEmail = $this->Session->read('Users.id');
		$displayName = $this->Session->read('Users.name');
		if($loginuserEmail=="")
		{
			if($condition!="")
			{
				$condition=$condition." and paid='N'";
			}
			else
			{
				$condition=$condition." paid='N'";
			}
		}
		$freeSongs  = $this->Song->findAll($condition,null,null,null,null,-1);
		
		foreach($freeSongs as $k => $v)
		{
			$songId = $v['Song']['id'];
			$this->get_song_rating($songId);
		}

		//$jokecat  = $this->Jokecategory->findAll(null,null,null,null,null,0);
		$songcat  = $this->Genre->findAll(null,null,null,null,null,-1);
		
		if($loginuserEmail==""){
			$loggedIn=true;
		}else { $loggedIn=false; }

		$this->set('songRating', $this->songRating);
		$this->set('displayName',$displayName);
		$this->set('users', $this->User->findAll());
		$this->set('freeSongs',$freeSongs);
		$this->set('loggedIn',$loggedIn);
		
		//$this->set('jokecat',$jokecat);
		$this->set('songcat',$songcat);

	}

	// this function displays all song categories
	function song_category()// ported
	{
		$songcat = $this->Genre->findAll(null,null,null,null,null,0);
		$loginuserEmail = $this->Session->read('Users.id');
		$displayName = $this->Session->read('Users.name');

		if($loginuserEmail==""){
			$loggedIn=true;
		}else { $loggedIn=false; }

		$this->set('displayName',$displayName);
		$this->set('loggedIn',$loggedIn);
		$this->set('songcat',$songcat);

		$condition="";
		$freeSongs = $this->Song->findAll($condition ." paid='N'",null,null,null,null,0);
		if (!is_array($freeSongs))
		$freeSongs=array();

		foreach($freeSongs as $k => $v)
		{
			$songId = $v['Song']['id'];
			$this->get_song_rating($songId);
		}

		$this->set('freeSongs',$freeSongs);

		$this->set('songRating', $this->songRating);


	}

	// This function forces for download
	function download($chr, $filename = '',$db='', $type)
	{
		if ($db != 'no')
		{
			$user_id = $this->Session->read('Users.userid');
			$tmp = $this->Cartitem->query("select * from songs where path=".$chr);
			$tmp = $tmp[0]['songs'];
			if ($tmp['paid'] == 'Y')
			$this->Cartitem->query("insert into statistic set gdate='".date("Y-m-d")."',date='".date("Y-m")."', id_user=".$user_id.",result='pc',type='pcpj',time=".time());
			else
			{
			 if ($type == 'free')
			 {
			 	$this->Cartitem->query("insert into statistic set gdate='".date("Y-m-d")."',date='".date("Y-m")."', result='pc',type='pcfj',time=".time());
			 }else
			 {
			 	$this->Cartitem->query("insert into statistic set gdate='".date("Y-m-d")."',date='".date("Y-m")."', id_user=".$user_id.",result='pc',type='pcfj',time=".time());
			 }
			}
		}

		//echo $ref = $_SERVER['REQUEST_URI'];die;
		if ($type != 'free')
		$this->session_check(false);

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

	function downloaddrm($chr)
	{
		$this->session_check(false);
		$file = "http://yaxmobi.com/img/songs/".$chr;

		header("Content-Type: application/x-octet-stream");
		header("Content-Disposition: attachment; filename=".basename($file));
		header("Content-Transfer-Encoding: binary");
		readfile($file);
		exit;
	}



	function welcome($char=null, $char2 = null)
	{
		$this->session_check();
		$user_id = $this->Session->read('Users.userid');
		if(count($_POST) > 0)
		for($i=0; $i<count($_POST['boxdel_']); $i++)
		{
			$sql = "delete from cartitems WHERE song_id = '".$_POST['boxdel_'][$i]."' AND user_id = '". $user_id ."'";
			$this->Cartitem->query($sql);
		}

		if ($char == 'download' && $char2 != null)
		{

			$str = explode(',',$char2);

			$sql = "update cartitems set statuspc = '2' WHERE song_id = '".$str[1]."'";
			$this->Cartitem->query("update songs set stat_pc = stat_pc+1 where id=".$str[1]);

			$this->Cartitem->query($sql);
			if ($str[0] != '')
			{

				$tmp = $this->Cartitem->query("select * from songs where id=".$str[1]);
				$tmp = $tmp[0]['songs'];
				if ($tmp['paid'] == 'Y')
				$this->Cartitem->query("insert into statistic set gdate='".date("Y-m-d")."',date='".date("Y-m")."', id_user=".$user_id.",result='pc',type='pcpj',time=".time());
				else
				{
					$this->Cartitem->query("insert into statistic set gdate='".date("Y-m-d")."',date='".date("Y-m")."', id_user=".$user_id.",result='pc',type='pcfj',time=".time());
				}

				$filedownload = pathinfo($str[0]);

				if(strtolower($filedownload['extension']) == 'wma' or strtolower($filedownload['extension']) == 'wmv') {
					$filename = pathinfo($tmp['or_file']);
					$basename = substr($tmp['or_file'], 0, strlen($tmp['or_file']) - strlen($filename['extension'])-1);

					$this->download('drm_' . $str[0], $basename . '.' . $filedownload['extension'],'no');
				}
				$this->download($str[0],'','no');


			}
			$str = '';
		}
		$findChar  = strpos($char,'&');
		if($findChar==true)
		{
			$str  = explode('&',$char);
			if($str[0]=='singer')
			{
				$condition="Song.singer_id =".$str[1].' ';
			}
			if($str[0]=='year')
			{
				$condition="Song.year =".$str[1].' ';
			}
			if($str[0]=='genre')
			{
				$condition="Song.genre_id =".$str[1].' ';
			}
			if($str[0]=='more')
			{
				$this->morelimit='20';
			}

		}
		else
		{
			if($char==null){
				$condition="";
			}else{
				$condition="Song.composition like '".$char."%'" ;
			}
			$loginuserEmail = $this->Session->read('Users.id');
			if($loginuserEmail==""){
				$this->redirect('/users');
			}
		}


		$condition = "Cartitem.user_id='".$user_id."'"; //AND Cartitem.status!='0'";
		$this->Pagination->ajaxDivUpdate = "tasks_todo";
		$this->Pagination->url = "welcometpaging";
		$this->Pagination->style = "ajax";
		$this->Pagination->onComplete ="show('tasks_todo')";
		$this->Pagination->_setPrivateParameter("onComplete");
		list($order,$limit,$page) = $this->Pagination->init($condition ." AND Cartitem.status!='0' AND Song.id != NULL",null, array('modelClass'=>'Cartitem'));
		//$this->Pagination->init(null);
		//$condition  =  $condition . "group by Album.aname";

		$loginuserEmail = $this->Session->read('Users.id');
		$displayName = $this->Session->read('Users.name');
		$this->set('displayName',$displayName);
		//$freeSongs  = $this->Song->findAll($condition,null,null,$limit,$page,0);
			
		///// ringtones
		$sql = "select ringtones.*,ringtonecategories.title as catname from `ringtones` INNER JOIN cartitems ON `cartitems`.`song_id` = `ringtones`.`id`
  INNER JOIN ringtonecategories ON `ringtonecategories`.`id` = `ringtones`.`category`
 WHERE cartitems.user_id=".$user_id." AND cartitems.status='1' and cartitems.statuspc<>'1' and cartitems.type='r'";

		$pendingringtone = $this->Cartitem->query($sql);


		//Peanding jokes
		$sql = "select Song.*,Genre.gname,Cartitem.created,Cartitem.id,Cartitem.status,Cartitem.statuspc from `cartitems` AS `Cartitem`
  INNER JOIN songs as Song  ON `Cartitem`.`song_id` = `Song`.`id` 
  INNER JOIN `genres` AS `Genre` ON Song.genre_id = Genre.id
  WHERE ". $condition." AND ((Cartitem.status='1')or(Cartitem.statuspc='1'))  and  Cartitem.type<>'r'
  LIMIT " . $limit;

		$pendingSongs = $this->Cartitem->query($sql);
		//	Initialize pending songs name list
		$pendingSongArr = array();

		foreach($pendingSongs as $k => $v)
		{
			$songId = $v['Song']['id'];
			$this->get_song_rating($songId );
			if (!($pos = strrpos($v['Song']['drm'], '.mp3')))
			$pendingSongArr[] = $v['Song']['drm'];
		}

		//	set pending songs list
		$this->set('pendingSongArr',$pendingSongArr);
		// Purchased songs
		$sql = "select Song.*,Genre.gname,Cartitem.created,Cartitem.id,Cartitem.status,Cartitem.statuspc from `cartitems` AS `Cartitem`
  INNER JOIN songs as Song  ON `Cartitem`.`song_id` = `Song`.`id` 
  INNER JOIN `genres` AS `Genre` ON Song.genre_id = Genre.id
  WHERE ". $condition." AND ((Cartitem.status='2')or(Cartitem.statuspc='2')) and  Cartitem.type<>'r'
  LIMIT " . $limit;

		$freeSongs = $this->Cartitem->query($sql);
		//$freeSongs = $this->Cartitem->findAll($condition, Null, null, $limit,$page, 2);
		//pr ($freeSongs);
		foreach($freeSongs as $k => $v)
		{
			$songId = $v['Song']['id'];
			$this->get_song_rating($songId );
		}
		//$this->User->getPurchasedSomgs();


		//pr($this->songRating);
		//fecho($this->morelimit);
		$this->set('songRating', $this->songRating);
		$this->set('users', $this->User->findAll());
		$this->set('pendingSongs',$pendingSongs);
		$this->set('freeSongs',$freeSongs);
		$this->set('pendingringtone',$pendingringtone);

		$this->set('limit',$this->morelimit);
		$this->set('recCount',count($freeSongs));

	}

	function sendfree($chr)
	{
		$this->session_check();
		$user_id = $this->Session->read('Users.userid');
		if (intval($user_id) == 0)
		{
			$this->redirect('/users/login');
		}
		else
		{
			$sql = "select users.*,carriers.carriername from users inner join carriers on carriers.id=users.carrier where users.id=" . $user_id;
			$user = $this->Cartitem->query($sql);

			$sql = "select path from songs where id=" . $chr;
			$song = $this->Cartitem->query($sql);

			$phone = '';
			$carrier = '';
			$this->set('user',$user[0]['users']);
			if(isset($user[0]['users']) && count($user[0]['users']) > 0)
			$phone = $user[0]['users']['mobilephone'];
			if(isset($user[0]['carriers']) && count($user[0]['carriers']) > 0)
			$carrier = $user[0]['carriers']['carriername'];
			if ($phone != '' && $carrier != '')
			{
				$this->sendfile($phone,$carrier,$song[0]['songs']['path']);
				$this->set('message',"Joke sended on your phone. <br> <b><a href='/users/song_category'><b>Other jokes</b></a></b>");
			}
			else
			{
				$this->set('message',"You not enter phone or carrier. <br><br>Please <a target=blank href='/users/myprofile'><b>click here</b></a> for enter it.<br><br>
 <a href='/users/sendfree/".$chr."'><b>Try send file again</b></a>");
			}

		}
	}

	function sendfile($number,$carrier,$text,$type,$iden) // ported
                {
		// ������� �������� ����
		if ($text != 'Test message from yaxmobi.com for '.$carrier)
		{
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

			if($sock)
			{

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
				for($izz=5;$izz<strlen($return);$izz++)
				{
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


				$user_id = $this->Session->read('Users.userid');
				$this->Cartitem->query("insert into statistic set gdate='".date("Y-m-d")."',date='".date("Y-m")."', id_user=".$user_id.",result='".$id."',type='".$type."',time=".time());

				if($type == 'pr')
				{
					$this->Cartitem->query("update ringtones set stat_phone = stat_phone+1 where id=".$iden);
				}

				if($type == 'pj' || $type == 'fj' )
				{
					$this->Cartitem->query("update songs set stat_phone = stat_phone+1 where id=".$iden);
				}

				if ($id>0)
				return $id;
				else
				return false;

			}
			else
			return false;
		}
		else
		{
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

			if($sock)
			{
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
				for($izz=5;$izz<strlen($return);$izz++)
				{
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

				return true;


			}
			else
			return false;
		}

	}

	function welcometpaging()
	{
		$this->Pagination->ajaxDivUpdate = "tasks_todo";
		$this->Pagination->url = "welcometpaging";
		$this->Pagination->style = "ajax";
		$this->Pagination->onComplete ="show('tasks_todo')";
		$this->Pagination->_setPrivateParameter("onComplete");

		$user_id = $this->Session->read('Users.userid');
		list($order,$limit,$page) = $this->Pagination->init("Cartitem.status != '0' AND  Cartitem.user_id=".$user_id,null, array('modelClass'=>'Cartitem'));
		$loginuserEmail = $this->Session->read('Users.id');
		$displayName = $this->Session->read('Users.name');
		$this->set('displayName',$displayName);


		//$freeSongs = $this->Cartitem->findAll('Cartitem.user_id='.$user_id.' AND Cartitem.status=\'1\'', Null, null, $limit,$page,2);

		$offset = null;
		if ($page > 1 && $limit != null)
		{
			$offset = ($page - 1) * $limit;
		}

		//echo $offset.">>".$limit.">>".$page."I am here";
		//Peanding jokes
		if ($offset)
		$limtClause = $offset . ',' . $limit;
		else
		$limtClause = $limit;
		$sql = "select Song.*,Genre.gname,Cartitem.created from `cartitems` AS `Cartitem`
  LEFT JOIN songs as Song  ON `Cartitem`.`song_id` = `Song`.`id` 
  LEFT JOIN `genres` AS `Genre` ON Song.genre_id = Genre.id
  WHERE Cartitem.user_id='".$user_id."' AND Cartitem.status='1' 
  LIMIT " . $limtClause;

		$pendingSongs = $this->Cartitem->query($sql);

		foreach($pendingSongs as $k => $v)
		{
			$songId = $v['Song']['id'];
			$this->get_song_rating($songId );
		}
		// Purchased songs
		$sql = "select Song.*,Genre.gname,Cartitem.created from `cartitems` AS `Cartitem`
  LEFT JOIN songs as Song  ON `Cartitem`.`song_id` = `Song`.`id` 
  LEFT JOIN `genres` AS `Genre` ON Song.genre_id = Genre.id
  WHERE Cartitem.user_id='".$user_id."' AND Cartitem.status='2' 
  LIMIT " . $limtClause;

		$freeSongs = $this->Cartitem->query($sql);
		//$freeSongs = $this->Cartitem->findAll($condition, Null, null, $limit,$page, 2);
		//pr ($freeSongs);
		foreach($freeSongs as $k => $v)
		{
			$songId = $v['Song']['id'];
			$this->get_song_rating($songId );
		}

		//$freeSongs = $this->Song->findAll(null,null,null,$limit,$page,0);

		foreach($freeSongs as $k => $v)
		{
			$songId = $v['Song']['id'];
			$this->get_song_rating($songId );
		}

		$this->set('songRating', $this->songRating);
		$this->set('pendingSongs',$pendingSongs);
		$this->set('freeSongs',$freeSongs);
		$this->render('welcometodo', 'ajax');
	}

	function cash()
	{
		//$this->session_check();
		$user_id = $this->Session->read('Users.userid');
		$loginuserEmail = $this->Session->read('Users.id');
		if($loginuserEmail==""){
			$loggedIn=true;
		}else { $loggedIn=false; }

		$this->set('loggedIn',$loggedIn);

		$displayName = $this->Session->read('Users.name');
		$this->set('displayName',$displayName);
		//$this->set('users', $this->User->findById($user_id));

		$errMessage = '';

		$this->set('errMessage',$errMessage);

	}

	//  This function writes the contact us
	function contact_us()
	{

		$cor = 0;
		if(count($_POST)>0){
			if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] == $_POST['captcha']){
				$cor = 3;
			}else{
				$cor = 0;
				$this->set('capch','Enter correct captcha');
			}
		}

		if ($cor == 3)
		{


			//$this->session_check();
			$user_id = $this->Session->read('Users.userid');
			$loginuserEmail = $this->Session->read('Users.id');
			if($loginuserEmail==""){
				$loggedIn=true;
			}else { $loggedIn=false; }

			$this->set('loggedIn',$loggedIn);

			$displayName = $this->Session->read('Users.name');
			$this->set('displayName',$displayName);
			//$this->set('users', $this->User->findById($user_id));

			$errMessage = '';
			if (!empty($this->data))
			{
				$to = CONTACT_US_EMAIL;
				$toName = CONTACT_US_NAME;
				$fromName = $this->data['Support']['fname'] . '' . $this->data['Support']['lname'];

				$fromEmail = $this->data['Support']['email'];

				$subject = $this->data['Support']['subject'];

				$message = "A customer has asked for some help.<br><br>".$this->data['Support']['message']."<br></br>Customer Support\nYaxmobi";

				$this->Mailer->init();
				$this->Mailer->IsHTML(true);
				//$this->Mailer->AddEmbeddedImage($this->websroot."img/sitelogo.gif", "my-attach", "sitelogo.gif");

				$this->Mailer->AddAddress($to, $toName);
				$this->Mailer->FromName = $fromName;
				$this->Mailer->From = $fromEmail;

				$this->Mailer->Subject = $subject;
				ob_start();

				//$this->render('nameOfEmailTemplate', 'nameOfEmailLayout');
				$this->Mailer->Body = $message;

				// Send mail
				if ($this->Mailer->send()) {
					$msg = 'Mail was sent successfully.';
				} else {
					$msg = 'There was a problem sending mail: '.$this->Mailer->ErrorInfo;
				}
				$errMessage = "Thanks for contacting us. We will get back to you shortly.";
				//$this->redirect('/users/welcome');
			}
			$this->set('errMessage',$errMessage);
		}
	}

	//  This function writes the support section
	function support() // ported
	{
		//$this->session_check();
		$user_id = $this->Session->read('Users.userid');
		$loginuserEmail = $this->Session->read('Users.id');
		if($loginuserEmail==""){
			$loggedIn=true;
		}else { $loggedIn=false; }

		$this->set('loggedIn',$loggedIn);

		$displayName = $this->Session->read('Users.name');
		$this->set('displayName',$displayName);
		//$this->set('users', $this->User->findById($user_id));

		$errMessage = '';
		if (!empty($this->data))
		{
			$to = SUPPORT_EMAIL;
			$toName = SUPPORT_NAME;
			$fromName = $this->data['Support']['fname'] . '' . $this->data['Support']['lname'];

			$fromEmail = $this->data['Support']['email'];

			$subject = $this->data['Support']['subject'];

			$message = "A customer has asked for some help.<br><br>".$this->data['Support']['message']."<br></br>Customer Support\nYaxmobi";

			$this->Mailer->init();
			$this->Mailer->IsHTML(true);
			//$this->Mailer->AddEmbeddedImage($this->websroot."img/sitelogo.gif", "my-attach", "sitelogo.gif");

			$this->Mailer->AddAddress($to, $toName);
			$this->Mailer->FromName = $fromName;
			$this->Mailer->From = $fromEmail;

			$this->Mailer->Subject = $subject;
			ob_start();

			//$this->render('nameOfEmailTemplate', 'nameOfEmailLayout');
			$this->Mailer->Body = $message;

			// Send mail
			if ($this->Mailer->send()) {
				$msg = 'Mail was sent successfully.';
			} else {
				$msg = 'There was a problem sending mail: '.$this->Mailer->ErrorInfo;
			}
			$errMessage = "Your Query has been succesfully sent. Our support staff will contact you withing 1 business day.";
			//$this->redirect('/users/welcome');
		}
		$this->set('errMessage',$errMessage);
	}
	function myprofile() // ported
	{
		$this->session_check();
		$user_id = $this->Session->read('Users.userid');
		/*if($user_id==null){
		 $this->redirect('/');
		 }*/

		$displayName = $this->Session->read('Users.name');
		$this->set('displayName',$displayName);
		$condition = 'WHERE id = '.$user_id;
		$this->set('id',$user_id);
		$this->set('users', $this->User->findById($user_id));
		$this->countryList();
		$this->updatecarriers();
		$this->carrierList();

		if (!empty($this->data)){
			$this->User->save($this->data);
			$this->set('msg', true);
			$this->redirect('/users/welcome');

		}
	}

	function send($char=null,$id=null,$type=0) // ported
	{
		$this->session_check();
		$user_id = $this->Session->read('Users.userid');
		/*if($user_id==null){
		 $this->redirect('/');
		 }*/
		$displayName = $this->Session->read('Users.name');

		if ((!empty($this->data))&&($char == null))
		$this->User->save($this->data);

		$this->set('displayName',$displayName);
		$condition = 'WHERE id = '.$user_id;
		$this->set('id',$user_id);
		$mass_users = $this->User->findById($user_id);
		$this->set('users', $mass_users);
		$this->set('char', $char);

		if ($char == null)
		{
			$temp = $this->Cartitem->query("select * from carriers where  id=".$mass_users['User']['carrier']);
			$carr = $temp[0]['carriers']['carriername'];
			if($this->sendfile($mass_users['User']['mobilephone'],$carr,'Test message from yaxmobi.com for '.$carr,'test'))
			$this->set('message','The message was successfully sent');
			else
			$this->set('message','Error at sending. Check up correctness of your number and carrier');
		}

		if ($char == 'form')
		{
			$this->updatecarriers();
			$this->carrierList();

			if ($type == 0)
			{
				$sql = "select Song.*,Genre.gname,Cartitem.created from `cartitems` AS `Cartitem`
  INNER JOIN songs as Song  ON `Cartitem`.`song_id` = `Song`.`id` 
  INNER JOIN `genres` AS `Genre` ON Song.genre_id = Genre.id
  WHERE `Cartitem`.`song_id`=".$id." and (Cartitem.status='2' or Cartitem.status='1')
  LIMIT 1";

				$freeSongs = $this->Cartitem->query($sql);

				if(count($freeSongs) == 0)
				{
					$sql = "select Song.*,Genre.gname from songs as Song
 left JOIN `genres` AS `Genre` ON Song.genre_id = Genre.id
 WHERE `Song`.`id`=".$id." and (Song.paid='N')
 LIMIT 1";

					$freeSongs = $this->Cartitem->query($sql);
				}

				if(count($freeSongs) > 0)
				{
					$songId = $freeSongs[0]['Song']['id'];
					$this->get_song_rating($songId );

					$this->set('message', '');

					$this->set('freeSongs', $freeSongs);
					$this->set('file_path', 'Joke'.$id.substr($freeSongs[0]['Song']['path'],strpos($freeSongs[0]['Song']['path'],"."),strlen($freeSongs[0]['Song']['path'])));
					$this->set('file_id', $freeSongs[0]['Song']['id']);

				}
				else
				$this->set('message', 'You can not download this song');
			}

			if ($type == 1)
			{
				$sql = "select ringtones.* from ringtones INNER JOIN `cartitems` ON cartitems.song_id = ringtones.id  where ringtones.id =".$id." and (ringtones.type='0' or cartitems.status='1') LIMIT 1";
				$freering = $this->Cartitem->query($sql);

				if (count($freering) > 0)
				{

					$songId = $freering[0]['ringtones']['id'];
					$typer = $freering[0]['ringtones']['type'];
					$this->set('freering', $freering);
					$this->set('file_path', 'Ring'.$id.substr($freering[0]['ringtones']['ringtone'],strpos($freering[0]['ringtones']['ringtone'],"."),strlen($freering[0]['ringtones']['ringtone'])));
					$this->set('file_id', $freering[0]['ringtones']['id']);
					$this->set('message', '');
					$this->set('types', '11');


				}
				else
				$this->set('message', 'Sorry. You can not send this ringtone');
			}

		}

		if ($char == 'result')
		{


			if (!empty($this->data)){
				$phone = $this->data['User']['mobilephone'];
				$carr_id = $this->data['User']['carrier'];
			}

			$temp = $this->Cartitem->query("select * from carriers where id=".$carr_id);
			if (isset($temp[0]['carriers'])&&(count($temp[0]['carriers']))>0)
			$carr = $temp[0]['carriers']['carriername'];
			else
			$carr = '';

			$result = $this->sendfile($phone,$carr,$this->data['File']['path'],$_POST['typ'],$id);
			if($result)
			{
				$sql = "update cartitems set status='2' where song_id =".$id." and user_id = ".$user_id;  $tmp = $this->Cartitem->query($sql);

				$this->set('message','The message was successfully sent. File ID - '.$result);
				$this->set('linkback','/users/');
			}
			else
			{
				$this->set('linkback',$_SERVER['HTTP_REFERER']);
				$this->set('message','Error at sending. Check up correctness of your number and carrier');
			}
		}

	}

	function mybalance() // ported
	{

		$this->session_check();
		$user_id = $this->Session->read('Users.userid');
		$displayName = $this->Session->read('Users.name');
		$this->set('displayName',$displayName);

		$condition = 'WHERE id = '.$user_id;
		$userDetail = $this->Userbalance->findAll("Userbalance.user_id=".$user_id,'Userbalance.amount, User.firstname, User.lastname, User.modified, User.created', null, 2);

		$temp = $this->Cartitem->query("select users.*,userbalances.* from users inner join userbalances on  users.id = userbalances.user_id  where  users.id=".$user_id);

		$this->set('users', $temp);

		//pr($userDetail);
		//  $userDetail = $this->Userbalance->findById($user_id,'User.firstname, User.lastname, User.modified, User.created', null, 2);

	}

	function license($id)// ported
	{
		$this->session_check();
		$user_id = $this->Session->read('Users.userid');
		// $user_id = '77';
		//$id = '317';
		$sql = sprintf("SELECT license FROM license where iduser='%s' and idfile='%s' and license<>'' limit 1",$user_id,$id);
		$license = $this->Cartitem->query($sql);
		if (isset($license[0]['license']['license']))
		$text_license = $license[0]['license']['license'];
		else $text_license = '';

		$this->set('license',$text_license);

		$mass = mysql_query("select * from user_licenses where user_id=".$user_id." and song_id='".$id."' order by id desc limit 1");
		$mass = mysql_fetch_assoc($mass);
		$this->set('user_licenses',$mass);

	}



	function success()
	{

		$paypalId = 'marlonjean72@yahoo.com';
		$postdata='';

		$money_sum = trim($_POST['mc_gross'])+0;
		if ($money_sum>0)
		{
			$postdataV="";
	  foreach ($_POST as $key=>$value) $postdataV.=$key."=".urlencode($value)."&";
	  $postdataV.="cmd=_notify-validate";
	  $curl = curl_init("https://www.paypal.com/cgi-bin/webscr");
	  curl_setopt ($curl, CURLOPT_HEADER, 0);
	  curl_setopt ($curl, CURLOPT_POST, 1);
	  curl_setopt ($curl, CURLOPT_POSTFIELDS, $postdataV);
	  curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);
	  curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
	  curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 1);
	  $response = curl_exec ($curl);
	  curl_close ($curl);
	  if ($response != "VERIFIED") exit;

	  if ($_POST['receiver_email'] != $paypalId) exit;

	  $user_id = $_POST['item_number'];
	  $postdata = $user_id;

	  $sql = "select * from userbalances where user_id=$user_id";
	  $res = mysql_query($sql);
	  if (mysql_num_rows($res))
	  {
	  	$sql = "update userbalances set amount=(amount+$money_sum) where user_id=$user_id";
	  	mysql_query($sql);
	  }
	  else
	  {
	  	$sql = "insert into userbalances (user_id,amount) values ($user_id,$money_sum)";
	  	mysql_query($sql);
	  }
	  $postdata .= '--|'.$sql.'|--';
		}

			
		foreach ($_POST as $key=>$value) $postdata.=$key."=".urlencode($value)."&";


		$file_name = date('H-i-s').'-11-.txt';
		$file_hendle = fopen($file_name, "w ");
		fwrite($file_hendle,$postdata); // переписываем файл visitors и
		fclose($file_hendle); // закрываем файл

	}

	function cancelled()
	{
		$user_id = $this->Session->read('Users.userid');
		$postdata=$user_id;
		foreach ($_POST as $key=>$value) $postdata.=$key."=".urlencode($value)."&";

		$file_name = 'cancel'.date('H-i-s').'.txt';
		$file_hendle = fopen($file_name, "w ");
		fwrite($file_hendle,$postdata); // переписываем файл visitors и
		fclose($file_hendle); // закрываем файл

		$displayName = $this->Session->read('Users.name');
		$this->set('displayName',$displayName);
		$this->Session->del('Useramount.paypalid');
	}

	function balance(){
		//pr($_POST);die;


		$this->session_check();
		$user_id = $this->Session->read('Users.userid');
		$itemNumber = $user_id;
		$this->set('user_id', $user_id);
		$displayName = $this->Session->read('Users.name');
		$this->set('displayName',$displayName);
		if(!empty($_POST['paynow']) && isset($_POST) && $_POST['paynow']==1)
		{
			$tempAmt = $this->data['Useramount']['amount'];
			$tempAmt == '' ? $tempAmt = '10' : $tempAmt = $tempAmt;
			$this->data['Useramount']['amount'] = $tempAmt;
			//echo "<pre>"; print_r($_POST);die();
			$this->Useramount->save($this->data);
			$this->Session->write('Useramount.paypalid', $this->Useramount->getLastInsertID());

			/*********/
			//$paypalUrl = "https://www.sandbox.paypal.com/cgi-bin/webscr"; // test server
			$paypalUrl = "https://www.paypal.com/cgi-bin/webscr"; // live paypal
			//$paypalId = 'webguruofindia@yahoo.com'; // test email id
			$paypalId = 'marlonjean72@yahoo.com'; //live email id

			echo "Redirecting to the payment gateway...";
			?>
<form name="Donation" action="https://www.paypal.com/cgi-bin/webscr"
	method="POST"><input type=hidden name="cmd" value="_xclick"> <input
	type=hidden name="business" value="<?=$paypalId?>"> <input type=hidden
	name="item_name" value="Top-up Balance"> <input type=hidden
	name="item_number" value="<?=$itemNumber?>"> <input type=hidden
	name="amount" value="<?=$tempAmt?>"> <input type=hidden
	name="no_shipping" value="0"> <input type="hidden" name="no_note"
	value="1"> <input type=hidden name="return"
	value="http://www.yaxmobi.com/users/mybalance"> <input type=hidden
	name="rm" value="2"> <input type=hidden name="cancel_return"
	value="http://www.yaxmobi.com/users/cancelled"> <input type="hidden"
	name="notify_url" value="http://www.yaxmobi.com/users/success"> <input
	type=hidden name="currency_code" value="USD"></form>
<script language='javascript'>document.Donation.submit()</script>
			<?
			/*******************/
			//echo "I am here";  die;
		}
	}

	function login(){
		//$this->;
		$this->set('error', false);

		$this->set('ref', getenv("HTTP_REFERER"));

		if (isset($_SERVER['HTTP_REFERER']))
		if (ereg("\/users\/search\/",$_SERVER['HTTP_REFERER']))
		{
			$this->Session->write('Redirect.url', $_SERVER['HTTP_REFERER']);
		}
		// If a user has submitted form data:
		if (!empty($this->data)){
			// First, let's see if there are any users in the database
			// with the username supplied by the user using the form:
			$userinfo = $this->User->findByEmail($this->data['User']['email']);

			// Now compare the form-submitted password with the one in
			// the database.

			if(!empty($userinfo['User']['password']) && $userinfo['User']['password'] == $this->data['User']['password'] && $userinfo['User']['status'] == 'A')
			{
				$_SESSION['isuser'] =  $userinfo['User']['firstname'];
				// This means they were the same. We can now build some basic
				// session information to remember this user as 'logged-in'.
				/*
				echo "<pre>";
				print_r($this->data);
				print_r($userinfo);
				exit;
				*/
				$this->Session->write('Users.id', $userinfo['User']['email']);
				$this->Session->write('Users.name', $userinfo['User']['firstname']);
				$this->Session->write('Users.userid', $userinfo['User']['id']);

				//$this->checkSession();
				// check for redirection url
				$redirectUrl = $this->Session->read('Redirect.url');

				if ($redirectUrl != '')
				{
					if (ereg("\/users\/search\/",$redirectUrl))
					{
						$redirectUrl = $redirectUrl;
					}else
					{
						$redirectUrl =" http://" . $_SERVER['HTTP_HOST'] . $redirectUrl;
					}

					$this->Session->del('Redirect.url');

					// if ($redirectUrl != '')$redirectUrl

					$this->redirect($redirectUrl);
				}else
				{
					//if ($_POST['ref'] != '' && ereg("\/users\/login\/",$_POST['ref']))
					if ($_POST['ref'] != '' && $_POST['ref'] != 'http://yaxmobi.com/users/login') $this->redirect($_POST['ref']);
					else
					$this->redirect("/users/");
					//$this->redirect('/users/welcome');
				}
			}else{
				$this->set('error', true);
			}
		}
	}   // ported

	function logout() {
		$this->Session->del('Redirect');
		$this->Session->del('Users');
		$this->redirect('/');
	} // ported

	function randomnumber(){  // Function to create a random number.
		// seed with microseconds

		srand($this->make_seed());
		$randval = md5(rand());
		return $randval;
	}

	function make_seed(){
		list($usec, $sec) = explode(' ', microtime());
		return (float) $sec + ((float) $usec * 100000);
	}

	// this function confirms a user
	function confirm ()
	{
		/*   print 'ok'; */
		/*   exit; */
		$addQuery = "User.email = '".$this->params['pass'][1]."' and User.activationkey='".$this->params['pass'][0]."' and User.status != 'A'";
		if($TotalRecord = $this->User->findCount($addQuery)){
			$user=$this->User->findAll($addQuery);
			$this->data['User']['id']=$user[0]['User']['id'];
			$this->data['User']['status']='A';
			$this->User->query("insert into userbalances set user_id='".$user[0]['User']['id']."',amount='0'");
			$this->User->save($this->data);
			$this->flash('Congratulations. You have successfully activated your account.','/users/');

		}else
		{
			//echo "<script>alert('We are sorry. This activation key doesnot exist.');</script>";

			$this->flash('We are sorry. This activation key doesnot exist','/users/');
			//$this->redirect('/users/');
		}
	}

	function register()  {
			
		// Function to register on the site.
			
		$cor = 0;
		if(count($_POST)>0){
			if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] == $_POST['captcha']){
				$cor = 3;
			}else{
				$cor = 0;
				$this->set('capch','Enter correct captcha');
			}
		}
		//unset($_SESSION['captcha_keystring']);
		 

		if (!empty($this->data) && $cor == 3){
			// check for existing email id
			$userinfo = $this->User->findByEmail($this->data['User']['email']);
			if (!$userinfo)
			{
				// Generate an activation key to be sent with the mail.
				$activationnumber = $this->randomnumber();
				$this->data['User']['activationkey']=$activationnumber;
				$this->data['User']['country']=$this->params['form']['country'];
				$this->data['User']['birthdate']=$this->params['form']['bYear']."-".$this->params['form']['bMonth']."-".$this->params['form']['bDay'];
				$this->data['User']['gender']=$this->params['form']['gender'];
				$this->data['User']['displayname']=$this->data['User']['firstname'];

				if($this->User->save($this->data)){
					$to = $this->data['User']['email'];
					$toName = $this->data['User']['firstname'];

					$from = 'alert@yaxmobi.com';
					$fromName = 'Account Confirmation';


					$this->Mailer->init();
					$this->Mailer->IsHTML(true);
					$this->Mailer->IsMail();
					$this->Mailer->AddAddress($to, $toName);



					$link = MY_SITE_URL."users/confirm/".$activationnumber."/".$this->data['User']['email'];
					$message = "Dear ". $this->data['User']['firstname']."\n\n";
					$message .= "Thanks for registering on Yaxmobi.com.". "\n\n";
					$message .= "You need to activate your account by clicking the link provided below"."\n";
					$message .= "<a href='". $link ."' target='_blank'>Click here to activate </a>"."\n\n";
					$message .= "Thanks, \n\n Support Team\n Yaxmobi.com \n";

					// Subject of mail
					$subject = "Your Yaxmobi account confirmation";



					ob_start();

					//$this->render('nameOfEmailTemplate', 'nameOfEmailLayout');
					$this->Mailer->Body = nl2br($message);
					$this->Mailer->FromName = 'Account Confirmation';
					$this->Mailer->From = 'alert@yaxmobi.com';
					$this->Mailer->Subject = $subject;

					// Send mail
					if ($this->Mailer->send()) {
						$errMessage = 'Your message has been succefully sent.';
					} else {
						$errMessage = 'There was a problem sending mail: '.$this->Mailer->ErrorInfo;
					}

					//$this->flash('Your account has been successfully created','/users/');
					//$this->Session->write('Users.id', $this->data['User']['email']);
					//$this->Session->write('Users.name', $this->data['User']['firstname']);
					//$this->redirect('/users/profile/');
					$this->redirect('/users/congratulations/');
					die;
				}
			}else
			{
				$errMessage = "This email already exists.";
			}
			$this->set('errMessage', $errMessage);
		}
	} // ported

	function congratulations () // ported
	{
		//$this->session_check();
		$user_id = $this->Session->read('Users.userid');
		$loginuserEmail = $this->Session->read('Users.id');
		if($loginuserEmail==""){
			$loggedIn=true;
		}else { $loggedIn=false; }

		$this->set('loggedIn',$loggedIn);

		$displayName = $this->Session->read('Users.name');
		$this->set('displayName',$displayName);
		//$this->set('users', $this->User->findById($user_id));

		$errMessage = '';

		$this->set('errMessage',$errMessage);

	}


	function confirm__($activate){
		$addQuery = "User.email = '".$this->params['pass'][1]."' and User.activationkey='".$this->params['pass'][0]."' and User.status !='A'";
		if($TotalRecord = $this->User->findCount($addQuery)){
			$user=$this->User->findAll($addQuery);
			/*   $this->query("insert into userbalances set user_id='".$user[0]['User']['id']."',amount='0'"); */
			$this->data['User']['id']=$user[0]['User']['id'];
			$this->data['User']['status']='A';
			$this->User->save($this->data);

			/*   $this->query("insert into userbalances set user_id='".$user[0]['User']['id']."',amount='0'"); */
			$this->redirect('/users/');
		}
		//echo
	}

	function change_password() {
		$this->session_check();
		//$this->set('error', false);
		if (!empty($this->data)){
			$userinfo = $this->User->findByPassword($this->data['User']['password']);
			if(!empty($userinfo['User']['password']) && $userinfo['User']['password'] == $this->data['User']['password']){
				$new_pass= $this->data['User']['new_pass'];
				$confirm_pass=$this->data['User']['confirm_pass'];
				if($new_pass!=$confirm_pass){
					$this->flash('Please Enter same New and Confirm Password','/users/change_password');
				} else {
					$this->data['User']['id']=$userinfo['User']['id'];
					$this->data['User']['password']=$userinfo['User']['password'];
					$this->User->save($this->data);

					//mysql_query("UPDATE Users SET fld_Userpassword ='".$new_pass."' WHERE id = ".$id);

					//mail($mail,"Changed Password","Your new  password is $password","From: info@mbanexus.com");
					$this->set('msg', true);
				}
			}else{
				$this->set('error', true);
			}
		}
	}

	function forget_password(){
			
		$this->set('error', false);
		if (!empty($this->data)) {
			// First, let's see if there is any E-mail in the database
			// with the email supplied by the user using the form:

			$userinfo = $this->User->findByEmail($this->data['User']['email']);

			//echo '<pre>';
			//print_r($userinfo);
			if(!empty($userinfo['User']['email']) && $userinfo['User']['email'] == $this->data['User']['email']) {
				// Address where mail has to be sent
				$to = $this->data['User']['email'];

				// Html message which has to be sent
				$message = "Dear ". $userinfo['User']['firstname'].",\n\n";
				$message .= "Here is your password at yaxmobi.com : ". "\n\n";
				$message .= "Login: ".$userinfo['User']['email']."\n";
				$message .= "Password: ".$userinfo['User']['password']."\n";
				$message .= "Thanks, \n\n Support Team\n yaxmobi.com \n\n";

				// Subject of mail
				$subject = "Your yaxmobi.com account password";

				// To send HTML mail, the Content-type header must be set
				$headers  = 'MIME-Version: 1.0' . "\n";
				$headers .= 'Content-type: text/plain; charset=iso-8859-1' . "\n";

				// Additional headers
				$headers .= 'From: Support Team <'.SUPPORT_EMAIL.'>' . "\n";

				// Mail it
				mail($to, $subject, $message, $headers);
				//echo $message;

				$this->set('msg', true);
				//$this->redirect('/User/Users');
			}else{
				$this->set('error', true);
			}
		}
	}

	function profile(){
		//echo '<pre>';
		$this->session_check();
		$this->set('username',$this->Session->read('Users.name'));
		$this->set('User',$this->User->findByEmail($this->Session->read('Users.id')));
		//print_r($this->User->findByEmail($this->Session->read('Users.id')));
	}
	function profile1(){
		//echo '<pre>';
		$this->set('username',$this->Session->read('Users.name'));
		$this->set('User',$this->User->findByEmail($this->Session->read('Users.id')));
		//print_r($this->User->findByEmail($this->Session->read('Users.id')));
	}



	function personality($id=null) {
		$this->session_check();
		if (!empty($this->data)){
			if($this->User->save($this->data['Profile'])) {
				$this->redirect("/users/personality");
			}
		} else {
			$this->set('username',$this->Session->read('Users.name'));
			$this->set('User',$this->User->findByEmail($this->Session->read('Users.id')));
			$userdata=$this->User->findByEmail($this->Session->read('Users.id'));
			$this->User->id = $userdata['User']['id'];
			$this->User->read();
			//print_r($this->User->findByEmail($this->Session->read('Users.id')));
			//echo '<pre>';
			//print_r($User);
			//exit;
		}
	}

	function lists() {
		$order = "User.created DESC";
		if(empty($this->params['form'])) {
			$this->set('Users', $this->User->findAll(null,null,$order,null,null));
			$this->countryList();
		} else {
			//echo "<pre>";
			//print_r($_POST);
			//die();
			$this->set('browse',@$_POST['gender']);
			$this->set('setMinAge',@$_POST['minAge']);
			$this->set('setMaxAge',@$_POST['maxAge']);
			$this->set('setSS',@$_POST['statusSingle']);
			$this->set('setSM',@$_POST['statusMarried']);
			$this->set('setSR',@$_POST['statusInRelation']);
			$this->set('setSD',@$_POST['statusDivorced']);
			$this->set('setMR',@$_POST['motiveRelationship']);
			$this->set('setMN',@$_POST['motiveNetworking']);
			$this->set('setMF',@$_POST['motiveFriend']);
			$this->set('setMD',@$_POST['motiveDating']);
			$this->set('setCountry',@$_POST['data']['User']['country_id']);
			$this->set('setShowPhoto',@$_POST['showPhotoUsers']);
			$this->set('setShowNamePhoto',@$_POST['showNamePhoto']);

			$addQuery = "";
			$bval = "";
			if(@$_POST['gender']=='F') {
				$addQuery .= "User.gender='F'";
				$bval = " AND ";
			} elseif (@$_POST['gender']=='M') {
				$addQuery .= "User.gender='M'";
				$bval = " AND ";
			}

			if($_POST['minAge']!="") {
				$addQuery .= $bval . "User.birthdate<='" . date("Y-m-d",mktime(0,0,0,date("m"),date("d"),date("Y"))-$_POST['minAge']*24*60*60*365) . "'";
				$bval = " AND ";
			}

			if($_POST['maxAge']!="") {
				$addQuery .= $bval . "User.birthdate>='" . date("Y-m-d",mktime(0,0,0,date("m"),date("d"),date("Y"))-$_POST['maxAge']*24*60*60*365) . "'";
				$bval = " AND ";
			}


			if(@$_POST['motiveNetworking']=='Y' || @$_POST['motiveRelationship']=='Y' || @$_POST['motiveFriend']=='Y' || @$_POST['motiveDating']=='Y') {
				$bval = " AND (";
				if(@$_POST['motiveNetworking']=='Y') {
					$addQuery .= $bval . "User.herefornetwork='Y'";
					$bval = " OR ";
				}

				if(@$_POST['motiveRelationship']=='Y') {
					$addQuery .= $bval . "User.hereforrelation='Y'";
					$bval = " OR ";
				}


				if(@$_POST['motiveFriend']=='Y') {
					$addQuery .= $bval . "User.hereforfriendship='Y'";
					$bval = " OR ";
				}

				if(@$_POST['motiveDating']=='Y') {
					$addQuery .= $bval . "User.herefordate='Y'";
					$bval = " OR ";
				}
				$addQuery .= ")";
			}

			if(@$_POST['data']['User']['country_id']!='') {
				$addQuery .= $bval . "User.country_id=".$_POST['data']['User']['country_id'];
				$bval = " AND ";
			}

			if(@$_POST['statusSingle']=='Y' || @$_POST['statusMarried']=='Y' || @$_POST['statusInRelation']=='Y' || @$_POST['statusDivorced']=='Y') {
				$bval = " AND (";
				if(@$_POST['statusSingle']=='Y') {
					$addQuery .= $bval . "Profile.maritalstatus='3'";
					$bval = " OR ";
				}

				if(@$_POST['statusMarried']=='Y') {
					$addQuery .= $bval . "Profile.maritalstatus='5'";
					$bval = " OR ";
				}

				if(@$_POST['statusInRelation']=='Y') {
					$addQuery .= $bval . "Profile.maritalstatus='2'";
					$bval = " OR ";
				}

				if(@$_POST['statusDivorced']=='Y') {
					$addQuery .= $bval . "Profile.maritalstatus='4'";
					$bval = " OR ";
				}

				$addQuery .= ")";
			}


			$allResult = $this->User->findAll($addQuery,null,$order,null,null);
			$this->set('Users', $this->User->findAll($addQuery,null,$order,null,null));
			$CountryList = $this->Country->generateList(null, null, null, '{n}.Country.id', '{n}.Country.countryname');
			$this->set('CountryList',$CountryList);
			//echo "<pre>";
			//print_r($allResult);
			//die();
		}
	}

	function pprofile($id = null)  // View User public profile
	{
		$this->User->id = $id;
		$this->data = $this->User->read();
		$this->set('user',$this->data);
		$this->set('herefor', $this->herefor());
		$this->set('marritalstatus', $this->marritalstatus());

		$location1 = array();
		$location2 = array();
		if($this->data['User']['address'] != "") $location1[] = ucwords($this->data['User']['address']);
		if($this->data['User']['city'] != "") $location1[] = ucwords($this->data['User']['city']);
		if($this->data['User']['state'] != "") $location2[] = ucwords($this->data['User']['state']);
		if($this->data['Country']['countryname'] != "") $location2[] = strtoupper($this->data['Country']['countryname']);

		$this->set('location', implode(", ", $location1).'<br>'.implode(", ", $location2));
	}

	function herefor()
	{
		$herefor = array();
		if(strtoupper($this->data['User']['herefordate']) == 'Y') $herefor[] = 'Dating';
		if(strtoupper($this->data['User']['hereforcareer']) == 'Y') $herefor[] = 'Career';
		if(strtoupper($this->data['User']['hereforfriendship']) == 'Y') $herefor[] = 'Friendship';
		if(strtoupper($this->data['User']['herefornetwork']) == 'Y') $herefor[] = 'Network';
		if(strtoupper($this->data['User']['hereforsocializing']) == 'Y') $herefor[] = 'Social Works';
		if(strtoupper($this->data['User']['hereforeducation']) == 'Y') $herefor[] = 'Education';
		if(strtoupper($this->data['User']['hereforjobs']) == 'Y') $herefor[] = 'Job';
		return implode(", ", $herefor);
	}

	function marritalstatus()
	{
		//1 == married
		//2 == In a relationship
		//3 == Single
		//4 == Divorcee

		$marritalstatus = "";
		if($this->data['Profile']['maritalstatus']==1) $marritalstatus = 'Married';
		elseif($this->data['Profile']['maritalstatus']==2) $marritalstatus = 'In a Relationship';
		elseif($this->data['Profile']['maritalstatus']==3) $marritalstatus = 'Single';
		elseif($this->data['Profile']['maritalstatus']==4) $marritalstatus = 'Divorcee';
		return $marritalstatus;
	}
	/*
	 * Aries - March 21 - April 20
	 * Taurus - April 21 - May 21
	 * Gemini - May 22 - June 21
	 * Cancer - June 22 - July 22
	 * Leo - July 23 -August 21
	 * Virgo - August 22 - September 23
	 * Libra - September 24 - October 23
	 * Scorpio - October 24 - November 22
	 * Sagittarius - November 23 - December 22
	 * Capricorn - December 23 - January 20
	 * Aquarius - January 21 - February 19
	 * Pisces - February 20- March 20
	 */
	/****************************************************************************************************/
	//ADMIN METHODS
	/****************************************************************************************************/

	function admin_index()  // Default Page for listing and managing User in Admin section.
	{
		$this->session_checkadmin();
		$this->Pagination->ajaxDivUpdate = "tasks_todo";
		$this->Pagination->url = "paging";
		$this->Pagination->style = "ajax";
		$this->Pagination->onComplete ="show('tasks_todo')";
		$this->Pagination->_setPrivateParameter("onComplete");
		list($order,$limit,$page) = $this->Pagination->init(NULL);
		if(empty($_GET['char']))
		{
			$addQuery="";
		}
		else
		{
			$addQuery="User.firstname LIKE '".$_GET['char']."%'" ;
		}

		if(!empty($_POST['search']) && $_POST['search'] == 'search')  // Search by keyword.
		{
			$addQuery .= "User.firstname LIKE '%". $_POST['searchkeyworld']."%'";
		}

		if(!empty($_POST['edit']) && !empty($_POST['id']))
		{
			if (($_POST['id']>0) && ($_POST['num']>0))
			{
				$this->Cartitem->query("delete from userbalances where user_id=".$_POST['id']."");
				$this->Cartitem->query("insert into userbalances (amount,user_id) values (".$_POST['num'].",".$_POST['id'].")");
			}
		}
		//$us = $this->Cartitem->query("select * from users where  id=".$id);

		$this->set('users', $this->User->findAll($addQuery, NULL, $order, $limit, $page));
		$subscript = $this->Cartitem->query("select * from subscriptions");
		$this->set('subscript',$subscript);
		$ballance = $this->Cartitem->query("select * from userbalances");
		$this->set('userbalances',$ballance);
		//echo "<pre>";
		//print_r($firstname);
		$this->render('admin_index');
	}



	function ajaxValidateUsername()  // Username validation in Ajax
	{
		if($this->User->findByFld_Userid ($this->data['User']['fld_Userid']))
		{
			$valid = false;
		}
		else
		{
			$valid = true;
		}
		if ($valid)
		{
			$this->set('labelText', '<font color="green">Login ID - ok</font>');
		}
		else
		{
			$this->set('labelText', '<font color="red"><b>Login - Taken. Please choose another</b></font>');
		}

		$this->render('usernamelabel', 'ajax');
	}


	function admin_searchresult($page=1)  // Search Function.
	{
		//echo("<pre>");
		//print_r($_POST);
		$addQuery = "";
		$bval = "";
		if(!empty($_POST['data']['User']['txtsearch']))  // Search by keyword.
		{
			if($_POST['data']['User']['search']=='fld_Userfirstname')
			$addQuery .= "fld_Userfirstname like '".$_POST['data']['User']['txtsearch']."%'" ;

			else
			$addQuery .= "fld_Userid like '".$_POST['data']['User']['txtsearch']."%'" ;

			//$bval = " OR ";
		}
		/*if(!empty($_POST['start_date_from']))  // Search by date from.
		 {
		 $addQuery .= $bval ."User.created >= '".$_POST['start_date_from']." 00:00:00'" ;
		 $bval = " AND ";
		 }
		 if(!empty($_POST['start_date_to']))  // Search by date to.
		 {
		 $addQuery .= $bval ."User.created <= '".$_POST['start_date_to']." 00:00:00'" ;
		 }*/

		$countTotalUser = $this->User->findCount($addQuery);  // Finds Total Number of User.
		$this->set('countTotalUser',$countTotalUser);
		$this->Pagination->ajaxDivUpdate = "tasks_todo";
		$this->Pagination->url = "paging";
		$this->Pagination->style = "ajax";
		$this->Pagination->onComplete ="show('tasks_todo')";
		$this->Pagination->_setPrivateParameter("onComplete");
		list($order1,$limit1,$page1) = $this->Pagination->init($addQuery);
		$r = $this->User->findAll( $addQuery
		, null
		, $order1
		, $limit1
		, $page1
		, null
		);
		$this->set('Users', $r);
		$this->render('todo', 'ajax');

	}

	function admin_delete()  // Delete User
	{
		for($i=0; $i<count($_POST['box_']); $i++) {
			$this->User->del($_POST['box_'][$i]);
		}
		$this->paging();
	}

	function paging()  // Paging funtion
	{
		$this->Pagination->ajaxDivUpdate = "tasks_todo";
		$this->Pagination->url = "paging";
		$this->Pagination->style = "ajax";
		$this->Pagination->style = "ajax";
		$this->Pagination->onComplete ="show('tasks_todo')";
		$this->Pagination->_setPrivateParameter("onComplete");

		list($order,$limit,$page) = $this->Pagination->init(NULL);

		$this->set('users', $this->User->findAll(NULL, NULL, $order, $limit, $page));
		$this->render('todo', 'ajax');

	}

	function updateMultiple($uPID, $status){  // Updates status.
		$this->data['User']['id'] = $uPID;
		$this->data['User']['status']=$status;
		$this->User->save($this->data['User']);
	}



	/*  function admin_updatestatus()  // Change Status Action
	 {
	 for($i=0; $i<count($_POST['box_']); $i++) {
	 $this->updateMultiple($_POST['box_'][$i], $_POST['new_status']);
	 }

	 $this->admin_index();
	 }
	 */

	function admin_suspend()  // Suspend Blog
	{
		if(isset($_POST['box_']) && count($_POST['box_'])>0)
		for($i=0; $i<count($_POST['box_']); $i++) {
			$this->updateMultiple($_POST['box_'][$i], 'S');
		}
		$this->paging();
	}


	function admin_activate()  // Activate Blog
	{
		if(isset($_POST['box_']) && count($_POST['box_'])>0)
		for($i=0; $i<count($_POST['box_']); $i++) {
			$this->updateMultiple($_POST['box_'][$i], 'A');
		}
		$this->paging();
	}


	function admin_view($id = null)  // View User Data in Admin
	{
		if (empty($this->data))
		{
			$this->User->id = $id;
			$this->data = $this->User->read();

			$this->set('user',$this->data);

			$us = $this->Cartitem->query("select * from users where  id=".$id);
			$this->set('us',$us[0]['users']);
			$sub = $this->Cartitem->query("select * from subscriptions where  id=".$us[0]['users']['id_subscript']);

			$this->set('sub',$sub[0]['subscriptions']);


			///////////////
			$jokes = $this->Cartitem->query("select * from jokes where  user_id=".$us[0]['users']['id']);
			$this->set('jokes',$jokes);
			$stat = $this->Cartitem->query("select * from statistic where  id_user=".$us[0]['users']['id']); $this->set('stat',$stat);

			$bal = $this->Cartitem->query("select * from userbalances where  user_id=".$us[0]['users']['id']); $this->set('bal',$bal[0]['userbalances']);

		}
	}

	function admin_stat($id = null)  // View User Data in Admin
	{
		$month = array();
		for ($i=0;$i<30;$i++)
		{
			$date =  mktime(0,0,0,date("m"),date("d")-$i,date("Y"));
			$month[date("F d, Y", $date)]['fj'] = 0;
			$month[date("F d, Y", $date)]['pj'] = 0;
			$month[date("F d, Y", $date)]['pr'] = 0;
			$month[date("F d, Y", $date)]['pcpj'] = 0;
			$month[date("F d, Y", $date)]['pcfj'] = 0;

		}
		$year = array();
		for ($i=0;$i<24;$i++)
		{
			$date =  mktime(0,0,0,date("m")-$i,date("d"),date("Y"));
			$year[date("F Y", $date)]['fj'] = 0;
			$year[date("F Y", $date)]['pj'] = 0;
			$year[date("F Y", $date)]['pr'] = 0;
			$year[date("F Y", $date)]['pcpj'] = 0;
			$year[date("F Y", $date)]['pcfj'] = 0;

		}

		$temp_month = $this->Cartitem->query("select count(*) as num,statistic.* from statistic where gdate > NOW() - interval 1 month and type='pr' group by gdate order by gdate desc");
		foreach($temp_month as $doc)
		{
			$month[date("F d, Y", $doc['statistic']['time'])]['pr'] = $doc['0']['num'];
		}
		$temp_month = $this->Cartitem->query("select count(*) as num,statistic.* from statistic where gdate > NOW() - interval 1 month and type='pj' group by gdate order by gdate desc");
		foreach($temp_month as $doc)
		{
			$month[date("F d, Y", $doc['statistic']['time'])]['pj'] = $doc['0']['num'];
		}

		$temp_month = $this->Cartitem->query("select count(*) as num,statistic.* from statistic where gdate > NOW() - interval 1 month and type='fj' group by gdate order by gdate desc");

		foreach($temp_month as $doc)
		{
			$month[date("F d, Y", $doc['statistic']['time'])]['fj'] = $doc['0']['num'];
		}
		////
		$temp_month = $this->Cartitem->query("select count(*) as num,statistic.* from statistic where gdate > NOW() - interval 1 month and type='pcpj' group by gdate order by gdate desc");

		foreach($temp_month as $doc)
		{
			$month[date("F d, Y", $doc['statistic']['time'])]['pcpj'] = $doc['0']['num'];
		}

		$temp_month = $this->Cartitem->query("select count(*) as num,statistic.* from statistic where gdate > NOW() - interval 1 month and type='pcfj' group by gdate order by gdate desc");

		foreach($temp_month as $doc)
		{
			$month[date("F d, Y", $doc['statistic']['time'])]['pcfj'] = $doc['0']['num'];
		}

		///////////////////////////////////////////
		//////////////////////////////////////////
		$temp_years = $this->Cartitem->query("select count(*) as num,statistic.* from statistic where gdate > NOW() - interval 24 month and type='pr' group by date order by gdate desc");
		foreach($temp_years as $doc)
		{
			$year[date("F Y", $doc['statistic']['time'])]['pr'] = $doc['0']['num'];
		}
		$temp_years = $this->Cartitem->query("select count(*) as num,statistic.* from statistic where gdate > NOW() - interval 24 month and type='pj' group by date order by gdate desc");
		foreach($temp_years as $doc)
		{
			$year[date("F Y", $doc['statistic']['time'])]['pj'] = $doc['0']['num'];
		}
		$temp_years = $this->Cartitem->query("select count(*) as num,statistic.* from statistic where gdate > NOW() - interval 24 month and type='fj' group by date order by gdate desc");
		foreach($temp_years as $doc)
		{
			$year[date("F Y", $doc['statistic']['time'])]['fj'] = $doc['0']['num'];
		}

		$temp_years = $this->Cartitem->query("select count(*) as num,statistic.* from statistic where gdate > NOW() - interval 24 month and type='pcpj' group by date order by gdate desc");
		foreach($temp_years as $doc)
		{
			$year[date("F Y", $doc['statistic']['time'])]['pcpj'] = $doc['0']['num'];
		}

		$temp_years = $this->Cartitem->query("select count(*) as num,statistic.* from statistic where gdate > NOW() - interval 24 month and type='pcfj' group by date order by gdate desc");
		foreach($temp_years as $doc)
		{
			$year[date("F Y", $doc['statistic']['time'])]['pcfj'] = $doc['0']['num'];
		}



		$this->set('month',$month);
		$this->set('years',$year);

	}


	function searchUser()
	{
		$this->Pagination->ajaxDivUpdate = "tasks_todo";
		$this->Pagination->url = "searchUser_paging";
		$this->Pagination->style = "ajax";
		$this->Pagination->onComplete ="show('tasks_todo')";
		$this->Pagination->_setPrivateParameter("onComplete");
		list($order,$limit,$page) = $this->Pagination->init(NULL);
		$this->set('Users', $this->User->findAll(NULL, NULL, $order, $limit, $page));
		$firstname = $this->User->generateList(null, null, null, '{n}.User.id', '{n}.User.fld_Userfirstname');
		$loginID = $this->User->generateList(null, null, null, '{n}.User.id', '{n}.User.fld_Userid');
		$lastname = $this->User->generateList(null, null, null, '{n}.User.id', '{n}.User.fld_Userlastname');
		foreach($firstname as $key => $val)
		{
			$firstname[$key] .=  " ".$lastname[$key];
		}
		$firstname[0]='--Select Name--';
		ksort($firstname);
		$this->set('Names',$loginID);
		$this->render('searchUser');

	}

	function searchUser_paging(){  // Paging funtion
		$this->Pagination->ajaxDivUpdate = "tasks_todo";
		$this->Pagination->url = "searchuser_paging";
		$this->Pagination->style = "ajax";
		$this->Pagination->onComplete ="show('tasks_todo')";
		$this->Pagination->_setPrivateParameter("onComplete");
		list($order,$limit,$page) = $this->Pagination->init(NULL);
		$this->set('Users', $this->User->findAll(NULL, NULL, $order, $limit, $page));
		$this->render('searchuser_todo', 'ajax');

	}


	/*
	 * This function updates view = view + 1
	 * @param $id
	 * @return unknown_type
	 */
	function set_view_joke($id)
	{
		$sql = "update songs SET view = (view+1) WHERE id = '".$id."'";
		$this->Song->Query($sql);
	}
	/*
	 * This function plays the selected audio joke
	 * @param $songid
	 * @param $folder
	 * @return unknown_type
	 */
	function player($songid = '',$folder='')
	{
		$paind = 0;
		if ($folder=='pending')
		{
			$paind = 1;
			$folder = '';
		}
		if ($folder == 'ring')
		{
			//$songid;
			if (trim($songid) != 'ticker_space.gif')
			{
				$this->Session->write('Relatedjoke.myjokeid',$songid);
				$this->Session->write('Relatedjoke.type', "ring");
			}
			$folder = '';
			$sql = "select * from ringtones where id=$songid";
			$result = mysql_query($sql);
			$object = mysql_fetch_array($result);
			$this->set('songRec',$object);
			$this->set('type',"ring");
			$songFile = $object['prew_ringtone'];
			$this->set('songFile',$songFile);

			$cat_id = $object['category'];
			$sql = "select title from ringtonecategories where id=$cat_id";
			$result = mysql_query($sql);
			$object = mysql_fetch_array($result);
			$cat_name = $object['title'];
			$this->set('catName',$cat_name);
		}
		else
		{
			$folder = '';
			/*
			 *	Set Audio joke id in session for displaying related audio jokes
			 * @param $songid
			 * @param $folder
			 * @return unknown_type
			 */
				
			//$songid;
			if (trim($songid) != 'ticker_space.gif')
			{
				$this->Session->write('Relatedjoke.myjokeid',$songid);
				$this->Session->write('Relatedjoke.type', "Joke");
			}
				
			/*
			 * Update view times for song id
			 * @param $songid
			 * @param $folder
			 * @return unknown_type
			 */
			$this->set_view_joke($songid);
				
			$songRec = $this->Song->findAll('Song.id='.$songid,null,null,null,null,0);
			$this->set('songRec',$songRec);

			/*           print_r($songRec); */
			//echo $folder;
			$songFile = "";
			if ( $songRec )
			{
				/*   	        print "\nOK\n"; */
				$sampleFile =  $songRec[0]['Song']['sample_file'];
				$sampleFile_b =  $songRec[0]['Song']['sample_file_before'];

				$mainFile =  $songRec[0]['Song']['path'];

				if ($folder != '')
				{

					$file = WWW_ROOT . 'img/songs/' . $sampleFile;


					if (is_file($file) && ($_SERVER['HTTP_REFERER'] == 'http://www.yaxmobi.com/users/welcome' || $_SERVER['HTTP_REFERER'] == 'http://www.yaxmobi.com/users/send/form/'.$songid))
					{
							
						$songFile = $folder . '/' . $sampleFile;
					}
					else if ( is_file(WWW_ROOT . 'img/songs/' . $sampleFile_b) &&  $_SERVER['HTTP_REFERER'] != 'http://www.yaxmobi.com/users/welcome')
					{

						$songFile = $sampleFile_b;
					}
					else if ( is_file(WWW_ROOT . 'img/songs/' . $mainFile) )
					{

						$songFile = '';
					}else
					{

						$songFile = "";
					}

				}else
				{
					$referrer = '';
					if (isset($_SERVER['HTTP_REFERER']))
					$referrer = $_SERVER['HTTP_REFERER'];


					if ( is_file( WWW_ROOT . 'img/songs/' . $sampleFile ) &&  ($referrer == 'http://www.yaxmobi.com/users/welcome' || $referrer == 'http://www.yaxmobi.com/users/send/form/'.$songid || $paind))
					{
						$songFile = $sampleFile;
					}else if ( is_file(WWW_ROOT . 'img/songs/' . $sampleFile_b) &&  $referrer != 'http://www.yaxmobi.com/users/welcome')
					{
							
						$songFile = $sampleFile_b;
					}else
					{
						/*          print WWW_ROOT . 'img/songs/' . $sampleFile_b; */
						if(is_file(WWW_ROOT . 'img/songs/' . $sampleFile_b)) {
							$songFile = $sampleFile_b;
							/*              print 'ok2'; */
						} elseif(is_file(WWW_ROOT . 'img/songs/' . $sampleFile)) {
							$songFile = $sampleFile;
							/*                print 'ok3'; */
						} else {
							$songFile = "";
							/*                  print 'ok4'; */
						}
					}
				}
			}
			/*           echo WWW_ROOT;  */
			/*           exit; */
			$this->set('songFile',$songFile);

			$path  = WWW_ROOT."img". DS ."player".DS;
			$this->set('path',$path);
		}

	}

	function tellafriend(){
		$this->set('path','jjjj');
	}

	//////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////
	/////////////////// ������� �����////////////////////
	///////////////////������� �����/////////////////////
	//////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////
	function export_joke2(){
			
		$dir = opendir("../../files/WMA_DRM/");
		chdir("../../files/WMA_DRM/");
		$mass = array();
		while($f=readdir($dir))
		{
			if (is_file($f) &&($f != '.')&&($f != '..'))
			{
				$mass[strtolower($f)] = $f;
			}

		}
		closedir($dir);

		$dir2 = opendir("../jsp/");

		//chdir("../../../files/jsp/");
		$mass_jsp = array();
		while($f2=readdir($dir2))
		{
			if (is_file($f2) &&($f2 != '.')&&($f2 != '..'))
			{
				$mass_jsp[strtolower($f2)] = $f2;
			}

		}
		closedir($dir2);


		$dir3 = opendir("../previews/");

		//chdir("../files/previews/");
		$mass_pre = array();
		while($f=readdir($dir3))
		{
			if (is_file($f) &&($f != '.')&&($f != '..'))
			{
				$mass_pre[strtolower($f)] = $f;
			}

		}
		closedir($dir3);


			
			
		$items = mysql_query("select * from songs");

		while ($data = mysql_fetch_assoc($items))
		{

			$path = $data['path'];

			if (is_file("../WMA_DRM/".$mass[str_replace(".mp3",".wma",str_replace("_"," ",$path))]))
			{


				// if (copy("".$mass[str_replace(".mp3",".wma",str_replace("_"," ",$path))],"../../app/webroot/img/songs/drm_".str_replace(".mp3",".wma",$path)))
				if(1)
				{

					print '3 '.$path.'<br>';
					mysql_query("update songs set drm='drm_".str_replace(".mp3",".wma",$path)."', type='wma' where id=".$data['id']);


				}
				else
				{

					print '2 '.$path.'<br>';
				}

			}
			else
			{

				print '1 '.$path.'<br>';
			}

		}




	}







	function export_joke(){
			
		$dir = opendir("../../../files/jmp/");
		chdir("../../../files/jmp/");
		$mass_jmp = array();
		while($f=readdir($dir))
		{
			if (is_file($f) &&($f != '.')&&($f != '..'))
			{
				$mass_jmp[strtolower($f)] = $f;
			}

		}
		closedir($dir);

		$dir2 = opendir("../jsp/");

		//chdir("../../../files/jsp/");
		$mass_jsp = array();
		while($f2=readdir($dir2))
		{
			if (is_file($f2) &&($f2 != '.')&&($f2 != '..'))
			{
				$mass_jsp[strtolower($f2)] = $f2;
			}

		}
		closedir($dir2);


		$dir3 = opendir("../previews/");

		//chdir("../files/previews/");
		$mass_pre = array();
		while($f=readdir($dir3))
		{
			if (is_file($f) &&($f != '.')&&($f != '..'))
			{
				$mass_pre[strtolower($f)] = $f;
			}

		}
		closedir($dir3);

		$genres_temp = $this->Cartitem->query("select * from genres");
		$genres = array();
		foreach($genres_temp as $doc)
		{
			$genres[strtolower(trim($doc['genres']['gname']))]=$doc['genres']['id'];
		}

		$singers_temp = $this->Cartitem->query("select * from singers");
		$singers = array();
		foreach($singers_temp as $doc)
		{
			$singers[strtolower(trim($doc['singers']['sname']))]=$doc['singers']['id'];
		}

		$albums_temp = $this->Cartitem->query("select * from  albums");
		$albums = array();
		foreach($albums_temp as $doc)
		{
			$albums[strtolower(trim($doc['albums']['aname']))]=$doc['albums']['id'];
		}

		$list = fopen("http://yaxmobi.com/export_j.csv","r");

		if ($list)
		{

			$new_list = fopen("../../app/webroot/new_export_joke_".date("Y_m_d_h_i_s").".csv","w");

			$i=1;
			while (($data = fgetcsv($list, 100000, ";")) != FALSE)
			{
				if ($i == 1)
				{
					fputcsv($new_list,$data,";");
				}
				else
				{

					$name = $data[0];
					$singer = $data[1];
					$album = $data[2];
					$genre = $data[3];
					$year = $data[4];
					$duration = $data[5];
					$pc = $data[6];
					$phone = $data[7];
					$type = $data[8];
					$path = $mass_jsp[strtolower($data[9])];
					$pathdrm = $mass_jmp[strtolower($data[10])];
					$pathsim = $mass_pre[strtolower($data[11])];

					if (key_exists(strtolower(trim($singer)),$singers))
					$singer_id = $singers[strtolower(trim($singer))];
					else
					$singer_id = 0;

					if (key_exists(strtolower(trim($album)),$albums))
					$album_id = $albums[strtolower(trim($album))];
					else
					$album_id = 0;

					if (key_exists(strtolower(trim($genre)),$genres))
					$genre_id = $genres[strtolower(trim($genre))];
					else
					$genre_id = 0;

					$pay = 'Y';
					if(trim($type) == 'F')
					$pay = 'N';


					if (strtolower(trim($genre) != '' && key_exists(strtolower(trim($genre)),$genres)) && is_file("../jsp/".$path) && is_file("../jmp/".$pathdrm))
					{


						if (copy("../jsp/".$path,"../../app/webroot/img/songs/".strtolower(str_replace(" ","_",$path))) && copy("../jmp/".$pathdrm,"../../app/webroot/img/songs/drm_".strtolower(str_replace(" ","_",$pathdrm))))
						{
							$simple = '';
							if (copy("../previews/".$pathsim,"../../app/webroot/img/songs/preview_".strtolower(str_replace(" ","_",$pathsim))))
							{
								$simple = 'preview_'.strtolower(str_replace(" ","_",$pathsim));
							}

							$tp = 'mp3';

							if ($pos = strrpos($pathdrm, '.')) {
								$tp = substr($pathdrm, $pos);
							}


							$temp = $this->Cartitem->query("insert into songs set
  composition='".mysql_escape_string($name)."',
  singer_id=".$singer_id.",
  album_id=".$album_id.",
  genre_id=".$genre_id.",
  year='".trim($year)."',
  path='".mysql_escape_string(strtolower(str_replace(" ","_",$path)))."',
  paid='".$pay."',
  created='".date("Y-m-d H:i:s")."',
  modified='".date("Y-m-d H:i:s")."',
  duration='".trim($duration)."',
  type='".str_replace(".","",$tp)."',
  rate='".str_replace(",",".",$pc)."',
  ratepc='".strval(floatval(str_replace(",",".",$pc))+floatval(str_replace(",",".",$pc)))."',
  drm='drm_".mysql_escape_string(strtolower(str_replace(" ","_",$pathdrm)))."',
  sample_file='".mysql_escape_string($simple)."',
  
  or_file='".mysql_escape_string($path)."'  ");
						}
						else
						{

							fputcsv($new_list,$data,";");
						}

					}
					else
					{

						fputcsv($new_list,$data,";");
					}

				}

				$i++;
			}
			fclose($new_list);
			fclose($list);
		}
	}

	//////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////
	/////////////////// ������� ���������////////////////////
	///////////////////������� ���������/////////////////////
	//////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////

	function export_ring(){
			
		$dir = opendir("../../../files/Rings/");
		chdir("../../../files/Rings/");
		$mass_r = array();
		while($f=readdir($dir))
		{
			if (is_file($f) &&($f != '.')&&($f != '..'))
			{
				$mass_r[strtolower($f)] = $f;
			}

		}
		closedir($dir);


		$genres_temp = $this->Cartitem->query("select * from ringtonecategories");
		$genres = array();
		foreach($genres_temp as $doc)
		{
			$genres[strtolower(trim($doc['ringtonecategories']['title']))]=$doc['ringtonecategories']['id'];
		}


		$list = fopen("http://yaxmobi.com/export_r.csv","r");
		if ($list)
		{
			$new_list = fopen("../../app/webroot/new_export_ring_".date("Y_m_d_h_i_s").".csv","w");
			$i=1;
			while (($data = fgetcsv($list, 100000, ";")) != FALSE)
			{
				if ($i == 1)
				{
					fputcsv($new_list,$data,";");
				}
				else
				{
					$name = $data[0];
					$desc = $data[1];
					$genre = $data[3];
					$price = $data[7];
					$type = $data[8];
					$path = $mass_r[strtolower($data[9])];


					if (key_exists(strtolower(trim($genre)),$genres))
					$genre_id = $genres[strtolower(trim($genre))];
					else
					$genre_id = 0;

					$pay = '1';
					if(trim($type) == 'F')
					$pay = '0';

					if (strtolower(trim($genre) != '' && key_exists(strtolower(trim($genre)),$genres)) && is_file("../Rings/".$path))
					{
						 
						if (copy("../Rings/".$path,"../../app/webroot/tone/".strtolower(str_replace(" ","_",$path))))
						{
							$temp = $this->Cartitem->query("insert into ringtones set
  title='".mysql_escape_string($name)."',  
  category=".$genre_id.",  
  ringtone='".mysql_escape_string(strtolower(str_replace(" ","_",$path)))."',
  description='".$desc."',
  type='".$pay."',
  price='".str_replace(",",".",$price)."' ,
  status=1
  ");
						}
						else
						fputcsv($new_list,$data,";");

					}
					else
					fputcsv($new_list,$data,";");

				}

				$i++;
			}
			fclose($new_list);
			fclose($list);
		}
	}
}

?>