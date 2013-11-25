<?php $view->extend('YxBundle:layout:base.html.php') ?>

<?php $view['slots']->start('body') ?>

<table border="0" cellspacing="0" cellpadding="0" class="container">
    <tr>
        <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
        <td class="navwhitetext">YaxGifts</td>
        <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
    </tr>
    <tr>
        <td colspan="3">
            <OBJECT id="slideshow" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" WIDTH="429" HEIGHT="144"  id="homeBanner" align="middle"> 
                <PARAM NAME=movie VALUE="/flash/yaxmobi_yaxgift.swf">
                <PARAM NAME=quality VALUE=high> 
                <PARAM NAME=allowScriptAccess VALUE=sameDomain> 
                <EMBED Name="slideshow" src="/flash/yaxmobi_yaxgift.swf" quality=high WIDTH="429" HEIGHT="144" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED>
            </OBJECT>
        </td>
    <tr>
        <td colspan="3" align="center" width="100%">
            <h2>Be a great friend: give the gift of laughter with Yaxmobi gift certificates!</h2>
            <table width="100%" border="0" align="center">
                <tr align='center'>
                    <td valign="bottom"> 
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post">

                            <input type="hidden" name="cmd" value="_oe-gift-certificate">

                            <input type="hidden" name="business" value="marlonjean72@yahoo.com">

                            <input type="hidden" name="no_shipping" value="0">

                            <input type="hidden" name="no_note" value="1">

                            <input type="hidden" name="currency_code" value="USD">

                            <input type="hidden" name="bn" value="PP-GiftCertBF">

                            <input type="hidden" name="min_denom" value="5.00">

                            <input type="hidden" name="max_denom" value="1000.00">

                            <input type="hidden" name="style_color" value="ORG">

                            <input type="hidden" name="shopping_url" value="http://yaxmobi.com/">

                            <input type="hidden" name="image_url" value="http://yaxmobi.com/img/sitelogo2.gif">

                            <input type="hidden" name="cancel_return" id="cancel_return" value='http://yaxmobi.com/users/cancelled'>

                            <input type="hidden" name="return" id="return" value='http://yaxmobi.com/users/mybalance'>

                            <input type="hidden" name="notify_url" value="http://yaxmobi.com/yaxgift/success">

                            <input type="hidden" name="rm" id="rm" value='2'>

                            <input type="image" height="47px" src="/img/paypal_img.png" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">

                            <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">

                        </form>
                    </td>
                    <td>
                        <?
                        if (!$loggedIn)
                            print "<form name='Donation' id='Donation' action='https://www.paypal.com/cgi-bin/webscr' method='POST'>";
                        else
                            print "<form name='Donation' id='Donation' action='/users/login' method='POST'>";
                        ?>

                        <table>
                            <tr><td align="center" valign="bottom">
                                    Please enter your certificate amount ($ US)
                                    <input type=hidden name=item_number id=item_number value='<?= mt_rand(); ?>'>
                                    <input type=hidden name=business id=business value='marlonjean72@yahoo.com'>
                                    <input type=hidden name=no_note id=no_note value='1'>
                                    <input type=hidden name='cmd' id='cmd' value='_xclick'>
                                    <input type=hidden name=currency_code id=currency_code value='USD'>
                                    <input type=hidden name=item_name id=item_name value='Redeem Gift Certificate'>
                                    <input type="hidden" name="cpp_header_image" value="http://yaxmobi.com/img/sitelogo.gif">
                                    <input type="hidden" name="cpp_headerback_color" value="#9090CB"> 
                                    <input type="hidden" name="style_color" value="ORG">
                                    <input name=amount id=amount size="7"  onKeyDown="nowval0=this.value;" onKeyUp="reg=/^([0-9]|\.|\,){0,10}$/;if(reg.test(this.value)==false){if(reg.test(nowval0)==false){this.value='';}else{this.value=nowval0;}}">
                                    <input type=hidden name=cancel_return id=cancel_return value='http://yaxmobi.com/users/cancelled'>
                                    <input type=hidden name=no_shipping id=amount value='1'>
                                    <input type="hidden" name="return" id="return" value='http://yaxmobi.com/users/mybalance'>
                                </td></tr>
                            <tr><td align="center">
                                    <input type="image" src="/img/clip_image002.gif" border="0" name="submit" alt="Redeem your sertificat">
                                    <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                </td></tr>
                        </table>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
            </table>
            <br />
            <h2>How to redeem your gift certificate:</h2> 

            <p><b>Step 1: </b>Register for your free Yaxmobi user account.  If you are new to the site, <a href="/users/register" class="pagelink">click here</a> to  register.</p>

            <p><b>Step 2: </b> Browse our large library of funny audio jokes or service you want to purchase with your gift certificate. </p>

            <p><b>Step 3: </b>During checkout, select PayPal as your payment option and log in to your account. If you do not have a PayPal account, <a href="https://www.paypal.com/us/cgi-bin/?cmd=_registration-run" class="pagelink">click here</a> to sign up now.</p>

            <p><b>Step 4: </b> When prompted, enter your redemption code and follow the last steps to redeem your gift certificate. </p>

            <p><b>Step 5:</b> Laugh! </p>
        </td>
    </tr>
</table>
<?php $view['slots']->stop() ?>