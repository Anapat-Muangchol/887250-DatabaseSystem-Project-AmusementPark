var id = document.getElementById("id");
var nameCus = document.getElementById("nameCus");
var tel = document.getElementById("telephone");
var answer;
var order;

liveSearch(order);

id.onkeydown = id.onkeyup = id.onkeypress
    = nameCus.onkeydown = nameCus.onkeyup = nameCus.onkeypress
    =tel.onkeydown = tel.onkeyup = tel.onkeypress = function () {

    //document.getElementById("status").innerHTML = "<b>Search in Customer List</b>";

    if (id.value == "" && nameCus.value == "" && tel.value == "") {
        document.getElementById("status").innerHTML = "<b>Customer List</b>";
        liveSearch(order);
    }

    if (id.value == "" && nameCus.value == "" && tel.value != "") {
        liveSearch("telCustomer=" + tel.value);
    }

    if (id.value == "" && nameCus.value != "" && tel.value != "") {
        liveSearch("nameCustomer=" + nameCus.value + "&telCustomer=" + tel.value);
    }

    if (id.value != "" && nameCus.value != "" && tel.value != "") {
        liveSearch("idCustomer=" + id.value + "&nameCustomer=" + nameCus.value + "&telCustomer=" + tel.value);
    }

    if (id.value != "" && nameCus.value == "" && tel.value == "") {
        liveSearch("idCustomer=" + id.value);
    }

    if (id.value == "" && nameCus.value != "" && tel.value == "") {
        liveSearch("&nameCustomer=" + nameCus.value);
    }

    if (id.value != "" && nameCus.value == "" && tel.value != "") {
        liveSearch("idCustomer=" + id.value + "&telCustomer=" + tel.value);
    }

    if (id.value != "" && nameCus.value != "" && tel.value == "") {
        liveSearch("idCustomer=" + id.value + "&nameCustomer=" + nameCus.value);
    }

}
function liveSearch(order) {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            answer = xmlhttp.responseText;
            if(answer == 0){
                document.getElementById("results").innerHTML =
                    "<table> <tr class=\"table-header\"> <th> ID</th> <th> Name</th> <th> Telephone Number</th> <th> Actuation</th> </tr><tr><td id=\"add\" colspan=\"4\">Data not found.</td></tr></table>";
            } else {
                document.getElementById("results").innerHTML = answer;
            }
        }
    }
    xmlhttp.open("POST", "Customer_Live_Data.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    if(order == ""){
        xmlhttp.send();
    }else {
        xmlhttp.send(order);
    }


}