<?php
include("connect.php");
$action=$_POST['action'];
if($action=="print")
{
	$gross_total=$_POST['gross_total'];
	if($gross_total==0)
	{
		echo $gross_total;
		exit;
	}
	$gst_5=$_POST['gst_5'];
	$gst_12=$_POST['gst_12'];
	$gst_18=$_POST['gst_18'];
	$gst_total=$_POST['gst_total'];
	$date=date("d-m-Y");
	$pn1="INSERT INTO `purchase_num`(`purchase_no_id`, `number`, `date`, `gross_total`, `5%`, `12%`, `18%`) VALUES ('','0','$date','$gross_total','$gst_5','$gst_12','$gst_18')";
	$pn_confirm=mysqli_query($conn,$pn1);	
	$pn2="SELECT `purchase_no_id` FROM `purchase_num` ORDER BY `purchase_no_id` DESC LIMIT 1;";
	$pn_confirm2=mysqli_query($conn,$pn2);
	$purchase=mysqli_fetch_array($pn_confirm2);
	$purchase_number=$purchase['purchase_no_id'];
	$q="SELECT * FROM `purc_temp_item`;";
	$confirm=mysqli_query($conn,$q);
	while ($out=mysqli_fetch_array($confirm)) 
	{
		$vender_id=$out['custid'];
		$item_id=$out['item_id'];
		$item_gst=$out['item_gst'];
		$date=date("d-m-Y");
		$pc=$out['item_pc'];
		$qty=$out['item_quant'];
		$value=$out['item_value'];
		$rate=$out['item_rate'];
		$type="cash";

		$q2="INSERT INTO `purchase`(`purchase_no_id`, `vender_id`, `item_id`, `item_pc`, `gst_per`, `purchase_qty`, `purchase_mrp`, `Purchase_rate`, `purchase_type`, `purchase_date`) VALUES ('$purchase_number','$vender_id','$item_id','$pc','$item_gst','$qty','$rate','$value','$type','$date')";
		$confirm2=mysqli_query($conn,$q2); 

		$q3="SELECT * FROM `stock` WHERE `item_id`='$item_id';";
		$confirm3=mysqli_query($conn,$q3);
		$result=mysqli_num_rows($confirm3);
		$stock=mysqli_fetch_array($confirm3);
		$stock_quantity=$stock['stock_quantity']+$qty;
		if($result!=0)
		{
			$q4="UPDATE `stock` SET `stock_quantity`='$stock_quantity' WHERE `item_id`='$item_id'";
			$confirm4=mysqli_query($conn,$q4);
		}else
		{
			$q5="INSERT INTO `stock`(`stock_id`, `gst_id`, `item_id`, `unit`, `stock_quantity`, `mrp`, `value`) VALUES ('','$gst_id','$item_id','','$qty','$item_rate','$value')";
			$confirm5=mysqli_query($conn,$q5);
		}

		#detele query
		$q5="DELETE FROM `purc_temp_item` WHERE `item_id`='$item_id';";
		$confirm5=mysqli_query($conn,$q5);
	}
}

// purchase iten add

if($action=="purchase_item")
{
	echo $item_id=$_POST['item_id'];
	$item_name=$_POST['item_name'];
	$custid=$_POST['custid'];
	$item_hsn=$_POST['item_hsn'];
	$item_gst=$_POST['item_gst'];
	$item_pkc=$_POST['item_pkc'];
	$item_mrp=$_POST['item_mrp'];
	$item_rate=$_POST['item_rate'];
	$sale_rate=$_POST['sale_rate'];
	$item_quant=$_POST['item_quant'];
	$item_value=$_POST['item_value'];
	$q="SELECT * FROM `purc_temp_item` WHERE `item_id`='$item_id';";
	$confirm=mysqli_query($conn,$q);
	$result=mysqli_num_rows($confirm);
	if($result>0)
	{
			if($item_name<>"" && $item_hsn<>"" && $item_gst<>"" && $item_pkc<>"" && $item_quant<>"" && $item_value<>"" && $item_rate<>"" && $sale_rate<>"")
			{
				$qry="UPDATE `purc_temp_item` SET `item_name`='$item_name',`item_quant`='$item_quant',`item_value`='$item_value',`item_rate`='$item_rate' WHERE `item_id`='$item_id'";
				$confirm=mysqli_query($conn, $qry);
				$qry="UPDATE `item` SET `sale`='$sale_rate',`pur`='$item_rate' WHERE `item_id`='$item_id';";
				$confirm=mysqli_query($conn, $qry);
				}else{echo "All Fieds are nessessary";}
			 }else{
		if($item_name<>" " && $item_hsn<>" " && $item_gst<>" " && $item_unit<>" "&& $item_quant<>""&& $item_value<>" " && $item_rate<>" ")
			{
				$qry="INSERT INTO `purc_temp_item`(`item_id`,`custid`, `item_name`, `item_hsn`, `item_gst`, `item_pc`, `item_quant`, `item_value`,`item_rate`,`item_mrp`) VALUES ('$item_id','$custid','$item_name','$item_hsn','$item_gst','$item_pkc','$item_quant','$item_value','$item_rate','$item_mrp')";
				$confirm=mysqli_query($conn, $qry);
				$qry="UPDATE `item` SET `sale`='$sale_rate',`pur`='$item_rate' WHERE `item_id`='$item_id';";
				$confirm=mysqli_query($conn, $qry);
					}else{echo "All Fieds are nessessary";}
			 }
	}
// purchase iten add

// purchase item delete
if($action=="purchase_item_delete")
{
	$item_id=$_POST['item_id'];
	$custid=$_POST['custid'];
	$q="DELETE FROM `purc_temp_item` WHERE `item_id`='$item_id' AND `custid`='$custid';";
	$confirm=mysqli_query($conn,$q)or die(mysqli_error());
	echo "success";
	}
// purchase item delete

//purchase bill  cancel codding
if($action=="cancel")
{
	$q="TRUNCATE TABLE `purc_temp_item`;";
	$confirm=mysqli_query($conn,$q);
	echo "success";
}

//purchase rate fetch
if($action=="purchase_rate")
{
	$item_id = $_POST['item_id'];
	$q="SELECT `Purchase_rate` FROM `purchase_mrp` WHERE `item_id`='$item_id';";
	$confirm=mysqli_query($conn,$q);
	$out = mysqli_fetch_array($confirm);
	echo $out[0];
	}
?>
