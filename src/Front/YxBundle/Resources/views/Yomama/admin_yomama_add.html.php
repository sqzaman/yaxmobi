<?php $view->extend('YxBundle:layout:admin_base.html.php') ?>

<?php $view['slots']->start('body') ?>

<link href="/css/table-sorter/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery/jquery.tablesorter.js"></script>
<script type="text/javascript" src="/js/jquery/jquery.validate.min.js"></script>
<script type="text/javascript" src="/js/js_files/yomama.js"></script>
<script>
    $(document).ready(function(){
        $('#frm1').validate();
    });
    
</script>
<div class="PageTitle"><?php echo strtoupper('Add Yomama'); ?></div>
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
                    <td align="right">Yomama:</td>
                    <td>
                    
                        <select name="category" class="required">
                            <option value="">Select</option>
                        <?php 
                            if ($category):
                                foreach ( $category as $val):
                                    echo '<option value="'. $val->getId() .'">'. $val->getCatname() .'</option>';
                                endforeach;
                            endif;
                        ?>
                        </select>
                    
                    </td>
                </tr>
                <tr class="bgGrey">
                    <td align="right">Yomama:</td>
                    <td>
                        <input class="required" type="text" size="40" name="title" value="" />
                    </td>
                </tr>
                <tr class="bgGrey">
                    <td align="right">Description:</td>
                    <td>
                        <input type="text" size="40" name="description" value="" />
                    </td>
                </tr>
                <tr class="bgGrey">
                    <td align="right">Status:</td>
                    <td>
                        Active <input type="radio" name="status" value='1' checked> 
                        Inactive <input type="radio" name="status" value='0'> 
                    </td>
                </tr>
                <tr>
                    <td align="right">Year:</td>
                    <td>
                        <input class="required" type="text" size="40" name="year" value="" />
                    </td>
                </tr>
                <tr>
                    <td align="right">Duration:</td>
                    <td>
                        <input class="required" type="text" size="40" name="duration" value="" />
                    </td>
                </tr>
                <tr>
                    <td align="right">Price phone:</td>
                    <td>
                        <input class="required" type="text" size="40" name="rate" value="" />
                    </td>
                </tr>
                <tr>
                    <td align="right">Type:</td>
                    <td>
                        <input class="required" type="text" size="40" name="type" value="" />
                    </td>
                </tr>
                <tr>
                    <td align="right">Paid:</td>
                    <td>
                        Paid <input type="radio" name="paid" value="Y">
                        Free <input type="radio" name="paid" value="N" checked>
                    </td>
                </tr>
                <tr>
                    <td align="right">Myxer Code:</td>
                    <td>
                        <input type="text" size="40" name="myxer_tag" value="" />
                    </td>
                </tr>
                <tr >
                    <td align="right">Song Tag:</td>
                    <td>
                        <input type="text" size="40" name="tag" value="" />
                    </td>
                </tr>
                <tr>
                    <td align="right">Yomama File:</td>
                    <td>
                        <input type="file" name="yomama_file" />
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