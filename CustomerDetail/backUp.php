<!doctype html>
<html>
<head>
    <title>Customer Beta</title>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link
        href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,700,700italic|Noto+Sans:400,400italic,700,700italic'
        rel='stylesheet' type='text/css'>
    <link href="myStyle.css" type="stylesheet" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
</head>
<body>
<div id="topbar">
    <div id="menubar">
        <ul>
            <li><a href="">Home</a></li>
            <li><a href="Customer_Live.php">Customer</a></li>
            <li><a href="">Receipts Detail</a></li>
            <li><a href="">Ticket Type</a></li>
            <li><a href="">Zone</a></li>
            <li><a href="">Play Machine</a></li>
        </ul>
    </div>
</div>
<div id="content">

    <?php
    require('db_Live.php');
    require('Customer_class_Live.php');

    $ObjCustomer = new Customer();
    $ObjCustomer->connect();

    if (!empty($_POST['idCustomer']) || !empty($_POST['nameCustomer']) || !empty($_POST['telCustomer'])) {
        //echo "Search";
        echo
            "<table class=\"pure-table table-striped\">
         <tr><td colspan=\"5\">
         <form METHOD =\"post\" NAME=\"Customer\" ACTION=\"Customer_Live.php\">
         <CENTER>
        <table class=\"table table-bordered\" style =\"width:70%\">
        <tr ALIGN=\"center\">
        <td> ID </td><td> Name </td><td> Telephone Number </td>
        </tr>
        <tr ALIGN=\"center\">
        <td> <INPUT class=\"fill\" TYPE=\"text\" NAME=\"idCustomer\" value=\"" . $_POST['idCustomer'] . "\"> </td>
              <td> <INPUT class=\"fill\" TYPE=\"text\" NAME=\"nameCustomer\" value=\"" . $_POST['nameCustomer'] . "\"> </td>
              <td> <INPUT class=\"fill\" TYPE=\"text\" NAME=\"telCustomer\" value=\"" . $_POST['telCustomer'] . "\"> </td>
        </tr>
        <tr ALIGN=\"right\">
        <td></td>
        <td></td>
        <td>
        <INPUT class=\"press\" TYPE=\"submit\" VALUE=\"Search\">&nbsp;&nbsp;
        </td>
        </tr>


        </td></tr>
        </table></CENTER></form>

        <table class=\"pure-table table-striped card\">
        <tr><td colspan=\"5\"><p style=\"text-align:center\"><b>Customer List</b></p></td></tr>
        <tr class=\"pure-table-th\">
        <th> ID </th>
        <th> Name </th>
        <th> Telephone Number </th>
        <th> Actuation </th>
        </tr>";

        $sql = "";
        if (!empty($_POST['idCustomer']) && !empty($_POST['nameCustomer']) && !empty($_POST['telCustomer'])) {
            $sql = "SELECT * FROM Customer WHERE idCustomer LIKE '%" . $_POST['idCustomer'] . "%' AND nameCustomer LIKE '%" . $_POST['nameCustomer'] . "%' AND telCustomer LIKE '%" . $_POST['telCustomer'] . "%'";
        } else if (!empty($_POST['idCustomer']) && !empty($_POST['nameCustomer'])) {
            $sql = "SELECT * FROM Customer WHERE idCustomer LIKE '%" . $_POST['idCustomer'] . "%' AND nameCustomer LIKE '%" . $_POST['nameCustomer'] . "%'";
        } else if (!empty($_POST['nameCustomer']) && !empty($_POST['telCustomer']) && !empty($_POST['telCustomer'])) {
            $sql = "SELECT * FROM Customer WHERE nameCustomer LIKE '%" . $_POST['nameCustomer'] . "%' AND telCustomer LIKE '%" . $_POST['telCustomer'] . "%'";
        } else if (!empty($_POST['idCustomer']) && !empty($_POST['telCustomer'])) {
            $sql = "SELECT * FROM Customer WHERE idCustomer LIKE '%" . $_POST['idCustomer'] . "%' AND telCustomer LIKE '%" . $_POST['telCustomer'] . "%'";
        } else if (!empty($_POST['idCustomer'])) {
            $sql = "SELECT * FROM Customer WHERE idCustomer LIKE '%" . $_POST['idCustomer'] . "%'";
        } else if (!empty($_POST['nameCustomer'])) {
            $sql = "SELECT * FROM Customer WHERE nameCustomer LIKE '%" . $_POST['nameCustomer'] . "%'";
        } else if (!empty($_POST['telCustomer'])) {
            $sql = "SELECT * FROM Customer WHERE telCustomer LIKE '%" . $_POST['telCustomer'] . "%'";
        }

        $ObjCustomer->query($sql);

        while ($row = mysqli_fetch_array($ObjCustomer->results)) {
            echo "<tr>
            <td><b><a href=\"\" >" . $row['idCustomer'] . "</b></td>
            <td><b>" . $row['nameCustomer'] . "</b></td>
            <td><b>" . $row['telCustomer'] . "</b></td>
            <td><b><a href=\"updateCustomer.php?idCustomer=" . $row['idCustomer'] . "\">Edit</a> |
            <a href=\"updateCustomer.php?idCustomer=" . $row['idCustomer'] . "&action=delete\">Delete</a></b></td>
            </tr>";
        }
        $ObjCustomer->close();
    } else {
        echo "<table class=\"pure-table table-striped\">
        <tr><td colspan=\"5\">
        <form METHOD =\"post\" NAME=\"Customer\" ACTION=\"Customer_Live.php\">
        <CENTER>
        <table class=\"table table-bordered\" style =\"width:70%\">
        <tr ALIGN=\"center\">
        <td> ID </td><td> Name </td><td> Telephone Number </td>
        </tr>
        <tr ALIGN=\"center\">
        <td> <INPUT class=\"fill\" TYPE=\"text\" NAME=\"idCustomer\" > </td>
              <td> <INPUT class=\"fill\" TYPE=\"text\" NAME=\"nameCustomer\" > </td>
              <td> <INPUT class=\"fill\" TYPE=\"text\" NAME=\"telCustomer\" > </td>
        </tr>
        <tr ALIGN=\"right\">
        <td></td>
        <td></td>
        <td>
        <INPUT class=\"press\" TYPE=\"submit\" VALUE=\"Search\">&nbsp;&nbsp;
        </td>
        </tr>


        </td></tr>
        </table></CENTER>


        <table class=\"pure-table table-striped card\">
        <tr><td colspan=\"5\"><center><b>Customer List</b></center></td></tr>
        <tr class=\"pure-table-th\">
        <th> ID </th>
        <th> Name </th>
        <th> Telephone Number </th>
        <th> Actuation </th>
        </tr>";

        $sql = "SELECT * FROM Customer";

        $ObjCustomer->query($sql);

        while ($row = mysqli_fetch_array($ObjCustomer->results)) {
            echo "<tr>
            <td><b><a href=\"\">" . $row['idCustomer'] . "</a></b></td>
            <td><b>" . $row['nameCustomer'] . "</b></td>
            <td><b>" . $row['telCustomer'] . "</b></td>
            <td><b><a href=\"updateCustomer.php?idCustomer=" . $row['idCustomer'] . "\">Edit</a> |
            <a href=\"updateCustomer.php?idCustomer=" . $row['idCustomer'] . "&action=delete\">Delete</a></b></td>
            </tr>";
        }
        $ObjCustomer->close();

    }

    ?>

    <tr>
        <td COLSPAN=6 align=center><a href=" insertCustomer.php "><b>Add</b></a></td>
    </tr>
    </table>
</div>
</body>
</html>