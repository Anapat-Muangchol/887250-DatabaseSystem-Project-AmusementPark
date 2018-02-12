<?php
	require("../db_Live.php");
	require("TicketType_class.php");
	require("../TicketTypeDetail_class.php");
	require("../Zone/Zone_class.php");

	$objTicketType=new TicketType();
	$objTicketType->connect();
	$objTicketTypeDetail = new TicketTypeDetail();
	$objTicketTypeDetail->connect();

if($_GET['action']=='delete'){
	$objTicketTypeDetail->delete($_GET['idType']);
	if($objTicketType->delete($_GET['idType'])){
		echo "Delete information successfully
		<meta http-equiv=\"Refresh\" content=\"2;URL=../TicketType\">";
	}else{
		echo "Wrongful!! Not delete information";
	}
}else if(!empty($_GET['idType'])){
	$sql="SELECT * FROM TicketType WHERE idType='".$_GET['idType']."'";
	$objTicketType->query($sql);
	$row=mysqli_fetch_array($objTicketType->results,MYSQL_ASSOC);

	echo "<!doctype html>
    <html>
    <head>
    <meta charset=\"utf-8\">
    <title>Edit Ticket Type - Amusement Park</title>
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
	<form method =\"post\" name=\"TicketType\" ACTION=\"updateTicketType.php\">
	
	<p>Edit Ticket Type</p>
	<table class='table-form-group'>

    <tr><td><label for='idType'>ID</label></td>
    <td><input class=\"fill receive\" id='idType' type=\"text\" placeholder=\"Eg. TDP, TFP, TYP...\" name=\"idType\" value='".$row['idType']."' ></td>
    </tr>

    <tr><td><label for='nameType'>Name</label></td>
    <td><input class=\"fill receive\" id='nameType' type=\"text\" placeholder=\"Eg. Day Pass, Kid Pass, Water Pass...\" name=\"nameType\" value='".$row['nameType']."'></td>
    </tr>

    <tr><td><label for='priceType'>Price</label></td>
    <td><input class=\"fill receive\" id='priceType' type=\"text\" placeholder=\"Eg. 900, 250, 3000...\" name=\"priceType\" value='".$row['priceType']."'></td>
    </tr>

    <tr>
    <td><b>Zone</b></td>
    <td id='selectZone'>";
    	$ObjIDZone = new Zone();
        $ObjIDZone->connect();
        $sqlObjIDZone="SELECT * FROM Zone";
        $ObjIDZone->query($sqlObjIDZone);
        while ($Zone = mysqli_fetch_array($ObjIDZone->results)) {
        	$sql2="SELECT Zone_idZone FROM TicketTypeDetail WHERE Type_idType='".$_GET['idType']."' AND Zone_idZone='".$Zone['idZone']."'";
			$objTicketTypeDetail->query($sql2);
			$row2 = mysqli_fetch_array($objTicketTypeDetail->results);
			if(!empty($row2['Zone_idZone']))echo "<label for='".$Zone['idZone']."'><input type=\"checkbox\" id='".$Zone['idZone']."' name=\"".$Zone['idZone']."\" checked> ".$Zone['nameZone']." </label><br>";
			else echo "<label for='".$Zone['idZone']."'><input type=\"checkbox\" id='".$Zone['idZone']."' name=\"".$Zone['idZone']."\"> ".$Zone['nameZone']." </label><br>";
        }

    echo "</td>
    </tr>
    </table>

	<div style='padding-top: 10px'>
    <input class=\"press\" type=\"submit\" value=\"Edit\">&nbsp;&nbsp;
    <input class=\"press\" type=\"reset\" value=\"Cancel\">
    </div>

	</form>
	</div>
	</div>
	</body>
	</html>";

}else{

	if(isset($_POST['idType'])) $objTicketType->idType=$_POST['idType'];
	else $objTicketType->idType='';

	if(isset($_POST['nameType'])) $objTicketType->nameType=$_POST['nameType'];
	else $objTicketType->nameType='';

	if(isset($_POST['priceType'])) $objTicketType->priceType=$_POST['priceType'];
	else $objTicketType->priceType='';

	$objTicketTypeDetail->Type_idType = $_POST['idType'];
    $objTicketTypeDetail->delete($_POST['idType']);
    
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

	if($objTicketType->update()){
		echo "Edit information successfully
		<meta http-equiv=\"Refresh\" content=\"2;URL=../TicketType\">";
	}
	
}


$objTicketType->close();
$objTicketTypeDetail->close();

?>