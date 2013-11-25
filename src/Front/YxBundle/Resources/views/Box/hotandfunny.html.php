<tr>
    <td colspan="3">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
                    <td class="navwhitetext">&nbsp;&nbsp;What's Hot &amp; Funny</td>
                    <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
                </tr>
            </table>
    </td>
</tr>
<tr>
    <td colspan="3" align="center"	style="border-bottom: #4c4c4c 1px solid; border-left: #4c4c4c 1px solid; border-right: #4c4c4c 1px solid">
<table width="98%" border="0" cellspacing="0" cellpadding="5">
    <tr>
        <td height="10" style="background-color: #e5e5e5;font-weight:bold;color:#5d5da1;">Top 10 Audio Jokes</td>
    </tr>
    <tr>
        <td align='left'>
            <!-- Audio Joke section Starts -->
            <?php
                if (count ($audioJokes) > 0):
                    $li = '';
                    $link = '';
                    foreach ( $audioJokes as $v ):
                    //echo "<pre>"; print_r($v);die;
                        $link = "/songs/preview/" . $v['id'];
                        $li .= "<p><a class='pagelink' href='". $link ."'>". $v['composition']."</a></p>";
                    endforeach;
                    echo "<div style='width:150px;height:100px; padding: 7px; overflow: auto;'>$li<div>";
                endif;
            ?>
            <!-- Audio Joke section Starts -->
        </td>
    </tr>
    <tr>
        <td height="10" style="background-color: #e5e5e5;font-weight:bold;color:#5d5da1;">Top 10 Ringtones</td>
    </tr>
    <tr>
        <td align='left'>
            <?php
                if (count ($ringtone) > 0):
                    $li = '';
                    $link = '';
                    foreach ( $ringtone as $v ):
                    //
                        $link = "/ringtones/preview/" . $v['id'];
                        $li .= "<p><a class='pagelink' href='". $link ."'>". $v['title']."</a></p>";
                    endforeach;
                    echo "<div style='width:150px;height:100px; padding: 7px; overflow: auto;'>$li<div>";
                endif;
            ?>
        </td>
    </tr>
</table>
    </td>
</tr>