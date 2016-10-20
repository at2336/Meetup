<?php
session_start();

if(isset($_SESSION['username']))
	header("Location:index.php");

$servername = "localhost";
$dbusername = "root";
$dbpassword = "" ;
$dbname = "meetup";
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if(!$conn) 
	die("Unable to connect to database");
//Prepared statement to query, protects against SQL Injection
$pStmt = $conn->prepare("SELECT username, zipcode FROM member WHERE username = ? AND zipcode = ?");
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	//Get username and password
	$username = $_POST['username'];
	$zipcode = $_POST['zipcode'];

	//Replaces ? with username and password
	$pStmt->bind_param("sd", $username, $zipcode);
	//Executes query and if a result is found, log in and create session
	$pStmt->execute();
	$pStmt = $pStmt->get_result();
	if($pStmt->num_rows > 0)
	{
		$_SESSION['resetPassword'] = $username;
		header("Location: create_new_password.php");
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Meetup</title>

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
                        <a href="login.php"><span style="color: red;">Log in</span></a>
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

        <div class="login-container">
            <form  action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" role="form">
            <div class="second-box">
					<h6><a class="btn btn-primary">Enter Your Information?</a></h6>
                        <div class="well">
                                <div class="form-group">
                                    <label for="username">Verify Username</label>
                                    <input type="password" name = "username" class="form-control" id="pass" placeholder="Verify your Username" required>
                                </div>
                                <div class="form-group">
                                    <label for="zipcode">Verify Zipcode</label>
                                    <input type="zipcode" name = "zipcode" class="form-control" id="verifyzip" placeholder="Verify your Zipcode" required>
                                </div>
                                <input type="submit" value = "Update Password!" class="btn btn-default btn-lg"></button>
                        </div>
                </div>
				</form>
            </div>
        </div>

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
