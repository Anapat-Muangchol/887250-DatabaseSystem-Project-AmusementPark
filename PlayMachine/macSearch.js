var idPlayMachine = document.getElementById("idPlayMachine");
var namePlayMachinecol = document.getElementById("namePlayMachinecol");
var Zone_idZone = document.getElementById("Zone_idZone");
var answer;
var order;

liveSearch(order);

idPlayMachine.onkeydown = idPlayMachine.onkeyup = idPlayMachine.onkeypress
    = namePlayMachinecol.onkeydown = namePlayMachinecol.onkeyup = namePlayMachinecol.onkeypress
    =Zone_idZone.onkeydown = Zone_idZone.onkeyup = Zone_idZone.onkeypress = function () {

    if (idPlayMachine.value == "" && namePlayMachinecol.value == "" && Zone_idZone.value == "") {
        document.getElementById("status").innerHTML = "<b>Play Machine</b>";
        liveSearch(order);
    }

    if (idPlayMachine.value == "" && namePlayMachinecol.value == "" && Zone_idZone.value != "") {
        liveSearch("Zone_idZone=" + Zone_idZone.value);
    }

    if (idPlayMachine.value == "" && namePlayMachinecol.value != "" && Zone_idZone.value != "") {
        liveSearch("namePlayMachinecol=" + namePlayMachinecol.value + "&Zone_idZone=" + Zone_idZone.value);
    }

    if (idPlayMachine.value != "" && namePlayMachinecol.value != "" && Zone_idZone.value != "") {
        liveSearch("idPlayMachine=" + idPlayMachine.value + "&namePlayMachinecol=" + namePlayMachinecol.value + "&Zone_idZone=" + Zone_idZone.value);
    }

    if (idPlayMachine.value != "" && namePlayMachinecol.value == "" && Zone_idZone.value == "") {
        liveSearch("idPlayMachine=" + idPlayMachine.value);
    }

    if (idPlayMachine.value == "" && namePlayMachinecol.value != "" && Zone_idZone.value == "") {
        liveSearch("&namePlayMachinecol=" + namePlayMachinecol.value);
    }

    if (idPlayMachine.value != "" && namePlayMachinecol.value == "" && Zone_idZone.value != "") {
        liveSearch("idPlayMachine=" + idPlayMachine.value + "&Zone_idZone=" + Zone_idZone.value);
    }

    if (idPlayMachine.value != "" && namePlayMachinecol.value != "" && Zone_idZone.value == "") {
        liveSearch("idPlayMachine=" + idPlayMachine.value + "&namePlayMachinecol=" + namePlayMachinecol.value);
    }

}
function liveSearch(order) {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            answer = xmlhttp.responseText;
            if(answer == 0){
                document.getElementById("results").innerHTML =
                    "<table> <tr class=\"table-header\"> <th>ID</th> <th>Name</th> <th>Zone</th> <th>Detail</th> <th>Engineer</th> <th>Supplier</th> <th> Actuation </th> </tr><tr><td idPlayMachine=\"add\" colspan=\"7\">Data not found.</td></tr></table>";
            } else {
                document.getElementById("results").innerHTML = answer;
            }
        }
    }
    xmlhttp.open("POST", "PlayMachine.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    if(order == ""){
        xmlhttp.send();
    }else {
        xmlhttp.send(order);
    }


}