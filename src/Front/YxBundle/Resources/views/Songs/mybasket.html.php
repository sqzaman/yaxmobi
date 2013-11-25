<?php $view->extend('YxBundle:layout:base.html.php') ?>

<?php $view['slots']->start('body') ?>
<script type="text/javascript" src="/js/js_files/home.js"></script>
<table border="0" cellpadding="0" cellspacing="0" class="container">
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
                    <td class="navwhitetext">My Basket</td>
                    <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <?php echo $view->render('YxBundle:Box:index_search.html.php'); 
            
                //echo $this->renderElement('cart_searchbox')
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <?
                if(isset($errMessage) && $errMessage != ''){
                    echo "<div class='error'>";
                    echo $errMessage;
                    echo "</div>";
                }
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <form name="frm1" id="frm1" method="post" action="/songs/buy">
                <input type="hidden" name="client_info" value="" /> 
                <table bgcolor="#bbbbbb" width="100%" border="0">
                    <tr>
                        <td>
                            <table bgcolor="#fff" cellspacing="1" cellpadding="3" width='100%'>
                            <?php if(count($userCartItems)>0){ ?>
                                <tr>
                                    <th>Preview</th>
                                    <th width="200">Joke</th>
                                    <th>Category</th>
                                    <th>Duration</th>
                                    <th>Type</th>
                                    <th style="font-size: 8"><nobr>Buy For:</nobr><br>
                                        <sub>PC<br>
                                        PC+Phone</sub></th>
                                    <th align='right'><nobr>PC 
                                        <input type="checkbox" onClick="javascript:for(i=0;i<this.form.elements.length; i++)
                                                                        if((this.form.elements[i].type==
									'checkbox')&&(this.form.elements[i].name.indexOf('boxpcp_')==0))
									this.form.elements[i].checked=this.checked;recountbasket();"> 
                                    </nobr>
                                    <br>
                                    <nobr>
                                        PC+Phone 
                                            <input type="checkbox" onClick="javascript:for(i=0;i<this.form.elements.length; i++)
                                                                        if((this.form.elements[i].type==
									'checkbox')&&(this.form.elements[i].name.indexOf('boxpc_')==0))
									this.form.elements[i].checked=this.checked;recountbasket();">
                                    </nobr>
                                    </th>
                                </tr>
                                <?
                                    $color = 2;
                                    $basketprice=0;
                                    $counter = 1;

                                    foreach($userCartItems as $song){
                                        //pr($song);
					if ($song['type_upl']==1)
                                            $basketprice	= $basketprice + $song['rate'];
                                        if ($song['type_upl']==2)
                                            $basketprice	= $basketprice + $song['ratepc'];
									
					if($color%2==0){
                                            $rowColor = '#F8F8F8';
                                        }else{
                                            $rowColor = '#ffffff';
                                        }
                                        $color ++;
                                    ?>
                                    <tr bgcolor="<?php echo $rowColor?>" valign='top' id="<?php echo $counter;?>"
								onmouseover="Javascript: void roll_over('<?php echo $rowColor;?>', this.id);"
								onmouseout="javascript: void roll_over_restore('<?php echo $rowColor;?>', this.id);">
                                        <td>
                                            <a href="javascript:openPlayer('<?php echo $song['id'];?>', 'sample_file')">
                                                <img src="/img/images/play_btn.gif" border="0" align="absmiddle" />
                                            </a>&nbsp;&nbsp;
                                        </td>
					<td><?php echo $song['composition']?> </td>
					<td><?php echo $song['gname']?></td>
					<td><?php echo $song['duration']?></td>
					<td><?php echo $song['type']?></td>
					<td>$<?php echo $song['rate']?><br>
					$<?php echo $song['ratepc']?></td>

					<td align='right' valign='top'>
                                            <table>
                                                <tr>
                                                    <td valign='top' align="right">
                                                        <nobr>PC <input type="checkbox"
                                                                    name="boxpcp_[]"
                                                                    value="<?php echo $song['cart_id']; ?>"
                                                                    <?if ($song['type_upl']==1) echo 'checked';?>
                                                                    onClick="javascript: recountbasket();"></nobr> 
                                                        <nobr>PC+Phone<input
                                                            type="checkbox" name="boxpc_[]"
                                                            value="<?php echo $song['cart_id']; ?>"
                                                            <?if ($song['type_upl']==2) echo 'checked';?>
                                                            onClick="javascript: recountbasket();"></nobr> <input
                                                                type=hidden id="boxpcp_<?php echo $song['cart_id']?>"
                                                                value="<?php echo $song['rate']?>"> 
                                                            <input type=hidden
                                                                id="boxpc_<?php echo $song['cart_id']?>"
                                                                value="<?php echo $song['ratepc']?>">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
					<?
                                            $counter++;
                                        }
					?>
					<tr>
                                            <td colspan='7' align='right' valign='top' bgcolor="#FFFFFF">
                                                <table border='0'>
                                                    <tr>
                                                        <td align="right">
                                                            <div id="basket_price">Basket Price : $ <b><?php echo $basketprice?></b></div>
                                                        </td>
							<td valign=top>&nbsp;&nbsp;&nbsp;&nbsp; 
                                                            <input type="submit"
                                                                class="submit_btn" value="Buy Item(s)"
								onClick="Javascript: var istrue = false; for(i=0;i<this.form.elements.length;i++) {
                                                                                    if(this.form.elements[i].type=='checkbox')if (this.form.elements[i].checked==true)
											{istrue=true;}} if (!istrue) return false; 
                                                                                        else {this.form.client_info.value=netobj.GetSystemInfo();this.form.action='/songs/buy'; }">
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="right">Available Balance : $ <b><?= number_format($userBalance, 2, ".", " ");?></b></td>
                                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" class="submit_btn" value="Remove" onClick="Javascript: this.form.action='/songs/basketdelete';"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan='2'><a href="#" onclick="javascript:window.open('https://www.paypal.com/us/cgi-bin/webscr?cmd=xpt/cps/popup/OLCWhatIsPayPal-outside','olcwhatispaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=400, height=350');">
                                                                    <img src="https://www.paypal.com/en_US/i/bnr/horizontal_solution_PPeCheck.gif" border="0" alt="Solution Graphics"></a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>

                                        <?php
                                        }else{
                                        ?>
                                            <tr>
                                                    <td colspan='3' align='center'>No Record Found !!!!</td>
                                            </tr>
                                        <?
                                            }
                                        ?>
                                    </table>
                                </td>
                            </tr>
                        </table>
            </form>
        </td>
    </tr>
</table>
<script> 
function recountbasket(){
	var sum = 0;
	obj = document.getElementsByName("boxpcp_[]");
	objp = document.getElementsByName("boxpc_[]");
	for (var i = 0;i < obj.length; i++)
	{
		if (obj.item(i).checked==true && objp.item(i).checked!=true)
		{
			var cur_id = obj.item(i).value;
			var cur_elem = document.getElementById("boxpcp_"+cur_id);
			sum = sum*1 + cur_elem.value*1;
		}
		
		if (objp.item(i).checked==true)
		{
			var cur_id = obj.item(i).value;
			var cur_elem = document.getElementById("boxpc_"+cur_id);
			sum = sum*1 + cur_elem.value*1;
		}
	}
	var cur_elem_price = document.getElementById("basket_price");
	cur_elem_price.innerHTML = "Basket Price : $ <b>"+sum.toFixed(2)+"</b>";
}
</script>
<?php $view['slots']->stop() ?>