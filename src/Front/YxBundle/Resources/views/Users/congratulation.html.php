<?php $view->extend('YxBundle:layout:base.html.php') ?>

<?php $view['slots']->start('body') ?>

<table border="0" cellspacing="0" cellpadding="0" class="container">
    <tr>
        <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
        <td class="navwhitetext">Congratulation</td>
        <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
    </tr>
    <tr>
        <td colspan="3">
            <h2>Registration Information</h2>
        </td>
    </tr>
    <tr>
        <td colspan="3" align="center" width="100%">
            <p>Thank You for Registering</p>
            <p>Please check your email to validate your registration.</p>
        </td>
    </tr>
</table>
<?php $view['slots']->stop() ?>