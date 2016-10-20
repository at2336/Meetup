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
if(!isset($_SESSION['username']))
	header("Location: login.html");

$pStmt = $conn->prepare("SELECT group_name FROM groups, belongs_to, member WHERE member.username = belongs_to.username AND groups.group_id = belongs_to.group_id AND member.username = ?");
$username = $_SESSION['username'];
$pStmt->bind_param("s", $username);
$pStmt->execute();
$pStmt = $pStmt->get_result();

$findGroup = $conn->prepare("SELECT group_id FROM groups WHERE group_name = ?");
if(isset($_POST['findGroup']))
	$groupID = $_POST['findGroup'];
$findGroup->bind_param("s", $groupID);
$findGroup->execute();
$findGroup = $findGroup->get_result();
$findGroup = $findGroup->fetch_assoc();

$createEvent = $conn->prepare("INSERT into events(title, description, start_time, end_time, group_id, lname, zip) VALUES (?,?,?,?,?,?,?)");
$title = $_POST['title'];
$desc = $_POST['description'];
$start = $_POST['starttime'];
$end = $_POST['endtime'];
$date = $_POST['eventdate'];
$lname = $_POST['lname'];
$zip = $_POST['zip'];
$group = $_POST['groupID'];

$checkAuthorized = $conn->prepare("SELECT authorized FROM belongs_to WHERE username = ? AND group_id = ?");
$checkAuthorized->bind_param("sd", $username, $group);
$checkAuthorized->execute();
$checkAuthorized = $checkAuthorized->get_result();
$row = $checkAuthorized->fetch_assoc();
if($row['authorized'] == 1)
{
	$start = date("Y-m-d H:i:s", mktime(substr($start, 0,2),substr($start, 3, 2), substr($start, 6, 2), substr($date, 5, 2), substr($date, 8, 2), substr($date, 0, 4)));
	$end = date("Y-m-d H:i:s", mktime(substr($end, 0,2),substr($end, 3, 2), substr($end, 6, 2), substr($date, 5, 2), substr($date, 8, 2), substr($date, 0, 4)));
	$createEvent->bind_param("ssssdsd", $title, $desc, $start, $end, $group, $lname, $zip);
	$createEvent->execute();
	$createEvent = $createEvent->get_result();
	echo "Congratulations, you have created an event!";
	header("refresh: 3, URL=index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>
<div>
</div>
	
</body>
</html>