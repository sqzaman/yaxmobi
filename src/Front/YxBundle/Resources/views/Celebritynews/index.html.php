<?php $view->extend('YxBundle:layout:base.html.php') ?>

<?php $view['slots']->start('body') ?>

<table border="0" cellspacing="0" cellpadding="0" class="container">
    <tr>
        <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
        <td class="navwhitetext">Entertainment News</td>
        <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
    </tr>
    <tr>
        <td colspan="3" align="center" width="100%">
            <IFRAME  marginWidth=0 marginHeight=0 src="/files/rss_reader.php?count=0" frameBorder=0 width='100%' height='600'  scrolling=yes></IFRAME>
        </td>
    </tr>
</table>
<?php $view['slots']->stop() ?>