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
					
		foreach ($jokes as $joke):
                    if($color%2==0){
                            $rowColor = '#F8F8F8';
                    }else {
                            $rowColor = '#FFFFFF';
                    }

                    $color ++;
            ?>
                    <tr bgcolor="<?php echo $rowColor?>" id="<?php echo $i;?>" onmouseover="Javascript: void roll_over('<?php echo $rowColor;?>', this.id);" onmouseout="javascript: void roll_over_restore('<?php echo $rowColor;?>', this.id);">
                        <td align="left">
                            <a href="/jokes/jokes/<?php echo $joke->getId();?>"><?php echo $joke->getCatname();?></a>
                        </td>
                    </tr>
            <?
                $i++;
                endforeach;

            ?>
            </table>
        </td>
    </tr>
</table>
<?php $view['slots']->stop() ?>