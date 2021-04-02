
	<table class="fixed_header1 table  table-bordered" id="table">
					  <thead>
					    <tr>
					      <th style="width:5%";>Sn</th>
					       <th style="width:5%"; id="id">Customer Id</th>
					      <th style="width:30%">Customer Name</th>
					      <th>Customer Address</th>
					      <th>Customer Mobile No.</th>
					      <th>Customer GST No.</th>
					       <th>Customer Fssid</th>
					       <!-- <th>Customer Category</th> -->
					    </tr>
					  </thead>
					  <tbody>
					  <?php
					  include("connect.php");
					  $sn=0;
							$qry="SELECT * FROM `customer`";
							$confirm=mysqli_query($conn,$qry)or die(mysqli_error());
							while($out=mysqli_fetch_array($confirm))
							{ $sn=$sn+1;
						?>
					    <tr id="tr">
					      <td style="margin-left: 10px; width:5%;"><?php echo $sn;?></td>
					      <td  style="width:6%"><?php echo $out['customer_id'];?></td>
					      <td  style="width:30%"><?php echo $out['customer_name'];?></td>
					      <td><?php echo $out['customer_address'];?></td>
					      <td><?php echo $out['customer_mob'];?></td>
					      <td><?php echo $out['customer_gst'];?></td>
					      <td><?php echo $out['customer_fssid'];?></td>
					     <!--  <td><?php echo $out['customer_category'];?></td> -->
					    </tr>
							<?php	} ?>

					  </tbody>
					  </table>
<script type="text/javascript">
	$(document).ready(function(){
	$("#table tbody").on('dblclick', 'tr', function () {
		var currow=$(this).closest('tr');
		var customer_id=currow.find('td:eq(1)').html();
		var customer_name=currow.find('td:eq(2)').html();
		var customer_address=currow.find('td:eq(3)').html();
		var customer_mob=currow.find('td:eq(4)').html();
		var customer_gst=currow.find('td:eq(5)').html();
		var customer_fssid=currow.find('td:eq(6)').html();
		var customer_category=currow.find('td:eq(7)').html();
		$('#customer_id').val(customer_id);
   		$('#customer_name').val(customer_name);
		$('#customer_address').val(customer_address);
		$('#customer_mob').val(customer_mob);
		$('#customer_gst').val(customer_gst);
		$('#customer_fssid').val(customer_fssid);
		$('#customer_category').val(customer_category);
	});
});
</script>