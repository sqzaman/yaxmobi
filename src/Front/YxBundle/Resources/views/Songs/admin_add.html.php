<?php $view->extend('YxBundle:layout:admin_base.html.php') ?>

<?php $view['slots']->start('body') ?>

<link href="/css/table-sorter/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery/jquery.tablesorter.js"></script>
<script type="text/javascript" src="/js/jquery/jquery.validate.min.js"></script>
<script type="text/javascript" src="/js/js_files/song.js"></script>

<script>
    $(document).ready(function(){
        $('#frm1').validate();
    });
    
</script>
<div class="PageTitle"><?php echo strtoupper('Add Song'); ?></div>
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
                    <td align="right">Song Title:</td>
                    <td>
                        <input class="required" type="text" size="40" name="composition" value="" />
                    </td>
                </tr>
                <tr>
                    <td align="right">Singer Name:</td>
                    <td>
                        <select class="required" name="singer_id">
                            <option>Select Singer</option>
                        <?php
                        if ( $singers ):
                            foreach ( $singers as $singer ):
                                echo '<option value="'. $singer->getId() .'">'. $singer->getSname() .'</option>';
                            endforeach;
                        endif;
                        ?>
                        </select> 
                    </td>

                </tr>

                <tr>
                    <td align="right">Album Name:</td>
                    <td>
                        <select class="required" name="album_id">
                            <option>Select Album</option>
                        <?php
                        if ( $singers ):
                            foreach ( $albums as $album ):
                                echo '<option value="'. $album->getId() .'">'. $album->getAname() .'</option>';
                            endforeach;
                        endif;
                        ?>
                        </select> 
                    </td>
                </tr>
                <tr>
                    <td align="right">Genre Name:</td>
                    <td>
                        <select class="required" name="genre_id">
                            <option>Select Genre</option>
                        <?php
                        if ( $genres ):
                            foreach ( $genres as $genre ):
                                echo '<option value="'. $genre->getId() .'">'. $genre->getGname() .'</option>';
                            endforeach;
                        endif;
                        ?>
                        </select> 
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
                    <td align="right">Price pc:</td>
                    <td>
                        <input class="required" type="text" size="40" name="ratepc" value="" />
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
                        Paid <input type="radio" name="paid" value="Y" checked >
                        Free <input type="radio" name="paid" value="N" >
                    </td>
                </tr>
                <tr>
                    <td align="right">Myxer Code:</td>
                    <td>
                        <input type="text" size="40" name="myxer_tag" value="" />
                    </td>
                </tr>
                <tr>
                    <td align='right'>Upload Joke for Phone:</td>
                    <td>
                        <input class="required" type="file" name="path">
                    </td>
                </tr>
                <tr>
                    <td align='right'>Upload Joke for PC(DRM):</td>
                    <td>
                        <input type="file" name="drm">
                    </td>
                </tr>
                <tr>
                <tr>
                    <td align='right'>Upload Sample after buying:</td>
                    <td>
                        <input type="file" name="sample_file">
                    </td>

                </tr>
                <tr>
                    <td align='right'>Upload Sample befor buying:</td>
                    <td>
                        <input type="file" name="sample_file_before">
                    </td>
                </tr>
                <tr >
                    <td align="right">Song Tag:</td>
                    <td>
                        <input type="text" size="40" name="tag" value="" />
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