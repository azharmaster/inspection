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

$sql=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM user WHERE id='".$_SESSION['id']."'"));
$dept=$sql['dept_id'];
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
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../file/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../file/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../file/plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="../file/../file/dist/css/PAKAR.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php
  include 'includes/header.php';
  include 'includes/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
         
          
         

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box " style="background-color: #FFD919" >
              <div class="inner">
              <h3> 
                <?php   
                $ret=mysqli_query($con,"SELECT  COUNT(DISTINCT i.id) AS tot FROM observe o JOIN insp i ON o.insp_id=i.id WHERE o.dept_id='$dept'");
                $num = mysqli_fetch_array($ret); echo $num['tot'];  ?>
                </h3>
                <p>TOTAL INSPECTION TYPE</p>
              </div>
              <div class="icon">
              <i class="far fa-clipboard"></i>
              </div>
              <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger" >
              <div class="inner">
              <h3> 
                <?php   
                $ret=mysqli_query($con," SELECT  COUNT(id) as tot FROM observe WHERE status = 0 AND dept_id='$dept'");
                $num = mysqli_fetch_array($ret); echo $num['tot'];  ?>
                </h3>

                <p>OPEN INSPECTION</p>
              </div>
              <div class="icon">
              <i class="far fa-clipboard"></i>
              </div>
              <a href="manageinsp.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success" >
              <div class="inner">
              <h3> 
                <?php   
                $ret=mysqli_query($con," SELECT  COUNT(id) as tot FROM observe WHERE status = 1 AND dept_id='$dept'");
                $num = mysqli_fetch_array($ret); echo $num['tot'];  ?>
                </h3>

                <p>CLOSE INSPECTION</p>
              </div>
              <div class="icon">
              <i class="far fa-clipboard"></i>
              </div>
              <a href="manageinsp.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box " style="background-color:#FF55F5">
              <div class="inner">
              <h3> 
                <?php   
                $ret=mysqli_query($con," SELECT  COUNT(id) as tot FROM observe WHERE dept_id='$dept'");
                $num = mysqli_fetch_array($ret); echo $num['tot'];  ?>
                </h3>

                <p>TOTAL FINDING</p>
              </div>
              <div class="icon">
              <i class="far fa-clipboard"></i>
              </div>
              <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-6 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
          

           
            <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Latest Inspection</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Vessel</th>
                      <th>Inspection Name</th>
                      <th>Create Date</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                
                $query=mysqli_query($con,"SELECT DISTINCT i.* FROM observe o JOIN insp i ON o.insp_id=i.id WHERE o.dept_id='$dept'  ORDER BY i.id DESC  limit 5");
                $cnt=1;
                while($row=mysqli_fetch_array($query))
                { 
                  
                      $rws=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `vessel` WHERE id='".$row['vessel_id']."'")); 
                      $rws1=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `inspection` WHERE id='".$row['insp_id']."'")); 
                  ?>
                    <tr>
                      <td><?php echo $cnt ?>.</td>
                      <td><?php echo $rws['name'] ?></td>
                      <td><?php echo $rws1['insp_name'] ?></td>
                      <td><?php echo $row['cdate'] ?></td>
                    </tr>
                    <?php  $cnt=$cnt+1; } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

            <!-- BAR CHART -->
            <div class="card ">
              <div class="card-header">
                <h3 class="card-title">Total Inspection and Finding</h3>

              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-6 connectedSortable">


          <!-- /.card -->
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Latest Finding / Observation / Action Item</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
              <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Finding / Observation / Action Item</th>
                      <th>Status</th>
                      <th>Target Date</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                
                $query=mysqli_query($con,"SELECT * FROM observe WHERE dept_id='$dept' ORDER BY id DESC  limit 5");
                $cnt=1;
                while($row=mysqli_fetch_array($query))
                { 
                  
                      // $rws=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `insp` WHERE id='".$row['insp_id']."'")); 
                      // $rws1=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `vessel` WHERE id='".$rws1['vessel_id']."'")); 
                  ?>
                    <tr>
                      <td><?php echo $cnt ?>.</td>
                      <td><?php echo $row['observation'] ?></td>
                      <td><?php if($row['status']==0){ echo '<span class="badge badge-danger">Open</span>'; }else{ echo '<span class="badge badge-success">Close</span>';} ?></td>
                      <td><?php echo $row['target_date'] ?></td>
                    </tr>
                    <?php  $cnt=$cnt+1; } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          
          
           

           
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    
    <!-- /.content -->
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

<!-- jQuery -->
<script src="../file/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../file/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="../file/plugins/chart.js/Chart.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../file/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<!-- <script src="../file/plugins/chart.js/Chart.min.js"></script> -->
<!-- Sparkline -->
<script src="../file/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<!-- <script src="../file/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../file/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
<!-- jQuery Knob Chart -->
<script src="../file/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../file/plugins/moment/moment.min.js"></script>
<script src="../file/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../file/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<!-- <script src="../file/plugins/summernote/summernote-bs4.min.js"></script> -->
<!-- overlayScrollbars -->
<script src="../file/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../file/dist/js/adminlte.js"></script>

<!-- Page specific script -->
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

   
<?php
 $f1="00:00:00";

 $abulan4=date('Y-m-d', strtotime("first day of previous month -3 month"))." ".$f1;
$bbulan4=date('Y-m-d', strtotime("last day of previous month -3 month"))." ".$f1;

$abulan3=date('Y-m-d', strtotime("first day of previous month -2 month"))." ".$f1;
$bbulan3=date('Y-m-d', strtotime("last day of previous month -2 month"))." ".$f1;

$abulan2=date('Y-m-d', strtotime("first day of previous month -1 month"))." ".$f1;
$bbulan2=date('Y-m-d', strtotime("last day of previous month -1 month"))." ".$f1;

$abulan1=date('Y-m-d', strtotime("first day of previous month "))." ".$f1;
$bbulan1=date('Y-m-d', strtotime("last day of previous month "))." ".$f1;

$abulan0=date('Y-m-d', strtotime("first day of previous month +1 month"))." ".$f1;
$bbulan0=date('Y-m-d', strtotime("last day of previous month +1 month"))." ".$f1;
?>

var areaChartData = {

labels  : [
'<?php echo date('F', strtotime("-4 month"));  ?>', 
'<?php echo date('F', strtotime("-3 month")); ?>', 
'<?php echo date('F', strtotime("-2 month")); ?>', 
'<?php echo date('F', strtotime("-1 month")); ?>', 
'<?php echo date('F');?>'],

      datasets: [
        

        <?php  
        
          // $iduser=$row['id'];
          // $nama=$row['name'];
          $color='#FCAD85';
          //SELECT  COUNT(DISTINCT i.id) AS ki FROM observe o JOIN insp i ON o.insp_id=i.id WHERE o.dept_id='$dept' AND
          $que1=mysqli_query($con,"SELECT  COUNT(DISTINCT i.id) AS ki FROM observe o JOIN insp i ON o.insp_id=i.id WHERE o.dept_id='$dept' AND  i.cdate between '$abulan4' AND '$bbulan4'");
          $rw1=mysqli_fetch_array($que1); $bulan4=$rw1['ki'];

          $que2=mysqli_query($con,"SELECT  COUNT(DISTINCT i.id) AS ki FROM observe o JOIN insp i ON o.insp_id=i.id WHERE o.dept_id='$dept' AND  i.cdate between '$abulan3' AND '$bbulan3'");
          $rw1=mysqli_fetch_array($que2); $bulan3=$rw1['ki'];
          
          $que3=mysqli_query($con,"SELECT  COUNT(DISTINCT i.id) AS ki FROM observe o JOIN insp i ON o.insp_id=i.id WHERE o.dept_id='$dept' AND  i.cdate between '$abulan2' AND '$bbulan2'");
          $rw1=mysqli_fetch_array($que3); $bulan2=$rw1['ki'];

          $que4=mysqli_query($con,"SELECT  COUNT(DISTINCT i.id) AS ki FROM observe o JOIN insp i ON o.insp_id=i.id WHERE o.dept_id='$dept' AND  i.cdate between '$abulan1' AND '$bbulan1'");
          $rw1=mysqli_fetch_array($que4); $bulan1=$rw1['ki'];

          $que5=mysqli_query($con,"SELECT  COUNT(DISTINCT i.id) AS ki FROM observe o JOIN insp i ON o.insp_id=i.id WHERE o.dept_id='$dept' AND  i.cdate between '$abulan0' AND '$bbulan0'");
          $rw1=mysqli_fetch_array($que5); $bulan0=$rw1['ki'];

           echo "
           {
            label               : 'Inspection',
            backgroundColor     : '$color',
            borderColor         : '$color',
            pointRadius         : false,
            pointColor          : '$color',
            pointStrokeColor    : '$color',
            pointHighlightFill  : '$color',
            pointHighlightStroke: '$color',
            data                : [$bulan4,$bulan3,$bulan2,$bulan1,$bulan0]
          }, ";
          ?>
         <?php  
          // $iduser=$row['id'];
          // $nama=$row['name'];
          $color='#82FF71';

          $que1=mysqli_query($con,"SELECT COUNT(id) as ki FROM observe WHERE dept_id='$dept' AND cdate between '$abulan4' AND '$bbulan4'");
          $rw1=mysqli_fetch_array($que1); $bulan4=$rw1['ki'];

          $que2=mysqli_query($con,"SELECT COUNT(id) as ki FROM observe WHERE dept_id='$dept' AND cdate between '$abulan3' AND '$bbulan3'");
          $rw1=mysqli_fetch_array($que2); $bulan3=$rw1['ki'];
          
          $que3=mysqli_query($con,"SELECT COUNT(id) as ki FROM observe WHERE dept_id='$dept' AND cdate between '$abulan2' AND '$bbulan2'");
          $rw1=mysqli_fetch_array($que3); $bulan2=$rw1['ki'];

          $que4=mysqli_query($con,"SELECT COUNT(id) as ki FROM observe WHERE dept_id='$dept' AND cdate between '$abulan1' AND '$bbulan1'");
          $rw1=mysqli_fetch_array($que4); $bulan1=$rw1['ki'];

          $que5=mysqli_query($con,"SELECT COUNT(id) as ki FROM observe WHERE dept_id='$dept' AND cdate between '$abulan0' AND '$bbulan0'");
          $rw1=mysqli_fetch_array($que5); $bulan0=$rw1['ki'];

           echo "
           {
            label               : 'Finding',
            backgroundColor     : '$color',
            borderColor         : '$color',
            pointRadius         : false,
            pointColor          : '$color',
            pointStrokeColor    : '$color',
            pointHighlightFill  : '$color',
            pointHighlightStroke: '$color',
            data                : [$bulan4,$bulan3,$bulan2,$bulan1,$bulan0]
          }, ";
          ?>
        
      ]
    }




   
   
    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

   
  })
</script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="../file/dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../file/dist/js/pages/dashboard.js"></script>
</body>
</html>
<?php } ?>