<?php
//$serverURL = $_SERVER['QUERY_STRING'];
//$REQUESTURL = $_SERVER['REQUEST_URI'];
$menuArray = array(
    'Browse By Category' => array('users/song_category', 'songs/genre', 'ringtonecategory/index', 'ringtones/ringtonelist', 'videos/play'),
    'Written Jokes' => array('jokes/all_joke_category', 'jokes/jokes'),
    'Recent Downloads' => array('users/index', 'users/welcome', 'users/send'),
    'My Profile' => array('users/myprofile'),
    'My balance' => array('users/mybalance'),
    'Fill balance' => array('users/balance'),
    'Subscriptions' => array('subscriptions/index', 'subscriptions/all', 'subscriptions/a_la_carte', 'subscriptions/ringtone', 'subscriptions/audio_joke', 'subscriptions/combo_plan',),
    'My basket' => array('songs/mybasket', 'songs/buy', 'songs/search_joke'),
    'Yaxgifts' => array('yaxgift/index'),
);

$serverURL = ''; //$this->params['controller'].'/'.$this->params['action'];
$serverURL = trim($serverURL);
//$serverURL = substr($serverURL, strpos($serverURL, '/')+1);
//if (strstr($serverURL, '/'))
//	$serverURL = substr($serverURL, 0,strpos($serverURL, '/'));
/* if (in_array($serverURL, $menuArray['Browse By Category']))
  echo "i m here". $serverURL; */
//echo "OK".$serverURL;
//echo $serverURL = $this->params['url']['url'];//$_SERVER['REQUEST_URI'];
//echo $serverURL = substr($serverURL, 0,strrpos($serverURL, '/'));
//$_SERVER['REQUEST_URI'];
//pr($this->params); 
?>
<tr>
    <td width="1"><img src="/img/images/t01.gif" border="0" width="5" /></td>
    <td class="navwhitetext">Welcome! &nbsp;<? if (isset($displayName)) echo ucfirst($displayName); ?></td>
    <td width="1" align="right"><img src="/img/images/t03.gif" border="0" width="6" /></td>
</tr>
<tr>
    <td colspan="3" align="center"
        style="border-bottom: #4c4c4c 1px solid; border-left: #4c4c4c 1px solid; border-right: #4c4c4c 1px solid">
        <form method="post" action="/users/login"
              onSubmit="return checkform(this);" style="margin: 0px; padding: 0px;">
            <table width="100%">
                <tr>
                    <td class='<? if (in_array($serverURL, $menuArray['Recent Downloads'])) echo 'tdBottomBorderOrange'; else echo 'tdBottomBorder'; ?>'>
                        <a href="/users"  class="linksnormal">My Jokes</a>
                    </td>
                </tr>
                <tr>
                    <td
                        class='<? if (in_array($serverURL, $menuArray['Browse By Category'])) echo 'tdBottomBorderOrange'; else echo 'tdBottomBorder'; ?>'>
                        <a href="/users/song_category"  class="linksnormal">Browse By Category</a>
                    </td>
                </tr>
                <!--<tr>
                    <td
                        class='<? //if (in_array($serverURL, $menuArray['Written Jokes'])) echo 'tdBottomBorderOrange'; else echo 'tdBottomBorder'; ?>'>
                        <a href="/jokes/all_joke_category"  class="linksnormal">Written Jokes</a>
                    </td>
                </tr>-->
                <tr>
                    <td
                        class='<? if (in_array($serverURL, $menuArray['My Profile'])) echo 'tdBottomBorderOrange'; else echo 'tdBottomBorder'; ?>'>
                        <a href="/users/myprofile"  class="linksnormal">My Profile</a>
                    </td>
                </tr>
                <tr>
                    <td
                        class='<? if (in_array($serverURL, $menuArray['My balance'])) echo 'tdBottomBorderOrange'; else echo 'tdBottomBorder'; ?>'>
                        <a href="/users/mybalance"  class="linksnormal">My Balance</a>
                    </td>
                </tr>
                <tr>
                    <td
                        class='<? if (in_array($serverURL, $menuArray['Fill balance'])) echo 'tdBottomBorderOrange'; else echo 'tdBottomBorder'; ?>'>
                        <a href="/users/balance"  class="linksnormal">Fill Balance</a>
                    </td>
                </tr>
                <tr>
                    <td
                        class='<? if (in_array($serverURL, $menuArray['My balance'])) echo 'tdBottomBorderOrange'; else echo 'tdBottomBorder'; ?>'>
                        <a href="/wishes"  class="linksnormal">My Wish List</a>
                    </td>
                </tr>
                <tr>
                    <td
                        class='<? if (in_array($serverURL, $menuArray['My balance'])) echo 'tdBottomBorderOrange'; else echo 'tdBottomBorder'; ?>'>
                        <a href="/playlists"  class="linksnormal">My Playlist</a>
                    </td>
                </tr>
                <tr>
                    <td
                        class='<? if (in_array($serverURL, $menuArray['Subscriptions'])) echo 'tdBottomBorderOrange'; else echo 'tdBottomBorder'; ?>'>
                        <a href="/subscriptions"  class="linksnormal">Subscriptions</a>
                    </td>
                </tr>
                <tr>
                    <td
                        class='<? if (in_array($serverURL, $menuArray['My basket'])) echo 'tdBottomBorderOrange'; else echo 'tdBottomBorder'; ?>'>
                        <a href="/songs/mybasket"  class="linksnormal">My Basket</a>
                    </td>
                </tr>
                <tr>
                    <td
                        class='<? if (in_array($serverURL, $menuArray['Yaxgifts'])) echo 'tdBottomBorderOrange'; else echo 'tdBottomBorder'; ?>'>
                        <a href="/yaxgift"  class="linksnormal">YaxGifts</a>
                    </td>
                </tr>
                <tr>
                    <td class="tdBottomBorder">
                        <a href="/users/logout"  class="linksnormal">Log Out</a>
                    </td>
                </tr>
            </table>
        </form>
    </td>
</tr>