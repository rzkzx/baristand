<?php

class LogUserModel
{ 
  private $table = 'log_user';
  private $db;

  public function __construct()
  {
      $this->db = new Database;
  }

  public function get()
  {
      $query = "SELECT * FROM ".$this->table. " ORDER by id DESC";
      $this->db->query($query);

      return $this->db->resultSet();
  }

  public function add(){
    $this->db->query('INSERT INTO '.$this->table.' (nama_user,nip_user,waktu_login,waktu_logout) VALUES (:nama_user,:nip_user,:waktu_login,:waktu_logout)');
    $this->db->bind(':nama_user', $_SESSION['nama']);
    $this->db->bind(':nip_user', $_SESSION['nip']);
    $this->db->bind(':waktu_login', $_SESSION['waktu_login']);
    $this->db->bind(':waktu_logout', date('Y-m-d H:i:s'));

    //execute 
    if($this->db->execute()){
        return true;
    }else{
        return false;
    }
}
}

?>