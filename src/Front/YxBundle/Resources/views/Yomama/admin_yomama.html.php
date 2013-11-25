<?php $view->extend('YxBundle:layout:admin_base.html.php') ?>

<?php $view['slots']->start('body') ?>

<link href="/css/table-sorter/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery/jquery.tablesorter.js"></script>
<script type="text/javascript" src="/js/js_files/yomama.js"></script>
<div class="PageTitle"><?php echo strtoupper('Yomama'); ?></div>
<div id="tasks_todo" >
    <div class="md">
        <?php //echo $this->renderElement('member_search')?>
        <?php //echo $view['actions']->render('YxBundle:Tickers:index', array('flag' => 'reduced'));?>
        <?php echo $view->render('YxBundle:Box:search_bar.html.php', array('url' => $base_url .'/', 'label' => 'Yomama')); ?>
    </div>
    
    <table width="98%" id="myTable" class="tablesorter" align="left">
    <thead>
        <tr>
            <th width="50">
                <input id="sel_all" type="checkbox">
            </th>
            <th>Edit</th>
            <th>Yomama</th>
        </tr>
    </thead>
 
  <tbody>
    <?php 
        $cnt = 0;
        foreach ($records as $data): 
            $cnt++;
        $classVar ='class="bgGrey"';
    ?>
    <tr <?php echo $classVar;?> id="tr_<?php echo $data['id'];?>" >
        <td> <input type="checkbox" class="sel-all-chkbox" name="box_[]" value="<?php echo $data['id']; ?>"></td>
        <td> <a href="<?php echo $base_url . '/edit/' . $data['id'];?>"><img src="/img/edit.gif" border="0" />  </a> </td>
        <td><?php echo $data['title'];?></td>
    </tr>
    <?php endforeach; ?>
    
  </tbody>
</table>
    <br>
<table>
    <tr>
    <td class="buttonbar" align="">
        <input type="button" value="Delete" class="delete-me yomama">
        &nbsp;&nbsp;
        <a href="/admin/yomama/add"><input type="button" value="Add New"></a>
    </td>
</tr> 
</table>
    
</div>
<div class="pagination">
    <?php echo $paginator->create_links( $base_url , $extraParam );?>
</div>
<?php $view['slots']->stop() ?>