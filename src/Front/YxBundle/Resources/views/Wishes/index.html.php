<?php $view->extend('YxBundle:layout:base.html.php') ?>

<?php $view['slots']->start('body') ?>
<script type="text/javascript" src="/js/js_files/wishes.js"></script>
<table border="0" cellspacing="0" cellpadding="0" class="container">
    <tr>
        <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
        <td class="navwhitetext">My Wish List</td>
        <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
    </tr>
    <tr>
        <td colspan="3" align="center" width="100%">
            <form name="frm1" id ="frm1" method="post" action="/wishes/buy/">
                <table width="100%" border="0" align="center">
                <tr>
                    <th><input type="checkbox" id="sel-all" /> </th>
                    <th>My Wish Item Name</th>
                    <th>Category</th>
                    <th>Date Added</th>
                    <th style="font-size:8">Item Price</th>
                </tr>
                <?php if(count($userCartItems)>0):
                    //echo '<pre>'; print_r( $userCartItems );die;
                    $color = 2;
                    $basketprice=0;
                    $counter = 1;
                    
                    foreach ($userCartItems as $song): 
                        if($color%2==0){
                            $rowColor = '#F8F8F8';
                        }else{
                            $rowColor = '#ffffff';
                        }
                        $color ++;
                        $counter++;
                        
                        $songType = 's';
                        if ( $song['ringtone_id'] != '' ):
                            $songType = 'r';
                        endif;
                        
                        if ( $song['ringtone_id'] != '' ):
                            $songId = $song['ringtone_id'];
                        else:
                            $songId = $song['song_id'];
                        endif;
                        
                        $audioImage = 'play_btn.gif';
                ?>
                <tr bgcolor="<?=$rowColor?>" valign='top' id="tr-<?php echo $counter;?>" 
                    onmouseover="Javascript: void roll_over('<?php echo $rowColor;?>', this.id);"
                    onmouseout="javascript: void roll_over_restore('<?php echo $rowColor;?>', this.id);">
                    <td>
                        <input type="checkbox" name="box_[]" class="chk-box" value="<?php echo $song['wish_id']; ?>" />
                        <input type="hidden" name="price[<?php echo $song['wish_id']; ?>]" value="<?php echo $song['price']; ?>" />
                        <input type="hidden" name="type[<?php echo $song['wish_id']; ?>]" value="<?php echo $songType; ?>" />
                        
                        <input type="hidden" name="song_id[<?php echo $song['wish_id']; ?>]" value="<?php echo $songId; ?>" />

                        <?php 
                            if ( $songType == 's' ):
                        ?>
                        <a href="javascript:openPlayer('<?php echo $songId; ?>', '')">
                            <img border="0" align="absmiddle" src="/img/images/<?php echo $audioImage ?>">
                        </a>
                        <?php 
                            else:
                        ?>
                        <div style="float:none; overflow: visible; width: 20px;">
                            <script language="JavaScript" src="/tone/player/audio-player.js"></script>
                            <object type="application/x-shockwave-flash" data="/tone/player/player.swf" id="audioplayer1" height="24" width="290">
                                <param name="movie" value="/tone/player/player.swf">
                                <param name="FlashVars" value="playerID=1&amp;soundFile=/tone/<?php if (is_file('tone/' . $song['prew_ringtone'])) print $song['prew_ringtone']; elseif (is_file('tone/preview_' . $song['ringtone'])) print 'preview_' . $song['ringtone']; else print $song['ringtone']; ?>&amp;bg=0xCDDFF3&amp;leftbg=0x357DCE&amp;lefticon=0xF2F2F2&amp;rightbg=0xF06A51&amp;rightbghover=0xAF2910&amp;righticon=0xF2F2F2&amp;righticonhover=0xFFFFFF&amp;text=0x357DCE&amp;">
                                <param name="quality" value="high">
                                <param name="menu" value="false">
                                <param name="wmode" value="transparent">
                            </object>
                        </div>
                        <?php        
                            endif;
                        ?>
                    </td>
                    <td>
                        <?php echo $song['ringtone']; ?>
                    </td>
                    <td>
                        <?php echo $song['title']; ?>
                    </td>
                    <td>
                        <?php echo $song['created']; ?>
                    </td>
                    <td>
                        <?php echo $song['price']; ?>
                    </td>
                </tr>
                <?php endforeach;?>
                <?php
                echo '<tr>
                        <td colspan="5">
                            <input id="buy-w-l" type="submit" value="Buy" class="submit_btn" />
                            <input id="del-w-l" type="submit" value="Remove" class="submit_btn" />
                        </td>
                    </tr>';
                    else:
                        echo '<tr><td colspan="5">No Records.</td></tr>';
                    endif;
                ?>
                
            </table>
            </form>
        </td>
    </tr>
</table>
<?php $view['slots']->stop() ?>