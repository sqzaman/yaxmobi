<?php $view->extend('YxBundle:layout:base.html.php') ?>

<?php $view['slots']->start('body') ?>
<script type="text/javascript" src="/js/jquery/jquery.validate.min.js"></script>

<script>
$ = jQuery;
jQuery(function(){
    
    $('#theForm').validate();
    
    $('#smsForm').validate();
    
});

</script>

<table border="0" cellspacing="0" cellpadding="0" class="container">
    <tr>
        <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
        <td class="navwhitetext">Tell A Friend-By Email</td>
        <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
    </tr>
    <tr>
        <td colspan="3" align="center" width="100%">
            <table width="100%" border="0" align="center">
                <?php
                if (!isset($errMessage))
                    $errMessage = '';
                if (!isset($capch))
                    $capch = '';
                if ($errMessage != '' || $capch != '') {
                    echo "<tr><td colspan='2' class='error'>" . $errMessage . '<br>' . $capch . "</td></tr>";
                }
                ?>
                <tr>
                    <td bgcolor="#bbbbbb">
                        <table width="100%" border='0' bgcolor="#ffffff">
                            <tr>
                                <td colspan="2" align="left">Be a good friend: share the laughter!
                                    Please use the form below to spread the word about yaxmobi.com: the
                                    only place to find great audio jokes and the best funny ringtones.
                                    They'll thank you for it!</td>
                            </tr>
                            <tr>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                            <form id="theForm" name="theForm" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                <input type="hidden" name="taf" value="<?php print $_SERVER['REQUEST_URI']; ?>">
                                <tr>
                                    <td align="left" width="100">First Name</td>
                                    <td align="left">
                                        <input class="required" type="text" name="tellafriend[fname]" value="" size="40">
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left">Last Name</td>
                                    <td align="left">
                                        <input class="required" type="text" name="tellafriend[lname]" value="" size="40">
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left">Email</td>
                                    <td align="left">
                                        <input class="required" type="text" name="tellafriend[myemail]" value="" size="40">
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">Friend's Email</td>
                                    <td valign="top" align="left">
                                        <input type="hidden" name="tellafriend[user_id]" value="<?php echo $user_id;?>">
                                        <input type="hidden" name="tellafriend[id]" value="<?php echo $songId;?>">
                                        <input type="hidden" name="tellafriend[songType]" value="<?php echo $songType;?>">
                                        <nobr>
                                        <textarea class="required" name="tellafriend[friendemailadd]" row="20" cols="30" id="TellafriendFriendemailadd"></textarea>
                                            <a
                                                href="javascript:void(0);"
                                                onclick="popUp('<?php echo MY_SITE_URL ;?>invite/index.php'); return false;">
                                                <img src="/img/add_button.gif" border="0" /></a>
                                        </nobr>
                                        <br>
                                (xyz@xyz.com,xyz@xyz.com....)</td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">Feedback</td>
                                    <?
                                    $mailMessage = 'Hello,
                                    I thought you might like this website and all the hilarious clips it offers.';
                                    ?>
                                    <td align="left" valign="top">
                                        <textarea name="tellafriend[message]" row="20" cols="30" id="TellafriendMessage"><?php echo $mailMessage;?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td align="left">
                                        <input type="submit" value="Tell A Friend" class="submit_btn">
                                    </td>
                                </tr>
                            </form>
                        </table>
                    </td>
                </tr>


                <!--tr>
                    <td align="left">
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="1">
                                    <img src="/img/images/t01.gif" border="0" width="5" height="28" />
                                </td>
                                <td width="417" class="navwhitetext">
                                    Use the form below to send free SMS text messages
                                </td>
                                <td width="1" align="right">
                                    <img src="/img/images/t03.gif" border="0" width="5" height="28" />
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#bbbbbb">
                        <table bgcolor="#ffffff" border='0' width='100%'>
                            <tr>
                                <td align="left" width='1'>&nbsp;</td>
                                <td align="left">
                                    <form id="smsForm" action="/tellafriends/add" method="post" name="submit">
                                        <input type="hidden" name="typer" value="sms"> <br>
                                        Please enter a cell phone number:<br />
                                        <input class="required" type="text" name="phone" value=""> <br />
                                        NO Dashes - Example: 7361829726<br>
                                        <textarea class="required" name="message" rows="5" cols="40">Your Message Here</textarea><br />
                                        Please choose your recipient's provider:<br>
                                        <select name=carrier>
                                            <?
                                            //foreach ($carriers as $doc)
                                              //  print '<option value="' . $doc . '">' . $doc . '</option>';
                                            ?>
                                        </select> <br>
                                        <br>
                                        Captcha <br>
                                        <img
                                            src="/kcaptcha/?<?php echo session_name() ?>=<?php echo session_id() ?>"><br>
                                        <input type="text" name=captcha2 value=""><br>

                                        <input type="submit" value="Send SMS!" name="submit" class="submit_btn">
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2'>&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr-->
            </table>
        </td>
    </tr>

</table>
<?php $view['slots']->stop() ?>