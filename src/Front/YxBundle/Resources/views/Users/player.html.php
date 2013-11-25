<?php
if (isset($type)) {
    if ($type = 'yomama') {
//        $sql = "select * from ringtonecategories where id=" . $songRec['category'];
//        $result = mysql_query($sql);
//        $object = mysql_fetch_array($result);


        $sname = $songRec[0]['title'];
        $gname = $catName;
        $composition = $songRec[0]['title'];
        $paid = $songRec[0]['paid'];
        $year = $songRec[0]['year'];
    } elseif ($type = 'ring') {
//        $sql = "select * from ringtonecategories where id=" . $songRec['category'];
//        $result = mysql_query($sql);
//        $object = mysql_fetch_array($result);


        $sname = $songRec['title'];
        $gname = $catName;
        $composition = $songRec['ringtone'];
        $paid = "y";
        $year = 2008;
        if ($songRec['prew_ringtone'] == '')
            exit;
    }else {
        $type = 'song';
        $sname = $songRec[0]['Singer']['sname'];
        $gname = $songRec[0]['Genre']['gname'];
        $composition = $songRec[0]['Song']['composition'];
        $paid = $songRec[0]['Song']['paid'];
        $year = $songRec[0]['Song']['year'];
    }
} else {
    $type = 'song';
    $sname = $songRec[0]['sname'];
    $gname = $songRec[0]['gname'];
    $composition = $songRec[0]['composition'];
    $paid = $songRec[0]['paid'];
    $year = $songRec[0]['year'];
}
?>

<link rel="stylesheet" type="text/css" href="/css/style_player.css" media="all" />
<script type="text/javascript" src="<?php echo $view['assets']->getUrl('js/jquery/jquery.js') ?>"></script>
<script type="text/javascript" src="/js/js_files/common.js"></script>

<table width='100%' border='0'>
    <tr>
        <td width='100%' valign='top'>
            <table width='100%'>
                <tr>
                    <td valign='top'>
                        <table width='100%' border='0'>
                            <tr>
                                <td>
                                    <img src='/img/images/logo_popup.gif' border='0'>
                                </td>
                                <td valign='top' align="right">
                                    <table>
                                        <tr>
                                            <td align='left'><?
if ($type == 'ring')
    echo 'Title : ';
else
    echo 'Performer : ';
?><?php echo $sname ?></td>
                                        </tr>

                                        <tr>
                                            <td align='left'>Category : <?php echo $gname ?></td>
                                        </tr>
                                        <?
                                        if ($type != 'ring') {
                                            ?>
                                            <tr>
                                                <td align='left'>Audio Joke : <?php echo $composition ?>
                                                </td>
                                            </tr>
                                            <?
                                        }
                                        ?>
                                        <tr>
                                            <td align='left'><?php if ($paid == "N") { ?>
                                                    <a href="#"
                                                       onclick="window.opener.location = '/tellafriends/add/<?php echo $songRec[0]['id'] ?>'">
                                                        <img src="/img/tellafriend.gif" border="0" align="absmiddle" />&nbsp;
                                                        <b>Spread the laughter: Send to your friends</b></a> <br>

                                                <?php } ?> 
                                                <a href="#"
                                                   onclick="window.opener.location = '/widget/'">
                                                    <img src="/img/Media_Player.png" border="0" align="absmiddle" />&nbsp;
                                                    <b>Get the widget: take the laughs with you!</b></a>
                                            </td>
                                        </tr>

                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align='left'	valign="top"  style="background-color:#303161;">
                        <table border='0'>
                            <tr>
                                <td width='435'>
                                    <div id="flashPlayer"></div>
                                    <?
                                    if ($songFile != '') {
                                        if ($type == 'yomama') {
                                            ?> 

                                            <!-- START WIMPY PLAYER CODE -->
                                            <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,47,0" width="428" height="102" id="wimpy1540">
                                                <param name="allowScriptAccess" value="always" />
                                                <param name="movie" value="<?php echo MY_SITE_URL ?>rave/rave.swf" />
                                                <param name="loop" value="false" />
                                                <param name="menu" value="false" />
                                                <param name="quality" value="high" />
                                                <param name="scale" value="noscale" />
                                                <param name="salign" value="lt" />
                                                <param name="bgcolor" value="000000" />
                                                <param name="flashvars" value="wimpyApp=<?php echo MY_SITE_URL ?>rave/rave.php&wimpySkin=<?php echo MY_SITE_URL ?>rave/skins/myskin/skin_myskin.xml&playlist=<?php echo MY_SITE_URL . "img/yomama/file/" . $songFile; ?>&wimpyReg=NmslMjMlM0JvcDZKayU3RkhNaEIlMkNHclY5JTVFV2ZTJTdCOFlHN25m&startPlayingOnload=yes" loop="false" menu="false" quality="high" width="428" height="105" scale="noscale" salign="lt" name="wimpy1540" align="center" bgcolor="000000" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"/>

                                                <embed src="<?php echo MY_SITE_URL ?>rave/rave.swf" flashvars="wimpyApp=<?php echo MY_SITE_URL ?>rave/rave.php&wimpySkin=<?php echo MY_SITE_URL ?>rave/skins/myskin/skin_myskin.xml&playlist=<?php echo MY_SITE_URL . "img/yomama/file/" . $songFile; ?>&wimpyReg=NmslMjMlM0JvcDZKayU3RkhNaEIlMkNHclY5JTVFV2ZTJTdCOFlHN25m&startPlayingOnload=yes" loop="false" menu="false" quality="high" width="428" height="105" scale="noscale" salign="lt" name="wimpy1540" align="center" bgcolor="000000" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
                                            </object>
                                            <!-- END WIMPY PLAYER CODE -->

                                            <!-- <object type="application/x-shockwave-flash"
                                    data="http://yaxmobi.com<?php echo $this->webroot; ?>img/player/mp3player.swf"
                                    id="audioplayer1" height="45" width="300">
                                    <param name="movie"
                                            value="http://yaxmobi.com<?php echo $this->webroot; ?>img/player/mp3player.swf">
                                    <param name="FlashVars"
                                            value="file=http://yaxmobi.com<?php echo $this->webroot; ?>tone/<?php echo $songFile ?>&title=<?php echo $sname ?>&lightcolor=0x66CC00;">
                                    <param name="quality" value="high">
                                    <param name="menu" value="true">
                                    <param name="wmode" value="transparent">
                            </object>  --><?
                                        }elseif ($type == 'ring') {
                                            ?> 

                                            <!-- START WIMPY PLAYER CODE -->
                                            <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,47,0" width="428" height="102" id="wimpy1540">
                                                <param name="allowScriptAccess" value="always" />
                                                <param name="movie" value="<?php echo MY_SITE_URL ?>rave/rave.swf" />
                                                <param name="loop" value="false" />
                                                <param name="menu" value="false" />
                                                <param name="quality" value="high" />
                                                <param name="scale" value="noscale" />
                                                <param name="salign" value="lt" />
                                                <param name="bgcolor" value="000000" />
                                                <param name="flashvars" value="wimpyApp=<?php echo MY_SITE_URL ?>rave/rave.php&wimpySkin=<?php echo MY_SITE_URL ?>rave/skins/myskin/skin_myskin.xml&playlist=<?php echo MY_SITE_URL . "tone/" . $songFile; ?>&wimpyReg=NmslMjMlM0JvcDZKayU3RkhNaEIlMkNHclY5JTVFV2ZTJTdCOFlHN25m&startPlayingOnload=yes" loop="false" menu="false" quality="high" width="428" height="105" scale="noscale" salign="lt" name="wimpy1540" align="center" bgcolor="000000" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"/>

                                                <embed src="<?php echo MY_SITE_URL ?>rave/rave.swf" flashvars="wimpyApp=<?php echo MY_SITE_URL ?>rave/rave.php&wimpySkin=<?php echo MY_SITE_URL ?>rave/skins/myskin/skin_myskin.xml&playlist=<?php echo MY_SITE_URL . "tone/" . $songFile; ?>&wimpyReg=NmslMjMlM0JvcDZKayU3RkhNaEIlMkNHclY5JTVFV2ZTJTdCOFlHN25m&startPlayingOnload=yes" loop="false" menu="false" quality="high" width="428" height="105" scale="noscale" salign="lt" name="wimpy1540" align="center" bgcolor="000000" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
                                            </object>
                                            <!-- END WIMPY PLAYER CODE -->

                                            <!-- <object type="application/x-shockwave-flash"
                                    data="http://yaxmobi.com<?php echo $this->webroot; ?>img/player/mp3player.swf"
                                    id="audioplayer1" height="45" width="300">
                                    <param name="movie"
                                            value="http://yaxmobi.com<?php echo $this->webroot; ?>img/player/mp3player.swf">
                                    <param name="FlashVars"
                                            value="file=http://yaxmobi.com<?php echo $this->webroot; ?>tone/<?php echo $songFile ?>&title=<?php echo $sname ?>&lightcolor=0x66CC00;">
                                    <param name="quality" value="high">
                                    <param name="menu" value="true">
                                    <param name="wmode" value="transparent">
                            </object>  --><?
                                } else {
                                    $composition = $songRec[0]['composition'];
                                            ?> <!-- START WIMPY PLAYER CODE --> <object
                                                classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
                                                codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,47,0"
                                                width="428" height="102" id="wimpy1540">
                                                <param name="allowScriptAccess" value="always" />
                                                <param name="movie"
                                                       value="<?php echo MY_SITE_URL ?>rave/rave.swf" />
                                                <param name="loop" value="false" />
                                                <param name="menu" value="false" />
                                                <param name="quality" value="high" />
                                                <param name="scale" value="noscale" />
                                                <param name="salign" value="lt" />
                                                <param name="bgcolor" value="000000" />
                                                <param name="flashvars"
                                                       value="wimpyApp=<?php echo MY_SITE_URL ?>rave/rave.php&wimpySkin=<?php echo MY_SITE_URL ?>rave/skins/myskin/skin_myskin.xml&playlist=<?php echo MY_SITE_URL ?>img/songs/<?php echo $songFile ?>&wimpyReg=NmslMjMlM0JvcDZKayU3RkhNaEIlMkNHclY5JTVFV2ZTJTdCOFlHN25m&startPlayingOnload=yes" loop="false" menu="false" quality="high" width="428" height="105" scale="noscale" salign="lt" name="wimpy1540" align="center" bgcolor="000000" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"/>

                                                <embed src="<?php echo MY_SITE_URL ?>rave/rave.swf"
                                                       flashvars="wimpyApp=<?php echo MY_SITE_URL ?>rave/rave.php&wimpySkin=<?php echo MY_SITE_URL ?>rave/skins/myskin/skin_myskin.xml&playlist=<?php echo MY_SITE_URL ?>img/songs/<?php echo $songFile ?>&wimpyReg=NmslMjMlM0JvcDZKayU3RkhNaEIlMkNHclY5JTVFV2ZTJTdCOFlHN25m&startPlayingOnload=yes"
                                                       loop="false" menu="false" quality="high" width="428"
                                                       height="105" scale="noscale" salign="lt" name="wimpy1540"
                                                       align="center" bgcolor="000000" allowScriptAccess="always"
                                                       type="application/x-shockwave-flash"
                                                       pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>
                                            <!-- END WIMPY PLAYER CODE --> <?
                                }
                            } else {
                                echo "We are unable to play this joke. Please check back soon.";
                            }
                                    ?></td>

                                <td rowspan='3' width='150px'>
                                    <table width=100% height='100%'>
                                        <tr>
                                            <td>
                                                <?
                                                if ($paid == 'N')
                                                    echo "<a title='Download on PC' href='/users/index/download/" . $songRec[0]['path'] . ',' . $songRec[0]['id'] . ',free' . "'> " .
                                                    "<img src=\"/img/download_button.jpg\" border=\"0\" align=\"absmiddle\" />" . "</a>";
                                                ?>
                                                <a href="#<?php echo $type . '-' . $songRec[0]['id']; ?>" class="add-w-l"><img src="/img/wishlist.gif" align="absmiddle"></a>
                                            </td>
                                        </tr>
                                        <!-- Download Cart Section -->
                                        <?
                                        if ($type != 'ring') {
                                            //echo $this->requestAction('/rightmenus/relateditem/reduced', array('return'));
                                            echo $view['actions']->render('YxBundle:Box:related', array('size' => 'reduced'));
                                        }
                                        ?>
                                        <!-- Download Cart Section -->	
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td height='28px'>
                                    <?
                                    //echo $this->requestAction('/tickers/index/reduced', array('return'));
                                    echo $view['actions']->render('YxBundle:Tickers:index', array('flag' => 'reduced'));
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td align='left'>
                                    <div align="left">

                                        <OBJECT id="slideshow"
                                                classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
                                                codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0"
                                                WIDTH="425" HEIGHT="58" id="test" align="middle">
                                            <PARAM NAME=movie VALUE="/flash/mediaplayer.swf">
                                            <PARAM NAME=quality VALUE=high>
                                            <PARAM NAME=allowScriptAccess VALUE=sameDomain>
                                            <PARAM NAME=bgcolor VALUE=#b3b4d9>
                                            <EMBED Name="slideshow" src="/flash/mediaplayer.swf" quality=high
                                                   bgcolor=#b3b4d9 WIDTH="425" HEIGHT="58"
                                                   TYPE="application/x-shockwave-flash"
                                                   PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED></div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>


            </table>
