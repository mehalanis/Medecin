<?php
class user{
  public $id;
  public $nom;
  public $prenom;
  public $email;
  public $id_region;
  public $username;
  public $password;
  public function __construct($id,$nom,$prenom,$email,$id_region,$username,$password)
  {
    $this->id=$id;
    $this->nom=$nom;
    $this->prenom=$prenom;
    $this->email=$email;
    $this->id_region=$id_region;
    $this->username=$username;
    $this->password=$password;
  }
  public function InsertUser()
  {
    $database=new database();
    $database->query("INSERT INTO `user`( `nom`, `prenom`, `email`, `id_region`, `username`, `password`)
                         VALUES ('$this->nom','$this->prenom','$this->email',$this->id_region,'$this->username','$this->password')");
  }
  public function UpdateUser()
  {
    $database=new database();
    $sql_password="";
    if(!empty($this->password)){
      $sql_password=" , `password` = '".md5($this->password)."' ";
      $_SESSION["password"]=md5($this->password);
    }
    $_SESSION["username"]=$this->username;
    $database->query("UPDATE `user` SET `nom`='$this->nom',`prenom`='$this->prenom'
          ,`email`='$this->email',`id_region`=$this->id_region,`username`='$this->username'
           $sql_password  WHERE id_user=$this->id ");
  }
}
