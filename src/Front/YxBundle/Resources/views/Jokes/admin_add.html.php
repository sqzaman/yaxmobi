<?php $view->extend('YxBundle:layout:admin_base.html.php') ?>

<?php $view['slots']->start('body') ?>

<link href="/css/table-sorter/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery/jquery.tablesorter.js"></script>
<script type="text/javascript" src="/js/jquery/jquery.validate.min.js"></script>
<script type="text/javascript" src="/js/js_files/joke.js"></script>
<script>
    $(document).ready(function(){
        $('#frm1').validate();
    });
    
</script>
<div class="PageTitle"><?php echo strtoupper('Add Joke'); ?></div>
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
                    <td align="right">Joke Category:</td>
                    <td>
                        <select name="jokecategory_id" class="required">
                            <option value="">Select</option>
                        <?php
                            if ( $jokeCat ):
                                foreach ( $jokeCat as $val ):
                                    echo '<option value="'. $val->getId() .'">'. $val->getCatname() .'</option>';
                                endforeach;
                            endif;
                        ?>
                        </select>
                    </td>
                </tr>
                <tr class="bgGrey">
                    <td align="right">Joke Title:</td>
                    <td>
                        <input class="required" type="text" size="40" name="title" value="" />
                    </td>
                </tr>
                <tr class="bgGrey">
                    <td align="right">Joke:</td>
                    <td>
                        <textarea class="required" name="description" rows="5" cols="43"></textarea>
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