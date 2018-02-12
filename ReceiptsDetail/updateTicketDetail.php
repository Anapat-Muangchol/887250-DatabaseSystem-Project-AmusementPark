<?php
	require("../db_Live.php");
	require("TicketDetail_class.php");
	require("../TicketType/TicketType_class.php");
    require("../Customer/Customer_class_Live.php");
	require("../numOfTicket_class.php");

	$objTicketDetail=new TicketDetail();
	$objTicketDetail->connect();
	$objnumOfTicket=new numOfTicket();
    $objnumOfTicket->connect();

if($_GET['action']=='delete'){
	$objnumOfTicket->delete($_GET['Ticket_ID']);
	if($objTicketDetail->delete($_GET['Ticket_ID'])){
		echo "Delete information successfully
		<meta http-equiv=\"Refresh\" content=\"2;URL=../ReceiptsDetail\">";
	}else{
		echo "Wrongful!! Not delete information";
	}
}else if(!empty($_GET['Ticket_ID'])){
	$sql="SELECT * FROM TicketDetail WHERE Ticket_ID='".$_GET['Ticket_ID']."'";
	$objTicketDetail->query($sql);
	$row=mysqli_fetch_array($objTicketDetail->results,MYSQL_ASSOC);

     $orDate = explode("-",$row['orderDate']);
    $recDate = explode("-",$row['reciveDate']);

	echo "<!doctype html>
    <html>
    <head>
    <meta charset=\"utf-8\">
    <title>Edit Receipt - Amusement Park</title>
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
<p id='form-header'>Edit Receipt</p>

	<form method =\"post\" name=\"TicketDetail\" action=\"updateTicketDetail.php\">
	<table class=\"table-form-group\">

    <tr><td><label for='Ticket_ID'>Receipt No. :</label></td>
    <td><input class=\"fill receive\" id='Ticket_ID' type=\"text\" placeholder='Eg. RC0001, RC0005, RC0010...' name=\"Ticket_ID\"  value=\"".$row['Ticket_ID']."\"></td>
    </tr>

    <tr><td><label for='Customer_idCustomer1'>Customer Name :</label></td>
    <td><select class='sel' id='Customer_idCustomer1' name=\"Customer_idCustomer1\">";
    
        $ObjCustomer = new Customer();
        $ObjCustomer->connect();
        $sqlObjCustomer="SELECT * FROM Customer";
        $ObjCustomer->query($sqlObjCustomer);
        echo "<option value=\"\">Select Customer</option>";
        while ($Cus = mysqli_fetch_array($ObjCustomer->results)) {
            if($Cus['idCustomer']==$row['Customer_idCustomer1']){
                echo "<option value=\"".$Cus['idCustomer']."\" selected>".$Cus['nameCustomer']."</option>";
            }else{
                echo "<option value=\"".$Cus['idCustomer']."\">".$Cus['nameCustomer']."</option>";
            }
        }

    echo "
    </select></td>
    </tr>

    <tr><td><label for='orderDate'>Order Date :</label></td>
    <td><input class=\"fill receive\" id='orderDate' placeholder='YYYY-MM-DD' type=\"date\" name=\"orderDate\"  value=\"".$orDate[0]."-".$orDate[1]."-".$orDate[2]."\"></td>
    </tr>

    <tr><td><label for='receiveDate'>Receive Date :</label></td>
    <td><input class=\"fill receive\" id='receiveDate' placeholder='YYYY-MM-DD' type=\"date\" name=\"receiveDate\"  value=\"".$recDate[0]."-".$recDate[1]."-".$recDate[2]."\"></td>
    </tr>
   
    <input TYPE=\"hidden\" name=\"PK\"  value=\"" .$row['Ticket_ID']. "\">
    
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
        echo "<tr><td align='center' colspan='2'> ".$TicketType['nameType']." <input class=\"fill\" type=\"number\" min=\"0\" name=\"".$TicketType['idType']."\"  value=\"";
        $sql2="SELECT * FROM numOfTicket WHERE TicketDetail_Ticket_ID='".$_GET['Ticket_ID']."' AND TicketType_idType='".$TicketType['idType']."'";
        $objnumOfTicket->query($sql2);
        $row2=mysqli_fetch_array($objnumOfTicket->results,MYSQL_ASSOC);
        if(!empty($row2['numOfTicket']))echo $row2['numOfTicket']."\"></td>";
        else echo "0\"></td></tr>"; 
    }

    echo "<tr ALIGN=\"CENTER\">
    <td COLSPAN =2>
    <input class=\"press\" TYPE=\"submit\" VALUE=\"Edit\">&nbsp;&nbsp;
    <input class=\"press\" TYPE=\"reset\" VALUE=\"Cancel\">
    </td>
    </tr>
    </form>
    </center>
    </div>
    </div>
    </body>
    </html>";

}else{

	if(isset($_POST['Ticket_ID'])) $objTicketDetail->Ticket_ID=$_POST['Ticket_ID'];
	else $objTicketDetail->Ticket_ID='';

	if(isset($_POST['orderDate'])) $objTicketDetail->orderDate=$_POST['orderDate'];
	else $objTicketDetail->orderDate='';

	if(isset($_POST['receiveDate'])) $objTicketDetail->receiveDate=$_POST['receiveDate'];
	else $objTicketDetail->receiveDate='';

	if(isset($_POST['Customer_idCustomer1'])) $objTicketDetail->Customer_idCustomer1=$_POST['Customer_idCustomer1'];
	else $objTicketDetail->Customer_idCustomer1='';

    $objTicketDetail->totalTicket = 0;
    $objTicketDetail->totalPrice = 0;

    $objnumOfTicket=new numOfTicket();
    $objnumOfTicket->connect();
    $objnumOfTicket->delete($_POST['Ticket_ID']);
    $objnumOfTicket->close();

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
    
	if($objTicketDetail->update($_POST['PK'])){
		echo "Edit information successfully  <meta http-equiv=\"Refresh\" content=\"2;URL=../ReceiptsDetail\">";
	}
	
}


$objTicketDetail->close();

?>