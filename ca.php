<?php include("header.php"); ?>


<body class="theam">
    <div class="col-md-12 bg-success ">
        <h2 class="text-center" style="color:black;">C A REPORT</h2>
        <div class="row">
            <div class="col-md-12 ">
                <div class="row cust_add">
                    <form action="" method="post">
                        <div class="col-md-2">
                            <label>Starting Date:-</label>
                            <input type="date" name="start" class="col-md-1 form-control input-sm" id="">
                        </div>
                        <div class="col-md-2">
                            <label>Ending Date:-</label>
                            <input type="date" name="end" class="col-md-1 form-control input-sm" id="">
                        </div>

                        <div style="margin-bottom: 10px;" class="col-lg-4">
                            <input style=" margin-top: 25px;" type="submit" value="Submit"
                                class="col-md-2 input-sm btn btn-success" id="customer_add1" name="search">
                        </div>

                    </form>
                    <div style="margin-left: -20px;" class="col-md-2">
                        <label>Search:</label>
                        <input type="text" placeholder="Search.." class="form-control input-sm" id="search">
                    </div>
                    <div class="col-md-1">
                        <input type="button" onclick="exportTableToExcel('table', 'Sale_Report')" value="Excel"
                            style=" margin-top: 25px;" class="btn-sm btn-warning" id="search">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <!-- <center>
	
	<table style=" padding-top: 20px; width: 100%" border="1">
		
		<tr><th>Serial No</th><th>Item Name</th><th>Item HSN</th><th>Item GST</th><th>Item Unit</th><th>Quantity</th><th>Item Value</th><th>Amount</th></tr>
		<tr></tr>
		 
	</table>
</center> -->

    <!-----table------->
	<div class="col-md-12 theam " style="margin-top: -10px;">
            <table class="fixed_header1 table table-bordered" id="table">
                <thead>
                    <tr>
                        <th style="width: 5%" ;> Bill no</th>
                        <th style="width: 15%" ;>Cudtomer Name</th>
                        <th style="width: 10%" ;>GST No</th>
                        <th style="width: 10%" ;>Date</th>
                        <th>Gross Amount</th>
                        <th>Discount</th>
                        <th>CGST</th>
                        <th>SGST</th>
                        <th>TOTAL AMT</th>
						<th class="exelhead" style="display: none;">Bill Status</th>
                    </tr>
                </thead>
                <tbody id="table_body">
                    <script type="text/javascript"></script>

                    <?php
					  include("connect.php");
					  $sn=0;
					  if(isset($_POST['search']))
					  {
					  	 $start=date("Y-m-d",strtotime($_POST['start'])); $end=date("Y-m-d",strtotime($_POST['end']));
					  	$qry="SELECT DISTINCT `customer`.`customer_name`,`customer`.`customer_gst`,`invoice_no`.*,`invoice`.`invoice_date` AS `date` FROM `invoice_no`,`invoice`,`customer` WHERE `invoice_no`.`in_id`=`invoice`.`in_id` AND `invoice`.`customer_id`=`customer`.`customer_id` AND `invoice`.`invoice_date` BETWEEN '$start' AND '$end' ORDER BY `invoice_no`.`in_id`";
					  }else{
							$qry="SELECT DISTINCT `customer`.`customer_name`,`customer`.`customer_gst`,`invoice_no`.*,`invoice`.`invoice_date` AS `date` FROM `invoice_no`,`invoice`,`customer` WHERE `invoice_no`.`in_id`=`invoice`.`in_id` AND `invoice`.`customer_id`=`customer`.`customer_id` ORDER BY `invoice_no`.`in_id`;";
						}
						$confirm=mysqli_query($conn,$qry) or die(mysqli_error());
						$total=$gt=0;
						while($out=mysqli_fetch_array($confirm))
						{ $sn=$sn+1;$t=$g=0;
							if($out['status']!='1')
							{
								$t = $out['gross_total']-$out['discount']+$out['5%']+$out['12%']+$out['18%'];
								$g= $out['gross_total'];
							}
						?>
                    <tr <?php if($out['status']=='1'){?> style="background-color:lightpink"; <?php } ?>>
                        <td style="width: 5%" ;><?php echo $out['in_id'];?></td>
                        <td style="width: 15%" ;><?php echo $out['customer_name'];?></td>
                        <td style="width: 10%" ;><?php echo $out['customer_gst'];?></td>
                        <td style="width: 10%" ;><?php echo date("d-m-Y",strtotime($out['date']));?></td>
                        <td><?php echo number_format($out['gross_total'],2);?></td>
                        <td><?php echo $out['discount'];?></td>
                        <td><?php echo number_format(($out['5%']+$out['12%']+$out['18%'])/2,2);?></td>
                        <td><?php echo number_format(($out['5%']+$out['12%']+$out['18%'])/2,2);?></td>
                        <td><?php echo number_format($out['gross_total']-$out['discount']+$out['5%']+$out['12%']+$out['18%'],2);?></td>
						<td class="exelhead" style="display: none;"><?php if($out['status']=='1') echo "Cancel"; ?></td>
                    </tr>
                    <?php $gt +=$g; $total += $t;}  ?>
                </tbody>
                <thead>
                    <th style="width: 5%" ;></th>
                    <th style="width: 15%";></th>
                    <th style="width: 10%";></th>
					<th style="width: 10%;font-size:15pt"><?php echo "Gross Total"; ?></td>
                    <th style="font-size:15pt"><?php echo number_format($gt,2);?></td>
					<th></th><th></th>
                    <th style="font-size:15pt"><?php echo "Total"; ?></td>
                    <th style="font-size:15pt"><?php echo number_format($total,2);?></td>
                        </tr>
                </thead>
            </table>
    </div>
    <!------table------>

    <script>
    $(document).ready(function() {
        $('#search').keyup(function() {
            var value = $(this).val().toLowerCase();
            $('#table_body tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });

        });
    });

    </script>




</body>

</html>