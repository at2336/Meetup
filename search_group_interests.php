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
	header("Location: login.php");

$findGroup = $conn->prepare("SELECT * FROM groups, interest, about WHERE interest.interest_name = about.interest_name AND groups.group_id = about.group_id AND interest.interest_name = ?");
if(isset($_POST['findGroup']))
{
	$groupName = $_POST['findGroup'];
	$findGroup->bind_param("s", $groupName);
	$findGroup->execute();
	$findGroup = $findGroup->get_result();
}
if(isset($_POST['searchGroups']))
{
	$groupToSearch = $_POST['searchGroups'];
	$findGroup->bind_param("s", $groupToSearch);
	$findGroup->execute();
	$findGroup = $findGroup->get_result();
}

if($findGroup->num_rows > 0)
{
	while($row = $findGroup->fetch_assoc())
	{
		echo "Group id: " . $row['group_id'];
		nl2br("\nwtf");
		echo "Group Name: " . $row['group_name'];
		echo "Description: " . $row['description'];
		echo "Creator: " . $row['username'];
	}
}
else
{
	echo "There are no groups for this interest!";
}
?>