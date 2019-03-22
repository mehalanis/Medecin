var list;
function LoadPageAjax(request,page) {
  var xhttp = new XMLHttpRequest();
  if(document.getElementById('RechMalade').value!=""){
    request+=document.getElementById('RechMalade').value;
  }
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        window.list =JSON.parse(this.responseText);
        AfficheTableInfo();
        Affiche(page);
    }
  };
  xhttp.open("GET", request, true);
  xhttp.send();
}
function Affiche(page) {
  var table=document.getElementById("tablemalade");
  var operation=document.getElementById("operation");
  var s="";
  var j=0;
  var listoperation;
  var headtable= document.getElementsByClassName('headtable');
  for(var i=(page*10)-10;i<list.List.length&& j<10;i++){
    j++;
    s+="<tr>";
    for(var k=0;k<headtable.length;k++){
      s+="<td>"+list.List[i][headtable[k].abbr]+"</td>";
    }
    s+="<td>";
    listoperation =JSON.parse(operation.abbr);
    for(var k=0;k<listoperation.list.length;k++){
      s+="<a class=\""+listoperation.list[k].class+"\" href=\""+listoperation.list[k].url
                +list.List[i]["id"]+"\">"+listoperation.list[k].name+" </a>";
    }
    s+="</td>";
    s+="</tr>";
  }
  table.innerHTML=s;
  var itemactiv= document.getElementsByClassName('list');
  for(var i=0;i<itemactiv.length;i++){
    if(i+1==page){itemactiv[i].setAttribute("class","list itemactiv");}
    else{itemactiv[i].setAttribute("class","list"); }
  }
}
function AfficheTableInfo() {
 var nb=parseInt(list.List.length / 10);
 if(list.List.length%10!=0)nb++;
 var s="";
 var listinfo=document.getElementById("tableinfo");
 for(var i=1;i<=nb;i++){
   s+="<li class='list' onclick='Affiche("+i+")'>"+i+"</li>";
 }
 listinfo.innerHTML="<ul class='listinfo'><li class='suivprec'><img src='img/precedant.png'/></li>"
                               +s+"<li class='suivprec'><img src='img/suivant.png'/></li></ul>";
}
