<!DOCTYPE html>
<?php
include("connect.php");
session_start();
$_SESSION['type'];
if ($_SESSION['type']!="admin") {
    header("Location: index.php");
}
?>
<html>

<head>
<title> Shree Shivlingeshwar </title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->

    <!-- jQuery library -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet"> -->

    <!-- Latest compiled JavaScript -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css"> -->


    <link rel="stylesheet" href="plugin/bootstrap.css">
    <!-- jQuery library -->
    <script src="plugin/jquery.js"></script>
    <link href="plugin/fontasome.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="plugin/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">




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
        cursor: pointer;
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

    label {
        color: black;
        font-weight: 500;
    }
    </style>
    <script type="text/javascript">
    function exportTableToExcel(tableID, filename = '') {
        $('#exelhead').css('display','block');
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

        // Specify file name
        filename = filename ? filename + '.xls' : 'excel_data.xls';

        // Create download link element
        downloadLink = document.createElement("a");

        document.body.appendChild(downloadLink);

        if (navigator.msSaveOrOpenBlob) {
            var blob = new Blob(['\ufeff', tableHTML], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob(blob, filename);
        } else {
            // Create a link to the file
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

            // Setting the file name
            downloadLink.download = filename;

            //triggering the function
            downloadLink.click();
        }
        $('#exelhead').css('display','none');
    }
    </script>
</head>

<section class="col-md-12 theam mt-3" style="margin-top: 0px;">
    <div class="row">
        <div class="col-md-1">
            <a href="holesale_customer.php" role="button">
                <h4 style="color:white;" ;>Invoice</h4>
            </a>
        </div>
        <div class="col-md-1">
            <div class="dropdown">
                <div class="dropdown-toggle " data-toggle="dropdown">
                    <h4>Master <i class="fa fa-caret-down" aria-hidden="true"></i></h4>
                </div>
                <ul class="dropdown-menu">
                    <li><a href="additem.php">Item Master</a></li>
                    <li><a href="vendor.php">Supplier</a></li>
                    <li><a href="cust_reg.php">Client</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-1">
            <div class="dropdown">
                <div class="dropdown-toggle" data-toggle="dropdown">
                    <h4>Purchase <i class="fa fa-caret-down" aria-hidden="true"></i></h4>
                </div>
                <ul class="dropdown-menu">
                    <li><a href="purchase.php">Stock Entry</a></li>
                    <li><a href="purchase_return.php">Purchase Return</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-1">
            <div class="dropdown">
                <div class="dropdown-toggle " data-toggle="dropdown">
                    <h4>Report <i class="fa fa-caret-down" aria-hidden="true"></i></h4>
                </div>
                <ul class="dropdown-menu">
                    <li><a href="stock.php">Stock</a></li>
                    <li><a href="purchasebill.php">Purchase Bills</a></li>
                    <li><a href="purch_return.php">Purchase Return Bills</a></li>
                    <li><a href="localsale.php">Sales Bills</a></li>
                    <li><a href="saleitem.php">Sales Items</a></li>
                    <li><a href="ca.php">C A Report</a></li>
            </div>
        </div>
        <div class="col-md-1">
            <a href="logout.php">
                <h4 style="color:white" ;>Logout</h4>
            </a>
        </div>
    </div>
</section>