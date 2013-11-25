<?php $view->extend('YxBundle:layout:base.html.php') ?>

<?php $view['slots']->start('body') ?>
<script type="text/javascript" src="/js/js_files/home.js"></script>
<table border="0" cellspacing="0" cellpadding="0" class="container">
    <tr>
        <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
        <td class="navwhitetext">Preview Ringtone</td>
        <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
    </tr>
    <tr>
        <td colspan="3" align="center" width="100%">
            <OBJECT id="slideshow" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" WIDTH="429" HEIGHT="144"  id="homeBanner" align="middle"> 
                <PARAM NAME=movie VALUE="/flash/yaxmobi_ringtone.swf">
                <PARAM NAME=quality VALUE=high> 
                <PARAM NAME=allowScriptAccess VALUE=sameDomain> 
                <EMBED Name="slideshow" src="/flash/yaxmobi_ringtone.swf" quality=high WIDTH="429" HEIGHT="144" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED>
            </OBJECT>
        </td>
    </tr>
    <tr>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3">
            <script type="text/javascript"
            src="http://www.zaptophone.com/resources/zaptophone.js"></script>
            <form name="frm1" id ="frm1" method="post" action="/ringtones/download/">
                <input type="hidden" name="idf" value="">
                <input type="hidden" name="type" value="">
                <input type="hidden" name="price" value="">
                <input type="hidden" name="ringtone_file" value="">
                <input type="hidden" name="myxer_tag" value="">
                <input type="hidden" name="ringtone_title" value="">

                <table width="100%" border="0" align="center">
                    <?php
                    $rowColor = 'bgcolor="#fff"';
                    $downloadImage = "ringtone_download_black.gif";
                    ?>
                    <tr <?php echo $rowColor ?>>
                        <?php
                        for ($i = 0; $i <= count($ringtones) - 1; $i++) {
                            ?>

                            <td width='50%'>
                                <table width='100%' style="border-right: 1px solid;border-right-color: #FF9C12;border-bottom: 1px solid; border-bottom-color: #FF9C12;">

                                    <tr valign='top'>
                                        <td valign='top' nowrap>
                                            <?php
                                            echo ($i + 1) . '.&nbsp;' . $ringtones[$i]['title'];
                                            if ($ringtones[$i]['type'] == '0' || $ringtones[$i]['type'] == '') {
                                                echo '<img src="/img/freeimage.gif" />'; 
                                            }
                                            else
                                                print '<br><b>Price: $ ' . str_replace("$", "", $ringtones[$i]['price']) . '</b>';
                                            ?>

                                        </td>
                                        <td valign='top' width='100' rowspan='2' align='right'>
    <?php
    $file = WWW_ROOT . 'tone/' . $ringtones[$i]['ringtone'];

    if (is_file($file)) {
        $fileName = $ringtones[$i]['ringtone'];
        $fileTitle = $ringtones[$i]['title'];
        $file = MY_SITE_URL . 'tone/' . $fileName;

        /* /<a href="javascript:zap('<?php echo $file?>', '<?php echo $ringtones[$i]['title'];?>');">Download tone!</a> */

        if ($ringtones[$i]['type'] == '0' || $ringtones[$i]['type'] == '') {
            ?>


                                                    <a href="#" onclick="javascript: document.frm1.type.value='<?php echo $ringtones[$i]['type'] ?>';document.frm1.price.value='<?php echo $ringtones[$i]['price'] ?>';document.frm1.ringtone_file.value= '<?php echo $fileName ?>'; document.frm1.ringtone_title.value= '<?php echo $fileTitle ?>';document.frm1.myxer_tag.value= '<?php echo $ringtones[$i]['myxer_tag'] ?>'; document.frm1.submit();">Download</a>
                                                    <br>
                                                    <a href="#" onclick="javascript: document.frm1.type.value='<?php echo $ringtones[$i]['type'] ?>';document.frm1.price.value='<?php echo $ringtones[$i]['price'] ?>';document.frm1.ringtone.value= '<?php echo $fileName ?>'; document.frm1.myxer_tag.value= '<?php echo $ringtones[$i]['myxer_tag'] ?>';document.frm1.ringtone_title.value= '<?php echo $fileTitle ?>';  document.frm1.submit();"> 
                                                    <img src="/img/<?php echo $downloadImage;?>" border="0" />
                                                    </a>
                                                    <?php
                                                } else {
                                                    ?>


                                                    <a href="#" onclick="javascript: if ( confirm('Your credits will be adjusted once you confirm to download this ringtone.')) { document.frm1.idf.value='<?php echo $ringtones[$i]['id'] ?>';document.frm1.type.value='<?php echo $ringtones[$i]['type'] ?>';document.frm1.price.value='<?php echo $ringtones[$i]['price'] ?>';document.frm1.ringtone_file.value= '<?php echo $fileName ?>'; document.frm1.ringtone_title.value= '<?php echo $fileTitle ?>'; document.frm1.submit();}">Download</a>
                                                    <br>
                                                    <a href="#" onclick="javascript: if ( confirm('Your credits will be adjusted once you confirm to download this ringtone.')) { document.frm1.idf.value='<?php echo $ringtones[$i]['id'] ?>';document.frm1.type.value='<?php echo $ringtones[$i]['type'] ?>';document.frm1.price.value='<?php echo $ringtones[$i]['price'] ?>';document.frm1.ringtone.value= '<?php echo $fileName ?>'; document.frm1.ringtone_title.value= '<?php echo $fileTitle ?>';  document.frm1.submit();}"> 
                                                    <img src="/img/<?php echo $downloadImage;?>" border="0" />
                                                    </a>
                                                    <?php
                                                }
                                            } else {
                                                //echo $html->link('On phone', "/users/send/form/".$ringtones[$i]['id']."/1").'<br>';
                                                //echo $html->link($html->image('Download.gif', array('border'=>'0')), "/users/send/form/". $ringtones[$i]['id']."/1");
                                            }
                                            ?>
                                        </td>
                                    </tr>

            <!-- <tr>
                    <td valign='top' colspan='2'><?php echo $ringtones[$i]['description']; ?></td>
            </tr> -->
                                    <tr>
                                        <td valign='top' colspan='2'>
                                            <?php
                                            
                                            if (( $ringtones[$i]['type'] == '0' || $ringtones[$i]['type'] == '' ) || $loggedIn) {
                                                ?>
                                                <script language="JavaScript" src="/tone/player/audio-player.js"></script>
                                                <object type="application/x-shockwave-flash" data="/tone/player/player.swf" id="audioplayer1" height="24" width="290">
                                                    <param name="movie" value="/tone/player/player.swf">
                                                    <param name="FlashVars" value="playerID=1&amp;soundFile=/tone/<?php if (is_file('tone/' . $ringtones[$i]['prew_ringtone'])) print $ringtones[$i]['prew_ringtone']; elseif (is_file('tone/preview_' . $ringtones[$i]['ringtone'])) print 'preview_' . $ringtones[$i]['ringtone']; else print $ringtones[$i]['ringtone']; ?>&amp;bg=0xCDDFF3&amp;leftbg=0x357DCE&amp;lefticon=0xF2F2F2&amp;rightbg=0xF06A51&amp;rightbghover=0xAF2910&amp;righticon=0xF2F2F2&amp;righticonhover=0xFFFFFF&amp;text=0x357DCE&amp;">
                                                    <param name="quality" value="high">
                                                    <param name="menu" value="false">
                                                    <param name="wmode" value="transparent">
                                                </object>

        <?php
    }else {
        echo "Please " . $html->link('sign in', '/users/login/') . " to browse the premium ringtones.";
    }
    echo "<br>";
    if ($songRating[$i]['points'][0] != 0) {
        echo "<table width='100%'><tr><td>";
        for ($k = 0; $k < $songRating[$i]['points'][0]; $k++) {
            echo '<img src="/img/images/star.gif" border="0" vspace="5" />';
        }
        echo " </td><td>Votes : " . $songRating[$i]['vote'][0] . "</td><td align='right'>";
        ?>
                                                <a href="#" onclick = "openWindow('<?php echo MY_SITE_URL ?>ratings/add/<?php echo $ringtones[$i]['id'] ?>,3','');">Rate </a></td></tr></table>
                                                <?php
                                            } else {
                                                echo '<img src="/img/images/00star.gif" border="0" vspace="5" />';
                                                ?>
                                    <br><a href="#" onclick = "openWindow('<?php echo MY_SITE_URL ?>ratings/add/<?php echo $ringtones[$i]['id'] ?>,3','');">Be the first one to rate this ringtone</a>
                                                <?php
                                            }
                                            ?>


                            </td>
                        </tr>


                    </table>
            </td>


                                <?php
                                if (($i + 1) % 2 == 0) {
                                    /* if($rowColor == 'bgcolor="#000000"' )
                                      $rowColor = 'bgcolor="#595757"';
                                      else
                                      $rowColor = 'bgcolor="#000000"'; */

                                    echo "</tr><tr " . $rowColor . ">";
                                }
                            }
                            ?>
    </tr>
</table>
</form>
</td>
</tr>
</table>
        <?php $view['slots']->stop() ?>