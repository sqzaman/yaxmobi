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
            <form name="frm1" id ="frm1" method="post" action="/yaxgift/apply_redeem">
                <table width="100%" border="0" align="center">
                    <?
                    if ( isset($errMessage) && $errMessage  != '') {
                        echo "<tr>
                                                <td colspan=2 class='error'>" . $errMessage . "</td>
                                        </tr>";
                    }
                    ?>    
                    <tr>
                        <td colspan=2 >Please, fill in this form and insert your yaxgift certificate</td>
                    </tr>
                    <?
                    if ($displayName) {
                        echo "<tr><td></td><td><input type='hidden' name='login' value='$displayName'></td></tr>";
                    } else {
                        ?>
                        <tr>
                            <td align="right">Your login in yaxmobi</td>
                            <td><input type="text" name='login'></td></tr></td>
                        </tr>
    <?
}
?>                   
                    <tr>
                        <td align="right">Certificate</td>
                        <td>
                            <textarea name="code"  cols="50" rows="10"></textarea> 
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="left"><input type="submit" value="Enter Sertificat"></td>

                    </tr>
                </table>
            </form>
        </td>
</table>
<?php $view['slots']->stop() ?>