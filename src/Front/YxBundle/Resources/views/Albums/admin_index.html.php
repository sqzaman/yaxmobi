<?php $view->extend('YxBundle:layout:admin_base.html.php') ?>

<?php $view['slots']->start('body') ?>

<link href="/css/table-sorter/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery/jquery.tablesorter.js"></script>
<script type="text/javascript" src="/js/js_files/album.js"></script>
<div class="PageTitle"><?php echo strtoupper('Genres'); ?></div>
<div id="tasks_todo" >
    <div class="md">
        <?php //echo $this->renderElement('member_search')?>
        <?php //echo $view['actions']->render('YxBundle:Tickers:index', array('flag' => 'reduced'));?>
        <?php echo $view->render('YxBundle:Box:search_bar.html.php', array('url' => $base_url .'/', 'label' => 'Albums')); ?>
    </div>
    
    <table width="98%" id="myTable" class="tablesorter" align="left">
    <thead>
        <tr>
            <th width="50">
                <input id="sel_all" type="checkbox">
            </th>
            <th>Edit</th>
            <th>Album</th>
            <th>Price</th>
            <th>Description</th>
        </tr>
    </thead>
 
  <tbody>
    <?php 
        $cnt = 0;
        foreach ($albums as $data): 
            $cnt++;
        $classVar ='class="bgGrey"';
    ?>
    <tr <?php echo $classVar;?> id="tr_<?php echo $data['id'];?>" >
        <td> <input type="checkbox" class="sel-all-chkbox" name="box_[]" value="<?php echo $data['id']; ?>"></td>
        <td> <a href="<?php echo $base_url . '/edit/' . $data['id'];?>"><img src="/img/edit.gif" border="0" />  </a> </td>
        <td><a href="/admin/songs/album/<?php echo $data['id']; ?>"><?php echo $data['aname'];?></a></td>
        <td><?php echo $data['price'];?></td>
        <td><?php echo $data['description'];?></td>
    </tr>
    <?php endforeach; ?>
    
  </tbody>
</table>

    <table>
        <tr>
        <td class="buttonbar" align="">
            <input type="button" value="Delete" class="delete-me">
            &nbsp;&nbsp;
            <a href="/admin/albums/add"><input type="button" value="Add New"></a>
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