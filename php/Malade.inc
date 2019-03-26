<?php

class Malade{
  public $id;
  public $matricule;
  public $nom;
  public $prenom;
  public $date;
  public function __construct($id,$matricule,$nom,$prenom,$date)
  {
    $this->id=$id;
    $this->matricule=$matricule;
    $this->nom=$nom;
    $this->prenom=$prenom;
    $this->date=$date;
  }
  public function InsertMalade()
  {
    $database=new database();
    $result=$database->query("insert into malade(matricule,nom,prenom,date_naissance)
            values ('".$this->matricule."','".$this->nom."','".$this->prenom."','".$this->date."')");
    if(!$result) { die("error");}
    return $database->insertid();
  }
  public function ModifieMalade()
  {
    $database=new database();
    $result=$database->query("update malade set matricule='".$this->matricule."',
            nom='".$this->nom."',prenom='".$this->prenom."',date_naissance='".$this->date
            ."' WHERE id_malade=".$this->id);
    if(!$result) { die("error");}
  }
  public function RemoveMalade()
  {
    $database=new database();
    $result=$database->query("DELETE FROM malade WHERE id_malade=".$this->id);
    if(!$result) { die("error");}
  }
}
