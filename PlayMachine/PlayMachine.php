<?php
require('../db_Live.php');
require('PlayMachine_class.php');

$ObjPlayMachine = new PlayMachine();
$ObjPlayMachine->connect();

$sql = "";
$check = false;
$answer = "";
$totalResults = 0;

$sql = "";
if (!empty($_POST['idPlayMachine']) && !empty($_POST['namePlayMachinecol']) && !empty($_POST['Zone_idZone'])) {
    $sql = "SELECT * FROM PlayMachine WHERE idPlayMachine LIKE '%" . $_POST['idPlayMachine'] . "%' AND namePlayMachinecol LIKE '%" . $_POST['namePlayMachinecol'] . "%' AND Zone_idZone LIKE '%" . $_POST['Zone_idZone'] . "%'";
} else if (!empty($_POST['idPlayMachine']) && !empty($_POST['namePlayMachinecol'])) {
    $sql = "SELECT * FROM PlayMachine WHERE idPlayMachine LIKE '%" . $_POST['idPlayMachine'] . "%' AND namePlayMachinecol LIKE '%" . $_POST['namePlayMachinecol'] . "%'";
} else if (!empty($_POST['namePlayMachinecol']) && !empty($_POST['Zone_idZone']) && !empty($_POST['Zone_idZone'])) {
    $sql = "SELECT * FROM PlayMachine WHERE namePlayMachinecol LIKE '%" . $_POST['namePlayMachinecol'] . "%' AND Zone_idZone LIKE '%" . $_POST['Zone_idZone'] . "%'";
} else if (!empty($_POST['idPlayMachine']) && !empty($_POST['Zone_idZone'])) {
    $sql = "SELECT * FROM PlayMachine WHERE idPlayMachine LIKE '%" . $_POST['idPlayMachine'] . "%' AND Zone_idZone LIKE '%" . $_POST['Zone_idZone'] . "%'";
} else if (!empty($_POST['idPlayMachine'])) {
    $sql = "SELECT * FROM PlayMachine WHERE idPlayMachine LIKE '%" . $_POST['idPlayMachine'] . "%'";
} else if (!empty($_POST['namePlayMachinecol'])) {
    $sql = "SELECT * FROM PlayMachine WHERE namePlayMachinecol LIKE '%" . $_POST['namePlayMachinecol'] . "%'";
} else if (!empty($_POST['Zone_idZone'])) {
    $sql = "SELECT * FROM PlayMachine WHERE Zone_idZone LIKE '%" . $_POST['Zone_idZone'] . "%'";
} else {
    $sql = "select * from PlayMachine";
}

$ObjPlayMachine->query($sql);

$answer = "<table>
<tr class=\"table-header\">
           <th>ID</th>
           <th>Name</th>
           <th>Zone</th>
           <th>Detail</th>
           <th>Engineer</th>
           <th>Supplier</th>
           <th> Actuation </th>
       </tr>
";

while ($row = mysqli_fetch_array($ObjPlayMachine->results)) {
    $check = true;
    $answer .= "<tr>
    <td>" . $row['idPlayMachine'] . "</td>
    <td>" . $row['namePlayMachinecol'] . "</td>
    <td>" . $row['Zone_idZone'] . "</td>
    <td>" . $row['detail'] . "</td>
    <td>" . $row['engineer'] . "</td>
    <td>" . $row['supplier'] . "</td>
    <td><a href=\"updatePlayMachine.php?idPlayMachine=" . $row['idPlayMachine'] . "\">Edit</a> |
    <a href=\"updatePlayMachine.php?idPlayMachine=" . $row['idPlayMachine'] . "&action=delete\">Delete</a></td>
    </tr>";
    $totalResults += 1;
}

$answer .= "<tr>
            <td id=\"add\" COLSPAN=7 align=center><a href=\"insertPlayMachine.php\"><b>Add</b></a></td>
        </tr>
    </table>";

$totalResults = "<p>Found ".$totalResults." Result(s).</p>";

if($check){
    echo $answer;
    echo $totalResults;
}else {
    echo $answer = 0;
}

$ObjPlayMachine->close();

?>

