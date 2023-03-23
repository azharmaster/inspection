

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


  $insp=$_POST['insp'];
  $desc=$_POST['desc'];

            $sql=mysqli_query($con,"INSERT INTO `inspection`( `insp_name`,`descr`) VALUES ('$insp','$desc')");
            if($sql){	
          echo "<script type='text/javascript'> alert('Successfully Recorded.'); </script>";
          echo "<script type='text/javascript'> document.location = '$namepage'; </script>";
          
          }else{
          echo "<script type='text/javascript'> alert('Sorry!! Unsuccessful.'); </script>";
          }


}
if (isset($_POST['update'])) {

  $id=$_POST['idd'];
  $insp=$_POST['insp'];
  $desc=$_POST['desc'];


            $sql=mysqli_query($con,"UPDATE `inspection` SET `insp_name`='$insp',`descr`='$desc' WHERE id='$id'");
            if($sql){	
          echo "<script type='text/javascript'> alert('Successfully Update.'); </script>";
          echo "<script type='text/javascript'> document.location = '$namepage'; </script>";
          
          }else{
          echo "<script type='text/javascript'> alert('Sorry!! Unsuccessful.'); </script>";
          }


}


if(isset($_GET['del']))
		  {
		         $ssq= mysqli_query($con,"delete from inspection where id = '".$_GET['id']."'");
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
            <h1 class="page-title">Inspection Management </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Inspection Management</li>
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
                <h2 class="table-title">List of Inspection</h2>
                <a data-toggle="modal" data-target="#exampleModal1" data-whatever="@mdo" class="btn btn-primary shadow-sm p-8 mr-4 rounded " ><i class="fas fa-plus"></i>&nbsp; Add</a>
               
              </div>
              <hr>
              
              <!-- /.card-header -->
              <div class="card-body one">
                <table id="example1" class="table table-bordered table-hover">
                <thead class="table table-secondary">
                  <tr class="text-left">
                    <th>#</th>
                    <th>Category</th>
                    <th>Description</th>
											<th>Action</th>
											
                  </tr>
                </thead>
                  <tbody>

                  <?php 

                  $query=mysqli_query($con,"SELECT * FROM inspection ");
                  $cnt=1;
                  while($row=mysqli_fetch_array($query))
                  {

                 
                  ?>		
  
                  <tr class="text-left">
                  <td><?php echo htmlentities($cnt); ?></td>
                  
              
               
                  <td><span id="name<?php echo $row['id']; ?>"><?php echo $row['insp_name']; ?></span></td>
                  <td><span id="desc<?php echo $row['id']; ?>"><?php echo $row['descr']; ?></span></td>
                 
											
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
    <?php  include('popup/modal_inspection.php'); ?>
    


<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Inspection </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal row-fluid" name="asd" method="post" enctype="multipart/form-data">

    
      <div class="form-group">
            <label for="title" class="col-form-label">Inspection  Name:</label>
            <input type="text" class="form-control" id="title" name="insp" placeholder="e.g : P1">
          </div>
          <div class="form-group">
            <label for="description" class="col-form-label">Description :</label>
            <textarea class="form-control" id="description" name="desc" rows="4" cols="50"></textarea>
           
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

    var a1=$('#name'+id).text();
    var a5=$('#desc'+id).text();
	
		$('#edit').modal('show');

    $('#idd').val(id);
    $('#ename').val(a1);
    $('#edesc').val(a5);
	});
});
</script>

</body>
</html>
<?php } ?>