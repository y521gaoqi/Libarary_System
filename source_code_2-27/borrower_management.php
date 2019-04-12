<!-- <?php
	// echo "<h1> Sign Up</h1><br><br><br>";

	// echo"<form action='check_borrower_account.php' method='get'>
	// SSN<input type='text' name='ssn' required='required'/><br>
	// Name<input type='text' name='Name' required='required'/><br>
	// Address<input type='text' name='address' required='required'/><br>
	// Phone<input type='text' name='phone' required='required'/><br>
	// <input type='submit' name='submit' value='Sign Up'>";
	// echo"</form>";
	// 	SSN<input type='text' name='ssn' placeholder="000-000-000" pattern="/^\d{3}\-\d{3}\-\d{4}$/" required='required'/><br>



?> -->

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Sign Up Page</title>
</head>
<body>

<h1> Sign Up</h1><br><br><br>

<form action='check_borrower_account.php' method='get'>
	SSN@:
	<input type="text" name="ssn-1" maxlength="3" minlength="3">-
    <input type="text" name="ssn-2" maxlength="2" minlength="2">-
    <input type="text" name="ssn-3" maxlength="4" minlength="4"><br>
	Name<input type='text' name='name' required='required'/><br>
	Address<input type='text' name='address' required='required'/><br>
	Phone<input type='text' name='phone' required='required'/><br>
	<input type='submit' name='submit' value='Sign Up'>
</form>

</body>
</html>