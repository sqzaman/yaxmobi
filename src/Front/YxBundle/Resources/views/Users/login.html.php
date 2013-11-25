<?php $view->extend('YxBundle:layout:base.html.php') ?>

<?php $view['slots']->start('body') ?>

<table border="0" cellspacing="0" cellpadding="0" class="container">
    <tr>
        <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
        <td class="navwhitetext">Login</td>
        <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
    </tr>
    <tr>
	<td colspan="3" align="center" width="100%">
	<table width="100%" border="0" align="center">
	<tr>
		<td>
			Please enter your email ID and password and press the "Login" button to login.
		</td>	
	</tr>
		<td>
		<!-- START: MAIN CONTENT -->
			<form method="post" action="/users/login" onsubmit="return checkform(this);">
			<input type="hidden" name=ref value="<?=$ref?>">
			<table width="94%" border="0" align="center" cellpadding="0" cellspacing="0" class="box">
			<tr>
                            <td align="center">
                            <?php if (@$msg): ?>
                                <center>
                                    <font size="2" color="blue"><p>Your Password will be send to you on entered E-mail.</p></font>
                                </center>
                            <? endif; ?>
                            </td>
			<tr>
			<tr>
                            <td align="center" class="title">LOGIN</td>
			</tr>
			<tr>
                            <td align="center">
                                <?if (@$error): ?>
                                    <center>
                                        <font size="2" color="red">Please enter valid E-mail and Password.Try again.</font>
                                    </center>
                                <? endif; ?>
                            </td>
			<tr>
			<tr>
                            <td>
                                <table>
                                    <tr>
                                        <td align="right">Email ID: </td>
                                        <td align="left"><input name="data[User][email]" size="18" value="" type="text" id="UserEmail"></td>
                                    </tr>
                                    <tr>
                                        <td align="right">Password: </td>
                                        <td align="left"><input name="data[User][password]" size="18" value="" type="password" id="UserPassword"></td>
                                    </tr>
                                    <tr>
                                        <td align="center" colspan="2">
                                            <input type="submit" class="submit_btn" value="Login">
                                        </td>
                                    </tr>
                                </table>
                            </td>
			</tr>
			</table>							
			</form>
		<!-- END  : MAIN CONTENT-->
			</td>
		</tr>
	</table>
		</td>
	</tr>
</table>

<?php $view['slots']->stop() ?>