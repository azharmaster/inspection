

<?php
session_start();
include('../config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:../index.php');
}
else{
date_default_timezone_set('Asia/Kuala_lumpur');// change according timezone
$currentTime = date( 'Y-m-d H:i:s', time () );
// $pid = strval($_GET['id']);
$namepage=basename($_SERVER['PHP_SELF']);

if (isset($_POST['submit'])) {

  $vessel=$_POST['vessel'];
  $master=$_POST['master'];
  $inspby=$_POST['inspby'];
  $vsuper=$_POST['vsuper'];
  $inspdate=$_POST['inspdate'];
  $inspname=$_POST['inspname'];

            $sql=mysqli_query($con,"INSERT INTO `insp`( `vessel_id`, `insp_id`, `insp_by`, `name_master`, `insp_date`, `name_supertendent`, `cdate`) 
            VALUES ('$vessel','$inspname','$inspby','$master','$inspdate','$vsuper','$currentTime')");
            if($sql){	
          echo "<script type='text/javascript'> alert('Successfully Recorded.'); </script>";
          echo "<script type='text/javascript'> document.location = '$namepage'; </script>";
          
          }else{
          echo "<script type='text/javascript'> alert('Sorry!! Unsuccessful.'); </script>";
          }


}



if(isset($_GET['del']))
		  {
		         $ssq= mysqli_query($con,"delete from insp where id = '".$_GET['id']."'");
             if($ssq){	
              echo "<script type='text/javascript'> alert('Successfully Delete.'); </script>";
              echo "<script type='text/javascript'> document.location = '$namepage'; </script>";
              
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
            <h1 class="page-title">Report Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Report Management</li>
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
                <h2 class="table-title">List of Report</h2>
                <a data-toggle="modal" data-target="#exampleModal1" data-whatever="@mdo" class="btn btn-primary shadow-sm p-8 mr-4 rounded " ><i class="fas fa-plus"></i>&nbsp; Add</a>
               
              </div>
              <hr>
              
              <!-- /.card-header -->
              <div class="card-body one">
                
                <table id="example1" class="table table-bordered table-hover">
                <thead class="table table-secondary">
                  <tr class="text-left">
                      <th>#</th>
                      <th>Vessel Name</th>
                      <th>Inspection Name </th>
                      <th>Name of Master </th>
                      <th>Name of Superitendent </th>
                      <th>Inspection By </th>
                      <th>Inspection Date </th>
                      <th>Status</th>
											<th>Action</th>
                  </tr>
                </thead>
                  <tbody>

                  <?php 

                  $query=mysqli_query($con,"SELECT * FROM insp");
                  $cnt=1;
                  while($row=mysqli_fetch_array($query))
                  {

                    $quy1=mysqli_query($con,"SELECT COUNT(id) total FROM observe WHERE status=0 AND insp_id='".$row['id']."'  ");
                    $rw1=mysqli_fetch_array($quy1);

                    $quy2=mysqli_query($con,"SELECT COUNT(id) total FROM observe WHERE status=1 AND insp_id='".$row['id']."'  ");
                    $rw2=mysqli_fetch_array($quy2);


                  ?>		
  
                  <tr class="text-left">
                  <td><?php echo htmlentities($cnt); ?></td>
                  <td>
                  <?php 
                  $quy=mysqli_query($con,"SELECT * FROM vessel WHERE id='".$row['vessel_id']."'");
                  $rw=mysqli_fetch_array($quy); if($rw){echo $rw['name'];}else{}  ?>		
                   
                  </td>
                  <td>
                  <?php 
                  $quy=mysqli_query($con,"SELECT * FROM inspection WHERE id='".$row['insp_id']."'");
                  $rw=mysqli_fetch_array($quy); if($rw){echo $rw['insp_name'];}else{}  ?>		    
                  </td>
                  <td><?php echo $row['name_master']; ?></td>
                  <td><?php echo $row['name_supertendent']; ?></td>
                  <td><?php echo $row['insp_by']; ?></td>
                  <td><?php echo $row['insp_date']; ?></td>
                  <td><span class="badge badge-danger"><?php echo $rw1['total'] ?> Open</span> <br><span class="badge badge-success"><?php echo $rw2['total'] ?> Close</span></td>
                  <td> <a href="rp-details.php?id=<?php echo $row['id'] ?>" class="btn btn-success ">
                          <i class="fa fa-eye "></i></a></td>
                  
                    <?php $cnt=$cnt+1; } ?>

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
    </section>
    <?php // include('popup/modal_task.php'); ?>
    


<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Inspection</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal row-fluid" name="asd" method="post" >
        

      
          <div class="form-group">
            <label  class="col-form-label">Vessel:</label>
            <select class="form-control"  name="vessel" >
                  <option value="">Choose Vessel</option>
                  <?php 
                  $query=mysqli_query($con,"SELECT * FROM vessel");
                  while($row=mysqli_fetch_array($query))
                  { ?>		
                  <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                  <?php } ?>
            </select>
          </div>
      
          <div class="form-group">
            <label for="task" class="col-form-label">Name of Master :</label>
            <input type="text" class="form-control" id="task" name="master" >
          </div>

          <div class="form-group">
            <label for="task" class="col-form-label">Inspection By :</label>
            <input type="text" class="form-control" id="task" name="inspby" >
          </div>

          <div class="form-group">
            <label for="task" class="col-form-label">Name of Vessel Superintendent :</label>
            <input type="text" class="form-control" id="task" name="vsuper" >
          </div>

          <div class="form-group">
            <label for="task" class="col-form-label">Inspection Date  :</label>
            <input type="date" class="form-control" id="task" name="inspdate" >
          </div>

          <div class="form-group">
            <label  class="col-form-label">Inspection Name / Type  :</label>
            <select class="form-control"  name="inspname" >
                  <option value="">Choose Inspection Name</option>
                  <?php 
                  $query=mysqli_query($con,"SELECT * FROM inspection");
                  while($row=mysqli_fetch_array($query))
                  { ?>		
                  <option value="<?php echo $row['id'] ?>"><?php echo $row['insp_name'] ?></option>
                  <?php } ?>
            </select>
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

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
     "responsive": true, "lengthChange": false, "autoWidth": false,
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

    var a1=$('#project'+id).text();
		var a2=$('#task'+id).text();
    var a3=$('#user'+id).text();
    var a4=$('#status'+id).text();
    var a5=$('#descb'+id).text();
	
		$('#edit').modal('show');

    $('#idd').val(id);
    $('#eproject').val(a1);
		$('#etask').val(a2);
    $('#euser').val(a3);
    $('#estatus').val(a4);
    $('#edescb').val(a5);
	});
});
</script>
</body>
</html>
<?php } ?>