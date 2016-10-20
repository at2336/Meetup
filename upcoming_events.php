
<!DOCTYPE html>
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
		
	$username = $_SESSION['username'];
	//$checkRSVP = $conn->prepare("SELECT rsvp FROM attend WHERE username = ?");
	$upcomingEvents = $conn->prepare("SELECT events.event_id, events.title, events.description, events.start_time, events.end_time, events.lname, events.zip, events.group_id FROM events, attend WHERE events.start_time BETWEEN ? AND ? AND events.event_id = attend.event_id AND rsvp = '1' AND attend.username = ?");
	$today = date("Y-m-d");
	$daterange = date("Y-m-d", strtotime("+3 days"));
	$upcomingEvents->bind_param('sss', $today, $daterange, $username);
	$upcomingEvents->execute();
	$upcomingEvents = $upcomingEvents->get_result();
	
?>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Meetup!</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Meetup</a>
                <a class="navbar-brand" href="find_event.php"><span style="color: red;">Find events</span></a>
                <a class="navbar-brand" href="create_event.php"><span style="color: red;">Create event</span></a>
                <a class="navbar-brand" href="create_group.php"><span style="color: red;">Create group</span></a>
                <a class="navbar-brand" href="view_group.php"><span style="color: red;">View Group</span></a>
				<a class="navbar-brand" href="upcoming_events.php"><span style="color: red;">Upcoming Events</span></a>
				<a class="navbar-brand" href="interest_group.php"><span style="color: red;">Find Group</span></a>
				<a class="navbar-brand" href="attend.php"><span style="color: red;">RSVP</span></a>
				<a class="navbar-brand" href="create_interest.php"><span style="color: red;">Create Interest</span></a>

            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <!---
                    <li>
                        <a href="about.html">About</a>
                    </li>
                    <li>
                        <a href="services.html">Services</a>
                    </li>
                    <li>
                        <a href="contact.html">Contact</a>
                    </li>
                -->
                 
                    <li>
                        <a href = "create_interest.php">Create Interest</a>
                    </li>

                    <li>
                        <a href = "logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li></li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
    

        <!-- Content Row -->
        <div class="row">
            
            <div class="signup-container">
                <div class="first-box">
                    <span style="color:red"><h2>Upcoming Events!</h2></span>
                    <span style="color:red"><lable>Look at all the fun stuff that's in store for you!</label></span>
                </div>
				<?php while($row = $upcomingEvents->fetch_assoc())
				{
				echo "
                <div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'>
				  <div class='panel panel-default'>
				    <div class='panel-heading' role='tab' id='headingOne'>
				      <h4 class='panel-title'>
				        <a role='button' data-toggle='collapse' data-parent='#accordion' href='#collapseOne' aria-expanded='true' aria-controls='collapseOne'>
				          Event ID: " . $row['event_id'] . "
				        </a>
				      </h4>
				    </div>
				    <div id='collapseOne' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'>"
						?><?php
						echo "Event Name:  ". $row['title']; ?><br/><?php
						echo "Start Time: " . $row['start_time']; ?><br/><?php
						echo "End Time: " . $row['end_time']; ?><br/><?php
						echo "Group: " . $row['group_id']; ?><br/><?php
						echo "Location: " . $row['lname']; ?><br/><?php
						echo "Zip	: " . $row['zip']; ?><br/><?php echo "
				      <div class='panel-body'>
				      </div>
				    </div>
				  </div> 
				  </div>"; 
				  } ?>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>