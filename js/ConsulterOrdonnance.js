var cpt=0;
function AjouteMedicament() {
  var nom=document.getElementById("nomMedicament");
  var doz=document.getElementById("dozMedicament");
  var nbrboit=document.getElementById("nbrboitMedicament");
  var table=document.getElementById("consulterOrdonnancelist");
  table.innerHTML+="<tr id=\""+window.cpt+"\"><td width=\"30\"><button class=\"btndelete\" type=\"button\" value=\""+window.cpt+"\" onclick=\"supp(this.value)\" >"
              +"<img src='img/delete.png' ></button></td>"
                +"<td> <input class=\"hiddeninput\" type=\"text\" name='nom[]'  value=\""+nom.value
              +"\"/></td><td><input class=\"hiddeninputnbrboit\" type=\"text\" name='doz[]'  value=\""+doz.value
              +"\"/></td><td><input class=\"hiddeninputnbrboit\" type=\"text\" name='nbrboit[]'  value=\""+nbrboit.value+"\"/></td></tr>";
  window.cpt++;
  nom.value="";
  nbrboit[0].selected =true;
  doz[0].selected=true;
}
function supp(v) {
  var ligne=document.getElementById(v);
  ligne.innerHTML="";
}
