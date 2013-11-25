<?php $view->extend('YxBundle:layout:base.html.php') ?>

<?php $view['slots']->start('body') ?>

<table border="0" cellspacing="0" cellpadding="0" class="container">
    <tr>
        <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
        <td class="navwhitetext"><? echo $pageHeading; ?></td>
        <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
    </tr>
    <tr>
        <td colspan="3" align="center" width="100%">
            <table width="100%" border="0" align="center">
            <? 
		$i=0; 
		
		$color = 2;
					
		foreach ($joke as $joke):
                    if($color%2==0){
                            $rowColor = '#F8F8F8';
                    }else {
                            $rowColor = '#FFFFFF';
                    }

                    $color ++;
            ?>
                    <tr bgcolor="<?php echo $rowColor?>" id="<?php echo $i;?>" onmouseover="Javascript: void roll_over('<?php echo $rowColor;?>', this.id);" onmouseout="javascript: void roll_over_restore('<?php echo $rowColor;?>', this.id);">
                        <td align="left" style="border: #7777cc 2px solid">
                            <table width="100%" border='0'>
                                <tr>
                                    <td colspan='2' style="background-color:#303161 ; color:#fff">
                                        <?php echo $joke->getDescription();?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo "Published on " . $joke->getCreated()->format('d M, Y') ;?></td>
                                    <td align="right">
                                        <?php 
                                            echo "<a href='#' onclick = 'openWindow(\"".MY_SITE_URL."ratings/add/".$joke->getId().",2\",\"\");'>Rate this joke</a>&nbsp;&nbsp;";
                                            echo "<a href='tellafriends/add/". $joke->getId() .",2'><img src='/img/images/tellafriend.gif' border='0' align='absmiddle'  /></a>";
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan='2'>
                                    <?php 
                                        if ($songRating[$i]['points'][0] != 0){
                                            for ($k = 0; $k < $songRating[$i]['points'][0]; $k++){
                                                echo "<img src='/img/images/star.gif' />";
                                                
                                            }
                                            echo " Votes : " . $songRating[$i]['vote'][0];
                                        }else{
                                            echo "<img src='/img/images/00star.gif' />";
                                        ?> <br>
                                        <a href="#"
                                            onclick="openWindow('<?=MY_SITE_URL?>ratings/add/<?php echo $joke->getId();?>,2','');">Be
                                            the first one to rate this joke</a> <?
                                        }

                                        ?>
                                    </td>
                                </tr>
                            </table>
                            
                        </td>
                    </tr>
            <?
                $i++;
                endforeach;

            ?>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="3" class="buttonbar" align="left">
            <h1><a id="backanchor" href="/jokes/all_joke_category">Back to Written Jokes Categories</a></h1>
        </td>
    </tr>
</table>
<?php $view['slots']->stop() ?>