<?php $view->extend('YxBundle:layout:base.html.php') ?>

<?php $view['slots']->start('body') ?>

<table border="0" cellspacing="0" cellpadding="0" class="container">
    <tr>
        <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
        <td class="navwhitetext">Cancelled</td>
        <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
    </tr>
    <tr>
        <td colspan="3" align="center" width="100%">
            <table width="100%" border="0" align="center">
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr> 
                    <td align="left" valign="top" bgcolor="#000000"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                                <td align="center" bgcolor="#EEEEEE"> <p>&nbsp;</p>
                                    <p><span style="color:#000000">We're sorry, your transaction has not been processed.</span> </p>
                                    <p>&nbsp;</p></td>
                            </tr>
                        </table></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<?php $view['slots']->stop() ?>