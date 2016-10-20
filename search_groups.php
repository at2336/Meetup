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

if(isset($_POST['searchGroups']))
	$searchGroups = $_POST['searchGroups'];
else
	echo "Please enter an event name or id to search for";
	
$searchStmt = $conn->prepare("SELECT * FROM groups WHERE (group_name = ? OR group_id = ?)");
$searchStmt->bind_param("ss", $searchGroups, $searchGroups);
$searchStmt->execute();
$searchStmt = $searchStmt->get_result();
if($searchStmt)
{
	while($row = $searchStmt->fetch_assoc())
	{
		echo "Group ID: " . $row['group_id'];
		?><br/><?php
		echo "Group Name: " . $row['group_name'];
		?><br/><?php
		echo "Description: " . $row['description'];
		?><br/><?php
		echo "Creator: " . $row['username'];
		?><br/><?php
		?><br/><br/><br/><?php
	}
}
else
	echo "There are no groups with that name or ID!";
?>
<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>

<a href = "index.php">Back to Index</a>
</body>
</html>