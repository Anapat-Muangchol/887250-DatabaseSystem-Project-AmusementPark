<?php
require("../db_Live.php");
require("TicketType_class.php");
require("../TicketTypeDetail_class.php");
require("../Zone/Zone_class.php");

if (!empty ($_POST['idType'])) {

    $objTicketType = new TicketType();
    $objTicketType->idType = $_POST['idType'];
    $objTicketType->nameType = $_POST['nameType'];
    $objTicketType->priceType = $_POST['priceType'];
    $objTicketType->connect();
    if ($objTicketType->insert()) {
        echo "Insert information successfully";
    } else {
        echo "Wrongful!! Not insert information";
    }
    $objTicketType->close();

    $objTicketTypeDetail = new TicketTypeDetail();
    $objTicketTypeDetail->Type_idType = $_POST['idType'];
    $objTicketTypeDetail->connect();
    
    $ObjIDZone = new Zone();
    $ObjIDZone->connect();
    $sqlObjIDZone="SELECT * FROM Zone";
    $ObjIDZone->query($sqlObjIDZone);
    
    while($Zone = mysqli_fetch_array($ObjIDZone->results)){
        //echo $_POST[$index[$i]]." ".$Zone['idZone']."<br>";
        if(!empty($_POST[$Zone['idZone']])){
            $objTicketTypeDetail->insert($Zone['idZone']);
        }
    }
    
    echo "<meta http-equiv=\"Refresh\" content=\"2;URL=../TicketType\">";
    $objTicketTypeDetail->close();

} else {
    echo "<!doctype html>
    <html>
    <head>
    <meta charset=\"utf-8\">
    <title>Add Ticket Type - Amusement Park</title>
    <meta charset=\"utf-8\"/>
    <meta http-equiv=\"Content-type\" content=\"text/html; charset=utf-8\"/>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\"/>
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
    <p id='form-header'>Add TicketType</p>
    
    <form method =\"post\" name=\"TicketType\" action=\"insertTicketType.php\">
    <table class='table-form-group'>

    <tr><td><label for='idType'>ID</label></td>
    <td><input class=\"fill receive\" id='idType' type=\"text\" placeholder='Eg. TDP, TFP, TYP...' name=\"idType\" ></td>
    </tr>

    <tr><td><label for='nameType'>Name</label></td>
    <td><input class=\"fill receive\" id='nameType' type=\"text\" placeholder='Eg. Day Pass, Kid Pass, Water Pass...' name=\"nameType\" ></td>
    </tr>

    <tr><td><label for='priceType'>Price</label></td>
    <td><input class=\"fill receive\" id='priceType' type=\"text\" placeholder='Eg. 900, 250, 3000...' name=\"priceType\" ></td>
    </tr>

    <tr>
    <td><b>Zone</b></td>
    <td id='selectZone'>";
        $ObjIDZone = new Zone();
        $ObjIDZone->connect();
        $sqlObjIDZone="SELECT * FROM Zone";
        $ObjIDZone->query($sqlObjIDZone);
        while ($Zone = mysqli_fetch_array($ObjIDZone->results)) {
            echo "<label for='".$Zone['idZone']."'><input type=\"checkbox\" id='".$Zone['idZone']."' name=\"".$Zone['idZone']."\"> ".$Zone['nameZone']." </label><br>";
        }
    echo "
    </td>
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