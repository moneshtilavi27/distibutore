<?php
include("header.php");
?>
<!DOCTYPE html>
<html>

<head>

    <style type="text/css">
    .b1 {
        height: 38px;
        margin-top: 23px;
        width: 10em;
    }

    #b1 {
        background-color: lightgreen;
    }

    #b2 {
        background-color: lightcoral;
    }

    #b3 {
        background-color: lightblue;
    }

    #list {
        max-height: 70px;
        overflow-y: auto;
    }

    #list ul {
        background-color: #DEB0A6;
        padding: 3px;
        cursor: pointer;
        max-height: 150px;
        overflow-y: auto;
        list-style: none;
    }

    #list li {
        color: black;
        font: 12pt;
        padding: 8px;
    }

    #list li:hover {
        color: white;
        background-color: #b3b3ff;
    }

    #list1 {
        max-height: 70px;
        overflow-y: auto;
    }

    #list1 ul {
        background-color: #DEB0A6;
        padding: 3px;
        cursor: pointer;
        max-height: 150px;
        overflow-y: auto;
        list-style: none;

    }

    #list1 li {
        color: black;
        font: 12pt;
        padding: 8px;
    }

    #list1 li:hover {
        color: white;
        background-color: #b3b3ff;
    }
    </style>
    <script>
    $(document).ready(function() {
        $("#inputZip4").keyup(function() {
            var x = $(this).val();
            if (x != '') {
                $.ajax({
                    url: "holesale_customer_search.php",
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
            $(document).on('click', 'li', function() {
                $('#inputZip4').val($(this).text());
                $('#list').fadeOut();
            });
        });
    });

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

</head>

<body>
    <!----invoise form------>
    <div class="col-md-12 bg-success ">
        <h2 class="text-center" style="color:black;">INVOICE</h2>
        <div class="row">
            <div class="col-md-6 ip">
                <div class="row">
                    <div class="col-md-3">
                        <label>Client Name:-</label>
                    </div>
                    <div class="col-md-6 cust_search">
                        <input type="text" name="" class="col-md-1 form-control input-sm " autocomplete="off" id="inputZip4">
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
                            <label>Client Name:-</label>
                            <label id="name"></label>
                        </div>
                        <div class="col-md-6">
                            <label> Gst No:-</label>
                            <label id="gst"></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Client Mobile:-</label>
                            <label id="mob"></label>
                        </div>
                        <div class="col-md-6">
                            <label>State:-</label>
                            <label id="gst">Karnataka</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Client Address:-</label>
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
                            <input type="text" name="" class="col-md-1 form-control input-sm " id="item_id" readonly="">
                        </div>
                        <div class="offset-md-3 col-md-3 cust_info">
                            <label for="input">Item Name</label>
                            <input type="text" name="" autocomplete="off" class="col-md-1 form-control input-sm " id="item_name">
                            <lable id="list1"></lable>
                        </div>
                        <div class="offset-md-3 col-md-1 cust_info">
                            <label for="input">Item HSN</label>
                            <input type="text" name="" class="col-md-1 form-control input-sm " id="item_hsn"
                                readonly="">
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
                            <input type="text" name="" class="col-md-1 form-control input-sm" id="item_quant"
                                required="">
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
                            <input type="text" name="" class="col-md-1 form-control input-sm" id="item_value"
                                readonly="">
                        </div>
                        <div class="col-md-1">
                            <div class=" " style="margin-top: 20px;">
                                <label for="input"></label>
                                <input type="submit" value="Add" class="col-md-12 input-sm btn btn-warning" id="iadd">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="" style="margin-top: 20px;">
                                <input type="submit" value="Delete" class="col-md-12 input-sm btn btn-danger"
                                    id="delete">
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
            $('#tb').load("holesale_item_fetch.php");
            $('#item_hsn').keyup(function() {

            });
        });
        </script>
        <script type="text/javascript">
        $(document).ready(function() {
            $('#search').click(function() {
                var x = $('#inputZip4').val();
                $("#inputZip4").val("");
                $('#inputZip4').attr('readonly', true);
                $.ajax({
                    type: "post",
                    url: "holesale_cust.php",
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
                    }
                })
            });
        });
        </script>

        <script type="text/javascript">
        $('#delete').click(function() {
            var item_id = $('#item_id').val();
            var custid = $('#cust_id').val();
            $('#item_name').val(" ");
            $('#item_hsn').val(" ");
            $('#item_gst').val(" ");
            $('#item_unit').val(" ");
            $('#item_quant').val(" ");
            $('#item_value').val(" ");
            $('#item_id').val(" ");
            $.ajax({
                type: "post",
                url: "holesale_coding.php",
                data: {
                    action: "item_delete",
                    custid: custid,
                    item_id: item_id
                },
                success: function(status) {
                    // alert(status);
                    $('#tb').load("holesale_item_fetch.php");
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
            var item_unit = $('#item_unit').val();
            var item_quant = $('#item_quant').val();
            var item_free = $('#free').val();
            var item_value = $('#item_value').val();
            var item_mrp = $('#item_mrp').val();
            var item_rate = $('#item_rate').val();
            var custid = $('#cust_id').val();
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
                (item_rate == "") || (custid == "")) {
                alert("All Field Necessary");
            } else {

                $.ajax({
                    type: "post",
                    url: "holesale_coding.php",
                    data: {
                        action: "holesale_item",
                        custid: custid,
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
                        // alert(status);
                        $('#tb').load("holesale_item_fetch.php");
                    }
                });

                //cheaK FOR STOCK
                // $.ajax({
                //  type:"post",
                //  url:"stock_fetch.php",
                //  data:{
                //    item_quant : item_quant,
                //    item_id : item_id
                //  },
                //  success:function(qty){
                //        if(qty == 1)
                //        {
                //            $.ajax({
                //              type:"post",
                //              url:"holesale_coding.php",
                //              data:{
                //                action:"holesale_item",
                //                custid : custid,
                //                item_name: item_name,
                //                item_hsn: item_hsn,
                //                item_quant : item_quant,
                //                item_unit:item_unit,
                //                item_gst:item_gst,
                //                item_rate:item_rate,
                //                item_mrp:item_mrp,
                //                item_value:item_value,
                //                item_id:item_id
                //              },
                //                success:function(status){
                //                      alert(status);
                //                      $('#tb').load("holesale_item_fetch.php");
                //                    }
                //                  });
                //        }else{
                //          alert("Less Stock of "+item_name+" ="+qty);
                //        }
                //    }
                // });
            }
        });
        </script>

        <script type="text/javascript">
        $(document).ready(function() {
            $('#item_unit').change(function() {
                var x = $('#item_name').val();
                var item_unit = $(this).val();
                var item_qty = $('#item_quant').val();
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
        });
        </script>
        <script type="text/javascript">
        $(document).ready(function() {
            $('#item_rate').keyup(function() {

                var rate = $(this).val();
                var qty = $('#item_quant').val();
                var final = qty * rate;
                $("#item_value").val(final);
            });

        });
        </script>
</body>

</html>