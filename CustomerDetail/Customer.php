<!doctype html>
<html>
<head>
    <title>Customer List - Amusement Park</title>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link
        href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,700,700italic|Noto+Sans:400,400italic,700,700italic'
        rel='stylesheet' type='text/css'>
    <link href="tablePage.css" type="stylesheet" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
</head>
<body>
<div id="topbar">
    <div id="menubar">
        <ul>
            <li><a href="pageIndex.php">Home</a></li>
            <li><a href="Customer.php">Customer</a></li>
            <li><a href="TicketDetail.php">Receipts Detail</a></li>
            <li><a href="TicketType.php">Ticket Type</a></li>
            <li><a href="Zone.php">Zone</a></li>
            <li><a href="PlayMachine.php">Play Machine</a></li>
        </ul>
    </div>
</div>
    <div id="content">

    <?php
    require('db.php');
    require('Customer_class.php');

    $ObjCustomer = new Customer();
    $ObjCustomer->connect();

    if(!empty($_POST['idCustomer']) || !empty($_POST['nameCustomer']) || !empty($_POST['telCustomer'])){
        //echo "Search";
        echo "<table class=\"pure-table table-striped\">";
        echo "<tr><td colspan=\"5\">";
        echo "<FORM METHOD =\"post\" NAME=\"Customer\" ACTION=\"Customer.php\">";
        echo "<CENTER>";
        echo "<TABLE class=\"table table-bordered\" style =\"width:70%\">";
        echo "<TR ALIGN=\"center\">";
        echo "<TD> ID </TD><TD> Name </TD><TD> Telephone Number </TD>";
        echo "</TR>";
        echo "<TR ALIGN=\"center\">";
        echo "<TD> <INPUT class=\"fill\" TYPE=\"text\" NAME=\"idCustomer\" value=\"" .$_POST['idCustomer']. "\"> </TD>
              <TD> <INPUT class=\"fill\" TYPE=\"text\" NAME=\"nameCustomer\" value=\"" .$_POST['nameCustomer']. "\"> </TD>
              <TD> <INPUT class=\"fill\" TYPE=\"text\" NAME=\"telCustomer\" value=\"" .$_POST['telCustomer']. "\"> </TD>";
        echo "</TR>";
        echo "<TR ALIGN=\"right\">";
        echo "<TD></TD>";
        echo "<TD></TD>";
        echo "<TD>";
        echo "<INPUT class=\"press\" TYPE=\"submit\" VALUE=\"Search\">&nbsp;&nbsp;";
        echo "</TD>";
        echo "</TR>";


        echo "</td></tr>";
        echo "</table></CENTER></form>";
        //echo "<br><br>";

        echo "<table class=\"pure-table table-striped card\">";
        echo "<tr><td colspan=\"5\"><p style=\"text-align:center\"><b>Customer List</b></p></td></tr>";
        echo "<tr class=\"pure-table-th\">";    
        echo "<th> ID </th>";      
        echo "<th> Name </th>";     
        echo "<th> Telephone Number </th>";    
        echo "<th> Actuation </th>";      
        echo "</tr>"; 

        $sql="";
        if(!empty($_POST['idCustomer']) && !empty($_POST['nameCustomer']) && !empty($_POST['telCustomer'])){
            $sql = "SELECT * FROM Customer WHERE idCustomer LIKE '%".$_POST['idCustomer']."%' AND nameCustomer LIKE '%".$_POST['nameCustomer']."%' AND telCustomer LIKE '%".$_POST['telCustomer']."%'";
        }else if(!empty($_POST['idCustomer']) && !empty($_POST['nameCustomer'])){
            $sql = "SELECT * FROM Customer WHERE idCustomer LIKE '%".$_POST['idCustomer']."%' AND nameCustomer LIKE '%".$_POST['nameCustomer']."%'";
        }else if(!empty($_POST['nameCustomer']) && !empty($_POST['telCustomer']) && !empty($_POST['telCustomer'])){
            $sql = "SELECT * FROM Customer WHERE nameCustomer LIKE '%".$_POST['nameCustomer']."%' AND telCustomer LIKE '%".$_POST['telCustomer']."%'";
        }else if(!empty($_POST['idCustomer']) && !empty($_POST['telCustomer'])){
            $sql = "SELECT * FROM Customer WHERE idCustomer LIKE '%".$_POST['idCustomer']."%' AND telCustomer LIKE '%".$_POST['telCustomer']."%'";
        }else if(!empty($_POST['idCustomer'])){
            $sql = "SELECT * FROM Customer WHERE idCustomer LIKE '%".$_POST['idCustomer']."%'";
        }else if(!empty($_POST['nameCustomer'])){
            $sql = "SELECT * FROM Customer WHERE nameCustomer LIKE '%".$_POST['nameCustomer']."%'";
        }else if(!empty($_POST['telCustomer'])){
            $sql = "SELECT * FROM Customer WHERE telCustomer LIKE '%".$_POST['telCustomer']."%'";
        }
        
        $ObjCustomer->query($sql);

        while ($row = mysqli_fetch_array($ObjCustomer->results)) {
            echo "<tr>";
            echo "<td><b><a href=\"CustomerDetail.php?idCustomer=".$row['idCustomer'] . "\" >" . $row['idCustomer'] . "</b></td>";
            echo "<td><b>" . $row['nameCustomer'] . "</b></td>";
            echo "<td><b>" . $row['telCustomer'] . "</b></td>";
            echo "<td><b><a href=\"updateCustomer.php?idCustomer=" . $row['idCustomer'] . "\">Edit</a> | ";
            echo "<a href=\"updateCustomer.php?idCustomer=" . $row['idCustomer'] . "&action=delete\">Delete</a></b></td>";
            echo "</tr>";
        }
        $ObjCustomer->close();
    }else{
        echo "<table class=\"pure-table table-striped\">";
        echo "<tr><td colspan=\"5\">";
        echo "<FORM METHOD =\"post\" NAME=\"Customer\" ACTION=\"Customer.php\">";
        echo "<CENTER>";
        echo "<TABLE class=\"table table-bordered\" style =\"width:70%\">";
        echo "<TR ALIGN=\"center\">";
        echo "<TD> ID </TD><TD> Name </TD><TD> Telephone Number </TD>";
        echo "</TR>";
        echo "<TR ALIGN=\"center\">";
        echo "<TD> <INPUT class=\"fill\" TYPE=\"text\" NAME=\"idCustomer\" > </TD>
              <TD> <INPUT class=\"fill\" TYPE=\"text\" NAME=\"nameCustomer\" > </TD>
              <TD> <INPUT class=\"fill\" TYPE=\"text\" NAME=\"telCustomer\" > </TD>";
        echo "</TR>";
        echo "<TR ALIGN=\"right\">";
        echo "<TD></TD>";
        echo "<TD></TD>";
        echo "<TD>";
        echo "<INPUT class=\"press\" TYPE=\"submit\" VALUE=\"Search\">&nbsp;&nbsp;";
        echo "</TD>";
        echo "</TR>";


        echo "</td></tr>";
        echo "</table></CENTER>";
        //echo "<br><br>";

        echo "<table class=\"pure-table table-striped card\">";
        echo "<tr><td colspan=\"5\"><center><b>Customer List</b></center></td></tr>";    
        echo "<tr class=\"pure-table-th\">";   
        echo "<th> ID </th>";      
        echo "<th> Name </th>";     
        echo "<th> Telephone Number </th>";    
        echo "<th> Actuation </th>";      
        echo "</tr>"; 

        $sql = "SELECT * FROM Customer";

        $ObjCustomer->query($sql);

        while ($row = mysqli_fetch_array($ObjCustomer->results)) {
            echo "<tr>";
            echo "<td><b><a href=\"CustomerDetail.php?idCustomer=" . $row['idCustomer'] . "\">" . $row['idCustomer'] . "</a></b></td>";
            echo "<td><b>" . $row['nameCustomer'] . "</b></td>";
            echo "<td><b>" . $row['telCustomer'] . "</b></td>";
            echo "<td><b><a href=\"updateCustomer.php?idCustomer=" . $row['idCustomer'] . "\">Edit</a> | ";
            echo "<a href=\"updateCustomer.php?idCustomer=" . $row['idCustomer'] . "&action=delete\">Delete</a></b></td>";
            echo "</tr>";
        }
        $ObjCustomer->close();
          
    }

    ?>

        <tr>
            <td COLSPAN=6 align=center><a href=" insertCustomer.php "><b>Add</b></a></td>
        </tr>
        </tbody>
    </table>
        </div>
</body>
</html>