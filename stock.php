<?php include("header.php"); ?>

<body class="theam">
    <div class="col-md-12 bg-success ">
        <h2 class="text-center" style="color:black;">STOCK INVENTARY</h2>
        <div class="row">
            <div class="col-md-12">
                <div class="row cust_add">
                    <form action="" method="post">
                        <div class="col-md-2" style="margin-left: 15px;">
                            <label>Sort Stock:-</label>
                            <select name="cmp" class="col-md-1 form-control input-sm " id="stk">
                                <option>Select</option>
                                <option>Bella</option>
                                <option>H.B</option>
                                <option>Clenzu</option>
                                <option>Delika</option>
                                <option>Purnima Treds</option>
                                <option>Stricks</option>
                                <option>Pharmalayam</option>
                                <option>Baliga</option>
                                <option>Atish</option>
                            </select>
                        </div>
                        <div style="margin-bottom: 10px;" class="col-lg-4">
                            <input style=" margin-top: 25px;" type="submit" value="Submit"
                                class="col-md-2 input-sm btn btn-success" id="customer_add1" name="search">
                            <input style="margin-left:25px; margin-top: 25px;" type="button"
                                onclick="exportTableToExcel('table', 'closingstock')" value="Excel" class="btn-sm btn-warning"
                                id="search">
                        </div>
                    </form>
                    <div class="col-md-3" style="margin-left: 300px;">
                        <label>Search:</label>
                        <input type="text" placeholder="Search.." onkeyup="myFunction()" name="search" id="search"
                            class="form-control">
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
                <tr id="exelhead" style="display: none;">
                    <th colspan="7"><h2 class="text-center">Closing Stock
                    <?php
                    if(isset($_POST['search']))
                    {
                       echo $cmp=$_POST['cmp']." ",date('d-m-Y');
                    }
                    ?>
                    </h2></th>
                </tr>
                <tr>
                    <th style="width:10%">Sn</th>
                    <!-- <th style="width:10%" id="id">Item Id</th> -->
                    <th style="width:40%">Item Name</th>
                    <th>Item Pc</th>
                    <th>Item HSN</th>
                    <!-- <th>Item Gst</th> -->
                    <th>Quantity</th>
                    <th>Basic Rate</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody id="mytable">
                <script type="text/javascript"></script>

                <?php
		$sn = 0;
		$total = 0;
		$gstfive = $gsttwelve = $gsteghteen = 0;
		if(isset($_POST['search']))
		 {
			$cmp=$_POST['cmp'];
			$qry="SELECT `item`.`item_id` AS `item_id`,`item`.`item_name` AS `item_name`,`item`.`item_hsn`AS `item_hsn`, `item`.`item_gst` AS `item_gst`,`item`.`item_pc` AS `item_pc`,`item`.`pur` AS `value`,`stock`.`stock_quantity` AS `quatity` FROM `item`,`stock` WHERE `item`.`item_id`=`stock`.`item_id` AND `item`.`item_cmp`='$cmp' ORDER BY `item`.`item_id`;";
		}
		else{
			$qry = "SELECT `item`.`item_id` AS `item_id`,`item`.`item_name` AS `item_name`,`item`.`item_hsn`AS `item_hsn`, `item`.`item_gst` AS `item_gst`,`item`.`item_pc` AS `item_pc`,`item`.`pur` AS `value`,`stock`.`stock_quantity` AS `quatity` FROM `item`,`stock` WHERE `item`.`item_id`=`stock`.`item_id` ORDER BY `item`.`item_id`;";
			}
		$stock=$stock1="0";
		$confirm = mysqli_query($conn, $qry);
		while ($out = mysqli_fetch_array($confirm)) {
			$sn = $sn + 1;

		?>
                <tr>
                    <td style="width:10%"><?php echo $sn; ?></td>
                    <!-- <td style="width:10%"><?php echo $out['item_id']; ?></td> -->
                    <td style="width:40%"><?php echo $out['item_name']; ?></td>
                    <td><?php echo $out['item_pc']; ?></td>
                    <td><?php echo $out['item_hsn']; ?></td>
                    <td><?php echo $out['quatity']; ?></td>
                    <td><?php echo $out['value']; ?></td>
                    <td><?php echo $stock = $out['quatity'] * $out['value']; ?></td>
                </tr>

                <?php	$stock1=$stock1+$stock; } ?>
            </tbody>
            <thead>
                <th></th>
                <th colspan="1"></th>
                <th></th>
                <th></th>
                <th></th>
                <th style="font-size:15pt"><?php echo "Total"; ?></td>
                <th style="font-size:15pt"><?php echo $stock1;?></td>
                    </tr>
            </thead>

        </table>
    </div>
    </div>
    <!------table------>






</body>

</html>

<script>
$(document).ready(function() {
    $('#stock').load("max_stock_fetch.php");
});
</script>
<script>
$(document).ready(function() {
    $('#search').keyup(function() {
        var value = $(this).val().toLowerCase();
        $('#mytable tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });

    });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#stk').change(function() {
        var x = $(this).val();
        if (x == "ASC") {
            $('#stock').load("max_stock_fetch.php");
        } else {
            $('#stock').load("min_stock_fetch.php");
        }
    });
});
</script>