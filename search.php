<?php
include("connect.php");
$term = $_POST[ "query" ];
$output = '';
$sql = "SELECT * FROM `vendor` WHERE `vender_name`LIKE '%".$term."%';";
//$sql ="select * from `resister`";
$result = $conn->query($sql);
$output = '<ul class="list-unstyled">';
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc())
    {
    	$name=$row['vender_name'];
    	$j = strlen($term);
		    for ($i = 0; $i < $j; $i++) {
		   	
			   	if(strcasecmp($name[$i],$term[$i])==0)
			   	{
			   		 $string3="true";
			   	}else{
			   		$string3="false";
			   		break;
			   	}
		    }
		    if($string3=="true")
		    {
		    	 $output .='<li id="li2">'.$name.'</li>';
		    }
    } 
}
 else 
 {
    //echo "0 results";
     $output .= '<li>"data not found"</li>';
 }
$output .='</ul>';
echo $output;

$conn->close();
?>