<?php
include("header.php");
?>

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
</head>
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
        $(document).on('click', 'li', function() {
            $('#item_name').val($(this).text());
            $('#list1').fadeOut();
            var x = $('#item_name').val();
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
                    $("#item_pc").val(data[4]);
                    $("#item_mrp").val(data[5]);
                    $("#basic_value").val(data[6]);
                }
            });
        });
    });
});
</script>

<body>
    <div class="col-md-12 bg-info ">
        <div class="row ip1">
            <div class="col-md-12">
                <div class="row" style="margin-right: 5%; ">
                    <div class="offset-md-3 col-md-1 cust_info" style="display: none;">
                        <label for="input">Item id</label>
                        <input type="text" name="" class="col-md-1 form-control input-sm" id="item_id" readonly="">
                    </div>
                    <div class="offset-md-3 col-md-2 cust_info">
                        <label for="input">Company</label>
                        <select class="col-md-1 form-control input-sm" id="item_cmp">
                        <option>Select</option>
                                <option>Bella</option>
                                <option>H.B</option>
                                <option>Delika</option>
                                <option>Purnima Treds</option>
                                <option>Stricks</option>
                                <option>Pharmalayam</option>
                                <option>Baliga</option>
                                <option>Atish</option>
                        </select>
                    </div>
                    <div class="offset-md-3 col-md-3 cust_info">
                        <label for="input">Item Name</label>
                        <input type="text" name="" class="col-md-2 form-control input-sm" id="item_name"
                            autocomplete="off">
                        <lable id="list1"></lable>
                    </div>
                    <div class="offset-md-2 col-md-1 cust_info">
                        <label for="input">Packing</label>
                        <input type="text" name="" class="col-md-2 form-control input-sm " id="item_pc">

                    </div>
                    <div class="offset-md-3 col-md-2 cust_info">
                        <label for="input">Item HSN</label>
                        <input type="text" name="" class="col-md-2 form-control input-sm " id="item_hsn">
                    </div>
                    <div class="offset-md-3 col-md-1 cust_info" >
                        <label for="input">Item GST</label>
                        <select class="col-md-1 form-control input-sm" id="item_gst">
                            <option>0</option>
                            <option>5</option>
                            <option>12</option>
                            <option>18</option>
                        </select>
                    </div>

                    <div class="offset-md-3 col-md-1 cust_info">
                        <label for="input">MRP</label>
                        <input type="text" name="" class="col-md-2 form-control input-sm " id="item_mrp">
                    </div>
                    <div class="offset-md-3 col-md-1 cust_info">
                        <label for="input">Sale Rate</label>
                        <input type="text" name="" class="col-md-2 form-control input-sm " id="basic_value">
                    </div>
                    <!-- <div class="offset-md-3 col-md-1 cust_info" style="display: none;">
				<label for="input">Rate / Kg</label>
				<input type="text" name="" class="col-md-2 form-control input-sm " id="wholesale_value">
			</div> -->
                </div>
            </div>
        </div>
    </div>
    <!----invoise form------>
    <!--------bottons------>
    <div class="col-md-12 bg-info ">
        <div class="row ip3">
            <div class="col-md-12">
                <div class="row">
                    <div class="row">
                        <div class="offset-md-2 col-md-2 " style="margin-left: 15%; ">
                            <label for="input"></label>
                            <input type="submit" value="Add" class="col-md-6 input-sm btn btn-success" id="item_add">
                        </div>
                        <div class="offset-md-2 col-md-2 ">
                            <label for="input"></label>
                            <input type="submit" value="Update" class="col-md-6 input-sm btn btn-info" id="item_update">
                        </div>
                        <div class="offset-md-2 col-md-2 ">
                            <label for="input"></label>
                            <input type="submit" value="clear" class="col-md-6 input-sm btn btn-default "
                                id="item_clear">
                        </div>
                        <div class="offset-md-2 col-md-2 ">
                            <label for="input"></label>
                            <input type="submit" value="Delete" class="col-md-6 input-sm btn btn-danger "
                                id="item_delete">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
        <!--------bottons------>
        <!-----table------->
        <div class="col-md-12 theam " style="margin-top: -10px;" id="fetch_table">
        </div>
        <!------table------>

        <script type="text/javascript">
        $(document).ready(function() {
            $('#fetch_table').load("fetch_item_master.php");
            $('#item_clear').click(function() {
				$(':text').val("");
            });

            $('#item_add').click(function() {
                var item_cmp = $('#item_cmp').val();
                var item_name = $('#item_name').val();
                var item_hsn = $('#item_hsn').val();
                var item_gst = $('#item_gst').val();
                var item_pc = $('#item_pc').val();
                var item_mrp = $('#item_mrp').val();
                var basic_value = $('#basic_value').val();
                var wholesale_value = $('#wholesale_value').val();
				$(':text').val("");
                $.ajax({
                    type: "post",
                    url: "add_item_ajax.php", 
                    data: {
						action: "add",
                        item_name: item_name,
                        item_cmp: item_cmp,
                        item_hsn: item_hsn,
                        basic_value: basic_value,
                        item_pc: item_pc,
                        item_mrp: item_mrp,
                        item_gst: item_gst,
                    },
                    success: function(status) {
                        $('#fetch_table').load("fetch_item_master.php");
                        alert(status);
                    }

                })

            });

            $('#item_update').click(function() {
                var item_id = $('#item_id').val();
                var item_cmp = $('#item_cmp').val();
                var item_name = $('#item_name').val();
                var item_hsn = $('#item_hsn').val();
                var item_gst = $('#item_gst').val();
                var item_pc = $('#item_pc').val();
                var item_mrp = $('#item_mrp').val();
                var basic_value = $('#basic_value').val();
                $(':text').val("");
                var x = $.ajax({
                    type: "post",
                    url: "add_item_ajax.php",
                    data: {
                        action: "update",
                        item_id: item_id,
                        item_cmp: item_cmp,
                        item_name: item_name,
                        item_hsn: item_hsn,
                        basic_value: basic_value,
                        item_pc: item_pc,
                        item_mrp: item_mrp,
                        item_gst: item_gst
                    },
                    success: function(status) {
                        $('#fetch_table').load("fetch_item_master.php");
                        //	alert(status);
                    }

                });
            });
        });
        $(document).ready(function() {
            $('#item_delete').click(function() {
                var item_id = $('#item_id').val();
                $(':text').val("");
                $.ajax({
                    type: "post",
                    url: "add_item_ajax.php",
                    data: {
                        action: "delete",
                        item_id: item_id
                    },
                    success: function(status) {
                        $('#fetch_table').load("fetch_item_master.php");
                        alert(status);
                    }
                })
            });
        });
        </script>
</body>

</html>