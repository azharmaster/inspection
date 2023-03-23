<?php
include('../config.php');
session_start();


date_default_timezone_set('Asia/Kuala_lumpur');// change according timezone
$currentTime = date( 'Y-m-d H:i:s', time () );

$id=$_SESSION['id'];
// $logout=mysqli_query($con,"SELECT * FROM user WHERE id='$id' ");
// $num = mysqli_fetch_array($logout); 

$log=mysqli_query($con,"UPDATE `userlog` SET `logout`='$currentTime' WHERE `user_id`='$id' ORDER BY `id` DESC limit 1");

$_SESSION['alogin']=="";
session_unset();
//session_destroy();
$_SESSION['errmsg']="You have successfully logout";
?>
<script language="javascript">
document.location="../index.php";
</script>
