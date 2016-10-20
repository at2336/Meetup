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

	$pStmt = $conn->prepare("SELECT * FROM groups, belongs_to, member WHERE member.username = belongs_to.username AND groups.group_id = belongs_to.group_id AND member.username = ?");
	$username = $_SESSION['username'];
	$pStmt->bind_param("s", $username);
	$pStmt->execute();
	$pStmt = $pStmt->get_result();
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
    <nav class="navbar navbar-fixed-top" role="navigation">
        <div class="container">
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
                        <a href="logout.php">Logout</a>
                    </li>
                    <li>
                        <a href="#">English <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="full-width.html">Full Width Page</a>
                            </li>
                            <li>
                                <a href="sidebar.html">Sidebar Page</a>
                            </li>
                            <li>
                                <a href="faq.html">FAQ</a>
                            </li>
                            <li>
                                <a href="404.html">404</a>
                            </li>
                            <li>
                                <a href="pricing.html">Pricing Table</a>
                            </li>
                        </ul>
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
        <div class="form-group">
        <br>
		</div>
    </div>
    


        <!-- Content Row -->
        <div class="row">
            
            <div class="signup-container">
                <div class="first-box">
                    <span style="color:red"><h2>Create an Event!</h2></span>
                </div>
            <form action = "update_event.php" role="form" method = "post" onsubmit="return validateForm()" name = "registerForm">
                <div class="second-box">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="name" name = "title" class="form-control" id="pass" placeholder="Enter Tile of Event" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="name" name = "description" class="form-control" id="verifypwd" placeholder="Enter Description" required>
                    </div>
                    <div class="form-group">
                        <label for="start_time">Start time</label>
                        <input type="time" name = "starttime" class="form-control" id="first" placeholder="Enter the Start time of Event" required>
                    </div>
                    <div class="form-group">
                        <label for="end_time">End Time</label>
                        <input type="time" name = "endtime" class="form-control" id="last" placeholder="Enter the End time of Event" required>
                    </div>
                    <div class="form-group">
                        <label for="e_date">Event Date</label>
                        <input type="date" name = "eventdate" class="form-control" id="zipcode" placeholder="Enter Date of Event" required>
                    </div>
                    <div class="form-group">
                        <label for="lname">Location Name</label>
                        <input type="name" name = "lname" class="form-control" id="zipcode" placeholder="Enter Location Name" required>
                    </div>
                    <div class="form-group">
                        <label for="zip">Zipcode</label>
                        <input type="name" name = "zip" class="form-control" id="zipcode" placeholder="Enter Zipcode of Event" required>
                    </div>
					<div class="form-group">
                        <label for="zip">Group ID</label>
                        <input type="name" name = "groupID" class="form-control" id="zipcode" placeholder="Enter ID of Group Hosting the Event" required>
                    </div>
					<br/>
                </div>
                <input type="submit"class="btn btn-default" value = "Create Event"></button>
            </form>
        </div>
            
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
