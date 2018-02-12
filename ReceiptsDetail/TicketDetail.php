<?php
require('../db_Live.php');
require('TicketDetail_class.php');

$ObjTicketDetail = new TicketDetail();
$ObjTicketDetail->connect();

$sql = "";
$check = false;
$answer = "";
$totalResults = 0;



    $sql = "";
    if (!empty($_POST['Ticket_ID']) && !empty($_POST['Customer_idCustomer1']) && !empty($_POST['receiveDate'])) {
        $sql = "SELECT * FROM TicketDetail WHERE Ticket_ID LIKE '%" . $_POST['Ticket_ID'] . "%' AND Customer_idCustomer1 LIKE '%" . $_POST['Customer_idCustomer1'] . "%' AND reciveDate LIKE '%" . $_POST['receiveDate'] . "%'";
    } else if (!empty($_POST['Ticket_ID']) && !empty($_POST['Customer_idCustomer1'])) {
        $sql = "SELECT * FROM TicketDetail WHERE Ticket_ID LIKE '%" . $_POST['Ticket_ID'] . "%' AND Customer_idCustomer1 LIKE '%" . $_POST['Customer_idCustomer1'] . "%'";
    } else if (!empty($_POST['Customer_idCustomer1']) && !empty($_POST['receiveDate']) && !empty($_POST['receiveDate'])) {
        $sql = "SELECT * FROM TicketDetail WHERE Customer_idCustomer1 LIKE '%" . $_POST['Customer_idCustomer1'] . "%' AND reciveDate LIKE '%" . $_POST['receiveDate'] . "%'";
    } else if (!empty($_POST['Ticket_ID']) && !empty($_POST['receiveDate'])) {
        $sql = "SELECT * FROM TicketDetail WHERE Ticket_ID LIKE '%" . $_POST['Ticket_ID'] . "%' AND reciveDate LIKE '%" . $_POST['receiveDate'] . "%'";
    } else if (!empty($_POST['Ticket_ID'])) {
        $sql = "SELECT * FROM TicketDetail WHERE Ticket_ID LIKE '%" . $_POST['Ticket_ID'] . "%'";
    } else if (!empty($_POST['Customer_idCustomer1'])) {
        $sql = "SELECT * FROM TicketDetail WHERE Customer_idCustomer1 LIKE '%" . $_POST['Customer_idCustomer1'] . "%'";
    } else if (!empty($_POST['receiveDate'])) {
        $sql = "SELECT * FROM TicketDetail WHERE reciveDate LIKE '%" . $_POST['receiveDate'] . "%'";
    } else {
        $sql = "select * from TicketDetail";
    }


$ObjTicketDetail->query($sql);

$answer = "<table>
<tr class=\"table-header\">
            <th>Receipt NO.</th>
            <th>Order Date</th>
            <th>Receive Date</th>
            <th>Total Price</th>
            <th>Total Ticket</th>
            <th>Customer ID</th>
            <th>Actuation</th>
            </tr>
";

while ($row = mysqli_fetch_array($ObjTicketDetail->results)) {
    $check = true;
    $answer .= "<tr>
            <td>" . $row['Ticket_ID'] . "</td>
            <td>" . $row['orderDate'] . "</td>
            <td>" . $row['reciveDate'] . "</td>
            <td>" . $row['totalPrice'] . "</td>
            <td>" . $row['totalTicket'] . "</td>
            <td><a href=\"../CustomerDetail/CustomerDetail.php?idCustomer=".$row['Customer_idCustomer1']."\">" . $row['Customer_idCustomer1'] . "</a></td>
            <td><a href=\"updateTicketDetail.php?Ticket_ID=" . $row['Ticket_ID'] . "\">Edit</a> |
            <a href=\"updateTicketDetail.php?Ticket_ID=" . $row['Ticket_ID'] . "&action=delete\">Delete</a></td>
            </tr>";
            $totalResults += 1;
}

$answer .= "<tr>
            <td id=\"add\" COLSPAN=7 align=center><a href=\"insertTicketDetail.php\"><b>Add</b></a></td>
        </tr>
    </table>";

$totalResults = "<p>Found ".$totalResults." Result(s).</p>";
if($check){
    echo $answer;
    echo $totalResults;
}else {
    echo $answer = 0;
}


$ObjTicketDetail->close();


?>

