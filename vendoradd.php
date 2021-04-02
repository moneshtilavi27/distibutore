<?php 
include("connect.php");
$action=$_POST['action'];

if($action=="vendoradd")
{
	$vender_name=$_POST['vender_name'];
	$vender_address=$_POST['vender_address'];
	$vender_mob=$_POST['vender_mob'];
	$vender_gst=$_POST['vender_gst'];
	$vender_fssid=$_POST['vender_fssid'];
	$mail_id=$_POST['mail_id'];
if($vender_name<>"" && $vender_address<>"" && $vender_mob<>"" && $vender_gst<>"")
	{
		$q="SELECT * FROM `vendor` WHERE `vender_name`='$vender_name' AND `vender_address`='$vender_address';";
		$conf=mysqli_query($conn,$q)or die(mysqli_error());
		if(mysqli_num_rows($conf)>0)
		{
				echo "Supplier Already exist";
		}
		else
		{
		$qry="INSERT INTO `vendor`(`vender_id`, `vender_name`, `vender_address`, `vender_mob`, `vender_gst`, `vender_fssid`, `mail_id`) VALUES ('','$vender_name','$vender_address','$vender_mob','$vender_gst','$vender_fssid','$mail_id')";
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
	$vender_id=$_POST['vender_id'];
	$vender_name=$_POST['vender_name'];
	$vender_address=$_POST['vender_address'];
	$vender_mob=$_POST['vender_mob'];
	$vender_gst=$_POST['vender_gst'];
	$vender_fssid=$_POST['vender_fssid'];
	$mail_id=$_POST['mail_id'];
if($vender_name<>"" && $vender_address<>"" && $vender_mob<>"" && $vender_gst<>"" && $vender_fssid<>"")
	{
		$qry="UPDATE `vendor` SET `vender_id`='',`vender_name`='$vender_name',`vender_address`='$vender_address',`vender_mob`='$vender_mob',`vender_gst`='$vender_gst',`vender_fssid`='$vender_fssid',`mail_id`='$mail_id' WHERE `vender_id`='$vender_id';";
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
	$vender_id=$_POST['vender_id'];
	if($vender_id!=" ")
	{
		$qry="DELETE FROM `vendor` WHERE `vender_id`='$vender_id';";
		$confirm=mysqli_query($conn, $qry)or die(mysqli_error());
		if($confirm)
		{
				echo "success";
		}
	}
	else{
		echo "please select Vendor";
	}
}
?>