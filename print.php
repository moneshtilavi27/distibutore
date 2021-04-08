<?php include("header.php"); ?>

<?php
$invoice_num=$_GET['edit'];
$qry="SELECT DISTINCT `vendor`.`vender_name` AS `customer`,`vendor`.`vender_mob` AS `mob`, `vendor`.`vender_gst` AS `gst_no`,`vendor`.`vender_address` AS `address`,`purchase`.`purchase_date` AS `date` FROM `purchase`,`vendor` WHERE `vendor`.`vender_id`=`purchase`.`vender_id` AND `purchase`.`purchase_no_id`='$invoice_num';";
  $confirm=mysqli_query($conn,$qry);
  $out=mysqli_fetch_array($confirm);
?>
<!----invoise form------>
<div class="col-md-12 bg-success">
<h3 class="text-center" style="color:black; margin-top:3px;margin-bottom:-2px;">PRIVIOUS BILL</h3>

  <div class="row">
	<div class="col-md-10 ">
		<div class="row cust_add">
			<div class="col-md-3">
			<div class="offset-md-3 col-md-1 cust_info" style="display: none;">
			<label for="input">Customer id</label>
				<input type="text" name="" class="col-md-1 form-control input-sm" id="customer_id" readonly="">
			</div>
				<label>Bill No:-</label>
				<input type="text" name="" value="<?php echo $invoice_num;?>" class="col-md-1 form-control input-sm"id="customer_name" readonly="" style="background-color:white; font-size:14pt; ">
			</div>
			<div class="col-md-3">
      <label>Customer Name:-</label>
				<input type="text" name="" value="<?php echo $out['customer'];?>" class="col-md-1 form-control input-sm "id="customer_name" readonly="" style="background-color:white; font-size:14pt;">
			</div>
      <div class="col-md-3">
				<label>Customer Address:-</label>
				<input type="text" name="" value="<?php echo $out['address'];?>" class="col-md-1 form-control input-sm "id="customer_address" readonly="" style="background-color:white; font-size:14pt;">
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<label>Date:-</label>
				<input type="text" name="" value="<?php echo $out['date'];?>" class="col-md-1 form-control input-sm "id="customer_email" readonly="" style="background-color:white; font-size:14pt;">
			</div>
			<div class="col-md-3">
				<label>Customer Mobile No:-</label>
				<input type="text" name="" value="<?php echo $out['mob'];?>" class="col-md-1 form-control input-sm "id="customer_mob" readonly="" style="background-color:white; font-size:14pt;">
			</div>
      <div class="col-md-3">
      <label>Customer GST NO:-</label>
				<input type="text" name="" value="<?php echo $out['gst_no'];?>" class="col-md-1 form-control input-sm "id="customer_email" readonly="" style="background-color:white; font-size:14pt;">
			</div>
		</div>
    </div>
		</div>
 </div>
 </div>
</div>
<!----invoise form------>
<!-----table------->
<?php $purch_id=$_GET['edit'];?>
<div class="col-md-12 theam " style="margin-top: 5px;">
  <div class="tbl1" id="tb">
    <table class="fixed_header table table-bordered" id="table">
            <thead>
              <tr>
                  <th style="width:10%;">Sn</th>
                  <th style="width:30%;">Item Name</th>
                  <th>Packing</th>
                  <th>Item HSN</th>
                  <th>Item GST</th>    
                   <th>Quantity</th>
                  <th>Pur Rate</th>
                   <th>Value</th>
              </tr>
            </thead>
            <tbody>
            <?php
            include("connect.php");
            $total=0;
            $gstfive=$gsttwelve=$gsteghteen=$gsttwelve1=$gsteghteen1=$gstfive1=$t=$without_gst=0;
            $sn=0;
              $qry="SELECT `item`.`item_name` AS `item_name`,`item`.`item_hsn` AS `hsn`,`purchase`.`gst_per` AS `item_gst`,`item`.`item_pc` AS `item_pc`,`purchase`.`purchase_qty` AS `qty`,`purchase`.`purchase_mrp` AS `value` FROM `purchase`,`item` WHERE  `purchase`.`item_id`=`item`.`item_id` AND `purchase`.`purchase_no_id`='$invoice_num';";
              $confirm=mysqli_query($conn,$qry);
              while($out=mysqli_fetch_array($confirm))
              { $sn=$sn+1;
               $value = $out['value'] * $out['qty'];
               $t=$t+$value;
               if($out['item_gst']=="0")
               {
                $without_gst=$without_gst+$value;
               }
               if($out['item_gst']=="5")
               {
                $ttl1=$value;
                $gstfive=$gstfive+$ttl1;
               
               }
                if($out['item_gst']=="12")
               {
                $ttl2=$value;
                $gsttwelve=$gsttwelve+$ttl2;
               }
                if($out['item_gst']=="18")
               {
                $ttl3=$value;
                $gsteghteen=$gsteghteen+$ttl3;
                $minus=$gsteghteen*18/100;
                $gsteghteen1=$gsteghteen-$minus;
               }
               $total=$gstfive+$gsttwelve+$gsteghteen;
            ?>
            <tr>
                <td style="margin-left: 10px;width:10%;"><?php echo $sn;?></td>
                <td style="display: none;"><?php echo $out['item_id'];?></td>
                <td style="width:30%;"><?php echo $out['item_name'];?></td>
                <td><?php echo $out['item_pc'];?></td>
                <td><?php echo $out['hsn'];?></td>
                <td><?php echo $out['item_gst'];?></td>
                <td><?php echo $out['qty'];?></td>
                  <td><?php echo round($out['value'],2);?></td> 
                <td><?php echo round($value,2);?></td>
               <!--  <td><?php echo $t;?></td> -->
                <td style="display: none;"><?php echo $out['custid'];?></td>
              </tr>
        <?php } ?>
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
            $total_gst=$gst_five+$gst_six+$gst_eight+$total+$without_gst;
            // if($gstfive1==0 && $gsttwelve1==0 && $gsteghteen1==0)
            // {
            //  $total_gst=$t;
            // }
          ?>

        <div class="row">
          <div class="col-md-10">
          <table class="table-bordered tab" style="width:100%; margin-top:-10px;">
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
          <div class="col-md-2" style="margin-top: -10px; margin-left: 0px;">
              <label for="input"></label>
              <input type="text" value="<?php echo $invoice_num;?>" id="bill" style="display: none;">
              <input type="button" name="Print" value="Print" class="col-md-6 input-sm btn-success" id="print" style="display: none;">
            </div>
               <div class="col-md-2" style="margin-top: 20px; margin-left: 0px;">
              <label for="input"></label>
              <input type="button" name="Cancel" value="Back" class="col-md-6 input-sm btn-danger" id="back">
            </div>
          </div>
</div>
</div>
<!------table------>

<!--------bottons------>
<script type="text/javascript">
  $(document).ready(function(){
    $('#back').click(function(){
      location="purchasebill.php";
    });
  });
</script>





</body>
</html>