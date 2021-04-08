<?php
include("header.php");
?>

<body class="theam">
    <div class="col-md-12 bg-success ">
        <h2 class="text-center" style="color:black;">INVOICE DETAILS</h2>
        <div class="row">
            <div class="col-md-12 ">
                <div class="row cust_add">
                    <form action=" " method="post">
                        <div class="col-md-3">
                            <div class="offset-md-3 col-md-1 cust_info" style="display: none;">
                                <label for="input">Customer id</label>
                                <input type="text" name="" class="col-md-1 form-control input-sm" id="customer_id"
                                    readonly="">
                            </div>

                            <label>Starting Date:-</label>
                            <input type="date" name="start" class="col-md-1 form-control input-sm " id="">
                        </div>
                        <div class="col-md-3">
                            <label>Ending Date:-</label>
                            <input type="date" name="end" class="col-md-1 form-control input-sm " id="">
                        </div>

                        <div style="margin-bottom: 10px;" class="col-lg-4">


                            <input style="margin-left: 10px; margin-top: 30px;" type="submit" value="Submit"
                                class="col-md-2 input-sm btn btn-success" id="customer_add1" name="purch">
                            <input type="text" value="" id="custid" style="display: none;">
                            <!-- <input style="margin-left: 10px; margin-top: 30px;" type="button" value="Export" class="col-md-2 input-sm btn btn-info" id="update"> -->
                        </div>

                    </form>
                    <div style="margin-left: -20px;" class="col-md-2">
                        <label>Search:</label>
                        <input type="text" placeholder="Search.." class="form-control input-sm" id="search">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-----table------->
    <div class="col-md-12 theam " style="margin-top: -10px;">
        <table class="fixed_header1 table table-bordered" id="table">
            <thead>
                <tr>
                    <th style="width: 5%;">Sn</th>
                    <th id="id" style="width: 7%;">invoice Id</th>
                    <th style="width: 30%;">Customer Name</th>
                    <th>Date</th>
                    <th>Items no</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <script type="text/javascript"></script>

                <?php
					  $sn=0; $total=0;
					  $gstfive=$gsttwelve=$gsteghteen=0;
					  if(isset($_POST['purch']))
					  {
					  	  $strat=$_POST['start'];$end=$_POST['end'];
							$qry="SELECT DISTINCT `invoice_no`.`number` AS `invoice`,`invoice_no`.`status` AS `status`,`customer`.`customer_name` AS `customer`,`invoice`.`invoice_date` AS `date` FROM `invoice_no`,`invoice`,`customer` WHERE `invoice`.`customer_id`=`customer`.`customer_id` AND `invoice_no`.`in_id`=`invoice`.`in_id` AND `invoice`.`customer_id`!='0' AND `invoice`.`invoice_date` BETWEEN '$strat' AND '$end' ORDER BY `invoice_no`.`number`";
						}else{
							$qry="SELECT DISTINCT `invoice_no`.`number` AS `invoice`,`invoice_no`.`status` AS `status`,`customer`.`customer_name` AS `customer`,`invoice`.`invoice_date` AS `date` FROM `invoice_no`,`invoice`,`customer` WHERE `invoice`.`customer_id`=`customer`.`customer_id` AND `invoice_no`.`in_id`=`invoice`.`in_id` AND `invoice`.`customer_id`!='0' ORDER BY `invoice_no`.`number`";
						}
							$confirm=mysqli_query($conn,$qry)or die(mysqli_error());
							
							while($out=mysqli_fetch_array($confirm))
							{ 
						
						 $sn=$sn+1; 
							$num=$out['invoice'];
							$qr="SELECT COUNT(`invoice_no`.`in_id`) AS `items`,(`invoice_no`.`gross_total`-`invoice_no`.`discount`+`invoice_no`.`5%`+`invoice_no`.`12%`+`invoice_no`.`18%`) AS `val`,`invoice_no`.`status` FROM `invoice_no`,`invoice` WHERE `invoice_no`.`in_id`=`invoice`.`in_id` and `invoice_no`.`in_id`='$num';";
							$co=mysqli_query($conn,$qr)or die(mysqli_error());
							$row=mysqli_fetch_array($co);
							$item=$row['items'];
							$val=$row['val'];
                            if($row['status']!=1)
                                $total += $val;
					?>
                <tr <?php if($out['status']=='1'){?> style="background-color:lightpink" ; <?php } ?>>
                    <td style="width: 5%;"><?php echo $sn;?></td>
                    <td style="width: 7%;"><?php echo $out['invoice'];?></td>
                    <td style="width: 30%;"><?php echo $out['customer'];?></td>
                    <td><?php echo date("d-m-Y",strtotime($out['date']));?></td>
                    <td><?php echo $item;?></td>
                    <td><?php echo number_format($val,2);?></td>
                    <td style="text-align: left;"><a href="localbill.php?edit=<?php echo $out['invoice']; ?>"
                            class="input-sm btn btn-success">View</a>
                        <?php if($out['status']!='1'){?>
                        <a href="copytoupdate.php?bill_no=<?php echo $out['invoice']; ?>"
                            class="input-sm btn btn-info">Update</a>
                        <?php } ?>
                    </td>
                </tr>
                <?php  } ?>
            </tbody>
            <thead>
                <th style="width: 5%" ;></th>
                <th style="width: 7%" ;></th>
                <th style="width: 30%" ;></th>
                <th></th>
                <th style="font-size:15pt"><?php echo "Total"; ?></td>
                <th style="font-size:15pt"><?php echo number_format($total,2);?></td>
                <th></th>
                    </tr>
            </thead>
        </table>
    </div>
</body>
<!------table------






</body>
</html>





SELECT `invoice_no`.`number` AS `invoice`,`local_cust`.`local_cust__name` AS `customer`,`invoice`.`invoice_date` AS `date` FROM `invoice_no`,`invoice`,`local_cust` WHERE `invoice`.`Local_cust_id`=`local_cust`.`Local_cust_id` AND `invoice_no`.`in_id`=`invoice`.`in_id` AND `invoice`.`Local_cust_id`!='0' ORDER BY `invoice`.`invoice_date