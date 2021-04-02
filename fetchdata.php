<table class="fixed_header table table-bordered" id="table">
    <thead>
        <tr>
            <th style="width:5%;">Sn</th>

            <!-- <th id="id">Item Id</th>-->
            <th style="width:30%; ">Item Name</th>
            <th style="width:11%;">Item HSN</th>
            <th>Item Gst</th>
            <th>Quantity</th>
            <th>Item Unit</th>
            <th>Item MRP</th>
            <th>Item Rate</th>
            <th>Item Value</th>
            <!-- 		       <th>Amount</th> -->
        </tr>
    </thead>
    <tbody>
        <script type="text/javascript"></script>
        <?php
					  include("connect.php");
					  $sn=0; $total=0;
					  $gstfive=$gsttwelve=$gsteghteen=$t=$without_gst=0;
							$qry="SELECT * FROM `tmpitem`;";
							$confirm=mysqli_query($conn,$qry)or die(mysqli_error());
							while($out=mysqli_fetch_array($confirm))
							{ $sn=$sn+1; 
								 $t=$out['item_value'];
							 $total=$total+$t;
							  if($out['item_gst']=="0")
							 {
							 	$without_gst=$out['item_value'];
							 }
							 if($out['item_gst']=="5")
							 {
							 	$ttl1=$out['item_value'];
							 	$gstfive=$gstfive+$ttl1;
							 }
							  if($out['item_gst']=="12")
							 {
							 	$ttl2=$out['item_value'];
							 	$gsttwelve=$gsttwelve+$ttl2;
							 }
							  if($out['item_gst']=="18")
							 {
							 	$ttl3=$out['item_value'];
							 	$gsteghteen=$gsteghteen+$ttl3;
							 }
						?>
        <tr>
            <td style="display: none;"><?php echo $out['item_id'];?></td>
            <td style="width:5%" ;><?php echo $sn;?></td>
            <td style="width:30%; text-align: left;" ;><?php echo $out['item_name'];?></td>
            <td><?php echo $out['item_hsn'];?></td>
            <td><?php echo $out['item_gst'];?></td>
            <td><?php echo $out['item_quant'];?></td>
            <td><?php echo $out['item_unit'];?></td>
            <td><?php echo $out['item_mrp'];?></td>
            <td><?php echo round($out['item_rate'],2);?></td>
            <td><?php echo round($out['item_value'],2);?></td>
            <!--  <td><?php echo $t;?></td> -->
        </tr>

        <?php	}
					  ?>
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
						$total_gst=$gst_five+$gst_six+$gst_eight+$total;
						
						
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
                <td><?php echo $gstfive; ?></td>
                <td>2.50</td>
                <td><?php echo $cgst_five; ?></td>
                <td>2.50</td>
                <td><?php echo $cgst_five; ?></td>
                <th><?php echo $gst_five; ?></th>
            </tr>
            <tr>
                <th>12 % GST</th>
                <td><?php echo $gsttwelve; ?></td>
                <td>6.00</td>
                <td><?php echo $cgst_six; ?></td>
                <td>6.00</td>
                <td><?php echo $sgst_six; ?></td>
                <th><?php echo $gst_six; ?></th>
            </tr>
            <tr>
                <th>18 % GST</th>
                <td><?php echo $gsteghteen; ?></td>
                <td>9.00</td>
                <td><?php echo $cgst_eight; ?></td>
                <td>9.00</td>
                <td><?php echo $sgst_eight; ?></td>
                <th><?php echo $gst_eight; ?></th>
            </tr>
            <tr>
                <th>Total</th>
                <th><?php echo $total; ?></th>
                <td></td>
                <th><?php echo $total_half; ?></th>
                <td></td>
                <th><?php echo $total_half; ?></th>
                <th><?php echo round($total_gst); ?></th>
            </tr>
        </table>
    </div>
    <div class="col-md-2" style="margin-top: 20px; margin-left: 0px;">
        <label for="input"></label>
        <input type="button" name="Save" value="Print" class="col-md-6 input-sm bg-success" id="print">
    </div>
    <div class="col-md-2" style="margin-top: 20px; margin-left: 0px;">
        <label for="input"></label>
        <input type="button" name="Cancel" value="Cancel" class="col-md-6 input-sm bg-success" id="cancel">
    </div>
    <input type="text" name="" value="<?php echo $total_gst; ?>" id="gtotal" style="display: none;">
    <input type="text" name="" value="<?php echo $gst_five; ?>" id="gst_5" style="display: none;">
    <input type="text" name="" value="<?php echo $gst_six; ?>" id="gst_12" style="display: none;">
    <input type="text" name="" value="<?php echo $gst_eight; ?>" id="gst_18" style="display: none;">
    <input type="text" name="" value="<?php echo $total_gst; ?>" id="gst_total" style="display: none;">
</div>


<script type="text/javascript">
$('#print').click(function() {
    var gross_total = $('#gtotal').val();
    var gst_5 = $('#gst_5').val();
    var gst_12 = $('#gst_12').val();
    var gst_18 = $('#gst_18').val();
    var gst_total = $('#gst_total').val();
    var discount = prompt("Enter Discount Amount");
    $.ajax({
        type: "post",
        url: "itemcustomer.php",
        data: {
            action: "print",
            gross_total: gross_total,
            gst_5: gst_5,
            gst_12: gst_12,
            gst_18: gst_18,
            gst_total: gst_total,
            discount: discount
        },
        success: function(status) {
            alert(status);
            location = "tax2.php?bill_no=" + status;

        }
    });
});
</script>

<script type="text/javascript">
$('#cancel').click(function() {
    $.ajax({
        type: "post",
        url: "itemcustomer.php",
        data: {
            action: "cancel",
        },
        success: function(status) {
            $('#item_name').val(" ");
            $('#item_hsn').val(" ");
            $('#item_gst').val(" ");
            $('#item_unit').val(" ");
            $('#item_quant').val(" ");
            $('#item_value').val(" ");
            $('#item_id').val(" ");
            $('#customer_name').val(" ");
            $('#customer_address').val(" ");
            $('#customer_mob').val(" ");
            $('#customer_email').val(" ");
            $("#custid").val(" ");
            $("#name").html(" ");
            $("#adress").html(" ");
            $("#mob").html(" ");
            $("#gst").html(" ");
            $("#fsn").html(" ");
            $("#mail").html(" ");
            $('#fetchdata').load("fetchdata.php");

        }
    });
});
</script>


<script type="text/javascript">
$(document).ready(function() {
    $('#click').click(function() {
        alert('monesh');
    });
});

$(document).ready(function() {
    $("#table tbody").on('dblclick', 'tr', function() {
        var currow = $(this).closest('tr');
        var item_id = currow.find('td:eq(0)').html();
        var item_name = currow.find('td:eq(2)').html();
        var item_hsn = currow.find('td:eq(3)').html();
        var item_gst = currow.find('td:eq(4)').html();
        var item_unit = currow.find('td:eq(6)').html();
        var item_qty = currow.find('td:eq(5)').html();
        var item_mrp = currow.find('td:eq(7)').html();
        var item_rate = currow.find('td:eq(8)').html();
        var item_value = currow.find('td:eq(9)').html();
        // var x=(((item_value*item_gst)/100));
        // 	item_value=Math.round(parseInt(item_value)+x);
        // var y=(((item_rate*item_gst)/100));
        // 	item_rate=Math.round(parseInt(item_rate)+y);
        $('#item_id').val(item_id);
        $('#item_name').val(item_name);
        $('#item_hsn').val(item_hsn);
        $('#item_gst').val(item_gst);
        $('#item_unit').val(item_unit);
        $('#item_quant').val(item_qty);
        $('#item_mrp').val(item_mrp);
        $('#item_rate').val(item_rate);
        $('#item_value').val(item_value);
        //alert(item_id);
    });

    $('#click').on('shown.bs.modal', function() {
        $('#myInput').trigger('focus')
    })
});
</script>