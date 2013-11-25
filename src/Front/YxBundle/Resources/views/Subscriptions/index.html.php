<?php $view->extend('YxBundle:layout:base.html.php') ?>

<?php $view['slots']->start('body') ?>

<table border="0" cellspacing="0" cellpadding="0" class="container">
    <tr>
        <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
        <td class="navwhitetext">Subscriptions</td>
        <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
    </tr>
    <tr>
        <td colspan="3" align="center" width="100%">
            <OBJECT id="slideshow"
			classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
			codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0"
			WIDTH="429" HEIGHT="144" align="middle">
			<PARAM NAME=movie VALUE="/flash/yaxmobi_subscription.swf">
			<PARAM NAME=quality VALUE=high>
			<PARAM NAME=allowScriptAccess VALUE=sameDomain>
			<EMBED Name="slideshow" src="/flash/yaxmobi_subscription.swf"
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
                                <td width="50%" align="right">
                                    <a href="/subscriptions/a_la_carte"><div class="blue_btn_sp2">A La Carte</div></a>
                                </td>
                                <td align="left">
                                    <a href="/subscriptions/ringtone"><div class="blue_btn_sp2">Ringtone Plans</div></a>
                                </td>
                            </tr>
                            <tr>
                                <td align="right">
                                    <a href="/subscriptions/audio_joke"><div class="blue_btn_sp2">Audio Jokes Plans</div></a>
                                </td>
                                <td align="left">
                                    <a href="/subscriptions/combo_plan"><div class="blue_btn_sp2">Combo Plans</div></a>
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