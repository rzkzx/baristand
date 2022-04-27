<?php

class FormulirModel
{ 
  private $table = 'm_formulir';
  private $db;

  public function __construct()
  {
      $this->db = new Database;
  }

  public function get()
  {
      $query = "SELECT * FROM ".$this->table;
      $this->db->query($query);

      return $this->db->resultSet();
  }

  public function getById($id){
    $query = "SELECT * FROM ".$this->table." WHERE id=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);

    return $this->db->single();
  }

  public function update($data)
  {
      $query = "UPDATE ".$this->table." SET nama=:nama,kode=:kode WHERE id=:id";
      $this->db->query($query);
      $this->db->bind('id',$data['id']);
      $this->db->bind('nama',$data['nama']);
      $this->db->bind('kode',$data['kode']);
  
      //execute 
      if($this->db->execute()){
        return true;
      }else{
          return false;
      }
  }
}

?>