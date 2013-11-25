<?php $view->extend('YxBundle:layout:base.html.php') ?>

<?php $view['slots']->start('body') ?>

<table border="0" cellspacing="0" cellpadding="0" class="container">
    <tr>
        <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
        <td class="navwhitetext">My Profile</td>
        <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
    </tr>
    <tr>
        <td colspan="3" align="center" width="100%">
            <?php 
                echo $view['form']->errors($form);
            ?>
            <?php
                //echo '<pre>'; print_r( $view['session'] );
                $temp = $view['session']->getFlash('notice');
                
                if ( $temp ):
                    //$t = $view['session']->getFlash('notice');
                    //$t[0];
                    echo '<div id="flash-message">' . $temp[0] . '</div>';
                endif;

            ?>
            <form action="/users/myprofile" method="post">
                <table width="100%" border="0" align="center">
                    <tr>
                        <td align="left" width='90'>Login
                            <input type="hidden" name="id" value="<?php echo $id?>">
                        </td>
                        <td align="left"><b><?php echo $users->getEmail(); ?></b></td>
                    </tr>
                    <tr>
                        <td align="left">Name</td>
                        <td align="left">
                            <?php echo $view['form']->widget($form['firstname']) ?>
                            <?php echo $view['form']->errors($form['firstname']) ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="left">Last name</td>
                        <td align="left">
                            <?php echo $view['form']->widget($form['lastname']) ?>
                            <?php echo $view['form']->errors($form['lastname']) ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="left">Country</td>
                        <td align="left">
                            <select name="user[country_id]">
                            <?php
                                if ( $country):
                                    foreach ( $country as $val ):
                                        $sel = $users->getCountryId() == $val->getId() ? ' Selected ' : ''; 
                                        echo '<option '. $sel .' value="'. $val->getId() .'">'. $val->getCountryname().'</option>';
                                    endforeach;
                                endif;
                            ?>
                            </select>
                        </td>
                    </tr>                     
                    <tr>
                        <td align="left">City</td>
                        <td align="left">
                            <?php echo $view['form']->widget($form['city']) ?>
                            <?php echo $view['form']->errors($form['city']) ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="left">Gender</td>
                        <td align="left">
                            <select name="user[gender]">
                            <?php
                                echo '<option value="M" '. ($users->getGender() == 'M' ? 'Selected' : '') .'>Male</option>';
                                echo '<option value="F" '. ($users->getGender() == 'F' ? 'Selected' : '') .'>Female</option>';
                            ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td align="left">Mobilephone</td>
                        <td align="left">
                            <?php echo $view['form']->widget($form['mobilephone']) ?>
                            <?php echo $view['form']->errors($form['mobilephone']) ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="left">Carrier</td>
                        <td align="left">
                            <select name="user[carrier]">
                            <?php
                                if ( $carriers):
                                    foreach ( $carriers as $val ):
                                        if ( $val->getCarriername() != '' ):
                                            $sel = $users->getCarrier() == $val->getId() ? ' Selected ' : ''; 
                                            echo '<option '. $sel .' value="'. $val->getId() .'">'. $val->getCarriername().'</option>';
                                        endif;
                                    endforeach;
                                endif;
                            ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td align="left"></td>
                        <td align="left">                       
                            <a href="javascript:document.forms[0].action='/users/send';document.forms[0].submit();"><h2>Send test message</h2></a>
                        </td>
                    </tr>
                    <tr>
                        <td align="left">E-mail</td>
                        <td align="left">
                            <?php echo $view['form']->widget($form['email']) ?>
                            <?php echo $view['form']->errors($form['email']) ?>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align='left'>
                            
                            <?php echo $view['form']->widget($form['_token']) ?>
                           <input type="submit" value="Submit" class="submit_btn">
                        </td></tr>
                </table>
            </form>
        </td>
    </tr>
</table>
<?php $view['slots']->stop() ?>