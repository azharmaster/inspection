<?php
session_start();
include '../config.php';
if (strlen($_SESSION['alogin']) == 0) {
  header('location:../index.php');
} else { 
  date_default_timezone_set('Asia/Kuala_lumpur');// change according timezone
$currentTime = date( 'Y-m-d H:i:s', time () );
  $id=$_GET['id'];

  $namepage=basename($_SERVER['PHP_SELF']);



if (isset($_POST['submit'])) {

  $corr=$_POST['corr'];
  $idd=$_POST['idd'];

  // if (isset($_FILES['pdf_file'])) {

    $dir="../uploads/";
    $pdf=$_FILES['uploadfiles']['name'];
    $temp_name=$_FILES['uploadfiles']['tmp_name'];
  
    if($pdf!="")
    {
        if(file_exists($dir.$pdf))
        {
            $pdf= time().'_'.$pdf;
        }
  
        $fdir= $dir.$pdf;
        move_uploaded_file($temp_name, $fdir);
    }

    $sql="UPDATE `observe` SET `corrective`='$corr',`status`='1',`pdf`='$pdf',`cordate`='$currentTime' WHERE id='$idd'";
    if (mysqli_query($con, $sql)) {

      echo "<script type='text/javascript'> alert('File uploaded successfully.'); </script>";
      echo "<script type='text/javascript'> document.location = '$namepage?id=$id'; </script>";
    } else {
      echo "Error uploading file: " . mysqli_error($conn);
    }
  //}
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
  <!-- DataTables --><link rel="stylesheet" href="../file/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="../file/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../file/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../file/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../file/dist/css/adminlte.min.css">
  <!-- added PAKAR css -->
  <link rel="stylesheet" href="../file/dist/css/PAKAR.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php
  include 'includes/header.php';
  include 'includes/sidebar.php'; ?>
  <?php 

$query=mysqli_query($con,"SELECT * FROM insp WHERE id='$id' ");
$cnt=1;
while($row=mysqli_fetch_array($query))
{ ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Inspection</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Inspection</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  
   
    <!-- /.content -->

    <section class="content">
      <div class="container-fluid">
      
      <div class="row">
          <div class="col-12">
            <div class="card card-primary card-outline">
            <div class="table-top" >
              <div class="col-10">
                <h2 class="table-title">Details of Inspection</h2>
                </div>
                <div class="col-2 pt-3">
                
                </div>
              </div>
              
              <br>
              <div class="card-body one">
            <div class="row invoice-info">
                
                <div class="col-sm-12 invoice-col table-responsive">

                <span hidden id="vessel<?php echo $row['id']; ?>"><?php echo $row['vessel_id']; ?></span>
                  <span hidden id="master<?php echo $row['id']; ?>"><?php echo $row['name_master']; ?></span>
                  <span hidden id="inspby<?php echo $row['id']; ?>"><?php echo $row['insp_by']; ?></span>
                  <span hidden id="vsuper<?php echo $row['id']; ?>"><?php echo $row['name_supertendent']; ?></span>
                  <span hidden id="inspdate<?php echo $row['id']; ?>"><?php echo $row['insp_date']; ?></span>
                  <span hidden id="inspname<?php echo $row['id']; ?>"><?php echo $row['insp_id']; ?></span>

                <table class="table table-bordered table-hover">
                  <tr>
                  
                    <th>Vessel Name</th>
                    <td> <?php 
                  $quy=mysqli_query($con,"SELECT * FROM vessel WHERE id='".$row['vessel_id']."'");
                  $rw=mysqli_fetch_array($quy); if($rw){echo $rw['name'];}else{}  ?>	</td>
                    <th>Name of Master</th>
                    <td><?php echo $row['name_master'] ?></td>
                  </tr>
                  <tr>
                    <th>Inspection By </th>
                    <td><?php echo $row['insp_by'] ?></td>
                    <th>Name of Vessel Superintendent</th>
                    <td><?php echo $row['name_supertendent'] ?></td>
                  </tr>
                  <tr>
                    <th>Inspection Date</th>
                    <td><?php echo $row['insp_date'] ?></td>
                    <th>Date of Report</th>
                    <td><?php echo date('Y-m-d') ?></td>
                  </tr>
                
                  <tr>
                    <th>Inspection Name / Type </th>
                    <td colspan="3"> <?php 
                  $quy=mysqli_query($con,"SELECT * FROM inspection WHERE id='".$row['insp_id']."'");
                  $rw=mysqli_fetch_array($quy); if($rw){echo $rw['insp_name'];}else{}  ?>	 </td>
                    
                  </tr>
                </table>
                </div>
                <?php } ?>
                
                <!-- /.col -->
              </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

        
          </div>
          <!-- /.col -->
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card card-primary card-outline">
              <div class="table-top" >
                <h2 class="table-title">List of Inspection</h2>
                
                
              </div>
              <hr>
              
              <!-- /.card-header -->
              <div class="card-body one">
                
                <table id="example1" class="table table-bordered table-hover">
                <thead class="table table-secondary">
                  <tr class="text-left">
                      <th>No</th>
                      <th>Finding / Observation / Action Item</th>
                      <th>Category</th>
                      <th>Assignee</th>
                      <th>Target Date</th>
                      <th>Corrective Action</th>
                      <th>Status</th>
                      <th>Action</th>
                  </tr>
                </thead>
                  <tbody>

                  <?php 
                  $sql=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM user WHERE id='".$_SESSION['id']."'"));
                  $dept=$sql['dept_id'];

                  $querys=mysqli_query($con,"SELECT * FROM observe WHERE insp_id='$id' ");
                  $cnt=1;
                  while($rows=mysqli_fetch_array($querys))
                  {


                  ?>		
  
                  <tr class="text-left">

                  

                      <td><?php echo $cnt ?></td>
                      <td><?php echo $rows['observation'] ?></td>
                      <td><?php 
                      $que=mysqli_query($con,"SELECT * FROM category WHERE id='".$rows['cat_id']."'");
                      $rws=mysqli_fetch_array($que); echo $rws['category']
                      ?></td>
                       <td><?php 
                      $que=mysqli_query($con,"SELECT * FROM dept WHERE id='".$rows['dept_id']."'");
                      $rws=mysqli_fetch_array($que); echo $rws['dept']
                      ?></td>
                      <td><?php echo $rows['target_date'] ?></td>
                      <td><?php echo $rows['corrective'] ?> <br> 
                      <?php if($rows['pdf']){
                        echo '<a target="_blank" href="../uploads/'.$rows['pdf'].'"><i  class="fas fa-file-pdf"></i> '.$rows['pdf'].'</a>';
                      }else{} ?>  
                    </td>

                      <td><?php if($rows['status']==0){ echo '<span class="badge badge-danger">Open</span>'; }
                      else{ echo '<span class="badge badge-success">Close</span>'; } ?><br><?php echo $rows['cordate']; ?></td>
                  
                     <td> 
                      <?php 
                       //
                      $qqq=mysqli_query($con,"SELECT * FROM observe WHERE id='".$rows['id']."' AND insp_id='$id' AND dept_id='$dept'");
                      $ww=mysqli_fetch_array($qqq); 
                      if($ww){
                        echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="'.$rows['id'].'">Update</button>';
                      }else{}
                      ?>
                     
                    </td>
                  
                    <?php $cnt=$cnt+1; } ?>

                  </tr>
                  
                  </tbody>
                </table>
                <!-- <div class="row">
                <div class="col-4">
                  

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                  Version: 2017 <br>
                  Revision: 1
                  </p>
                </div>
                <div class="col-4">
                  

                  <p class="" style="margin-top: 10px; color:red; ">
                    <b>Uncontrolled when printed or copied</b>
                  </p>
                </div>
                <div class="col-4">
                  

                  <p class="text-right" style="margin-top: 10px;">
                  Prepared by: DPA<br>
                  Approved by: Chief Operating Officer
                  </p>
                </div>
              </div> -->
              <!-- /.row -->
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
    </section>

    

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Finding / Observation / Action Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal row-fluid" name="editjob" method="post" enctype="multipart/form-data">

        <input type="hidden" id="someid" name="idd">
          <!-- <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            
          </div> -->
          <label for="message-text" class="col-form-label">Corrective File :</label>
          <div class="drop-zone" style="text-align: center; justify-content: center;">
                        <span class="drop-zone__prompt">Drop .jpg .png file here or click to upload .PDF</span>
                        <input type="file" name="uploadfiles" class="drop-zone__input">
                      </div>
          
          

          <div class="form-group">
            <label for="message-text" class="col-form-label">Corrective Action :</label>
            <textarea class="form-control" rows="4" cols="50" name="corr"  id="message-text"></textarea>
          </div>
          
          
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
        <button  name="submit" class="btn btn-info" >Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>

  </div>
 
  <!-- /.content-wrapper -->
<?php include 'includes/footer.php'; ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

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

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
     "responsive": true, "lengthChange": true, "autoWidth": false,
      

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

  $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  // modal.find('.modal-title').text(recipient)
  // modal.find('.modal-body input').val(recipient)
  modal.find('#someid').val(recipient)
})
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