<?php $view->extend('YxBundle:layout:admin_base.html.php') ?>

<?php $view['slots']->start('body') ?>

<link href="/css/table-sorter/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery/jquery.tablesorter.js"></script>
<script type="text/javascript" src="/js/js_files/mailinglist.js"></script>
<div class="PageTitle"><?php echo strtoupper('Mailinglists'); ?></div>
<div id="tasks_todo" >
    <div class="md">
        <?php //echo $this->renderElement('member_search')?>
        <?php //echo $view['actions']->render('YxBundle:Tickers:index', array('flag' => 'reduced'));?>
        <?php echo $view->render('YxBundle:Box:search_bar.html.php', array('url' => $base_url .'/', 'label' => 'Mailinglists')); ?>
    </div>
    
    <table width="98%" id="myTable" class="tablesorter" align="left">
    <thead>
        <tr>
            <th width="50">
                <input id="sel_all" type="checkbox">
            </th>
            <th>Mailinglist</th>
        </tr>
    </thead>
 
  <tbody>
    <?php 
        $cnt = 0;
        foreach ($records as $data): 
            $cnt++;
        if($data['status'] == '0') { 
            $classVar='class="suspend"';
        }else{ 
            $classVar=''; 
        }
        
        
    ?>
    <tr <?php echo $classVar;?> id="tr_<?php echo $data['id'];?>" >
        <td> <input type="checkbox" class="sel-all-chkbox" name="box_[]" value="<?php echo $data['id']; ?>"></td>
        <td><?php echo $data['email'];?></td>
    </tr>
    <?php endforeach; ?>
    
  </tbody>
</table>
    <br>
<table>
    <tr>
    <td class="buttonbar" align="">
        <input type="button" value="Delete" class="delete-me">
        &nbsp;&nbsp;
        <input type="button" value="Suspend" class="update-status" >
        &nbsp;&nbsp;
        <input type="button" value="Activate" class="update-status" >
    </td>
</tr> 
</table>
    
</div>
<div class="pagination">
    <?php echo $paginator->create_links( $base_url , $extraParam );?>
</div>
<table cellpadding="2" cellspacing="2" border="0" width="100" align="left">
	<tr class="suspend">
	   <td width="50" ></td>
	   <td>Suspended</td>
	</tr>
	<tr>
	   <td></td>
	   <td>Active</td>
	</tr>
</table>
<?php $view['slots']->stop() ?>