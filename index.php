<?php
session_start();
error_reporting(0);
include 'config.php';

date_default_timezone_set('Asia/Kuala_lumpur');// change according timezone
$currentTime = date('Y-m-d H:i:s', time () );

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $rot = mysqli_query($con, "SELECT * FROM user WHERE staf_id='$username'  ");
    $qq=mysqli_fetch_array($rot);

      $ac=$qq['acl'];

      // echo "<script type='text/javascript'> alert('Successfully Recorded. $ac'); </script>";
  
   if($ac==1 ){
//admin
      $ret = mysqli_query($con, "SELECT * FROM user WHERE staf_id='$username' and password='$password' and acl=1 ");
        $num = mysqli_fetch_array($ret);
        if ($num > 0) {
            $extra = '`/dashboard.php';
            $_SESSION['alogin'] = $_POST['username'];
            $_SESSION['id'] = $num['id'];
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            header("location:http://$host$uri/$extra");
            exit();
        } else {
            $_SESSION['errmsg'] = 'Invalid username or password';
            $extra = 'index.php';
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            header("location:http://$host$uri/$extra");
            exit();
        }

   }elseif($ac==2 ){
//technician
    $ret = mysqli_query($con, "SELECT * FROM user WHERE staf_id='$username' and password='$password' and acl=2");
    $num = mysqli_fetch_array($ret);
    if ($num > 0) {
        $extra = '-/dashboard.php';
        $_SESSION['alogin'] = $_POST['username'];
        $_SESSION['id'] = $num['id'];

        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("location:http://$host$uri/$extra");
        exit();
    } else {

        $_SESSION['errmsg'] = 'Invalid username or password';
        $extra = 'index.php';
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("location:http://$host$uri/$extra");
        exit();
    }
   }elseif(empty($ac)){
    //error
       
    $_SESSION['errmsg'] = 'Invalid username or password';
    $extra = 'index.php';
    $host = $_SERVER['HTTP_HOST'];
    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    header("location:http://$host$uri/$extra");
    exit();
        
       }
}
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>IFCP</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="`/data/jasa.png" rel="icon">

<meta name="title" content="IFCP">
<meta name="description" content="IFCP">
<meta name="keywords" content="IFCP">
<meta name="robots" content="index, follow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="language" content="English">
<meta name="author" content="IFCP">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="file/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="file/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="file/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <style>


    </style>
</head>
<body class="hold-transition login-page" style="background-image: url(2132978.png);   background-attachment: fixed;">



<div class="login-box">
  <div class="login-logo">
    <a  style="color:white; font-size:30px;">WELCOME TO  <b>IFCP(DEMO)</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      
      <form  method="post">
						<div class="module-head">
                        <a href="index.php"><b></b></a>
						</div>
						<span style="color:red;" ><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg'] = ''); ?></span>
					<div class="input-group mb-3">
					  <input  type="text" name="username" class="form-control" placeholder="No Staff">
            <div class="input-group-append">
              <div class="input-group-text">
                <i class="fas fa-user"></i>
              </div>
            </div>
          </div>


						<div class="input-group mb-3">
									<input type="password" name="password" class="form-control" placeholder="Password">
                  <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
            </div>

            <div class="row">
          <!-- <div class="col-8">
            <div class="icheck-primary">
            <input type="checkbox" id="remember">
            <label for="remember">
                remember Me
              </label>
            </div>
            </div> -->

							<!-- /.col -->
								<div class="col-12">
									<button type="submit" class="btn btn-primary btn-block" name="submit">Login</button>
								</div>
							<!-- /.col -->
						</div>
					</form>

    <p class="mb-1">
        <a href="forgot-password.php">Forgot Password</a>
        <a class="float-right" href="`/index.php">Client View</a>
      </p>
     
      <!-- <p class="mb-1">
        <a href="../register.php">Daftar Akaun Baru</a>
      </p> -->
      

      <!-- <div class="social-auth-links text-center mb-3">
        <p>- ATAU -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
     

     
     
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="file/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="file/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="file/dist/js/adminlte.min.js"></script>

</body>
</html>
