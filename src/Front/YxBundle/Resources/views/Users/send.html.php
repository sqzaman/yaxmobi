<?php $view->extend('YxBundle:layout:base.html.php') ?>

<?php $view['slots']->start('body') ?>

<table border="0" cellspacing="0" cellpadding="0" class="container">
    <tr>
        <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
        <td class="navwhitetext">Recent Downloads</td>
        <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
    </tr>
    
    <?php 
        if ( $via_myxer_Code ):
            echo '<tr style="border-right: 1px solid;border-right-color: #FF9C12;border-bottom: 1px solid; border-bottom-color: #FF9C12;"> <td colspan="3">'. $message .'</td></tr>';
            
        else:
        
    ?>
    
    
    
    
    <tr>
        <td colspan="3" align="center" width="100%">
            
            <!-- Test message -->
            <b><?php echo $message?></b>
            <?php if($char == null) { ?>
            <br><br>
            <? echo '<a href="/users/myprofile">My Profile</a>';
                }
            ?> 
            <!-- end Test message --> 
            
            <!-- File info -->
            <?php if( ($char == 'form') && (isset($freeSongs) > 0) ) { ?>
            <table width="100%" border="0" align="center">
                <tr>
                    <th width="200">Joke</th>
                    <th>Category</th>
                    <th>Duration</th>
                    <th>Date</th>
                    <th>Price</th>
                    <th>Listen</th>								
                </tr>
                <?
                    $color = 2;
                    for( $i=0; $i <= count($freeSongs)-1; $i++ ){
                        if($color%2==0)
                            $rowColor = 'tr1';
                        else $rowColor = '';
                            $color ++;
                ?>
                <tr class="<?php echo $rowColor?>" valign='top'>
                    <td width='350'>
                        <?php echo $freeSongs[$i]['composition'];?>
                        <br>
                    </td>
                    <td>
                        <?php echo $freeSongs[$i]['gname']?>
                    </td>
                    <td>
                        <?php echo $freeSongs[$i]['duration']?>
                    </td>
                    <td nowrap>
                        <?php
                            $date = $freeSongs[$i]['year'];
                            echo date("d M, Y", strtotime($date));
                        ?>
                    </td>
                    <td>
                        <?php 
                            if($freeSongs[$i]['paid'] == 'Y') 
                                echo '$'.$freeSongs[$i]['rate'];
                            else 
                                print 'Free!'; 
                        ?>
                    </td>
                    <td>
                        <a href='javascript:void' onclick="openPlayer('<?php echo $freeSongs[$i]['id'];?>', 'pending')">
                            <img border="0" align="absmiddle" src="/img/images/play_btn.gif">
                        </a>&nbsp;&nbsp;
                    </td>								
                </tr>

                <?
                    }
                    
                    if( count($freeSongs) == 0 ){
                ?>
                    <tr>
                        <td colspan='6' align='center'>No Record Found !!!!</td>
                    </tr>
                <?
                    }
		?>	
                </table>
						
						
                <form action="/users/send/result/<?php echo $file_id; ?>" method="post">		
                <input type="hidden" name=typ value="<?php if ($freeSongs[0]['paid'] == 'Y') print 'pj'; else print 'fj';?>">
                <input type="hidden" name="file[path]" value="<?php echo $file_path?>">
                
                <?php 
                    if ($message == '') {
                ?>
                <table border=0 align=center width='100%' cellspacing='3' cellpadding='3'>
                    <tr>
                        <td></td>
                        <td align=left>
                            <ul>
                                <li>Requires a data plan with cell phone carrier.  Please check that WAP service is enabled for your mobile phone.  If not enabled, contact your cell phone company.</li>
                                <li>Note:</b> in order to avoid item expiration, please download file on cell phone within 1 hour of receipt of text message link.</li>
                            </ul>
                        </td>
                    </tr>					
                    <tr>
                        <td align=right>Mobilephone</td>
                        <td align=left>
                            <input type="text" name="user[mobilephone]" class="input" value="<?php echo $users[0]->getMobilephone();?>">
                            <br>
                            NO Dashes - Example: 5551234567
                        </td>
                    </tr>
                    <tr>
                        <td align=right>Carrier</td>
                        <td align=left>
                            <select name="user[carrier]">
                            <?php
                                if ( $carriers):
                                    foreach ( $carriers as $val ):
                                        if ( $val->getCarriername() != '' ):
                                            $sel = $users[0]->getCarrier() == $val->getId() ? ' Selected ' : ''; 
                                            echo '<option '. $sel .' value="'. $val->getId() .'">'. $val->getCarriername().'</option>';
                                        endif;
                                    endforeach;
                                endif;
                            ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td align='left'>
                            <input type="submit" value="Submit" class="submit_btn">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="left">
                            <input type="button" class="submit_btn" value="Back" onclick="javascript: void history.go(-1);">
                        </td>
                    </tr>
                </table>
            <?php 
                } else {
            ?>
                <br><br>
                <b><?php print $message; ?></b>						
            <?php 
                } 
            ?>  
            </form>	
			       
        <?php 
            } else if (isset($message)&&($char == 'form')) 
            print $message; 
        ?>
            
        <?php if(($char == 'form') && (isset($freering) > 0) ) { ?>
        <table class='tableHeading' width='100%'>
            <tr>
                <th width="200">Title</th>	
		<th width="200"> Listen</th>			
            </tr>
            <?
                $color = 2;
		for($i=0;$i<=count($freering)-1;$i++){
                    if($color%2==0)
                        $rowColor = 'tr1';
                    else 
                        $rowColor = '';
                    $color ++;
            ?>
            <tr class="<?=$rowColor?>" valign='top'>
                <td width='350'>
                    <?php echo $freering[$i]['title'];?>
                    <br>							
                </td>								
		<td>
                    <?
                        if ($freering[$i]['prew_ringtone']!=''){
                    ?>
                            <a href='javascript:void' onclick="openPlayer('<?php echo $freering[$i]['id'];?>', 'ring')">
                                <img border="0" align="absmiddle" src="/img/images/play_btn.gif">
                            </a>&nbsp;&nbsp;
                    <?
                        }
                    ?>
                </td>								
            </tr>
            <?
                }
		if(count($freering)==0){
            ?>
                <tr><td colspan='6' align='center'>No Record Found !!!!</td></tr>
            <?
                }
            ?>	
            </table>
						
						
            <form action="/users/send/result/<?php echo $file_id;?>" method="post">	
            <input type="hidden" name=typ value="pr">
            <input type="hidden" name="file[path]" value="<?php echo $file_path;?>">
            
            <?php if ($message == '') {?>
            <table border=0 align=center width='100%' cellspacing='3' cellpadding='3'>					
                <tr>
                    <td align=right>Mobilephone</td>
                    <td align=left>
                        <input type="text" name="user[mobilephone]" value="<?php echo $users[0]->getMobilephone();?>" class="input">
                    </td>
                </tr>
                <tr>
                    <td align=right>Carrier</td>
                    <td align=left>
                        <select name="user[carrier]">
                        <?php
                            if ( $carriers):
                                foreach ( $carriers as $val ):
                                    if ( $val->getCarriername() != '' ):
                                        $sel = $users[0]->getCarrier() == $val->getId() ? ' Selected ' : ''; 
                                        echo '<option '. $sel .' value="'. $val->getId() .'">'. $val->getCarriername().'</option>';
                                    endif;
                                endforeach;
                            endif;
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align='left'>
                        <input type="submit" class="submit_btn" value="Submit">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td align="left">
                        <input type="button" class="submit_btn" value="Back" onclick="javascript: void history.go(-1);">
                    </td>
                </tr>
            </table>
            <?php 
            } else {
            ?>
                <br><br>
                <b><?php print $message; ?></b>						
            <?php } ?>  
            </form>	
			       
            <?php } else if (isset($message) && (isset($types)) ) 
                    print $message; 
            ?> 
            
        </td>
    </tr>
    <?php
        endif;
    ?>
</table>
<?php $view['slots']->stop() ?>