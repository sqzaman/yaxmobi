<?php

namespace Front\YxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class TellafriendsController extends BaseController {
    
    /**
     * @Route("/tellafriends")
     * @Route("/tellafriends/")
     * @Route("/tellafriends/add")
     * @Route("/tellafriends/add/{char}")
     * @Route("/tellafriends/add/{char}/")
     */
    public function add( $char = null ){
        $this->_conn = $this->get('database_connection');
        $this->_session = $this->getRequest()->getSession();
        
        $char_array = explode(',',$char);
        
        if (isset($char_array[1])){
            $type_char = 'wj';
            $char = $char_array[0];

        }else{
            $type_char = 'j';
        }
        
        $user_id = $this->_session->get('Users.userid');
        $this->_viewData['user_id'] = $user_id;
        
        $displayName = $this->_session->get('Users.name');
        $this->_viewData['displayName'] = $displayName;
        
        $loginuserEmail = $this->_session->get('Users.id');
        
        if($user_id == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        $em = $this->get('doctrine')->getEntityManager();
        /*$carrs = $em->getRepository('YxBundle:Carriers')->findAll();
        
        $carriers = array();
        foreach ( $carrs as $carr ){
            $carriers[] = $carr->getCarriername();
        }
        
        $this->_viewData['carriers'] = $carriers;*/
        
        $songId = '';
        $songType = '';
        
        //echo "<pre>"; print_r( $_POST );die;
        if (isset($_POST['typer']) && $_POST['typer'] == 'sms'){
            $cor = 3;
            
            
            /*if(count($_POST) > 0){
                if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] == $_POST['captcha2']){
                    $cor = 3;
                }else{
                    $cor = 0;
                    $this->_viewData['capch'] = 'Enter correct captcha for sending sms';
                }
            }*/

            if ( $cor == 3 && $_POST['phone'] != '' ){
                $carrier = $_POST['carrier'];

                if (($carrier != '')){
                    $number = urlencode($_POST['phone']);
                    $carrier = urlencode($carrier);
                    $text = urlencode($_POST['message']);
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

                        $this->_viewData['capch'] = 'Thanks for sending sms';
                    }
                }else{
                    $this->_viewData['capch'] = 'Enter phone and carrier';
                }
            }else{
                    $this->_viewData['capch'] = 'Please enter correct phone number, carrier, and characters from the picture in order to send text message';
            }
        }else{
            
            //$cor = 0;
            $cor = 3;
            
            /*if(count($_POST)>0){
                if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] == $_POST['captcha']){
                        $cor = 3;
                }else{
                        $cor = 0;
                        $this->_viewData['capch'] = 'Enter correct captcha';
                }
            }*/

            if ($cor == 3){
                $tafType = 1;

                if ($char != ''){
                    $findChar = strpos($char,',');
                    if($findChar==true){
                        $str = explode(',',$char);
                        $songId = $str[0];
                        $songType = 'joke';
                    }else{
                        $songId = $char;
                        $songType = 'song';
                    }

                    $greeting = "Send this ".$songType." to a friend.Please fill out the form below.";
                    $mailMessage = "Hello!  Your friend wanted to put a smile on your face by sending you this cool audio joke.  <a href='http://www.develop.yaxmobi.com/users/player/$char'>Click here</a> to listen to the joke.  If you are unable to play it, kindly copy and paste the URL below into your browser.";
                    $mailMessage_w = "Hello!  Your friend wanted to put a smile on your face by sending you this cool joke.  <a href='http://www.develop.yaxmobi.com/jokes/read_joke/$char'>Click here</a> to read to the joke.";
                    $tafType = 2;
                }else{
                    $songType = '';
                    $greeting = "Use this form to tell your friends about yaxmobi.com, place full of smile,humour and laughter.";
                    $mailMessage = "Hello,\nWelcome to the best source of Music and videoclips! Here you will find music of any genre, country and time. yaxmobi.com contains enormous amount of MP3 and video files! MP3 and video music to any taste!";
                }
                    
                $errMessage = '';
                
                // set welcome greeting message
                $this->_viewData['greeting'] = $greeting;
                // set welcome mail message
                $this->_viewData['mailMessage'] = $mailMessage;
                $this->_viewData['tafType'] = $tafType;
                
                // set song id
                $this->_viewData['songId'] = $songId;
                $this->_viewData['songType'] = $songType;

                if (!empty($_POST)){
                    $this->data = $_POST['tellafriend'];
                    $friendemailid	= explode(',', $this->data['friendemailadd']);

                    $fromName = $this->data['fname'] . ' ' . $this->data['lname'];

                    $fromEmail = $this->data['myemail'];

                    $subject = "General Comment or Question";

                    $msg = $this->data['message'];

                    $taf = MY_SITE_URL . $_POST['taf'];

                    if ($this->data['id'] != ''){
                        if ($this->data['songType'] == 'joke'){
                            $songUrl = "http://develop.yaxmobi.com/jokes/read_joke/".$this->data['id'];
                        }else{
                            $songUrl = "http://develop.yaxmobi.com/users/player/".$this->data['id'];
                        }
                        
                        $msg .= "\n<a href='".$songUrl."'>Click here</a> to listen to the joke.<br>  If you are
unable to click the link directly, kindly copy and paste the URL (below) into your browser
.<br><br>".$songUrl."<br><br><a href='http://develop.yaxmobi.com'>Yaxmobi.com</a>";
                    }

                    $message = "<html>
                                <head>
                                <title>Music and jokes</title>
                                <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>

                                <style>
                                body{
                                FONT-WEIGHT: normal; 
                                FONT-SIZE: 12px; 
                                margin: 0px;
                                padding: 0px;
                                background-color: #333366;
                                COLOR: #FFFFFF;
                                }

                                .tableHeading
                                {
                                border: 1px solid #ECEDEC;
                                background-color: #9090CB;
                                }
                                </style>
                                </head>
                                <body>
                                <table class='tableHeading' width='100%'>
                                <tr>
                                    <td>
                                            <img alt='Yaxmobi.com' src='cid:my-attach'>
                                    </td>
                                    <td width='25'>&nbsp;</td>
                                    <td valign='MIDDLE'>
                                            <p><a href='". MY_SITE_URL ."'>Yaxmobi.com</a>: experience humor differently!</p>
                                            <p>Come in and leave with a smile!</p>
                                            <p><a href='". MY_SITE_URL ."'>Yaxmobi.com</a>: your daily laughter pill!  No prescription needed.</p>
                                    ";
                                    if ($char != ''){
                                        if ($type_char=='j'){
                                            $message .= $mailMessage.'<br />';
                                            $message .= "<a href='". MY_SITE_URL ."users/player/$char'>". MY_SITE_URL ."users/player/$char</a><br /><br />";
                                        }else{
                                            $message .= $mailMessage_w.'<br />';
                                            $message .= "<a href='". MY_SITE_URL ."jokes/read_joke/$char'>". MY_SITE_URL ."jokes/read_joke/$char</a><br /><br />";
                                        }
                                    }
                                    $message .= "</td>
                                </tr>
                                <tr>
                                    <td colspan='3'>".$msg."<br><br>
                                <a href='".$taf."'><img src='". MY_SITE_URL ."img/tellafriend.gif'> Spread the laughter: Send to your friends</a><br>
                                <a href='". MY_SITE_URL ."widget/'><img alt='Yaxmobi.com' width=\"400\" src='cid:email'></a>
                                </td>
                                </tr>		
                                </table>
                                </body>
                                </html>";
                                    
                                // Subject of mail
                                $subject = 'Yaxmobi.com: Your Daily Laughter Pill.  No Prescription Needed! ';

                                $message = \Swift_Message::newInstance()
                                    ->setSubject( $subject )
                                    ->setFrom( array($fromEmail => $fromName))
                                    ->setContentType("text/html")
                                    ->setBody( $message );

                                for($i=0; $i <= count($friendemailid)-1; $i++){
                                    $sql = "insert into tellafriends (user_id,friendemailadd) values 
                                        ('".$this->data['user_id']."','".$friendemailid[$i]."')";
                                    
                                    $this->_conn->query( $sql );

                                    $message->setTo( array( $friendemailid[$i] => $friendemailid[$i]));
                                }
                                
                                $this->get('mailer')->send($message);
                                
                                $errMessage = 'Your message has been succefully sent.';
                            }
                            $this->_viewData['errMessage'] = $errMessage;
            }
        }

        $this->_viewData['songId'] = $songId;
        $this->_viewData['songType'] = '';
        
        
        
        //echo '<pre>'; print_r( $this->_viewData );die;
        return $this->render('YxBundle:Tellafriend:add.html.php', $this->_viewData);
    }


    /**
     * @Route("/widget")
     * @Route("/widget/")
     * @Route("/widget/index")
     */
    public function indexAction($flag = ''){
        $this->_conn = $this->get('database_connection');
        $this->_session = $this->getRequest()->getSession();
        
        //	Free Demo audio jokes
        $sql = "Select Song.*, Singer.sname, Genre.gname 
            from songs as Song
            LEFT JOIN singers as Singer ON Song.singer_id = Singer.id
            LEFT JOIN genres as Genre ON Song.genre_id = Genre.id
            WHERE Song.paid = 'N'";
        $freeSong = $this->_conn->fetchAll($sql);
        
        $this->_viewData['freeSong'] = $freeSong;
        
        $user_id = $this->_session->get('Users.userid');
        $this->_viewData['user_id'] = $user_id;
        
        $displayName = $this->_session->get('Users.name');
        $this->_viewData['displayName'] = $displayName;
        
        if($user_id == ""){
            $this->_viewData['loggedIn'] = false;
        }else
            $this->_viewData['loggedIn'] = TRUE;
        
        return $this->render('YxBundle:page:widget.html.php', $this->_viewData);
    }
    
    /**
     * @Route("/admin/tellafriends")
     * @Route("/admin/tellafriends/")
     */
    public function admin_indexAction(){
        if (! $this->session_checkadmin() )
            return $this->redirect($this->generateUrl('admin_login'), 302);
        
        //  Do Init
        $this->_viewData['base_url'] = '/admin/tellafriends';
        
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
        
        $order = ' Order By Tellafriend.id';
        $limitClause = " Limit $offset, $limit";
        
        if( ! $request->query->get('char') ){
            $addQuery="";
        }else{
            $extraParam['char'] = $request->query->get('char');
            $addQuery=" WHERE Tellafriend.friendemailadd LIKE '".$request->query->get('char')."%'" ;
        }
        
        $sql = "Select Tellafriend.*, User.email from tellafriends as Tellafriend 
                LEFT JOIN users as User ON User.id = Tellafriend.user_id
                " . $addQuery . $order . $limitClause ;
        
        $records = $this->_conn->fetchAll( $sql );
        $this->_viewData['records'] = $records;
        
        //echo '<pre>'; print_r( $records );die;
        //  Get All item count
        $sql = "Select count(Tellafriend.id) as num from tellafriends as Tellafriend " . $addQuery;
        $items = $this->_conn->fetchAll( $sql );

        $itemsCount = $items[0]['num'];
        
        $paginator = new \Front\YxBundle\Helper\Paginator($itemsCount, $page , $limit, $midrange);
        
        $this->_viewData['paginator'] = $paginator;
        
        $this->_viewData['extraParam'] = $extraParam;

        return $this->render('YxBundle:Tellafriend:admin_index.html.php', $this->_viewData);
    }
    
    
    /**
     * @Route("/admin/delete_tellafriend")
     * @Route("/admin/delete_tellafriend/")
     * @return type 
     */
    public function admin_deleteAction(){
        if (! $this->session_checkadmin() )
            return $this->redirect($this->generateUrl('admin_login'), 302);
        
        //  Do Init
        $em = $this->get('doctrine')->getEntityManager();
        $this->_conn = $this->get('database_connection');
        $request = $this->getRequest();
        
        if( $request->request->get('act') && $request->request->get('act') == 'delete_me' ){
            $ids = explode(',', $request->request->get('ids'));
            
            foreach ( $ids as $id ){
                if ( $id != '' ){
                    $data = $em->getRepository('YxBundle:Tellafriends')->find($id);
                    
                    $em->remove($data);
                    $em->flush();
                }
            }
        }
        
        echo 'Record deleted.';
        return new \Symfony\Component\HttpFoundation\Response();
        
    }
    
}
