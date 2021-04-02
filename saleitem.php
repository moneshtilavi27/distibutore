<?php include("header.php"); ?>


<body class="theam">
    <div class="col-md-12 bg-success ">
        <h2 class="text-center" style="color:black;">SALED ITEMS</h2>
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
                        <input type="button" onclick="exportTableToExcel('table', 'C_A_Report')" value="Excel"
                            style=" margin-top: 25px;" class="btn-sm btn-warning" id="search">
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
        <div class="tbl1" id="fetchdata">
            <table class="fixed_header2 table table-bordered" id="table">
                <thead>
                    <tr>
                        <th style="width: 5%" ;> Sn</th>
                        <th id="id" style="width: 10%" ;>Bill No</th>
                        <th style="width: 30%" ;>Item Name</th>
                        <th>Qty</th>
                        <th>Rate</th>
                        <th>Value</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody id="table_body">
                    <script type="text/javascript"></script>

                    <?php
					  include("connect.php");
					  $sn=0; $total=0;
					  if(isset($_POST['search']))
					  {
					  	$start=date("Y-m-d",strtotime($_POST['start'])); $end=date("Y-m-d",strtotime($_POST['end']));
					  	$qry="SELECT `item`.`item_name` AS `item_name`,`invoice`.`in_id` AS `invoice_no`,`invoice`.`qty` AS `qty`,`invoice`.`rate` AS `rate`,`invoice`.`invoice_date` AS `date` FROM `item`,`invoice` WHERE `item`.`item_id`=`invoice`.`item_id` AND `invoice`.`invoice_date` BETWEEN '$start' AND '$end' ORDER BY `invoice`.`invoice_date` DESC";
					  }
						else{
							$qry="SELECT `item`.`item_name` AS `item_name`,`invoice`.`in_id` AS `invoice_no`,`invoice`.`qty` AS `qty`,`invoice`.`rate` AS `rate`,`invoice`.`invoice_date` AS `date` FROM `item`,`invoice` WHERE `item`.`item_id`=`invoice`.`item_id` ORDER BY `invoice`.`invoice_date` DESC";
						}
						$confirm=mysqli_query($conn,$qry)or die(mysqli_error());
							while($out=mysqli_fetch_array($confirm))
							{ $sn=$sn+1; 
						?>
                    <tr>
                        <td style="width: 5%" ;><?php echo $sn;?></td>
                        <td style="width: 10%" ;><?php echo $out['invoice_no'];?></td>
                        <td style="width: 30%" ;><?php echo $out['item_name'];?></td>
                        <td><?php echo $out['qty'];?></td>
                        <td><?php echo $out['rate'];?></td>
                        <td><?php echo $out['rate']*$out['qty'];?></td>
                        <td><?php echo date("d-m-Y",strtotime($out['date']));?></td>
                    </tr>
                    <?php	}  ?>
                </tbody>
            </table>
        </div>
    </div>
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