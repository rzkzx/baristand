<?php

Class TBarangModel
{
  private $table = 'tbarang';
  private $db;

  public function __construct()
  {
      $this->db = new Database;
  }

  public function getAll()
  {
      $query = "SELECT tbarang.*, nbarang, jumlah, keterangan FROM ".$this->table." WHERE nip=:nip";
      $this->db->query($query);
      $this->db->bind('nip',$_SESSION['nip']);

      return $this->db->resultSet();
  }

  public function add($data)
  {

      $query = "INSERT INTO ".$this->table." (nbarang, jumlah, keterangan, nip) 
      VALUES (:nbarang, :jumlah, :keterangan, :nip)";

      $this->db->query($query);
      $this->db->bind('nbarang',$data['nbarang']);
      $this->db->bind('jumlah',$data['jumlah']);
      $this->db->bind('keterangan',$data['keterangan']);
      $this->db->bind('nip',$_SESSION['nip']);
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
    $query = "DELETE FROM ".$this->table." WHERE nip=:nip";
    $this->db->query($query);
    $this->db->bind('nip',$_SESSION['nip']);
    $this->db->execute();

    return $this->db->rowCount();
  }
}

?>