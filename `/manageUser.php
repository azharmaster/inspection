
<?php
session_start();
include('../config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
date_default_timezone_set('Asia/Kuala_lumpur');// change according timezone
$currentTime = date( 'Y-m-d H:i:s', time () );
$namepage=basename($_SERVER['PHP_SELF']);

if (isset($_POST['submit'])) {

  $no=$_POST['no'];
    $name=$_POST['name'];
    $contact=$_POST['contact'];
    $email=$_POST['email'];
    $role=$_POST['role'];
    $dept=$_POST['dept'];
    
  //81dc9bdb52d04dc20036dbd8313ed055
              $sql=mysqli_query($con,"INSERT INTO `user`(`staf_id`, `name`, `email`, `notel`, `password`, `acl`,`dept_id`, `cdate`) 
              VALUES (UPPER('$no'),'$name','$email','$contact','81dc9bdb52d04dc20036dbd8313ed055','$role','$dept','$currentTime')");
              if($sql){	
            echo "<script type='text/javascript'> alert('Successfully Recorded.'); </script>";
            echo "<script type='text/javascript'> document.location = '$namepage'; </script>";
            
            }else{
            echo "<script type='text/javascript'> alert('Sorry!! Unsuccessful.'); </script>";
            }


}

if (isset($_POST['update'])) {

  $id=$_POST['idd'];
  $stafid=$_POST['stafid'];
  $name=$_POST['name'];
  $contact=$_POST['contact'];
  $email=$_POST['email'];
  $role=$_POST['role'];
  $dept=$_POST['dept'];

		         $ssq= mysqli_query($con,"UPDATE `user` SET `staf_id`='$stafid',`name`='$name',`notel`='$contact',
             `email`='$email',`dept_id`='$dept',`acl`='$role' WHERE id = '$id'");
             if($ssq){	
              echo "<script type='text/javascript'> alert('Successfully Updated.'); </script>";
              echo "<script type='text/javascript'> document.location = '$namepage'; </script>";
              
              }else{
              echo "<script type='text/javascript'> alert('Sorry!! Unsuccessful.'); </script>";
              }
		  }

if(isset($_GET['up']))
		  {
		         $ssq= mysqli_query($con,"UPDATE `user` SET `status`='0' WHERE id = '".$_GET['id']."'");
             if($ssq){	
              echo "<script type='text/javascript'> alert('Successfully Unblacklist.'); </script>";
              echo "<script type='text/javascript'> document.location = 'manageUser.php'; </script>";
              
              }else{
              echo "<script type='text/javascript'> alert('Sorry!! Unsuccessful.'); </script>";
              }
		  }

if(isset($_GET['down']))
		  {
		         $ssq= mysqli_query($con,"UPDATE `user` SET `status`='1' WHERE id = '".$_GET['id']."'");
             if($ssq){	
              echo "<script type='text/javascript'> alert('Successfully Blacklist.'); </script>";
              echo "<script type='text/javascript'> document.location = 'manageUser.php'; </script>";
              
              }else{
              echo "<script type='text/javascript'> alert('Sorry!! Unsuccessful.'); </script>";
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
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../file/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../file/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../file/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../file/dist/css/adminlte.min.css">
  <!-- added PAKAR css -->
  <link rel="stylesheet" href="../file/dist/css/PAKAR.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../file/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../file/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../file/plugins/summernote/summernote-bs4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../file/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../file/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../file/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../file/dist/css/adminlte.min.css">
  <!-- added PAKAR css -->
  <link rel="stylesheet" href="../file/dist/css/PAKAR.css">

  <script>
function userAvailability2() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_id.php",
data:'no='+$("#no").val(),
type: "POST",
success:function(data){
$("#user-availability-status2").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
  <script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_email.php",
data:'email='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

</script>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  


  <!-- /header -->
  <?php
  include 'includes/header.php';
  include 'includes/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="page-title">User Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">User Management</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-primary card-outline">
              <div class="table-top" >
                <h2 class="table-title">List of User Dept</h2>
                <a data-toggle="modal" title="Add User" 
                  class="open-qq btn btn-primary shadow-sm p-8 mr-4 rounded " href="#add-user">
                  <i class="fas fa-plus"></i>&nbsp; Add 
                </a>
              </div>
              <hr>
              
              <!-- /.card-header -->
              <div class="card-body one">
                <table id="example1" class="table table-bordered table-hover">
                <thead class="table table-secondary">
                  <tr class="text-left">
                    <th>#</th>
                    <th>Staf Id </th>
											<th>Name </th>
                      <th>Contact No</th>
											<th>Email </th>
                      <th>Dept </th>
                     
                      <th>Reg Date </th>
											<th style="width: 80px;">Action</th>
											
                  </tr>
           

                  </thead>
                  <tbody>

                  <?php 

                  $query=mysqli_query($con,"SELECT * FROM user  ");
                  $cnt=1;
                  while($row=mysqli_fetch_array($query))
                  {
                  ?>		
  

                  <span hidden id="dept<?php echo $row['id']; ?>"><?php echo $row['dept_id']; ?></span>
                  <span hidden id="acl<?php echo $row['id']; ?>"><?php echo $row['acl']; ?></span>

                  <tr class="text-left">
                  <td><?php echo htmlentities($cnt); ?></td>
                  <td><span id="staf<?php echo $row['id']; ?>"><?php echo $row['staf_id']; ?></span></td>
                  <td><span id="name<?php echo $row['id']; ?>"><?php echo $row['name']; ?></span></td>
                  <td><span id="notel<?php echo $row['id']; ?>"><?php echo $row['notel']; ?></span></td>
                  <td><span id="email<?php echo $row['id']; ?>"><?php echo $row['email']; ?></span></td>

                  <td>
                  <?php  
                  $qu=mysqli_query($con,"SELECT * FROM dept WHERE id='".$row['dept_id']."' ");
                  $rw=mysqli_fetch_array($qu); if($rw){echo $rw['dept'];}else{echo 'admin';} ?> 
                  
                </td>
                     
                 <td><?php echo htmlentities($row['cdate']); ?></td>
                	
                      <td> <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
                                  
                            <button  class="dropdown-item edit" value="<?php echo $row['id']; ?>"><span class="fas fa-edit text-primary"></span> Edit</button>
				                    <!-- <a class="dropdown-item" href="#"><span class="fas fa-edit text-primary"></span> Edit</a> -->
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="<?php echo $namepage ?>?id=<?php echo htmlentities($row['id']); ?>&del" onClick="return confirm('Are you sure you want to delete?')"><span class="fas fa-trash text-danger"></span> Delete</a>
				                  </div></td>
                    <?php //} 
                    $cnt=$cnt+1; } ?>

                  </tr>
                  </tbody>
                  
                </table>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

        
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->

      
	
<?php include('popup/modal_user.php'); ?>

      

      <!-- /.start add user modal-->
      <div class="modal hide" id="add-user">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <form class="form-horizontal row-fluid" name="asd" method="post" >

              <div class="row">
              <!-- <div class="col-md-6">


                <div class="form-group">
                <label style="text-align: center;">Upload Profile Picture</label>
                <br><br>

                <div class="profile-pic-wrapper" >
                  <div class="pic-holder" style ="">
                    uploaded pic shown here 
                    <img id="profilePic" style ="border: 3px solid white; border-radius: 100%;" class="pic" src="../file/dist/img/user1.jpg">

                    <Input class="uploadProfileInput" type="file" name="profile_pic" id="newProfilePhoto" accept="image/*" style="opacity: 0;" />
                    <label for="newProfilePhoto" class="upload-file-block">
                      <div class="text-center">
                        <div class="mb-2">
                          <i class="fa fa-camera fa-2x"></i>
                        </div>
                        <div class="text-uppercase">
                          Upload <br /> Profile Photo
                        </div>
                      </div>
                    </label>
                  </div>
                </div>
                </div> -->
                <!-- /.form-group 
                

              <br>
                
               
              
                

              
              </div>-->
              <!-- /.col -->
              <div class="col-md-12">

              
                <!-- /.form-group -->

               
                <div class="form-group">
                  <label>ID Number</label>
                  <input type="text" class="form-control input" name="no" id="no" onBlur="userAvailability2()" placeholder="Enter ID number.." required>
                  <span id="user-availability-status2" style="font-size:12px;"></span>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control input" name="name" id="inputName" placeholder="Enter name.." required>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                  <label>Phone Number</label>
                  <input type="number"  class="form-control input" name="contact" id="inputPhoneNo" placeholder="Enter phone number.." required>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control input" name="email" id="email" onBlur="userAvailability()" placeholder="Enter email.." required>
                  <span id="user-availability-status1" style="font-size:12px;"></span>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
            <label  class="col-form-label">Role:</label>
              <select  class="form-control" name="role"  required>
                <option value="">Choose </option>
                <option value="1">Admin </option>
                <option value="2">Department </option>
              </select>
          </div>

                <div class="form-group">
            <label  class="col-form-label">Dept:</label>
            <select class="form-control"  name="dept" required>
                  <option value="">Choose</option>
                  <?php 
                  $query=mysqli_query($con,"SELECT * FROM dept");
                  while($row=mysqli_fetch_array($query))
                  { ?>		
                  <option value="<?php echo $row['id'] ?>"><?php echo $row['dept'] ?></option>
                  <?php  } ?>
            </select>
          </div>
             

                <div class="form-group">
                  <label>Password</label>
                  <input type="text" class="form-control input" placeholder="1234"  disabled>
                </div>
                <!-- /.form-group -->

              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button  name="submit" class="btn btn-primary" >Submit</button>
            </div>
                  </form>
          </div><!-- /.end modal content-->
        </div> <!-- /.end modal dialog-->
      </div> <!-- /.end modal-->
      <!-- /.end add user modal-->

      <!-- /.start view user modal-->
      <div class="modal hide" id="view-user">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">User Profile</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <form class="form-horizontal row-fluid" name="asd" method="post" >

              <div class="row">
              <div class="col-md-6">
                

              <br>
                
                <div class="form-group">
                  <label>Upload signature</label>

                  <div class="drop-zone" style="text-align: center; justify-content: center; height: 220px;">
                            <span class="drop-zone__prompt"> </span>
                            <input type="file" name="myFile" class="drop-zone__input"  value=" "disabled>
                  </div>

                </div>
                <!-- /.form-group -->
                

                

              </div>
              <!-- /.col -->
              <div class="col-md-6">

              <div class="form-group">
                  <label>Role</label>
                  <input type="text" style="background-color: white;" class="form-control"  value="Admin" placeholder="Name" disabled>

                </div>
                <!-- /.form-group -->

               
                <div class="form-group">
                  <label>ID Number</label>
                  <input type="text" style="background-color: white;"class="form-control" placeholder="Name" disabled>
                </div>
                <!-- /.form-group -->

                

                <div class="form-group">
                  <label>Name</label>
                  <input type="text" style="background-color: white;"class="form-control"  placeholder="Name" disabled>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                  <label>Phone Number</label>
                  <input type="text" style="background-color: white;"class="form-control"   placeholder="Name" disabled>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                  <label>Email</label>
                  <input type="text" style="background-color: white;" class="form-control"  placeholder="Name" disabled>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                  <label>Location</label>
                  <input type="text" style="background-color: white;" class="form-control"   placeholder="Name" disabled>
                </div>
                <!-- /.form-group -->

              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>

          </div><!-- /.end modal content-->
        </div> <!-- /.end modal dialog-->
      </div> <!-- /.end modal-->
      <!-- /.end view user modal-->




    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- /.content-wrapper footer -->
  <?php include 'includes/footer.php'; ?>

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
<!-- DataTables  & Plugins -->
<script src="../file/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../file/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../file/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../file/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../file/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../file/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../file/plugins/jszip/jszip.min.js"></script>
<script src="../file/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../file/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../file/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../file/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../file/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../file/dist/js/adminlte.min.js"></script>
<script>
  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
  </script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": [ 
                    {  
                        extend: 'excel',  
                        className: 'btn btn-default rounded excel',  
                        text: '<i class="far fa-file-excel"></i> Excel'  
                    },  
                    {  
                        extend: 'pdf',  
                        className: 'btn btn-default rounded pdf',  
                        text: '<i class="far fa-file-pdf"></i> Pdf'  
                    },   
                    {  
                        extend: 'print',  
                        className: 'btn btn-default rounded print',  
                        text: '<i class="fas fa-print"></i> Print'  
                    },
                    {  
                        extend: 'colvis',  
                        className: 'btn btn-default rounded pdf',  
                        text: '<i class="fas fa-sort"></i> Filter'  
                    }     ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  });

  $(document).ready(function(){
	$(document).on('click', '.edit', function(){
		var id=$(this).val();
    var sec=$('#staf'+id).text();
		var first=$('#name'+id).text();
		var last=$('#notel'+id).text();
		var email=$('#email'+id).text();
    var ee=$('#dept'+id).text();
    var acl=$('#acl'+id).text();
	
		$('#edit').modal('show');
    $('#idd').val(id);
    $('#estaf').val(sec);
		$('#ename').val(first);
		$('#enotel').val(last);
		$('#eemail').val(email);
    $('#edept').val(ee);
    $('#eacl').val(acl);
	});
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