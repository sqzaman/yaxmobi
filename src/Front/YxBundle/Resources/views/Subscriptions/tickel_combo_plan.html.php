<table width="428" border="0" cellpadding="0" cellspacing="0" >
    <!-- All Tab Section -->
    <tr>
        <td width="418" colspan="2" align="left">
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="1">
                        <img src="/img/images/t01.gif" border="0" width="5" height="28" />
                    </td>
                    <td width="10" style="background-image: url('/img/images/t02.gif'); background-repeat: repeat-x;">
                        <a href="/subscriptions/combo_plan_subscription/1/" class="navwhitelink change-tab">Tickle</a>
                    </td>
                    <td width="1">
                        <img src="/img/images/t03.gif" border="0" width="6" height="28" />
                    </td>
                    <td width="2">&nbsp;</td>
                    <td width="1">
                        <img src="/img/images/t01d.gif" border="0" width="5" height="28" />
                    </td>
                    <td width="10" style="background-image: url('/img/images/t02d.gif'); background-repeat: repeat-x;">
                        <a href="/subscriptions/combo_plan_subscription/2/" class="navgraylink change-tab">Tickle&nbsp;+&nbsp;Send&nbsp;To&nbsp;Phone</a>
                    </td>
                    <td width="1">
                        <img src="/img/images/t03d.gif" border="0" width="5" height="28" />
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <!-- All Tab Section -->
    <!-- Audio Joke -->
    <tr>
        <td colspan="2" width="100%" align="center" style="border: #4c4c4c 1px solid;" bgcolor='#bcbcee'>
            <table width="100%" border="0" cellspacing="0" cellpadding="2">
                <tr>

                    <td width="100%">
                        <table width="100%" border="0" bgcolor="#ffffff">
                            <tr>
                                <td align="center">
                                    <table border="0" width="100%" bgcolor="#ffffff">
                                        <tr>
                                            <td align="center"><b><?php echo $planTitle; ?></b></td>
                                        </tr>
                                        <?php
                                        if (count($plan) > 0) {
                                            for ($i = 0; $i <= count($plan) - 1; $i++) {
                                                ?>

                                                <tr>
                                                    <td width="100%">
                                                        <table border="0" cellpadding="5" cellspacing="1"  width="100%">
                                                            <tr>
                                                                <td width="200">Subscription Title</td>
                                                                <td width='1'>&nbsp;</td>
                                                                <td><?php echo $plan[$i]['name']; ?></td>
                                                            </tr>
                                                            <tr bgcolor="#CCCCCC">
                                                                <td>Number of Jokes</td>
                                                                <td>&nbsp;</td>
                                                                <td><?php echo $plan[$i]['count_joke']; ?></td>
                                                            </tr>
                                                            <tr bgcolor="#CCCCCC">
                                                                <td>Number of Ringtones</td>
                                                                <td>&nbsp;</td>
                                                                <td><?php echo $plan[$i]['count_ring']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Price (Monthly)</td>
                                                                <td>&nbsp;</td>
                                                                <td>$ <?php echo $plan[$i]['price']; ?></td>
                                                            </tr>
                                                            <tr bgcolor="#CCCCCC">
                                                                <td>Frequency of Jokes Delivery</td>
                                                                <td>&nbsp;</td>
                                                                <td>Every <?php echo $plan[$i]['per_joke']; ?> days</td>
                                                            </tr>
                                                            <tr bgcolor="#CCCCCC">
                                                                <td>Frequency of Ringtone Delivery</td>
                                                                <td>&nbsp;</td>
                                                                <td>Every <?php echo $plan[$i]['per_ring']; ?> days</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Type(s) of Delivery</td>
                                                                <td>&nbsp;</td>
                                                                <td>
        <?php
        if ($plan[$i]['delivery_mail'] == '+')
            print 'E-mail &nbsp;';
        if ($plan[$i]['delivery_phone'] == '+')
            print 'Phone &nbsp;';
        ?>
                                                                </td>
                                                            </tr>	
                                                            <tr>
                                                                <td align="center" colspan='3'>
        <?php
        if (intval($users['id_subscript']) == 0) {
            if (intval($user['id']) > 0)
                print '<form method="post" action= "https://www.paypal.com/cgi-bin/webscr">';
            else
                print '<form method="post" action= "/users/login">';
            ?> 
                                                                        <input type="hidden" name="cmd" value="_xclick-subscriptions">
                                                                        <input type="hidden" name="business"value="marlonjean72@yahoo.com"> 
                                                                        <input type="hidden" name="item_name" value="Subscription <?php echo $plan[$i]['name'] ?>"> 
                                                                        <input type="hidden" name="item_number" value="<?php echo $plan[$i]['id'] ?>"> 
                                                                        <input type="hidden" name="custom" value="<?php echo $user['id'] ?>"> 
                                                                        <input type="hidden" name="no_shipping" value="0"> 
                                                                        <input type="hidden" name="src" value="1"> 
                                                                        <input type="hidden" name="return" value="http://yaxmobi.com/subscriptions/all"> 
                                                                        <input type="hidden" name="rm" value="1"> 
                                                                        <input type="hidden" name="cancel_return" value="http://yaxmobi.com/subscriptions/index">
                                                                        <input type="hidden" name="no_shipping" value="1"> 
                                                                        <input type="hidden" name="currency_code" value="USD"> 
                                                                        <input type="hidden" name="notify_url" value="http://www.yaxmobi.com/subscriptions/ipn"> 
                                                                        <input type="hidden" name="a3" value="<?php echo $plan[$i]['price'] ?>"> 
                                                                        <input type="hidden" name="p3" value="1"> 
                                                                        <input type="hidden" name="t3" value="M"> 
                                                                        <input type="hidden" name="usr_manage" value="0"> 
                                                                        <input type="submit" name="submit" value="Subscribe" class="submit_btn">
                                                                        </FORM>
                                                                    </td>
            <?
        }
        ?>
                                                                </td>
                                                            </tr>
                                                                <?php
                                                                //$plan[$i]['Subscription']['image'] != '' ? $image = 'genres/' . $songcat[$i]['Genre']['image'] : $image = 'images/blondes.gif'; 
                                                                //echo $html->image($image , array('border'=>'0', 'width'=>'65', 'height'=>'65'));
                                                                //echo $html->link($html->image($image , array('border'=>'0', 'width'=>'65', 'height'=>'65')),'/songs/genre/'.$songcat[$i]['Genre']['id'], array("class" => "pagelink")); 
                                                                ?>




                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center">
                                                        &nbsp;<b><?php //echo $html->link($songcat[$i]['Genre']['gname'],'/songs/genre/'.$songcat[$i]['Genre']['id'], array("class" => "pagelink"));
                                                    ?></b>
                                                    </td>
                                                </tr>

        <?php
        //if (($i+1) % 4 == 0)
        //echo "</tr><tr>";
    }
}else {
    ?>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td align="center">Currently there are no plans in thsi category.</td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
    <?php
}
?>
                                        <tr>
                                            <td align="right">I would like to compare all Plans&nbsp;
                                                <input type="button" class="submit_btn" value="Compare All" onclick="Javascript: location.href='/subscriptions/all';">
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>

                </tr>
            </table>
        </td>
    </tr>
    <!-- Audio Joke -->
</table>