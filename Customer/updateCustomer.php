<?php
	require("../db_Live.php");
	require("Customer_class_Live.php");

	$objCustomer=new Customer();
	$objCustomer->connect();
	
if($_GET['action']=='delete'){
	if($objCustomer->delete($_GET['idCustomer'])){
		echo "Delete information successfully";
		echo "<meta http-equiv=\"Refresh\" content=\"2;URL=../Customer\">";
	}else{
		echo "Wrongful!! Not delete information";
	}
}else if(!empty($_GET['idCustomer'])){
	$sql="SELECT * FROM Customer WHERE idCustomer='".$_GET['idCustomer']."'";
	$objCustomer->query($sql);
	$row=mysqli_fetch_array($objCustomer->results);
	echo "<!doctype html>
    <html>
    <head>
    <meta charset=\"utf-8\">
    <title>Edit Customer - Amusement Park</title>
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
	<p id='form-header'>Edit Customer</p>
	<form method =\"post\" name=\"Customer\" action=\"updateCustomer.php\">
	
	<table class='table-form-group'>

    <tr><td><label for='id'>ID</label></td>
    <td><input id='id' class='fill receive' type='text' placeholder='Eg. C0001, C0009, C0017...' name='idCustomer' value=".$row['idCustomer']."></td>
    </tr>

    <tr><td><label for='nameCus'>Name</label></td>
    <td><input id='nameCus' class='fill receive' type='text' placeholder='Eg. Jyrki Loewe, Barbar mama, Tracy S. Pratt...' name='nameCustomer' value='".$row['nameCustomer']."'></td>
    </tr>

    <tr><td><label for='telphone'>Telphone Number</label></td>
    <td><input id='telphone' class='fill receive' type='tel' placeholder='Eg. 0800900010, 1298-23344, 42378521...' name='telCustomer' value=".$row['telCustomer']."></td>
    </tr>
    </table>

	<input type=\"hidden\" name=\"PK\" value=\"" .$row['idCustomer']. "\">

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
	if(isset($_POST['idCustomer'])) $objCustomer->idCustomer=$_POST['idCustomer'];
	else $objCustomer->idCustomer='';

	if(isset($_POST['nameCustomer'])) $objCustomer->nameCustomer=$_POST['nameCustomer'];
	else $objCustomer->nameCustomer='';

	if(isset($_POST['telCustomer'])) $objCustomer->telCustomer=$_POST['telCustomer'];
	else $objCustomer->telCustomer='';

	if($objCustomer->update($_POST['PK'])){
		echo "Edit information successfully
		<meta http-equiv=\"Refresh\" content=\"2;URL=../Customer\">";
	}
	
}


$objCustomer->close();

?>