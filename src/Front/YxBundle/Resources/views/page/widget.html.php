<?php $view->extend('YxBundle:layout:base.html.php') ?>

<?php $view['slots']->start('body') ?>

<table border="0" cellspacing="0" cellpadding="0" class="container">
    <tr>
        <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
        <td class="navwhitetext">Yaxmobi Widget</td>
        <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
    </tr>
    <tr>
        <td colspan="3" align="center" width="100%" style="background-color: #000000;">
            <br><font color="white">Take the laughter with you by placing the Yaxmobi widget on your site, blog, or social network page.</font>
        </td>
    </tr>
    <tr>
    <td colspan="3" align="center" style="background-color: #000000;">

<!--Include this JavaScript library once in the BODY of your HTML page-->
<script type="text/javascript" src="http://widgets.clearspring.com/launchpad/include.js">
</script>

<!--Put your widget in between the following div tags-->
<div id="PutWidgetHere"><script type="text/javascript" src="http://widgets.clearspring.com/o/48259a63b4a6cee4/482c57350c18ab3f/48259a63b4a6cee4/650e9746/widget.js"></script></div>
<br />
<br />
<!--This script invokes the Button or Menu. Note: the "source" should point to ID of the div that contains your widget-->
<script type="text/javascript">
$Launchpad.ShowMenu({"userId": "47693cc29c4a499a", "widgetName": "YaxMobi Widget", "source": "PutWidgetHere", "customCSS": "http://cdn.clearspring.com/launchpad/skins/black.css"});
</script></td>
	</tr>
</table>
<?php $view['slots']->stop() ?>