var Ticket_id = document.getElementById("Ticket_id");
var Customer_idCustomer1 = document.getElementById("Customer_idCustomer1");
var receiveDate = document.getElementById("receiveDate");
var answer;
var order;

liveSearch(order);

Ticket_id.onkeydown = Ticket_id.onkeyup = Ticket_id.onkeypress
    = Customer_idCustomer1.onkeydown = Customer_idCustomer1.onkeyup = Customer_idCustomer1.onkeypress
    =receiveDate.onkeydown = receiveDate.onkeyup = receiveDate.onkeypress = function () {

    if (Ticket_id.value == "" && Customer_idCustomer1.value == "" && receiveDate.value == "") {
        document.getElementById("status").innerHTML = "<b>Receipts Detail</b>";
        liveSearch(order);
    }

    if (Ticket_id.value == "" && Customer_idCustomer1.value == "" && receiveDate.value != "") {
        liveSearch("receiveDate=" + receiveDate.value);
    }

    if (Ticket_id.value == "" && Customer_idCustomer1.value != "" && receiveDate.value != "") {
        liveSearch("Customer_idCustomer1=" + Customer_idCustomer1.value + "&receiveDate=" + receiveDate.value);
    }

    if (Ticket_id.value != "" && Customer_idCustomer1.value != "" && receiveDate.value != "") {
        liveSearch("Ticket_id=" + Ticket_id.value + "&Customer_idCustomer1=" + Customer_idCustomer1.value + "&receiveDate=" + receiveDate.value);
    }

    if (Ticket_id.value != "" && Customer_idCustomer1.value == "" && receiveDate.value == "") {
        liveSearch("Ticket_id=" + Ticket_id.value);
    }

    if (Ticket_id.value == "" && Customer_idCustomer1.value != "" && receiveDate.value == "") {
        liveSearch("&Customer_idCustomer1=" + Customer_idCustomer1.value);
    }

    if (Ticket_id.value != "" && Customer_idCustomer1.value == "" && receiveDate.value != "") {
        liveSearch("Ticket_id=" + Ticket_id.value + "&receiveDate=" + receiveDate.value);
    }

    if (Ticket_id.value != "" && Customer_idCustomer1.value != "" && receiveDate.value == "") {
        liveSearch("Ticket_id=" + Ticket_id.value + "&Customer_idCustomer1=" + Customer_idCustomer1.value);
    }

}
function liveSearch(order) {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            answer = xmlhttp.responseText;
            if(answer == 0){
                document.getElementById("results").innerHTML =
                    "<table> <tr class=\"table-header\"> <th>Receipt NO.</th> <th>Customer ID</th> <th>Receive Date</th> <th> Actuation</th> </tr><tr><td Ticket_id=\"add\" colspan=\"4\">Data not found.</td></tr></table>";
            }else {
                document.getElementById("results").innerHTML = answer;
            }
        }
    }
    xmlhttp.open("POST", "TicketDetail.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    if(order == ""){
        xmlhttp.send();
    }else {
        xmlhttp.send(order);
    }


}