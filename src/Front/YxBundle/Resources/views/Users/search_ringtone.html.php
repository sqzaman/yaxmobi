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
                                                                                echo $ringtones[$i]['id'] . ' > ';
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
											?>  <object
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
                                                        <?php echo $paginator_r->create_links( $base_url, $extraParam );?>
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