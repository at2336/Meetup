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
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$pStmt = $conn->prepare("INSERT into groups(group_name, description, username) VALUES (?,?,?)");
	$creator = $_SESSION['username'];
	$groupname = $_POST['groupname'];
	$description = $_POST['description'];
	$pStmt->bind_param("sss", $groupname, $description, $creator);
	$pStmt->execute();
	if($pStmt)
	{
		echo "Congratulations, you have founded a group!";
		header('Refresh: 3; URL=index.php');
	}
	else
	{
		echo "There was an error creating your group, please try again";
		header('Refresh: 3; URL=index.php');
	}
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
    

        <!-- Content Row -->
        <div class="row">
            
            <div class="signup-container">
                <div class="first-box">
                    <span style="color:red"><h2>Create a Group!</h2></span>
                </div>
            <form action = "<?php echo $_SERVER["PHP_SELF"]; ?>" role="form" method = "post" onsubmit="return validateForm()" name = "registerForm">
                <div class="second-box">
                    <div class="form-group">
                        <label for="title">Group Name</label>
                        <input type="name" name = "groupname" class="form-control" id="pass" placeholder="Enter Group Name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="name" name = "description" class="form-control" id="verifypwd" placeholder="Enter Description" required>
                </div>
                <input type="submit"class="btn btn-default" value = "Create Group!"></button>
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
