<?php $view->extend('YxBundle:layout:base.html.php') ?>

<?php $view['slots']->start('body') ?>

<link href="/css/table-sorter/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery/jquery.tablesorter.js"></script>
<script type="text/javascript" src="/js/js_files/user.js"></script>

<table width="429" border="0" cellpadding="0" cellspacing="0" class="container">
    <tr>
        <td colspan="3">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
                    <td class="navwhitetext">Welcome</td>
                    <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="3" style="border-left: #4c4c4c 1px solid; border-right: #4c4c4c 1px solid; padding: 2px">
            <table width='100%' border='0' cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
                <tr>
                    <td align="left" bgcolor="#E9E9F8"><strong>Playlist Section</strong></td>
                </tr>
                <tr>
                    <td>
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
            </table>    
        </td>
    </tr>
    <tr>
        <td colspan="3" style="border-bottom: #4c4c4c 1px solid; border-left: #4c4c4c 1px solid; border-right: #4c4c4c 1px solid">
            <table width="429" border="0" align="center">
                <tr>
                    <td align="left">
                        <div id='tasks_todo'>
                            <form name="frm1" id="frm1" method="post" action="/songs/buy">
                                <input type="hidden" name="client_info" value="" />

                                
                                
                                <table class="tablesorter" id="myTableJ" width='100%' border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
                                    <thead>
                                    <tr>
                                        <td colspan='7' align="left" bgcolor="#E9E9F8"><strong>Long Jokes</strong></td>
                                        <td bgcolor="#E9E9F8"><input type="checkbox"
                                                                                   onClick="javascript:for(i=0;i<this.form.elements.length; i++)
                                                                                       if((this.form.elements[i].type=='checkbox')&&(this.form.elements[i].name.indexOf('boxdel_')==0)) this.form.elements[i].checked=this.checked;"></td>
                                    </tr>
                                    <tr>
                                        <th align="left" bgcolor="#F5F5FC">Listen</th>
                                        <th width="180px" align="left" bgcolor="#F5F5FC">Joke</th>
                                        <th align="left" bgcolor="#F5F5FC">Category</th>
                                        <th align="left" bgcolor="#F5F5FC">Duration</th>
                                        <th align="left" bgcolor="#F5F5FC">Date</th>
                                        <th align="left" bgcolor="#F5F5FC"><nobr>Add to playlist</nobr></th>

                                        <th align='left' bgcolor="#F5F5FC">Download </th>
                                        <th bgcolor="#FFFFFF">&nbsp;</th>
                                    </tr>
                                    </thead> 
                                    <tbody>
                                    <?php
                                    $color = 2;
                                    $r = 0;
                                    $counter = 1;
                                    //echo '<pre>'; print_r( $pendingSongs );die;
                                    for ($i = 0; $i <= count($pendingSongs) - 1; $i++) {
                                        if ($color % 2 == 0) {
                                            $rowColor = '#F8F8F8';
                                            $audioImage = 'images/Play-Button.png';
                                        } else {
                                            $rowColor = '#ffffff';
                                            $audioImage = 'images/Play-Button.png';
                                        }
                                        $color++;
                                        ?>
                                        <tr bgcolor="<?php echo $rowColor ?>" valign='top' id="<?php echo $counter; ?>"
                                            onmouseover="Javascript: void roll_over('<?php echo $rowColor; ?>', this.id);"
                                            onmouseout="javascript: void roll_over_restore('<?php echo $rowColor; ?>', this.id);">
                                            <td><a
                                                    href="javascript:openPlayer('<?php echo $pendingSongs[$i]['id']; ?>', 'pending')">
                                                        <img src="/img/images/Play-Button.png" border="0" align="absmiddle" /></a>&nbsp;&nbsp;
                                            </td>
                                            <td width='350'><?php echo $pendingSongs[$i]['composition']; ?>
                                                <br> 
    <?php
    if ($songRating[$r]['points'][0] != 0) {
        for ($k = 0; $k < $songRating[$r]['points'][0]; $k++) {
            echo '<img src="/img/star.gif" />';
        }
        echo " Votes : " . $songRating[$r]['vote'][0];
    } else {
        echo '<img src="/img/00star.gif" />';
        ?> <a target="_blank"
                                                       href="/ratings/add/<?php echo $pendingSongs[$i]['id'] ?>">Rate</a>


                                                    <?php
                                                }
                                                ?></td>
                                            <td><?php echo $pendingSongs[$i]['gname'] ?></td>
                                            <td><?php echo $pendingSongs[$i]['duration'] ?></td>
                                            <td nowrap><?php
                                            $date = $pendingSongs[$i]['created'];
                                            if ($date != '0000-00-00 00:00:00')
                                                echo date("d M, Y", strtotime($date));
                                                ?></td>
                                            <td><a href="#<?php echo $pendingSongs[$i]['cart_id'];?>" class="add-p-l"><img border="0" src="/img/playlist.jpg" alt="Add to Playlist"></a>
                                                
                                                <?php
                                                /*
                                            if (($pendingSongs[$i]['status'] != '1')) {
                                                $pr = '';
                                                if ($pendingSongs[$i]['ratepc'] - $pendingSongs[$i]['rate'] >= 0)
                                                    $pr = ' $' . ($pendingSongs[$i]['ratepc'] - $pendingSongs[$i]['rate']);
                                                else
                                                    $pr = '$ 0';

                                                print '<nobr><input type="checkbox" name="box_[]" value="' . $pendingSongs[$i]['cart_id'] . '">Phone</nobr><br> ' . $pr;
                                            }
                                            else
                                                print '<br>';

                                             if (($pendingSongs[$i]['Cartitem']['statuspc'] == '0'))
                                              {
                                              print '<nobr><input type="checkbox" name="boxpcp_[]" value="'.$pendingSongs[$i]['Cartitem']['id'].'">PC</nobr>';
                                              } */
                                                ?></td>
                                            
                                            <td align="left" width='41'><?php
                                            if (($pendingSongs[$i]['status'] == '1')) {
                                                    ?> <a title="Download"
                                                       href="/users/send/form/<?php echo $pendingSongs[$i]['id'] ?>"><nobr><img
                                                                align="left" src="/img/Download.gif" width="20px" border="0">Phone<sup>&nbsp;</sup></nobr></a><br>
                                                    <br>
                                                    <?php
                                                }

                                                if (($pendingSongs[$i]['statuspc'] == '1') || ($pendingSongs[$i]['statuspc'] == '2')) {
                                                    ?> <a title="Download" href="/users/welcome/download/<?php
                                                        if ($pendingSongs[$i]['drm'] != '') {
                                                            $filename = $pendingSongs[$i]['drm'];
                                                            if (substr($filename, 0, 4) == 'drm_')
                                                                $filename = substr($filename, 4);
                                                            print $filename;
                                                        } else{
                                                            print $pendingSongs[$i]['path'];
                                                        }
                                                        print "," . $pendingSongs[$i]['id']
                                                    ?>"> 
                                                        <nobr>
                                                            <img src="/img/Download.gif" align="left" width="20px" border="0">PC</nobr>
                                                    </a>
                                                    <?php /*if ($pendingSongs[$i]['drm'] != '' && !($pos = strrpos($pendingSongs[$i]['drm'], '.mp3'))) { ?>
                                                        <a target="_blank" title="Get code to unlock file" 
                                                           href="/users/license/<?php echo $pendingSongs[$i]['id'] ?>"><nobr>License</nobr></a>
                                                       <?php }*/ ?> 
                                            <?php } ?>
                                            </td>
                                            <td><a target="_blank"
                                                   href="/ratings/add/<?php echo $pendingSongs[$i]['id'] ?>">Rate</a>
                                                <hr>


                                        <nobr>Remove <input type="checkbox" name="boxdel_[]"
                                                            value="<?php echo $pendingSongs[$i]['id']; ?>"></nobr></td>
                                        </tr>

    <?php
    $r++;
    $counter++;
}
echo '</tbody>';
if (count($pendingSongs) == 0) {
    ?>
                                        <tr>
                                            <td colspan='8' align='center' bgcolor="#FFFFFF">No Record Found !!!!

                                        </tr>
                                        <?php
                                    }
                                    ?>
              
                                </table>
                                
                                <div>&nbsp;</div>
                                
                                
                                <table class="tablesorter" id="myTable" width='100%' border='0' cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
                                    <thead>
                                    <tr>
                                        <td colspan='6' align="left" bgcolor="#E9E9F8"><strong>One Liners</strong></td>
                                        <td align="right" bgcolor="#E9E9F8"></td>
                                    </tr>
                                    
                                    <tr>
                                        <th align="left" bgcolor="#F5F5FC">Listen</th>
                                        <th align="left" bgcolor="#F5F5FC">Title</th>
                                        <th align="left" bgcolor="#F5F5FC">Category</th>
                                        <th align="left" bgcolor="#F5F5FC">Price</th>
                                        <th align="left" bgcolor="#F5F5FC">Add to playlist</th>
                                        <th align='left' bgcolor="#F5F5FC">&nbsp;&nbsp;&nbsp;&nbsp;Download&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th bgcolor="#FFFFFF">&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $color = 2;
                                    $r = 0;
                                    
                                    for ($i = 0; $i <= count($pendingringtone) - 1; $i++) {
                                        //echo '<pre>'; print_r( $pendingringtone );die;
                                        if ($color % 2 == 0)
                                            $rowColor = '#F8F8F8';
                                        else
                                            $rowColor = '#ffffff';
                                        $color++;
                                        ?>
                                        <tr bgcolor="<?php echo $rowColor ?>" valign='top' id="<?php echo $counter; ?>"
                                            onmouseover="Javascript: void roll_over('<?php echo $rowColor; ?>', this.id);"
                                            onmouseout="javascript: void roll_over_restore('<?php echo $rowColor; ?>', this.id);">
                                            <td><a href='javascript:void' onclick="openPlayer('<?php echo $pendingringtone[$i]['id']; ?>', 'ring')">
                                                <img src="/img/images/Play-Button.png" border="0" align="absmiddle" />
                                                    </a>&nbsp;&nbsp;
                                            </td>
                                            <td><?php echo $pendingringtone[$i]['title']; ?>
                                            </td>
                                            <td><?php echo $pendingringtone[$i]['catname'] ?>
                                            </td>
                                            <td><?php echo $pendingringtone[$i]['price'] ?></td>
                                            <td><a href="#<?php echo $pendingringtone[$i]['cart_id'];?>" class="add-p-l"><img border="0" src="/img/playlist.jpg" alt="Add to Playlist"></a></td>
                                            <td align="left" width='41'><!-- download on phone --> <a
                                                    title="Download"
                                                    href="/users/send/form/<?php echo $pendingringtone[$i]['id'] ?>/1"><nobr><img
                                                            align="left" src="/img/Download.gif" width="20px" border="0">Phone</nobr></a>
                                            </td>
                                            <td><a href="#" onClick="openWindow('/ratings/add/<?php echo $pendingringtone[$i]['id'] ?>,3','');">Rate</a>
                                                <hr>


                                        <nobr>Remove <input type="checkbox" name="boxdel_[]"
                                                            value="<?php echo $pendingringtone[$i]['id']; ?>"></nobr>
                                        </td>
                                        </tr>

                                        <?php
                                        $r++;
                                        $counter++;
                                    }
                                    
                                    echo '</tbody>';
                                    if (count($pendingringtone) == 0) {
                                        ?>
                                        <tr>
                                            <td colspan='7' align='center' bgcolor="#FFFFFF">No Record Found !!!!</td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    
                                </table>
                                
                                

                                
                                
                                <div>&nbsp;</div>
                                
                                <table class="tablesorter" id="myTableR" width='100%' border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
                                    <thead>
                                    <tr>
                                        <td colspan='7' align="left" bgcolor="#E9E9F8"><strong>Recent
                                                Downloads</strong></td>
                                        <td bgcolor="#E9E9F8"></td>
                                    </tr>

                                    <tr class='txtHeadingOrange'>
                                        <th align="left" bgcolor="#F5F5FC">Listen</th>
                                        <th align="left" bgcolor="#F5F5FC">Joke</th>
                                        <th align="left" bgcolor="#F5F5FC">Category</th>
                                        <th align="left" bgcolor="#F5F5FC">Duration</th>
                                        <th align="left" bgcolor="#F5F5FC">Date</th>
                                        <th align="left" bgcolor="#F5F5FC"><nobr>Buy For</nobr></th>
                                        <th align='left' bgcolor="#F5F5FC">Download</th>
                                        <th bgcolor="#FFFFFF"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
<?php
$r = 0;
$color = 2;
//echo '<pre>'; print_r( $freeSongs );die;
for ($i = 0; $i <= count($freeSongs) - 1; $i++) {
    if ($color % 2 == 0) {
        $rowColor = '#F8F8F8';
        $audioImage = 'images/Play-Button.png';
    } else {
        $rowColor = '#ffffff';
        $audioImage = 'images/Play-Button.png';
    }
    $color++;
    ?>
                                        <tr bgcolor="<?php echo $rowColor ?>" valign='top' id="<?php echo $counter; ?>"
                                            onmouseover="Javascript: void roll_over('<?php echo $rowColor; ?>', this.id);"
                                            onmouseout="javascript: void roll_over_restore('<?php echo $rowColor; ?>', this.id);">
                                            <td><a
                                                    href="javascript:openPlayer('<?php echo $freeSongs[$i]['id']; ?>', '')">
                                                        <img src="/img/images/Play-Button.png" border="0" align="absmiddle" />
                                                </a>&nbsp;&nbsp;
                                            </td>
                                            <td align="left"><?php echo $freeSongs[$i]['composition']; ?>
                                                <br>
                                        <?php
                                        if ($songRating[$r]['points'][0] != 0) {
                                            for ($k = 0; $k < $songRating[$r]['points'][0]; $k++) {
                                                echo '<img src="/img/star.gif" />';
                                            }
                                            echo " Votes : " . $songRating[$r]['vote'][0];
                                        } else {
                                            echo '<img src="/img/00star.gif" />';
                                            ?> <br>
                                                    <a target="_blank"
                                                       href="/ratings/add/<?php echo $freeSongs[$i]['id'] ?>">Rate</a>
        <?php
    }
    ?></td>
                                            <td align="left"><?php echo $freeSongs[$i]['gname'] ?>
                                            </td>
                                            <td align="left"><?php echo $freeSongs[$i]['duration'] ?>
                                            </td>
                                            <td nowrap><?php
                                            $date = $freeSongs[$i]['created'];
                                            if (strtotime($date) > 0)
                                                echo date("d M, Y", strtotime($date));
    ?></td>


                                            <td><?php
                                            if (($freeSongs[$i]['status'] != '1')) {
                                                $pr = '';

                                                if ($freeSongs[$i]['ratepc'] - $freeSongs[$i]['rate'] >= 0)
                                                    $pr = ' $' . ($freeSongs[$i]['ratepc'] - $freeSongs[$i]['rate']);
                                                else
                                                    $pr = '$ 0';

                                                print '<nobr><input type="checkbox" name="box_[]" value="' . $freeSongs[$i]['cart_id'] . '">Phone</nobr><br> ' . $pr;
                                            }
                                            else
                                                print '<br>';

                                            /* if (($freeSongs[$i]['Cartitem']['statuspc'] == '0'))
                                              {
                                              print '<nobr><input type="checkbox" name="boxpcp_[]" value="'.$freeSongs[$i]['Cartitem']['id'].'">PC</nobr>';
                                              } */
    ?></td>



                                            <td align="left"><?php
                                            if (($freeSongs[$i]['status'] == '1')) {
        ?> <a title="Download"
                                                       href="/users/send/form/<?php echo $freeSongs[$i]['id'] ?>"><nobr><img
                                                                align="left" src="/img/Download.gif" width="20px" border="0">Phone<sup>&nbsp;</sup></nobr></a><br>
                                                    <br>
                                                    <?php
                                                }

                                                if (($freeSongs[$i]['statuspc'] == '1') || ($freeSongs[$i]['statuspc'] == '2')) {
                                                    //echo "<pre>";
                                                    //print_r($pendingSongs);
                                                    ?> <a title="Download"
                                                       href="/users/welcome/download/<?php if ($freeSongs[$i]['drm'] != '') print $freeSongs[$i]['drm']; else print $freeSongs[$i]['path']; print "," . $freeSongs[$i]['id'] ?>"><nobr><img
                                                                src="/img/Download.gif" align="left" width="20px" border="0">PC<sup>&nbsp;</sup></nobr></a>
        <?php
        /*if ($freeSongs[$i]['drm'] != '' && !in_array($freeSongs[$i]['drm'], $pendingSongArr)) {
        // && !($pos = strrpos($pendingSongs[$i]['Song']['drm'], '.mp3'))) 
            ?>
                                                        <a target="_blank" title="Get code to unlock file"
                                                           href="/users/license/<?php echo $freeSongs[$i]['id'] ?>"><nobr>License<sup>&nbsp;</sup></nobr></a>
        <?php }*/ ?> <?php } ?></td>
                                            <td><a target="_blank"
                                                   href="/ratings/add/<?php echo $freeSongs[$i]['id'] ?>">Rate</a>
                                                <hr>
                                        <nobr>Remove <input type="checkbox" name="boxdel_[]"
                                                            value="<?php echo $freeSongs[$i]['id']; ?>"></nobr></td>
                                        </tr>

                                                <?php
                                                $r++;
                                                $counter++;
                                            }
                                            echo '</tbody>';
                                            if (count($freeSongs) == 0) {
                                                ?>
                                        <tr>
                                            <td colspan='8' align='center' bgcolor="#FFFFFF">No Record Found !!!!
                                        </tr>
                                                <?php
                                            }
                                            ?>
                                    
                                    <tr>
                                    <td colspan='8' align='right' valign="top" bgcolor="#FFFFFF">
                                        <table width='100%'>
                                            <tr>
                                                <td align="right"><input type="submit" class="submit_btn" value="Buy" onClick="Javascript: this.form.client_info.value = netobj.GetSystemInfo();this.form.action='/songs/buy'; "></td>
                                            </tr>
                                            <tr>	
                                                <td align="right"><input type="submit" class="submit_btn" value="Remove" onClick="this.form.action='/users/welcome';"></td>
                                            </tr>
                                        </table>
                                    </td>
                                    </tr>
                                </table>
                            </form>
                        </div>


                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<script>
    function roll_over(origColor, obj)
    {
        //alert(origColor +'>>'+ obj);
        document.getElementById(obj).style.background = '#303161';
        document.getElementById(obj).style.color = '#fff';
    }

    function roll_over_restore(origColor, obj)
    {
        document.getElementById(obj).style.background = origColor;
        document.getElementById(obj).style.color = '#000';
    }
</script>
<?php $view['slots']->stop() ?>