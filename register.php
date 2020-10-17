<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	require('../mysqli_connect.php');
	if(!empty($_POST['name']) && !empty($_POST['card']) && !empty($_POST['email'])){
		$card = '"' . $_POST['card'] . '"';
		if(strlen($_POST['card']) == 8){
			$check=true;
		}else{
			$errors[] .= 'Card number must be 8 digits.' . preg_match("\\d{8}", $_POST["card"]) . $_POST['card'];
			$check=false;
		}	

		if(preg_match("(((\\w+\\.\\w+)|\\w+)\\@\\w+\\.\\w{2,4})", $_POST['email'], $match)){
			$check=true;
		}else{
			$errors[] .= 'Please enter a valid email.';
			$check=false;
		}
	}else{
		$errors[] .= 'You have not entered all of the required information.';
	}
	
	if(empty($errors)){
		$q = "SELECT * FROM th227.LibUsers WHERE Card_Number = " . $_POST['card'];

		$r = @mysqli_query($dbc, $q);

		if(mysqli_num_rows($r) >= 1){
				echo'The card number you entered is already in use. Please try again.';	
		}else{

			$q = "SELECT * FROM th227.LibUsers WHERE Patron_Email = '" . $_POST['email'] . "'";

			$r = @mysqli_query($dbc, $q);

			if(mysqli_num_rows($r) >= 1){

				echo'The email you entered is already in use. Please try again.';

			}else{
				$q = "INSERT INTO th227.LibUsers (Patron_Name, Card_Number, Patron_Email) VALUES ('" . $_POST['name'] . "', '" . $_POST['card'] . "', '" . $_POST['email'] . "')";

				$r = @mysqli_query($dbc, $q);

				if($r){
						echo'Your account has been created successfully.';
				}else{
						echo'Account could not be created.';
				}
			}
		}
	}else{
		if	(isset($errors)	&&	!empty($errors))	{
			echo	'<h1>Error!</h1>
			<p	class="error">The	following	error(s)	occurred:<br	/>';
			foreach	($errors	as	$msg)	{
				echo	"	-	$msg<br/>\n";
			}
			echo	'</p><p>Please	try	again.</p>';
		}
	}
}
?>
<h1>Create an Account</h1>
<form action="loggedin.php"	method="post">
	<p>Enter Your Name: <input type="text" name="name" size="20" maxlength="60"></p>
	<p>Create a Card Number:	<input type="text" name="card" size="20" maxlength="8"></p>
	<p>Enter Your Email:	<input type="text" name="email" maxlength="60"></p>
	<p><input type="submit" name="submit" value="Create"></p>
</form>