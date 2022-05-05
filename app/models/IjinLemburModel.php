<?php

class IjinLemburModel
{
  private $table = 'ijin_lembur';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function add($data)
  {
      $tanggal = date('Y-m-d');
      $pemohon = implode(',',$data['pemohon']);
      
      $query = "INSERT INTO ".$this->table." (pemohon,penginput,keperluan,keterangan,jam_mulai,jam_berakhir,tanggal_ijin,pejabat_validasi,tanggal_dibuat) VALUES (:pemohon,:penginput,:keperluan,:keterangan,:jam_mulai,:jam_berakhir,:tanggal_ijin,:pejabat_validasi,:tanggal_dibuat)";
      $this->db->query($query);
      $this->db->bind('pemohon',$pemohon);
      $this->db->bind('penginput',$_SESSION['nip']);
      $this->db->bind('keperluan',$data['keperluan']);
      $this->db->bind('keterangan',$data['keterangan']);
      $this->db->bind('jam_mulai',$data['jam_mulai']);
      $this->db->bind('jam_berakhir',$data['jam_berakhir']);
      $this->db->bind('tanggal_ijin',$data['tanggal_ijin']);
      $this->db->bind('tanggal_dibuat',$tanggal);
      $this->db->bind('pejabat_validasi',$data['pejabat_validasi']);
      $this->db->execute();

      return $this->db->rowCount();
  }

  public function validasiAtasan($data)
  {
      $waktu_validasi = date('Y-m-d').', '.date('H:i');
      $alasan_ditolak = $data['alasan_ditolak'];
      if($data['validasi'] == 'Diterima'){
        $alasan_ditolak = '';
      }

      $query = "UPDATE ".$this->table." SET validasi_atasan_langsung=:validasi_atasan_langsung,waktu_validasi_atasan_langsung=:waktu_validasi_atasan_langsung,alasan_ditolak=:alasan_ditolak WHERE id=:id";
      $this->db->query($query);
      $this->db->bind('id',$data['id']);
      $this->db->bind('validasi_atasan_langsung',$data['validasi']);
      $this->db->bind('waktu_validasi_atasan_langsung',$waktu_validasi);
      $this->db->bind('alasan_ditolak', $alasan_ditolak);
  
      $this->db->execute();
      return $this->db->rowCount();
  }

  public function validasiKB($data)
  {
      $waktu_validasi = date('Y-m-d').', '.date('H:i');
      $alasan_ditolak = $data['alasan_ditolak'];
      if($data['validasi'] == 'Diterima'){
        $alasan_ditolak = '';
      }

      $query = "UPDATE ".$this->table." SET validasi_kepala_balai=:validasi_kepala_balai,waktu_validasi_kepala_balai=:waktu_validasi_kepala_balai,alasan_ditolak=:alasan_ditolak WHERE id=:id";
      $this->db->query($query);
      $this->db->bind('id',$data['id']);
      $this->db->bind('validasi_kepala_balai',$data['validasi']);
      $this->db->bind('waktu_validasi_kepala_balai',$waktu_validasi);
      $this->db->bind('alasan_ditolak', $alasan_ditolak);
  
      $this->db->execute();
      return $this->db->rowCount();
  }

  public function terbitkan($data)
  {
      $start = strtotime($data['jam_mulai']);
      $end = strtotime($data['jam_berakhir']);
      $total = ($end - $start) / 60 / 60;
      $jam = floor($total);
      $menit = ($total - $jam) * 60;
      if($menit < 1){
        $lama_tugas = $jam.' Jam ';
      }else{
        $lama_tugas = $jam.' Jam '.$menit.' Menit ';
      }
      

      $nomor_surat = join('',$data['nomor_surat']);
      
      $query = "UPDATE ".$this->table." SET nomor_surat=:nomor_surat,tanggal_surat=:tanggal_surat,keperluan=:keperluan,keterangan=:keterangan,jam_mulai=:jam_mulai,jam_berakhir=:jam_berakhir,lama_tugas=:lama_tugas,tanggal_ijin=:tanggal_ijin,diterbitkan=:diterbitkan WHERE id=:id";
      $this->db->query($query);
      $this->db->bind('id',$data['id']);
      $this->db->bind('nomor_surat',$nomor_surat);
      $this->db->bind('tanggal_surat',$data['tanggal_surat']);
      $this->db->bind('keperluan',$data['keperluan']);
      $this->db->bind('keterangan',$data['keterangan']);
      $this->db->bind('jam_mulai',$data['jam_mulai']);
      $this->db->bind('jam_berakhir',$data['jam_berakhir']);
      $this->db->bind('lama_tugas',$lama_tugas);
      $this->db->bind('tanggal_ijin',$data['tanggal_ijin']);
      $this->db->bind('diterbitkan',TRUE);

      $this->db->execute();
      return $this->db->rowCount();
  }

  public function getAll()
  {
      $query = "SELECT * FROM ".$this->table." ORDER BY id DESC";
      $this->db->query($query);

      return $this->db->resultSet();
  }

  public function getByUserLogin()
  {
    $query = "SELECT * FROM ".$this->table." WHERE ijin_lembur.penginput=:nip_user ORDER BY id DESC";
    $this->db->query($query);
    $this->db->bind('nip_user',$_SESSION['nip']);

    return $this->db->resultSet();
  }

  public function getByAtasan()
  {
    $query = "SELECT * FROM ".$this->table." WHERE ijin_lembur.pejabat_validasi=:nip_user ORDER BY id DESC";
    $this->db->query($query);
    $this->db->bind('nip_user',$_SESSION['nip']);

    return $this->db->resultSet();
  }

  public function getByAtasanNotValidate()
  {
    $query = "SELECT * FROM ".$this->table." WHERE pejabat_validasi=:nip_user AND validasi_atasan_langsung IS NULL ORDER BY id DESC";
    $this->db->query($query);
    $this->db->bind('nip_user',$_SESSION['nip']);

    return $this->db->resultSet();
  }

  public function getByKBNotValidate()
  {
    $query = "SELECT * FROM ".$this->table." WHERE validasi_atasan_langsung='DITERIMA' AND validasi_kepala_balai IS NULL ORDER BY id DESC";
    $this->db->query($query);

    return $this->db->resultSet();
  }

  public function getByNomorNotInput()
  {
    $query = "SELECT * FROM ".$this->table." WHERE validasi_kepala_balai='DITERIMA' AND nomor_surat IS NULL ORDER BY id DESC";
    $this->db->query($query);

    return $this->db->resultSet();
  }

  public function rekapAll()
  {
      $query = "SELECT * FROM ".$this->table." WHERE diterbitkan=:terbit ORDER BY id DESC";
      $this->db->query($query);
      $this->db->bind('terbit',TRUE);

      return $this->db->resultSet();
  }
  public function rekapAllByDate($date1,$date2)
  {
      $dateOne = date("Y-m-d", strtotime($date1));
      $dateTwo = date("Y-m-d", strtotime($date2));
      $query = "SELECT * FROM ".$this->table." WHERE diterbitkan=:terbit AND ijin_lembur.tanggal_ijin BETWEEN :start_date AND :end_date ORDER BY id DESC";
      $this->db->query($query);
      $this->db->bind('terbit',TRUE);
      $this->db->bind('start_date',$dateOne);
      $this->db->bind('end_date',$dateTwo);

      return $this->db->resultSet();
  }

  public function rekapByNIP()
  {
    $query = "SELECT * FROM ".$this->table." WHERE diterbitkan=:terbit AND ijin_lembur.pejabat_validasi=:nip_user ORDER BY id DESC";
    $this->db->query($query);
    $this->db->bind('terbit',TRUE);
    $this->db->bind('nip_user',$_SESSION['nip']);

    return $this->db->resultSet();
  }
  public function rekapByNIPByDate($date1,$date2)
  {
    $dateOne = date("Y-m-d", strtotime($date1));
    $dateTwo = date("Y-m-d", strtotime($date2));
    $query = "SELECT * FROM ".$this->table." WHERE diterbitkan=:terbit AND ijin_lembur.pejabat_validasi=:nip_user AND ijin_lembur.tanggal_ijin BETWEEN :start_date AND :end_date ORDER BY id DESC";
    $this->db->query($query);
    $this->db->bind('terbit',TRUE);
    $this->db->bind('nip_user',$_SESSION['nip']);
    $this->db->bind('start_date',$dateOne);
    $this->db->bind('end_date',$dateTwo);

    return $this->db->resultSet();
  }

  public function getById($id){
    $query = "SELECT * FROM ".$this->table." WHERE ijin_lembur.id=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);

    return $this->db->single();
  }
}

?>