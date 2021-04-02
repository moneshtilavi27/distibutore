<!DOCTYPE html>
<html>

<head>
    <title><?php echo $_GET['bill_no']; ?></title>
    <link rel="stylesheet" href="plugin/bootstrap.css">
    <!-- jQuery library -->
    <script src="plugin/jquery.js"></script>
    <link href="plugin/fontasome.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="plugin/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <style type="text/css">
    * {
        margin: 0px;
        padding: 0px;
    }

    table,th {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 1px;
        text-align: center
    }
    #value {
        font-weight: 600;
        font-size: 15pt;
    }
    </style>
</head>
<?php
		$bill_no=$_GET['bill_no'];
		include("connect.php");
		?>

<body>

    <div class="container">
        <?php
		$q="SELECT DISTINCT `customer`.`customer_name` AS `customer`,`customer`.`customer_mob` AS `mob`,`customer`.`customer_address` AS `address`,`invoice`.`invoice_date` AS `date` FROM `customer`,`invoice`,`invoice_no` WHERE `customer`.`customer_id`=`invoice`.`customer_id` AND `invoice`.`in_id`=`invoice_no`.`in_id` AND `invoice_no`.`number`='$bill_no' LIMIT 1;";
		$confirm=mysqli_query($conn,$q) or die(mysqli_error());
		$out=mysqli_fetch_array($confirm);
		?>
        <table border="1" cellspacing="0" class="center" width="84%">
            <tr>
                <td colspan="7" style="text-align: left; padding-left: 10px; color:brown;">
                    SHRI SHIVLINSHWAR ENT<br />
                    PLOT NO 470, D A COLONY, BASAVAN KUDACHI, BELGAVI <br />
                    GSTN/UIN: 29BHAPB0918C1Z0 <br />
                    State Name:Karnataka Code:29<br />
                    Contact:,6362825118
                </td>
                <td colspan="3" rowspan="2" style="text-align: left; padding-left: 10px;">
                    Mobile: 6362825118<br/>
                	GSTN/UIN:29BHAPB0918C1Z0<br/>
               		state Name:Karnataka,code:29<br/>
                    <h5>Date:<?php echo date("d-m-Y",strtotime($out['date']));?> </h5>
                    <h4>Invoice No:- <?php echo $bill_no; ?></h4>
                </td>
            </tr>
            <tr>
                <td colspan="7" style="text-align: left; padding-left: 10px;">
                    Retailer: <?php echo $out['customer']; ?><br />
                    Address: <?php echo $out['address']; ?><br />
                    GSTN/UIN: <?php echo $out['mob']; ?><br />
                    Contact:<?php echo $out['mob']; ?>
                </td>
            </tr>

            <!------bill------>
            <tr>
                <th colspan="1" style="width: 5%;">SN</th>
                <th colspan="2" style="width: 20%;">Description</th>
				<th colspan="1" style="width: 5%;">HSN</th>
                <th colspan="1" style="width: 5%;">MRP</th>
                <th colspan="1" style="width: 5%;">Qty</th>
                <th colspan="1" style="width: 5%;">Free</th>
                <th colspan="1" style="width: 5%;">Rate</th>
                <th colspan="1" style="width: 5%;">GST%</th>
                <th colspan="1" style="width: 5%;">Ammount</th>
            </tr>
            <?php
			$q="SELECT `item`.`item_name` AS `item_name`,`item`.`item_hsn` AS `item_hsn`,`item`.`item_gst` AS `item_gst`,`invoice`.`qty` AS `item_quant`,`invoice`.`free` AS `free_item`,`invoice`.`mrp` AS `mrp`,`invoice`.`rate` AS `item_rate`,`invoice`.`value` AS `item_value` FROM `invoice`,`item` WHERE `item`.`item_id`=`invoice`.`item_id` AND `invoice`.`in_id`='$bill_no';";
			$confirm=mysqli_query($conn,$q);
			$i=1;
			while($out=mysqli_fetch_array($confirm))
			{$value=$out['item_value'];
				//$value=$out['value']-(($out['value']*$out['item_gst'])/100);?>
            <tr>
                <td colspan="1"><?php echo $i;?></td>
                <td colspan="2" style="text-align: left;padding-left: 10px;"><?php echo $out['item_name']; ?></td>
				<td colspan="1"><?php echo $out['item_hsn']; ?></td>
				<td colspan="1"><?php echo $out['mrp']; ?></td>
                <td colspan="1"><?php echo $out['item_quant']; ?></td>
                <td colspan="1"><?php echo $out['free_item']; ?></td>
                <td colspan="1"><?php echo $out['item_rate']; ?></td>
                <td colspan="1"><?php if($out['item_gst']==0){echo "-";}else{echo $out['item_gst'];}; ?></td>
                <td colspan="1"><?php echo $out['item_value'];?></td>
            </tr>
            <?php	$i++;}
			while($i<25)
			{?>
            <tr>
                <td colspan="1">.</td>
                <td colspan="2"> </td>
                <td colspan="1"> </td>
				<td colspan="1"> </td>
                <td colspan="1"> </td>
                <td colspan="1"> </td>
                <td colspan="1"> </td>
                <td colspan="1"> </td>
                <td colspan="1"> </td>
            </tr>
            <?php $i++;}
		
			$total=0;
			$gstfive=$gsttwelve=$gsteghteen=$gsttwelve1=0;
			$sn=0;
			// FIND DISCOUNT
			$ind="SELECT `discount` FROM `invoice_no` WHERE `in_id`='$bill_no';";
			$indco=mysqli_query($conn,$ind)or die(mysqli_error());
			$disc=mysqli_fetch_array($indco);
			$discount=$disc['discount'];	
			//FIND GST	
			$confirm=mysqli_query($conn,$q) or die(mysqli_error());
			while($out=mysqli_fetch_array($confirm))
			{ 	$sn=$sn+1; 
				$t=$out['item_value'];
				$total=$total+$t;
				if($out['item_gst']=="0")
				{
					$without_gst=$out['item_value'];
				}
				if($out['item_gst']=="5")
				{
					$ttl1=$out['item_value'];
					$gstfive=$gstfive+$ttl1;
				}
				if($out['item_gst']=="12")
				{
					$ttl2=$out['item_value'];
					$gsttwelve=$gsttwelve+$ttl2;
				}
				if($out['item_gst']=="18")
				{
					$ttl3=$out['item_value'];
					$gsteghteen=$gsteghteen+$ttl3;
				}
			}
			$gst_five=($gstfive*5)/100;
			$sgst_five=$gst_five/2;
			$cgst_five=$gst_five/2;


			$gst_six=($gsttwelve*12)/100;
			$sgst_six=$gst_six/2;
			$cgst_six=$gst_six/2;

			$gst_eight=($gsteghteen*18)/100;
			$sgst_eight=$gst_eight/2;
			$cgst_eight=$gst_eight/2;

			$total_half=$sgst_five+$sgst_six+$sgst_eight;
			$total_gst=$gst_five+$gst_six+$gst_eight+$total;
			 $grand_total=$total_half+$total_half+$total-$discount;
		?>
            <!-- //gst -->

            <tr>
                <th colspan="1">Tax Amt</th>
                <th colspan="1">CGST%</th>
                <th colspan="1">CGST</th>
                <th colspan="1">SGST%</th>
                <th colspan="2">SGST</th>
                <th colspan="3">Gross Total</th>
                <th><?php echo round($total,2); ?></th>
            </tr>
            <tr>
                <td colspan="1"><?php echo round($gstfive,2); ?></td>
                <td colspan="1">2.50</td>
                <td colspan="1"><?php echo round($cgst_five,2); ?></td>
                <td colspan="1">2.50</td>
                <td colspan="2"><?php echo round($cgst_five,2); ?></td>
                <th colspan="3">Discount</th>
                <td colspan="1"><?php echo round($discount,2); ?></td>
            </tr>
            <tr>
                <td colspan="1"><?php echo round($gsttwelve,2); ?></td>
                <td colspan="1">6.00</td>
                <td colspan="1"><?php echo round($cgst_six,2); ?></td>
                <td colspan="1">6.00</td>
                <td colspan="2"><?php echo round($cgst_six,2); ?></td>
                <th colspan="3">CGST</th>
                <td colspan="1"><?php echo round($total_half,2); ?></td>
            </tr>
            <tr>
                <td colspan="1"><?php echo round($gsteghteen,2); ?></td>
                <td colspan="1">9.00</td>
                <td colspan="1"><?php echo round($cgst_eight,2); ?></td>
                <td colspan="1">9.00</td>
                <td colspan="2"><?php echo round($cgst_eight,2); ?></td>
                <th colspan="3">SGST</th>
                <td colspan="1"><?php echo round($total_half,2); ?></td>
            </tr>
            <tr>
                <th colspan="1">Total</th>
                <th colspan="1">CGST</th>
                <td colspan="1"><?php echo round($total_half,2);?></td>
                <th colspan="1">SGST</th>
                <td colspan="2"><?php echo round($total_half,2);?></td>
                <th colspan="3">Total Amount</th>
                <td colspan="2" id="value"><?php echo round($grand_total);?>.00</td>
            </tr>
           
            <tr>
                <td colspan="6" style="text-align: left; padding-left: 10px;"><br />
                    <h6 style="margin-bottom: -10px;">Amount In Word :<k class="word"></k></h6><br />
                    Bank Details<br />
                    A/c No: (0505201011268) OR (0505261000597)<br />
                    Bank: kanara </br>
                    IFSC Code: CNRB0000505</br>
                    <p>Subject to belgavi jurisdiction</p>
                    <p>Good sold ones will not be taken back </p>
                </td>
                <td colspan="4" rowspan="2">
                    <br /><br /><br /><br />
                    <h6>Authorised Signatory</h6>
                </td>
            </tr>
        </table>
    </div>
    </div>
    </div>
</body>
</html>

<script type="text/javascript">
$(document).ready(function() {
    window.print();
    window.onafterprint = function(event) {
    window.location.href = 'holesale_customer.php';
	}
});
</script>


