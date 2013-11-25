<tr>
    <td width="1"><img src="/img/images/t01.gif" border="0" width="5" /></td>
    <td class="navwhitetext">&nbsp;&nbsp;Member's Login</td>
    <td width="1" align="right"><img src="/img/images/t03.gif" border="0" width="6" /></td>
</tr>
<tr>
    <td colspan="3" align="center"
        style="border-bottom: #4c4c4c 1px solid; border-left: #4c4c4c 1px solid; border-right: #4c4c4c 1px solid">
        <form method="post" action="/users/login"
              onSubmit="return checkform(this);" style="margin: 0px; padding: 0px;">
            <table width="90%" border="0" cellspacing="0" cellpadding="5">
                <tr>
                    <td height="10" align="left"></td>
                </tr>
                <tr>
                    <td align="left">User Name :</td>
                </tr>
                <tr>
                    <td align="left"><input name="data[User][email]"  size="20" class="tf" value="" type="text" id="UserEmail" /></td>
                </tr>
                <tr>
                    <td align="left">Password :</td>
                </tr>
                <tr>
                    <td align="left"><input type="password" name="data[User][password]"  size="20" class="tf" value="" id="UserPassword" /></td>
                </tr>
                <tr>
                    <td align="left"><input type='submit' id="button" value='Login'
                                            class="submit_btn"></td>
                </tr>
                <tr>
                    <td align="left"><a href="/users/benef"  class="pagelink">User Benefits</a></td>
                </tr>
                <tr>
                    <td align="left"><a href="/users/forget_password"  class="pagelink">Password Reminder</a></td>
                </tr>
                <tr>
                    <td align="left"><a href="/users/register"  class="pagelink">New User? Registration</a></td>
                </tr>
                <tr>
                    <td height="10" align="left"></td>
                </tr>
            </table>
        </form>
    </td>
</tr>