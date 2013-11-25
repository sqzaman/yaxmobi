<?php $view->extend('YxBundle:layout:base.html.php') ?>

<?php $view['slots']->start('body') ?>

<table border="0" cellspacing="0" cellpadding="0" class="container">
    <tr>
        <td width="1"><img src="/img/images/t01.gif" border="0" width="5" height="28" /></td>
        <td class="navwhitetext">Register</td>
        <td width="1"><img src="/img/images/t03.gif" border="0" width="6" height="28" /></td>
    </tr>
    <tr>
        <td colspan="3">
            <h2>Registration Information</h2>
            <a href="/users/benef"><h2>User Benefits</h2></a>
        </td>
    </tr>
    <?php

    if (isset($errMessage)) {
        echo "<tr>
					<td colspan='3' align='center' class='error'>" . $errMessage . "
					</td>
				</tr>";
    }
    ?>

    <tr>
        <td colspan="3" align="center" width="100%">
            <form action="/users/register" method="post" name="theForm" id="theForm" onsubmit="return chkForm();">
                <table width="100%" border="0" align="center">
                    <tr>
                        <td align="left" width='90'>Email</td>
                        <td align="left">
                            <?php echo $view['form']->widget($form['email']) ?>
                            <?php echo $view['form']->errors($form['email']) ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" width='90'>First Name</td>
                        <td align="left">
                            <?php echo $view['form']->widget($form['firstname']) ?>
                            <?php echo $view['form']->errors($form['firstname']) ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" width='90'>Last Name</td>
                        <td align="left">
                            <?php echo $view['form']->widget($form['lastname']) ?>
                            <?php echo $view['form']->errors($form['lastname']) ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" width='90'>Password</td>
                        <td align="left">
                            <?php echo $view['form']->widget($form['password']) ?>
                            <?php echo $view['form']->errors($form['password']) ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="left">Confirm Password</td>
                        <td align="left">
                            <input type="password" required="required" name="confirm_pass" id="confirm_pass">
                        </td>
                    </tr>
                    <tr>
                        <td align="left">Address</td>
                        <td align="left">
                            <?php echo $view['form']->widget($form['address']) ?>
                            <?php echo $view['form']->errors($form['address']) ?>
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
                        <td align="left">State</td>
                        <td align="left">                       
                            <?php echo $view['form']->widget($form['state']) ?>
                            <?php echo $view['form']->errors($form['state']) ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="left">Postal Code</td>
                        <td align="left">                       
                            <?php echo $view['form']->widget($form['zip']) ?>
                            <?php echo $view['form']->errors($form['zip']) ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="left">Country</td>
                        <td align="left">                       
                            <select name="user[country_id]" id="country">
                            <?php
                                if ( $country):
                                    foreach ( $country as $val ):
                                        echo '<option value="'. $val->getId() .'">'. $val->getCountryname().'</option>';
                                    endforeach;
                                endif;
                            ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td align="left">Gender</td>
                        <td align="left">                       
                            <input type="radio" name="user[gender]" id="genderF" value="F">
                            <label for="genderF" class="spacetext">Female</label>
                            <input type="radio" name="user[gender]" id="genderM" value="M" checked>
                            <label for="genderM" class="spacetext">Male</label>
                        </td>
                    </tr>
                    <tr>
                        <td align="left">Date of Birth</td>
                        <td align="left">                       
                            <!--


--><select name="bMonth" id="bMonth"></select><!--



--><select name="bDay" id="bDay"></select><!--



--><select name="bYear" id="bYear"></select><!--

-->
<script type="text/javascript">
function selMosb(pid,pval){
var h=document.getElementById(pid);
var m= new Array('January','February','March','April','May','June','July','August','September','October','November','December');
for(var i=1; i <= 12;i++)
h.options[h.options.length]=new Option(m[i-1],i);
h.value=pval;
}
function selRngb(pid,pval,pstart,pend){
var h=document.getElementById(pid);
for(var i=pstart;i<=pend; i++)
h.options[h.options.length]=new Option(i,i);
h.value=pval;
}// addStuff

function selAddBlnkb(pid,pidx){
var l= new Array('Year','Month','Day');

var h=document.getElementById(pid);
h.options[h.options.length]=new Option(l[pidx],0);
}
selAddBlnkb( "bYear",0);
selAddBlnkb( "bMonth",1 );
selAddBlnkb( "bDay",2);

selMosb( "bMonth", 0 );
selRngb( "bDay", 0, 1, 31 );
selRngb( "bYear", 0, 1906, 2006 );
</script>

                        </td>
                    </tr>
                    <tr>
                        <td align="left">Captcha</td>
                        <td align="left">                       
                            <img src="/kcaptcha/index.php?<?php echo session_name()?>=<?php echo session_id()?>" border="1"><br>
					
                            <input type="text" name=captcha value=""> 
                        </td>
                    </tr>
                    <tr>
                        <td align="left">Captcha</td>
                        <td align="left">                       
                            <input type="checkbox" name="tos" id="tos" value="1" >
                            <font class="required">
                                <label for="tos" class="required">By checking this box, you agree to our 
                                <b><?php echo '<a href="/termsofuse">Terms Of Use</a>';?> </b>
                                    and

                                    <b><b><?php echo '<a href="//privacypolicy/privacypolicy">Privacy Policy</a>';?> </b>
                                    &nbsp;</label>
                            </font>
					
                            
                        </td>
                    </tr>
                    <tr>
                        <td align="left"></td>
                        <td align="left">
                            <?php echo $view['form']->widget($form['_token']) ?>
                            <input type="submit" class="submit_btn" value="Register">
                        </td>
                    </tr>
                </table>
            </form>
        </td>
    </tr>
</table>
<script language="JavaScript">
<!--
function chkForm() {
	var email = document.getElementById('user_email');
        var firstname = document.getElementById('user_firstname');
        var lastname = document.getElementById('user_lastname');
	var Password = document.getElementById('user_password');
	var rePassword = document.getElementById('confirm_pass');
	var country = document.getElementById('country');
	var tos= document.getElementById('tos'); // checkbox for Terms of service

	strPassword = Password.value;

        // Email Checker
	if (email.value == 0) {
		//alert("Please enter your email address");
		alert("Please enter your email address");
		email.focus();
		return false;
	} else if (email.value.indexOf("@") < 0) {
		//alert("Incorrect email address. Please re-enter");
		alert("Incorrect email address. Please re-enter");
		email.focus();
		return false;
	} else if (email.value.indexOf(".") < 0) {
		//alert("Incorrect email address. Please re-enter");
		alert("Incorrect email address. Please re-enter");
		email.focus();
		return false;
	} else if (email.value.indexOf(" ") >= 0) {
		//alert("Incorrect email address. Please re-enter");
		alert("Incorrect email address. Please re-enter");
		email.focus();
		return false;
	}

        // Check DOB is not less than 18 yrs old
	var lowlimit = new Date();
	lowlimit.setYear(lowlimit.getYear()-14);
	// the + 1 below is because js months are indexed from zero
	var enteredAge = new Date(document.theForm.bYear.value, (document.theForm.bMonth.value - 1) , document.theForm.bDay.value);
	// Birthday date must be entered
	with (document.theForm) {
		if (!bYear.value|!bDay.value|!bMonth.value) {
			//alert ("Please enter a valid date for your birthday.");
			alert ("Please enter a valid date for your birthday.");
			return false;
		}
	}
	if (enteredAge > lowlimit) {
		//alert ("You must be 14 or older to use this site.");
		alert ("You must be 14 or older to use this site.");
		return false;
	}

	// Password Checker
	if (Password.value =="") {
		//alert ("Please enter a password (min 6 characters)");
		alert ("Please enter a password (min 6 characters)");
		Password.focus();
		return false;
	} else if (Password.length < 6) {
		//alert ("Password must have at least 6 characters. Please Re-enter.");
		alert ("Password must have at least 6 characters. Please Re-enter.");
		Password.focus();
		return false;
	} else if (!strPassword.match(/[0-9!@#\$%\^&\*\(\)\-_\+=\{\}\[\|:;'\?<>\.,~`"]/)) {
		//alert ("Password must contain at least 1 number or punctuation character.");
		alert ("Password must contain at least 1 number or punctuation character.");
		Password.focus();
		return false;
	} else if (!strPassword.match(/[A-Za-z]/)) {
		//alert ("Password must have contain least 1 letter.");
		alert ("Password must contain at least 1 number or punctuation character.");
		Password.focus();
		return false;
	} else if (firstname.value.length > 2 && strPassword.lastIndexOf(firstname.value.toUpperCase()) > -1) {
		//alert ("Password too closely resembles first name.");
		alert ("Password too closely resembles first name.");
		Password.focus();
		return false;
	} else if (lastname.value.length > 2 && strPassword.lastIndexOf(lastname.value.toUpperCase()) > -1) {
		//alert ("Password too closely resembles last name.");
		alert ("Password too closely resembles last name.");
		Password.focus();
		return false;
	} else if (strPassword.lastIndexOf(email.value.toUpperCase()) > -1) {
		//alert ("Password too closely resembles email.");
		alert ("Password too closely resembles email.");
		Password.focus();
		return false;
	} else if (Password.value.indexOf(" ") >= 0) {
		//alert ("Space is not ALLOWED for password. Please re-enter.");
		alert ("Space is not ALLOWED for password. Please re-enter.");
		Password.focus();
		return false;
	} else if (Password.value != rePassword.value) {
		alert ("Password do not matched. Please re-enter.");
		rePassword.focus();
		return false;
	}else if (country.value == '') {
		alert ("Please select your country.");
		rePassword.focus();
		return false;
	}
	
	/*else if (address.value == '') {
		alert ("Please enter your address.");
		address.focus();
		return false;
	}else if (city.value == '') {
		alert ("Please enter your city.");
		city.focus();
		return false;
	}else if (state.value == '') {
		alert ("Please enter your state.");
		state.focus();
		return false;
	}else if (postalCode.value == '') {
		alert ("Please enter your postal code.");
		postalCode.focus();
		return false;
	}*/

	
	// TOS check
	if (!tos.checked) {
		//alert("Please check the agree to our terms box.");
		alert("Please check the agree to our terms box.");
		tos.focus();
		return false;
	}
}

// If country is not US Disable some of the fields
function changeCountry() {
	country = document.theForm.country;

	var countyDropdown = document.getElementById('countyDropdown');
	var cityDropdown = document.getElementById('cityDropdown');
	var regionDropdown = document.getElementById('regionDropdown');

	if (document.theForm.country.value=='IE') {
		countyDropdown.style.display = '';
		if (cityDropdown) cityDropdown.style.display='none';
		if (regionDropdown) regionDropdown.style.display='none';
	} else if (document.theForm.country.value=='JP') {
		countyDropdown.style.display='none';
		if (cityDropdown) cityDropdown.style.display='';
		if (regionDropdown) regionDropdown.style.display='';
	} else {
		countyDropdown.style.display='none';
		if (cityDropdown) cityDropdown.style.display='none';
		if (regionDropdown) regionDropdown.style.display='none';
	}
}

function DropDownSelect(obj, val) {
	var i;
	var len = obj.options.length;
	for (i=0; i<len; i++) {
		if (obj.options[i].value == val) {
			obj.selectedIndex = i;
			break;
		}
	}
}

function handleOnChangePreferredCulture() {
	d = document.theForm.preferredCulture;
	i = d.selectedIndex;
	val = d[i].value;
	var userAgreementTextarea = document.getElementById('userAgreementTextarea');
	if (val == 'ja-JP') {
		if (userAgreementTextarea) userAgreementTextarea.style.display='';
	} else {
		if (userAgreementTextarea) userAgreementTextarea.style.display='none';
	}
}

//-->
</script>
<script language="JavaScript">
				<!--
				
					//DropDownSelect(document.forms.theForm.country, 'US');
					//changeCountry();
				
				
					DropDownSelect(document.theForm.bMonth, 0);
				
				
					DropDownSelect(document.theForm.bDay, 0);
				
				
					DropDownSelect(document.theForm.bYear, 0);
				
				
					//DropDownSelect(document.forms.theForm.preferredCulture, 'en-US');
				
				//handleOnChangePreferredCulture();
				//-->
				</script>
<?php $view['slots']->stop() ?>