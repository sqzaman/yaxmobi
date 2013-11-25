<table width="175" border="0" cellspacing="0" cellpadding="0">

    <!-- Download Cart Section -->
	<?php echo $view['actions']->render('YxBundle:Box:mycart'); ?>
    <!-- Download Cart Section -->
    
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <!-- Search form starts here -->	
    <form action="/users/search" METHOD="post" name="searchform" > 
        <tr>
            <td colspan="3">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
                        <td class="navwhitetext" style="background-image: url(/img/images/t02.gif); background-repeat: repeat-x;">Search Jokes Catalog</td>
                        <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
                    </tr>
                </table>
            </td>
        </tr>	
        <tr>
            <td colspan="3" align="center"
                style="border-bottom: #4c4c4c 1px solid; border-left: #4c4c4c 1px solid; border-right: #4c4c4c 1px solid">
                <table width="90%" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                        <td height="10" align="left"></td>
                    </tr>
                    <tr>
                        <td align="left">
                            <select name="what">
                                <option value="all">All Fields</option>
                                <option value="category">Category</option>
                                <option value="comp">Joke</option>
                                <option value="singer">Performer</option>
                                <option value="ringtone">Ringtone</option>
                            </select>
                            <INPUT TYPE="text" class="tf" name="searchkeyworld" value=''>				</td>
                    </tr>
                    <tr>
                        <td align="left">
                            <INPUT name="search" class="submit_btn" type="submit" value='Search'>				</td>
                    </tr>
                </table>
            </td>
        </tr>
    </form>
    
    <!-- Search form ends here -->
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    
    <!-- Related Item Section -->
    <?php echo $view['actions']->render('YxBundle:Box:related'); ?>
    <!-- Related Item Section -->
    
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <!-- Whats Hot & Funny Section -->
        <?php echo $view['actions']->render('YxBundle:Box:jokes'); ?>
    <!-- Whats Hot & Funny Section -->

    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="3" align="center">
            <OBJECT id="slideshow" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" WIDTH="176" HEIGHT="271"  align="middle">
                <PARAM NAME=movie VALUE="/flash/banner1.swf">
                <PARAM NAME=quality VALUE=high>
                <PARAM NAME=allowScriptAccess VALUE=sameDomain>
                <PARAM NAME=bgcolor VALUE=#ffffff>
                <EMBED Name="slideshow" src="/flash/banner1.swf" quality=high bgcolor=#FFFFFF WIDTH="176" HEIGHT="271" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED>
            </OBJECT>	

        </td>
    </tr>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
</table>