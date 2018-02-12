<?php
require("../db_Live.php");
require("../Customer/Customer_class_Live.php");
$sql = "SELECT * FROM Customer where idCustomer = '" . $_GET['idCustomer'] . "'";
$sql1 = "SELECT * FROM TicketDetail where Customer_idCustomer1 = '" . $_GET['idCustomer'] . "'";
//echo $sql."<br>";
$ObjCustomer = new Customer();
$ObjCustomer->connect();
$ObjCustomer->query($sql);
//$ObjCustomer->results;
echo "
<html>
<head>
<title>Customer Detail - Amusement Park</title>
<meta charset=\"utf-8\"/>
 <meta http-equiv=\"Content-type\" content=\"text/html; charset=utf-8\"/>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\"/>
    <link rel=\"icon\" type=\"image/gif\" href=\"../images/logo.gif\" />
    <link
        href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,700,700italic|Noto+Sans:400,400italic,700,700italic'
        rel='stylesheet' type='text/css'>
    <link href=\"../css/cusDetail.css\" type=\"text/css\" rel=\"stylesheet\">
    <link href=\"https://fonts.googleapis.com/icon?family=Material+Icons\"
          rel=\"stylesheet\">
</head>
<body>
<div id=\"topbar\">
    <div id=\"menubar\">
        <ul>
             <li><a href=\"../\">Home</a></li>
            <li><a href=\"../Customer\">Customer</a></li>
            <li><a href=\"../ReceiptsDetail\">Receipts Detail</a></li>
            <li><a href=\"../TicketType\">Ticket Type</a></li>
            <li><a href=\"../Zone\">Zone</a></li>
            <li><a href=\"../PlayMachine\">Play Machine</a></li>
        </ul>
    </div>
</div>

<div id=\"content\">
<div class='receipts card'>

";
if ($row = mysqli_fetch_array($ObjCustomer->results)) {
    echo "


<p class='namePark'>C Y❈ S<br>P A R A D I S E W❈ R L D</p>

<hr>
<div class='customerDetail'>
<table class='table-detail'>
<tr><td>ID : </td><td>" . $row[idCustomer] . "</td></tr>
<tr><td>Name :</td><td>" . $row[nameCustomer] . "</td></tr>
<tr><td>Telephone :</td><td>" . $row[telCustomer] . "</td></tr>
</table>

</div>
    <table style='width:98%' class='table-striped'>
    <tr class='table-header'>
    <th><b>Receipt ID</b></th>
    <th><b>Order Date</b></th>
    <th><b>Receive Date</b></th>
    <th><b>Price</b></th>
    <th><b>Number of Ticket</b></th>
    <th><b>Actuation</b></th>
    </tr>
    ";

    $ObjCustomer->query($sql1);
    while ($row1 = mysqli_fetch_array($ObjCustomer->results)) {
        echo "
        <tr>
        <td align=\"center\">".$row1['Ticket_ID']."</td>
        <td align=\"center\">".$row1['orderDate']."</td>
        <td align=\"center\">".$row1['reciveDate']."</td>
        <td align=\"center\">".$row1['totalPrice']."</td>
        <td align=\"center\">" . $row1['totalTicket'] . "</td>
        <td align=\"center\"><a href=\"../ReceiptsDetail/updateTicketDetail.php?Ticket_ID=" . $row1['Ticket_ID'] . "\">Edit |</a>
        <a href=\"../ReceiptsDetail/updateTicketDetail.php?Ticket_ID=" . $row1['Ticket_id'] . "&action=delete\">Delete</td>
        </tr>
    ";
        $totalTicket+=$row1['totalTicket'];
        $totalPrice+=$row1['totalPrice'];
    }



} else {
    echo "Not Found.";
}
echo "
</table>
<div class='totalPrice'>Total Price: ".$totalPrice." Baht.<br>Total : ".$totalTicket." Ticket(s)</div>
</div>
</div>
</body>
</html>
";

$ObjCustomer->close();

?>