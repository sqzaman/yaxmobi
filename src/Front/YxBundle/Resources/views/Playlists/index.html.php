<?php $view->extend('YxBundle:layout:base.html.php') ?>

<?php $view['slots']->start('body') ?>

<script type="text/javascript" src="/js/js_files/playlist.js"></script>

<table border="0" cellspacing="0" cellpadding="0" class="container">
    <tr>
        <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
        <td class="navwhitetext">My Playlist</td>
        <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
    </tr>
    <tr>
        <td colspan="3" align="center" width="100%">
                <!-- START WIMPY PLAYER CODE -->
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,47,0" width="428" height="102" id="wimpy1540">
<param name="allowScriptAccess" value="always" />
<param name="movie" value="<?php echo MY_SITE_URL;?>rave/rave.swf" />
<param name="loop" value="false" />
<param name="menu" value="false" />
<param name="quality" value="high" />
<param name="scale" value="noscale" />
<param name="salign" value="lt" />
<param name="bgcolor" value="000000" />
<param name="flashvars" value="wimpyApp=<?php echo MY_SITE_URL;?>rave/rave.php&wimpySkin=<?php echo MY_SITE_URL;?>rave/skins/myskin/skin_myskin.xml&playlist=<?php echo $playlist;?>&wimpyReg=NmslMjMlM0JvcDZKayU3RkhNaEIlMkNHclY5JTVFV2ZTJTdCOFlHN25m&&startPlayingOnload=no" loop="false" menu="false" quality="high" width="428" height="105" scale="noscale" salign="lt" name="wimpy1540" align="center" bgcolor="000000" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"/>

<embed src="<?php echo MY_SITE_URL;?>rave/rave.swf" flashvars="wimpyApp=<?php echo MY_SITE_URL;?>rave/rave.php&wimpySkin=<?php echo MY_SITE_URL;?>rave/skins/myskin/skin_myskin.xml&playlist=<?php echo $playlist; ?>&wimpyReg=NmslMjMlM0JvcDZKayU3RkhNaEIlMkNHclY5JTVFV2ZTJTdCOFlHN25m&startPlayingOnload=no" loop="false" menu="false" quality="high" width="428" height="105" scale="noscale" salign="lt" name="wimpy1540" align="center" bgcolor="000000" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>
<!-- END WIMPY PLAYER CODE -->
            
        </td>
    </tr>
    <tr>
        <td colspan="3" align="center" width="100%">
            <table bgcolor="#ffffff" cellspacing="1" cellpadding="3" width='100%'>
                <tr> 
                    <th  colspan="3"> <u> MY PLAYLIST </u> </th> 
                </tr>
                <tr>
                        <th>Y</th>
                        <th align ="center"> Name </th>
                        <th align="center"> Actions </th>
                </tr>
            <?php
                if ( $items ):
                    foreach ( $items as $k => $item ):
            ?>
                <tr id="tr-<?php echo $item->getId();?>">
                    <td>*</td>
                    <td><?php echo $song_file[$k]; ?></td>
                    <td>
                        <a class="del-p" href="/playlists/delete/#<?php echo $item->getId(); ?>" data="<?php echo ($item->getSongId() ? 's' : 'r');?>"><img border="0" alt="Delete" src="/img/delete.gif"></a> 
                        
                    </td>
                </tr>
            <?php
                    endforeach;
                endif;
            ?>
            </table>
        </td>
    </tr>
</table>
<?php $view['slots']->stop() ?>