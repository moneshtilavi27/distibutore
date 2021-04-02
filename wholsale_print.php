<!DOCTYPE html>
<html>
<head>
 <title>Rafiq & Sons</title>
 
  <?php include("connect.php"); ?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript" src="js/custom.js"></script>
   <style type="text/css">
        
        .b1{ height: 38px;
            margin-top: 23px;
            width: 10em;
        }
        #b1{background-color: lightgreen;}
         #b2{background-color: lightcoral;}
         #b3{background-color: lightblue;}
        #list{ max-height: 70px;
            overflow-y: auto;}
        #list ul{
            background-color: #DEB0A6;
            cursor: pointer;
        }
        #list li{ color: black; 
            font: 12pt;
        padding: 8px;}
         #list li:hover{ color: white; 
            background-color: #b3b3ff;}
    
              #list1{ max-height: 70px;
            overflow-y: auto;}
        #list1 ul{
            background-color: #DEB0A6;
            cursor: pointer;
        }
        #list1 li{ color: black; 
            font: 12pt;
        padding: 8px;}
         #list1 li:hover{ color: white; 
            background-color: #b3b3ff;}

    </style>

 

</head>
<body>
<section class="col-md-12" style="background-color: yellow; margin-top: -15px;" >
 <div class="text-center">
  <h3 style="font-family: Times New Roman;">Rafiq & Sons</h3>
 </div>

</section>
<section class="col-md-12 bg-primary mt-3" style="margin-top: -10px;">
  <div class="row">
    <div class="col-md-1">
     <div class="dropdown">
      <div class="dropdown-toggle " data-toggle="dropdown"><h4>Invoice</h4></div>
        <ul class="dropdown-menu">
            <li><a href="Customer.php">Sales</a></li>
          <li><a href="holesale_customer.html">Wholesaler</a></li>
        </ul>
      </div> 
    </div>
    <div class="col-md-1">
     <div class="dropdown">
      <div class="dropdown-toggle " data-toggle="dropdown"><h4>Master</h4></div>
        <ul class="dropdown-menu">
             <li><a href="additem.php">Item Master</a></li>
              <li><a href="vendor.php">Supplier</a></li>
              <li><a href="cust_reg.php">Client</a></li>
      </ul>
      </div> 
    </div>
     <div class="col-md-1">
       <div class="dropdown">
       <div class="dropdown-toggle " data-toggle="dropdown"><h4>Purchase</h4></div>
        <ul class="dropdown-menu">
            <li><a href="purchase.html">Stock Entry</a></li>
          <li><a href="purchase_return.html">Purchase Return</a></li>
        </ul>
      </div> 
  </div>
        <div class="col-md-1">
     <div class="dropdown">
      <div class="dropdown-toggle " data-toggle="dropdown"><h4>Report</h4></div>
        <ul class="dropdown-menu">
           <li><a href="stock.php">Stock</a></li>
          <li><a href="purchasebill.php">Purchase Bills</a></li>
          <li><a href="purch_return.php">Purchase Return Bills</a></li>
           <li><a href="ssales.php">Wholesales Bills</a></li>
           <li><a href="localsale.php">Localsales Bills</a></li>
      </div> 
    </div>
   <div class="col-md-1">
     <a href="index.php"><h4 style="color:white";>Logout</h4> </a>
    </div>
  </div>
</section>
<?php
$invoice_num=$_GET['edit'];
$qry="SELECT DISTINCT `customer`.`customer_name` AS `customer`,`customer`.`customer_mob` AS `mob`,`customer`.`customer_gst` AS `gst_no`,`customer`.`customer_address` AS `address`,`invoice`.`invoice_date` AS `date` FROM `customer`,`invoice`,`invoice_no` WHERE `customer`.`customer_id`=`invoice`.`customer_id` AND `invoice`.`in_id`=`invoice_no`.`in_id` AND `invoice_no`.`number`='$invoice_num' LIMIT 1";
  $confirm=mysqli_query($conn,$qry)or die(mysqli_error());
  $out=mysqli_fetch_array($confirm);
?>
<!----invoise form------>
<div class="col-md-12 bg-success ">
<div class="row">
 <div class="col-md-9" style="margin-top: 10px;">
  <div class="right">
  <div class="row">
   <div class="col-md-4">
    <label>Supplier Name:-</label>
    <label><?php echo $out['customer'];?></label>
   </div>
   <div class="col-md-4">
    <label> Gst No:-</label>
    <label id="gst"><?php echo $out['gst_no'];?></label>
   </div>
    <div class="col-md-3">
    <label> Purchase Bill No:-</label>
    <label id="bill_no"><?php echo $invoice_num;?></label>
   </div>
  </div>
  <div class="row">
   <div class="col-md-4">
    <label>Supplier Mobile:-</label>
    <label id="mob"><?php echo $out['mob'];?></label>
   </div>
 <!--   <div class="col-md-3">
    <label>State:-</label>
    <label id="gst">Karnataka</label>
   </div> -->
    <div class="col-md-3">
    <label>Date:-</label>
    <label id="date"><?php echo $out['date'];?></label>
   </div>
  </div>
  <div class="row">
     <div class="col-md-12">
      <label>Supplier Address:-</label>
      <label id="adress"><?php echo $out['address'];?></label>
     </div>
 </div>
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
<div class="col-md-12 bg-danger " style="margin-top: -10px;">
 <div class="row ip2">
  <div class="tbl1" id="tb">
    <table class="fixed_header table table-bordered" id="table">
            <thead>
              <tr>
                  <th>Sn</th>
                  <th>Item Name</th>
                  <th>Item HSN</th>
                  <th>Item GST</th>    
                   <th>Quantity</th>
                  <th>Rate Per kg/ltr</th>
                   <th>Value</th>
              </tr>
            </thead>
            <tbody>
            <?php
            include("connect.php");
            $total=0;
            $gstfive=$gsttwelve=$gsteghteen=$gsttwelve1=$gsteghteen1=$gstfive1=$t=$without_gst=0;
            $sn=0;
              $qry="SELECT `item`.`item_name` AS `item_name`,`item`.`item_hsn` AS `hsn`,`item`.`item_gst` AS `item_gst`,`item`.`item_unit` AS `item_unit`, `purchse_gst`.`gross_total` AS `gross`, `purchse_gst`.`5%` AS `%5`,`purchse_gst`.`12%` AS `12%` ,`purchse_gst`.`18%` AS `18%`, `invoice`.`qty` AS `qty`,`invoice`.`value` AS `value` FROM `customer`,`purchse_gst`,`invoice`,`item` WHERE `invoice`.`customer_id`=`customer`.`customer_id` AND `invoice`.`gst_id`=`purchse_gst`.`gst_id` AND `item`.`item_id`=`invoice`.`item_id` AND `invoice`.`in_id`='$invoice_num';";
              $confirm=mysqli_query($conn,$qry)or die(mysqli_error());
              while($out=mysqli_fetch_array($confirm))
              { $sn=$sn+1;
                $value=$out['value']*$out['qty'];
               $t=$t+$value;
              
               if($out['item_gst']=="0")
               {
                $without_gst=$out['value'];
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
                <td style="margin-left: 10px;"><?php echo $sn;?></td>
                <td style="display: none;"><?php echo $out['item_id'];?></td>
                <td><?php echo $out['item_name'];?></td>
                <td><?php echo $out['hsn'];?></td>
                <td><?php echo $out['item_gst'];?></td>
                <td><?php echo $out['qty'].$out['item_unit']?></td>
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
              <input type="text" value="<?php echo $invoice_num;?>" id="bill" style="display: none;">
              <input type="button" name="Print" value="Print" class="col-md-6 input-sm bg-success" id="print">
            </div>
               <div class="col-md-2" style="margin-top: 20px; margin-left: 0px;">
              <label for="input"></label>
              <input type="button" name="Cancel" value="Back" class="col-md-6 input-sm bg-success" id="back">
            </div>
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

     $('#print').click(function(){
      var x = $('#bill').val();
       location="tax2.php?bill_no="+x;
    });
  });
</script>





</body>
</html>