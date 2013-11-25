<table border='0'>
    <tr>
        <td valign="bottom" align='center'>
            <?
            if ($width == 'reduced') {
                $style = "overflow:hidden; 
	margin-top:-2px;
	margin-left:-2px;
	height:25px; 
	width:427px;
	font-weight:bold;
	background-color:#F7F719;
	color:#5d5da1;";
                ?>
                <DIV ID="TICKER" style='<?php echo $style; ?>'>
                    <?
                } else {
                    $style = "overflow:hidden; 
	margin-top:-2px;
	height:20px; 
	width:800px;
	font-weight:bold; 
	#background-color:#F7F719;
	color:#5d5da1;";
                    ?>
                    <DIV ID="TICKER" style='<?php echo $style; ?>'>
                    <?
                }
                ?>
                    <?php echo $tickerItem; ?>
                </DIV>
                <script type="text/javascript" src="/js/ticker/webticker_lib.js" language="javascript"></script>
        </td>
    </tr>
</table>