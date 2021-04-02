<table class="fixed_header1 table  table-bordered" id="table">
					  <thead>
					    <tr>
					      <th style="width:5%;">Sn</th>
					      <th id="id" style="width:5%;">Supplier Id</th>
					      <th style="width:30%;">Supplier Name</th>
					      <th>Supplier Adress</th>
					      <th>Supplier Mobile No.</th>
					      <th>Supplier GST No.</th>
					      <!--  <th>Supplier Fssid</th> -->
					       <th>Supplier Mail id</th>
					    </tr>
					  </thead>
					  <tbody>
						<?php
					  include("connect.php");
					  $sn=0;
							$qry="SELECT * FROM `vendor`";
							$confirm=mysqli_query($conn,$qry)or die(mysqli_error());
							while($out=mysqli_fetch_array($confirm))
							{ $sn=$sn+1;
						?>
					    <tr id="tr">
					      <td style="margin-left: 10px; width:5%;"><?php echo $sn;?></td>
					      <td style="width:6%;"><?php echo $out['vender_id'];?></td>
					      <td style="width:30%;"><?php echo $out['vender_name'];?></td>
					      <td><?php echo $out['vender_address'];?></td>
					      <td><?php echo $out['vender_mob'];?></td>
					      <td><?php echo $out['vender_gst'];?></td>
					     <!--  <td><?php echo $out['vender_fssid'];?></td> -->
					      <td><?php echo $out['mail_id'];?></td>
					    </tr>
							<?php	} ?>
					  
					  </tbody>
					</table>

<script type="text/javascript">
	$(document).ready(function(){
	$("#table tbody").on('dblclick', 'tr', function () {
		var currow=$(this).closest('tr');
		var vender_id=currow.find('td:eq(1)').html();
		var vender_name=currow.find('td:eq(2)').html();
		var vender_address=currow.find('td:eq(3)').html();
		var vender_mob=currow.find('td:eq(4)').html();
		var vender_gst=currow.find('td:eq(5)').html();
		//var vender_fssid=currow.find('td:eq(6)').html();
		var mail_id=currow.find('td:eq(6)').html();
		$('#vender_id').val(vender_id);
   		$('#vender_name').val(vender_name);
		$('#vender_addres').val(vender_address);
		$('#vender_mob').val(vender_mob);
		$('#vender_gst').val(vender_gst);
		$('#vender_fssid').val(vender_fssid);
		$('#mail_id').val(mail_id);
	});
});
</script>