<?php 
include("connect.php");
$action=$_POST['action'];

// insert items in database

if($action=="add")
{
	$item_cmp=$_POST['item_cmp'];
	$item_name=$_POST['item_name'];
	$item_mrp=$_POST['item_mrp'];
	$basic_value=$_POST['basic_value'];
	$item_hsn=$_POST['item_hsn'];
	$item_gst=$_POST['item_gst'];
	$item_pc=$_POST['item_pc'];
	if($item_name<>" " && $item_hsn<>" " && $basic_value<>" " && $item_gst<>" " && $item_mrp<>"")
	{
		$q="SELECT * FROM `item` WHERE `item_name`='$item_name';";
		$conf=mysqli_query($conn,$q)or die(mysqli_error());
		if(mysqli_num_rows($conf)>0)
		{
				echo "Item Already exist";
		}
		else
		{
				$qry="INSERT INTO `item`(`item_cmp`,`item_name`, `item_hsn`, `item_gst`, `item_pc`, `mrp`, `sale`) VALUES ('$item_cmp','$item_name','$item_hsn','$item_gst','$item_pc','$item_mrp','$basic_value');";
				$confirm=mysqli_query($conn, $qry);
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
	$item_id=$_POST['item_id'];
	$item_cmp=$_POST['item_cmp'];
	$item_name=$_POST['item_name'];
	$item_mrp=$_POST['item_mrp'];
	$basic_value=$_POST['basic_value'];
	$item_hsn=$_POST['item_hsn'];
	$item_gst=$_POST['item_gst'];
	$item_pc=$_POST['item_pc'];
	if($item_name<>" " && $item_hsn<>" " && $basic_value<>" " && $item_gst<>" " && $item_mrp<>"")
	{
		$qry="UPDATE `item` SET `item_name`='$item_name',`item_cmp`='$item_cmp',`item_hsn`='$item_hsn',`item_gst`='$item_gst',`item_pc`='$item_pc',`mrp`='$item_mrp',`sale`='$basic_value' WHERE `item_id`='$item_id';";
		$confirm=mysqli_query($conn, $qry);
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
	$item_id=$_POST['item_id'];
	if($item_id<>" ")
	{
		$qry="DELETE FROM `item` WHERE `item_id`='$item_id';";
		$confirm=mysqli_query($conn, $qry)or die(mysqli_error());
		if($confirm)
		{
				echo "success";
		}
	}
	else{
		echo "please Select Item";
	}
}
?>