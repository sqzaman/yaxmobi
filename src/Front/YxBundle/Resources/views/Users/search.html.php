<?php $view->extend('YxBundle:layout:base.html.php') ?>

<?php $view['slots']->start('body') ?>
<script language="JavaScript" src="/tone/player/audio-player.js"></script>
<table width="429" border="0" cellpadding="0" cellspacing="0" class="container">
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
                    <td class="navwhitetext">Home</td>
                    <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="5">
                <tr>
                    <td align="center"><strong>List of Audio Jokes:</strong></td>
                </tr>
                <tr>
                    <td align="center">
                        <?php echo $view->render('YxBundle:Box:index_search.html.php'); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        
                        <table width='100%' cellpadding='4' cellspacing='1' border="0">
                            <!-- Ringtone Section -->
                            <tr>
                                <td colspan="2">
                                    <form name="frm11" id="frm11" method="post" action="/ringtones/download/">
                                        <input type="hidden" name="idf" value=""> 
                                        <input type="hidden" name="type" value=""> 
                                        <input type="hidden" name="price" value="">
                                        <input type="hidden" name="ringtone_file" value=""> 
                                        <input type="hidden" name="myxer_tag" value=""> 
                                        <input type="hidden" name="ringtone_title" value="">
                                        <table>
                                            <tr>
                                                <td colspan='3'>
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
                                                            <td class="navwhitetext">Ringtone(s) For Your Search Term(s)</td>
                                                            <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                    <?php 
                                        $counter = 1;
                                        $color = 2;
                                        $paidCount = 0;
                                        $i = 0;
                                        if (count($ringtones) > 0 ){
                                            $paidCount = 0;
                                            for($i=0;$i<=count($ringtones)-1;$i++){
                                                if(($i+2) % 2 == 0){
                                                        $rowColor = '#ffffff';
                                                        $downloadImage = "images/download_btn.gif";
                                                }else{
                                                        $rowColor = '#e5e5e5';
                                                        $downloadImage = "images/download_btn.gif";
                                                }
                                        ?>
                                            <tr bgcolor=<?=$rowColor?> id="<?php echo $counter;?>"
						onmouseover="Javascript: void roll_over('<?php echo $rowColor;?>', this.id);"
						onmouseout="javascript: void roll_over_restore('<?php echo $rowColor;?>', this.id);">
                                                <td width='50%' >
                                                    <table width='100%' border='0'>
				
									<tr valign='top'>
										<td valign='top' width=220 nowrap>
										<?php 
                                                                                
										echo ($i+1) . '.&nbsp;' . $ringtones[$i]['title'];
										if ( $ringtones[$i]['type'] == '0' || $ringtones[$i]['type'] == '')
										{
											echo "&nbsp;&nbsp;" . '<img src="/img/images/free_btn.gif" />';
										}
										else
										print '&nbsp;&nbsp;<b>Price: $ '.str_replace("$","",$ringtones[$i]['price']).'</b>';
										echo "<br>";
										
										//	Print song rating
										if ($songRating[$i]['points'][0] != 0){
											echo "<table width='100%' border='0'><tr><td>";
											for ($k = 0; $k < $songRating[$i]['points'][0]; $k++){
                                                                                                echo '<img src="/img/images/star.gif" vspace="5">';
											}
											echo " </td><td>Ratings : " . $songRating[$i]['vote'][0] . "</td><td align='right'>";
											?> <a href="#"
											onclick="openWindow('/ratings/add/<?=$ringtones[$i]['id']?>,3','');">Rate
											</a>
                                                                                    
											</td>
										</tr>
									</table>
								<?
										}else{
                                                                                        echo '<img src="/img/images/00star.gif" vspace="5">';
											?> <br>
											<a href="#"
												onclick="openWindow('/ratings/add/<?=$ringtones[$i]['id']?>,3','');">Be
											the first one to rate this ringtone</a> 
								<?
										}
								?>
                                                </td></tr></table>
                                                </td>
                                                <td>
                                                    <?php 
                                                                                if ( ( $ringtones[$i]['type'] == '0' || $ringtones[$i]['type'] == '' ) || $loggedIn ){
											?>  
                                                                                        <object
											type="application/x-shockwave-flash"
											data="/tone/player/player.swf"
											id="audioplayer1" height="24" width="209">
											<param name="movie"
												value="/tone/player/player.swf">
											<param name="FlashVars"
												value="playerID=1&amp;soundFile=/tone/<? if(is_file('tone/'.$ringtones[$i]['prew_ringtone'])) print $ringtones[$i]['prew_ringtone']; elseif (is_file('tone/preview_'.$ringtones[$i]['ringtone']))  print 'preview_'.$ringtones[$i]['ringtone']; else print $ringtones[$i]['ringtone'];?>&amp;bg=0xCDDFF3&amp;leftbg=0x357DCE&amp;lefticon=0xF2F2F2&amp;rightbg=0xF06A51&amp;rightbghover=0xAF2910&amp;righticon=0xF2F2F2&amp;righticonhover=0xFFFFFF&amp;text=0x357DCE&amp;">
											<param name="quality" value="high">
											<param name="menu" value="false">
											<param name="wmode" value="transparent">
										</object> <?
										}else
										{
											echo "Please <a href='/users/login'>sign in</a> to browse the premium ringtones.";
										}
										?>
										<br>
										<?php 
										$file = 'tone/'.$ringtones[$i]['ringtone'];
				
										if (is_file($file))
										{
											$fileName = $ringtones[$i]['ringtone'];
											$fileTitle = $ringtones[$i]['title'];
											$file = 'tone/'.$fileName;
				
											/*/<a href="javascript:zap('<?=$file?>', '<?php echo $ringtones[$i]['Ringtone']['title'];?>');">Download tone!</a> */
				
											if ( $ringtones[$i]['type'] == '0' || $ringtones[$i]['type'] == '')
											{
												?> 
												<a href="#"
											onclick="javascript: document.frm11.type.value='<?=$ringtones[$i]['type']?>';document.frm11.price.value='<?=$ringtones[$i]['price']?>';document.frm11.ringtone_file.value= '<?=$fileName?>'; document.frm11.myxer_tag.value= '<?=$ringtones[$i]['myxer_tag']?>';document.frm11.ringtone_title.value= '<?=$fileTitle?>';  document.frm11.submit();">
                                                                                                    <img src="/img/<?php echo $downloadImage;?>" >
                                                                                                </a> <?
											}else
											{
												if ($loggedIn)
												{
													?>
													<a href="#"
											onclick="javascript: if ( confirm('Your credits will be adjusted once you confirm to download this ringtone.')) { document.frm11.idf.value='<?=$ringtones[$i]['id']?>';document.frm11.type.value='<?=$ringtones[$i]['type']?>';document.frm11.price.value='<?=$ringtones[$i]['price']?>';document.frm11.ringtone_file.value= '<?=$fileName?>'; document.frm11.ringtone_title.value= '<?=$fileTitle?>';  document.frm11.submit();}">
                                                                                                            <img src="/img/<?php echo $downloadImage;?>" >
                                                                                                        </a>
													<?php
												}else
												{
													?>
													<a href="#"
											onclick="javascript: document.frm11.idf.value='<?=$ringtones[$i]['id']?>';document.frm11.type.value='<?=$ringtones[$i]['type']?>';document.frm11.price.value='<?=$ringtones[$i]['price']?>';document.frm11.ringtone_file.value= '<?=$fileName?>'; document.frm11.ringtone_title.value= '<?=$fileTitle?>';  document.frm11.submit();">
                                                                                                            <img src="/img/<?php echo $downloadImage;?>" >
                                                                                                        </a>
													<?php 
												}
											}
										}else
										{
											//echo $html->link('On phone', "/users/send/form/".$ringtones[$i]['Ringtone']['id']."/1").'<br>';
											//echo $html->link($html->image('Download.gif', array('border'=>'0')), "/users/send/form/". $ringtones[$i]['Ringtone']['id']."/1");
										}
										?>
                                                </td>
                                                
                                            </tr>
<!--                                            <tr>
										<td valign='top' colspan='2'></td>
                                                                        </tr>-->
                                                                        
                                        <?php
                                            }
                                        ?>
                                            <tr>
                                                <td colspan="2">
                                                    <div class="pagination">
                                                        <?php echo $paginator_r->create_links( $base_url, $extraParamR );?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php    
                                        }else{
                                            echo "<tr><td colspan='2'>There are no ringtones matching your search criteria.</td></tr>";
                                        }
                                    ?>
                                        </table>
                                            
                                    </form>
                                </td>
                            </tr>
                            <!-- Ringtone Section -->
                            
                            <!-- Audio Joke Section -->
                            <form name="frm1" id="frm1" method="post"
							action="/songs/addtocart"
							onsubmit="return chkForm();">
                            <tr>
                                <td>
                                    <table width='100%'>
                                        <tr>
                                            <td align="left"><input type="button" class="submit_btn" value="Back" onclick="javascript: void history.go(-1);"></td>
                                            <td align="right"><input type="submit" value="Add to Cart" class="submit_btn"></td>
                                        </tr>
                                    </table>
                                </td>
                                
                            </tr>
                            <tr>
                                <td>
                                    <table>
                                            <tr>
                                                <td colspan='2'>
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
                                                            <td class="navwhitetext">Audio Joke(s) For Your Search Term(s)</td>
                                                            <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td colspan="3">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
                                            <td class="navwhitetext">Free Audio Jokes</td>
                                            <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" align="center" style="border-bottom: #4c4c4c 1px solid; border-left: #4c4c4c 1px solid; border-right: #4c4c4c 1px solid">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="1">
                                        <tr>
                                            <td>
                                                <table width="429" border="0" cellpadding="5" cellspacing="1" bgcolor="#bbbbbb">
                                                    <tr>
                                                        <td bgcolor="#E9E9F8"><strong>Listen </strong></td>
                                                        <td bgcolor="#E9E9F8"><strong>Joke </strong></td>
                                                        <td bgcolor="#E9E9F8"><strong>Get It</strong></td>
                                                        <td align="center" bgcolor="#E9E9F8"><strong>Send
                                                        <br />
                                                        to Phone</strong></td>
                                                        <td bgcolor="#E9E9F8"><strong>Share</strong></td>
                                                    </tr>
                                                    
                                                <?php
                                                    $color = 2;
                                                    for($i=0;$i<=count($freeSongs)-1;$i++):
                                                        if($color%2==0){
                                                            $rowColor = '#F8F8F8';
                                                            $audioImage = 'play_btn.gif';
                                                        }else {
                                                            $rowColor = '#ffffff';
                                                            $audioImage = 'play_btn.gif';
                                                        }	
                                                        $color ++;
                                                        //echo $freeSongs[$i]->getId();die;
                                                ?>
                                                    <tr bgcolor="<?php echo $rowColor;?>" valign='top'>
                                                        <td align="center">
                                                            <a title="Play" href='javascript:void();' onClick="openPlayer('<?php echo $freeSongs[$i]['id'];?>','')">
                                                                <img border="0" align="absmiddle" src="/img/images/<?php echo $audioImage?>">
                                                            </a>                                    
                                                        </td>
                                                        <td align="left">
                                                            <a href='javascript:void' onClick="openPlayer('<?php echo $freeSongs[$i]['id'];?>','')"><?php echo $freeSongs[$i]['composition'];?></a>
                                                            <br>
                                    <?
                                        if ($songRating[$i]['points'][0] != 0){
                                            for ($k = 0; $k < $songRating[$i]['points'][0]; $k++){
                                                echo '<img src="/img/images/star.gif">';
                                            }
                                        ?>
                                        	<a href="javascript:void();" onclick = "openWindow('ratings/add/<?php echo $freeSongs[$i]['id'];?>','');">Vote</a>
                                        <?php     
                                                echo "<br> Auditions: " . $freeSongs[$i]['view'];
                                        }else
                                        {
                                            echo '<img src="/img/images/00star.gif">';
                                        ?>
                                            <br>
                                            <a href="javascript:void();" onclick = "openWindow('/ratings/add/<?php echo $freeSongs[$i]['id'];?>','');">Be the first one to rate this joke</a>
                                        <?
                                        }
                                    ?>
                                    
                                                        </td>
                                                        <td align='left'>
                                                        <table border="0" cellpadding="0" cellspacing="0">
                                                            <tr valign='top'>
                                                                <td align='right'>
                                                                    <img border="0" align="absmiddle" src="/img/images/free_btn.gif">
                                                                </td>
                                                                <td align='left'>
                                                                    <a title="Download on PC" href='/users/index/download/<?php echo $freeSongs[$i]['path']. "," . $freeSongs[$i]['id'] . ",free"?>'>
                                                                        <img border="0" align="absmiddle" src="/img/images/download_btn.gif">
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </table>                                    
                                                        </td>
                                                        <td align="center">
                                                            <a title="Download on phone" href='/users/send/form/<?php echo $freeSongs[$i]['id']?>'>
                                                                <img border="0" align="absmiddle" src="/img/images/mobile_icon.gif">
                                                            </a>                                
                                                        </td>
                                                        <td align="center">
                                                            <a title="Send To Friends" href='/tellafriends/add/<?php echo $freeSongs[$i]['id']?>'>
                                                                <img border="0" align="absmiddle" src="/img/images/share_icon.gif">
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    endfor;
                                                ?>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                                </td>
                            </tr>
                            <!-- Paid Audio Joke Section -->
                            <tr>
                                <td>
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td colspan="2">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
                                                        <td class="navwhitetext">Premium Audio Jokes</td>
                                                        <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" >
                                        <tr>
                                                <th>Preview</th>
                                                <th width="200">Joke</th>
                                                <th>Duration</th>
                                                <th>Type</th>
                                                <th>Price</th>
                                                <th align='right'><input type="checkbox"
                                                        onClick="javascript:for(i=0;i<this.form.elements.length;
                                                        i++)
                                                        if((this.form.elements[i].type==
                                                        'checkbox')&&(this.form.elements[i].name.indexOf('box2_')==0))
                                                        this.form.elements[i].checked=this.checked;"></th>
                                        </tr>
                                        <?php
                                            $color = 2;
                                            $paidCount = 0;
                                            $rateCounter = $i;

                                            if (count($paidSongs) > 0 ){
                                            for ($i = 0; $i <= count($paidSongs) - 1; $i++) {
                                                    if ($color % 2 == 0) {
                                                            $rowColor = '#F8F8F8';
                                                            $audioImage = 'play_btn.gif';
                                                    } else {
                                                            $rowColor = '#FFFFFF';
                                                            $audioImage = 'play_btn.gif';
                                                    }
                                                    $color++;
                                                    ?>
                                            <tr bgcolor="<?=$rowColor?>" valign='top' id="<?php echo $counter;?>"
                    onmouseover="Javascript: void roll_over('<?php echo $rowColor;?>', this.id);"
                    onmouseout="javascript: void roll_over_restore('<?php echo $rowColor;?>', this.id);">
                                                    <td><!-- Here is the audio player --> 
                                                        
                                                        <a href="javascript:openPlayer('<?=$paidSongs[$i]['id'];?>', '')">
                                                                <img border="0" align="absmiddle" src="/img/images/<?php echo $audioImage ?>">
                                                        </a>&nbsp;&nbsp;
                                                    </td>
                                                    <td><?php echo $paidSongs[$i]['composition']?><br>
                                                    <?
                                                    if ($songRating[$rateCounter]['points'][0] != 0) {
                                                            for ($k = 0; $k < $songRating[$rateCounter]['points'][0]; $k++) {
                                                                    echo '<img src="/img/images/star.gif">';
                                                            }
                                                            echo " Votes : " . $songRating[$rateCounter]['vote'][0];
                                                    } else {
                                                            echo '<img src="/img/images/00star.gif">';
                                                            ?> <br>
                                                    <a href="#"
                                                            onclick="openWindow('/ratings/add/<?=$paidSongs[$i]['id']?>');">Be
                                                    the first one to rate this joke</a> <?																								
                                                    }
                                                    echo "<br>Auditions : " . $paidSongs[$i]['view'];
                                                    ?></td>
                                                    <td><?php echo $paidSongs[$i]['duration']?></td>
                                                    <td><?php echo $paidSongs[$i]['type']?></td>
                                                    <td>
                                                    <table width="100%">
                                                            <tr>
                                                                    <td align="left"><nobr>PC:</td>
                                                                    <td align="right">$<?php echo $paidSongs[$i]['rate']?></nobr></td>
                                                            </tr>
                                                            <tr>
                                                                    <td align="left"><nobr>PC+Phone:</td>
                                                                    <td align="right">$<?php echo $paidSongs[$i]['ratepc']?></nobr></td>
                                                            </tr>
                                                    </table>
                                                    </td>

                                                    <td align='right' style="text-align: right;"><nobr>PC: <img src="/img/cart.gif"
                                                            width="20px"> <input type="checkbox" name="box_[]"
                                                            value="<?php echo $paidSongs[$i]['id']; ?>"></nobr><br>
                                                    <nobr>PC+Phone:<img src="/img/cart.gif" width="20px"> <input
                                                            type="checkbox" name="box2_[]"
                                                            value="<?php echo $paidSongs[$i]['id']; ?>"></nobr></td>
                                            </tr>
                                            <?
                                            $rateCounter++;
                                            $paidCount++;
                                            $counter++;
                                            }
                                            ?>
                                                <tr>
                                                    <td colspan="6">
                                                        <div class="pagination">
                                                            <?php echo $paginator_p->create_links( $base_url, $extraParam );?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                            
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table width='100%'>
                                        <tr>
                                            <td align="left"><input type="button" class="submit_btn" value="Back" onclick="javascript: void history.go(-1);"></td>
                                            <td style="text-align: right;" align="right"><input type="submit" value="Add to Cart" class="submit_btn"></td>
                                        </tr>
                                    </table>
                                </td>
                                
                            </tr>
                            </form>
                            <!-- Paid Audio Joke Section -->
                            <!-- Audio Joke Section -->
                            
                        </table>
                        
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            &nbsp;
        </td>
    </tr>
    
</table>
<script>
function chkForm()
{
    var t =0;
    for (var i = 0; i < document.frm1.elements.length; i++)
    {
        if (document.frm1.elements[i].type == 'checkbox' && document.frm1.elements[i].name == 'box_[]' && document.frm1.elements[i].checked)
        {
            t++;
        }
    }
    
    for (var i = 0; i < document.frm1.elements.length; i++)
    {
        if (document.frm1.elements[i].type == 'checkbox' && document.frm1.elements[i].name == 'box2_[]' && document.frm1.elements[i].checked)
        {
            t++;
        }
    }

    if (t == 0)
    {
        alert ('Please select a joke to purchase.');
        return false;
    }
}


</script>
<?php $view['slots']->stop() ?>