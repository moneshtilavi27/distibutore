<?php include("header.php"); ?>


<body class="theam">
<div class="col-md-12 bg-success ">
<h2 class="text-center" style="color:black;">PURCHSE BILLS</h2>
<div class="row">
	<div class="col-md-12 ">
		<div class="row cust_add">
			<form action=" " method="post">
			<div class="col-md-3">
				<div class="offset-md-3 col-md-1 cust_info" style="display: none;">
			<label for="input">Customer id</label>
				<input type="text" name="" class="col-md-1 form-control input-sm" id="customer_id" readonly="">
			</div>
			
				<label>Starting Date:-</label>
				<input type="date" name="stat" class="col-md-1 form-control input-sm" id="">
			</div>
			<div class="col-md-3">
				<label>Ending Date:-</label>
				<input type="date" name="end" class="col-md-1 form-control input-sm" id="">
			</div>

			<div  style="margin-bottom: 10px;" class="col-lg-4">
		

		 <input style="margin-left: 10px; margin-top: 30px;" type="submit" value="Submit" class="col-md-2 input-sm btn btn-success" id="customer_add1" name="purch">						
				<input type="text" value="" id="custid" style="display: none;">
				<!-- <input style="margin-left: 10px; margin-top: 30px;" type="button" value="Export" class="col-md-2 input-sm btn btn-info" id="update"> -->
			</div>

		</form>
			<div style="margin-left: -20px;" class="col-md-2">
				<label>Search:</label>
				 <input type="text" placeholder="Search.." class="form-control input-sm" id="search">
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
					      <th style="width: 10%";> Sn</th>
					     <th id="id" style="width: 10%";>Purchase Id</th>
					      <th style="width: 30%";>Vendor Name</th>
					      <th>Date</th>
					      <th>Items</th>
					       <th>Amount</th>
					       <th>Action</th>
					    </tr>
					  </thead>
					  <tbody id="table_body">
					  <script type="text/javascript"></script>	
					  
					  <?php
					  include("connect.php");
					  $sn=0; $total=0;
					  $gstfive=$gsttwelve=$gsteghteen=0;
					  if(isset($_POST['purch']))
					  {
					  	$strat=$_POST['stat'];$end=$_POST['end'];
					  	$qry="SELECT `purchase_num`.`purchase_no_id` AS `pur_num`,`vendor`.`vender_name` AS `vendor`,`purchase_num`.`date` AS `date` FROM `vendor`,`purchase_num`,`purchase` WHERE `purchase`.`purchase_no_id`=`purchase_num`.`purchase_no_id` AND `vendor`.`vender_id`=`purchase`.`vender_id` AND `purchase`.`purchase_date` BETWEEN '$strat' AND '$end' ORDER BY `purchase_date` ASC";
					  }
						else{
							$qry="SELECT DISTINCT `purchase_num`.`purchase_no_id` AS `pur_num`,`vendor`.`vender_name` AS `vendor`,`purchase_num`.`date` AS `date` FROM `vendor`,`purchase_num`,`purchase` WHERE `purchase`.`purchase_no_id`=`purchase_num`.`purchase_no_id` AND `vendor`.`vender_id`=`purchase`.`vender_id` ORDER BY `purchase_date` DESC";
						}
						$confirm=mysqli_query($conn,$qry)or die(mysqli_error());
							while($out=mysqli_fetch_array($confirm))
							{ $sn=$sn+1; 
								$num=$out['pur_num'];
								$value=$item=$total=0;
								$qr="SELECT `gst_per`,`Purchase_rate` FROM `purchase` WHERE `purchase_no_id`='$num';";
								$co=mysqli_query($conn,$qr)or die(mysqli_error());
								while($row=mysqli_fetch_array($co))
								{
									$item++;
									$val=(($row['Purchase_rate']*$row['gst_per'])/100)+$row['Purchase_rate'];
									$total=$total+$val;
								}
								
						?>
						<tr>
					   		<td style="width: 10%";><?php echo $sn;?></td>
					   		 <td style="width: 10%";><?php echo $out['pur_num'];?></td>
					      <td style="width: 30%";><?php echo $out['vendor'];?></td>
						  <td><?php echo date("d-m-Y",strtotime($out['date']));?></td>
					      <td><?php echo $item;?></td>
					      <td><?php echo round($total);?></td>
					      <td><a href="print.php?edit=<?php echo $out['pur_num']; ?>"
                                       class="input-sm btn btn-success">View</a>
                                       </td>
					    </tr>
				<?php	}  ?>
					  </tbody>
					</table>
		</div>
</div>
</div>
<!------table------>

 <script>
        $(document).ready(function(){
            $('#search').keyup(function(){
            var value = $(this).val().toLowerCase();
                $('#table_body tr').filter(function(){
                     $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
                 
            });
        });

 </script>




</body>
</html>