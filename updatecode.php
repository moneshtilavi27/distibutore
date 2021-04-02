<?php 
require('connect.php');
$action=$_POST['action'];

if($action=="updateitem")
{ 
	$item_id=$_POST['item_id'];
	$item_name=$_POST['item_name'];
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
	$q="SELECT * FROM `updateitem` WHERE `item_id`='$item_id';";
	$confirm=mysqli_query($conn,$q)or die(mysqli_error());
	$result=mysqli_num_rows($confirm);
	if($result>0)
	{
			if($item_name<>" " && $item_hsn<>" " && $item_gst<>" " && $item_unit<>" "&& $item_quant<>""&& $item_value<>" "&& $item_rate<>" " && $item_mrp<>" ")
			{	//$item_value=$item_value-(($item_value*$item_gst)/100);
				$qry="UPDATE `updateitem` SET `item_unit`='$item_unit',`item_quant`='$item_quant',`item_value`='$item_value',`item_rate`='$item_rate' WHERE `item_id`='$item_id'";
				$confirm=mysqli_query($conn, $qry)or die(mysqli_error());
				echo "sucess";
					}else{echo "All Fieds are nessessary";}
			 }else{
			if($item_name<>" " && $item_hsn<>" " && $item_gst<>" " && $item_unit<>" "&& $item_quant<>""&& $item_value<>" "&& $item_rate<>" " && $item_mrp<>" ")
			{
					
				//$item_value=$item_value-(($item_value*$item_gst)/100);	
				$qry="INSERT INTO `updateitem`(`item_id`, `item_name`, `item_hsn`, `item_gst`, `item_unit`, `item_quant`, `free_item`, `mrp`, `item_value`, `item_rate`, `status`) VALUES ('$item_id','$item_name','$item_hsn','$item_gst','$item_unit','$item_quant','$item_free','$item_mrp','$item_value','$item_rate','add')";
				$confirm=mysqli_query($conn,$qry)or die(mysqli_error());
				echo "sucess";
					}else{echo "All Fieds are nessessary";}
			 }
	}

if($action=="cancel")
{
	$q="TRUNCATE TABLE `updateitem`";
	$confirm=mysqli_query($conn,$q)or die(mysqli_error());
	echo "success";
	}


if($action=="item_delete")
{
	$item_id=$_POST['item_id'];
	$q="UPDATE `updateitem` SET `status`='delete' WHERE `item_id`='$item_id';";
	$confirm=mysqli_query($conn,$q)or die(mysqli_error());
	echo $item_id;
	}

    if($action=="save")
    {
        $gross_total=$_POST['gross_total'];
        $discount = $_POST['discount'];
        $gst_5=$_POST['gst_5'];
        $gst_12=$_POST['gst_12'];
        $gst_18=$_POST['gst_18'];
        $gst_total=$_POST['gst_total'];
        $in_id = $_POST['billno'];
        $q1="UPDATE `invoice_no` SET `discount`='$discount',`gross_total`='$gross_total',`5%`='$gst_5',`12%`='$gst_12',`18%`='$gst_18' WHERE `in_id`='$in_id';";
        $confirm1=mysqli_query($conn,$q1)or die(mysqli_error());
    
        $q="SELECT * FROM `updateitem`;";
        $confirm2=mysqli_query($conn,$q)or die(mysqli_error());
        while ($out=mysqli_fetch_array($confirm2))
        {	
            $cust_id=$out['custid'];
            $item_id=$out['item_id'];
            $item_gst=$out['item_gst'];
            $qty = $out['item_quant'];
            $free = $out['free_item'];
            $unit=$out['item_unit'];
            $item_mrp=$out['mrp'];
            $item_rate=$out['item_rate'];
            $value = $out['item_value'];
            $status = $out['status'];
            $type="cash";
            // cheack previouse qty
            $qq="SELECT `qty`,`free`,`invoice_date` FROM `invoice` WHERE `in_id`='$in_id' AND `item_id`='$item_id';";
            $confirm3=mysqli_query($conn,$qq)or die(mysqli_error());
            $row =mysqli_fetch_array($confirm3);
            $q3="SELECT * FROM `stock` WHERE `item_id`='$item_id';";
            $confirm4=mysqli_query($conn,$q3);
            $result=mysqli_num_rows($confirm4);
            $stock=mysqli_fetch_array($confirm4);
            if($status=='delete')
            {
                $stak = $row['qty']+$row['free'];
                $stock_quantity = $stock['stock_quantity'] + $stak;
            }else{
                $stak = ($row['qty']+$row['free'])-($qty + $free);
                $stock_quantity = $stock['stock_quantity'] + $stak; 
            }
            $date = $row['invoice_date'];
            if($result!=0)
            {
                $q4="UPDATE `stock` SET `stock_quantity`='$stock_quantity' WHERE `item_id`='$item_id'";
                $confirm5=mysqli_query($conn,$q4)or die(mysqli_error());
                if($confirm5)
                {
                    $qry1="SELECT * FROM `invoice` WHERE `in_id`='$in_id' AND `item_id`='$item_id';";
                    $cfm=mysqli_query($conn,$qry1);
                    if(mysqli_num_rows($cfm)!=0)
                    {
                        if($status=='delete')
                        {
                            $q5="DELETE FROM `invoice` WHERE `in_id`='$in_id' AND `item_id`='$item_id';";
                        }else
                        {
                        $q5="UPDATE `invoice` SET `customer_id`='$cust_id',`gst`='$item_gst',`item_id`='$item_id',`qty`='$qty',`free`='$free',`rate`='$item_rate',`value`='$value' WHERE `in_id`='$in_id' AND `item_id`='$item_id';";
                        }
                    }else{
                        if($status!='delete')
                        {
                        $q5="INSERT INTO `invoice`(`in_id`, `customer_id`, `gst`, `item_id`, `qty`, `free`, `rate`, `mrp`, `value`, `type`, `invoice_date`) VALUES ('$in_id','$cust_id','$item_gst','$item_id','$qty','$free','$item_rate','$item_mrp','$value','$type','$date')";
                        }else{
                            $q5="SELECT * FROM `updateitem` WHERE `item_id`='0';";
                        }
                    }
                     mysqli_query($conn,$q5)or die(mysqli_error());
                }
            }
            // #detele query
            $q5="DELETE FROM `updateitem` WHERE `item_id`='$item_id'";
            mysqli_query($conn,$q5);
        }
        echo $in_id;
    }
?>