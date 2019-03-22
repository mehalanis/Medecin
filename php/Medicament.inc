<?php
class Medicament{
  public $id;
  public $name;
  public function __construct($id,$name)
  {
    $this->id=$id;
    $this->name=$name;
  }
  public function InsertMedicament()
  {
    $database=new database();
    $result=$database->query("insert into medicament(nom_medicament) values ('".$this->name."')");
    if(!$result) { die("error");}
  }
  public function ModifieMedicament()
  {
    $database=new database();
    $result=$database->query("update medicament set nom_medicament='".$this->name."' WHERE id_medicament=".$this->id);
    if(!$result) { die("error");}
  }
  public function RemoveMedicament()
  {
    $database=new database();
    $result=$database->query("DELETE FROM medicament WHERE id_medicament=".$this->id);
    if(!$result) { die("error");}
  }
}
