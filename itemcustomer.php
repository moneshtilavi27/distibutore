<?php 
include("connect.php");
$action=$_POST['action'];

if($action=="itemcustomer")
{
	$item_id=$_POST['item_id'];
	$item_name=$_POST['item_name'];
	$custid=$_POST['custid'];
	$item_hsn=$_POST['item_hsn'];
	$item_gst=$_POST['item_gst'];
	$item_unit=$_POST['item_unit'];
	$item_quant=$_POST['item_quant'];
	$item_rate=$_POST['item_rate'];
	$item_value=$_POST['item_value'];
	echo $custid;

	// //$i=(($item_value/(100+$item_gst))*100);
	// $i=$item_value*$item_quant;
	// // $rate=(($item_rate/(100+$item_gst))*100);
	$q="SELECT * FROM `tmpitem` WHERE `item_id`='$item_id';";
	$confirm=mysqli_query($conn,$q)or die(mysqli_error());
	$result=mysqli_num_rows($confirm);
	if($result>0)
	{
			if($item_name<>" " && $item_hsn<>" " && $item_gst<>" " && $item_unit<>" "&& $item_quant<>""&&  $item_value<>" "&& $item_rate<>" ")
			{
				$qry="UPDATE `tmpitem` SET `item_name`='$item_name',`item_hsn`='$item_hsn',`item_gst`='$item_gst',`item_unit`='$item_unit',`item_quant`='$item_quant',`item_value`='$item_value',`item_rate`='$item_rate' WHERE `item_id`='$item_id'";
				$confirm=mysqli_query($conn, $qry)or die(mysqli_error());
				
					}else{echo "All Fieds are nessessary";}
			 }else{
		if($item_name<>" " && $item_hsn<>" " && $item_gst<>" " && $item_unit<>" "&& $item_quant<>""&& $item_value<>" "&& $item_rate<>" ")
			{
				$zero=0;
				$qry="INSERT INTO `tmpitem`(`item_id`, `customer_id`, `Local_cust_id`, `item_name`, `item_hsn`, `item_gst`, `item_unit`, `item_quant`,`item_value`, `item_rate`) VALUES ('$item_id',' ','$custid','$item_name','$item_hsn','$item_gst','$item_unit','$item_quant','$item_value','$item_rate')";
				$confirm=mysqli_query($conn, $qry)or die(mysqli_error());
				
					}else{echo "All Fieds are nessessary";}
			 }
	}
?>

<?php

$customer_add1=$_POST['action'];	  

if($customer_add1=="customer_add1")
{
	$custid=$_POST['custid'];
	$customer_name=$_POST['customer_name'];
	$customer_address=$_POST['customer_address'];
	$customer_mob=$_POST['customer_mob'];
	$customer_email=$_POST['customer_email'];
if($customer_name!=" " && $customer_address!=" " && $customer_mob!=" "&& $customer_email!=" ")
	{

		$qry="SELECT * FROM `tmpcustomer`;";
		$confirm=mysqli_query($conn, $qry)or die(mysqli_error());
		$result=mysqli_num_rows($confirm);
		if($result!=0)
		{
			$qry="UPDATE `tmpcustomer` SET `customer_name`='$customer_name',`customer_address`='$customer_address',`customer_mob`='$customer_mob',`customer_email`='$customer_email' WHERE `customer_id`='$custid'";
			$confirm=mysqli_query($conn, $qry)or die(mysqli_error());
			echo "success";
		}
		else
		{
			$qry="INSERT INTO `tmpcustomer`(`customer_id`, `customer_name`, `customer_address`,`customer_mob`, `customer_email` ) VALUES ('','$customer_name','$customer_address','$customer_mob','$customer_email')";
			$confirm=mysqli_query($conn, $qry)or die(mysqli_error());
			echo "success";
		}
	}
}
?>

<?php
include("connect.php");
	$print=$_POST['action'];	  
	if($print=="print")
	{
		$gross_total=$_POST['gross_total'];
		$gst_5=$_POST['gst_5'];
		$gst_12=$_POST['gst_12'];
		$gst_18=$_POST['gst_18'];
		$discount=$_POST['discount'];
		$gst_total=$_POST['gst_total']-$discount;

		$qry="SELECT * FROM `tmpcustomer`";
		$confirm=mysqli_query($conn,$qry)or die(mysqli_error());
		$r=mysqli_num_rows($confirm);
		if($r!=0)
		{
			$out=mysqli_fetch_array($confirm);
			$name=$out['customer_name'];
			$adress=$out['customer_address'];
			$mob=$out['customer_mob'];
			$email=$out['customer_email'];
			$date=date("d-m-Y");

			$qry="INSERT INTO `local_cust`(`Local_cust_id`, `local_cust__name`, `loacal_cust_address`, `loacal_cust_mob`, `loacal_cust_gst`, `loacal_cust_fssid`, `loacal_cust_email`, `loacal_cust_date`) VALUES (' ','$name','$adress','$mob',' ',' ','$email','$date')";
			$confirm=mysqli_query($conn,$qry)or die(mysqli_error());
			if($confirm)
			{
				$qry="SELECT `Local_cust_id` FROM `local_cust` ORDER BY `Local_cust_id` DESC LIMIT 1;";
				$confirm=mysqli_query($conn,$qry)or die(mysqli_error());
				$cust=mysqli_fetch_array($confirm);
				$custid=$cust['Local_cust_id'];

				$q="INSERT INTO `purchse_gst`(`gst_id`, `gross_total`, `5%`, `12%`, `18%`) VALUES ('','$gross_total','$gst_5','$gst_12','$gst_18');";
				$confirm=mysqli_query($conn,$q)or die(mysqli_error());
				$q1="SELECT `gst_id` FROM `purchse_gst` ORDER BY `gst_id` DESC LIMIT 1;";
					$confirm1=mysqli_query($conn,$q1)or die(mysqli_error());
					$gst=mysqli_fetch_array($confirm1);
					$gst_id=$gst['0'];

					$q1="SELECT `in_id` FROM `invoice_no` ORDER BY `in_id` DESC LIMIT 1;";
					$confirm1=mysqli_query($conn,$q1)or die(mysqli_error());
					$in_id=mysqli_fetch_array($confirm1);
					$in_id=$in_id['0']+1;
					echo $in_id;
					$q1="INSERT INTO `invoice_no`(`number`, `discount`) VALUES ('$in_id','$discount')";
					$confirm1=mysqli_query($conn,$q1)or die(mysqli_error());

					$q="SELECT * FROM `tmpitem`;";
					$confirm=mysqli_query($conn,$q)or die(mysqli_error());
					while ($item=mysqli_fetch_array($confirm)) 
					{	
						$item_id=$item['item_id'];
						$item_quant=$item['item_quant'];
						$item_mrp=$item['item_mrp'];
						$value=$item['item_rate'];
						$item_unit=$item['item_unit'];
						$type="cash";
						$date=date("d-m-Y");
						if(($item_unit=="gm")||($item_unit=="ml"))
						{
							$qty=$item_quant/1000;
						}
						if(($item_unit=="kg")||($item_unit=="ltr"))
						{
							$qty=$item_quant/1;
						}
						if($item_unit=="qtl")
						{
							$qty=$item_quant*100;
						}
						$q5="INSERT INTO `invoice` (`in_id`, `customer_id`, `Local_cust_id`, `gst_id`, `item_id`, `qty`, `value`, `type`, `invoice_date`) VALUES ('$in_id', '0', '$custid', '$gst_id', '$item_id', '$item_quant', '$value', '$item_mrp', 'date')";
								$confirm5=mysqli_query($conn,$q5)or die(mysqli_error());
					
						//deduct from stock 
						// $q3="SELECT * FROM `stock` WHERE `item_id`='$item_id';";
						// $confirm3=mysqli_query($conn,$q3)or die(mysqli_error());
						// $result=mysqli_num_rows($confirm3);
						// $stock=mysqli_fetch_array($confirm3);
						// $stock_quantity=$stock['stock_quantity']-$qty;
						// if($result!=0)
						// {
						// 	$q4="UPDATE `stock` SET `stock_quantity`='$stock_quantity' WHERE `item_id`='$item_id'";
						// 	$confirm4=mysqli_query($conn,$q4)or die(mysqli_error());
						// 	if($confirm4)
						// 	{
						// 		$q5="INSERT INTO `invoice` (`in_id`, `customer_id`, `Local_cust_id`, `gst_id`, `item_id`, `qty`, `value`, `type`, `invoice_date`) VALUES ('$in_id', '0', '$custid', '$gst_id', '$item_id', '$qty', '$value', 'cash', 'date')";
						// 		$confirm5=mysqli_query($conn,$q5)or die(mysqli_error());
						// 	}
						// }

						#detele query
						$q5="DELETE FROM `tmpitem` WHERE `item_id`='$item_id'";
						$confirm5=mysqli_query($conn,$q5)or die(mysqli_error());
					}
			}
				$q5="TRUNCATE TABLE `tmpcustomer`;";
				$confirm5=mysqli_query($conn,$q5)or die(mysqli_error());
		}
}	
?>

<?php 
include("connect.php");
$action=$_POST['action'];

if($action=="purchase_item")
{
	$item_id=$_POST['item_id'];
	$item_name=$_POST['item_name'];
	$custid=$_POST['custid'];
	$item_hsn=$_POST['item_hsn'];
	$item_gst=$_POST['item_gst'];
	$item_unit=$_POST['item_unit'];
	$item_rate=$_POST['item_rate'];
	$item_quant=$_POST['item_quant'];
	$item_value=$_POST['item_value'];
	$q="SELECT * FROM `purc_temp_item` WHERE `item_id`='$item_id';";
	$confirm=mysqli_query($conn,$q)or die(mysqli_error());
	$result=mysqli_num_rows($confirm);
	if($result>0)
	{
			if($item_name<>" " && $item_name<>" " && $item_hsn<>" " && $item_gst<>" " && $item_unit<>" "&& $item_quant<>""&& $item_value<>" " && $item_rate<>" ")
			{
				$qry="UPDATE `purc_temp_item` SET `item_name`='$item_name',`item_hsn`='$item_hsn',`item_gst`='$item_gst',`item_unit`='$item_unit',`item_quant`='$item_quant',`item_rate`='$item_rate',`item_value`='$item_value' WHERE `item_id`='$item_id'";
				$confirm=mysqli_query($conn, $qry)or die(mysqli_error());
				
					}else{echo "All Fieds are nessessary";}
			 }else{
		if($item_id<>"" && $item_hsn<>"" && $item_gst<>"" && $item_unit<>"" && $item_quant<>"" && $item_value<>"" && $item_rate<>"")
			{
				$qry="INSERT INTO `purc_temp_item`(`item_id`, `custid`, `item_name`, `item_hsn`, `item_gst`, `item_unit`, `item_quant`, `item_value`,`item_rate`) VALUES ('$item_id','$custid','$item_name','$item_hsn','$item_gst','$item_unit','$item_quant','$item_value','$item_rate');";
				$confirm=mysqli_query($conn,$qry)or die(mysqli_error());
					}else{echo "All Fieds are nessessary";}
			 }
	}
?>

<?php 
include("connect.php");
$action=$_POST['action'];

if($action=="purchase_item_delete")
{
	$item_id=$_POST['item_id'];
	$custid=$_POST['custid'];
	$q="DELETE FROM `purc_temp_item` WHERE `item_id`='$item_id' AND `custid`='$custid';";
	$confirm=mysqli_query($conn,$q)or die(mysqli_error());
	echo "success";
	}
?>

<?php 
include("connect.php");
$action=$_POST['action'];

if($action=="sale_item_delete")
{
	$item_id=$_POST['item_id'];
	$custid=$_POST['custid'];
	$q="DELETE FROM `tmpitem` WHERE `item_id`='$item_id' AND `Local_cust_id`='$custid';";
	$confirm=mysqli_query($conn,$q)or die(mysqli_error());
	echo "success";
	}
?>


<?php 
include("connect.php");
$action=$_POST['action'];

if($action=="cancel")
{
		$q="TRUNCATE TABLE `tmpcustomer`;";
	$confirm=mysqli_query($conn,$q)or die(mysqli_error());

	$q="TRUNCATE TABLE `tmpitem`";
	$confirm=mysqli_query($conn,$q)or die(mysqli_error());
	echo "success";
	}
?>

<?php 
include("connect.php");
$action=$_POST['action'];

if($action=="purchase_cancel")
{
		$q="TRUNCATE TABLE `purc_temp_item`;";
	$confirm=mysqli_query($conn,$q)or die(mysqli_error());
	echo "success";
	}
?>