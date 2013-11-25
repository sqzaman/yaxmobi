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
            <table width="100%" border="0" align="center">
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<input type="hidden" name="cmd" value="_oe-gift-certificate">
	<input type="hidden" name="business" value="marlonjean72@yahoo.com">
	<input type="hidden" name="no_shipping" value="0">
	<input type="hidden" name="no_note" value="1">
	<input type="hidden" name="currency_code" value="USD">
	<input type="hidden" name="bn" value="PP-GiftCertBF">
	<input type="hidden" name="min_denom" value="5.00">
	<input type="hidden" name="max_denom" value="1000.00">
	<input type="hidden" name="style_theme" value="BB">
	<input type="hidden" name="shopping_url" value="http://yaxmobi.com/">
	<input type="hidden" name="logo_url" value="http://yaxmobi.com/img/sitelogo.gif">
	<input type=hidden name=cancel_return id=cancel_return value='http://yaxmobi.com/users/cancelled'>
	<input type=hidden name=return id=return value='http://yaxmobi.com/yaxgift/success'>
	<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_gift_LG.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
	<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>
	</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
</table>
        </td>
</table>
<?php $view['slots']->stop() ?>