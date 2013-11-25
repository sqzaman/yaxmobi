<?php $view->extend('YxBundle:layout:base.html.php') ?>

<?php $view['slots']->start('body') ?>
<script type="text/javascript" src="/js/js_files/home.js"></script>
<table border="0" cellspacing="0" cellpadding="0" class="container">
    <tr>
        <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
        <td class="navwhitetext">Ringtone</td>
        <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
    </tr>
    <tr>
        <td colspan="3" align="center" width="100%">
            <?php
            if (isset($textansw)) {
                print '<center>' . $textansw . '</center>';
            } else {
            ?>
                <script type="text/javascript" src="http://www.zaptophone.com/resources/zaptophone.js"></script>

                <form name="frm1" id ="frm1" method="post" action="/ringtones/download/">
                    <input type="hidden" name="ringtone_file" value="<?= $file ?>">
                    <input type="hidden" name="ringtone_title" value="<?= $fileTitle ?>">
                    <input type="hidden" name="action" value="download">

                    <table width="100%" border="0" align="center">
                        <tr>
                            <td width='50%'>
                                <?php
                                    if ($downloadSite == '2') {
                                ?>
                                    <table width='100%' style="border-right: 1px solid;border-right-color: #FF9C12;border-bottom: 1px solid; border-bottom-color: #FF9C12;">
                                        <tr>
                                            <td>
                                                To download ringtone, please send the following text message code: <br>
                                                <b><?php echo $myxer_tag ?> to 69937</b><br> from your mobile phone, and then follow the instructions.  <br>
                                                Standard text messaging fees may be applied by your carrier.  
                                                <br>
                                                NOTE: currently, this feature works only in the U.S., and requires that your mobile phone must have web browsing capability.  Please stay tuned for future changes
                                            </td>
                                        </tr>
                                    </table>
                                    <?
                                } else {
                                    $file = MY_SITE_URL . 'tone/' . $file;
                                    ?>
                                    You are just one step to download the ringtone to your cellphone.<br>
                                    Please click the download link below.
                                    <br>
                                    <a href="javascript:zap('<?php echo $file ?>', '<?php echo $fileTitle; ?>');">Download Now</a>
                            <?php
                                }
                            ?>
                            </td>
                        </tr>
                    </table>
                </form>
    <?php
        }   
    ?>
        </td>
    </tr>
</table>
<?php $view['slots']->stop() ?>