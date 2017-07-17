<?php
	$message='';
	require('connect_database.php');
	if (isset($_POST['submit'])){		
		$first_name = $_POST['firstName'];
		$last_name = $_POST['lastName'];
		$user_name = $_POST['username'];
		$email = $_POST['email'];
		$cnfm_email = $_POST['cnfmemail'];
		$pswd = $_POST['pswd'];
		$cnfm_pswd = $_POST['cnfmpswd'];
		$emp_id = $_POST['empID'];
		$check_query = "SELECT * FROM user_accounts WHERE user_name = '$user_name'";
		$result = database_query($check_query);
		if (( empty($first_name) || empty($last_name) || empty($user_name) || empty($email) || empty($emp_id)|| empty($pswd))){
			$message = "Please fill all the fields!";
		}
		elseif (!(is_null(mysqli_fetch_array($result)))){
			$message = "Username already exists!";
			$user_name = '';
		} elseif ($emp_id <1) {
			$message = 'Invalid Employ Number!';
			$emp_id='';
		} elseif ($pswd != $cnfm_pswd) {
			$message = 'Password Mismatch!';
		} elseif ($email != $cnfm_email) {
			$message = 'Email missmatch!';
			$email='';
		} else {
			$query="INSERT INTO user_accounts (first_name, last_name, emp_id, email, pwd, user_name) " . 
			"VALUES ('$first_name', '$last_name', $emp_id, '$email', SHA('$pswd'), '$user_name')";
			database_query($query);
			header("Location: Login.php");
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="CSS/Layout.css" rel="stylesheet" type="text/css" />
<link href="CSS/SignUpForm.css" rel="stylesheet" type="text/css" />
<title>Sign Up</title>
</head>
<body>
<div id="Holder">
<div id="Header"> </div>
<div id="Content"> 
<div id="PageHeading">
  <h1>Sign Up!</h1>
</div>
<div id="Message">
<h2> Fill all the fields! </h2>

</div>
<div id="Detail">
<h2 id="DetailHeader"> Enter Your Details! </h2>
<h3> <?php echo $message ?></h3>

<form action="SignUp.php" method="post" id="SignUpForm"> 
<table align="center"> 
<tr>
	<td width="250" height="35"> <label for="firstName"> First Name </label> </td>
    <td width="250" height="35"> <label for="lastName"> Last Name </label> </td>
</tr>
<tr>
	<td height="25"> <input type="text" id="firstName" name="firstName" value="<?php if(isset($first_name)) echo $first_name; ?>"/> </td>
    <td height="25"> <input type="text" id="lastName" name="lastName" value="<?php if(isset($last_name)) echo $last_name; ?>"/> </td>
</tr>
<tr>
	<td width="250" height="35"> <label for="username"> Username </label> </td>
    <td width="250" height="35"> <label for="empID"> Employ ID </label> </td>
</tr>
<tr>
	<td height="25"> <input type="text" id="username" name="username" value="<?php if(isset($user_name)) echo $user_name; ?>"/> </td>
	<td height="25"> <input type="number" id="empID" name="empID" value="<?php if(isset($emp_id)) echo $emp_id; ?>"/> </td>
</tr>
<tr>
	<td width="250" height="35"> <label for="email"> E-Mail </label> </td>
    <td width="250" height="35"> <label for="cnfmemail"> Confirm E-Mail </label> </td>
</tr>
<tr>
	<td height="25"> <input type="email" id="email" name="email" value="<?php if(isset($email)) echo $email; ?>"/> </td>
    <td height="25"> <input type="email" id="cnfmemail" name="cnfmemail" value="<?php if(isset($email)) echo $email; ?>"/> </td>	
</tr>
<tr>
	<td width="250" height="35"> <label for="pswd"> Password </label> </td>
    <td width="250" height="35"> <label for="cnfmpswd"> Confirm Password </label> </td>
</tr>
<tr>
	<td height="25"> <input type="password" id="pswd" name="pswd"/> </td>
    <td height="25"> <input type="password" id="cnfmpswd" name="cnfmpswd"/> </td>
</tr>
</table>
<button type="submit" form="SignUpForm" name="submit"> Sign Up </button>
</form>

</div>
</div>
<div id="footer"></div>
</div>
</body>
</html>