<?php include("header.php"); ?>
<script>
$(document).ready(function() {
    $("#inputZip4").keyup(function() {
        var x = $(this).val();
        if (x != '') {
            $.ajax({
                url: "search.php",
                method: "POST",
                data: {
                    query: x
                },
                success: function(data) {
                    $('#list').fadeIn();
                    $('#list').html(data);
                }
            });
        } else {
            $('#list').html("");
        }
        $(document).on('click', '#li2', function() {
            $('#inputZip4').val($(this).text());
            $('#list').fadeOut();
        });
    });
});
</script>
<script type="text/javascript">
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
        $(document).on('click', '#lii', function() {
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
                    $("#item_pkc").val(data[4]);
                    $("#item_mrp").val(data[5]);
                    $("#sale_rate").val(data[6]);
                }
            });
        });
    });
});
</script>

</head>

<body>


    <!----invoise form------>
    <div class="col-md-12 bg-success ">
    <h3 class="text-center" style="color:black; margin-top:3px;margin-bottom:-2px;">STOCK ENTRY</h3>
        <div class="row">
            <div class="col-md-5 ip">
                <div class="row">
                    <div class="col-md-3">
                        <label>Supplier Name:-</label>
                    </div>
                    <div class="col-md-6 cust_search">
                        <input type="text" name="" autocomplete="none" class="col-md-1 form-control input-sm " id="inputZip4">
                        <input type="text" name="" class="col-md-1 form-control input-sm " id="cust_id"
                            style="display: none;" readonly="">
                        <lable id="list"></lable>
                    </div>
                    <div class="col-md-3">
                        <button class="btn input-sm btn-search" id="search">Search</button>
                    </div>
                </div>
            </div>
            <div class="col-md-7" style="margin-top: 10px;">
                <div class="right">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Supplier Name:-</label>
                            <label id="name"></label>
                        </div>
                        <div class="col-md-6">
                            <label> Gst No:-</label>
                            <label id="gst"></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Supplier Mobile:-</label>
                            <label id="mob"></label>
                        </div>
                        <div class="col-md-6">
                            <label>State:-</label>
                            <label id="gst">Karnataka</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Supplier Address:-</label>
                            <label id="adress"></label>
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
                            <input type="text" name="" class="col-md-1 form-control input-sm " id="item_id">
                        </div>
                        <div class="col-md-3 cust_info" style="margin-left: -40px;">
                            <label for="input">Item Name</label>
                            <input type="text" name="" class="col-md-1 form-control input-sm " id="item_name"
                                autocomplete="off">
                            <lable id="list1"></lable>
                        </div>
                        <div class="offset-md-3 col-md-1 cust_info">
                            <label for="input">Packing</label>
                            <input type="text" name="" class="col-md-1 form-control input-sm " id="item_pkc" readonly>
                        </div>
                        <div class="offset-md-3 col-md-1 cust_info">
                            <label for="input">Item HSN</label>
                            <input type="text" name="" class="col-md-1 form-control input-sm " id="item_hsn" readonly>
                        </div>
                        <div class="offset-md-3 col-md-1 cust_info" style="display: none;">
                            <label for="input">Item GST</label>
                            <input type="text" name="" class="col-md-1 form-control input-sm " id="item_gst" readonly>
                            <!-- <select class="col-md-1 form-control input-sm" id="item_gst">
                <option>0</option>
                <option>5</option>
                <option>12</option>
                <option>18</option>
              </select> -->
                        </div>
                        <div class="offset-md-3 col-md-1 cust_info">
                            <label for="input">MRP</label>
                            <input type="text" name="" class="col-md-1 form-control input-sm" id="item_mrp" readonly>
                        </div>
                        <div class="offset-md-3 col-md-1 cust_info">
                            <label for="input">Quantity</label>
                            <input type="text" name="" class="col-md-1 form-control input-sm" id="item_quant">
                        </div>

                        <div class="offset-md-2 col-md-1 cust_info">
                            <label for="input">Pur Rate</label>
                            <input type="text" name="" class="col-md-1 form-control input-sm" id="item_rate"
                                autocomplete="off">
                        </div>
                        <div class="offset-md-2 col-md-1 cust_info">
                            <label for="input">Sale Rate</label>
                            <input type="text" name="" class="col-md-1 form-control input-sm" id="sale_rate"
                                autocomplete="off">
                        </div>
                        <div class="offset-md-2 col-md-1 cust_info">
                            <label for="input">value</label>
                            <input type="text" name="" class="col-md-1 form-control input-sm" id="item_value" readonly>
                        </div>
                        <div class="col-md-1 " style="margin-top: 20px;">
                            <label for="input"></label>
                            <input type="submit" value="Add" class="col-md-12 input-sm btn btn-warning" id="iadd">
                        </div>
                        <div class="col-md-1 " style="margin-top: 20px; margin-left: -20px;">
                            <label for="input"></label>
                            <input type="submit" value="Delete" class="col-md-12 input-sm btn btn-danger" id="delete">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!----invoise form------>
        <!-----table------->
        <div class="col-md-12 tbl1 theam" style="margin-top: -10px;" id="tb">
        </div>
        <!------table------>
        <script type="text/javascript">
        $(document).ready(function() {
            window.sessionStorage
            $('#tb').load("purchse_item_fetch.php");
            var vendor = sessionStorage.getItem("vendor");
            if(vendor!="")
            {
                var y = $.ajax({
                    type: "post",
                    url: "customer_search.php",
                    dataType: 'json',
                    data: {
                        action: vendor
                    },
                    success: function(data) {
                        $("#cust_id").val(data[0]);
                        $("#name").html(data[1]);
                        $("#adress").html(data[2]);
                        $("#mob").html(data[3]);
                        $("#gst").html(data[4]);
                        $("#fsn").html(data[5]);
                        $("#mail").html(data[6]);
                    }
                });
            }
            // fetch vendor
            $('#search').click(function() {
                var x = $('#inputZip4').val();
                sessionStorage.setItem("vendor", x);
                $("#inputZip4").val("");
                var y = $.ajax({
                    type: "post",
                    url: "customer_search.php",
                    dataType: 'json',
                    data: {
                        action: x
                    },
                    success: function(data) {
                        $("#cust_id").val(data[0]);
                        $("#name").html(data[1]);
                        $("#adress").html(data[2]);
                        $("#mob").html(data[3]);
                        $("#gst").html(data[4]);
                        $("#fsn").html(data[5]);
                        $("#mail").html(data[6]);
                        $('#inputZip4').attr('readonly', true);
                    }
                });
                console.log();
            });
        });
        </script>

        <script type="text/javascript">
        $('#delete').click(function() {
            var item_id = $('#item_id').val();
            var custid = $('#cust_id').val();
            $.ajax({
                type: "post",
                url: "purchase_coding.php",
                data: {
                    action: "purchase_item_delete",
                    custid: custid,
                    item_id: item_id
                },
                success: function(status) {
                    alert(status);
                    $('#item_name').val("");
                    $('#item_hsn').val("");
                    $('#item_gst').val("");
                    $('#item_pkc').val("");
                    $('#item_mrp').val("");
                    $('#item_quant').val("");
                    $('#item_rate').val("");
                    $('#sale_rate').val("");
                    $('#item_value').val("");
                    $('#item_id').val("");
                    $('#tb').load("purchse_item_fetch.php");
                }
            })
        });
        </script>
        <script type="text/javascript">
        $(document).ready(function() {
            $('#item_rate').keyup(function() {
                var x = $(this).val();
                var item_rate = $('#item_quant').val();
                var rate = x * item_rate;
                $('#item_value').val(rate);
            });
        });

        $(document).ready(function() {
            $('#item_quant').keyup(function() {
                var x = $(this).val();
                var item_rate = $('#item_rate').val();
                var rate = x * item_rate;
                $('#item_value').val(rate);
            });
        });
        </script>


        <script type="text/javascript">
        $('#iadd').click(function() {
            var item_id = $('#item_id').val();
            var item_name = $('#item_name').val();
            var item_hsn = $('#item_hsn').val();
            var item_gst = $('#item_gst').val();
            var item_pkc = $("#item_pkc").val();
            var item_mrp = $('#item_mrp').val();
            var item_quant = $('#item_quant').val();
            var item_rate = $('#item_rate').val();
            var sale_rate = $('#sale_rate').val();
            var item_value = $('#item_value').val();
            var custid = $('#cust_id').val();
            $('#item_name').val("");
            $('#item_hsn').val("");
            $('#item_gst').val("");
            $("#item_pkc").val("");
            $('#item_mrp').val("");
            $('#item_quant').val("");
            $('#item_value').val("");
            $('#item_rate').val("");
            $('#sale_rate').val("");
            $('#item_id').val("");
            if (item_id == "" || item_name == "" || item_hsn == "" || item_gst == "" || item_quant == "" ||
                item_value == "" || sale_rate == "" || custid == "" || item_rate == "") {
                alert("All Field Necessary");
            } else {
                $.ajax({
                    type: "post",
                    url: "purchase_coding.php",
                    data: {
                        action: "purchase_item", 
                        custid: custid,
                        item_name: item_name,
                        item_hsn: item_hsn,
                        item_quant: item_quant,
                        item_mrp: item_mrp,
                        item_pkc: item_pkc,
                        item_gst: item_gst,
                        sale_rate: sale_rate,
                        item_rate: item_rate,
                        item_value: item_value,
                        item_id: item_id
                    },
                    success: function(status) {
                        // alert(status);
                        $('#tb').load("purchse_item_fetch.php");
                    }

                });
            }

        });
        </script>

</body>

</html>