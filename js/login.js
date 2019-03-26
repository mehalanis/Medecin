function CreerCompte() {
  var login=document.getElementById('login_Compte');
  var creer=document.getElementById('Creer_Compte');

  if(creer.style.display=="none"){
    login.style.display ="none";
    creer.style.display="flex";
  }else{
    creer.style.display ="none";
    login.style.display="flex";
  }

}
