<div id="site">
<div id="logo"><a href=""></a></div>
<div id="small-top-menu">
<ul>
<li><a href="#">HOME</a></li>
<li><a href="/users/login">LOGIN</a></li>
<li><a href="/users/register">REGISTER</a></li>
<li><a href="/users/support">SUPPORT</a></li>
</ul>
</div>
<?php echo $view['actions']->render('YxBundle:Box:mycart'); ?>
<div id="big-top-menu">
<ul>
<li><a href="/">Home</a></li>
<li><a href="/users/song_category1">Jokes</a></li>
<li><a href="#">Short Jokes</a></li>
<li><a href="#">Yo Mama</a></li>
<li><a href="/subscriptions/">Subscriptions</a></li>
<li><a href="/yaxgift">Yax Gifts</a></li>
<li><a href="/widget/index">Widget</a></li>
<li><a href="/tellafriends/add">Tell a Friend</a></li>
<li><a href="#">Games</a></li>
</ul>
    <div id="count"><table id="search-position" ><td><a href="#">My Account</a></td><td><input name="" type="text" class="search"/></td></table></div>
<div id="link-social">
    <div class="pos-social">
<a href="#"><img src="<?php echo $view['assets']->getUrl('web/jokes/images/icon_linkedin.png') ?>" width="14" height="14" /></a>
<a href="#"><img src="<?php echo $view['assets']->getUrl('web/jokes/images/icon_twitter.png') ?>" width="14" height="14" /></a>
<a href="#"><img src="<?php echo $view['assets']->getUrl('web/jokes/images/icon_google+.png') ?>" width="14" height="14" /></a>
<a href="#"><img src="<?php echo $view['assets']->getUrl('web/jokes/images/icon_fb.png') ?>" width="14" height="14" /></a>
    </div>
</div>
</div>