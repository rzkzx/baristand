<?php

Class TBahanModel
{
  private $table = 'tbahan';
  private $db;

  public function __construct()
  {
      $this->db = new Database;
  }

  public function getAll()
  {
      $query = "SELECT tbahan.*, nbahan, jumlah, keterangan FROM ".$this->table;
      $this->db->query($query);

      return $this->db->resultSet();
  }

  public function add($data)
  {

      $query = "INSERT INTO ".$this->table." (nbahan, jumlah, keterangan) 
      VALUES (:nbahan, :jumlah, :keterangan)";

      $this->db->query($query);
      $this->db->bind('nbahan',$data['nbahan']);
      $this->db->bind('jumlah',$data['jumlah']);
      $this->db->bind('keterangan',$data['keterangan']);
      $this->db->execute();

      return $this->db->rowCount();
  }

  public function delete($id){
    $query = "DELETE FROM ".$this->table." WHERE id=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function deleteAll(){
    $query = "DELETE FROM ".$this->table;
    $this->db->query($query);
    $this->db->execute();

    return $this->db->rowCount();
  }
}

?>