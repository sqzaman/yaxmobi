<?php $view->extend('YxBundle:layout:admin_base.html.php') ?>

<?php $view['slots']->start('body') ?>
<form action="" method="post">
    <table border="0" width="100%" cellspacing="2" cellpadding="2">
        <tbody>
            <tr>
                <td align="left">
                    <table width="100%" border="0" cellpadding="2" cellspacing="2">
                        <tr>
                            <td align="right">Username: </td>
                            <td align="left">
                                <input type="text" name="username" value="" />
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Password: </td>
                            <td align="left">
                                <input type="password" name="password" value="" />
                            </td>
                        </tr>
                        <tr>
                            <td align="right"></td>
                            <td align="center">
                                <input type="submit" name="Login" value="Login" />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</form>

<?php $view['slots']->stop() ?>