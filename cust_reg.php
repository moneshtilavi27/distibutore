<?php
include("header.php");
?>
  <script>
    $(document).ready(function(){
        $("#customer_name").keyup(function(){
           var x = $(this).val();
            if(x != '')
            {
                $.ajax({
                    url:"holesale_customer_search.php",
                    method : "POST",
                    data :{query : x },
                    success : function(data)
                    {
                        $('#list').fadeIn();
                        $('#list').html(data);
                    }
                });
            }
            else
            {
                 $('#list').html("");
            } 
            $(document).on('click','li',function(){
                $('#customer_name').val($(this).text());
                 $('#list').fadeOut();
                 var x=$('#customer_name').val();
			        $.ajax({
			                type:"post",
			                url:"holesale_cust.php",
			                dataType: 'json',
			                data:{
			                  action:x
			                },
			                success:function(data){
			                  $("#customer_id").val(data[0]);
			                  $("#customer_name").val(data[1]);
			                  $("#customer_address").val(data[2]);
			                  $("#customer_mob").val(data[3]);
			                  $("#customer_gst").val(data[4]);
			                  $("#customer_fssid").val(data[5]);
			                  $("#customer_category").val(data[6]); 
			         }
			      })
            });
        });
    });
</script>
</head>
<body>



<div class="col-md-12 bg-info ">
<div class="row ip1">
	<div class="col-md-12">
		<div class="row" style="margin-left: -4%; ">
			<div class="offset-md-3 col-md-1 cust_info" style="display: none;">
			<label for="input">Client id</label>
				<input type="text" name="" class="col-md-1 form-control input-sm" id="customer_id" readonly="">
			</div>
			<div class="offset-md-3 col-md-3 cust_info" >
				<label for="input">Client Name</label>
				<input type="text" name="" class="col-md-2 form-control input-sm "id="customer_name">
				<lable id="list"></lable>
			</div>
			<div class="offset-md-3 col-md-3 cust_info">
				<label for="input">Client Address</label>
				<input type="text" name="" class="col-md-2 form-control input-sm "id="customer_address">
			</div>
			<div class="offset-md-3 col-md-2 cust_info">
				<label for="input">Client Mobile No.</label>
				<input type="text" name="" class="col-md-2 form-control input-sm "id="customer_mob">
			</div>
			<div class="offset-md-3 col-md-2 cust_info">
				<label for="input">Client Gst No</label>
				<input type="text" name="" class="col-md-2 form-control input-sm "id="customer_gst">
			</div>
			<div class="offset-md-3 col-md-2 cust_info">
				<label for="input">Client Fssid</label>
				<input type="text" name="" class="col-md-2 form-control input-sm "id="customer_fssid">
			</div>
			<div class="offset-md-3 col-md-2 cust_info" style="display: none;">
				<label for="input">Client Category</label>
				<input type="text" name="" class="col-md-2 form-control input-sm "id="customer_category">
			</div>
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
				<input type="submit" value="Add" class="col-md-6 input-sm btn btn-success" id="customer_add">
			</div>
			<div class="offset-md-2 col-md-2 ">
				<label for="input"></label>
				<input type="submit" value="Update" class="col-md-6 input-sm btn btn-info" id="customer_update">
			</div>
			<div class="offset-md-2 col-md-2 " >
				<label for="input"></label>
				<input type="submit" value="Clear" class="col-md-6 input-sm btn btn-default " id="customer_clear">
			</div>
			<div class="offset-md-2 col-md-2 ">
				<label for="input"></label>
				<input type="submit" value="Delete" class="col-md-6 input-sm btn btn-danger " id="customer_delete">
			</div>
		</div>
	</div>
	</div>
</div>
<!--------bottons------>
<!-----table------->
<div class="col-md-12 bg-danger" style="margin-top: -10px;">
	<div class="row ip4">
		<div class="tbl1" id="cust_reg_fetch">
			
	</div>
</div>
</div>
<!------table------>
<script type="text/javascript">
	
$(document).ready(function(){
	$('#cust_reg_fetch').load("cust_reg_fetch.php");

	$('#customer_clear').click(function(){
		$('#customer_id').val("");
		$('#customer_name').val("");
		$('#customer_address').val("");
		$('#customer_mob').val("");
		$('#customer_gst').val("");
		$('#customer_fssid').val("");
		$('#customer_category').val("");
	});

	$('#customer_add').click(function(){
		var customer_name = $('#customer_name').val();
		var customer_address = $('#customer_address').val();
		var customer_mob = $('#customer_mob').val();
		var customer_gst = $('#customer_gst').val();
		var customer_fssid = $('#customer_fssid').val();
		var customer_category = $('#customer_category').val();	
		$('#customer_name').val("");
		$('#customer_address').val("");
		$('#customer_mob').val("");
		$('#customer_gst').val("");
		$('#customer_fssid').val("");
		$('#customer_category').val("");

		$.ajax({
			type:"post",
			url:"customeradd.php",
			data:{
				action:"customeradd",
				customer_name:customer_name,
				customer_address:customer_address,
				customer_mob:customer_mob,
				customer_gst:customer_gst,
				customer_fssid:customer_fssid,
				customer_category:customer_category
			},
			success:function(status){
				$('#cust_reg_fetch').load("cust_reg_fetch.php");
				alert(status);
			}

		})
     });
});

</script>
<script type="text/javascript">
	$('#customer_update').click(function(){
		var customer_id = $('#customer_id').val();
		var customer_name= $('#customer_name').val();
		var customer_address= $('#customer_address').val();
		var customer_mob= $('#customer_mob').val();
		var customer_gst= $('#customer_gst').val();
		var customer_fssid= $('#customer_fssid').val();
		var customer_category=$('#customer_category').val();
		$('#customer_name').val("");
		$('#customer_address').val("");
		$('#customer_mob').val("");
		$('#customer_gst').val("");
		$('#customer_fssid').val("");
		$('#customer_category').val("");
		$.ajax({
			type:"post",
			url:"customeradd.php",
			data:{
				action:"update",
				customer_id:customer_id,
				customer_name:customer_name,
				customer_address:customer_address,
				customer_mob:customer_mob,
				customer_gst:customer_gst,
				customer_fssid:customer_fssid,
				customer_category:customer_category
			},
			success:function(status){
				$('#cust_reg_fetch').load("cust_reg_fetch.php");
				alert(status);
			}

		})

	});
</script>

<script type="text/javascript">
	$('#customer_delete').click(function(){
		var customer_id = $('#customer_id').val();
	 	$('#customer_id').val("");
		$('#customer_name').val("");
		$('#customer_address').val("");
		$('#customer_mob').val("");
		$('#customer_gst').val("");
		$('#customer_fssid').val("");
		$('#customer_category').val("");
		if(customer_id>0){

			$.ajax({
			type:"post",
			url:"customeradd.php",
			data:{
				action:"delete",
				customer_id:customer_id,
				
			},
			success:function(status){
				$('#cust_reg_fetch').load("cust_reg_fetch.php");
				alert(status);
			}

		});
		}
		else{
			alert("This Customer cannot be delete"+customer_id);
			}


	});
</script>
</body>
</html>