<?php $view->extend('YxBundle:layout:admin_base.html.php') ?>

<?php $view['slots']->start('body') ?>

<link href="/css/table-sorter/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery/jquery.tablesorter.js"></script>
<script type="text/javascript" src="/js/js_files/user.js"></script>
<div class="PageTitle"><?php echo strtoupper('Members'); ?></div>
<div id="tasks_todo" >
    <div class="md">
        <?php echo $view->render('YxBundle:Box:search_bar.html.php', array('url' => '/admin/users/', 'label' => 'List of Users')); ?>
    </div>
    
    <table width="98%" id="myTable" class="tablesorter">
    <thead>
        <tr>
            <th width="50">
<!--                <input id="sel_all" type="checkbox" onClick="javascript:for(i=0;i<this.form.elements.length;i++)
				    if((this.form.elements[i].type=='checkbox')&&(this.form.elements[i].name.indexOf('box_')==0))
						  this.form.elements[i].checked=this.checked;">-->
                <input id="sel_all" type="checkbox">
            </th>
            <th>Email Id</th>
            <th>First Name</th>
            <th>Balance Available</th>
            <th>Last modified</th>
            <th>Sex</th>
            <th>Account Created On</th>
            <th>Subscribed</th>
        </tr>
    </thead>
 
  <tbody>
    <?php 
        $cnt = 0;
        foreach ($users as $user): 
            $cnt++;
        if($user['status'] == 'S') { 
            $classVar='class="suspend"';
        } else if($user['status'] == 'N') { 
            $classVar='class="suspend"'; 
        } else if($user['status'] == 'A') { 
            $classVar=''; 
        }
    ?>
    <tr <?php echo $classVar;?> id="tr_<?php echo $user['id']; ?>" >
        <td> <input type="checkbox" class="sel-all-chkbox" name="box_[]" value="<?php echo $user['id']; ?>"></td>
        <td><?php echo $user['email'];?></td>
        <td><?php echo $user['firstname'];?></td>
        <td>
            <div>
                <span id="amt_<?php echo $cnt;?>"><?php echo $user['amount'];?></span>
                <span style="float:right;">
                    <form action="/admin/users/update" METHOD="post"> 
                        <input type=text class="input" maxLength="8" style="width:40px" name="num_<?php echo $cnt;?>"  value='<?php echo $user['amount'];?>'>
                        <input type="hidden" name="id_<?php echo $cnt;?>" value="<?php echo $user['id']?>">
                        <INPUT class="update-balance" id="btn_<?php echo $cnt;?>" type=submit value='Set'>
                    </form>
                </span>
            </div>
            
        </td>
        <td><?php echo $user['modified'];?></td>
        <td><?php echo $user['gender'];?></td>
        <td><?php echo $user['created'];?></td>
        <td><?php echo $user['name'];?></td>
    </tr>
    <?php endforeach; ?>
    
  </tbody>
</table>

    <table>
        <tr>
        <td colspan="7" class="buttonbar" align="">
            <input type="button" value="Delete" class="delete-user">
        </td>
        <td  class="buttonbar" align="right">
         <input type="button" value="Suspend" class="update-status">
         <input type="button" value="Activate" class="update-status">
        </td>
    </tr> 
    </table>
</div>
<div class="pagination">
    <?php echo $paginator->create_links( '/admin/users', $extraParam );?>
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