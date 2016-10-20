<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "" ;
$dbname = "meetup";
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if(!$conn) 
{
	die("Unable to connect to database");
}

//Prepared statement to query
$pStmt = $conn->prepare("INSERT into member (username, password, firstname, lastname, zipcode) VALUES (?,?,?,?,?)");
$userCheck = $conn->prepare("SELECT * FROM member WHERE username = ?");

//Get entered user information
$username = $_POST['user'];
$password = $_POST['pass'];
$verifypass = $_POST['verifypass'];
$firstname = $_POST['first'];
$lastname = $_POST['last'];
$zipcode = $_POST['zipcode'];

//Retrieve all usernames same as $username
$userCheck->bind_param("s", $username);
$userCheck->execute();
$userCheck = $userCheck->get_result();
$userCheck = $userCheck->fetch_assoc();

//Check if zipcode is correct, username is avaliable and password matches
if(strlen($zipcode) == 5 && ctype_digit($zipcode))
{
	if(empty($userCheck))
	{
		if($password == $verifypass)
		{
			$password = md5($password);
			$pStmt->bind_param("ssssd", $username, $password, $firstname, $lastname, $zipcode);
			$pStmt->execute();
			session_start();
			$_SESSION['username'] = $username;
			echo "You are now registered!";
			header('Refresh: 3; URL=index.php');
		}
		else
		{
			echo "Passwords do not match";
			header('Refresh: 3; URL=signup.html');
		}
	}
	else
	{
		echo "Username is taken";
		header('Refresh: 3; URL=signup.html');
	}
}
else
{
	echo "Invalid zipcode";
	header('Refresh: 3; URL=signup.html');
}

//Executes query and if a result is found, log in and create session
$pStmt->close();
?>