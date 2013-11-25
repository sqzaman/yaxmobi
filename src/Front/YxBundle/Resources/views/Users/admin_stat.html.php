<?php $view->extend('YxBundle:layout:admin_base.html.php') ?>

<?php $view['slots']->start('body') ?>

<link href="/css/table-sorter/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery/jquery.tablesorter.js"></script>
<script type="text/javascript" src="/js/js_files/user.js"></script>
<div class="PageTitle"><?php echo strtoupper('Report'); ?></div>
<div id="tasks_todo" >
    <div class="md">
        <?php //echo $view->render('YxBundle:Box:search_bar.html.php', array('url' => '/admin/users/', 'label' => 'List of Users')); ?>
    </div>
    
    <div style="width:100%;" align="left">
        <div align="left" style="width:70%;padding-right:5px;">
                <fieldset style="width:100%;"><legend> Report for last 30 days</legend>
                    <table width="100%" border="1" style="border-collapse: collapse; ">
                        <?php
                        echo '<tr>
                                <th>Date</th>
                                <th align=center>Paid ringtones</th>
                                <th align=center>Paid jokes phone</th>
                                <th align=center>Free jokes phone</th>
                                <th align=center>Paid jokes PC</th>
                                <th align=center>Free jokes PC</th>
                                </tr>';
                        foreach($month as $key => $doc){
                            if ( $key == date("F d, Y", time())) 
                                $key = 'Today';
                            
                            print '<tr><td>'.$key.'</td><td align=center>'.$doc['pr'].'</td><td align=center>'.$doc['pj'].'</td><td align=center>'.$doc['fj'].'</td><td align=center>'.$doc['pcpj'].'</td><td align=center>'.$doc['pcfj'].'</td></tr>';
                        }
                        ?>
                    </table>
                </fieldset>	
        </div>
        <div align="left" style="width:70%;padding-right:5px;">
            <fieldset style="width:100%;"><legend>Report for last 24 months</legend>
                <table width="100%" border="1" style="border-collapse: collapse; ">
                    <?php
                        print '<tr>
                                <th>Date</th>
                                <th align=center>Paid ringtones</th>
                                <th align=center>Paid jokes</th>
                                <th align=center>Free jokes</th>
                                <th align=center>Paid jokes PC</th>
                                <th align=center>Free jokes PC</th>
                                </tr>';
                        foreach($years as $key=>$doc){
                            print '<tr><td>'.$key.'</td><td align=center>'.$doc['pr'].'</td><td align=center>'.$doc['pj'].'</td><td align=center>'.$doc['fj'].'</td><td align=center>'.$doc['pcpj'].'</td><td align=center>'.$doc['pcfj'].'</td></tr>';
                        }
                    ?>
            </table>
            </fieldset>	
                <br>
        </div>
    </div>
    
</div>
<?php $view['slots']->stop() ?>