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
                    $("#item_rate").val(data[7]);

                    let log = $.ajax({
                        type: "post",
                        url: "purchase_coding.php",
                        dataType: 'json',
                        data: {
                            action: "purchase_rate",
                            item_id: data[0]
                        },
                        success: function(data) {
                            $("#item_rate").val(data);
                        }
                    });
                    console.log(log);
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
        <h2 class="text-center" style="color:black;">PURCHASE RETURN</h2>
        <div class="row">
            <div class="col-md-6 ip">
                <div class="row">
                    <div class="col-md-3">
                        <label>Supplier Name:-</label>
                    </div>
                    <div class="col-md-6 cust_search">
                        <input type="text" name="" autocomplete="off" class="col-md-1 form-control input-sm " id="inputZip4">
                        <input type="text" name="" class="col-md-1 form-control input-sm " id="cust_id"
                            style="display: none;" readonly="">
                        <lable id="list"></lable>
                    </div>
                    <div class="col-md-3">
                        <button class="btn input-sm btn-search" id="search">Search</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="margin-top: 10px;">
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
                        <div class="offset-md-3 col-md-3 cust_info">
                            <label for="input">Item Name</label>
                            <input type="text" name="" class="col-md-1 form-control input-sm " id="item_name"
                                autocomplete="off">
                            <lable id="list1"></lable>
                        </div>
                        <div class="offset-md-3 col-md-1 cust_info">
                            <label for="input">Packing</label>
                            <input type="text" name="" class="col-md-1 form-control input-sm " readonly id="item_pkc">
                        </div>
                        <div class="offset-md-3 col-md-1 cust_info">
                            <label for="input">Item HSN</label>
                            <input type="text" name="" class="col-md-1 form-control input-sm " readonly id="item_hsn">
                        </div>
                        <div class="offset-md-3 col-md-1 cust_info">
                            <label for="input">MRP</label>
                            <input type="text" name="" class="col-md-1 form-control input-sm" id="item_mrp" readonly>
                        </div>
                        <div class="offset-md-3 col-md-1 cust_info" style="display: none;">
                            <label for="input">Item GST</label>
                            <input type="text" name="" class="col-md-1 form-control input-sm " id="item_gst" readonly>
                        </div>
                        <div class="offset-md-3 col-md-1 cust_info">
                            <label for="input">Quantity</label>
                            <input type="text" name="" class="col-md-1 form-control input-sm" id="item_quant">
                        </div>
                        <div class="offset-md-2 col-md-1 cust_info">
                            <label for="input">Rate</label>
                            <input type="text" name="" class="col-md-1 form-control input-sm" id="item_rate"
                                autocomplete="off">
                        </div>
                        <div class="offset-md-2 col-md-1 cust_info">
                            <label for="input">value</label>
                            <input type="text" name="" class="col-md-1 form-control input-sm" readonly id="item_value">
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
        <div class="col-md-12 theam " style="margin-top: -10px;">
            <div class="tbl1" id="tb">
            </div>
        </div>
        <!------table------>
        <!--------bottons------>
        <!-- <div class="col-md-12 bg-info ">
<div class="row ip1">
  <div class="col-md-12">
    <div class="row">
      <div class="offset-md-3 col-md-2 cust_info" style="margin-left: 50px;">
        <label for="input">Gross Total</label>
        <input type="text" name="" class="col-md-1 form-control input-sm " id="total1">
      </div>
      <div class="offset-md-3 col-md-2 cust_info">
        <label for="input">CGST</label>
        <input type="text" name="" class="col-md-1 form-control input-sm ">
      </div>
      <div class="offset-md-3 col-md-2 cust_info">
        <label for="input">SGST</label>
        <input type="text" name="" class="col-md-1 form-control input-sm ">
      </div>
      <div class="offset-md-3 col-md-2 cust_info">
        <label for="input">Total amount</label>
        <input type="text" name="" class="col-md-1 form-control input-sm ">
      </div>
      <div class="offset-md-2 col-md-2" style="margin-top: 20px; margin-left: 0px;">
        <label for="input"></label>
        <input type="button" name="print" value="Print" class="col-md-6 input-sm " id="print">
      </div>
      
      <div class="offset-md-2 col-md-2 " style="margin-top: 20px; margin-left: -90px;">
        <label for="input"></label>
        <input type="submit" value="Delete" class="col-md-6 input-sm ">
      </div>
    </div>
  </div>
  </div>
</div> -->
        <!--------bottons------>

        <script type="text/javascript">
        $(document).ready(function() {
            $('#tb').load("purchase_return_fetch.php");
            $('#item_hsn').keyup(function() {
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
                        $("#item_rate").val(data[3]);
                    }
                })
            });
        });
        </script>

        <script type="text/javascript">
        $(document).ready(function() {
            $('#search').click(function() {
                var x = $('#inputZip4').val();
                $("#inputZip4").val(" ");
                $.ajax({
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
                })
            });
        });
        </script>
        <script type="text/javascript">
        $('#delete').click(function() {
            var item_id = $('#item_id').val();
            var custid = $('#cust_id').val();
            $.ajax({
                type: "post",
                url: "purchase_return_coding.php",
                data: {
                    action: "purchase_return_item_delete",
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
                    $('#tb').load("purchase_return_fetch.php");
                }

            })

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
            var item_value = $('#item_value').val();
            var custid = $('#cust_id').val();
            if (item_id == "" || item_name == "" || item_hsn == "" || item_gst == "" || item_pkc == "" ||
                item_quant == "" || item_mrp == ""|| item_rate == "" || item_value == "" || custid == "") {
                alert("All Field Necessary");
            } else {
                $.ajax({
                    type: "post",
                    url: "purchase_return_coding.php",
                    data: {
                        action: "purchase_return_item",
                        custid: custid,
                        item_name: item_name,
                        item_hsn: item_hsn,
                        item_quant: item_quant,
                        item_mrp : item_mrp,
                        item_pkc: item_pkc,
                        item_gst: item_gst,
                        item_rate: item_rate,
                        item_value: item_value,
                        item_id: item_id
                    },
                    success: function(status) {
                        $('#item_name').val("");
                        $('#item_hsn').val("");
                        $('#item_gst').val("");
                        $('#item_pc').val("");
                        $('#item_quant').val("");
                        $('#item_rate').val("");
                        $('#item_value').val("");
                        $('#item_id').val("");
                        // alert(status);
                        $('#tb').load("purchase_return_fetch.php");
                    }
                });
            }

        });

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


</body>

</html>