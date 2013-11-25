<?php $view->extend('YxBundle:layout:admin_base.html.php') ?>

<?php $view['slots']->start('body') ?>

<link href="/css/table-sorter/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery/jquery.tablesorter.js"></script>
<script type="text/javascript" src="/js/jquery/jquery.validate.min.js"></script>
<script type="text/javascript" src="/js/js_files/ringtone.js"></script>
<script>
    $(document).ready(function(){
        $('#frm1').validate();
    });
    
</script>
<div class="PageTitle"><?php echo strtoupper('Add Ringtone'); ?></div>
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
                    <td align="right">Ringtone Category:
                    </td>
                    <td>
                        <select name="category" class="required">
                            <option value="">Select</option>
                        <?php 
                            if ($ringtoneCat):
                                foreach ( $ringtoneCat as $val):
                                    echo '<option value="'. $val->getId() .'">'. $val->getTitle() .'</option>';
                                endforeach;
                            endif;
                        ?>
                        </select>
                    </td>
                </tr>
                <tr class="bgGrey">
                    <td align="right">Ringtone Title:
                    </td>
                    <td>
                        <input class="required" type="text" size="40" name="title" value="" />
                    </td>
                </tr>
                <tr>
                    <td align="right">Ringtone Description:</td>
                    <td>
                        <input class="required" type="text" size="40" name="description" value="" />
                    </td>
                </tr>
                <tr>
                    <td align="right">Status:</td>
                    <td>
                        Active <input type="radio" name="status" value='1' checked> 
                         Inactive <input type="radio" name="status" value='0'> 
                    </td>
                </tr>
                <tr>
                    <td align="right">Type:</td>
                    <td>
                        Free <input type="radio" name="type" value='0' checked>
                        Paid <input type="radio" name="type" value='1'>
                    </td>
                </tr>
                <tr>
                    <td align="right">Price:</td>
                    <td>
                        <input class="required" type="text" size="40" name="price" value="" />
                    </td>
                </tr>
                <tr>
                    <td align="right">Myxer Tag:</td>
                    <td>
                        <input class="required" type="text" size="40" name="myxer_tag" value="" />
                    </td>
                </tr>
                <tr>
                    <td align="right">Ringtone File:</td>
                    <td>
                        <input class="required" type="file" size="40" name="ringtone" value="" />
                    </td>
                </tr>
                <tr>
                    <td align="right">Ringtone File Preview:</td>
                    <td>
                        <input type="file" size="40" name="prew_ringtone" value="" />
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