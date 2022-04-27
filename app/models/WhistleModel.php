<?php

class WhistleModel
{ 
  private $table = 'whistleblowing';
  private $db;

  public function __construct()
  {
      $this->db = new Database;
  }

  public function get()
  {
      $query = "SELECT whistleblowing.*, users.nama FROM ".$this->table." LEFT JOIN users ON users.nip=whistleblowing.pelapor";
      $this->db->query($query);

      return $this->db->resultSet();
  }
  public function getAllByDate($date1,$date2)
  {
    $dateOne = date("Y-m-d", strtotime($date1));
    $dateTwo = date("Y-m-d", strtotime($date2));
    $query= "SELECT whistleblowing.*, users.nama FROM ".$this->table." LEFT JOIN users ON users.nip=whistleblowing.pelapor WHERE whistleblowing.tanggal BETWEEN :start_date AND :end_date ORDER BY id DESC";

    $this->db->query($query);
    $this->db->bind('start_date',$dateOne);
    $this->db->bind('end_date',$dateTwo);

    return $this->db->resultSet();
  }

  public function getAllByNIP()
  {
    $query = "SELECT * FROM ".$this->table." WHERE pelapor=:nip_pelapor";
    $this->db->query($query);
    $this->db->bind('nip_pelapor', $_SESSION['nip']);

    return $this->db->resultSet();
  }

  public function getById($id){
    $query = "SELECT whistleblowing.*,users.nama,users.nip FROM ".$this->table." JOIN users ON users.nip=whistleblowing.pelapor WHERE whistleblowing.id=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);

    return $this->db->single();
}

  public function add($data,$file)
  {
    $temp = $file['tmp_name'];
    $data_dukung = $file['name'];
    $size = $file['size'];

    // validate extension file
    $file_extension = pathinfo($file["name"], PATHINFO_EXTENSION);
    $allowed_extension = array(
      "pdf",
      "doc",
      "docx"
    );
    if(!in_array($file_extension, $allowed_extension)) {
      return 0;
    }

    if($size < 50000 * 1000){
      move_uploaded_file($temp, "../public/files/whistle/". $data_dukung);
    }else{
      return 0;
    }

    $query = "INSERT INTO ".$this->table." (pelapor,nama_pelaporan,instansi,alamat,email,telepon,judul_laporan,uraian_laporan,data_dukung,pelanggaran,tanggal) 
    VALUES (:pelapor,:nama_pelaporan,:instansi,:alamat,:email,:telepon,:judul_laporan,:uraian_laporan,:data_dukung,:pelanggaran,:tanggal)";

    $pelanggaran = implode(",", $data['pelanggaran']);

    $this->db->query($query);
    $this->db->bind('pelapor',$_SESSION['nip']);
    $this->db->bind('nama_pelaporan',$data['nama']);
    $this->db->bind('instansi',$data['instansi']);
    $this->db->bind('alamat',$data['alamat']);
    $this->db->bind('email',$data['email']);
    $this->db->bind('telepon',$data['no_telp']);
    $this->db->bind('judul_laporan',$data['judul_laporan']);
    $this->db->bind('uraian_laporan',$data['uraian_laporan']);
    $this->db->bind('data_dukung',$data_dukung);
    $this->db->bind('pelanggaran',$pelanggaran);
    $this->db->bind('tanggal', date('Y-m-d'));
    
    if($this->db->execute()){
      return true;
    }else{
      return false;
    }
  }

  public function update($data)
  {
      $query = "UPDATE ".$this->table." SET nama=:nama,instansi=:instansi,alamat=:alamat,email=:email,telepon=:telepon,judul_laporan=:judul_laporan,uraian_laporan=:uraian_laporan,pelanggaran=:pelanggaran,tanggal=:tanggal WHERE id=:id";

      $pelanggaran = implode(",", $data['pelanggaran']);

      $this->db->query($query);
      $this->db->bind('id',$data['id']);
      $this->db->bind('nama',$data['nama']);
      $this->db->bind('instansi',$data['instansi']);
      $this->db->bind('alamat',$data['alamat']);
      $this->db->bind('email',$data['email']);
      $this->db->bind('telepon',$data['no_telp']);
      $this->db->bind('judul_laporan',$data['judul_laporan']);
      $this->db->bind('uraian_laporan',$data['uraian_laporan']);
      $this->db->bind('pelanggaran',$pelanggaran);
      $this->db->bind('tanggal', date('Y-m-d'));
      $this->db->execute();

      return $this->db->rowCount();
  }

  public function delete($id){
    $query = "SELECT * FROM ".$this->table." WHERE id=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    $data = $this->db->single();
    
    if(unlink("../public/files/whistle/".$data->data_dukung)){
      $query = "DELETE FROM ".$this->table." WHERE id=:id";
      $this->db->query($query);
      $this->db->bind('id', $id);
      $this->db->execute();

      return $this->db->rowCount();
    }else{
      return false;
    }
  }
}

?>