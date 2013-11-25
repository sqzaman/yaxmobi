<!-- app/Resources/views/base.html.php -->
<?php

//  Set Page title
$request = Symfony\Component\HttpFoundation\Request::createFromGlobals();

$temp = $request->getPathInfo();
$title = '';
$articleTitle = '';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Yaxmobi.com :: A New Genre of Comedy</title>
        
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta http-equiv="Content-Script-Type" content="text/javascript" />
        <meta name="title" content="Yaxmobi.com :: A New Genre of Comedy">
        <meta NAME="Description" CONTENT="yaxmobi.com,Music,Jokes,Audio Joke, Fun, Comedy, Audio jokes, written joke,mp3 songs,Ringtones, Polyphonic ringtone, Celebrity News and Entertainment News">
        <meta NAME="keywords" CONTENT="yaxmobi.com,Music,Jokes,Audio Joke, Fun, Comedy, Audio jokes, written joke,mp3 songs,Ringtones, Polyphonic ringtone, Celebrity News and Entertainment News">
        <meta name="Generator" content="yaxmobi.com  All rights reserved." />
        <meta name="robots" content="index, follow">

        <link href="<?php echo $view['assets']->getUrl('css/style.css') ?>" rel="stylesheet" type="text/css" />
        
        

        
        
        
        
<script type="text/javascript" src="/js/tiny_mce/tiny_mce.js"></script>
<!--<script type="text/javascript" src="/js/utils.js"></script>
<script type="text/javascript" src="/js/prototype.js"></script>
<script type="text/javascript" src="/js/scriptaculous.js"></script>
<script type="text/javascript" src="/js/dropdown.js"></script>
<script type="text/javascript" src="/js/category.js"></script>
<script type="text/javascript" src="/js/ufo.js"></script>-->

<script type="text/javascript">var switchTo5x=true;</script>
	<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
	<script type="text/javascript" src="http://s.sharethis.com/loader.js"></script>
        
<script> 
    
function show(str){
	 Element.hide($(str)); new Effect.Appear($(str));
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
	eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
	if (restore) selObj.selectedIndex=0;
}

function GetClientInfo()
{
    frm1.client_info.value = netobj.GetSystemInfo();
    frm1.action = '/songs/buy';
    frm1.submit();
}

function openPlayer(songname, folder)
{
	if (folder != '')
	{
		folderURL = "/"+folder;
	}else
	{
		folderURL = '';
	}
        var url        = "/users/player/"+songname+folderURL;
        window.open(url,'mywin','left=20,top=20,width=700,height=470');        
}

</script>

        
<script type="text/javascript" src="<?php echo $view['assets']->getUrl('js/jquery/jquery.js') ?>"></script>
<!--<script>$ = jQuery.noConflict(true);</script>-->
<script type="text/javascript" src="/js/js_files/commonfunctions.js" language="javascript"></script>
<script type="text/javascript" src="<?php echo $view['assets']->getUrl('js/js_files/common.js') ?>"></script>        
<script type="text/javascript" src="<?php echo $view['assets']->getUrl('js/jquery/jquery.blockUI.js') ?>"></script>

<script type="text/javascript" src="<?php echo $view['assets']->getUrl('js/jquery/jquery-ui-1.10.3.custom.min.js') ?>"></script>

        
    </head>
    <body>
        <div id="flash-message-container" style="display: none; min-height: 25px; font-size: 14px; font-style: bold ; color: #fff; background-color: #000;">
            <?php 
                $fMsgs = $view['session']->getFlash('notice');
                if ( $fMsgs ):
                    foreach( $fMsgs as $fMsg ):
                        echo '<div id="flash-message">'. $fMsg .'</div>';
                    endforeach;
                endif;
            ?>
        </div>
        <div id="container">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td height="97" align="left"><img src="/img/images/ym_logo2.gif" border="0" /></td>
                                <td align="right" valign="top">
                                    <?php echo $view->render('YxBundle:layout:header.html.php'); ?>
                                </td>
                            </tr>
                            <tr>
				<td height="30" colspan="2" align="left">
					<?php echo $view['actions']->render('YxBundle:Tickers:index'); ?>
                                </td>
                            </tr>
                            <!--  Scrolling News Ends Here-->
                            
                            <tr>
				<td colspan="2" align="left">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2" align="left" valign='top'>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="1" valign="top">
                                                <!--  Left Menu Starts Here-->
                                                    <?php 
                                                        $addViewData = array();
                                                        if ( isset( $loggedIn ) )
                                                            $addViewData['loggedIn'] = $loggedIn;
                                                        
                                                        if ( isset( $displayName ) )
                                                            $addViewData['displayName'] = $displayName;
                                                        
                                                        echo $view->render('YxBundle:layout:left.html.php', $addViewData); 
                                                    ?>
                                                <!--  Left Menu Starts Here-->
                                            </td>
                                            <td valign="top">
                                                <!--  Main Content Starts Here-->
                                                <div id="content">
                                                    <?php $view['slots']->output('body') ?>
                                                    <div class="clear"></div>
                                                </div>
                                                <!--  Main Content Starts Here-->
                                            </td>
                                            <td width="180" valign="top" align="left">
                                                <!--  Right Menu Starts Here-->
                                                    <?php echo $view->render('YxBundle:layout:right.html.php'); ?>
                                                <!--  Right Menu Starts Here-->
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            
                            <!--  Header Ends -->
                        </table>
                    </td>
                </tr>
            
                
                
        
            <?php echo $view->render('YxBundle:layout:footer.html.php'); ?>
            </table>
        </div>
<div id="ajax-loading">
    <img src="/img/loading.gif" alt="Loading"/> Loading ...
</div>

    </body>
</html>