<?php $view->extend('YxBundle:layout:base1.html.php') ?>

<?php $view['slots']->start('body') ?>
<?php echo $view->render('YxBundle:layout:top_content.html.php'); ?>
<div class="container-all-tab">
<script src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>
<script>
jQuery(function() {
  jQuery("ul.tabs").tabs("div.css-panes > div", {effect: 'ajax'});
});
</script>
<ul class="tabs">
  <li><a href="<?php echo $view['router']->generate('tabbed', array('type' => 'long_jokes')) ?>">LONG JOKES</a></li>
  <li><a href="<?php echo $view['router']->generate('tabbed', array('type' => 'short_jokes')) ?>">SHORT JOKES</a></li>
  <li><a href="<?php echo $view['router']->generate('tabbed', array('type' => 'yo_mama'), true) ?>">YO MAMA</a></li>
  <li><a href="<?php echo $view['router']->generate('tabbed', array('type' => 'videos'), true) ?>">VIDEOS</a></li>
  <li><a href="<?php echo $view['router']->generate('tabbed', array('type' => 'cartoons'), true) ?>">CARTOONS</a></li>
</ul>
<!-- single pane. it is always visible -->
<div class="tab_container">
<div class="css-panes">
  <div style="display:block">        <div  class="tab_content">
   <div class="carousel-container" >
                 <div id="allinone_carousel_charming">
                     <div class="myloader"></div>
                  <ul class="allinone_carousel_list">
                  <?php foreach ($results as $result) :  ?>
                      <li><a href="<?php echo '/songs/genre/'. $result['id']; ?>"><img src="<?php echo $view['assets']->getUrl('img/genres/'.$result['image']) ?>" alt="" /></a></li>                
                  <?php endforeach; ?> 
                  </ul>             
           </div> 
        </div>
      </div>
  </div>
</div>
</div>
</div>
<div id="you-may">
<h1>YOU MAY ALSO LIKE</h1>
   <?php echo $view['actions']->render('YxBundle:Box:related'); ?>
</div>
<div id="popular">
<h1>POPLULAR PLAYLIST</h1>

<div style="height:100px;width:230px;overflow:scroll;overflow-x:hidden;overflow-y:scroll;">
<?php foreach ( $items as $k => $item ):?>
<div><a href="<?php echo $songFile[$k] ?>"><?php echo $title[$k] ?></a></div>
<?php endforeach; ?> </div> 

</div>
<div id="list-audio">
<div id="list-audio-1">
	LIST OF AUDIO JOKES<br />
	<img src="<?php echo $view['assets']->getUrl('jokes/images/icon_audio.png') ?>" width="36" height="42" /><br />
     <form action="/users/search" METHOD="post" name="searchform" > 
                <table style="margin-left:46px"  border="0" cellspacing="0" cellpadding="5">
                    <tr>
                        <td>
                            <select name="what">
                                <option value="all">All Fields</option>
                                <option value="category">Category</option>
                                <option value="comp">Joke</option>
                                <option value="singer">Performer</option>
                                <option value="ringtone">Ringtone</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <INPUT TYPE="text" class="search-list" name="searchkeyworld" value=''>				
                        </td>
                        <td class="search-pos" align="left">
                            <INPUT name="search" class="button-search" type="submit" value='Search'>				
                        </td>
                    </tr>
                </table>
     </form>
</div>
</div>

<?php $view['slots']->stop() ?>
