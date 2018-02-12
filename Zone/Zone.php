<?php
require('../db_Live.php');
require('Zone_class.php');

$objZone = new Zone();
$objZone->connect();

$sql = "";
$check = false;
$answer = "";
$totalResults = 0;

$sql = "";
if (!empty($_POST['idZone']) && !empty($_POST['nameZone'])) {
    $sql = "SELECT * FROM Zone WHERE idZone LIKE '%" . $_POST['idZone'] . "%' AND nameZone LIKE '%" . $_POST['nameZone'] . "%'";
} else if (!empty($_POST['idZone']) && empty($_POST['nameZone'])) {
    $sql = "SELECT * FROM Zone WHERE idZone LIKE '%" . $_POST['idZone'] . "%'";
} else if (!empty($_POST['nameZone'])) {
    $sql = "SELECT * FROM Zone WHERE nameZone LIKE '%" . $_POST['nameZone'] . "%'";
} else {
    $sql = "SELECT * FROM Zone";
}

$objZone->query($sql);

$answer = "<table>
            <tr class=\"table-header\">
            <th> ID</th>
            <th> Name</th>
            <th> Actuation</th>
            </tr>
";

while ($row = mysqli_fetch_array($objZone->results)) {
    $check = true;
    $answer .= "<tr>
    <td>" . $row['idZone'] . "</td>
    <td>" . $row['nameZone'] . "</td>
    <td><a href=\"updateZone.php?idZone=" . $row['idZone'] . "\">Edit</a> |
    <a href=\"updateZone.php?idZone=" . $row['idZone'] . "&action=delete\">Delete</a></td>
    </tr>";
    $totalResults += 1;
}

$answer .= "<tr>
            <td id=\"add\" COLSPAN=3 align=center><a href=\"insertZone.php\"><b>Add</b></a></td>
        </tr>
    </table>";

$totalResults = "<p>Found ".$totalResults." Result(s).</p>";
if($check){
    echo $answer;
    echo $totalResults;
}else {
    echo $answer = 0;
}

$objZone->close();

?>

