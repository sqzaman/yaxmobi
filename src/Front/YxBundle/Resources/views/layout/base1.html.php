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
        <link rel="shortcut icon" href="web/jokes/images/jokes.ico" type="image/x-icon" />
    <!-- must have -->
    <link href="<?php echo $view['assets']->getUrl('web/jokes/slider/css/allinone_bannerRotator.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo $view['assets']->getUrl('web/jokes/carousel/css/allinone_carousel.css') ?>" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="<?php echo $view['assets']->getUrl('web/jokes/css/style.css') ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $view['assets']->getUrl('web/jokes/css/lecteur-html5.css') ?>" />
    <link href="<?php echo $view['assets']->getUrl('web/jokes/player/css/xemusicplayer.css') ?>" media="all" rel="stylesheet" type="text/css">
    <!--[if IE 7]>
            <link type="text/css" rel="stylesheet" href="<?php echo $view['assets']->getUrl('web/jokes/css/ie/ie7.css') ?>" /> 
        <![endif]-->
        <!--[if IE 8]>
            <link type="text/css" rel="stylesheet" href="<?php echo $view['assets']->getUrl('web/jokes/css/ie/ie8.css') ?>" />
        <![endif]-->
    <script src="<?php echo $view['assets']->getUrl('web/jokes/js/json3.js') ?>" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo $view['assets']->getUrl('web/jokes/player/js/jquery-2.0.0.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo $view['assets']->getUrl('web/jokes/js/jquery-1.7.min.js') ?>" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo $view['assets']->getUrl('web/jokes/slider/js/jquery.ui.touch-punch.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo $view['assets']->getUrl('web/jokes/slider/js/allinone_bannerRotator.js') ?>" type="text/javascript"></script>
    <script src="<?php echo $view['assets']->getUrl('web/jokes/carousel/js/allinone_carousel.js') ?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo $view['assets']->getUrl('web/jokes/js/jquery-ui.js') ?>"></script>
    <script type="text/javascript" src="<?php echo $view['assets']->getUrl('web/jokes/js/cufon-yui.js') ?>"></script>
    <script type="text/javascript" src="<?php echo $view['assets']->getUrl('web/jokes/js/myriad-pro_400.font.js') ?>"></script>
    <!--<script src="<?php echo $view['assets']->getUrl('web/jokes/js/jquery-latest.js') ?>" type="text/javascript" charset="utf-8"></script>-->
    <!--<script src="<?php echo $view['assets']->getUrl('web/jokes/js/jquery.js') ?>" type="text/javascript" charset="utf-8"></script>-->
    <script src="<?php echo $view['assets']->getUrl('web/jokes/player/js/jquery-xemusicplayer-1.0.0.js') ?>" type="text/javascript"></script>
   
    <!-- must have -->
    <?php
$url = $app->getRequest()->getRequestUri();
$last = substr( $url, strrpos( $url, '/' )+1 );
if ($last == "song_category1" ) { ?>
<link rel="stylesheet" type="text/css" href="<?php echo $view['assets']->getUrl('web/jokes/css/size-category.css') ?>" />   
 <?php }else { ?>
   <link rel="stylesheet" type="text/css" href="<?php echo $view['assets']->getUrl('web/jokes/css/size-principal.css') ?>" />   
<?php } ?>
    	<script>
               var JQ=jQuery.noConflict();
               JQ(function() {
			JQ('#allinone_bannerRotator_universal').allinone_bannerRotator({
				skin: 'universal',
				width: 666,
				height: 271,
				thumbsWrapperMarginBottom:35,				
				autoHideBottomNav:true,
				showPreviewThumbs:false,
                                defaultEffect: 'slideFromRight'

			});		
			
			
		});
                
                var JQ1=jQuery.noConflict();
                
                 JQ1(function() {

			JQ1('#allinone_carousel_charming').allinone_carousel({
				skin: 'charming',
				width: 485,
				height: 215,
				autoPlay: 3,
				resizeImages:true,
				autoHideBottomNav:true,
				showElementTitle:false,
				verticalAdjustment:50,
				showPreviewThumbs:false,
				numberOfVisibleItems:5,
				nextPrevMarginTop:23,
				playMovieMarginTop:0,
				bottomNavMarginBottom:-10
			});		
			
			
		});
       
        var JQ3=jQuery.noConflict();

       JQ3(document).ready(function() {
        JQ3("ul.tabs li:first").addClass("active").show(); //Activate first tab
        JQ3("ul.tabs li").click(function() {
            JQ3("ul.tabs li").removeClass("active"); //Remove any "active" class
            JQ3(this).addClass("active"); //Add "active" class to selected tab
            return false;
        });
    });
    

</script>
    </head>
    <body>
        <div id="header"></div>
            <div id="center">
                <?php echo $view->render('YxBundle:layout:header.html.php'); ?>
                    <div id="content">
                        <?php $view['slots']->output('body') ?>

                    </div>
                </div>
            </div>
                <?php echo $view->render('YxBundle:layout:footer.html.php'); ?>  
    </body>
</html>
