<?php 
include("connect.php");
$action=$_POST['action'];

if($action=="customeradd")
{
	$customer_name=$_POST['customer_name'];
	$customer_address=$_POST['customer_address'];
	$customer_mob=$_POST['customer_mob'];
	$customer_gst=$_POST['customer_gst'];
	$customer_fssid=$_POST['customer_fssid'];
	$customer_category=$_POST['customer_category'];
if($customer_name<>"" && $customer_address<>"" && $customer_mob<>"")
	{
		$q="SELECT * FROM `customer` WHERE `customer_name`='$customer_name' AND `customer_address`='$customer_address';";
		$conf=mysqli_query($conn,$q)or die(mysqli_error());
		if(mysqli_num_rows($conf)>0)
		{
				echo "Client Already exist";
		}
		else
		{
	$qry="INSERT INTO `customer`(`customer_id`, `customer_name`, `customer_mob`, `customer_address`, `customer_gst`, `customer_fssid`, `customer_category`) VALUES ('','$customer_name','$customer_mob','$customer_address','$customer_gst','$customer_fssid','$customer_category')";
		$confirm=mysqli_query($conn, $qry)or die(mysqli_error());
		if($confirm)
		{
				echo "success";
		}
		}
	}
	else{
		echo "please fill all the Fields";
	}
}

if($action=="update")
{
	$customer_id=$_POST['customer_id'];
	$customer_name=$_POST['customer_name'];
	$customer_address=$_POST['customer_address'];
	$customer_mob=$_POST['customer_mob'];
	$customer_gst=$_POST['customer_gst'];
	$customer_fssid=$_POST['customer_fssid'];
	$customer_category=$_POST['customer_category'];
if($customer_name<>"" && $customer_address<>"" && $customer_mob<>"")
	{
		$qry="UPDATE `customer` SET `customer_name`='$customer_name',`customer_address`='$customer_address',`customer_mob`='$customer_mob',`customer_gst`='$customer_gst',`customer_fssid`='$customer_fssid',`customer_category`='$customer_category' WHERE `customer_id`='$customer_id';";
		$confirm=mysqli_query($conn, $qry)or die(mysqli_error());
		if($confirm)
		{
				echo "success";
		}
	}
	else{
		echo "please fill all the Fields";
	}
}

if($action=="delete")
{
	$customer_id=$_POST['customer_id'];
if($customer_id<>" ")
	{
		$qry="DELETE FROM `customer` WHERE `customer_id`='$customer_id';";
		$confirm=mysqli_query($conn, $qry)or die(mysqli_error());
		if($confirm)
		{
				echo "success";
		}
	}
	else{
		echo "please fill all the Fields";
	}
}
?>
