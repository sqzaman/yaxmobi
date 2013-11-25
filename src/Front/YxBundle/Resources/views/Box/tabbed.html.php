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
    <script src="<?php echo $view['assets']->getUrl('web/jokes/player/js/jquery-2.0.0.min.js') ?>" type="text/javascript"></script>
    
    <script src="<?php echo $view['assets']->getUrl('web/jokes/carousel/js/allinone_carousel.js') ?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo $view['assets']->getUrl('web/jokes/js/jquery-ui.js') ?>"></script>
    <script type="text/javascript" src="<?php echo $view['assets']->getUrl('web/jokes/js/scroll.js') ?>"></script>
<script>
jQuery(function() {

			jQuery('#allinone_carousel_charming').allinone_carousel({
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
    </script>

        <div  class="tab_content">
   <div class="carousel-container" >
                 <div id="allinone_carousel_charming">
                     <div class="myloader"></div>
                <ul class="allinone_carousel_list">
                  <?php foreach ($results as $result) :  ?>
                    <?php if ($type == "long_jokes") :  ?>
                    <li><a onclick="showUser(<?php echo $result['id']; ?>,1,'<?php echo $type ?>','<?php echo $result['gname'] ?>')"><img src="<?php echo $view['assets']->getUrl('web/img/genres/'.$result['image']) ?>" alt="<?php echo $result['gname'] ?>" /></a></li>
                    <?php endif; ?>
                    <?php if ($type == "short_jokes") :  ?>
                    <li><a onclick="showUser(<?php echo $result['id']; ?>,1,'<?php echo $type ?>','<?php echo $result['title'] ?>')"><img src="<?php echo $view['assets']->getUrl('web/img/genres/'.$result['image']) ?>" alt="<?php echo $result['title'] ?>" /></a></li>
                    <?php endif; ?>
                    <?php if ($type == "yo_mama") :  ?>
                    <li><a onclick="showUser(<?php echo $result['id']; ?>,1,'<?php echo $type ?>','<?php echo $result['catname'] ?>')"><img src="<?php echo $view['assets']->getUrl('web/img/yomama/'.$result['image']) ?>" alt="<?php echo $result['catname'] ?>" /></a></li>
                    <?php endif; ?> 
                    <?php if ($type == "videos") :  ?>
                    <li><a onclick="showUser(<?php echo $result['id']; ?>,1,'<?php echo $type ?>','<?php echo $result['title'] ?>')"><img src="<?php echo $view['assets']->getUrl('web/img/videos/'.$result['image']) ?>" alt="<?php echo $result['title'] ?>" /></a></li>
                    <?php endif; ?>   
                    <?php if ($type == "cartoons") :  ?>
                    <li><a onclick="showUser(<?php echo $result['id']; ?>,1,'<?php echo $type ?>','<?php echo $result['title'] ?>')"><img src="<?php echo $view['assets']->getUrl('web/img/cartoons/'.$result['image']) ?>" alt="<?php echo $result['title'] ?>" /></a></li>
                    <?php endif; ?> 
                  <?php endforeach; ?> 
                </ul>    
                                       
                           
           </div> 
        </div>
      </div>