	<table class="fixed_header1 table table-bordered" id="table">
					  <thead>
					    <tr>
					        <th style="width:5%">Sn</th>
					        <th style="width:5%">Item Id</th>
					      <th style="width:30%">Item Name</th>
							<th>Packing</th>
					      	<th>Item HSN</th>
					      	<th>Item GST</th>
							<th>Item MRP</th>
					      	 <th>Rate / Pcs</th>
					      	 <!-- <th>Rate / KG</th> -->
					    </tr>
					  </thead>
					  <tbody>
					  <?php
					  include("connect.php");
					  $sn=0;
							$qry="SELECT * FROM `item`";
							$confirm=mysqli_query($conn,$qry)or die(mysqli_error());
							while($out=mysqli_fetch_array($confirm))
							{ $sn=$sn+1;
						?>
					      <td style="margin-left: 10px; width:5%;"><?php echo $sn;?></td>
					      <td style="width:5%"><?php echo $out['item_id'];?></td>
					      <td style="width:30%; text-align: left"><?php echo $out['item_name'];?></td>
						<td><?php echo $out['item_pc'];?></td>
					      <td><?php echo $out['item_hsn'];?></td>
					      <td><?php echo $out['item_gst'];?></td>
					      <td><?php echo $out['mrp'];?></td>
					       <td><?php echo $out['sale'];?></td>
					    </tr>
				<?php	} ?>
					  </tbody>
					</table>	


					<script type="text/javascript">
						$(document).ready(function(){
							$("#table tbody").on('dblclick', 'tr', function () {
								var currow=$(this).closest('tr');
								var item_id=currow.find('td:eq(1)').html();
								var item_name=currow.find('td:eq(2)').html();
								var item_pc=currow.find('td:eq(3)').html();
								var item_hsn=currow.find('td:eq(4)').html();								
								var item_gst=currow.find('td:eq(5)').html();
								var basic_value=currow.find('td:eq(6)').html();
								var wholesale_value=currow.find('td:eq(7)').html();
								$('#item_id').val(item_id);
						   		$('#item_name').val(item_name);
								$('#item_hsn').val(item_hsn);
								$('#item_pc').val(item_pc);
								$('#item_gst').val(item_gst);
								$('#item_mrp').val(basic_value);
								$('#basic_value').val(wholesale_value);
							});
						});
					</script>