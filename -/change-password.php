
<?php
session_start();
include '../config.php';
if (strlen($_SESSION['alogin']) == 0) {
  header('location:../index.php');
} else {
date_default_timezone_set('Asia/Kuala_Lumpur'); // change according timezone
$currentTime = date( 'Y-m-d H:i:s', time () );


if (isset($_POST['submit'])) {
  $sql = mysqli_query($con, "SELECT password FROM  user where password='".md5($_POST['password'])."' && id='".$_SESSION['id']."'");
  $num = mysqli_fetch_array($sql);
  if ($num > 0) {
    $con = mysqli_query($con, "update user set password='".md5($_POST['newpassword'])."' where id='".$_SESSION['id']."'");
    echo "<script type='text/javascript'> alert('Successfully Change. Please Login Again.'); </script>";
    echo "<script type='text/javascript'> document.location = 'logout.php'; </script>";

  } else {
    echo "<script type='text/javascript'> alert('Failed.'); </script>";
  }
} ?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php include 'includes/title.php'; ?></title>
<?php include 'includes/meta.php'; ?>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../file/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../file/dist/css/PAKAR.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../file/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../file/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<script type="text/javascript">
  function valid()
  {
    if(document.chngpwd.password.value=="")
    {
      alert("Current Password Filed is Empty !!");
      document.chngpwd.password.focus();
      return false;
    }
    else if(document.chngpwd.newpassword.value=="")
    {
      alert("New Password Filed is Empty !!");
      document.chngpwd.newpassword.focus();
      return false;
    }
    else if(document.chngpwd.confirmpassword.value=="")
    {
      alert("Confirm Password Filed is Empty !!");
      document.chngpwd.confirmpassword.focus();
      return false;
    }
    else if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
    {
      alert("Password and Confirm Password Field do not match  !!");
      document.chngpwd.confirmpassword.focus();
      return false;
    }
    return true;
  }
</script>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php include 'includes/header.php'; ?>
  <?php include 'includes/sidebar.php'; ?>


  <div class="content-wrapper">

  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="page-title">Change Password</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            
              <li class="breadcrumb-item active">Change Password</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">


        <div class="card">

          <div class="card-body">

        


            <form class="form-horizontal row-fluid" name="chngpwd" method="post" onSubmit="return valid();">

              <div class="control-group pb-3">

                <a class="control-label pt-2" for="basicinput">Current Password</a>
                <div class="controls pt-2">
                  <input type="password" placeholder="Enter your current Password"  name="password" class="form-control" required>
                </div>
              </div>


<div class="control-group pb-3">
  <a class="control-label" for="basicinput">New Current Password</a>
  <div class="controls pt-2">
    <input type="password" placeholder="Enter your new current Password"  name="newpassword" class="form-control" required>
  </div>
</div>

              <div class="control-group pb-3">
                <a class="control-label" for="basicinput">New Password Again</a>
                <div class="controls pt-2">
                  <input type="password" placeholder="Enter your new Password again"  name="confirmpassword" class="form-control" required>
                </div>
              </div>






              <div class="control-group pt-3 text-right">
                <div class="controls">
                  <button type="submit" name="submit" class="btn btn-primary ">Change</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>


      </div><!--/.content-->
  </div><!--/.span9-->





  <?php include 'includes/footer.php'; ?>

</body>
  </html>


  <script src="../file/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../file/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE -->
  <script src="../file/dist/js/adminlte.js"></script>

  <!-- OPTIONAL SCRIPTS -->
  <script src="../file/plugins/chart.js/Chart.min.js"></script>

  <script src="../file/dist/js/pages/dashboard3.js"></script>

  <?php
} ?>
