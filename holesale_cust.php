<?php

include('connect.php');
 $cust_name=$_POST['action'];
//$itmsec=$_POST['wingsec'];

 $a = array();

 $sql = "SELECT * FROM `customer` WHERE `customer_name`='$cust_name';";
  $result = mysqli_query($conn, $sql);
 if (mysqli_num_rows($result) > 0) {
     // output data of each row
   while($row = mysqli_fetch_assoc($result)) {
        array_push($a,$row['customer_id'],$row['customer_name'],$row['customer_address'],$row['customer_mob'],$row['customer_gst'],$row['customer_fssid'],$row['customer_fssid']);
     }
 }

 echo json_encode($a);

//echo $vender_name;
?>
