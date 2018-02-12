<?php
require("../db_Live.php");
require("Zone_class.php");

$objZone = new Zone();
$objZone->connect();

if ($_GET['action'] == 'delete') {
    if ($objZone->delete($_GET['idZone'])) {
        echo "Delete information successfully";
        echo "<meta http-equiv=\"Refresh\" content=\"2;URL=../Zone\">";
    } else {
        echo "Wrongful!! Not delete information";
    }
} else if (!empty($_GET['idZone'])) {
    $sql = "SELECT * FROM Zone WHERE idZone='" . $_GET['idZone'] . "'";
    $objZone->query($sql);
    $row = mysqli_fetch_array($objZone->results, MYSQL_ASSOC);
    echo "<!doctype html>
    <html>
    <head>
    <meta charset=\"utf-8\">
    <title>Edit Zone - Amusement Park</title>
    <meta charset=\"utf-8\"/>
    <meta http-equiv=\"Content-type\" content=\"text/html; charset=utf-8\"/>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\"/>
    <link rel=\"icon\" type=\"image/gif\" href=\"../images/logo.gif\" />
    <link
        href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,700,700italic|Noto+Sans:400,400italic,700,700italic'
        rel='stylesheet' type='text/css'>
    <link href=\"../css/myStyle2.css\" type=\"text/css\" rel=\"stylesheet\">
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

    <div id='content'>
    <div class='form-group'>
    <p id='form-header'>Edit Zone</p>
    <form METHOD =\"post\" name=\"Zone\" action=\"updateZone.php\">
    <table class='table-form-group'>

    <tr><td><label for='idZone'>ID</label></td>
    <td><input class=\"fill receive\" type=\"text\" placeholder=\"Eg. F, FTS, X...\" name=\"idZone\" value=\"" . $row['idZone'] . "\"></td>
    </tr>

    <tr><td><label for='nameZone'>Name</label></td>
    <td><input class=\"fill receive\" type=\"text\" placeholder=\"Eg. Fantasy Zone, Mystery Zone, Extreme Zone...\" name=\"nameZone\" value=\"" . $row['nameZone'] . "\"></td>
    </tr>

    </table>
    <div style='padding-top: 10px'>
    <input class=\"press\" type=\"submit\" VALUE=\"Edit\">&nbsp;&nbsp;
    <input class=\"press\" type=\"reset\" VALUE=\"Cancel\">
    </div>

    </form>
    </div>
    </div>
    </body>
    </html>";

} else {

    if (isset($_POST['idZone'])) $objZone->idZone = $_POST['idZone'];
    else $objZone->idZone = '';

    if (isset($_POST['nameZone'])) $objZone->nameZone = $_POST['nameZone'];
    else $objZone->nameZone = '';

    if ($objZone->update()) {
        echo "Edit information successfully";
        echo "<meta http-equiv=\"Refresh\" content=\"2;URL=../Zone\">";
    }

}


$objZone->close();

?>