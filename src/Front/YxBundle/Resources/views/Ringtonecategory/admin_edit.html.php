<?php $view->extend('YxBundle:layout:admin_base.html.php') ?>

<?php $view['slots']->start('body') ?>

<link href="/css/table-sorter/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery/jquery.tablesorter.js"></script>
<script type="text/javascript" src="/js/jquery/jquery.validate.min.js"></script>
<script type="text/javascript" src="/js/js_files/ringtonecategory.js"></script>

<script>
    $(document).ready(function(){
        $('#frm1').validate();
    });
    
</script>
<div class="PageTitle"><?php echo strtoupper('Edit Ringtonecategory'); ?></div>
<div id="tasks_todo" >
    <div class="md">
        <?php //echo $view->render('YxBundle:Box:search_bar.html.php', array('url' => $base_url . '/', 'label' => 'Edit Genre')); ?>
    </div>

    <form name="frm1" id="frm1" method="post" action="" enctype="multipart/form-data">
        <div id="tasks_todo">
            <table width="70%" cellpadding="2" cellspacing="0" border="0" align="" class="blue_header borNavBlue">
                <tr>
                    <td colspan=2>&nbsp;</td>
                </tr>
                <tr class="bgGrey">
                    <td align="right">Ringtone Category:</td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $record->getId(); ?>"/>
                        <input class="required" type="text" size="40" name="title" value="<?php echo $record->getTitle();?>" />
                    </td>
                </tr>
                <tr class="bgGrey">
                    <td align="right">Status:</td>
                    <td>
                        Active <input type="radio" name="status" value="1" <?php echo $record->getStatus() == 1 ? 'checked' : '';?> >
                        Inactive <input type="radio" name="status" value="0" <?php echo $record->getStatus() == 0 ? 'checked' : '';?>>
                    </td>
                </tr>
                <tr class="bgGrey">
                    <td align="right">Upload Image:</td>
                    <td>
                        <input type="file" name="image" />
                    </td>
                </tr>
                <tr class="bgGrey">
                    <td align="right"></td>
                    <td><input type="submit" value="Save"></td>
                </tr>
            </table>
        </div>
    </form>
    <?php $view['slots']->stop() ?>