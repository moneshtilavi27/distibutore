<?php
include("connect.php");


?>
<!DOCTYPE html>
<html>
<head>
	<title>MR Agency</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>


<?php
$qry="SELECT * FROM `item`";
$confirm=mysqli_query($conn,$qry)or die(mysqli_error());

echo "<table class='fixed_header1 table table-bordered' id='table'>
		 <thead>
			 <tr>
			<th>Sn</th>
			 <th>Item Name</th>
			 <th>Item HSN</th>
			<th>Item Gst</th>
			<th>Item Unit</th>
			<th>Item Description</th>
			 </tr>
		</thead>
	 <tbody>" ?>
<?php
$sn=0;
while ($row =mysqli_fetch_array($confirm))
{$sn=$sn+1;
	echo "<tr>";
	echo "<td>" . $sn . "</td>";
    echo "<td>" . $row['item_name'] . "</td>";
    echo "<td>" . $row['item_hsn'] . "</td>";
    echo "<td>" . $row['item_gst'] . "</td>";
    echo "<td>" . $row['item_unit'] . "</td>";
    echo "<td>" . $row['item_description'] . "</td>";
    echo "</tr>";
}
?>