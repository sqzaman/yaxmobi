<?php $view->extend('YxBundle:layout:base.html.php') ?>

<?php $view['slots']->start('body') ?>

<table border="0" cellspacing="0" cellpadding="0" class="container">
    <tr>
        <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
        <td class="navwhitetext">Yomama</td>
        <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
    </tr>
    <tr>
        <td colspan="3" align="center" width="100%">
            <OBJECT id="slideshow"
			classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
			codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0"
			WIDTH="429" HEIGHT="144" id="homeBanner" align="middle">
			<PARAM NAME=movie VALUE="/flash/yaxmobi_ringtone.swf">
			<PARAM NAME=quality VALUE=high>
			<PARAM NAME=allowScriptAccess VALUE=sameDomain>
			<EMBED Name="slideshow" src="/flash/yaxmobi_ringtone.swf"
				quality=high WIDTH="429" HEIGHT="144"
				TYPE="application/x-shockwave-flash"
				PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED>
            </OBJECT>
        </td>
    </tr>
    <tr>
        <td colspan="3" align="center" width="100%">
            <table width="100%" border="0" align="center">
                <tr>
                    <td>
                    <style>
                    .blue_btn_sp2{
                                            width:130px;					
                                            background:#5d5da1;
                                            border:#000000 1px solid;
                                            color:#FFFFFF;
                                            text-align:center;
                                            padding:8px;
                                    }
                    </style>
                        <table width="100%">
                            <tr>
                                <td colspan='2'>
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="1">
                                                <img src="/img/images/t01.gif" border="0" width="5" height="28" />
                                            </td>
                                            <td width="417" class="navwhitetext" style="background-image: url('/img/images/t02.gif'); background-repeat: repeat-x;">
                                                Yomama - <?php echo $category;?>
                                            </td>
                                            <td width="1" align="right">
                                                <img src="/img/images/t03.gif" border="0" width="5" height="28" />
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <?php
                                if (count($records) > 0 ):
                                    $color = 2;
                                    for($i=0; $i <= count($records)-1; $i++):
                                        if($color%2==0){
                                            $rowColor = '#F8F8F8';
                                            $audioImage = 'play_btn.gif';
                                        }else {
                                            $rowColor = '#ffffff';
                                            $audioImage = 'play_btn.gif';
                                        }	
                                        $color ++;
                                        
                            ?>
                                <tr bgcolor=<?php echo $rowColor?> id="<?php echo $i;?>"
                            onmouseover="Javascript: void roll_over('<?php echo $rowColor;?>', this.id);"
                            onmouseout="javascript: void roll_over_restore('<?php echo $rowColor;?>', this.id);">
                                    <td width='50%' >
                                        <?php echo ($i+1) . '.&nbsp;' . $records[$i]['title'];?>
                                    </td>
                                    <td>
                                        <a title="Play" href='javascript:void();' onClick="openPlayer('<?php echo $records[$i]['id'];?>','yomama')">
                                            <img border="0" align="absmiddle" src="/img/images/<?php echo $audioImage?>">
                                        </a>
                                    </td>
                            <?php
                                    endfor;
                                endif;
                            ?>
                            <tr>
                                <td colspan="3">
                                    <div class="pagination">
                                        <?php echo $paginator->create_links( $base_url, $extraParam );?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2'>
                                    <div id="tabdiv">

                                        <!--             Tabbed Section -->
                                        <?php echo $view['actions']->render('YxBundle:Tabs:yomama'); ?>
                                        <!--             Tabbed Section -->


                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" colspan='2'>
                                    <a class="blue_btn_a back-btn" href="#"><div class="blue_btn">Back</div></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<?php $view['slots']->stop() ?>