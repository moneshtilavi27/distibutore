<?php 
include("connect.php");
$action=$_POST['action'];

if($action=="holesale_item")
{ 
	$item_id=$_POST['item_id'];
	$item_name=$_POST['item_name'];
	$custid=$_POST['custid'];
	$item_hsn=$_POST['item_hsn'];
	$item_gst=$_POST['item_gst'];
	$item_unit=$_POST['item_unit'];
	$item_quant=$_POST['item_quant'];
	$item_free=$_POST['item_free'];
	$item_mrp=$_POST['item_mrp'];
	$item_rate=$_POST['item_rate'];
	$item_value=$_POST['item_value'];
	$i=(($item_value/(100+$item_gst))*100);
	$rate=(($item_rate/(100+$item_gst))*100);
	$q="SELECT * FROM `hole_temp_item` WHERE `item_id`='$item_id';";
	$confirm=mysqli_query($conn,$q)or die(mysqli_error());
	$result=mysqli_num_rows($confirm);
	if($result>0)
	{
			if($item_name<>" " && $item_hsn<>" " && $item_gst<>" " && $item_unit<>" "&& $item_quant<>""&& $item_value<>" "&& $item_rate<>" " && $item_mrp<>" ")
			{	//$item_value=$item_value-(($item_value*$item_gst)/100);
				$qry="UPDATE `hole_temp_item` SET `item_unit`='$item_unit',`item_quant`='$item_quant',`item_value`='$item_value',`item_rate`='$item_rate' WHERE `item_id`='$item_id'";
				$confirm=mysqli_query($conn, $qry)or die(mysqli_error());
				echo "sucess";
					}else{echo "All Fieds are nessessary";}
			 }else{
			if($item_name<>" " && $item_hsn<>" " && $item_gst<>" " && $item_unit<>" "&& $item_quant<>""&& $item_value<>" "&& $item_rate<>" " && $item_mrp<>" ")
			{
					
				//$item_value=$item_value-(($item_value*$item_gst)/100);	
				$qry="INSERT INTO `hole_temp_item`(`item_id`, `custid`, `item_name`, `item_hsn`, `item_gst`, `item_unit`, `item_quant`, `free_item`, `mrp`, `item_value`, `item_rate`) VALUES ('$item_id','$custid','$item_name','$item_hsn','$item_gst','$item_unit','$item_quant','$item_free','$item_mrp','$item_value','$item_rate')";
				$confirm=mysqli_query($conn,$qry)or die(mysqli_error());
				echo "sucess";
					}else{echo "All Fieds are nessessary";}
			 }
	}
?>

<?php
$action=$_POST['action'];
if($action=="print")
{
	$gross_total=$_POST['gross_total'];
	$discount = $_POST['discount'];
	$gst_5=$_POST['gst_5'];
	$gst_12=$_POST['gst_12'];
	$gst_18=$_POST['gst_18'];
	$gst_total=$_POST['gst_total'];
	$q1="SELECT `in_id` FROM `invoice_no` ORDER BY `in_id` DESC LIMIT 1;";
	$confirm1=mysqli_query($conn,$q1)or die(mysqli_error());
	$in_id=mysqli_fetch_array($confirm1);
	$in_id=$in_id['0']+1;
	$q1="INSERT INTO `invoice_no`(`number`, `discount`, `gross_total`, `5%`, `12%`, `18%`) VALUES ('$in_id','$discount','$gross_total','$gst_5','$gst_12','$gst_18')";
	$confirm1=mysqli_query($conn,$q1)or die(mysqli_error());

	$q="SELECT * FROM `hole_temp_item`;";
	$confirm=mysqli_query($conn,$q)or die(mysqli_error());
	while ($out=mysqli_fetch_array($confirm))
	{	
		$cust_id=$out['custid'];
		$item_id=$out['item_id'];
		$item_gst=$out['item_gst'];
		$date = date("Y-m-d");
		$qty = $out['item_quant'];
		$free = $out['free_item'];
		$unit=$out['item_unit'];
		$item_mrp=$out['mrp'];
		$item_rate=$out['item_rate'];
		$value = $out['item_value'];
		$type="cash";
	
		$stak = $qty + $free;
		$q3="SELECT * FROM `stock` WHERE `item_id`='$item_id';";
		$confirm3=mysqli_query($conn,$q3)or die(mysqli_error());
		$result=mysqli_num_rows($confirm3);
		$stock=mysqli_fetch_array($confirm3);
		$stock_quantity = $stock['stock_quantity'] - $stak;
		if($result!=0)
		{
			$q4="UPDATE `stock` SET `stock_quantity`='$stock_quantity' WHERE `item_id`='$item_id'";
			$confirm4=mysqli_query($conn,$q4)or die(mysqli_error());
			if($confirm4)
			{
				$q5="INSERT INTO `invoice`(`in_id`, `customer_id`, `gst`, `item_id`, `qty`, `free`, `rate`, `mrp`, `value`, `type`, `invoice_date`) VALUES ('$in_id','$cust_id','$item_gst','$item_id','$qty','$free','$item_rate','$item_mrp','$value','$type','$date')";
	 			$confirm5=mysqli_query($conn,$q5)or die(mysqli_error());
			}
		}
		// #detele query
		$q5="DELETE FROM `hole_temp_item` WHERE `item_id`='$item_id'";
		$confirm5=mysqli_query($conn,$q5)or die(mysqli_error());
		echo $in_id;
	}
}
?>



<?php 
$action=$_POST['action'];

if($action=="cancel")
{
	$q="TRUNCATE TABLE `hole_temp_item`";
	$confirm=mysqli_query($conn,$q)or die(mysqli_error());
	echo "success";
	}
?>

<?php 
$action=$_POST['action'];

if($action=="item_delete")
{
	$cust_id=$_POST['custid'];
	$item_id=$_POST['item_id'];
	$q="DELETE FROM `hole_temp_item` WHERE `item_id`='$item_id' AND `custid`='$cust_id';";
	$confirm=mysqli_query($conn,$q)or die(mysqli_error());
	echo $cust_id;
	}
?>