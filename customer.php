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

<script type="text/javascript">
	  $(document).ready(function(){
        $("#item_name").keyup(function(){
           var x = $(this).val();
            if(x != '')
            {
                $.ajax({
                    url:"search_items.php",
                    method : "POST",
                    data :{query : x },
                    success : function(data)
                    {
                        $('#list1').fadeIn();
                        $('#list1').html(data);
                    }
                });
            }
            else
            {
                 $('#list1').html("");
            } 
            $(document).on('click','li',function(){
                $('#item_name').val($(this).text());
                 $('#list1').fadeOut();
                  var x=$('#item_name').val();
                 var x=$('#item_name').val();
		        $.ajax({
		                type:"post",
		                url:"items.php",
		                dataType: 'json',
		                data:{
		                  action:x
		                },
		                success:function(data){
		                 $("#item_id").val(data[0]);
		                 $("#item_name").val(data[1]);
		                $("#item_hsn").val(data[2]);
		                $("#item_gst").val(data[3]);
		              $("#item_unit").val(data[4]);
                  $("#item_mrp").val(data[5]);
		              $("#item_rate").val(data[7]);
		                }
		              });
            });
        });
    });
</script>
<!----invoise form------>
<div class="col-md-12 bg-success ">
<div class="row">
	<div class="col-md-6 ">
		<div class="row cust_add">
			<div class="col-md-6">
				<div class="offset-md-3 col-md-1 cust_info" style="display: none;">
			<label for="input">Customer id</label>
				<input type="text" name="" class="col-md-1 form-control input-sm" id="customer_id" readonly="">
			</div>
			
				<label>Customer Name:-</label>
				<input type="text" name="" class="col-md-1 form-control input-sm "id="customer_name">
			</div>
			<div class="col-md-6">
				<label>Customer Address:-</label>
				<input type="text" name="" class="col-md-1 form-control input-sm "id="customer_address">
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<label>Customer GST NO:-</label>
				<input type="text" name="" class="col-md-1 form-control input-sm "id="customer_email">
			</div>
			<div class="col-md-6">
				<label>Customer Mobile No:-</label>
				<input type="text" name="" class="col-md-1 form-control input-sm "id="customer_mob">
			</div>


		</div>
      <div class="row">
      <div class="col-md-6" style="margin-top: 10px;">
        <input type="button" name="customer_add1" value="Add" class="col-md-12 input-sm btn btn-success" id="customer_add1">           <input type="text" value="" id="custid" style="display: none;">
      </div>
      <div class="col-md-6" style="margin-top: 10px;">
              <input type="text" value="" id="custid" style="display: none;">
        <input type="button" value="Edit" class="col-md-12 input-sm btn btn-info" id="update">
      </div>
    </div>

		</div>
	<div class="col-md-6" style="margin-top: 8px;">
  <div class="right">
  <div class="row">
   <div class="col-md-6">
    <label>Customer Name:-</label>
    <label id="name"></label>
   </div>
   <div class="col-md-6">
    <label> Gst No:-</label>
    <label id="gst"></label>
   </div>
  </div>
  <div class="row">
   <div class="col-md-6">
    <label>Customer Mobile:-</label>
    <label id="mob"></label>
   </div>
   <div class="col-md-6">
    <label>State:-</label>
    <label id="gst">Karnataka</label>
   </div>
  </div>
  <div class="row">
     <div class="col-md-12">
      <label>Customer Address:-</label>
      <label id="adress"></label>
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
   <div class="offset-md-3 col-md-2 cust_info">
    <label for="input">Item Name</label>
    <input type="text" name="" class="col-md-1 form-control input-sm " id="item_name" >
     <lable id="list1"></lable>
   </div>
   <div class="offset-md-3 col-md-1 cust_info">
    <label for="input">Item HSN</label>
    <input type="text" name="" class="col-md-1 form-control input-sm " id="item_hsn" readonly="">
   </div>
   <div class="offset-md-3 col-md-1 cust_info">
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
    <label for="input">Item Unit</label>
    <select class="col-md-1 form-control input-sm" id="item_unit">
             <option>Pcs</option>
              <option>Gm</option>
              <option>Kg</option>
              <option>Qtl</option>
              <option>Box</option>
              <option>Dozen</option>
              <option>Half Dozen</option>
        </select>
   </div>
    <div class="offset-md-3 col-md-1 cust_info">
    <label for="input">Item MRP</label>
    <input type="text" name="" class="col-md-1 form-control input-sm" id="item_mrp">
   </div>
   <div class="offset-md-2 col-md-1 cust_info">
    <label for="input">Rate</label>
    <input type="text" name="" class="col-md-1 form-control input-sm" id="item_rate">
   </div>
    <div class="offset-md-2 col-md-1 cust_info">
    <label for="input">value</label>
    <input type="text" name="" class="col-md-1 form-control input-sm" id="item_value" readonly="">
   </div>
    <div class="col-md-2">
   <div class=" " style="margin-top: 20px;">
    <label for="input"></label>
    <input type="submit" value="Add" class="col-md-6 input-sm btn btn-warning" id="iadd">
   </div>
 </div>
 <div class="col-md-1">
     <div class="" style="margin-top: 20px; margin-left: -110px;">
    <input type="submit" value="Delete" class="col-md-6 input-sm btn btn-danger" id="delete">
   </div>
</div>  
  </div>
 </div>
 </div>
</div>
<!----invoise form------>
<!-----table------->
<div class="col-md-12 bg-danger " style="margin-top: -10px;">
	<div class="row ip2">
		<div class="tbl1" id="fetchdata">
		</div>

	</div>
</div>
</div>
<!------table------>
<!--------bottons------>
<!-- <div class="col-md-12 bg-info ">
<div class="row ip1">
	<div class="col-md-12">
		<div class="row">
			<div class="offset-md-3 col-md-2 cust_info" style="margin-left: 100px;">
				<label for="input">Amount</label>
				<input type="text" name="" class="col-md-1 form-control input-sm ">
			</div>
			<div class="offset-md-3 col-md-2 cust_info">
				<label for="input">GST</label>
				<input type="text" name="" class="col-md-1 form-control input-sm ">
			</div>
			<div class="offset-md-3 col-md-2 cust_info">
				<label for="input">GST</label>
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
		</div>
	</div>
	</div>
</div> -->
<!--------bottons------>
<script type="text/javascript">
	$(document).ready(function(){
	$("#table tbody").on('dblclick', 'tr', function () {
		var currow=$(this).closest('tr');
		var vender_id=currow.find('td:eq(1)').html();
		var vender_name=currow.find('td:eq(2)').html();
		var vender_address=currow.find('td:eq(3)').html();
		var vender_mob=currow.find('td:eq(4)').html();
		var vender_gst=currow.find('td:eq(5)').html();
		var vender_fssid=currow.find('td:eq(6)').html();
		var mail_id=currow.find('td:eq(7)').html();
		alert(vender_id);
	});
});
</script>

<script type="text/javascript">
	$(document).ready(function(){
			$('#fetchdata').load("fetchdata.php");
				$('#customer_name').attr('readonly', true);
		$('#customer_address').attr('readonly', true);  
		$('#customer_mob').attr('readonly', true); 
		$('#customer_email').attr('readonly', true); 		
		});

</script>
<script type="text/javascript">
	$('#customer_add1').click(function(){
		var custid=$("#custid").val();
		var customer_name = $('#customer_name').val();
		var customer_address = $('#customer_address').val();
		var customer_mob = $('#customer_mob').val();
		var customer_email=$('#customer_email').val();
		$('#customer_name').val(" ");
		$('#customer_address').val(" ");
		$('#customer_mob').val(" ");
		$('#customer_email').val(" ");
		$('#customer_name').attr('readonly', true);
		$('#customer_address').attr('readonly', true);  
		$('#customer_mob').attr('readonly', true); 
		$('#customer_email').attr('readonly', true); 
		$.ajax({
			type:"post",
			url:"itemcustomer.php",
			data:{
				action:"customer_add1",
				custid:custid,
				customer_name : customer_name,
				customer_address : customer_address,
				customer_mob : customer_mob,
				customer_email : customer_email
			},
			success:function(status){
				$.ajax({
                type:"post",
                url:"local_cust_fetch.php",
                dataType: 'json',
                data:{
                  action:"search"
                },
                success:function(data){
	                  $("#custid").val(data[0]);
	                  $("#name").html(data[1]);
                        $("#adress").html(data[2]);
                        $("#mob").html(data[3]);
                        $("#gst").html(data[4]);
                         $("#fsn").html(data[5]);
                        $("#mail").html(data[6]); 
                }
              })
			}
		})
    });
</script>

<script type="text/javascript">
	$('#update').click(function(){
		$('#customer_name').attr('readonly', false);
		$('#customer_address').attr('readonly', false);  
		$('#customer_mob').attr('readonly', false); 
		$('#customer_email').attr('readonly', false); 
		$.ajax({
                type:"post",
                url:"local_cust_fetch.php",
                dataType: 'json',
                data:{
                  action:"search"
                },
                success:function(data){
                  $("#custid").val(data[0]);
                  $("#customer_name").val(data[1]);
                  $("#customer_address").val(data[2]);
                  $("#customer_mob").val(data[3]);
                  $("#customer_email").val(data[4]);
                }
              })
    });

    $(document).ready(function(){
    	$.ajax({
                type:"post",
                url:"local_cust_fetch.php",
                dataType: 'json',
                data:{
                  action:"search"
                },
                success:function(data){
		                  $("#custid").val(data[0]);
		                  $("#name").html(data[1]);
                        $("#adress").html(data[2]);
                        $("#mob").html(data[3]);
                        $("#gst").html(data[4]);
                         $("#fsn").html(data[5]);
                        $("#mail").html(data[6]); 
                }
              })
    });
</script>

<script type="text/javascript">
    $('#iadd').click(function(){
    	var item_id = $('#item_id').val();
		var item_name = $('#item_name').val();
		var item_hsn  = $('#item_hsn').val();
		var item_gst = $('#item_gst').val();
		var item_unit = $('#item_unit').val();
		var item_quant = $('#item_quant').val();
    var item_mrp = $('#item_mrp').val();
    var item_rate = $('#item_rate').val();
		var item_value = $('#item_value').val();
		var custid = $('#custid').val();
		$('#item_name').val(" ");
		$('#item_hsn').val(" ");
		$('#item_gst').val(" ");
		$('#item_unit').val(" ");
		$('#item_quant').val(" ");
    $('#item_rate').val(" ");
		$('#item_value').val(" ");
		$('#item_id').val(" ");
		if((item_id==" ") || (item_name==" ") || (item_hsn==" ") || (item_gst==" ") || (item_unit==" ") || (item_mrp==" ") ||(item_quant==" ") || (item_value==" ") || (item_rate==" ")|| (custid==" ")){
		      alert("All Field Necessary");
		    }else{

           //item add into bill
                        $.ajax({
                              type:"post",
                              url:"itemcustomer.php",
                              data:{
                                action:"itemcustomer",
                                custid : custid,
                                item_name: item_name,
                                item_hsn: item_hsn,
                                item_quant : item_quant,
                                item_unit:item_unit,
                                item_gst:item_gst,
                                item_mrp:item_mrp,
                                item_rate:item_rate,
                                item_value:item_value,
                                item_id:item_id
                              },
                              success:function(status){
                                alert(status);
                                $('#fetchdata').load("fetchdata.php");
                              }
                            });

          // //stock cheak by this coad
          //   $.ajax({
          //   type:"post",
          //   url:"stock_fetch.php",
          //   data:{
          //     item_quant : item_quant,
          //     item_id : item_id
          //   },
          //   success:function(qty){
          //         if(qty == 1)
          //         {
          //           //item add into bill
          //               $.ajax({
          //                     type:"post",
          //                     url:"itemcustomer.php",
          //                     data:{
          //                       action:"itemcustomer",
          //                       custid : custid,
          //                       item_name: item_name,
          //                       item_hsn: item_hsn,
          //                       item_quant : item_quant,
          //                       item_unit:item_unit,
          //                       item_gst:item_gst,
          //                       item_rate:item_rate,
          //                       item_value:item_value,
          //                       item_id:item_id
          //                     },
          //                     success:function(status){
          //                       alert(status);
          //                       $('#fetchdata').load("fetchdata.php");
          //                     }
          //                   });
          //         }else{
          //           alert("Less Stock of "+item_name+" ="+qty);
          //         }
          //   }
          // });
        }
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#purchese_redirect').click(function(){
		window.location="purchase.html";
	});
	});
	
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#tb').load("purchse_item_fetch.php");
    $('#item_hsn').keyup(function(){
      var x=$('#item_name').val();
        $.ajax({
                type:"post",
                url:"items.php",
                dataType: 'json',
                data:{
                  action:x
                },
                success:function(data){
                 $("#item_id").val(data[0]);
                 $("#item_name").val(data[1]);
                $("#item_hsn").val(data[2]);
                $("#item_gst").val(data[3]);
              $("#item_unit").val(data[4]);
              $("#item_value").val(data[5]);
                }
              })
        });
  });
</script>

 <script type="text/javascript">
    $('#delete').click(function(){
    var item_id = $('#item_id').val();
   var custid = $('#custid').val();
    $('#item_name').val(" ");
    $('#item_hsn').val(" ");
    $('#item_gst').val(" ");
    $('#item_unit').val(" ");
    $('#item_quant').val(" ");
    $('#item_value').val(" ");
     $('#item_rate').val(" ");
    $('#item_id').val(" ");
    $.ajax({
      type:"post",
      url:"itemcustomer.php",
      data:{
        action:"sale_item_delete",
        custid : custid,
        item_id:item_id
      },
      success:function(status){
        alert(status);
        $('#fetchdata').load("fetchdata.php");
      }
    }) 
  });
</script>


<script type="text/javascript">
  $(document).ready(function(){
    $('#item_unit').change(function(){
      var x=$('#item_name').val();
        var item_unit=$(this).val();
         var item_qty=$('#item_quant').val();
          $.ajax({
                type:"post",
                url:"items.php",
                dataType: 'json',
                data:{
                  action:x
                },
                success:function(data){
                 if((item_unit=="Kg")||(item_unit=="Gm")||(item_unit=="Qtl"))
                  {
                     var value=data[6];
                      if(item_unit=="Kg")
                      {
                        val=value/1;
                      }
                      if(item_unit=="Gm"){
                         val=value/1000;
                      }
                      $('#item_rate').val(val);
                      if(item_unit=="Qtl"){
                         val=value*100;
                          $('#item_rate').val(value);
                      }
                      
                  }
                  if((item_unit=="Pcs")||(item_unit=="Box")||(item_unit=="Dozen")||(item_unit=="Half Dozen"))
                  {
                     var value=data[7];

                      $('#item_rate').val(value);
                       if(item_unit=="Pcs")
                      {
                        val=value;
                      }
                  
                      if(item_unit=="Box"){
                         val=value*576;
                      }
                      if(item_unit=="Dozen"){
                         val=value*12;
                      }
                        if(item_unit=="Half Dozen"){
                         val=value*6;
                      }
                  }
                    var final=item_qty*val;
                     $("#item_value").val(final);
                  }
              });
    });


    $('#item_quant').keyup(function(){
       var x=$('#item_name').val();
        var item_unit=$('#item_unit').val();
         var item_qty=$(this).val();
          $.ajax({
                type:"post",
                url:"items.php",
                dataType: 'json',
                data:{
                  action:x
                },
                success:function(data){
                   if((item_unit=="Kg")||(item_unit=="Gm")||(item_unit=="Qtl"))
                  {
                     var value=data[6];
                      if(item_unit=="Kg")
                      {
                        val=value/1;
                      }
                      if(item_unit=="Gm"){
                         val=value/1000;
                      }
                      $('#item_rate').val(val);
                      if(item_unit=="Qtl"){
                         val=value*100;
                          $('#item_rate').val(value);
                      }
                      
                  }
                  if((item_unit=="Pcs")||(item_unit=="Box")||(item_unit=="Dozen")||(item_unit=="Half Dozen"))
                  {
                     var value=data[7];

                      $('#item_rate').val(value);
                       if(item_unit=="Pcs")
                      {
                        val=value;
                      }
                  
                      if(item_unit=="Box"){
                         val=value*576;
                      }
                      if(item_unit=="Dozen"){
                         val=value*12;
                      }
                        if(item_unit=="Half Dozen"){
                         val=value*6;
                      }
                  }
                    var final=item_qty*val;
                     $("#item_value").val(final);
                  }
              });
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#item_rate').keyup(function(){

      var rate=$(this).val();
      var qty=$('#item_quant').val();
      var final=qty*rate;
       $("#item_value").val(final);
    });

  });

</script>
</body>
</html>