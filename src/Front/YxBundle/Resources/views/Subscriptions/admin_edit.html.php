<?php $view->extend('YxBundle:layout:admin_base.html.php') ?>

<?php $view['slots']->start('body') ?>

<link href="/css/table-sorter/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery/jquery.tablesorter.js"></script>
<script type="text/javascript" src="/js/jquery/jquery.validate.min.js"></script>
<script type="text/javascript" src="/js/js_files/subscription.js"></script>
<script>
    $(document).ready(function(){
        $('#frm1').validate();
    });
    
</script>
<div class="PageTitle"><?php echo strtoupper('Edit Subscription'); ?></div>
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
                    <td align="right" width="210">Subscription Title:</td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $record->getId();?>" />
                        <input class="required" type="text" name="name" value="<?php echo $record->getName();?>" /> 
                    </td>
                </tr>
                <tr class="bgGrey">
                    <td align="right">Count of Jokes:</td>
                    <td>
                        <input class="required" type="text" name="count_joke" value="<?php echo $record->getCountJoke();?>" /> 
                    </td>
                </tr>
                <tr class="bgGrey">
                    <td align="right">Count of Ringtones:</td>
                    <td>
                        <input class="required" type="text" name="count_ring" value="<?php echo $record->getCountRing();?>" /> 
                    </td>
                </tr>
                <tr class="bgGrey">
                    <td align="right">Price:</td>
                    <td>
                        <input class="required" type="text" name="price" value="<?php echo $record->getPrice();?>" /> 
                    </td>
                </tr>
                <tr class="bgGrey">
                    <td align="right">Frequency of delivery joke (days):</td>
                    <td>
                        <input class="required" type="text" name="per_joke" value="<?php echo $record->getPerJoke();?>" /> 
                    </td>
                </tr>
                <tr class="bgGrey">
                    <td align="right">Frequency of delivery Ringtones (days):</td>
                    <td>
                        <input class="required" type="text" name="per_ring" value="<?php echo $record->getPerRing();?>" /> 
                    </td>
                </tr>
                <tr class="bgGrey">
                    <td align="right">Delivery E-mail:</td>
                    <td>
                        <input class="required" type="radio" name="delivery_mail" value="+" <?php echo $record->getDeliveryMail() == '+' ? ' Checked ' : '';?>/> Yes
                        <input class="required" type="radio" name="delivery_mail" value="" <?php echo $record->getDeliveryMail() == '' ? ' Checked ' : '';?>/> No 
                    </td>
                </tr>
                <tr class="bgGrey">
                    <td align="right">Delivery phone:</td>
                    <td>
                        <input class="required" type="radio" name="delivery_phone" value="+" <?php echo $record->getDeliveryPhone() == '+' ? ' Checked ' : '';?> /> Yes
                        <input class="required" type="radio" name="delivery_phone" value="" <?php echo $record->getDeliveryPhone() == '' ? ' Checked ' : '';?> /> No 
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