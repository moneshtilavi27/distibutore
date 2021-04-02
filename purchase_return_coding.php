<?php
include("connect.php");
$action=$_POST['action'];
if($action=="print")
{
	$gross_total=$_POST['gross_total'];
	if($gross_total<=0)
	{
		echo $gross_total;
		exit; 
	}

	$q1="SELECT `return_num` FROM `purchase_return_number` ORDER BY `return_num` DESC LIMIT 1;";
	$confirm1=mysqli_query($conn,$q1);
	$return_id=mysqli_fetch_array($confirm1);
	$return_id=$return_id['0']+1;
	$q1="INSERT INTO `purchase_return_number`(`return_num`, `number`) VALUES (' ','$return_id')";
	$confirm1=mysqli_query($conn,$q1);

	$q="SELECT * FROM `purc_temp_item`;";
	$confirm=mysqli_query($conn,$q);
	while ($out=mysqli_fetch_array($confirm)) 
	{
		$vender_id=$out['custid'];
		$item_id=$out['item_id'];
		$item_gst=$out['item_gst'];
		$date=date("Y-m-d");
		$item_quant=$out['item_quant'];
		$rate=$out['item_rate'];
		$value=$out['item_value'];
		$type="cash";
		//echo "<script>alert($vender_id','$item_id','$gst_id);</script>";

		$q2="INSERT INTO `purchase_return`(`return_id`, `return_num`, `vender_id`, `item_id`, `gst_per`, `purchase_qty`, `purchase_mrp`, `Purchase_rate`, `purchase_type`, `purchase_date`) VALUES (' ','$return_id','$vender_id','$item_id','$item_gst','$item_quant','$rate','$value','$type','$date')";
		$confirm2=mysqli_query($conn,$q2); 

		$q3="SELECT * FROM `stock` WHERE `item_id`='$item_id';";
		$confirm3=mysqli_query($conn,$q3);
		$result=mysqli_num_rows($confirm3);
		$stock=mysqli_fetch_array($confirm3);
		$stock_quantity=$stock['stock_quantity']-$item_quant;
		if($result!=0)
		{
			$q4="UPDATE `stock` SET `stock_quantity`='$stock_quantity' WHERE `item_id`='$item_id'";
			$confirm4=mysqli_query($conn,$q4);
		}

		#detele query
		$q5="DELETE FROM `purc_temp_item` WHERE `item_id`='$item_id';";
			$confirm5=mysqli_query($conn,$q5);
			echo "Success";

	}
}



// purchase iten add

if($action=="purchase_return_item")
{
	echo $item_id=$_POST['item_id'];
	$item_name=$_POST['item_name'];
	$custid=$_POST['custid'];
	$item_hsn=$_POST['item_hsn'];
	$item_quant=$_POST['item_quant'];
	$item_mrp=$_POST['item_mrp'];
	$item_pkc = $_POST['item_pkc'];
	$item_gst=$_POST['item_gst'];
	$item_rate=$_POST['item_rate'];
	$item_value=$_POST['item_value'];
	$q="SELECT * FROM `purc_temp_item` WHERE `item_id`='$item_id';";
	$confirm=mysqli_query($conn,$q);
	$result=mysqli_num_rows($confirm);
	if($result>0)
	{
			if($item_name<>" " && $item_hsn<>" " && $item_gst<>" " && $item_unit<>" " && $item_quant<>" " && $item_value<>" " && $item_rate<>" " )
			{
				$qry="UPDATE `purc_temp_item` SET `item_name`='$item_name',`item_hsn`='$item_hsn',`item_gst`='$item_gst',`item_pc`='$item_pkc',`item_quant`='$item_quant',`item_value`='$item_value',`item_rate`='$item_rate' WHERE `item_id`='$item_id'";
				$confirm=mysqli_query($conn, $qry);
				
					}else{echo "All Fieds are nessessary";}
			 }else{
		if($item_name<>" " && $item_hsn<>" " && $item_gst<>" " && $item_unit<>" "&& $item_quant<>""&& $item_value<>" " && $item_rate<>" ")
			{
				$qry="INSERT INTO `purc_temp_item`(`item_id`, `custid`, `item_name`, `item_hsn`, `item_gst`, `item_pc`, `item_quant`, `item_value`, `item_rate`, `item_mrp`) VALUES ('$item_id','$custid','$item_name','$item_hsn','$item_gst','$item_pkc','$item_quant','$item_value','$item_rate','$item_mrp')";
				$confirm=mysqli_query($conn, $qry);
					}else{echo "All Fieds are nessessary";}
			 }
	}
// purchase iten add


// purchase item delete
if($action=="purchase_return_item_delete")
{
	$item_id=$_POST['item_id'];
	$custid=$_POST['custid'];
	$q="DELETE FROM `purc_temp_item` WHERE `item_id`='$item_id' AND `custid`='$custid';";
	$confirm=mysqli_query($conn,$q)or die(mysqli_error());
	echo "success";
	}
// purchase item delete


//purchase return bill  cancel codding
if($action=="cancel")
{
	$q="TRUNCATE TABLE `purc_temp_item`;";
	$confirm=mysqli_query($conn,$q)or die(mysqli_error());
	echo "success";
	}
?>