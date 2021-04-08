<?php include("header.php"); 

$invoice_num=$_GET['edit'];
$qry="SELECT DISTINCT `customer`.`customer_name` AS `customer`,`customer`.`customer_mob` AS `mob`,`customer`.`customer_address` AS `address`,`customer`.`customer_gst` AS `gst_no`,`invoice`.`invoice_date` AS `date` FROM `customer`,`invoice`,`invoice_no` WHERE `customer`.`customer_id`=`invoice`.`customer_id` AND `invoice`.`in_id`=`invoice_no`.`in_id` AND `invoice_no`.`number`='$invoice_num' LIMIT 1;";
  $confirm=mysqli_query($conn,$qry)or die(mysqli_error());
  $out=mysqli_fetch_array($confirm);
?>
<script>
$(document).ready(function() {
    $("#item_name").keyup(function() {
        var x = $(this).val();
        if (x != '') {
            $.ajax({
                url: "search_items.php",
                method: "POST",
                data: {
                    query: x
                },
                success: function(data) {
                    $('#list1').fadeIn();
                    $('#list1').html(data);
                }
            });
        } else {
            $('#list1').html("");
        }
        $(document).on('click', 'li', function() {
            $('#item_name').val($(this).text());
            $('#list1').fadeOut();
            var x = $('#item_name').val();
            $.ajax({
                type: "post",
                url: "items.php",
                dataType: 'json',
                data: {
                    action: x
                },
                success: function(data) {
                    $("#item_id").val(data[0]);
                    $("#item_name").val(data[1]);
                    $("#item_hsn").val(data[2]);
                    $("#item_gst").val(data[3]);
                    $("#item_unit").val(data[4]);
                    $('#item_mrp').val(data[5])
                    $('#item_rate').val(data[6])
                }
            });
        });
    });
});
</script>

<body class="theam">
    <!----invoise form------>
    <div class="col-md-12 bg-success">
    <h3 class="text-center" style="color:black; margin-top:3px;margin-bottom:-2px;">UPDATE BILL</h3>

        <div class="row">
            <div class="col-md-10 ">
                <div class="row cust_add">
                    <div class="col-md-1">
                        <div class="offset-md-3 col-md-1 cust_info" style="display: none;">
                            <label for="input">Customer id</label>
                            <input type="text" name="" class="col-md-1 form-control input-sm" id="customer_id"
                                readonly="">
                        </div>
                        <label>Bill No:-</label>
                        <input type="text" name="" value="<?php echo $invoice_num;?>"
                            class="col-md-1 form-control input-sm" id="bill_no" readonly=""
                            style="background-color:white; font-size:14pt; ">
                    </div>
                    <div class="col-md-3">
                        <label>Customer Name:-</label>
                        <input type="text" name="" value="<?php echo $out['customer'];?>"
                            class="col-md-1 form-control input-sm " id="customer_name" readonly=""
                            style="background-color:white; font-size:14pt;">
                    </div>
                    <div class="col-md-6">
                        <label>Customer Address:-</label>
                        <input type="text" name="" value="<?php echo $out['address'];?>"
                            class="col-md-1 form-control input-sm " id="customer_address" readonly=""
                            style="background-color:white; font-size:14pt;">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label>Date:-</label>
                        <input type="text" name="" value="<?php echo date("d-m-Y",strtotime($out['date']));?>"
                            class="col-md-1 form-control input-sm " id="customer_email" readonly=""
                            style="background-color:white; font-size:14pt;">
                    </div>
                    <div class="col-md-3">
                        <label>Customer Mobile No:-</label>
                        <input type="text" name="" value="<?php echo $out['mob'];?>"
                            class="col-md-1 form-control input-sm " id="customer_mob" readonly=""
                            style="background-color:white; font-size:14pt;">
                    </div>
                    <div class="col-md-4">
                        <label>Customer GST NO:-</label>
                        <input type="text" name="" value="<?php echo $out['gst_no'];?>"
                            class="col-md-1 form-control input-sm " id="customer_email" readonly=""
                            style="background-color:white; font-size:14pt;">
                    </div>
                    <div class="col-md-2">
                        <input type="submit" value="Bill Cancel" class="col-md-12 input-sm btn btn-info" id="bilcancel">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="container-fluid bg-info ">
        <div class="row ip1">
            <div class="col-md-12">
                <div class="row">
                    <div class="offset-md-3 col-md-1 cust_info" style="display: none;">
                        <label for="input">Item id</label>
                        <input type="text" name="" class="col-md-1 form-control input-sm " id="item_id" readonly="">
                    </div>
                    <div class="offset-md-3 col-md-3 cust_info">
                        <label for="input">Item Name</label>
                        <input type="text" name="" autocomplete="off" class="col-md-1 form-control input-sm "
                            id="item_name">
                        <lable id="list1"></lable>
                    </div>
                    <div class="offset-md-3 col-md-1 cust_info">
                        <label for="input">Item HSN</label>
                        <input type="text" name="" class="col-md-1 form-control input-sm " id="item_hsn" readonly="">
                    </div>
                    <div class="offset-md-3 col-md-1 cust_info">
                        <label for="input">Item MRP</label>
                        <input type="text" name="" class="col-md-1 form-control input-sm" id="item_mrp">
                    </div>
                    <div class="offset-md-3 col-md-1 cust_info" style="display: none;">
                        <label for="input">Item GST</label>
                        <select class="col-md-1 form-control input-sm" id="item_gst">
                            <option>0</option>
                            <option>5</option>
                            <option>12</option>
                            <option>18</option>
                        </select>
                    </div>
                    <div class="offset-md-3 col-md-1 cust_info">
                        <label for="input">Quantity</label>
                        <input type="text" name="" class="col-md-1 form-control input-sm" id="item_quant" required="">
                    </div>
                    <div class="offset-md-3 col-md-1 cust_info">
                        <label for="input">Free</label>
                        <input type="text" name="" class="col-md-1 form-control input-sm" id="free" required="">
                    </div>
                    <div class="offset-md-3 col-md-1 cust_info" style="display: none;">
                        <label for="input">Item Unit</label>
                        <select class="col-md-1 form-control input-sm" id="item_unit">
                            <option>--</option>
                            <option>gm</option>
                            <option>kg</option>
                            <option>qtl</option>
                            <option>ltr</option>
                            <option>ml</option>
                            <option>pkt</option>
                            <option>btl</option>
                            <option>Box</option>
                        </select>
                    </div>
                    <div class="offset-md-2 col-md-1 cust_info">
                        <label for="input">Rate</label>
                        <input type="text" name="" class="col-md-1 form-control input-sm" id="item_rate">
                    </div>
                    <div class="offset-md-2 col-md-1 cust_info">
                        <label for="input">value</label>
                        <input type="text" name="" class="col-md-1 form-control input-sm" id="item_value" readonly="">
                    </div>
                    <div class="col-md-1">
                        <div class=" " style="margin-top: 20px;">
                            <label for="input"></label>
                            <input type="submit" value="Add" class="col-md-12 input-sm btn btn-warning" id="iadd">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="" style="margin-top: 20px;">
                            <input type="submit" value="Delete" class="col-md-12 input-sm btn btn-danger" id="delete">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!----invoise form------>
    <!-----table------->
    <div class="col-md-12  theam" style="margin-top: -10px;">
        <div class="tbl1" id="tb">
        </div>
    </div>
    <!------table------>
    <!----invoise form------>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#tb').load("update_item.php");
        $('#item_hsn').keyup(function() {

        });
    });

    $('#bilcancel').click(function() {
        let billno = $('#bill_no').val();
        $.ajax({
            type: "post",
            url: "updatecode.php",
            data: {
                action: "BillCancel",
                billno: billno
            },
            success: function(status) {
                window.location = "localsale.php";
            }
        })
    });

    $('#delete').click(function() {
        var item_id = $('#item_id').val();
        $('#item_name').val("");
        $('#item_hsn').val("");
        $('#item_gst').val("");
        $('#item_quant').val("");
        $('#item_value').val("");
        $('#item_id').val("");
        $.ajax({
            type: "post",
            url: "updatecode.php",
            data: {
                action: "item_delete",
                item_id: item_id
            },
            success: function(status) {
                alert(status);
                $('#tb').load("update_item.php");
            }

        })

    });

    $('#iadd').click(function() {
        var item_id = $('#item_id').val();
        var item_name = $('#item_name').val();
        var item_hsn = $('#item_hsn').val();
        var item_gst = $('#item_gst').val();
        var item_unit = $('#item_unit').val();
        var item_quant = $('#item_quant').val();
        var item_free = $('#free').val();
        var item_value = $('#item_value').val();
        var item_mrp = $('#item_mrp').val();
        var item_rate = $('#item_rate').val();
        $('#item_name').val("");
        $('#item_hsn').val("");
        $('#item_gst').val("");
        $('#item_unit').val("");
        $('#item_quant').val("");
        $('#free').val("");
        $('#item_rate').val("");
        $('#item_value').val("");
        $('#item_id').val("");
        if ((item_id == "") || (item_name == "") || (item_hsn == "") || (item_gst == "") || (item_unit ==
                "") || (item_mrp == "") || (item_quant == "") || (item_free == "") || (item_value == "") ||
            (item_rate == "")) {
            alert("All Field Necessary");
        } else {

            $.ajax({
                type: "post",
                url: "updatecode.php",
                data: {
                    action: "updateitem",
                    item_name: item_name,
                    item_hsn: item_hsn,
                    item_quant: item_quant,
                    item_free: item_free,
                    item_unit: item_unit,
                    item_gst: item_gst,
                    item_rate: item_rate,
                    item_mrp: item_mrp,
                    item_value: item_value,
                    item_id: item_id
                },
                success: function(status) {
                    //alert(status);
                    $('#tb').load("update_item.php");
                }
            });
        }
    });

    $('#item_quant').keyup(function() {
        var x = $('#item_name').val();
        var item_unit = $('#item_unit').val();
        var item_qty = $(this).val();
        $.ajax({
            type: "post",
            url: "items.php",
            dataType: 'json',
            data: {
                action: x
            },
            success: function(data) {

                var value = data[6];
                if ((item_unit == "kg") || (item_unit == "pkt") || (item_unit ==
                        "btl") || (item_unit == "Box")) {
                    val = value / 1;
                }
                if (item_unit == "gm") {
                    val = value / 1000;
                }
                if (item_unit == "qtl") {
                    val = value * 100;
                    $('#item_rate').val(value);
                }
                if (item_unit == "Dozen") {
                    val = value * 12;
                }
                if (item_unit == "Half Dozen") {
                    val = value * 6;
                }

                var final = item_qty * val;
                $("#item_value").val(final);
            }
        });
    });
    $(document).ready(function() {
        $('#item_rate').keyup(function() {

            var rate = $(this).val();
            var qty = $('#item_quant').val();
            var final = qty * rate;
            $("#item_value").val(final);
        });

    });
    </script>