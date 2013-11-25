

<table width="175" border="0" cellspacing="0" cellpadding="0">
    <?php
        
        if ( isset($loggedIn) && $loggedIn ){
            echo $view->render('YxBundle:Box:member.html.php', array('displayName' => $displayName) );
        }else{
            echo $view->render('YxBundle:Box:nonMemberMenu.html.php');
        }
    ?>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
        <td width="173" class="navwhitetext"			style="background-image: url(/img/images/t02.gif); background-repeat: repeat-x;">&nbsp;&nbsp;Latest
            Celebrity News</td>
        <td width="1" align="right"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
    </tr>
    <tr>
        <td colspan="3" align="center"
            style="border-bottom: #4c4c4c 1px solid; border-left: #4c4c4c 1px solid; border-right: #4c4c4c 1px solid">
            <table width="98%" border="0" cellspacing="0" cellpadding="5">
                <tr>
                    <td height="10"></td>
                </tr>
                <tr>
                    <td><iframe src="/files/rss_reader.php"
                                FRAMEBORDER='0' width="160" height="200"></iframe></td>
                </tr>
                <tr>
                    <td height="10" style="background-image: url(/img/images/dotted_line.gif); background-repeat: repeat-x;"></td>
                </tr>
                <tr>
                    <td height="10"></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="3" align="center"><embed
                src="http://flash.textmarks.com/flash/widgets-01/current-sub-01.swf?v=2.49a-BETA"
                flashvars="tm=YAXMOBI&Tint1Col=fe0000&Tint1Pct=100" quality="high"
                bgcolor="#ffffff" wmode="transparent" width="150" height="230"
                align="middle" name="TM-Flash-Widget"
                allowScriptAccess="sameDomain" type="application/x-shockwave-flash"
                pluginspage="http://www.macromedia.com/go/getflashplayer" /></td>
    </tr>
    <tr>
        <td height="10" colspan="3" align="center"></td>
    </tr>
    <tr>
        <td colspan="3" align="center"><a
                href="http://www.textmarks.com/widget/gallery/" class="pagelink"><strong>Get
                    your own at TextMarks! </strong></a></td>
    </tr>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
        <td width="173" class="navwhitetext" style="background-image: url(/img/images/t02.gif); background-repeat: repeat-x;">&nbsp;&nbsp;Join Our Mailing List</td>
        <td width="1" align="right"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
    </tr>
    <tr>
        <td colspan="3" align="center"
            style="border-bottom: #4c4c4c 1px solid; border-left: #4c4c4c 1px solid; border-right: #4c4c4c 1px solid">
            <form name="mailing_list" action="/mailinglists/join" method="post" onsubmit="return chkMailingForm();">
                <table width="98%" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                        <td height="10"></td>
                    </tr>
                    <tr>
                        <td>Email <input name="data[Mailinglist][email]"  size="20" class="tf" value="" type="text" id="MailinglistEmail" /></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Join" class="submit_btn"></td>
                    </tr>
                    <tr>
                        <td height="10"></td>
                    </tr>
                </table>
            </form>
        </td>
    </tr>
</table>