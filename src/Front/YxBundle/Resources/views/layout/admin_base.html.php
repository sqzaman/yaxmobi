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
        

        <script type="text/javascript" src="/js/js_files/commonfunctions.js" language="javascript"></script>

        <script type="text/javascript" src="<?php echo $view['assets']->getUrl('js/jquery/jquery.js') ?>"></script>
        <script type="text/javascript" src="<?php echo $view['assets']->getUrl('js/js_files/common.js') ?>"></script>        
        <script type="text/javascript" src="<?php echo $view['assets']->getUrl('js/jquery/jquery.blockUI.js') ?>"></script>
        
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
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td colspan="2" valign="top">
                                    <?php echo $view->render('YxBundle:layout:admin_header.html.php'); ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" valign="top">
                                    &nbsp;
                                </td>
                            </tr>
                            <!--  Scrolling News Ends Here-->
                            <tr>
                                <td valign="top" width="250">
                                    <?php 
                                        $addViewData = array();
                                        /*if ( isset( $loggedIn ) )
                                            $addViewData['loggedIn'] = $loggedIn;

                                        if ( isset( $displayName ) )
                                            $addViewData['displayName'] = $displayName;*/
                                        if( ! isset( $left ) )
                                            echo $view->render('YxBundle:layout:admin_left.html.php', $addViewData); 
                                        else
                                            echo '<div style="width: 150px;">&nbsp;</div>';
                                    ?>
                                </td>
                                <td align="left" valign='top'>
                                    
                                        <!--  Main Content Starts Here-->
                                        <div id="content">
                                            <?php $view['slots']->output('body') ?>
                                            <div class="clear"></div>
                                        </div>
                                        <!--  Main Content Starts Here-->
                                </td>
                            </tr>
                            <!--  Header Ends -->
                        </table>
                    </td>
                </tr>
            <?php echo $view->render('YxBundle:layout:admin_footer.html.php'); ?>
            </table>
        </div>
    </body>
</html>