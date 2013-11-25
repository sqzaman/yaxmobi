<?php $view->extend('YxBundle:layout:admin_base.html.php') ?>

<?php $view['slots']->start('body') ?>

<link href="/css/table-sorter/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery/jquery.tablesorter.js"></script>
<script type="text/javascript" src="/js/jquery/jquery.validate.min.js"></script>
<script type="text/javascript" src="/js/js_files/user.js"></script>
<script>
    $(document).ready(function(){
        $('#frm1').validate();
    });
    
</script>
<div class="PageTitle"><?php echo strtoupper('My Preference'); ?></div>
<div id="tasks_todo" >
    <div class="md">
        <?php //echo $view->render('YxBundle:Box:search_bar.html.php', array('url' => '/admin/users/', 'label' => 'List of Users')); ?>
    </div>
    
    <div style="width:100%;" align="left">
        <?php if ($msg != '' ): ?>
            <center><font size="4" color="red"><p><?php echo $msg ;?></p></font></center>
        <? endif; ?>
        <form name="frm1" id="frm1" action="" method="post">
            <table cellpadding="3" cellspacing="0" border="0" width="550" class="logintbl">
                <tr>
                    <td style="padding-left:15px;">Change E-mail Id:</td>
                    <td style="padding-right:15px;">
                        <input class="required" type="text" name="email" size="30" value="<?php echo $record->getEmail();?>" />
                    </td>
                </tr>
                
                <tr>
                    <td style="padding-left:15px;"></td>
                    <td style="padding-right:15px;">
                        <input type="submit" value="Save" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
    
</div>
<?php $view['slots']->stop() ?>