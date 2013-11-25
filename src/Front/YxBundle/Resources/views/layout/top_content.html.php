<div id="animation-banner">
<div id="slider-container1">
            <div id="allinone_bannerRotator_universal" style="display:none;">
                <!-- IMAGES -->
                <ul class="allinone_bannerRotator_list">
                    <li data-text-id="#allinone_bannerRotator_photoText1"><img src="<?php echo $view['assets']->getUrl('web/jokes/slider/images/universal/Banner-1.jpg') ?>" alt="" /></li>
                    <li data-text-id="#allinone_bannerRotator_photoText3"><img src="<?php echo $view['assets']->getUrl('web/jokes/slider/images/universal/Banner-2.jpg') ?>" alt="" /></li>
                    <li data-text-id="#allinone_bannerRotator_photoText4"><img src="<?php echo $view['assets']->getUrl('web/jokes/slider/images/universal/Banner-3.jpg') ?>" alt="" /></li> 
                    <li data-text-id="#allinone_bannerRotator_photoText5"><img src="<?php echo $view['assets']->getUrl('web/jokes/slider/images/universal/Banner-4.jpg') ?>" alt="" /></li>
                    <li data-text-id="#allinone_bannerRotator_photoText5"><img src="<?php echo $view['assets']->getUrl('web/jokes/slider/images/universal/Banner-5.jpg') ?>" alt="" /></li>
                </ul>
           </div>  
</div>
</div>
<div id="blog-pos">
<div id="blog-left">

<div class="player-container" >
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
 
jQuery("#player").xeMusicPlayer({songlist: songlist, theme: 2, mode: 2});
</script>

<hr class="separ" />
<div id="blog-login">
<h1>Member's login</h1>
<div id="login-now"><a href="/users/login">LOGIN NOW</a></div>
<div id="create"><a href="/users/register">CREATE FREE ACCOUNT</a></div>
<ul>
<li><a href="/users/benef">User Benefits</a></li>
<li><a href="/users/forget_password">Password Reminder</a></li>
<li><a href="/users/register">New User? Registration</a></li>
</ul>
</div>
<div id="blog-video"></div>
<div id="blog-join">
<h1>JOIN OUR MAILING LIST</h1>
<img src="<?php echo $view['assets']->getUrl('web/jokes/images/icon_mailling_list.png') ?>" width="41" height="48" />
<form name="mailing_list" action="/mailinglists/join" method="post" onsubmit="return chkMailingForm();">
    <table width="98%" border="0" cellspacing="0" cellpadding="5">
        <tr>
            <td><input name="data[Mailinglist][email]"  size="20" class="email" value="" type="text" id="MailinglistEmail" /></td>
        </tr>
        <tr>
            <td><input type="submit" class="join" value="Join" class="submit_btn"></td>
        </tr>
        <tr>
            <td height="5"></td>
        </tr>
    </table>
</form>
</div>
</div>
</div>
</div>   