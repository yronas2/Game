<?php

	$con = mysqli_connect('localhost', 'root', '', 'unityaccess');

	// check connection
	if(mysqli_connect_errno())
	{
		echo "1: Connection failed";// error code #1 = connection failed
		exit();
	}

	$username = $_POST["name"];
	$password = $_POST["password"];

	//check if name exists
	$namecheckquery = "SELECT username FROM players WHERE username =' ". $username . "'";

	$namecheck = mysqli_query($con, $namecheckquery) or die ("2: name check query failed"); // ERRROR code #2 name check query failed
	if (mysqli_num_rows($namecheck) > 0)
	{
		echo "3: name already exists"; // error code #3 - name already exists
		exit();
	}

	//add user to the table 
	$salt = "\$5\$rounds=5000\$" . "steamedhams" . $username . "\$";// naudojamas sifras 
	$hash = crypt($password, $salt);
	$insertuserquery = "INSERT INTO players (username, hash, salt) VALUES ('" . $username . "', '" . $hash . "', '" . $salt . "');";
	mysqli_query($con, $insertuserquery) or die("4: Insert player query failed"); // errpr cpde #4 insert query failed

	echo ("0");


?>


