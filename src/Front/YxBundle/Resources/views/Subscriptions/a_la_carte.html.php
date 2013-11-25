<?php $view->extend('YxBundle:layout:base.html.php') ?>

<?php $view['slots']->start('body') ?>

<table border="0" cellspacing="0" cellpadding="0" class="container">
    <tr>
        <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
        <td class="navwhitetext">Subscriptions - <?php echo $planName; ?></td>
        <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
    </tr>
    <tr>
        <td colspan="3" align="center" width="100%">
            <OBJECT id="slideshow"
                    classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
                    codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0"
                    WIDTH="429" HEIGHT="144" align="middle">
                <PARAM NAME=movie VALUE="/flash/yaxmobi_subscription.swf">
                <PARAM NAME=quality VALUE=high>
                <PARAM NAME=allowScriptAccess VALUE=sameDomain>
                <EMBED Name="slideshow" src="/flash/yaxmobi_subscription.swf"
                       quality=high WIDTH="429" HEIGHT="144"
                       TYPE="application/x-shockwave-flash"
                       PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED>
            </OBJECT>
        </td>
    </tr>
    <tr>
        <td colspan="3" align="center" width="100%">
            <table width="100%" border="0" align="center">
                <tr>
                    <td>
                        <table width="100%">
                            <tr>
                                <td width="50%" align="right">
                                    <a class="blue_btn_a back-btn" href="#"><div class="blue_btn">Back</div></a>
                                </td>
                            </tr>
                            <tr>
                                <td style="border: #4c4c4c 1px solid;" bgcolor='#bcbcee'>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="8" bgcolor="#fff">
                                        <tr>
                                            <td>
                                                <p>Don't like recurring payments?</p>
                                                <p>Then A La Carte is right for you!</p>
                                                <p>Once you become a registered user (free registration), simply fund/refill your account and use your available balance to make purchases as you go.  No monthly payments!</p>
                                            </td>
                                        </tr>
                                    </table>	
                                </td>

                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<?php $view['slots']->stop() ?>