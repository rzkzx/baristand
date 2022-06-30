<?php

Class PersediaanModel
{
  private $table = 'persediaan';
  private $tablegd = 'gudang';

  public function __construct()
  {
      $this->db = new Database;
  }
  
  public function getAll()
  {
      $query = "SELECT * FROM ".$this->table;
      $this->db->query($query);

      return $this->db->resultSet();
  }

  public function getAllgudang()
  {
      $query = "SELECT * FROM ".$this->tablegd;
      $this->db->query($query);

      return $this->db->resultSet();
  }

  public function addGudang($data)
  {
      $waktu = date('Y-m-d H:i');
      $petugas = implode(',',$data['petugas']);

      $query = "INSERT INTO ".$this->tablegd." (namagudang, petugas, tanggal, keterangan) 
      VALUES (:namagudang, :petugas, :tanggal, :keterangan)";

      $this->db->query($query);
      $this->db->bind('namagudang',$data['nama']);
      $this->db->bind('petugas',$petugas);
      $this->db->bind('tanggal',$waktu);
      $this->db->bind('keterangan',$data['keterangan']) ;
      $this->db->execute();

      return $this->db->rowCount();
  }
}
?>