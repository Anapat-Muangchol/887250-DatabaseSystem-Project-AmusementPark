<?php
require('../db_Live.php');
require('Customer_class_Live.php');

$ObjCustomer = new Customer();
$ObjCustomer->connect();

$sql = "";
$check = false;
$answer = "";
$totalResults = 0;

$sql = "";
if (!empty($_POST['idCustomer']) && !empty($_POST['nameCustomer']) && !empty($_POST['telCustomer'])) {
    $sql = "SELECT * FROM Customer WHERE idCustomer LIKE '%" . $_POST['idCustomer'] . "%' AND nameCustomer LIKE '%" . $_POST['nameCustomer'] . "%' AND telCustomer LIKE '%" . $_POST['telCustomer'] . "%'";
} else if (!empty($_POST['idCustomer']) && !empty($_POST['nameCustomer'])) {
    $sql = "SELECT * FROM Customer WHERE idCustomer LIKE '%" . $_POST['idCustomer'] . "%' AND nameCustomer LIKE '%" . $_POST['nameCustomer'] . "%'";
} else if (!empty($_POST['nameCustomer']) && !empty($_POST['telCustomer']) && !empty($_POST['telCustomer'])) {
    $sql = "SELECT * FROM Customer WHERE nameCustomer LIKE '%" . $_POST['nameCustomer'] . "%' AND telCustomer LIKE '%" . $_POST['telCustomer'] . "%'";
} else if (!empty($_POST['idCustomer']) && !empty($_POST['telCustomer'])) {
    $sql = "SELECT * FROM Customer WHERE idCustomer LIKE '%" . $_POST['idCustomer'] . "%' AND telCustomer LIKE '%" . $_POST['telCustomer'] . "%'";
} else if (!empty($_POST['idCustomer'])) {
    $sql = "SELECT * FROM Customer WHERE idCustomer LIKE '%" . $_POST['idCustomer'] . "%'";
} else if (!empty($_POST['nameCustomer'])) {
    $sql = "SELECT * FROM Customer WHERE nameCustomer LIKE '%" . $_POST['nameCustomer'] . "%'";
} else if (!empty($_POST['telCustomer'])) {
    $sql = "SELECT * FROM Customer WHERE telCustomer LIKE '%" . $_POST['telCustomer'] . "%'";
}
else {
    $sql = "SELECT * FROM Customer";
}

$ObjCustomer->query($sql);

$answer = "<table>
<tr class=\"table-header\">
            <th> ID</th>
            <th> Name</th>
            <th> Telephone Number</th>
            <th> Actuation</th>
        </tr>
";

while ($row = mysqli_fetch_array($ObjCustomer->results)) {
    $check = true;
    $answer.= "<tr>
    <td><a href=\"../CustomerDetail/CustomerDetail.php?idCustomer=".$row['idCustomer'] . "\" >" . $row['idCustomer'] . "</a></td>
    <td>" . $row['nameCustomer'] . "</td>
    <td>" . $row['telCustomer'] . "</td>
    <td><a href=\"updateCustomer.php?idCustomer=" . $row['idCustomer'] . "\">Edit</a> |
    <a href=\"updateCustomer.php?idCustomer=" . $row['idCustomer'] . "&action=delete\">Delete</a></td>
    </tr>";
    $totalResults += 1;
}

$answer .= "<tr>
            <td id=\"add\" COLSPAN=6 align=center><a href=\"insertCustomer.php\"><b>Add</b></a></td>
        </tr>
    </table>";

$totalResults = "<p>Found ".$totalResults." Result(s).</p>";

if($check){
    echo $answer;
    echo $totalResults;
}else {
    echo $answer = 0;
}

$ObjCustomer->close();

?>