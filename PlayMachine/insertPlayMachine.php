<?php
require("../db_Live.php");
require("../Zone/Zone_class.php");
require("PlayMachine_class.php");

if (!empty ($_POST['idPlayMachine'])) {
    $objPlayMachine = new PlayMachine();
    $objPlayMachine->idPlayMachine = $_POST['idPlayMachine'];
    $objPlayMachine->namePlayMachinecol = $_POST['namePlayMachinecol'];
    $objPlayMachine->Zone_idZone = $_POST['Zone_idZone'];
    $objPlayMachine->detail = $_POST['detail'];
    $objPlayMachine->engineer = $_POST['engineer'];
    $objPlayMachine->supplier = $_POST['supplier'];
    $objPlayMachine->connect();
    if ($objPlayMachine->insert()) {
        echo "Insert information successfully
        <meta HTTP-EQUIV=\"Refresh\" content=\"2;URL=../PlayMachine\">";
    } else {
        echo "Wrongful!! Not insert information";
    }
    $objPlayMachine->close();
} else {
    echo "<!doctype html>
    <html>
    <head>
    <meta charset=\"utf-8\">
    <title>Add Play Machine - Amusement Park</title>
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
    <p id='form-header'> Add PlayMachine</p>

    <form method =\"post\" name=\"PlayMachine\" action=\"insertPlayMachine.php\">
    <table class='table-form-group'>

    <tr><td><label for='idPlayMachine'>ID</label></td>
    <td><input id='idPlayMachine' class=\"fill receive\" type=\"text\" placeholder=\"Eg. MF01, MM01, MX03...\" name=\"idPlayMachine\"  ></td>
    </tr>

    <tr><td><label for='namePlayMachinecol'>Name</label></td>
    <td><input id='namePlayMachinecol' class=\"fill receive\" type=\"text\" placeholder=\"Eg. Dino World, Whale Adventure, Take Off...\" name=\"namePlayMachinecol\"  ></td>
    </tr>

    <tr><td><label for='Zone_idZone'>Zone</label></td>
    <td><select id='Zone_idZone' class='sel' name=\"Zone_idZone\">";
    
        $ObjIDZone = new Zone();
        $ObjIDZone->connect();
        $sqlObjIDZone="SELECT * FROM Zone";
        $ObjIDZone->query($sqlObjIDZone);
        echo "<option value=\"\">Select Zone</option>";
        while ($Zone = mysqli_fetch_array($ObjIDZone->results)) {
            echo "<option value=\"".$Zone['idZone']."\">".$Zone['nameZone']."</option>";
        }

    echo "
    </select></td>
    </tr>

    <tr><td><label for='detail'>Detail</label></td>
    <td><input id='detail' class=\"fill receive\" type=\"text\" placeholder='Eg. The machine is in an Family Zone...' name=\"detail\"  ></td>
    </tr>

    <tr><td><label for='engineer'>Engineer</label></td>
    <td><input id='engineer' class=\"fill receive\" placeholder='Eg. Anne J. Perron, Terry E. Lawson, Paul B. Hughes...' type=\"text\" name=\"engineer\"  ></td>
    </tr>

    <tr><td><label for='supplier'>Supplier</label></td>
    <td><input id='supplier' class=\"fill receive\" placeholder='Eg. Staff Industries, Steve Industries...' type=\"text\" name=\"supplier\"  ></td>
    </tr>
    </table>

    <div style='padding-top: 10px'>
    <input class=\"press\" type=\"submit\" value=\"Add\">&nbsp;&nbsp;
    <input class=\"press\" type=\"reset\" value=\"Clear\">
    </div>

    </form>
    </div>
    </div>
    </body>
    </html>";
}

?>