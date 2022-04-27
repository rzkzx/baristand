<?php

class IjinKeluarModel
{ 
  private $table = 'ijin_keluar';
  private $db;

  public function __construct()
  {
      $this->db = new Database;
  }

  //for count in dashboard
  public function getAllCountByMonth()
  {
      $query = "SELECT * FROM ".$this->table." WHERE MONTH(tanggal_ijin)=:month";
      $this->db->query($query);
      $this->db->bind('month', date('m'));

      return $this->db->resultSet();
  }
  public function getAllCountPercent()
  {
        $query = "SELECT * FROM ".$this->table." WHERE MONTH(tanggal_ijin)=:month";
        $this->db->query($query);
        $this->db->bind('month', date('m'));
        $now = $this->db->resultSet();

        $query2 = "SELECT * FROM ".$this->table." WHERE MONTH(tanggal_ijin)=:month";
        $this->db->query($query2);
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
      $query = "SELECT ijin_keluar.*,users.nama FROM ".$this->table." LEFT JOIN users ON users.nip=ijin_keluar.pemohon ORDER BY id DESC";
      $this->db->query($query);

      return $this->db->resultSet();
  }
  public function getAllPejabatValidasi()
  {
      $query = "SELECT ijin_keluar.*,users.nama FROM ".$this->table." LEFT JOIN users ON users.nip=ijin_keluar.pejabat_validasi ORDER BY id DESC";
      $this->db->query($query);

      return $this->db->resultSet();
  }
  public function getById($id){
    $query = "SELECT ijin_keluar.*, users.nama, users.no_telp FROM ".$this->table." LEFT JOIN users ON users.nip=ijin_keluar.pemohon WHERE ijin_keluar.id=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);

    return $this->db->single();
  }
  public function getByUserLogin()
  {
    $query = "SELECT ijin_keluar.*,users.nama FROM ".$this->table." LEFT JOIN users ON users.nip=ijin_keluar.pemohon WHERE ijin_keluar.pemohon=:nip_user ORDER BY ijin_keluar.tanggal_ijin DESC";
    $this->db->query($query);
    $this->db->bind('nip_user',$_SESSION['nip']);

    return $this->db->resultSet();
  }
  public function getByAtasan()
  {
    $query = "SELECT ijin_keluar.*,users.nama FROM ".$this->table." LEFT JOIN users ON users.nip=ijin_keluar.pemohon WHERE ijin_keluar.pejabat_validasi=:nip_user ORDER BY ijin_keluar.tanggal_ijin DESC";
    $this->db->query($query);
    $this->db->bind('nip_user',$_SESSION['nip']);

    return $this->db->resultSet();
  }
  public function getPejabatValidasi()
  {
      $query = "SELECT ijin_keluar.*,users.nama FROM ".$this->table." LEFT JOIN users ON users.nip=ijin_keluar.pejabat_validasi WHERE ijin_keluar.pemohon=:nip_user ORDER BY ijin_keluar.tanggal_ijin DESC";
      $this->db->query($query);
      $this->db->bind('nip_user',$_SESSION['nip']);

      return $this->db->resultSet();
  }

  // get model By Date
  public function getAllByDate($date1,$date2)
  {
    $dateOne = date("Y-m-d", strtotime($date1));
    $dateTwo = date("Y-m-d", strtotime($date2));
    $query= "SELECT ijin_keluar.*,users.nama FROM ".$this->table." LEFT JOIN users ON users.nip=ijin_keluar.pemohon WHERE ijin_keluar.tanggal_ijin BETWEEN :start_date AND :end_date ORDER BY id DESC";
    $this->db->query($query);
    $this->db->bind('start_date',$dateOne);
    $this->db->bind('end_date',$dateTwo);

    return $this->db->resultSet();
  }
  public function getAllPejabatValidasiByDate($date1,$date2)
  {
      $dateOne = date("Y-m-d", strtotime($date1));
      $dateTwo = date("Y-m-d", strtotime($date2));
      $query = "SELECT ijin_keluar.*,users.nama FROM ".$this->table." LEFT JOIN users ON users.nip=ijin_keluar.pejabat_validasi WHERE ijin_keluar.tanggal_ijin BETWEEN :start_date AND :end_date ORDER BY id DESC";
      $this->db->query($query);
      $this->db->bind('start_date',$dateOne);
      $this->db->bind('end_date',$dateTwo);

      return $this->db->resultSet();
  }
  // get model by Date 
  public function getByAtasanByDate($date1,$date2)
  {
      $dateOne = date("Y-m-d", strtotime($date1));
      $dateTwo = date("Y-m-d", strtotime($date2));
      $query = "SELECT ijin_keluar.*,users.nama FROM ".$this->table." LEFT JOIN users ON users.nip=ijin_keluar.pemohon WHERE pejabat_validasi=:nip_user AND ijin_keluar.tanggal_ijin BETWEEN :start_date AND :end_date ORDER BY id DESC";
      $this->db->query($query);
      $this->db->bind('nip_user',$_SESSION['nip']);
      $this->db->bind('start_date',$dateOne);
      $this->db->bind('end_date',$dateTwo);

      return $this->db->resultSet();
  }
  public function getByAtasanPejabatValidasiByDate($date1,$date2)
  {
      $dateOne = date("Y-m-d", strtotime($date1));
      $dateTwo = date("Y-m-d", strtotime($date2));
      $query = "SELECT ijin_keluar.*,users.nama FROM ".$this->table." LEFT JOIN users ON users.nip=ijin_keluar.pejabat_validasi WHERE pejabat_validasi=:nip_user AND ijin_keluar.tanggal_ijin BETWEEN :start_date AND :end_date ORDER BY id DESC";
      $this->db->query($query);
      $this->db->bind('nip_user',$_SESSION['nip']);
      $this->db->bind('start_date',$dateOne);
      $this->db->bind('end_date',$dateTwo);

      return $this->db->resultSet();
  }


  // add model
  public function add($data)
  {
      $tanggal = date('Y-m-d');
      
      $query = "INSERT INTO ".$this->table." (pemohon,keperluan,jam_keluar,jam_kembali,tanggal_ijin,pejabat_validasi,tanggal_dibuat) VALUES (:pemohon,:keperluan,:jam_keluar,:jam_kembali,:tanggal_ijin,:pejabat_validasi,:tanggal_dibuat)";
      $this->db->query($query);
      $this->db->bind('pemohon',$data['pemohon']);
      $this->db->bind('keperluan',$data['keperluan']);
      $this->db->bind('jam_keluar',$data['jam_keluar']);
      $this->db->bind('jam_kembali',$data['jam_kembali']);
      $this->db->bind('tanggal_ijin',$data['tanggal_ijin']);
      $this->db->bind('pejabat_validasi',$data['pejabat_validasi']);
      $this->db->bind('tanggal_dibuat',$tanggal);
      //execute 
      if($this->db->execute()){
        return true;
      }else{
          return false;
      }
  }

  public function update($data)
  {
      $waktu_validasi = date('Y-m-d').', '.date('H:i');
      $alasan_ditolak = $data['alasan_ditolak'];
      if($data['validasi'] == 'Diterima'){
        $alasan_ditolak = NULL;
      }

      $query = "UPDATE ".$this->table." SET validasi=:validasi,waktu_validasi=:waktu_validasi,alasan_ditolak=:alasan_ditolak WHERE id=:id";
      $this->db->query($query);
      $this->db->bind('id',$data['id']);
      $this->db->bind('validasi',$data['validasi']);
      $this->db->bind('waktu_validasi',$waktu_validasi);
      $this->db->bind('alasan_ditolak', $alasan_ditolak);
  
      //execute 
      if($this->db->execute()){
        return true;
      }else{
          return false;
      }
  }
}

?>