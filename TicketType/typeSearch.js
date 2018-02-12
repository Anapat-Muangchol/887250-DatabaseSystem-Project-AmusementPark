var idType = document.getElementById("idType");
var nameType = document.getElementById("nameType");
var priceType = document.getElementById("priceType");
var answer;
var order;

liveSearch(order);

idType.onkeydown = idType.onkeyup = idType.onkeypress
    = nameType.onkeydown = nameType.onkeyup = nameType.onkeypress
    =priceType.onkeydown = priceType.onkeyup = priceType.onkeypress = function () {

    //document.getElementById("status").innerHTML = "<b>Search in Customer List</b>";

    if (idType.value == "" && nameType.value == "" && priceType.value == "") {
        document.getElementById("status").innerHTML = "<b>Customer List</b>";
        liveSearch(order);
    }

    if (idType.value == "" && nameType.value == "" && priceType.value != "") {
        liveSearch("priceType=" + priceType.value);
    }

    if (idType.value == "" && nameType.value != "" && priceType.value != "") {
        liveSearch("nameType=" + nameType.value + "&priceType=" + priceType.value);
    }

    if (idType.value != "" && nameType.value != "" && priceType.value != "") {
        liveSearch("idType=" + idType.value + "&nameType=" + nameType.value + "&priceType=" + priceType.value);
    }

    if (idType.value != "" && nameType.value == "" && priceType.value == "") {
        liveSearch("idType=" + idType.value);
    }

    if (idType.value == "" && nameType.value != "" && priceType.value == "") {
        liveSearch("&nameType=" + nameType.value);
    }

    if (idType.value != "" && nameType.value == "" && priceType.value != "") {
        liveSearch("idType=" + idType.value + "&priceType=" + priceType.value);
    }

    if (idType.value != "" && nameType.value != "" && priceType.value == "") {
        liveSearch("idType=" + idType.value + "&nameType=" + nameType.value);
    }

}
function liveSearch(order) {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            answer = xmlhttp.responseText;
            if(answer == 0){
                document.getElementById("results").innerHTML =
                    "<table> <tr class=\"table-header\"> <th>ID</th> <th>Name</th> <th>Price</th> <th>Zone</th> <th>Actuation</th> </tr><tr><td idType=\"add\" colspan=\"5\">Data not found.</td></tr></table>";
            } else {
                document.getElementById("results").innerHTML = answer;
            }
        }
    }
    xmlhttp.open("POST", "TicketType.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    if(order == ""){
        xmlhttp.send();
    }else {
        xmlhttp.send(order);
    }


}