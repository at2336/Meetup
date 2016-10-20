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
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	//Get username and password
	$password = $_POST['pass'];
	$verifypassword = $_POST['verifypass'];
	if($password == $verifypassword)
	{
		//Executes query and if a result is found, update password
		$pStmt = $conn->prepare("SELECT * FROM member WHERE username = ? AND zipcode = ?");
		$pStmt->bind_param("ss", $_SESSION['resetPassword'], $zipcode);
		$pStmt->execute();
		$pStmt = $pStmt->get_result();
		if($pStmt->num_rows < 1)
		{
			$updatePass = $conn->prepare("UPDATE member SET password = ? WHERE username = ?");
			$password = md5($password);
			$updatePass->bind_param("ss", $password, $_SESSION['resetPassword']);
			$updatePass->execute();
			echo "Your password has been changed!";
			header("refresh: 3,URL= index.php");
		}
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
				<a class="navbar-brand" href="signup.php">Sign Up</a>
				<a class="navbar-brand" href="login.php">Login</a>

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
            <div class="second-box">
					<h6><a class="btn btn-primary">Create Your Password!</a></h6>
                    
                                  <div class="modal-body">
                                    <div collapseExample>
                                                    <div class="well">
                                                        <form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post">
                                                            <div class="form-group">
                                                                <label for="password">New Password</label>
                                                                <input type="password" name = "pass" class="form-control" id="pass" placeholder="Enter your New password" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="password">Verify Password</label>
                                                                <input type="password" name = "verifypass" class="form-control" id="verifypwd" placeholder="Verify New Password" required>
                                                            </div>
                                                            <input type="submit" value ="Set New Password!" class="btn btn-default"></submit>
                                                        </form>
                                                    </div>
                                                </div>
                                  </div>
                                  <div class="modal-footer">
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
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
