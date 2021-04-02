<?php
include("header.php");
?>

 <style type="text/css">
        
        .b1{ height: 38px;
            margin-top: 23px;
            width: 10em;
        }
        #b1{background-color: lightgreen;}
         #b2{background-color: lightcoral;}
         #b3{background-color: lightblue;}
        #list{ max-height: 70px;
            overflow-y: auto;}
        #list ul{
            background-color: #DEB0A6;
            cursor: pointer;
        }
        #list li{ color: black; 
            font: 12pt;
        padding: 8px;}
         #list li:hover{ color: white; 
            background-color: #b3b3ff;}
    
              #list1{ max-height: 70px;
            overflow-y: auto;}
        #list1 ul{
            background-color: #DEB0A6;
            cursor: pointer;
        }
        #list1 li{ color: black; 
            font: 12pt;
        padding: 8px;}
         #list1 li:hover{ color: white; 
            background-color: #b3b3ff;}

    </style>
</head>
<body>
  <script>
    $(document).ready(function(){
        $("#vender_name").keyup(function(){
           var x = $(this).val();
            if(x != '')
            {
                $.ajax({
                    url:"search.php",
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
                $('#vender_name').val($(this).text());
                 $('#list').fadeOut();
                  var x=$('#vender_name').val();
	              $.ajax({
                type:"post",
                url:"customer_search.php",
                dataType: 'json',
                data:{
                  action:x
                },
                success:function(data){
                  $("#vender_id").val(data[0]);
                  $("#name").html(data[1]);
                        $("#vender_addres").val(data[2]);
                        $("#vender_mob").val(data[3]);
                        $("#vender_gst").val(data[4]);
                         $("#vender_fssid").val(data[5]);
                        $("#mail_id").val(data[6]); 
                }
              })
            });
        });
    });
</script>

<div class="col-md-12 bg-info ">
<div class="row ip1">
	<div class="col-md-12">
		<div class="row" style="margin-left: -4%; ">
			<div class="offset-md-3 col-md-1 cust_info" style="display: none;">
				<label for="input">Supplier id</label>
				<input type="text" name="" class="col-md-1 form-control input-sm" id="vender_id" readonly="">

			</div>
			<div class="offset-md-3 col-md-3 cust_info" >
				<label for="input">Supplier Name</label>
				<input type="text" name="" class="col-md-2 form-control input-sm "id="vender_name">
				  <lable id="list"></lable>
			</div>
			<div class="offset-md-3 col-md-3 cust_info">
				<label for="input">Address</label>
				<input type="text" name="" class="col-md-2 form-control input-sm "id="vender_addres">
			</div>
			<div class="offset-md-3 col-md-2 cust_info">
				<label for="input">Mobile No</label>
				<input type="text" name="" class="col-md-2 form-control input-sm "id="vender_mob">
			</div>
			<div class="offset-md-3 col-md-2 cust_info">
				<label for="input">Email id</label>
				<input type="text" name="" class="col-md-2 form-control input-sm "id="mail_id">
			</div>
			<div class="offset-md-3 col-md-2 cust_info">
				<label for="input">Supplier Gst No</label>
				<input type="text" name="" class="col-md-2 form-control input-sm "id="vender_gst">
			</div>

			<div class="offset-md-3 col-md-2 cust_info" style="display: none">
				<label for="input">Fssid No</label>
				<input type="text" name="" class="col-md-2 form-control input-sm "id="vender_fssid">
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
				<input type="submit" value="Add" class="col-md-6 input-sm btn btn-success" id="vendor_add">
			</div>
			<div class="offset-md-2 col-md-2 ">
				<label for="input"></label>
				<input type="submit" value="Update" class="col-md-6 input-sm btn btn-info" id="vendor_update">
			</div>
			<div class="offset-md-2 col-md-2 " >
				<label for="input"></label>
				<input type="submit" value="clear" class="col-md-6 input-sm btn btn-default " id="vendor_clear">
			</div>
			<div class="offset-md-2 col-md-2 ">
				<label for="input"></label>
				<input type="submit" value="Delete" class="col-md-6 input-sm btn btn-danger " id="vendor_delete">
			</div>
		</div>
	</div>
	</div>
</div>
<!--------bottons------>
<!-----table------->
<div class="col-md-12 bg-danger " style="margin-top: -10px;">
	<div class="row ip4">
		<div class="tbl1" id="vendor_fetch">
				
	</div>
</div>
</div>
<!------table------>
<script type="text/javascript">
	
$(document).ready(function(){
	$('#vendor_clear').click(function(){
		$('#vender_id').val(" ");
		$('#vender_name').val(" ");
		$('#vender_addres').val(" ");
		$('#vender_mob').val(" ");
		$('#vender_gst').val(" ");
		$('#vender_fssid').val(" ");
		$('#mail_id').val(" ");
	});

	$('#vendor_add').click(function(){
		var vender_name = $('#vender_name').val();
		var vender_address = $('#vender_addres').val();
		var vender_mob = $('#vender_mob').val();
		var vender_gst = $('#vender_gst').val();
		var vender_fssid = $('#vender_fssid').val();
		var mail_id = $('#mail_id').val();	
		$('#vender_name').val(" ");
		$('#vender_addres').val(" ");
		$('#vender_mob').val(" ");
		$('#vender_gst').val(" ");
		$('#vender_fssid').val(" ");
		$('#mail_id').val(" ");
		$.ajax({
			type:"post",
			url:"vendoradd.php",
			data:{
				action:"vendoradd",
				vender_name:vender_name,
				vender_address:vender_address,
				vender_mob:vender_mob,
				vender_gst:vender_gst,
				vender_fssid:vender_fssid,
				mail_id:mail_id
			},
			success:function(status){ 
				$('#vendor_fetch').load("vendor_fetch.php");
				alert(status);
			}

		})
     });
});

</script>
<script type="text/javascript">
$('#vendor_fetch').load("vendor_fetch.php");

	$('#vendor_update').click(function(){
		var vender_id = $('#vender_id').val();
		var vender_name= $('#vender_name').val();
		var vender_address= $('#vender_addres').val();
		var vender_mob= $('#vender_mob').val();
		var vender_gst= $('#vender_gst').val();
		var vender_fssid= $('#vender_fssid').val();
		var mail_id=$('#mail_id').val();
		$('#vender_name').val(" ");
		$('#vender_addres').val(" ");
		$('#vender_mob').val(" ");
		$('#vender_gst').val(" ");
		$('#vender_fssid').val(" ");
		$('#mail_id').val("");
		$.ajax({
			type:"post",
			url:"vendoradd.php",
			data:{
				action:"update",
				vender_id:vender_id,
				vender_name:vender_name,
				vender_address:vender_address,
				vender_mob:vender_mob,
				vender_gst:vender_gst,
				vender_fssid:vender_fssid,
				mail_id:mail_id
			},
			success:function(status){
				$('#vendor_fetch').load("vendor_fetch.php");
				alert(status);
				
			}

		})

	});
</script>
<script type="text/javascript">
	$('#vendor_delete').click(function(){
		var vender_id = $('#vender_id').val();
		$('#vender_id').val(" ");
		$('#vender_name').val(" ");
		$('#vender_addres').val(" ");
		$('#vender_mob').val(" ");
		$('#vender_gst').val(" ");
		$('#vender_fssid').val(" ");
		$('#mail_id').val("");
		$.ajax({
			type:"post",
			url:"vendoradd.php",
			data:{
				action:"delete",
				vender_id:vender_id
			},
			success:function(status){
				$('#vendor_fetch').load("vendor_fetch.php");
				alert(status);
			}

		})

	});
</script>
</body>
</html>
