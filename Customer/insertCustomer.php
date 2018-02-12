<?php
require("../db_Live.php");
require("Customer_class_Live.php");

if (!empty ($_POST['idCustomer'])) {
    $objCustomer = new Customer();
    $objCustomer->idCustomer = $_POST['idCustomer'];
    $objCustomer->nameCustomer = $_POST['nameCustomer'];
    $objCustomer->telCustomer = $_POST['telCustomer'];
    $objCustomer->connect();
    if ($objCustomer->insert()) {
        echo "Insert information successfully";
        echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=../Customer\">";
    } else {
        echo "Wrongful!! Not insert information";
    }
    $objCustomer->close();
} else {
    echo "<!doctype html>
    <HTML>
    <HEAD>
    <meta charset=\"utf-8\">
    <title>Add Customer - Amusement Park</title>
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
    <p id='form-header'> Add Customer</p>
    <form method =\"post\" name=\"Customer\" ACTION=\"insertCustomer.php\">
    <table class='table-form-group'>

    <tr><td><label for='id'>ID</label></td>
    <td><input id='id' class='fill receive' type='text' placeholder='Eg. C0001, C0009, C0017...' name='idCustomer'></td>
    </tr>

    <tr><td><label for='nameCus'>Name</label></td>
    <td><input id='nameCus' class='fill receive' type='text' placeholder='Eg. Jyrki Loewe, Barbar mama, Tracy S. Pratt...' name='nameCustomer'></td>
    </tr>

    <tr><td>
    <label for='telphone'>Telphone Number</label></td>
    <td><input id='telphone' class='fill receive' type='tel' placeholder='Eg. 0800900010, 1298-23344, 42378521...' name='telCustomer'></td>
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