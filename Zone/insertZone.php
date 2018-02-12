<?php
require("../db_Live.php");
require("Zone_class.php");

if (!empty ($_POST['idZone'])) {
    $objZone = new Zone();
    $objZone->idZone = $_POST['idZone'];
    $objZone->nameZone = $_POST['nameZone'];
    $objZone->connect();
    if ($objZone->insert()) {
        echo "Insert information successfully";
        echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=../Zone\">";
    } else {
        echo "Wrongful!! Not insert information";
    }
    $objZone->close();
} else {
    echo "<!doctype html>
    <HTML>
    <HEAD>
    <meta charset=\"utf-8\">
    <title>Add Zone - Amusement Park</title>
    <meta charset=\"utf-8\"/>
    <meta http-equiv=\"Content-type\" content=\"text/html; charset=utf-8\"/>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\"/>
    <link rel=\"icon\" type=\"image/gif\" href=\"../images/logo.gif\" />
    <link
        href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,700,700italic|Noto+Sans:400,400italic,700,700italic'
        rel='stylesheet' type='text/css'>
    <link href=\"../css/myStyle2.css\" type=\"text/css\" rel=\"stylesheet\">
    </HEAD>
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
    <p id='form-header'> Add Zone</p>

    <form method =\"post\" name=\"Zone\" action=\"insertZone.php\">
    <table class=\"table-form-group\">

    <tr><td><label for='idZone'>ID</label></td>
    <td><input class=\"fill receive\" type=\"text\" placeholder=\"Eg. F, FTS, X...\" name=\"idZone\"></td>
    </tr>

    <tr><td><label for='nameZone'>Name</label></td>
    <td><input class=\"fill receive\" placeholder=\"Eg. Fantasy Zone, Mystery Zone, Extreme Zone...\" type=\"text\" name=\"nameZone\"></td>
    </tr>
    </table>

    <div style='padding-top: 10px'>
    <input class=\"press\" type=\"submit\" VALUE=\"Add\">&nbsp;&nbsp;
    <input class=\"press\" type=\"reset\" VALUE=\"Clear\">
    </div>

    </form>
    </div>
    </div>
    </body>
    </html>";
}

?>