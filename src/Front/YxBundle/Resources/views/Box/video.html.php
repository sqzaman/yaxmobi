<table width="428" border="0" cellpadding="0" cellspacing="0">
                                <!-- All Tab Section -->
		<tr>
			<td width="418" colspan="2" align="left">
			<table border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="1"><img src="/img/images/t01d.gif" border="0" width="5" height="28" />					</td>
					<td width="10" style="background-image: url(/img/images/t02d.gif); background-repeat: repeat-x;">
						<a href="/tabs/index/"  class="navgraylink change-tab" id="link1001890292" >Audio&nbsp;Jokes</a></td>
					<td width="1"><img src="/img/images/t03d.gif" border="0" width="6" height="28" />					</td>
					<td width="2">&nbsp;</td>
					<td width="1"><img src="/img/images/t01d.gif" border="0" width="6" height="28" />					</td>
					<td width="10" style="background-image: url(/img/images/t02d.gif); background-repeat: repeat-x;">
						<a href="/tabs/ringtone/"  class="navgraylink change-tab" id="link175492473">Ringtones</a>
                                        </td>
					<td width="1"><img src="/img/images/t03d.gif" border="0" width="6" height="28" />					</td>
					<td width="2">&nbsp;</td>
					<td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" />					</td>
					<td width="10" style="background-image: url(/img/images/t02.gif); background-repeat: repeat-x;">
						<a href="/tabs/video/"  class="navwhitelink change-tab" id="link32783323" >Videos</a></td>
					<td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" />					</td>
                                        <td width="2">&nbsp;</td>
                                        <td width="1"><img src="/img/images/t01d.gif" border="0" width="5" height="28" />					</td>
                                        <td width="10" style="background-image: url(/img/images/t02d.gif); background-repeat: repeat-x;">
						<a href="/tabs/cartoons/"  class="navgraylink change-tab" id="link32783323" >Cartoons</a></td>
					<td width="1"><img src="/img/images/t03d.gif" border="0" width="6" height="28" />					</td>
                                        <td width="2">&nbsp;</td>
                                        <td width="1"><img src="/img/images/t01d.gif" border="0" width="5" height="28" />					</td>
                                        <td width="10" style="background-image: url(/img/images/t02d.gif); background-repeat: repeat-x;">
						<a href="/tabs/yomama/"  class="navgraylink change-tab" id="link32783323" >Yomama</a></td>
					<td width="1"><img src="/img/images/t03d.gif" border="0" width="6" height="28" />					</td>
				</tr>
			</table>
			</td>
		</tr>
		<!-- All Tab Section -->
                <!-- Audio Joke -->
		<tr>
			<td colspan="2" align="center" style="border: #4c4c4c 1px solid;" bgcolor='#bcbcee'>
                            <table width="100%" border="0" cellspacing="0" cellpadding="2">
				<tr>
					<td align="right">
                                            <a class="next-tab" href="<?php echo $prevPage;?>">
                                                <img src="/img/images/prev.gif" border="0" width="12" height="54" />
                                            </a>
					</td>
					<td width="1">
					<table width="96%" border="0" cellspacing="0" cellpadding="8" bgcolor="#d6d2d2">
						<tr>
						<?php
						for($i=0;$i<=count($video)-1;$i++)
						{
							?>
							<td align="center">
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td>
									<table border="0" cellpadding="5" cellspacing="1"
										bgcolor="#CCCCCC">
										<tr>
											<td bgcolor="#eeeeee">
												<?php
													$video[$i]['image'] != '' ? $image = 'video/image/' . $video[$i]['image'] : $image = 'images/blondes.gif'; 
                                                                                                        echo '<a class="pagelink" href="#"><img src="/img/'.$image.'" border="0" width="65" height="65" /></a>';
												?>
												
											</td>
										</tr>

									</table>
									</td>
								</tr>
								<tr>
									<td align="center">
                                                                            
										<b><?php echo '<a class="pagelink" href="#">'.$video[$i]['title'].'</a>';?></b>
									</td>
								</tr>
							</table>
							</td>
							<?php
							if (($i+1) % 4 == 0)
							echo "</tr><tr>";
						}
						?>
						</tr>
					</table>
					</td>
					<td>
                                            <a class="next-tab" href="<?php echo $nextPage;?>">
                                                <img src="/img/images/next.gif" border="0" width="12" height="54" />
                                            </a>
					</td>
				</tr>
			</table>
			</td>
		</tr>
		<!-- Audio Joke -->
                
                            </table>