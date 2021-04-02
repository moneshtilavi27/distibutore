<?php
require('connect.php');
if($_GET['bill_no'])
{
	$bill_no = $_GET['bill_no'];
    $next = false;
	$q="SELECT `item`.`item_id`,`item`.`item_name`,`item`.`item_hsn`,`item`.`item_gst`,`invoice`.`customer_id`,`invoice`.`qty`,`invoice`.`free`,`invoice`.`rate`,`invoice`.`mrp`,`invoice`.`value` FROM `item`,`invoice` WHERE `item`.`item_id`=`invoice`.`item_id` AND `invoice`.`in_id`='$bill_no';";
	$confirm=mysqli_query($conn,$q);
    if(mysqli_num_rows($confirm)!=0)
    {
        while($row=mysqli_fetch_array($confirm))
        {
            $item_id = $row['item_id'];
            $cust_id = $row['customer_id'];
            $item_name = $row['item_name'];
            $item_hsn = $row['item_hsn'];
            $item_gst = $row['item_gst'];
            $item_quant = $row['qty'];
            $item_free = $row['free'];
            $item_rate = $row['rate'];
            $mrp = $row['mrp'];
            $item_value = $row['value'];
            $qry = "INSERT INTO `updateitem`(`item_id`, `custid`, `item_name`, `item_hsn`, `item_gst`, `item_unit`, `item_quant`, `free_item`, `mrp`, `item_value`, `item_rate`, `status`) VALUES ('$item_id','$cust_id','$item_name','$item_hsn','$item_gst','0','$item_quant','$item_free','$mrp','$item_value','$item_rate','add');";
            mysqli_query($conn,$qry);
        }
        $next = true;
    }
	if($next)
    {
        header('Location:update_bill.php?edit='.$bill_no);
    }
}
?>