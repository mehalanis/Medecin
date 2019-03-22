function ControlKeyDown(e) {
  if(((e.key>=0)&&(e.key<=9))||(e.keyCode==8)){
  return true;
 }
 return false;
}
