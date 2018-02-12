var id = document.getElementById("id");
var nameZone = document.getElementById("nameZone");
var answer;
var order;

liveSearch(order);

id.onkeydown = id.onkeyup = id.onkeypress
    = nameZone.onkeydown = nameZone.onkeyup = nameZone.onkeypress = function () {

    if (id.value == "" && nameZone.value == "") {
        document.getElementById("status").innerHTML = "<b>Zone</b>";
        liveSearch(order);
    }

    if (id.value == "" && nameZone.value != "") {
        liveSearch("nameZone=" + nameZone.value);
    }

    if (id.value != "" && nameZone.value != "") {
        liveSearch("idZone=" + id.value + "&nameZone=" + nameZone.value);
    }

    if (id.value != "" && nameZone.value == "") {
        liveSearch("idZone=" + id.value);
    }
    
}
function liveSearch(order) {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            answer = xmlhttp.responseText;
            if(answer == 0){
                document.getElementById("results").innerHTML =
                    "<table> <tr class=\"table-header\"> <th> ID</th> <th> Name</th> <th> Actuation</th> </tr><tr><td id=\"add\" colspan=\"3\">Data not found.</td></tr></table>";
            }else {
                document.getElementById("results").innerHTML = answer;
            }
        }

    }
    xmlhttp.open("POST", "Zone.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    if(order == ""){
        xmlhttp.send();
    }else {
        xmlhttp.send(order);
    }


}