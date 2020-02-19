<?php 
ob_start();
session_start();
if ($_POST['submit'] == 'Log Out') {session_destroy();};
if (isset($_SESSION["email"])){
	header("location:feed.php");	
};
include "elements/header.php"; 
ob_end_flush();
?>

<title>Signup to SkateBuddy</title>

<?php
include_once 'functions/config.php';
include_once 'functions/functions.php';

$errors = 0;
$error_code = array();

//check if the form has been submitted
if (isset($_POST['submit'])) {

	$variables = array(
					   "first_name" => $_POST['user_first_name'],
					   "last_name" => $_POST['user_first_name'],
					   "email" => $_POST['user_first_name'],
					   "password" => $_POST['user_first_name'],
					   "check_password" => $_POST['user_first_name'],
					   "sex" => $_POST['user_first_name'],
					   "month" => $_POST['user_first_name'],
					   "day" => $_POST['user_first_name'],
					   "year" => $_POST['user_first_name'],					   
					   );
	
	//Clean Variables
	//Prevent msql injection
	$user_first_name = ($_POST['user_first_name']); 
	$user_last_name = ($_POST['user_last_name']);
	$user_email = ($_POST['user_email']);
	$user_password = ($_POST['user_password']);
	$check_password = ($_POST['check_password']);
	$user_sex = ($_POST['user_sex']);
	$user_birthday_month = ($_POST['user_birthday_month']);
	$user_birthday_day = ($_POST['user_birthday_day']);
	$user_birthday_year = ($_POST['user_birthday_year']);
	
	$user_first_name = stripslashes($user_first_name); 
	$user_last_name = stripslashes($user_last_name);
	$user_email = stripslashes($user_email);
	$user_password = stripslashes($user_password);
	$check_password = stripslashes($check_password);
	$user_sex = stripslashes($user_sex);
	$user_birthday_month = stripslashes($user_birthday_month);
	$user_birthday_day = stripslashes($user_birthday_day);
	$user_birthday_year = stripslashes($user_birthday_year);
	
	$user_first_name = mysql_real_escape_string($user_first_name); 
	$user_last_name = mysql_real_escape_string($user_last_name);
	$user_email = mysql_real_escape_string($user_email);
	$user_password = mysql_real_escape_string($user_password);
	$check_password = mysql_real_escape_string($check_password);
	$user_sex = mysql_real_escape_string($user_sex);
	$user_birthday_month = mysql_real_escape_string($user_birthday_month);
	$user_birthday_day = mysql_real_escape_string($user_birthday_day);
	$user_birthday_year = mysql_real_escape_string($user_birthday_year);
	
	//Check for valid variables
	if ($error_code = check_variables($_POST)){$errors = 1;};
	
	//Check if account already exists
	$result = mysql_query("SELECT * FROM users WHERE user_email='$user_email'");
	$count = mysql_num_rows($result);
	if ($count > 0){
		$errors = 1;
		array_push($error_code, 300);
	};
	
	if (!$errors){
		
		//encripting password
		$user_password = md5($user_password);	
		
		//add to database		
		$add =  mysql_query("INSERT INTO users (user_first_name, user_last_name, user_email, user_password, user_sex, user_birthdate, user_first_login, user_last_login, user_picture) VALUES ('".$user_first_name."', '".$user_last_name."', '".$user_email."', '".$user_password."', '".$user_sex."', '".$user_birthdate."', CURDATE(), CURDATE(), '')");
		
		if ($add){
			$user_id = mysql_insert_id();
			
			//create a random key
			$user_key = $user_id . $user_email . date('mY');
			$user_key = md5($user_key);
			
			//add confirm row
			$confirm = mysql_query("INSERT INTO confirmations (user_id, user_key, user_email) VALUES ('".$user_id."','".$user_key."','".$user_email."')");
			
			if ($confirm){				
				//send the email
				if(send_email($user_first_name, $user_last_name, $user_id, $user_key, $user_email)){	
					$signup_success = 1;
				}else{$errors = 1;
					array_push($error_code, 101);				
				};
				
			}else{$errors = 1;
				array_push($error_code, 102);
			};
		}else{$errors = 1;
				array_push($error_code, 103);		
		}
		
		mysql_close($con);  
	};
	
};

?>

<div id="content">
<div id="cover_img"><img src="images/sb1.jpg" /></div>

<div id="signup" class="shadow">

<?php 
if ($signup_success){
	echo "<div style='padding:20px;text-align:center;'><h1 class='text_shadow'>Thank You</h1><h3 class='text_shadow'>An email verification has been sent to '$user_email'.</h3></div>";
}; ?>

<form id="signup_form" action="" method="post" style="padding:10px; display:<?php if ($signup_success){echo 'none';}else {echo 'block';}; ?>">

<div>
<h1 class="text_shadow">Sign Up</h1>
<h3 class="text_shadow">It's free</h3>
</div>
<span class="field_div">
<?php if (in_array( 1, $error_code)){echo '<style>#first_name{border:#ff0000 solid 2px;}</style>';}; ?>
<input id="first_name" onClick="eraseSignupText(1)" onFocus="eraseSignupText(1)" onKeyDown="$(this).css('border','#111111 solid 1px');" value=<?php if (isset($_POST['submit']) && $user_first_name != 'First Name' && $user_first_name != ''){echo "'".$user_first_name."'";}else{echo '"First Name"';}; ?> class="input_field" type="text" name="user_first_name" />
</span>

<span class="field_div">
<?php if (in_array( 2, $error_code)){echo '<style>#last_name{border:#ff0000 solid 2px;}</style>';}; ?>
<input id="last_name" onClick="eraseSignupText(2)" onFocus="eraseSignupText(2)" onKeyDown="$(this).css('border','#111111 solid 1px');"  value=<?php if (isset($_POST['submit']) && $user_last_name != 'Last Name' && $user_last_name != '') {echo "'".$user_last_name."'";}else{echo '"Last Name"';}; ?> class="input_field" type="text" name="user_last_name" />
</span>

<div class="field_div">
<?php if (in_array( 300, $error_code)){echo 'Email already exists.<a href="recover.php"> Forgor your password? </a><br/>';}; ?>
</div>
<div class="field_div">
<?php if (in_array( 3, $error_code) || in_array( 10, $error_code) || in_array( 300, $error_code) ){echo '<style>#email{border:#ff0000 solid 2px;}</style>';}; ?>
<input id="email" onClick="eraseSignupText(3)" onFocus="eraseSignupText(3)" onKeyDown="$(this).css('border','#111111 solid 1px');" value=<?php if (isset($_POST['submit']) && $user_email != 'Email'  && $user_email != '') {echo "'".$user_email."'";}else{echo '"Email"';}; ?> class="input_field" type="text" name="user_email" />
</div>
<div class="field_div">
<?php if (in_array( 4, $error_code)){echo 'Please enter a valid password.<br/>';}; ?>
<?php if (in_array( 5, $error_code)){echo "Passwords don't match.<br/>";}; ?>
<?php if (in_array( 11, $error_code)){echo "Passwords too short at least 8 characters.<br/>";}; ?>
<?php if (in_array( 12, $error_code)){echo "Passwords Fon't match.<br/>";}; ?>
</div>
<div style="height:30px;">
<div style="position:absolute;">
<span class="field_div">
<?php if (in_array( 4, $error_code) || in_array( 5, $error_code) || in_array( 11, $error_code) || in_array( 12, $error_code)){echo '<style>#password{border:#ff0000 solid 2px;}</style>';}; ?>
<input id="password" onFocus="eraseSignupText_t(4)" onKeyDown="$(this).css('border','#111111 solid 1px');" class="input_field" width="150px" type="password" name="user_password" />
</span>

<span class="field_div">
<?php if (in_array( 4, $error_code) || in_array( 5, $error_code) || in_array( 11, $error_code) || in_array( 12, $error_code)){echo '<style>#password_check{border:#ff0000 solid 2px;}</style>';}; ?>
<input id="password_check" onFocus="eraseSignupText_t(5)" onKeyDown="$(this).css('border','#111111 solid 1px');" class="input_field" width="150px" type="password" name="check_password" />
</span>
</div>

<div  style="position:absolute;">
<span class="field_div">
<?php if (in_array( 4, $error_code) || in_array( 5, $error_code) || in_array( 11, $error_code) || in_array( 12, $error_code)){echo '<style>#password_text{border:#ff0000 solid 2px;}</style>';}; ?>
<input id="password_text" onClick="eraseSignupText(4)" onFocus="eraseSignupText(4)" onKeyDown="$(this).css('border','#111111 solid 1px');" value="Create Password" class="input_field" type="text"/>
</span>

<span class="field_div">
<?php if (in_array( 4, $error_code) || in_array( 5, $error_code) || in_array( 11, $error_code) || in_array( 12, $error_code)){echo '<style>#password_check_text{border:#ff0000 solid 2px;}</style>';}; ?>
<input id="password_check_text" onClick="eraseSignupText(5)" onFocus="eraseSignupText(5)" onKeyDown="$(this).css('border','#111111 solid 1px');" value="Reenter Password" class="input_field" type="text"/>
</span>
</div>


</div>

<?php if (in_array( 6, $error_code)){echo '<style>#sex{border:#ff0000 solid 2px;}</style>';}; ?>
<div id="sex" class="field_div">
Male:
<input type="radio" onClick="$('#sex').css('border','none');" name="user_sex" value="male" />
Female:
<input type="radio" onClick="$('#sex').css('border','none');" name="user_sex" value="female"  />
</div>

<div class="field_div">
<h3>Birthdate:</h3>

<?php if (in_array( 13, $error_code)){
	echo "Must be at least older then 7 years old.<br/>";
	echo '<style>#month{border:#ff0000 solid 2px;}</style>';
	echo '<style>#day{border:#ff0000 solid 2px;}</style>';
	echo '<style>#year{border:#ff0000 solid 2px;}</style>';
	}; ?>
</div>
<div class="field_div">
<?php if (in_array( 7, $error_code)){echo '<style>#month{border:#ff0000 solid 2px;}</style>';}; ?>
<select id="month" onFocus="$(this).css('border','#111111 solid 1px');" class="input_field" name="user_birthday_month" style="height:30px;">
<option value="-1">Month:</option>
<option value="1">Jan</option>
<option value="2">Feb</option>
<option value="3">Mar</option>
<option value="4">Apr</option>
<option value="5">May</option>
<option value="6">Jun</option>
<option value="7">Jul</option>
<option value="8">Aug</option>
<option value="9">Sep</option>
<option value="10">Oct</option>
<option value="11">Nov</option>
<option value="12">Dec</option>
</select>


<?php if (in_array( 7, $error_code)){echo '<style>#day{border:#ff0000 solid 2px;}</style>';}; ?>
<select id="day" onFocus="$(this).css('border','#111111 solid 1px');" class="input_field" name="user_birthday_day" style="height:30px;">
<option value="-1">Day:</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option
><option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
</select>


<?php if (in_array( 7, $error_code)){echo '<style>#year{border:#ff0000 solid 2px;}</style>';}; ?>
<select id="year" onFocus="$(this).css('border','#111111 solid 1px');" class="input_field" name="user_birthday_year" style="height:30px;">
<option value="-1">Year:</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option><option value="1932">1932</option><option value="1931">1931</option><option value="1930">1930</option><option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option><option value="1926">1926</option><option value="1925">1925</option><option value="1924">1924</option><option value="1923">1923</option><option value="1922">1922</option><option value="1921">1921</option><option value="1920">1920</option><option value="1919">1919</option><option value="1918">1918</option><option value="1917">1917</option><option value="1916">1916</option><option value="1915">1915</option><option value="1914">1914</option><option value="1913">1913</option><option value="1912">1912</option><option value="1911">1911</option><option value="1910">1910</option><option value="1909">1909</option><option value="1908">1908</option><option value="1907">1907</option><option value="1906">1906</option><option value="1905">1905</option>
</select>
</div>
<div class="field_div">
<input type="submit" name="submit" value="Submit" class="button"  />
</div>
</form> 

</div>  
  
</div><!-- Content -->

<?php include "elements/footer.php"; ?>
