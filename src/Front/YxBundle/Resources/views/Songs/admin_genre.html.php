<?php $view->extend('YxBundle:layout:admin_base.html.php') ?>

<?php $view['slots']->start('body') ?>

<link href="/css/table-sorter/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery/jquery.tablesorter.js"></script>
<script type="text/javascript" src="/js/js_files/song.js"></script>
<div class="PageTitle"><?php echo strtoupper("ALBUM LIST RELATED TO GENRE"); ?></div>
<div id="tasks_todo" >
    <div class="md">
    </div>
    
    <table width="98%" id="myTable" class="tablesorter">
    <thead>
        <tr>
            <th width="50">
                <input id="sel_all" type="checkbox">
            </th>
            <th>Composition</th>
            <th>Album</th>
            <th>Genre</th>
            <th>Year</th>
        </tr>
    </thead>
 
  <tbody>
    <?php 
        $cnt = 0;
        foreach ($songs as $data): 
            $cnt++;
        $classVar ='class="bgGrey"';
    ?>
    <tr <?php echo $classVar;?> id="tr_<?php echo $data['id'];?>" >
        <td> <input type="checkbox" class="sel-all-chkbox" name="box_[]" value="<?php echo $data['id']; ?>"></td>
        <td><?php echo $data['composition'];?></td>
        <td><a href="/admin/songs/album/<?php echo $data['album_id'];?>"><?php echo $data['aname'];?></a></td>
        <td><?php echo $data['gname'];?></td>
        <td><?php echo $data['year'];?></td>
    </tr>
    <?php endforeach; ?>
    
  </tbody>
</table>

    <table>
        <tr>
        <td class="buttonbar" align="">
            <input type="button" value="Delete" class="delete-me">
        </td>
    </tr> 
    </table>
</div>
<div class="pagination">
    <?php
    //echo '<pre>'; print_r( $paginator );die;
    ?>
    <?php echo $paginator->create_links( $base_url , $extraParam );?>
</div>
<?php $view['slots']->stop() ?>