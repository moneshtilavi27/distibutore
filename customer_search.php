<?php

include('connect.php');
 $vender_name=$_POST['action'];
//$itmsec=$_POST['wingsec'];

 $a = array();

 $sql = "SELECT * FROM `vendor` WHERE `vender_name`='$vender_name';";
  $result = mysqli_query($conn, $sql);
 if (mysqli_num_rows($result) > 0) {
     // output data of each row
   while($row = mysqli_fetch_assoc($result)) {
        array_push($a,$row['vender_id'],$row['vender_name'],$row['vender_address'],$row['vender_mob'],$row['vender_gst'],$row['vender_fssid'],$row['mail_id']);
     }
 }

 echo json_encode($a);

//echo $vender_name;
?>


