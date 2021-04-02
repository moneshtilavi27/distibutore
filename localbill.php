<?php include("header.php"); 


$invoice_num=$_GET['edit'];
$qry="SELECT DISTINCT `customer`.`customer_name` AS `customer`,`customer`.`customer_mob` AS `mob`,`customer`.`customer_address` AS `address`,`customer`.`customer_gst` AS `gst_no`,`invoice`.`invoice_date` AS `date` FROM `customer`,`invoice`,`invoice_no` WHERE `customer`.`customer_id`=`invoice`.`customer_id` AND `invoice`.`in_id`=`invoice_no`.`in_id` AND `invoice_no`.`number`='$invoice_num' LIMIT 1;";
  $confirm=mysqli_query($conn,$qry)or die(mysqli_error());
  $out=mysqli_fetch_array($confirm);
?>

<body class="theam">
    <!----invoise form------>
    <div class="col-md-12 bg-success">
        <h2 class="text-center" style="color:black;">Invoice Details</h2>

        <div class="row">
            <div class="col-md-10 ">
                <div class="row cust_add">
                    <div class="col-md-1">
                        <div class="offset-md-3 col-md-1 cust_info" style="display: none;">
                            <label for="input">Customer id</label>
                            <input type="text" name="" class="col-md-1 form-control input-sm" id="customer_id"
                                readonly="">
                        </div>
                        <label>Bill No:-</label>
                        <input type="text" name="" value="<?php echo $invoice_num;?>"
                            class="col-md-1 form-control input-sm" id="bill_no" readonly=""
                            style="background-color:white; font-size:14pt; ">
                    </div>
                    <div class="col-md-3">
                        <label>Customer Name:-</label>
                        <input type="text" name="" value="<?php echo $out['customer'];?>"
                            class="col-md-1 form-control input-sm " id="customer_name" readonly=""
                            style="background-color:white; font-size:14pt;">
                    </div>
                    <div class="col-md-7">
                        <label>Customer Address:-</label>
                        <input type="text" name="" value="<?php echo $out['address'];?>"
                            class="col-md-1 form-control input-sm " id="customer_address" readonly=""
                            style="background-color:white; font-size:14pt;">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label>Date:-</label>
                        <input type="text" name="" value="<?php echo date("d-m-Y",strtotime($out['date']));?>"
                            class="col-md-1 form-control input-sm " id="customer_email" readonly=""
                            style="background-color:white; font-size:14pt;">
                    </div>
                    <div class="col-md-3">
                        <label>Customer Mobile No:-</label>
                        <input type="text" name="" value="<?php echo $out['mob'];?>"
                            class="col-md-1 form-control input-sm " id="customer_mob" readonly=""
                            style="background-color:white; font-size:14pt;">
                    </div>
                    <div class="col-md-5">
                        <label>Customer GST NO:-</label>
                        <input type="text" name="" value="<?php echo $out['gst_no'];?>"
                            class="col-md-1 form-control input-sm " id="customer_email" readonly=""
                            style="background-color:white; font-size:14pt;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!----invoise form------>
    <!-----table------->
    <?php $bill_id=$_GET['edit'];?>
    <div class="col-md-12 theam" style="margin-top: 2px;">
        <div class="tbl1" id="tb">
            <table class="fixed_header table table-bordered" id="table">
                <thead>
                    <tr>
                        <th style="width:5%">Sn</th>
                        <th style="display: none;">Item Id</th>
                        <th style="width:30%">Item Name</th>
                        <th style="width:11%">Item HSN</th>
                        <th>MRP Rate</th>
                        <th>Item GST</th>
                        <th>Quantity</th>
                        <th>Free</th>
                        <th>Item Rate</th>
                        <th>Value</th>
                        <!--   <th>Total</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
					  include("connect.php");
					  $total=0;
					  $gstfive=$gsttwelve=$gsteghteen=$t=$without_gst=0;
					  $sn=0;
							$qry="SELECT `item`.`item_name` AS `item_name`,`item`.`item_hsn` AS `item_hsn`,`item`.`item_gst` AS `item_gst`,`invoice`.`qty` AS `item_quant`,`invoice`.`free` AS `free_item`,`invoice`.`mrp` AS `mrp`,`invoice`.`rate` AS `item_rate`,`invoice`.`value` AS `item_value` FROM `invoice`,`item` WHERE `item`.`item_id`=`invoice`.`item_id` AND `invoice`.`in_id`='$bill_id';";
							$confirm=mysqli_query($conn,$qry)or die(mysqli_error());
							while($out=mysqli_fetch_array($confirm))
							{ $sn=$sn+1;
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

						?>
                    <tr>
                        <td style="margin-left: 10px; width:5%"><?php echo $sn;?></td>
                        <td style="display: none;"><?php echo $out['item_id'];?></td>
                        <td style="width:30%; text-align: left;"><?php echo $out['item_name'];?></td>
                        <td style="width:11%"><?php echo $out['item_hsn'];?></td>
                        <td><?php echo $out['item_gst'];?></td>
                        <td><?php echo round($out['mrp'],2);?></td>
                        <td><?php echo $out['item_quant'];?></td>
                        <td><?php echo $out['free_item'];?></td>
                        <td><?php echo round($out['item_rate'],2);?></td>
                        <td><?php echo round($out['item_value'],2);?></td>
                        <!--  <td><?php echo $t;?></td> -->
                        <td style="display: none;"><?php echo $out['custid'];?></td>
                    </tr>
                    <?php	} ?>
                </tbody>
            </table>

            <?php
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
			 $grand_total=$total_half+$total_half+$total;
						?>

            <div class="row" style="margin-top: -20px;">
                <div class="col-md-10">
                    <table class="table-bordered tab" style="width:100%">
                        <tr>
                            <th></th>
                            <th>Gross Total</th>
                            <th>CGST</th>
                            <th>Amount</th>
                            <th>SGST</th>
                            <th>Amount</th>
                            <th>Total</th>
                        </tr>
                        <tr>
                            <th>5 % GST</th>
                            <td><?php echo round($gstfive,2); ?></td>
                            <td>2.50</td>
                            <td><?php echo round($cgst_five,2); ?></td>
                            <td>2.50</td>
                            <td><?php echo round($cgst_five,2); ?></td>
                            <th><?php echo round($gst_five,2); ?></th>
                        </tr>
                        <tr>
                            <th>12 % GST</th>
                            <td><?php echo round($gsttwelve,2); ?></td>
                            <td>6.00</td>
                            <td><?php echo round($cgst_six,2); ?></td>
                            <td>6.00</td>
                            <td><?php echo round($sgst_six,2); ?></td>
                            <th><?php echo round($gst_six,2); ?></th>
                        </tr>
                        <tr>
                            <th>18 % GST</th>
                            <td><?php echo round($gsteghteen,2); ?></td>
                            <td>9.00</td>
                            <td><?php echo round($cgst_eight,2); ?></td>
                            <td>9.00</td>
                            <td><?php echo round($sgst_eight,2); ?></td>
                            <th><?php echo round($gst_eight,2); ?></th>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <th><?php echo round($total,2); ?></th>
                            <td></td>
                            <th><?php echo round($total_half,2); ?></th>
                            <td></td>
                            <th><?php echo round($total_half,2); ?></th>
                            <th><?php echo round($total_gst); ?>.00</th>
                        </tr>
                    </table>
                </div>
                <div class="col-md-2" style="margin-top: 20px; margin-left: 0px;">
                    <label for="input"></label>
                    <input type="button" name="Save" style="background-color: green;color:black" value="Print"
                        class="col-md-6 input-sm bg-success" id="print">
                </div>
                <div class="col-md-2" style="margin-top: 20px; margin-left: 0px;">
                    <label for="input"></label>
                    <input type="button" name="Cancel" value="Cancel" style="background-color: tomato;color:black"
                        class="col-md-6 input-sm" id="cancel">
                </div>

            </div>
            <!------table------>

            <!--------bottons------>
            <script type="text/javascript">
            $(document).ready(function() {
                $('#cancel').click(function() {
                    location = "localsale.php";
                });

                $('#print').click(function() {
                    var status = $('#bill_no').val();
                    location = "tax2.php?bill_no=" + status;
                });
            });
            </script>





</body>

</html>