<style>
    body{
        background-image: url("/img/images/page_bg.gif");
        background-repeat: repeat-x;
        font-family: Tahoma,Arial,Helvetica,sans-serif;
        font-size: 11px;
        line-height: 16px;
        margin: 0;
        vertical-align: top;
    }
    
    *{
        font-size: 11px;
        line-height: 16px;
    }
    
</style>
<script>
    function chkForm(frm)
    {
        var t = 0;
        for (var i = 0; i <frm.elements.length; i++)
        {
            if (frm.elements[i].type == 'radio' && frm.elements[i].checked == true)
            {
                t++;
            }
        }

        if (t == 0)
        {
            alert('Please select you rating.');
            return false;
        }
    }
</script>
<table width='100%' cellspacing="0" cellpadding="0">
    <tr>
        <td class='tableHeading'>
            <table width='100%' cellspacing='3' cellpadding='3' border='1'>
                <tr>
                    <td class='tdBottomBorder' align='left'>
                        <a href="<?php echo MY_SITE_URL;?>" target="_blank">
                            <img src='/img/images/ym_logo2.gif' border='0'>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td align='left'>
                        <table>
                            <tr>
                                <td valign="bottom" align='center'>
                                    <form name="form1" action="/ratings/add/" method="post" onsubmit="return chkForm(this);">
                                        <TABLE>
                                            <TR>
                                                <TD colspan='3'>Rate this <?php echo $label ?></TD>
                                            </TR>
                                            <?
                                            if ($errorMessage != '') {
                                                echo "<TR>
                                                            <TD colspan='3' class='error'>" . $errorMessage . "</TD>
                                                    </TR>";
                                            }
                                            ?>
                                            <TR>
                                                <TD>
                                                    <input type="hidden" name="Rating[user_id]" value="<?php echo $user_id?>" />
                                                    <input type="hidden" name="Rating[joke_id]" value="<?php echo $id?>" />
                                                    <input type="hidden" name="Rating[joke_type]" value="1" />
                                                    
                                                    <table border="1">
                                                        <tr align='center'>
                                                            <td width='125' height='25'>
                                                                <img src="/img/rating_images/smiley1.gif">
                                                            </td>
                                                            <td width='125' >
                                                                <img src="/img/rating_images/smiley2.gif">
                                                            </td>
                                                            <td width='125' >
                                                                <img src="/img/rating_images/smiley3.gif">
                                                            </td>
                                                            <td width='125' >
                                                                <img src="/img/rating_images/smiley4.gif">
                                                            </td>
                                                            <td width='125' >
                                                                <img src="/img/rating_images/smiley5.gif">
                                                            </td>
                                                        </tr>
                                                        <tr align='center'>
                                                            <td BACKGROUND="/img/rating_images/1.gif" align='center' width='125'  height='25'>
                                                                <input type="radio" name="Rating[user_rating]" value="1" />
                                                            </td>
                                                            <td BACKGROUND="/img/rating_images/2.gif" width='125' >
                                                                <input type="radio" name="Rating[user_rating]" value="2" />
                                                            </td>
                                                            <td BACKGROUND="/img/rating_images/3.gif" width='125' >
                                                                <input type="radio" name="Rating[user_rating]" value="3" />
                                                            </td>
                                                            <td BACKGROUND="/img/rating_images/4.gif" width='125' >
                                                                <input type="radio" name="Rating[user_rating]" value="4" />
                                                            </td>
                                                            <td BACKGROUND="/img/rating_images/5.gif" width='125' >
                                                                <input type="radio" name="Rating[user_rating]" value="5" />
                                                            </td>
                                                        </tr>
                                                        <tr align='center' class="small">
                                                            <td nowrap class="small">What was that?</td>
                                                            <td nowrap class="small">Not bad...</td>
                                                            <td nowrap class="small">That was pretty funny!</td>
                                                            <td nowrap class="small">Wow, that's hilarious!!</td>
                                                            <td nowrap class="small">Help! My belly's hurting!!!</td>
                                                        </tr>
                                                    </table>
                                                </TD>
                                                <TD>&nbsp;</TD>
                                                <TD align='left' style="padding-top:16px;"><input type="submit" class="buttonGreen" value="Rate"></TD>
                                            </TR>
                                        </TABLE>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td>
            <?php echo $view['actions']->render('YxBundle:Tickers:index'); ?>
        </td>
    </tr>

</table>