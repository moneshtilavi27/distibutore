<?php

include('connect.php');
 $item_name=$_POST['action'];
//$itmsec=$_POST['wingsec'];

 $b = array();

 $sql = "SELECT * FROM `item` WHERE `item_name`='$item_name';";
  $result = mysqli_query($conn, $sql);
 if (mysqli_num_rows($result) > 0) {
     // output data of each row
   while($row = mysqli_fetch_assoc($result)) {
        array_push($b,$row['item_id'],$row['item_name'],$row['item_hsn'],$row['item_gst'],$row['item_pc'],$row['mrp'],$row['sale'],$row['pur']);
     }
 }

 echo json_encode($b);

//echo $vender_name;
?>