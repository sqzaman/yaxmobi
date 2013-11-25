<?php $view->extend('YxBundle:layout:base.html.php') ?>

<?php $view['slots']->start('body') ?>

<table border="0" cellspacing="0" cellpadding="0" class="container">
    <tr>
        <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
        <td class="navwhitetext">Fill Balance</td>
        <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
    </tr>
    <tr>
        <td colspan="3" align="center" width="100%">
            <table width="100%" border="0" align="center">
                <TR>
                    <TD align=left valign=top id='INTRO'><BR><b>Fill Balance:</b><br>
                        Credit your account by using PayPal's secure and reliable payment processor. <br> After refilling your balance, you will be able to continue enjoying access to our huge and hilarious audio jokes archive.

                        <br><br>
                        <hr noshadow style="color:#D39E64;">
                        <h2>Payment by PayPal</h2>
                        <TABLE BORDER=0 cellpadding=0 cellspacing=0>
                            <tr>
                                <td align='left'>
                                    <form action="/users/balance" name="form1" method="post">
                                        <input type="hidden" name="data[useramount][user_id]" value="<?php echo $user_id;?>">
                                        Choose your Amount : 
                                        <br><input type="radio" name="data[useramount][amount]" id="amount_10" value="10">$ 10(1000 Points)&nbsp;&nbsp;
                                        <input type="radio" name="data[useramount][amount]" id="amount_15" value="15">$ 15(1500 Points)<br>
                                        <input type="radio" name="data[useramount][amount]" id="amount_20" value="20">$ 20(2000 Points)&nbsp;&nbsp;
                                        <input type="radio" name="data[useramount][amount]" id="amount_25" value="25">$ 25(2500 Points)<br>
                                        <input type="radio" name="data[useramount][amount]" id="amount_50" value="50">$ 50(5000 Points)&nbsp;&nbsp;
                                        <input type="radio" name="data[useramount][amount]" id="amount_75" value="75">$ 75(7500 Points)<br>
                                        <input type="radio" name="data[useramount][amount]" id="amount_100" value="100">$ 100(10000 Points)
                                        <br><br><br>							
                                        <input type="hidden" name="paynow" value="1">

                                        <b>Refill Balance &nbsp; </b>
                                        <input type="submit" value="Fill Balance" class="submit_btn">
                                    </form>
                                </td>
                                <td width='25'>&nbsp;</td>
                                <td valign='top'>
                                    <img src="/img/PayPal_Verification_Seal.gif">
                                </td>
                            </tr>
                        </table>
                        <img src="/img/pay.gif">
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>
<?php $view['slots']->stop() ?>