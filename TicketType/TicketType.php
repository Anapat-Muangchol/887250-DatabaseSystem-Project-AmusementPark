<?php
require('../db_Live.php');
require('TicketType_class.php');
require('../TicketTypeDetail_class.php');

$objTicketType = new TicketType();
$objTicketType->connect();
$objTicketTypeDetail = new TicketTypeDetail();
$objTicketTypeDetail->connect();

$sql = "";
$check = false;
$answer = "";
$totalResults = 0;

$sql = "";
if (!empty($_POST['idType']) && !empty($_POST['nameType']) && !empty($_POST['priceType'])) {
    $sql = "SELECT * FROM TicketType WHERE idType LIKE '%" . $_POST['idType'] . "%' AND nameType LIKE '%" . $_POST['nameType'] . "%' AND priceType LIKE '%" . $_POST['priceType'] . "%'";
} else if (!empty($_POST['idType']) && !empty($_POST['nameType'])) {
    $sql = "SELECT * from TicketType WHERE idType LIKE '%" . $_POST['idType'] . "%' AND nameType LIKE '%" . $_POST['nameType'] . "%'";
} else if (!empty($_POST['nameType']) && !empty($_POST['priceType']) && !empty($_POST['priceType'])) {
    $sql = "SELECT * from TicketType WHERE nameType LIKE '%" . $_POST['nameType'] . "%' AND priceType LIKE '%" . $_POST['priceType'] . "%'";
} else if (!empty($_POST['idType']) && !empty($_POST['priceType'])) {
    $sql = "SELECT * from TicketType WHERE idType LIKE '%" . $_POST['idType'] . "%' AND priceType LIKE '%" . $_POST['priceType'] . "%'";
} else if (!empty($_POST['idType'])) {
    $sql = "SELECT * from TicketType WHERE idType LIKE '%" . $_POST['idType'] . "%'";
} else if (!empty($_POST['nameType'])) {
    $sql = "SELECT * from TicketType WHERE nameType LIKE '%" . $_POST['nameType'] . "%'";
} else if (!empty($_POST['priceType'])) {
    $sql = "SELECT * from TicketType WHERE priceType LIKE '%" . $_POST['priceType'] . "%'";
} else {
    $sql = "SELECT * FROM TicketType";
}

$objTicketType->query($sql);

$answer = "<table>
<tr class=\"table-header\">
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Zone</th>
            <th>Actuation </th>
        </tr>
";

$objTicketType->query($sql);

while ($row = mysqli_fetch_array($objTicketType->results)) {
    $check = true;
    $answer .= "<tr>
            <td>" . $row['idType'] . "</td>
            <td>" . $row['nameType'] . "</td>
            <td>" . $row['priceType'] . "</td>
            <td>";

    $sql1 = "SELECT Zone_idZone from TicketTypeDetail where Type_idType='" . $row['idType'] . "' ";

    $objTicketTypeDetail->query($sql1);
    while ($row1 = mysqli_fetch_array($objTicketTypeDetail->results)) {
        $answer .= $row1['Zone_idZone'] . " ";
    }

    $answer .= "</td>";


    $answer .= "<td><a href=\"updateTicketType.php?idType=" . $row['idType'] . "\">Edit</a> |
            <a href=\"updateTicketType.php?idType=" . $row['idType'] . "&action=delete\">Delete</a></td>
            </tr>";
    $totalResults += 1;

}
$answer .= "<tr>
            <td id=\"add\" COLSPAN=5 align=center><a href=\"insertTicketType.php\"><b>Add</b></a></td>
        </tr>
    </table>";

$totalResults = "<p>Found ".$totalResults." Result(s).</p>";

if($check){
    echo $answer;
    echo $totalResults;
}else {
    echo $answer = 0;
}

$objTicketType->close();
$objTicketTypeDetail->close();



?>

