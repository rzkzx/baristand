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
      $query = "SELECT tbahan.*, nbahan, jumlah, keterangan FROM ".$this->table." WHERE nip=:nip";
      $this->db->query($query);
      $this->db->bind('nip',$_SESSION['nip']);

      return $this->db->resultSet();
  }

  public function add($data)
  {

      $query = "INSERT INTO ".$this->table." (nbahan, jumlah, keterangan, nip) 
      VALUES (:nbahan, :jumlah, :keterangan, :nip)";

      $this->db->query($query);
      $this->db->bind('nbahan',$data['nbahan']);
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

    return $this->db->rowCount();
  }
}

?>