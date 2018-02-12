<?php
require("../db_Live.php");
require("TicketDetail_class.php");
require("../TicketType/TicketType_class.php");
require("../Customer/Customer_class_Live.php");
require("../numOfTicket_class.php");


if (!empty ($_POST['Ticket_ID'])) {
    $objTicketDetail = new TicketDetail();
    $objTicketDetail->Ticket_ID = $_POST['Ticket_ID'];
    $objTicketDetail->orderDate = $_POST['orderDate'];
    $objTicketDetail->receiveDate = $_POST['receiveDate'];
    $objTicketDetail->Customer_idCustomer1 = $_POST['Customer_idCustomer1'];
    $objTicketDetail->totalTicket = 0;
    $objTicketDetail->totalPrice = 0;
    $objTicketDetail->connect();
    if ($objTicketDetail->insert()) {
        echo "Insert information successfully
        <META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=../ReceiptsDetail\">";
    } else {
        echo "Wrongful!! Not insert information";
    }

    $ObjTicketType = new TicketType();
    $ObjTicketType->connect();
    $sqlObjTicketType="SELECT * FROM TicketType";
    $ObjTicketType->query($sqlObjTicketType);
    while($TicketType = mysqli_fetch_array($ObjTicketType->results)){
        //echo $_POST[$index[$i]]." ".$TicketType['idType']."<br>";
        if ($_POST[$TicketType['idType']] > 0) {
            $objnumOfTicket = new numOfTicket();
            $objnumOfTicket->connect();
            $objnumOfTicket->TicketType_idType = $TicketType['idType'];
            $objnumOfTicket->TicketDetail_Ticket_ID = $_POST['Ticket_ID'];
            $objnumOfTicket->numOfTicket = $_POST[$TicketType['idType']];
            $objnumOfTicket->insert();
            $objnumOfTicket->close();
            $objTicketDetail->totalPrice = $objTicketDetail->totalPrice + ($TicketType['priceType'] * $_POST[$TicketType['idType']]);
            $objTicketDetail->totalTicket+=$_POST[$TicketType['idType']];
        }
    }

    //echo $objTicketDetail->totalPrice." <br> ".$objTicketDetail->totalTicket;
    $objTicketDetail->update2($objTicketDetail->totalPrice, $objTicketDetail->totalTicket);
    $objTicketDetail->close();
    $objTicketType->close();
} else {
    echo "<!doctype html>
    <html>
    <head>
    <meta charset=\"utf-8\">
    <title>Add Receipt - Amusement Park</title>
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
    <p id='form-header'> Add Receipt</p>

    <form method =\"post\" name=\"TicketDetail\" action=\"insertTicketDetail.php\">
    <table class=\"table-form-group\">
    
    <tr><td><label for='Ticket_ID'>Receipt No. :</label></td>
    <td><input class=\"fill receive\" id='Ticket_ID' type=\"text\" placeholder='Eg. RC0001, RC0005, RC0010...' name=\"Ticket_ID\"  ></td>
    </tr>
    
    <tr><td><label for='Customer_idCustomer1'>Customer Name :</label></td>
    <td><select class='sel' id='Customer_idCustomer1' name=\"Customer_idCustomer1\">";
    
        $ObjCustomer = new Customer();
        $ObjCustomer->connect();
        $sqlObjCustomer="SELECT * FROM Customer";
        $ObjCustomer->query($sqlObjCustomer);
        echo "<option value=\"\">Select Customer</option>";
        while ($Cus = mysqli_fetch_array($ObjCustomer->results)) {
            echo "<option value=\"".$Cus['idCustomer']."\">".$Cus['nameCustomer']."</option>";
        }

    echo "
    </select></td>
    </tr>

    <tr><td><label for='orderDate'>Order Date :</label></td>
    <td><input class=\"fill receive\" id='orderDate' placeholder='YYYY-MM-DD' type=\"date\" name=\"orderDate\"></td>
    </tr>

    <tr><td><label for='receiveDate'>Receive Date :</label></td>
    <td><input class=\"fill receive\" id='receiveDate' placeholder='YYYY-MM-DD' type=\"date\" name=\"receiveDate\"  ></td>
    </tr>


    <tr style='margin-top: 5px'>
    <td colspan='2' style='border-top: 1px solid orange'>
    <p style='text-align: center'><b>Number of tickets</b></p>
    </td>
    <td style='border-top: 1px solid orange'></td>
    </tr>";

    $ObjTicketType = new TicketType();
    $ObjTicketType->connect();
    $sqlObjTicketType="SELECT * FROM TicketType";
    $ObjTicketType->query($sqlObjTicketType);
    while ($TicketType = mysqli_fetch_array($ObjTicketType->results)) {
        echo "<tr><td align='center' colspan='2'> ".$TicketType['nameType']." <input class=\"fill\" type=\"number\" min=\"0\" name=\"".$TicketType['idType']."\"  value=\"0\"></td></tr>";
    }

    echo "
    <tr ALIGN=\"CENTER\">
    <td colspan='2'>
    <input class=\"press\" type=\"submit\" VALUE=\"Add\">&nbsp;&nbsp;
    <input class=\"press\" type=\"reset\" VALUE=\"Cancel\">
    </td>
    </tr>
    </form>

    </div>
    </div>
    </body>
    </html>";
}

?>