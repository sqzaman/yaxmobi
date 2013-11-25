<?php $view->extend('YxBundle:layout:base.html.php') ?>

<?php $view['slots']->start('body') ?>
<script type="text/javascript" src="/js/js_files/home.js"></script>
<table border="0" cellpadding="0" cellspacing="0" class="container">
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
                    <td class="navwhitetext">Preview Joke</td>
                    <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <OBJECT id="slideshow" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" WIDTH="429" HEIGHT="144"  id="homeBanner" align="middle"> 
                <PARAM NAME=movie VALUE="/flash/yaxmobi_audio_joke.swf">
                <PARAM NAME=quality VALUE=high> 
                <PARAM NAME=allowScriptAccess VALUE=sameDomain> 
                <EMBED Name="slideshow" src="/flash/yaxmobi_audio_joke.swf" quality=high WIDTH="429" HEIGHT="144" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED></OBJECT>
        </td>
    </tr>

    <tr>
        <td>
            <form name="frm1" id="frm1" method="post" action="/songs/addtocart" onsubmit="return chkForm();">
                <input type="hidden" name="client_info" value="" /> 
                <table width="100%" border="0" align="center">
                    <tr>
                        <td colspan='6'>
                            <table width="100%" border='0'>
                                <tr>
                                    <td align="left"><a class="blue_btn_a back-btn" href="#"><div class="blue_btn">Back</div></a></td>
                                    <td align="right"><input type="submit" value="Add to Cart" class="submit_btn"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='6'>Please make your selection</td>
                    </tr>
                    <tr>
                        <th>Preview</th>
                        <th width="200">Joke</th>
                        <th>Duration</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th align='right'>
                            <input type="checkbox" onClick="javascript:for(i=0;i<this.form.elements.length;i++)
                                if((this.form.elements[i].type=='checkbox')&&(this.form.elements[i].name.indexOf('box2_')==0))
                                    this.form.elements[i].checked=this.checked;">
                        </th>
                    </tr>
                    <?
                    $color = 2;
                    for ($i = 0; $i <= count($joke) - 1; $i++) {
                        if ($color % 2 == 0) {
                            $rowColor = 'tr1';
                            $colorCode = '#F8F8F8';
                            $audioImage = 'play_btn.gif';
                        } else {
                            $rowColor = '';
                            $colorCode = '#FFFFFF';
                            $audioImage = 'play_btn.gif';
                        }
                        $color++;
                        ?>
                        <tr id="<?php echo $i; ?>" class="<?= $rowColor ?>" valign='top' onmouseover="Javascript: void roll_over('<?php echo $colorCode; ?>', this.id);" onmouseout="javascript: void roll_over_restore('<?php echo $colorCode; ?>', this.id);">
                            <td>
                                <!-- Here is the audio player -->
                                <a  href="javascript:openPlayer('<?php echo $joke[$i]->getId(); ?>', '')">
                                    <img border="0" align="absmiddle" src="/img/images/<?php echo $audioImage ?>">
                                </a>&nbsp;&nbsp;
                            </td>
                            <td >
                                <?php echo $joke[$i]->getComposition(); ?><br>
                                <?
                                if ($songRating[$i]['points'][0] != 0) {
                                    for ($k = 0; $k < $songRating[$i]['points'][0]; $k++) {
                                        echo '<img src="/img/images/star.gif">';
                                    }
                                    echo " Votes : " . $songRating[$i]['vote'][0];
                                } else {
                                    echo '<img src="/img/images/00star.gif">';
                                ?>
                                    <br><a href="#" onclick = "openWindow('<?php echo MY_SITE_URL ?>ratings/add/<?php echo $joke[$i]->getId(); ?>');">Be the first one to rate this joke</a>
                                <?
                                }
                                echo "<br>Auditions : " . $joke[$i]->getView();
                                ?>
                            </td>
                            <td>
                                <?php echo $joke[$i]->getDuration(); ?>
                            </td>
                            <td>
                                <?php echo $joke[$i]->getType(); ?>
                            </td>
                            <td>
                                <table width="100%">
                                    <tr>
                                        <td align="left">
                                        <nobr>PC:</td>
                                            <td align="right"> $<?php echo $joke[$i]->getRate(); ?></nobr>
                                            </td>
                                    </tr>
                                    <tr>
                                        <td align="left"><nobr>PC+Phone:</td>
                                        <td align="right"> $<?php echo $joke[$i]->getRatepc(); ?></nobr></td>
                                    </tr>
                                </table>
                            </td>

                            <td align='right' style="text-align:right;">
                                <nobr>PC: <img src="/img/cart.gif" width="20px">
                                <input type="checkbox" name="box_[]" value="<?php echo $joke[$i]->getId(); ?>"></nobr>
                                <br>
                                <nobr>PC+Phone:<img src="/img/cart.gif" width="20px">
                                <input type="checkbox" name="box2_[]" value="<?php echo $joke[$i]->getId(); ?>"></nobr>
                                <div style="float:right">
                                    <a href="#song-<?php echo $joke[$i]->getId(); ?>" class="add-w-l"><img src="/img/wishlist.gif"></a>
                                </div>
                            </td>
                        </tr>
                        <? 
                        }
                        if (count($joke) == 0) {
                        ?>
                        <tr>
                            <td colspan='6' align='center'>No Record Found !!!!</td>
                        </tr>
                        <?																								
			} else {
			?>	
			<tr>
                            <td colspan='6' align='right' >
                                <table width="100%" border='0'>
                                    <tr>
                                        <td align="left"><a class="blue_btn_a back-btn" href="#"><div class="blue_btn">Back</div></a></td>
                                        <td style="text-align:right;">
                                            <input type="submit" value="Add to Cart" class="submit_btn"> &nbsp;
                                            
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <?	
			}																							
			?>
                        <tr>
                            <td colspan='6'>
                                <div id="tabdiv">
                                <?php echo $view['actions']->render('YxBundle:Tabs:index'); ?>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </td>
        </tr>
</table>
<script>
function chkForm(){
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