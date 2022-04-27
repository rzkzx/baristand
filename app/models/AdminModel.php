<?php

class AdminModel
{ 
  private $table = 'admin';
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

  public function getPegawai($hak_akses){
    $query = "SELECT * FROM ".$this->table." WHERE hak_akses=:hak_akses";
    $this->db->query($query);
    $this->db->bind('hak_akses',$hak_akses);
    $jabatan = $this->db->single();

    $array = explode(',',$jabatan['nip_pegawai']);
    $nip_pegawai = implode("','",$array);
    $query = "SELECT * FROM users WHERE nip IN ('".$nip_pegawai."')";
    $this->db->query($query);

    return $this->db->resultSet();
  }

  public function cekAkses($hak_akses)
  {
    $query = "SELECT * FROM ".$this->table." WHERE hak_akses=:hak_akses";
    $this->db->query($query);
    $this->db->bind('hak_akses',$hak_akses);
    $jabatan = $this->db->single();

    $nip_pegawai = explode(',',$jabatan->nip_pegawai);
    if(in_array($_SESSION['nip'],$nip_pegawai,TRUE)){
      return 1;
    }
    return 0;
  }

  public function update($data)
  {
      $pegawai = implode(',',$data['pegawai']);
      $query = "UPDATE ".$this->table." SET nip_pegawai=:nip_pegawai WHERE id=:id";
      $this->db->query($query);
      $this->db->bind('id',$data['id']);
      $this->db->bind('nip_pegawai',$pegawai);
      $this->db->execute();
      
      return $this->db->rowCount();
  }
}

?>