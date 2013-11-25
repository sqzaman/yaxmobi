<?php $view->extend('YxBundle:layout:base.html.php') ?>

<?php $view['slots']->start('body') ?>
<script type="text/javascript" src="/js/js_files/home.js"></script>
<table width="429" border="0" cellpadding="0" cellspacing="0" class="container">
    <tr>
        <td colspan="3">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
                    <td class="navwhitetext">Audio Joke Category</td>
                    <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="3" align="center" width="100%"><OBJECT id="slideshow"
                                                            classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
                                                            codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0"
                                                            WIDTH="429" HEIGHT="144" id="homeBanner" align="middle">
                <PARAM NAME=movie VALUE="/flash/yaxmobi_audio_joke.swf">
                <PARAM NAME=quality VALUE=high>
                <PARAM NAME=allowScriptAccess VALUE=sameDomain>
                <EMBED Name="slideshow" src="/flash/yaxmobi_audio_joke.swf"
                       quality=high WIDTH="429" HEIGHT="144"
                       TYPE="application/x-shockwave-flash"
                       PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED></OBJECT>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <table width="100%" border="0" cellspacing="0" cellpadding="5">
                <tr>
                    <td align="center"><strong>List of Audio Jokes:</strong></td>
                </tr>
                <tr>
                    <td align="center">
                        <?php echo $view->render('YxBundle:Box:index_search.html.php'); ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <div id="tabdiv">
                <?php echo $view['actions']->render('YxBundle:Tabs:index'); ?>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            &nbsp;
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <table width="100%" border="0" cellspacing="0" cellpadding="1">
                <tr>
                    <td>
                        <table width="100%" border="0" cellpadding="5" cellspacing="1"
                               bgcolor="#bbbbbb">
                            <tr>
                                <td bgcolor="#E9E9F8"><strong>Listen </strong></td>
                                <td bgcolor="#E9E9F8"><strong>Joke </strong></td>
                                <td bgcolor="#E9E9F8"><strong>Get It</strong></td>
                                <td align="center" bgcolor="#E9E9F8"><strong>Send <br />
                                        to Phone</strong></td>
                                <td bgcolor="#E9E9F8"><strong>Share</strong></td>
                            </tr>
                            <?
                            $color = 2;
                            for ($i = 0; $i <= count($freeSongs) - 1; $i++) {
                                if ($color % 2 == 0) {
                                    $rowColor = 'tr1';
                                    $audioImage = 'play_btn.gif';
                                } else {
                                    $rowColor = '';
                                    $audioImage = 'play_btn.gif';
                                }
                                $color++;
                                ?>
                                <tr class="<?php echo $rowColor ?>" valign='top'>
                                    <td>
                                        <a title="Play" href='javascript:void();'
                                           onclick="openPlayer('<?php echo $freeSongs[$i]->getId(); ?>','')">
                                            <img border="0" align="absmiddle" src="/img/images/<?php echo $audioImage ?>">
                                        </a>
                                    </td>
                                    <td width='270'><a href='javascript:void'
                                                       onclick="openPlayer('<?php echo $freeSongs[$i]->getId(); ?>','')"><?php echo $freeSongs[$i]->getComposition(); ?></a>
                                        <br>
                                        <?
                                        if ($songRating[$i]['points'][0] != 0) {
                                            for ($k = 0; $k < $songRating[$i]['points'][0]; $k++) {
                                                echo '<img src="/img/images/star.gif">';
                                            }
                                            echo " Ratings : " . $songRating[$i]['vote'][0];
                                        } else {
                                            echo '<img src="/img/images/00star.gif">';
                                            ?> <br>
                                            <a href="javascript:void();"
                                               onclick="openWindow('/ratings/add/<?php echo $freeSongs[$i]->getId(); ?>','');">Be
                                                the first one to rate this joke</a> <?
                                }
                                        ?> &nbsp;&nbsp;<a href="javascript:void();"
                                                       onclick="openWindow('/ratings/add/<?php echo $freeSongs[$i]->getId() ?>','');">Vote</a>
                                    </td>
                                    <td align='right'>
                                        <table>
                                            <tr valign='top'>
                                                <td align='right'><img border="0" align="absmiddle" src="/img/images/free_btn.gif"></td>
                                                <td align='left'>
                                                    <a title="Download on PC" href='/users/index/download/<?php echo $freeSongs[$i]->getPath() . "," . $freeSongs[$i]->getId() . ",free" ?>'>
                                                        <img border="0" align="absmiddle" src="/img/images/download_btn.gif">
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td><a title="Download on phone"
                                           href='/users/send/form/<?php echo $freeSongs[$i]->getId(); ?>'>
                                            <img border="0" align="absmiddle" src="/img/images/mobile_icon.gif">
                                        </a>
                                    </td>
                                    <td>
                                        <a title="Send To Friends" href='/tellafriends/add/<?php echo $freeSongs[$i]->getId(); ?>'>
                                            <img border="0" align="absmiddle" src="/img/images/share_icon.gif">
                                        </a>
                                    </td>
                                </tr>
                                <?
                            }
                            ?>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<?php $view['slots']->stop() ?>