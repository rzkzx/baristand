<?php

class PegawaiModel
{ 
  private $table = 'users';
  private $db;

  public function __construct()
  {
      $this->db = new Database;
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
      $query = "INSERT INTO ".$this->table." (nip,nama,golongan,jabatan,username,password,no_telp,email,role,created_at,tgl_lahir,jenis_kel,pangkat,pendidikan) VALUES (:nip,:nama,:golongan,:jabatan,:username,:password,:no_telp,:email,:role,:created_at,:tgl_lahir,:jenis_kel,:pangkat,:pendidikan)";
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
      $this->db->bind('tgl_lahir',$data['tgl_lahir']);
      $this->db->bind('jenis_kel',$data['jenis_kel']);
      $this->db->bind('pangkat',$data['pangkat']);
      $this->db->bind('pendidikan',$data['pendidikan']);

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
      
      $query = "UPDATE ".$this->table." SET nip=:nip,nama=:nama,golongan=:golongan,jabatan=:jabatan,username=:username,no_telp=:no_telp,email=:email,tgl_lahir=:tgl_lahir,jenis_kel=:jenis_kel,pangkat=:pangkat,pendidikan=:pendidikan".$added." WHERE id=:id";
      $this->db->query($query);
      $this->db->bind('id',$data['id']);
      $this->db->bind('nip',$data['nip']);
      $this->db->bind('nama',$data['nama']);
      $this->db->bind('golongan',$data['golongan']);
      $this->db->bind('jabatan',$data['jabatan']);
      $this->db->bind('username',$data['username']);
      $this->db->bind('no_telp',$data['no_telp']);
      $this->db->bind('email',$data['email']);
      $this->db->bind('tgl_lahir',$data['tgl_lahir']);
      $this->db->bind('jenis_kel',$data['jenis_kel']);
      $this->db->bind('pangkat',$data['pangkat']);
      $this->db->bind('pendidikan',$data['pendidikan']);
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