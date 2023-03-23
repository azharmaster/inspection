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
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <a onclick="window.print()"  class="text-right btn btn-success" >
                    <i class="fas fa-print"></i> Print</a>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  
    <?php 

$query=mysqli_query($con,"SELECT * FROM insp WHERE id='$id' ");
$cnt=1;
while($row=mysqli_fetch_array($query))
{ ?>
    <!-- /.content -->

    <section class="content">
      <div class="container-fluid">
      
      <div class="row">
          <div class="col-12">
            <div class="card card-primary card-outline">
            <div class="table-top" >
               
                
            <table class="table table-bordered">
                  <tr>
                    <td  style="text-align:center"><img src="data/jasa.png"></td>
                    <td style="font-weight: bold;">CHECKLIST & FORM (CF)<br>CF NUMBER : Q15<br>
                    CF TITLE : INSPECTION / INVESTIGATION FINDINGS CLOSURE PLAN (IFCP)
</td>
                  </tr>
                </table>
              
              </div>
              <div class="table-top">
                &nbsp;&nbsp;Instruction : This record shall be updated until all findings are closed. All closures shall be updated monthly to the vessel superintendent.
              </div>
              <br>
              <div class="card-body one">
            <div class="row invoice-info">
                
                <div class="col-sm-12 invoice-col table-responsive">


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
                  $rw=mysqli_fetch_array($quy); if($rw){echo $rw['insp_name']; echo '- '.date('M Y',strtotime($row['insp_date'])).'';  }else{}  ?>	 </td>
                    
                  </tr>
                </table>
                </div>
                <?php } ?>
                
                <!-- /.col -->
              </div>
              </div>
              <!-- /.card-body -->
           
             
             
              
              <!-- /.card-header -->
              <div class="card-body one table-responsive">
                
                <table  class="table table-bordered table-hover">
                <thead class="table table-secondary">
                  <tr class="text-left">
                      <th>No</th>
                      <th>Finding / Observation / Action Item</th>
                      <th>Category</th>
                      <th>Assignee</th>
                      <th>Target Date</th>
                      <th>Corrective Action</th>
                      <th>Status</th>
                     
                  </tr>
                </thead>
                  <tbody>

                  <?php 

                  $querys=mysqli_query($con,"SELECT * FROM observe WHERE insp_id='$id'");
                  $cnt=1;
                  while($rows=mysqli_fetch_array($querys))
                  {


                  ?>		
  
                  <tr class="text-left">

                  <span hidden id="obser<?php echo $rows['id']; ?>"><?php echo $rows['observation']; ?></span>
                  <span hidden id="cat<?php echo $rows['id']; ?>"><?php echo $rows['cat_id']; ?></span>
                  <span hidden id="dept<?php echo $rows['id']; ?>"><?php echo $rows['dept_id']; ?></span>
                  <span hidden id="tdate<?php echo $rows['id']; ?>"><?php echo $rows['target_date']; ?></span>

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
                  
                     
                  
                    <?php $cnt=$cnt+1; } ?>

                  </tr>
                  
                  </tbody>
                </table>
                <div class="row">
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
              </div>
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

  $(document).ready(function(){
	$(document).on('click', '.edit2', function(){

		var id=$(this).val();
    var a1=$('#vessel'+id).text();
		var a2=$('#master'+id).text();
    var a3=$('#inspby'+id).text();
    var a4=$('#vsuper'+id).text();
    var a5=$('#inspdate'+id).text();
    var a6=$('#inspname'+id).text();
	
		$('#edit2').modal('show');

    $('#idd').val(id);
    $('#evessel').val(a1);
		$('#emaster').val(a2);
    $('#einspby').val(a3);
    $('#evsuper').val(a4);
    $('#einspdate').val(a5);
    $('#einspname').val(a6);
	});
});

  $(document).ready(function(){
	$(document).on('click', '.edit', function(){
		var id=$(this).val();

    var a1=$('#obser'+id).text();
		var a2=$('#cat'+id).text();
    var a3=$('#dept'+id).text();
    var a4=$('#tdate'+id).text();
	
		$('#edit').modal('show');

    $('#idd').val(id);
    $('#eobser').val(a1);
		$('#ecat').val(a2);
    $('#edept').val(a3);
    $('#etdate').val(a4);
	});
});
</script>
</body>
</html>
<?php } ?>