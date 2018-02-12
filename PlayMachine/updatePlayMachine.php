<?php
	require("../db_Live.php");
	require("../Zone/Zone_class.php");
	require("PlayMachine_class.php");

	$objPlayMachine=new PlayMachine();
	$objPlayMachine->connect();
	
if($_GET['action']=='delete'){
	if($objPlayMachine->delete($_GET['idPlayMachine'])){
		echo "Delete information successfully
		<meta http-equiv=\"Refresh\" content=\"2;URL=../PlayMachine\">";
	}else{
		echo "Wrongful!! Not delete information";
	}
}else if(!empty($_GET['idPlayMachine'])){
	$sql="SELECT * FROM PlayMachine WHERE idPlayMachine='".$_GET['idPlayMachine']."'";
	$objPlayMachine->query($sql);
	$row=mysqli_fetch_array($objPlayMachine->results,MYSQL_ASSOC);

	echo "<!doctype html>
    <html>
    <head>
    <meta charset=\"utf-8\">
    <title>Edit Play Machine - Amusement Park</title>
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
	<p id='form-header'>Edit PlayMachine</p>
	<form METHOD =\"post\" name=\"PlayMachine\" action=\"updatePlayMachine.php\">
	<table class='table-form-group'>

	<tr><td><label for='idPlayMachine'>ID</label></td>
	<td><input class='fill receive' type=\"text\" placeholder=\"Eg. MF01, MM01, MX03...\" name=\"idPlayMachine\"  value=\"" .$row['idPlayMachine']. "\"></td>
	</tr>

	<tr><td><label for='namePlayMachinecol'>Name</label></td>
	<td><input class='fill receive' type=\"text\" placeholder=\"Eg. Dino World, Whale Adventure, Take Off...\" name=\"namePlayMachinecol\"  value=\"" .$row['namePlayMachinecol']. "\"></td>
	</tr>

	<tr><td><label for='Zone_idZone'>Zone</label></td>

	<td><select class='sel' name=\"Zone_idZone\">";
    
        $ObjIDZone = new Zone();
        $ObjIDZone->connect();
        $sqlObjIDZone="SELECT * FROM Zone";
        $ObjIDZone->query($sqlObjIDZone);
        while ($Zone = mysqli_fetch_array($ObjIDZone->results)) {
        	if($Zone['idZone']==$row['Zone_idZone']){
        		echo "<option value=\"".$Zone['idZone']."\" selected>".$Zone['nameZone']."</option>";
        	}else{
        		echo "<option value=\"".$Zone['idZone']."\">".$Zone['nameZone']."</option>";
        	}
        }

    echo "
    </select></td>
	</tr>
	
	<tr><td><label for='detail'>Detail</label></td>
	<td><input class='fill receive' type=\"text\" placeholder='Eg. The machine is in an Family Zone...' name=\"detail\"  value=\"" .$row['detail']. "\"></td>
	</tr>
	
	<tr><td><label for='engineer'>Engineer</label></td>
	<td><input class='fill receive' type=\"text\" placeholder='Eg. Anne J. Perron, Terry E. Lawson, Paul B. Hughes...' name=\"engineer\"  value=\"" .$row['engineer']. "\"></td>
	</tr>
	
	<tr><td><label for='supplier'>Supplier</label></td>
	<td><input class='fill receive' type=\"text\" placeholder='Eg. Staff Industries, Steve Industries...' name=\"supplier\"  value=\"" .$row['supplier']. "\"></td>
	</tr>
	</table>

	<input type=\"hidden\" name=\"PK\"  value=\"" .$row['idPlayMachine']. "\">

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

	if(isset($_POST['idPlayMachine'])) $objPlayMachine->idPlayMachine=$_POST['idPlayMachine'];
	else $objPlayMachine->idPlayMachine='';

	if(isset($_POST['namePlayMachinecol'])) $objPlayMachine->namePlayMachinecol=$_POST['namePlayMachinecol'];
	else $objPlayMachine->namePlayMachinecol='';

	if(isset($_POST['Zone_idZone'])) $objPlayMachine->Zone_idZone=$_POST['Zone_idZone'];
	else $objPlayMachine->Zone_idZone='';

	if(isset($_POST['detail'])) $objPlayMachine->detail=$_POST['detail'];
	else $objPlayMachine->detail='';

	if(isset($_POST['engineer'])) $objPlayMachine->engineer=$_POST['engineer'];
	else $objPlayMachine->engineer='';

	if(isset($_POST['supplier'])) $objPlayMachine->supplier=$_POST['supplier'];
	else $objPlayMachine->supplier='';

	if($objPlayMachine->update($_POST['PK'])){
		echo "Edit information successfully";
		echo "<meta http-equiv=\"Refresh\" content=\"2;URL=../PlayMachine\">";
	}
	
}


$objPlayMachine->close();

?>