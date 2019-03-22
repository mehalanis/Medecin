function ConsulterOrdonnance(idOrdonnance) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var list =JSON.parse(this.responseText);
        AfficheOrdonnance(list);
    }
  };
  xhttp.open("GET", "request.php?idOrdonnance="+idOrdonnance, true);
  xhttp.send();
}
function AfficheOrdonnance(list) {
    var table=document.getElementById("consulterordonnancetable");
    var s="<thead><tr><th>Medicament</th><th>Doz</th><th>Nombre Boit</th></tr></thead>";
    for(var i=0;i<list.List.length;i++){
      s+="<tr><td>"+list.List[i].nom+"</td><td>"+list.List[i].doz+"</td><td>"+list.List[i].nbrboit+"</td></tr>";
    }
    table.innerHTML=s;
}
