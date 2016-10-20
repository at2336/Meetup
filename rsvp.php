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

session_start();
$username = $_SESSION['username'];

$attendEvent = $conn->prepare("INSERT into attend (event_id, username, rsvp, rating) VALUES (?,?,?,?)");
if(isset($_POST['eventRSVP']))
{
	$eventID = $_POST['eventRSVP'];
	$rsvp = "1";
	$rating = "99";
	$attendEvent->bind_param("dsii", $eventID, $username, $rsvp, $rating);
	$attendEvent->execute();
	echo "You have RSVP'd for the event!";
	header("refresh: 3, URL =index.php");
}
else
{
	echo "You have already RSVP'd for this event!";
	header("refresh: 3, URL =index.php");
}
?>