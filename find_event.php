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
$eventsByDate = False;
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$start = $_POST['s_date'];
	$end = $_POST['e_date'];
	$eventsByDate = $conn->prepare("SELECT * FROM events WHERE start_time between ? AND ?");
	$start = date("Y-m-d H:i:s", mktime(0,0,0, substr($start, 5, 2), substr($start, 8, 2), substr($start, 0, 4)));
	$end = date("Y-m-d H:i:s", mktime(0,0,0, substr($end, 5, 2), substr($end, 8, 2), substr($end, 0, 4)));
	$eventsByDate->bind_param("ss", $start, $end);
	$eventsByDate->execute();
	$eventsByDate = $eventsByDate->get_result();
}
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
                <a class="navbar-brand" href="find_event.php"><span style="color: red;">Find event</span></a>               

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
                        <a href="signup.html">Sign Up</a>
                    </li>
                    <li>
                        <a href="login.php">Log in</a>
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
    
        <!-- Content Row -->
        <div class="row">
            
            <div class="signup-container">
                <div class="first-box">
                    <span style="color:red"><h2>Find an Event!</h2></span>
                </div>
            <form action = "<?php echo $_SERVER["PHP_SELF"];?>" role="form" method = "post" onsubmit="return validateForm()" name = "registerForm">
                <div class="second-box">
                    
                    <label for="e_date" class="btn btn-primary">Date Range</label>
                     <div class="form-group">
                        <label for="e_date">Start Date Range:</label>
                        <input type="date" name = "s_date" class="form-control" id="zipcode" placeholder="Enter Start Date of Event" required>
                    </div>
                    <div class="form-group">
                        <label for="e_date">End Date Range:</label>
                        <input type="date" name = "e_date" class="form-control" id="zipcode" placeholder="Enter End Date of Event" required>
                    </div>
                    
                </div>
                <div>
                    <input class="btn btn-primary" type="submit" value = "Find Events" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    </input>
                </div>
				<br/>
				<span style="color:red"><h2>List of Events:</h2></span>
				<?php 
				if(!$eventsByDate)
					echo "Please select an event first!";
				else
					echo " ";
				?>
				<?php
				if($eventsByDate)
				{
					while($row = $eventsByDate->fetch_assoc())
					{
						$temp = $row['event_id'];
						echo "Event_id: " . $temp; ?><br/><?php
						$temp = $row['title'];
						echo "Event Name: " . $temp; ?><br/><br/><?php
					}
				}
				?>
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
