<?php

class PegawaiModel
{ 
  private $table = 'users';
  private $db;

  public function __construct()
  {
      $this->db = new Database;
  }

  //for dashboard
  public function getAllCountPercent()
  {
        $query = "SELECT * FROM ".$this->table." WHERE role=:role AND MONTH(created_at)=:month";
        $this->db->query($query);
        $this->db->bind('role', "PEGAWAI");
        $this->db->bind('month', date('m'));
        $now = $this->db->resultSet();

        $query2 = "SELECT * FROM ".$this->table." WHERE role=:role AND MONTH(created_at)=:month";
        $this->db->query($query2);
        $this->db->bind('role', "PEGAWAI");
        $this->db->bind('month', date('m')-1);
        $before = $this->db->resultSet();

        $now = count($now);
        $before = count($before);
        $diff = $now - $before;
        $percent = ($diff/$before) * 100;
        return round($percent,2);
  }

  // get model group
  public function get()
  {
      $query = "SELECT * FROM ".$this->table." WHERE role=:role";
      $this->db->query($query);
      $this->db->bind('role', "PEGAWAI");

      return $this->db->resultSet();
  }
  public function getById($id){
      $query = "SELECT * FROM ".$this->table." WHERE id=:id";
      $this->db->query($query);
      $this->db->bind('id', $id);

      return $this->db->single();
  }
  public function getByNIP($nip){
    $query = "SELECT * FROM ".$this->table." WHERE nip=:nip";
    $this->db->query($query);
    $this->db->bind('nip', $nip);

    return $this->db->single();
  }
  public function getAllNIP($nip_pegawai){
    $array= explode(',', $nip_pegawai);
    $array = implode("','",$array);
    $query = "SELECT * FROM ".$this->table." WHERE nip IN ('".$array."')";
    $this->db->query($query);

    return $this->db->resultSet();
  }

  // add model
  public function add($data)
  {
    $user = "SELECT * FROM ".$this->table." WHERE nip=:nip_user OR username=:username_user";
    $this->db->query($user);
    $this->db->bind('nip_user',$data['nip']);
    $this->db->bind('username_user',$data['username']);
    $checkUser = $this->db->single();
    if($checkUser){
      return false;
    }else{
      $query = "INSERT INTO ".$this->table." (nip,nama,golongan,jabatan,username,password,no_telp,email,role,created_at) VALUES (:nip,:nama,:golongan,:jabatan,:username,:password,:no_telp,:email,:role,:created_at)";
      $this->db->query($query);
      $this->db->bind('nip',$data['nip']);
      $this->db->bind('nama',$data['nama']);
      $this->db->bind('golongan',$data['golongan']);
      $this->db->bind('jabatan',$data['jabatan']);
      $this->db->bind('username',$data['username']);
      $this->db->bind('password', password_hash($data['username'],PASSWORD_DEFAULT));
      $this->db->bind('no_telp',$data['no_telp']);
      $this->db->bind('email',$data['email']);
      $this->db->bind('role','PEGAWAI');
      $this->db->bind('created_at', date('Y-m-d'));

      //execute 
      if($this->db->execute()){
        return true;
      }else{
        return false;
      };
    }
  }

  // update model
  public function update($data)
  {
      $added='';
      if($data['password']) {
        $added = ',password=:password';
      }
      
      $query = "UPDATE ".$this->table." SET nip=:nip,nama=:nama,golongan=:golongan,jabatan=:jabatan,username=:username,no_telp=:no_telp,email=:email".$added." WHERE id=:id";
      $this->db->query($query);
      $this->db->bind('id',$data['id']);
      $this->db->bind('nip',$data['nip']);
      $this->db->bind('nama',$data['nama']);
      $this->db->bind('golongan',$data['golongan']);
      $this->db->bind('jabatan',$data['jabatan']);
      $this->db->bind('username',$data['username']);
      $this->db->bind('no_telp',$data['no_telp']);
      $this->db->bind('email',$data['email']);
      if($data['password']) {
        $this->db->bind('password',password_hash($data['password'], PASSWORD_DEFAULT));
      }
    
      if($this->db->execute()){
        return true;
      }else{
        return false;
      };
  }

  // delete model
  public function delete($id){
    $query = "DELETE FROM ".$this->table." WHERE id=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);

    if($this->db->execute()){
      return true;
    }else{
      return false;
    };
  }
}

?>