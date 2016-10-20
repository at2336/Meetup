<?php
session_start();
if(isset($_SESSION['username']))
{
	unset($_SESSION);
	session_destroy();
	header("Location: login.php");
}
?>