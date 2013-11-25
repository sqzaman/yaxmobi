<?php $view->extend('YxBundle:layout:base.html.php') ?>

<?php $view['slots']->start('body') ?>

<table border="0" cellspacing="0" cellpadding="0" class="container">
    <tr>
        <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
        <td class="navwhitetext">My Balance</td>
        <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
    </tr>
    <tr>
        <td colspan="3" align="center" width="100%">
            <form action="/users/myprofile" method="post">
                <table width="100%" border="0" align="center">
                    <tr>
                        <td align="left" width='90'>Name</td>
                        <td align="left"><b><?php echo $users[0]['firstname'] . ' ' . $users[0]['lastname']; ?></b></td>
                    </tr>
                    <tr>
                        <td align="left">Registration Date</td>
                        <td align="left">
                            <? echo date('Y M d',strtotime($users[0]['created'])); ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="left">Last Modified</td>
                        <td align="left">
                            <? echo date('Y M d',strtotime($users[0]['modified'])); ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="left">Balance</td>
                        <td align="left">                       
                            $ <?=number_format($users[0]['amount'], 2, ".", " "); ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="left"></td>
                        <td align="left">
                            <input type="button" class="submit_btn" value="Fill Balance" onclick="Javascript:location.href='/users/balance'">
                        </td>
                    </tr>
                </table>
            </form>
        </td>
    </tr>
</table>
<?php $view['slots']->stop() ?>