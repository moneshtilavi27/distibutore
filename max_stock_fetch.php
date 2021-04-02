<table class="fixed_header2 table table-bordered" id="table">
    <thead>
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

		$qry = "SELECT `item`.`item_id` AS `item_id`,`item`.`item_name` AS `item_name`,`item`.`item_hsn`AS `item_hsn`, `item`.`item_gst` AS `item_gst`,`item`.`item_pc` AS `item_pc`,`item`.`pur` AS `value`,`stock`.`stock_quantity` AS `quatity` FROM `item`,`stock` WHERE `item`.`item_id`=`stock`.`item_id` ORDER BY `stock_quantity` ASC";
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
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
            <th style="font-size:15pt"><?php echo "Total"; ?></td>
            <th style="font-size:15pt"><?php echo $stock1;?></td>
        </tr>
	</thead>
   
</table>