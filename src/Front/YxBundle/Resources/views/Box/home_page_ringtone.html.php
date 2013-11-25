<?php 
	$playlist = '';
	if (is_array($songFile)){
            foreach ($songFile as $v){
                $playlist .= MY_SITE_URL . "tone/" . $v . "|";	
            }
	}
	$playlist = substr($playlist,0,-1);
	//echo $playlist;
?>
<!-- START WIMPY PLAYER CODE -->
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,47,0" width="428" height="102" id="wimpy1540">
<param name="allowScriptAccess" value="always" />
<param name="movie" value="http://www.yaxmobi.com/rave/rave.swf" />
<param name="loop" value="false" />
<param name="menu" value="false" />
<param name="quality" value="high" />
<param name="scale" value="noscale" />
<param name="salign" value="lt" />
<param name="bgcolor" value="000000" />
<param name="flashvars" value="wimpyApp=http://www.yaxmobi.com/rave/rave.php&wimpySkin=http://www.yaxmobi.com/rave/skins/myskin/skin_myskin.xml&startPlayingOnload=no" />
<embed src="http://www.yaxmobi.com/rave/rave.swf" flashvars="wimpyApp=http://www.yaxmobi.com/rave/rave.php&wimpySkin=http://www.yaxmobi.com/rave/skins/myskin/skin_myskin.xml&playlist=<?php echo $playlist; ?>&wimpyReg=NmslMjMlM0JvcDZKayU3RkhNaEIlMkNHclY5JTVFV2ZTJTdCOFlHN25m&startPlayingOnload=no" loop="false" menu="false" quality="high" width="428" height="105" scale="noscale" salign="lt" name="wimpy1540" align="center" bgcolor="000000" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>
<!-- END WIMPY PLAYER CODE -->
