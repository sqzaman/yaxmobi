<?php $view->extend('YxBundle:layout:base.html.php') ?>

<?php $view['slots']->start('body') ?>

<table border="0" cellspacing="0" cellpadding="0" class="container">
    <tr>
        <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
        <td class="navwhitetext">Subscriptions - Compare All</td>
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
                    <td align="right"><a class="blue_btn_a" href="javascript: void history.go(-1);"><div class="blue_btn">Back</div></a></td>
                </tr>
                <tr>
                    <td>
                        <div id='tasks_todo'>

                            <table width='100%' cellpadding='1' border="1">
                                <tr bgcolor='#0a71dc' class='txtHeadingwhite'>
                                    <td colspan='6' class='txtHeadingwhite' align='left'><?
if ((intval($user['id']) > 0) && (intval($users['id_subscript']) != 0)) {
    ?> <a href="/subscriptions/all"><b>All Subscriptions</b></a> || <a
                                                href="/subscriptions/my">My Subscription</a> <?
                                    }
?></td>

                                </tr>

                                <?php if (intval($user['id_subscript']) > 0) { ?>
                                    <tr>
                                        <td colspan='7'>

                                            <table width='100%' cellpadding='4' cellspacing='1'>
                                                <tr class='txtHeadingwhite'>
                                                    <td class='txtHeadingOrange' valign='top'>
                                                        <table width='100%'>
                                                            <tr>
                                                                <td><?php echo $types['name']; ?><br>
                                                                    You have <?php print $user['count_joke']; ?> Joke(s)<br>
                                                                    You have <?php print $user['count_ring']; ?> Ringtone(s)<br>
                                                                    <?php if ($user['count_joke'] > 0) print 'Jokes delivery every ' . $types['per_joke'] . ' day(s)'; ?><br>
                                                                    <?php if ($user['count_ring'] > 0) print 'Ringtones delivery every ' . $types['per_ring'] . ' day(s)'; ?>
                                                                    <br>
                                                                    Subscription Date: <?php print $user['date_subscript']; ?></td>
                                                                <td valign=center align=right><a
                                                                        href="/subscriptions/instruction"><b>HOW TO UNSUBSCRIBE</b></a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <!-- tr>
                                <td colspan="3">
                                     <center><OBJECT id="slideshow" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" WIDTH="317" HEIGHT="136"  id="test" align="middle"> <PARAM NAME=movie VALUE="/flash/subscript.swf">
<PARAM NAME=quality VALUE=high> 
<PARAM NAME=allowScriptAccess VALUE=sameDomain> 
<PARAM NAME=bgcolor VALUE=#000000><EMBED Name="slideshow" src="/flash/subscript.swf" quality=high bgcolor=#FFFFFF WIDTH="500" HEIGHT="136" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED></OBJECT></center>
                </td>                                        
                        </tr-->


                                <tr>
                                    <td colspan='3' align='left'>
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td width="1">
                                                    <img src="/img/images/t01.gif" border="0" width="5" height="28" />
                                                </td>
                                                <td width="100%" class="navwhitetext" style="background-image: url('/img/images/t02.gif'); background-repeat: repeat-x;">
                                                    Monthly Subscription Service: Audio Jokes
                                                </td>
                                                <td width="1" align="right">
                                                    <img src="/img/images/t03.gif" border="0" width="5" height="28" />
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <?php
                                $color = '#e5e5e5';
                                $counter = 1;
                                if (count($subscriptions) > 0)
                                    foreach ($subscriptions as $doc)
                                        if ((intval($doc['count_joke']) > 0) && (intval($doc['count_ring'] == 0))) {
                                            if ($color == '#e5e5e5')
                                                $color = '#FFFFFF'; else
                                                $color = '#e5e5e5';
                                            $doc = $doc;
                                            ?>

                                            <tr id="<?php echo $counter; ?>" bgcolor="<?php echo $color ?>" onmouseover="Javascript: void roll_over('<?php echo $color; ?>', this.id);" onmouseout="javascript: void roll_over_restore('<?php echo $color; ?>', this.id);">
                                                <td width="1%"><nobr><b>Subscription Title:</b></nobr><br>
                                            <nobr><b>Number of jokes:</b></nobr><br>
                                            <nobr><b>Price (monthly):</b></nobr><br>
                                            <nobr><b>Frequency of jokes delivery:</b></nobr><br>
                                            <nobr><b>Type(s) of delivery:</b></nobr><br>
                                            </td>
                                            <td width="99%"><nobr><?php echo $doc['name'] ?></nobr><br>
                                            <nobr> <?php echo $doc['count_joke'] ?></nobr><br>
                                            <nobr> $ <?php echo $doc['price'] ?></nobr><br>
                                            <nobr> Every <?php echo $doc['per_joke'] ?> day<?php if ($doc['per_joke'] > 1) print 's'; ?></nobr><br>
                                            <nobr> <?php
                                if ($doc['delivery_mail'] == '+')
                                    print 'E-mail &nbsp;';
                                if ($doc['delivery_phone'] == '+')
                                    print 'Phone &nbsp;';
                                            ?></nobr><br>
                                            </td>
                                            <?php
                                            if (intval($users['id_subscript']) == 0) {
                                                ?>
                                                <td valign="center"><?
                                if (intval($user['id']) > 0)
                                    print '<form method="post" action= "https://www.paypal.com/cgi-bin/webscr">';
                                else
                                    print '<form method="post" action= "/users/login">';
                                                ?> <input type="hidden" name="cmd" value="_xclick-subscriptions">
                                                    <input type="hidden" name="business"
                                                           value="marlonjean72@yahoo.com"> <input type="hidden"
                                                           name="item_name" value="Subscription <?php echo $doc['name'] ?>"> <input
                                                           type="hidden" name="item_number" value="<?php echo $doc['id'] ?>"> <input
                                                           type="hidden" name="custom" value="<?php echo $user['id'] ?>"> <input
                                                           type="hidden" name="no_shipping" value="0"> <input type="hidden"
                                                           name="return" value="http://yaxmobi.com/subscriptions/all"> <input
                                                           type="hidden" name="rm" value="1"> <input type="hidden"
                                                           name="cancel_return" value="http://yaxmobi.com/subscriptions/all">
                                                    <input type="hidden" name="no_shipping" value="1"> <input
                                                        type="hidden" name="currency_code" value="USD"> <input
                                                        type="hidden" name="notify_url"
                                                        value="http://www.yaxmobi.com/subscriptions/ipn"> <input
                                                        type="hidden" name="a3" value="<?php echo $doc['price'] ?>"> <input
                                                        type="hidden" name="p3" value="1"> <input type="hidden"
                                                        name="src" value="1"> <input type="hidden" name="t3" value="M"> <input
                                                        type="hidden" name="usr_manage" value="0"> <?php
                                    if (intval($user['id']) > 0) {
                                        ?> <input type="submit" name="submit"
                                                               onclick="if (<?php echo intval($user['carrier']) ?> != 0 && '<?php echo ('r' . $user['mobilephone']) ?>' != 'r') document.frm.submit(); else alert('Please go in profile and enter phone and carrier');return false;"
                                                               value="Subscribe"> <?php
                                    } else {
                                        ?> <input type="submit" name="submit"
                                                               onclick="if (<?php echo intval($user['id']) ?> != 0) document.frm.submit(); else window.location='http://yaxmobi.com/users/login';"
                                                               value="Subscribe"> <?php } ?>
                                                    </FORM>
                                                </td>
                <?
            }
            ?>
                                            </tr>


                                            <?php
                                            $counter++;
                                        }
                                ?>



                                <tr>
                                    <td colspan='3' align='left'>
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td width="1">
                                                    <img src="/img/images/t01.gif" border="0" width="5" height="28" />
                                                </td>
                                                <td width="100%" class="navwhitetext" style="background-image: url('/img/images/t02.gif'); background-repeat: repeat-x;">
                                                    Monthly Subscription Service: Ringtones
                                                </td>
                                                <td width="1" align="right">
                                                    <img src="/img/images/t03.gif" border="0" width="5" height="28" />
                                                </td>
                                            </tr>
                                        </table>

                                    </td>
                                </tr>
<?php
$color = '#162c3e';
if (count($subscriptions) > 0)
    foreach ($subscriptions as $doc)
        if ((intval($doc['count_joke']) == 0) && (intval($doc['count_ring'] > 0))) {
            if ($color == '#e5e5e5')
                $color = '#FFFFFF'; else
                $color = '#e5e5e5';
            $doc = $doc;
            ?>

                                            <tr id="<?php echo $counter; ?>" bgcolor="<?php echo $color ?>" onmouseover="Javascript: void roll_over('<?php echo $color; ?>', this.id);" onmouseout="javascript: void roll_over_restore('<?php echo $color; ?>', this.id);">
                                                <td><nobr><b>Subscription Title:</b></nobr><br>
                                            <nobr><b>Number of ringtones:</b></nobr><br>
                                            <nobr><b>Price (monthly):</b></nobr><br>
                                            <nobr><b>Frequency of ringtones delivery:</b></nobr><br>
                                            <nobr><b>Type(s) of delivery:</b></nobr><br>

                                            </td>
                                            <td><nobr> <?php echo $doc['name'] ?></nobr><br>
                                            <nobr> <?php echo $doc['count_ring'] ?></nobr><br>
                                            <nobr> $ <?php echo $doc['price'] ?></nobr><br>
                                            <nobr> Every <?php echo $doc['per_ring'] ?> day<?php if ($doc['per_ring'] > 1) print 's'; ?></nobr><br>

                                            <nobr> <?php
                                if ($doc['delivery_mail'] == '+')
                                    print 'E-mail &nbsp;';
                                if ($doc['delivery_phone'] == '+')
                                    print 'Phone &nbsp;';
            ?></nobr><br>
                                            </td>
                                                <?php
                                                if (intval($users['id_subscript']) == 0) {
                                                    ?>
                                                <td valign="center"><?
                                                    if (intval($user['id']) > 0)
                                                        print '<form method="post" action= "https://www.paypal.com/cgi-bin/webscr">';
                                                    else
                                                        print '<form method="post" action= "/users/login">';
                                                    ?> <input type="hidden" name="cmd" value="_xclick-subscriptions">
                                                    <input type="hidden" name="business"
                                                           value="marlonjean72@yahoo.com"> <input type="hidden"
                                                           name="item_name" value="Subscription <?php echo $doc['name'] ?>"> <input
                                                           type="hidden" name="item_number" value="<?php echo $doc['id'] ?>"> <input
                                                           type="hidden" name="custom" value="<?php echo $user['id'] ?>"> <input
                                                           type="hidden" name="no_shipping" value="0"> <input type="hidden"
                                                           name="src" value="1"> <input type="hidden" name="return"
                                                           value="http://yaxmobi.com/subscriptions/all"> <input
                                                           type="hidden" name="rm" value="1"> <input type="hidden"
                                                           name="cancel_return" value="http://yaxmobi.com/subscriptions/all">
                                                    <input type="hidden" name="no_shipping" value="1"> <input
                                                        type="hidden" name="currency_code" value="USD"> <input
                                                        type="hidden" name="notify_url"
                                                        value="http://www.yaxmobi.com/subscriptions/ipn"> <input
                                                        type="hidden" name="a3" value="<?php echo $doc['price'] ?>"> <input
                                                        type="hidden" name="p3" value="1"> <input type="hidden" name="t3"
                                                        value="M"> <input type="hidden" name="usr_manage" value="0"> <input
                                                        type="submit" name="submit" value="Subscribe">
                                                    </FORM>
                                                </td>
                <?
            }
            ?>
                                            </tr>


                                            <?php
                                            $counter++;
                                        }
                                ?>




                                <tr>
                                    <td colspan='3' width="100%" align='left'>
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td width="1">
                                                    <img src="/img/images/t01.gif" border="0" width="5" height="28" />
                                                </td>
                                                <td width="100%" class="navwhitetext" style="background-image: url('/img/images/t02.gif'); background-repeat: repeat-x;">
                                                    Monthly Subscription Service: Hybrid (Audio Jokes + Ringtones)
                                                </td>
                                                <td width="1" align="right">
                                                    <img src="/img/images/t03.gif" border="0" width="5" height="28" />
                                                </td>
                                            </tr>
                                        </table>

                                    </td>
                                </tr>
<?php
$color = '#e5e5e5';
if (count($subscriptions) > 0)
    foreach ($subscriptions as $doc)
        if ((intval($doc['count_joke']) > 0) && (intval($doc['count_ring'] > 0))) {
            if ($color == '#e5e5e5')
                $color = '#FFFFFF'; else
                $color = '#e5e5e5';
            $doc = $doc;
            ?>

                                            <tr id="<?php echo $counter; ?>" bgcolor="<?php echo $color ?>" onmouseover="Javascript: void roll_over('<?php echo $color; ?>', this.id);" onmouseout="javascript: void roll_over_restore('<?php echo $color; ?>', this.id);">
                                                <td><nobr><b>Subscription Title:</b></nobr><br>
                                            <nobr><b>Number of jokes:</b></nobr><br>
                                            <nobr><b>Number of ringtones:</b></nobr><br>
                                            <nobr><b>Price (monthly):</b></nobr><br>
                                            <nobr><b>Frequency of jokes delivery:</b></nobr><br>
                                            <nobr><b>Frequency of ringtones delivery:</b></nobr><br>
                                            <nobr><b>Type(s) of delivery:</b></nobr><br>

                                            </td>
                                            <td><nobr><?php echo $doc['name'] ?></nobr><br>
                                            <nobr> <?php echo $doc['count_joke'] ?></nobr><br>
                                            <nobr> <?php echo $doc['count_ring'] ?></nobr><br>
                                            <nobr> $ <?php echo $doc['price'] ?></nobr><br>
                                            <nobr> Every <?php echo $doc['per_joke'] ?> day<?php if ($doc['per_joke'] > 1) print 's'; ?></nobr><br>
                                            <nobr> Every <?php echo $doc['per_ring'] ?> day<?php if ($doc['per_ring'] > 1) print 's'; ?></nobr><br>

                                            <nobr> <?php
                                if ($doc['delivery_mail'] == '+')
                                    print 'E-mail &nbsp;';
                                if ($doc['delivery_phone'] == '+')
                                    print 'Phone &nbsp;';
            ?></nobr><br>
                                            </td>
                                                <?php
                                                if (intval($users['id_subscript']) == 0) {
                                                    ?>
                                                <td valign="center"><?
                                                    if (intval($user['id']) > 0)
                                                        print '<form method="post" action= "https://www.paypal.com/cgi-bin/webscr">';
                                                    else
                                                        print '<form method="post" action= "/users/login">';
                                                    ?> <input type="hidden" name="cmd" value="_xclick-subscriptions">
                                                    <input type="hidden" name="business"
                                                           value="marlonjean72@yahoo.com"> <input type="hidden"
                                                           name="item_name" value="Subscription <?php echo $doc['name'] ?>"> <input
                                                           type="hidden" name="item_number" value="<?php echo $doc['id'] ?>"> <input
                                                           type="hidden" name="custom" value="<?php echo $user['id'] ?>"> <input
                                                           type="hidden" name="no_shipping" value="0"> <input type="hidden"
                                                           name="src" value="1"> <input type="hidden" name="return"
                                                           value="http://yaxmobi.com/subscriptions/all"> <input
                                                           type="hidden" name="rm" value="1"> <input type="hidden"
                                                           name="cancel_return" value="http://yaxmobi.com/subscriptions/all">
                                                    <input type="hidden" name="no_shipping" value="1"> <input
                                                        type="hidden" name="currency_code" value="USD"> <input
                                                        type="hidden" name="notify_url"
                                                        value="http://www.yaxmobi.com/subscriptions/ipn"> <input
                                                        type="hidden" name="a3" value="<?php echo $doc['price'] ?>"> <input
                                                        type="hidden" name="p3" value="1"> <input type="hidden" name="t3"
                                                        value="M"> <input type="hidden" name="usr_manage" value="0"> <input
                                                        type="submit" name="submit" value="Subscribe">
                                                    </FORM>
                                                </td>
                <?
            }
            ?>
                                            </tr>

                                            <?php
                                            $counter++;
                                        }
                                ?>

                            </table>
                            </form>
                        </div>

                    </td>
                </tr>
                <tr>
                    <td align="right"><a class="blue_btn_a" href="javascript: void history.go(-1);"><div class="blue_btn">Back</div></a></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<?php $view['slots']->stop() ?>