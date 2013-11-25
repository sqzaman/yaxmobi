<?php
if (isset($type)) {
    if($type == 'short_jokes') {
//        $sql = "select * from ringtonecategories where id=" . $songRec['category'];
//        $result = mysql_query($sql);
//        $object = mysql_fetch_array($result);
        
        $sname = $songRec['title'];
        $gname = $catName;
        $composition = $songRec['title'];
        $duration  =  $songRec['duration'];
        $auditions = $songRec['view'];
        $path = $songRec['path'];
        $paid = "y";
        $year = 2008;
        $id = $songRec['id'];

    }else {

        $sname = $songRec[0]['sname'];
        $gname = $songRec[0]['gname'];
        $composition = $songRec[0]['composition'];
        $duration  =  $songRec[0]['duration'];
        $auditions = $songRec[0]['view'];
        $path = $songRec[0]['path'];
        $paid = $songRec[0]['paid'];
        $year = $songRec[0]['year'];
        $id = $songRec[0]['id'];
        
    }
} else {
    
        $sname = $songRec[0]['sname'];
        $gname = $songRec[0]['gname'];
        $composition = $songRec[0]['composition'];
        $duration = $songRec[0]['duration'];
        $path = $songRec[0]['path'];
        $paid = $songRec[0]['paid'];
        $auditions = $songRec[0]['view'];
        $year = $songRec[0]['year'];
        $id = $songRec[0]['id'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
     <meta charset="UTF-8"/>
     <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"/>
     <link rel="stylesheet" type="text/css" href="<?php echo $view['assets']->getUrl('web/jokes/css/popup.css') ?>"/>
     <link rel="stylesheet" type="text/css" href="<?php echo $view['assets']->getUrl('web/jokes/bigplayer/css/reset.css') ?>"/>
     <link rel="stylesheet" type="text/css" href="<?php echo $view['assets']->getUrl('web/jokes/bigplayer/css/style.css') ?>"/>
     <link rel="stylesheet" type="text/css" href="<?php echo $view['assets']->getUrl('web/jokes/bigplayer/css/scroll.css') ?>"/>
     <link rel="stylesheet" type="text/css" href="<?php echo $view['assets']->getUrl('web/jokes/bigplayer/css/tabs-no-images.css') ?>"/>
     
     <script src="<?php echo $view['assets']->getUrl('web/jokes/js/jquery-1.7.min.js') ?>" type="text/javascript" charset="utf-8"></script>
     <script type="text/javascript" src="<?php echo $view['assets']->getUrl('web/jokes/bigplayer/js/jquery-ui.js') ?>"></script>
     <script src="<?php echo $view['assets']->getUrl('web/jokes/secondplayer/js/jquery-xemusicplayer-1.0.0.js') ?>" type="text/javascript"></script>
     <link href="<?php echo $view['assets']->getUrl('web/jokes/secondplayer/css/xemusicplayer.css') ?>" media="all" rel="stylesheet" type="text/css">
     	<script type="text/javascript">
   //             var JQ7=jQuery.noConflict();
//		JQ7(function(){
//			JQ7('#dark').plp({
//				'volume': 80,
//				'playlist':[
//					{"title":"<?php echo $composition ?>", "author":"<?php echo $sname ?>", "cover":"<?php echo $sname ?>", "cover":"<?php echo $view['assets']->getUrl('/web/jokes/images/smiley.png') ?>", "mfile":"<?php echo $view['assets']->getUrl('/tone/'.$path) ?>", "duration":"<?php echo $duration ?>&nbsp;min"}

//				]
//			});
//		});	
                
     var JQ9=jQuery.noConflict();
JQ9(function() {
    var items = JQ9('#v-nav>ul>li').each(function() {
        JQ9(this).click(function() {
            //remove previous class and add it to clicked tab
            items.removeClass('current');
            JQ9(this).addClass('current');

            //hide all content divs and show current one
            JQ9('#v-nav>div.tab-content').hide().eq(items.index(JQ9(this))).show('fast');

            window.location.hash = JQ9(this).attr('tab');
        });
    });

    if (location.hash) {
        showTab(location.hash);
    }
    else {
        showTab("tab1");
    }

    function showTab(tab) {
       JQ9("#v-nav ul li:[tab*=" + tab + "]").click();
    }

    // Bind the event hashchange, using jquery-hashchange-plugin
    JQ9(window).on('hashchange', function() {
        showTab(location.hash.replace("#", ""));
    })

    // Trigger the event hashchange on page load, using jquery-hashchange-plugin
    JQ9(window).trigger('hashchange');
});


function download_message(){
    alert('You can not download just after purchase it!');
    }

	</script>
    </head>
    <body>
        <div id="all">
        <div id="header"></div>
        <div id="logo"><a href=""></a></div>
        <div id="global">
   <div id="player"></div>
           <script type="text/javascript">
var songlist = new Array(2);
songlist[0] = new Object();
songlist[0].cover = "<?php echo $view['assets']->getUrl('tone/5_teeth_and_20_feet.jpg') ?>"
songlist[0].mp3 = "<?php echo $view['assets']->getUrl('tone/5_teeth_and_20_feet.mp3') ?>";
songlist[0].ogg = "<?php echo $view['assets']->getUrl('tone/5_teeth_and_20_feet.ogg') ?>";
songlist[0].title = "Artiste 1";
songlist[0].title_link = "http://google.com";
songlist[0].artist = "Artiste 1";
songlist[1] = new Object();
songlist[1].cover = "<?php echo $view['assets']->getUrl('tone/7-course_meal.jpg') ?>"
songlist[1].mp3 = "<?php echo $view['assets']->getUrl('tone/7-course_meal.mp3') ?>";
songlist[1].ogg = "<?php echo $view['assets']->getUrl('tone/7-course_meal.ogg') ?>";
songlist[1].title = "Artiste 2";
songlist[1].title_link = "http://google.com";
songlist[1].artist = "Artiste 2";
 var JQ100=jQuery.noConflict();
JQ100("#player").xeMusicPlayer({songlist: songlist, theme: 1, mode: 2});
</script>
        </div>
        <div id="you-may"> 
            <h1>YOU MAY ALSO LIKE</h1>
            <div style="height:170px;width:195px;overflow:scroll;overflow-x:hidden;overflow-y:scroll; position: absolute; top: 21px; left: 1px;" >
            <?php              
            
               $count = 0;
               foreach ($audioJokes as $audioJoke) { ?>
               <div id="<?php echo (++$count%2 ? "active" : "no-active") ?>">
               <?php if($type == 'long_jokes' || $type=='yomama' || $type== 'videos' || $type== 'cartoons' ) :  ?>
               <a href="/songs/preview/<?php echo $audioJoke['id']?>" ><?php echo $audioJoke['composition'] ?></a>
               <?php endif; ?>
               <?php if($type == 'short_jokes' ) :  ?>
               <a href="/songs/preview/<?php echo $audioJoke['id']?>" ><?php echo $audioJoke['title'] ?></a>
               <?php endif; ?>
               </div>
            <?php } ?>  
            </div>
        </div>

        <section id="wrapper" class="wrapper">

  <div id="v-nav">
<?php $search = array("_", "\'");
               $result   = array(" ", "'"); ?>
  <ul>
    <li tab="tab1" class="first current">INFO</li>
    <li tab="tab2">SHARE</li>
    <li tab="tab4" class="last">COMMENTS</li>
 </ul>

      <div class="tab-content"> 
          <div class="information">
              <ul>
                  <li><strong>Name :</strong> <?php echo $composition ?></li>
                  <li><strong>Category :</strong> <?php echo str_replace($search,$result,strtoupper($gname))  ?></li>
                  <li><strong>Duration :</strong> <?php echo $duration ?></li>
                  <li><strong>Auditions :</strong> <?php echo $auditions ?></li>        
              </ul>
          </div>
          <div class="separate"></div>
          <div class="separate-1"></div>
          <div class="option">
              <table>
                  <thead>
                      <tr>
                          <td><a target="_blank" href="<?php echo $view['assets']->getUrl('/songs/addtocart') ?>?checking=<?php echo $id; ?>"><img class="img_tab" border="0" align="absmiddle" src="<?php echo $view['assets']->getUrl('/web/jokes/images/add_cart.png') ?>"></a></td>
                          <td><a target="_blank" href="<?php echo $view['assets']->getUrl('/tellafriends/add/'.$id) ?>"><img class="img_tab" border="0" align="absmiddle" src="<?php echo $view['assets']->getUrl('/web/jokes/images/get_it.png') ?>"></a></td>
                      </tr>
                      <tr>
                          <td><a target="_blank" href=""><img class="img_tab" border="0" align="absmiddle" src="<?php echo $view['assets']->getUrl('/web/jokes/images/view_cart.png') ?>"></a></td>
                          <td><a target="_blank" href="<?php echo $view['assets']->getUrl('/#'.$type . '-' .$id) ?>"><img class="img_tab" border="0" align="absmiddle" src="<?php echo $view['assets']->getUrl('/web/jokes/images/add_wishlist.png') ?>"></a></td>
                      </tr>
                      <tr>
                          <td><a target="_blank" href="<?php echo $view['assets']->getUrl('/subscriptions/');?>"><img class="img_tab" border="0" align="absmiddle" src="<?php echo $view['assets']->getUrl('/web/jokes/images/subscribe.png') ?>"></a></td>
                          <td><a target="_blank" href="<?php echo $view['assets']->getUrl('/#'.$id) ?>"><img class="img_tab" border="0" align="absmiddle" src="<?php echo $view['assets']->getUrl('/web/jokes/images/add_playlist.png') ?>"></a></td>
                      </tr>
                  </thead>
              </table>
          </div>
 </div>

 <div class="tab-content">
   <h4><a href="">Nothing yet!</a></h4>
 </div>

 <div class="tab-content">
    <h4><a href="">Nothing yet!</a></h4>   
 </div>

</div>

</section>


        </div>
        </div>
    </body>
</html>