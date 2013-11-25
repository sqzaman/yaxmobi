<?php $view->extend('YxBundle:layout:base.html.php') ?>

<?php $view['slots']->start('body') ?>
<script type="text/javascript" src="/js/js_files/home.js"></script>
<table border="0" cellpadding="0" cellspacing="0" class="container">
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
                    <td class="navwhitetext">Purchase</td>
                    <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <p>Thank you for your recent purchase</p>
            <p>Please go to the <a href="/users/index">Recent Downloads</a> page to retrieve your items.</p>
        </td>
    </tr>
</table>

<?php $view['slots']->stop() ?>