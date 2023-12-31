<!DOCTYPE html>
<html lang="en">
<?php


require_once('functions.php');
require "admin/users/users.php";

if(isset($_SESSION['email'])) die('You are already sign in, no need to sign in.');
$showForm=true;
if(count($_POST)>0){
	if(isset($_POST['email'][0]) && isset($_POST['password'][0])){
		// process information
		$index=0;
		$fp=fopen('data/users.csv','r');
		while(!feof($fp)){
			$line=fgets($fp);
			
			if(strstr($line,'<?php die() ?>') || strlen($line)<5) continue;
			$index++;
			$line=explode(',',trim($line));
			
		
			
			if($line[0]==$_POST['email'] && $line[1]==$_POST['password']){
				// Sign the user in
				//1. Save the user's data into the session
				$_SESSION['email']=$_POST['email'];
				$_SESSION['password']=$_POST['password'];
				$_SESSION['id']=$line[3];
				
				header("Location: index.php");
				//2. Show a welcome message
				echo 'Welcome to our website';$showForm=false;
				if($line[2]==1){
					$_SESSION['admin']=true;
					header("Location: admin/index.php");
					
				}else{
					$_SESSION['admin']=false;
			}
		 }
		}
		fclose($fp);
		// The credentials are wrong
		if($showForm) {echo 'Your credentials are wrong';}
					//print_r($line);
					//echo $_POST['email'];
					//echo $_POST['password'];
		}else echo 'Email and password are missing';
}
//if user isAdmin() header admin folder
if($showForm){
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
   <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
   <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">


    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" method="POST" action="login.php">
										<div class="form-group">
											<input type="email" class="form-control form-control-user" name="email"
												id="exampleInputEmail" aria-describedby="emailHelp"
												placeholder="Enter Email Address...">
										</div>
										<div class="form-group">
											<input type="password" class="form-control form-control-user" name="password"
												id="exampleInputPassword" placeholder="Password">
										</div>
									  
										<button type="submit">Log in</button>
									</form>

                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
<?php }?>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

</body>

</html>
