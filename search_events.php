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

if(isset($_POST['searchEvents']))
	$searchEvents = $_POST['searchEvents'];
else
	echo "Please enter an event name or id to search for";
	
$searchStmt = $conn->prepare("SELECT * FROM events WHERE (title = ? OR event_id = ?)");
$searchStmt->bind_param("ss", $searchEvents, $searchEvents);
$searchStmt->execute();
$searchStmt = $searchStmt->get_result();
if($searchStmt)
{
	while($row = $searchStmt->fetch_assoc())
	{
		echo "Event ID: " . $row['event_id'];
		?><br/><?php
		echo "Event Name: " . $row['title'];
		?><br/><?php
		echo "Description: " . $row['description'];
		?><br/><?php
		echo "Start Time: " . $row['start_time'];
		?><br/><?php
		echo "Start Time: " . $row['end_time'];
		?><br/><?php
		echo "Group ID: " . $row['group_id'];
		?><br/><?php
		echo "Location: " . $row['lname'];
		?><br/><?php
		echo "Zipcode: " . $row['zip'];
		?><br/><br/><br/><?php
	}
}
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