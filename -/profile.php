
<?php
session_start();
include '../config.php';
if (strlen($_SESSION['alogin']) == 0) {
  header('location:../index.php');
} else {
$username = $_SESSION['alogin'];

if (isset($_POST['submit'])) {

  
  
  $name=$_POST['name'];
  $email=$_POST['email'];
  $contact=$_POST['contact'];
 
 

$sql=mysqli_query($con,"UPDATE `user` SET `name`='$name',`email`='$email',`notel`='$contact' WHERE id='".$_SESSION['id']."'");
if($sql){	
  echo "<script type='text/javascript'> alert('Successfully Update.'); </script>";
  // echo "<script type='text/javascript'> document.location = 'manage-kj.php?id=$dept'; </script>";
   
  }else{
  echo "<script type='text/javascript'> alert('Sorry!! Unsuccessful Recorded.'); </script>";
  }
} 

if (isset($_POST['update'])) {



  $dir="../profilePic/";
  $image=$_FILES['uploadfiles']['name'];
  $temp_name=$_FILES['uploadfiles']['tmp_name'];

  if($image!="")
  {
      if(file_exists($dir.$image))
      {
          $image= time().'_'.$image;
      }

      $fdir= $dir.$image;
      move_uploaded_file($temp_name, $fdir);
  }
  

$sql=mysqli_query($con,"UPDATE `user` SET `pic`='$image' WHERE id='".$_SESSION['id']."'");
if($sql){	
  echo "<script type='text/javascript'> alert('Successfully Update.'); </script>";
   
  }else{
  echo "<script type='text/javascript'> alert('Sorry!! Unsuccessful Recorded.'); </script>";
  }
} 


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php include 'includes/title.php'; ?></title>
<?php include 'includes/meta.php'; ?>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../file/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../file/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../file/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../file/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../file/dist/css/adminlte.min.css">
  <!-- added PAKAR css -->
  <link rel="stylesheet" href="../file/dist/css/PAKAR.css">
  <!-- SweetAlert2 -->
<link rel="stylesheet" href="../file/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<!-- Toastr -->
<link rel="stylesheet" href="../file/plugins/toastr/toastr.min.css">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  


  <!-- /header -->
  <?php include 'includes/header.php'; ?>

  <!-- /sidebar -->
  <?php include 'includes/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="page-title">My Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              
              <li class="breadcrumb-item active">Edit Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        

        <div class="row">


        
          <div class="col-md-3">

          <form class="form-horizontal row-fluid" name="addjob" method="post" enctype="multipart/form-data">
<?php

$query = mysqli_query($con, "SELECT * FROM user WHERE id='".$_SESSION['id']."'");
$cnt = 1;
while ($row = mysqli_fetch_array($query)) {
?>

<div class="card card-primary card-outline">
              <div class="card-body box-profile">
               


              <div class="profile-pic-wrapper" >
                <div class="pic-holder" style ="border: 3px solid gray;">
                  <!-- uploaded pic shown here -->
                  <?php if(empty($row['pic'])){ 
                    echo '<img id="profilePic" style ="border: 3px solid white; border-radius: 100%;" class="pic" src="../file/dist/img/user1.jpg">';
                  }else{
                    echo '<img id="profilePic" style ="border: 3px solid white; border-radius: 100%;" class="pic" src="../profilePic/'.$row['pic'].'">';
                  }  ?>
                  
                </div>

                
              </div>

            <br>



                <p class="text-muted text-center">Picture</p>

               

                <div style="height: auto; display : flex; text-align : center; justify-content: center; float: center;">
                <a data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" class="btn btn-success btn-block"><i class="fas fa-pencil-alt"></i> <b>Update Profile</b></a>
                 <!-- <a href="Profile-edit.php" style=" width: 125px;" class="btn btn-success btn-block"><i class="fas fa-pencil-alt"></i> <b>Edit Profile</b></a> -->
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- Profile Image -->
            

            

           
          </div>
          
          <!-- /.col -->

          
          <div class="col-md-9">
            <div class="card card-primary card-outline">
            <div class="card-header p-2">
            <h2 class="card-title add m-2">
              User Details
            </h2>
            <div class="card-tools">
              <a href="#" type="button" class="btn btn-tool" >
                <i class="fas fa-times"></i>
              </a>
            </div>
          </div>
          <!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div >
                    <form class="form-horizontal">

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Staff ID</label>
                        <div class="col-sm-10">
                          <input type="text" style="background-color: white;"class="form-control"   value="<?php echo htmlentities($row['staf_id']); ?>" placeholder="CB190322" disabled>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                          <input type="text" style="background-color: white;"class="form-control" name="name"  value="<?php echo htmlentities($row['name']); ?>" placeholder="Name" >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Contact No.</label>
                        <div class="col-sm-10">
                          <input type="text" style="background-color: white;"  class="form-control" name="contact" value="<?php echo htmlentities($row['notel']); ?>" placeholder="Name" >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" style="background-color: white;" class="form-control" name="email"  value="<?php echo htmlentities($row['email']); ?>" placeholder="email" >
                        </div>
                      </div>
                    

                      

                     
                      <!-- /.form-group -->

                      <div class="card-footer">
                            <button  type="submit" name="submit" class="btn btn-primary float-right shadow-sm rounded mr-2"  >Submit</button><a>
                            <a  href="profile.php.php" class="btn btn-default bg-white shadow-sm float-right rounded mr-2">Cancel</a>
                                

                      </div>
                     
                      <?php } ?>
                      
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->


             
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->


       
        

    </section>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update picture</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal row-fluid" name="editjob" method="post" enctype="multipart/form-data">
      
      <div class="drop-zone" style="text-align: center; justify-content: center;">
                        <span class="drop-zone__prompt">Drop .jpg .png file here or click to upload picture</span>
                        <input type="file" name="uploadfiles" class="drop-zone__input">
                      </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
        <button  name="update" class="btn btn-info" >Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Signature</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal row-fluid" name="editjob" method="post" enctype="multipart/form-data">
      
      <div class="drop-zone" style="text-align: center; justify-content: center;">
                        <span class="drop-zone__prompt">Drop .jpg .png file here or click to upload Signature</span>
                        <input type="file" name="uploadfile" class="drop-zone__input">
                      </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
        <button  name="updatede" class="btn btn-info" >Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
  include 'includes/footer.php';
 ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../file/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../file/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../file/dist/js/adminlte.min.js"></script>

<!-- SweetAlert2 -->
<script src="../file/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../file/plugins/toastr/toastr.min.js"></script>


<!-- Page specific script -->
<script src="../file/dist/js/app.js"></script>
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>



<script>
  document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
  const dropZoneElement = inputElement.closest(".drop-zone");

  dropZoneElement.addEventListener("click", (e) => {
    inputElement.click();
  });

  inputElement.addEventListener("change", (e) => {
    if (inputElement.files.length) {
      updateThumbnail(dropZoneElement, inputElement.files[0]);
    }
  });

  dropZoneElement.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropZoneElement.classList.add("drop-zone--over");
  });

  ["dragleave", "dragend"].forEach((type) => {
    dropZoneElement.addEventListener(type, (e) => {
      dropZoneElement.classList.remove("drop-zone--over");
    });
  });

  dropZoneElement.addEventListener("drop", (e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
      inputElement.files = e.dataTransfer.files;
      updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
    }

    dropZoneElement.classList.remove("drop-zone--over");
  });
});

/**
 * Updates the thumbnail on a drop zone element.
 *
 * @param {HTMLElement} dropZoneElement
 * @param {File} file
 */
function updateThumbnail(dropZoneElement, file) {
  let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

  // First time - remove the prompt
  if (dropZoneElement.querySelector(".drop-zone__prompt")) {
    dropZoneElement.querySelector(".drop-zone__prompt").remove();
  }

  // First time - there is no thumbnail element, so lets create it
  if (!thumbnailElement) {
    thumbnailElement = document.createElement("div");
    thumbnailElement.classList.add("drop-zone__thumb");
    dropZoneElement.appendChild(thumbnailElement);
  }

  thumbnailElement.dataset.label = file.name;

  // Show thumbnail for image files
  if (file.type.startsWith("image/")) {
    const reader = new FileReader();

    reader.readAsDataURL(file);
    reader.onload = () => {
      thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
    };
  } else {
    thumbnailElement.style.backgroundImage = null;
  }
}
</script>
</body>
</html>
<?php } ?>