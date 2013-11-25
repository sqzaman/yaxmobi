<?php $view->extend('YxBundle:layout:base.html.php') ?>

<?php $view['slots']->start('body') ?>
<script type="text/javascript" src="/js/js_files/home.js"></script>
<table border="0" cellspacing="0" cellpadding="0" class="container">
    <tr>
        <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
        <td class="navwhitetext">Ringtone</td>
        <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
    </tr>
    <tr>
        <td colspan="3" align="center" width="100%">
            <OBJECT id="slideshow"
                    classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
                    codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0"
                    WIDTH="429" HEIGHT="144" id="homeBanner" align="middle">
                <PARAM NAME=movie VALUE="/flash/yaxmobi_ringtone.swf">
                <PARAM NAME=quality VALUE=high>
                <PARAM NAME=allowScriptAccess VALUE=sameDomain>
                <EMBED Name="slideshow" src="/flash/yaxmobi_ringtone.swf"
                       quality=high WIDTH="429" HEIGHT="144"
                       TYPE="application/x-shockwave-flash"
                       PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED>
            </OBJECT>
        </td>
    </tr>

    <tr>
        <td colspan="3" align="center" width="100%">
            <table width="100%" border="0" align="center">
                <tr>
                    <td colspan='2'>
                        <?php echo $view['actions']->render('YxBundle:Tabs:home_page_ringtone'); ?> 
                    </td>
                </tr>
                <tr>
                    <td align="right" colspan='2'>
                        <a class="blue_btn_a back-btn" href="#"><div class="blue_btn">Back</div></a>
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <div id="tabdiv">

                            <!--             Tabbed Section -->
                            <?php echo $view['actions']->render('YxBundle:Tabs:ringtone'); ?>
                            <!--             Tabbed Section -->


                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="1">
                                    <img src="/img/images/t01.gif" border="0" width="5" height="28" />
                                </td>
                                <td width="417" class="navwhitetext" style="background-image: url('/img/images/t02.gif'); background-repeat: repeat-x;">
                                    Free Ringtones</td>
                                <td width="1" align="right">
                                    <img src="/img/images/t03.gif" border="0" width="5" height="28" />
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <?php
                for ($i = 0; $i <= count($ringtones) - 1; $i++) {
                    if (($i + 2) % 2 == 0) {
                        $rowColor = '#ffffff';
                        $downloadImage = "images/download_btn.gif";
                    } else {
                        $rowColor = '#e5e5e5';
                        $downloadImage = "images/download_btn.gif";
                    }
                    ?>
                    <tr bgcolor=<?php echo $rowColor ?> id="<?php echo $i; ?>" onmouseover="Javascript: void roll_over('<?php echo $rowColor; ?>', this.id);" onmouseout="javascript: void roll_over_restore('<?php echo $rowColor; ?>', this.id);">
                        <td width='50%'>
                            <table width='100%' border='0'>
                                <tr valign='top'> 
                                    <td valign='top' width=200>
                                        <?php
                                        echo ($i + 1) . '.&nbsp;' . $ringtones[$i]['title'];
                                        if ($ringtones[$i]['type'] == '0' || $ringtones[$i]['type'] == '') {
                                            echo "&nbsp;&nbsp; <img src='/img/images/free_btn.gif' border='0' />";
                                        } else {
                                            print '&nbsp;&nbsp;<b>Price: ' . $ringtones[$i]['price'] . '</b>';
                                        }
                                        echo "<br>";
                                        // Print rating star for this ringtone
                                        if ($songRating[$i]['points'][0] != 0) {
                                            echo "<table width='100%'><tr><td>";
                                            for ($k = 0; $k < $songRating[$i]['points'][0]; $k++) {
                                                echo "<img src='/img/images/star.gif' border='0' vspace='5' />";
                                            }
                                            echo " </td><td>Ratings : " . $songRating[$i]['vote'][0] . "</td><td align='right'>";
                                            ?> 
                                            <a href="javascript:void"
                                               onclick="openWindow('<?php echo MY_SITE_URL ?>ratings/add/<?php echo $ringtones[$i]['id'] ?>,3','');">Rate
                                            </a>
                                    </td></tr></table>
                                        
                                        
        <?
    } else {
        echo "<img src='/img/images/00star.gif' border='0' vspace='5' />";
        ?> <br>
                                <a href="javascript:void"
                                   onclick="openWindow('<?php echo MY_SITE_URL ?>ratings/add/<?php echo $ringtones[$i]['id'] ?>,3','');">Be
                                    the first one to rate this ringtone</a> <?
                    }
    ?>
                        </td>
                                    </tr>
                                    </table></td>
                        <td>
    <?
    if ( ( $ringtones[$i]['type'] == '0' || $ringtones[$i]['type'] == '' ) || $loggedIn ) {
        ?> <script language="JavaScript" src="/tone/player/audio-player.js"></script> 
                                <object
                                    type="application/x-shockwave-flash"
                                    data="/tone/player/player.swf"
                                    id="audioplayer1" height="24" width="209">
                                    <param name="movie"
                                           value="/tone/player/player.swf">
                                    <param name="FlashVars"
                                           value="playerID=1&amp;soundFile=/tone/<? if (is_file('tone/' . $ringtones[$i]['prew_ringtone'])) print $ringtones[$i]['prew_ringtone']; elseif (is_file('tone/preview_' . $ringtones[$i]['ringtone'])) print 'preview_' . $ringtones[$i]['ringtone']; else print $ringtones[$i]['ringtone']; ?>&amp;bg=0xCDDFF3&amp;leftbg=0x357DCE&amp;lefticon=0xF2F2F2&amp;rightbg=0xF06A51&amp;rightbghover=0xAF2910&amp;righticon=0xF2F2F2&amp;righticonhover=0xFFFFFF&amp;text=0x357DCE&amp;">
                                    <param name="quality" value="high">
                                    <param name="menu" value="false">
                                    <param name="wmode" value="transparent">
                                </object> 
        <?
    }else {
        echo "Please <a href='/users/login/'>sign in</a>";
    }
    ?>
                            <br>
                            <?
                            $file = WWW_ROOT . 'tone/' . $ringtones[$i]['ringtone'];

                            if (is_file($file)) {
                                $fileName = $ringtones[$i]['ringtone'];
                                $fileTitle = $ringtones[$i]['title'];
                                $file = MY_SITE_URL . 'tone/' . $fileName;

                                /* /<a href="javascript:zap('<?php echo $file?>', '<?php echo $ringtones[$i]['Ringtone']['title'];?>');">Download tone!</a> */

                                if ($ringtones[$i]['type'] == '0' || $ringtones[$i]['type'] == '') {
                                    ?> <a href="javascript: void();"
                                       onclick="javascript: document.frm1.type.value='<?php echo $ringtones[$i]['type'] ?>';document.frm1.price.value='<?php echo $ringtones[$i]['price'] ?>';document.frm1.ringtone_file.value= '<?php echo $fileName ?>'; document.frm1.myxer_tag.value= '<?php echo $ringtones[$i]['myxer_tag'] ?>';document.frm1.ringtone_title.value= '<?php echo $fileTitle ?>';  document.frm1.submit();">
                                    <img src='/img/images/<?php echo $downloadImage;?>' border='0'/>
                                    </a> <?
                                } else {
                                    ?> <a href="javascript: void();"
                                       onclick="javascript: if ( confirm('Your credits will be adjusted once you confirm to download this ringtone.')) { document.frm1.idf.value='<?php echo $ringtones[$i]['id'] ?>';document.frm1.type.value='<?php echo $ringtones[$i]['type'] ?>';document.frm1.price.value='<?php echo $ringtones[$i]['price'] ?>';document.frm1.ringtone_file.value= '<?php echo $fileName ?>'; document.frm1.ringtone_title.value= '<?php echo $fileTitle ?>';  document.frm1.submit();}">
                                    <img src='/img/images/<?php echo $downloadImage;?>' border='0'/> </a> <?
                                }
                            } else {
                                //echo $html->link('On phone', "/users/send/form/".$ringtones[$i]['Ringtone']['id']."/1").'<br>';
                                //echo $html->link($html->image('Download.gif', array('border'=>'0')), "/users/send/form/". $ringtones[$i]['Ringtone']['id']."/1");
                            }
                            ?>
                            <a href="#ringtone-<?php echo $ringtones[$i]['id']; ?>" class="add-w-l"><img src="/img/wishlist.gif" align="absmiddle"></a>
                        </td>
                    </tr>
                            <?php
                        }
                        ?>
                <tr>
                    <td align="right" colspan='2'>
                        <a class="blue_btn_a back-btn" href="#"><div class="blue_btn">Back</div></a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
                        <?php $view['slots']->stop() ?>