<?php

class SuratTugasModel
{ 
  private $table = 'surat_tugas';
  private $db;

  public function __construct()
  {
      $this->db = new Database;
  }

  //for count in dashboard
  public function getAllCountByMonth()
  {
      $query = "SELECT * FROM ".$this->table." WHERE MONTH(tanggal_permohonan)=:month";
      $this->db->query($query);
      $this->db->bind('month', date('m'));

      return $this->db->resultSet();
  }

  public function getAll()
  {
      $query = "SELECT surat_tugas.*,users.nama FROM ".$this->table." LEFT JOIN users ON users.nip=surat_tugas.pemohon";
      $this->db->query($query);

      return $this->db->resultSet();
  }

  public function getById($id){
    $query = "SELECT surat_tugas.*,users.nama,users.jabatan FROM ".$this->table." LEFT JOIN users ON users.nip=surat_tugas.pengusul WHERE surat_tugas.id=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);

    return $this->db->single();
  }
  public function getTugasById($id){
    $query = "SELECT surat_tugas.*,users.nama,users.jabatan,users.golongan FROM ".$this->table." LEFT JOIN users ON users.nip=surat_tugas.nip_ditugaskan WHERE surat_tugas.id=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);

    return $this->db->single();
  }
  public function getPPKById($id){
    $query = "SELECT surat_tugas.*,users.nama,users.jabatan FROM ".$this->table." LEFT JOIN users ON users.nip=surat_tugas.nip_ppk WHERE surat_tugas.id=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);

    return $this->db->single();
  }

  public function getByNIP(){
    $query = "SELECT surat_tugas.*,users.nama FROM ".$this->table." LEFT JOIN users ON users.nip=surat_tugas.pemohon WHERE pemohon=:id OR pengusul=:id";
    $this->db->query($query);
    $this->db->bind('id', $_SESSION['nip']);

    return $this->db->resultSet();
  }

  public function add($data,$file)
  {
    $temp = $file['tmp_name'];
    $nama_file = $file['name'];
    $size = $file['size'];
    $tanggal = date ('Y-m-d');
    $lama_tugas = dateDiff($data['tanggal_berangkat'],$data['tanggal_kembali']) + 1;
    $pengikut = implode(',',$data['pengikut']);

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
      move_uploaded_file($temp, "../public/files/dasar_surat/". $nama_file);
    }else{
      return 0;
    }

    $query = "INSERT INTO ".$this->table." (pemohon,tanggal_permohonan,pengusul,nip_ditugaskan,tujuan_tugas,keperluan_tugas,tanggal_berangkat,tanggal_kembali,lama_tugas,instansi_dituju,is_biaya,pengikut,dasar_surat,detail_perjalanan,nip_ppk) VALUES (:pemohon,:tanggal_permohonan,:pengusul,:nip_ditugaskan,:tujuan_tugas,:keperluan_tugas,:tanggal_berangkat,:tanggal_kembali,:lama_tugas,:instansi_dituju,:is_biaya,:pengikut,:dasar_surat,:detail_perjalanan,:nip_ppk)";


    $this->db->query($query);
    $this->db->bind('pemohon',$_SESSION['nip']);
    $this->db->bind('tanggal_permohonan',$tanggal);
    $this->db->bind('pengusul',$data['pengusul']);
    $this->db->bind('nip_ditugaskan',$data['nip_ditugaskan']);
    $this->db->bind('tujuan_tugas',$data['tujuan_tugas']);
    $this->db->bind('keperluan_tugas',$data['keperluan_tugas']);
    $this->db->bind('tanggal_berangkat',$data['tanggal_berangkat']);
    $this->db->bind('tanggal_kembali',$data['tanggal_kembali']);
    $this->db->bind('lama_tugas',$lama_tugas.' Hari');
    $this->db->bind('instansi_dituju',$data['instansi_dituju']);
    $this->db->bind('is_biaya',$data['is_biaya']);
    $this->db->bind('pengikut',$pengikut);
    $this->db->bind('dasar_surat',$nama_file);
    $this->db->bind('detail_perjalanan',$data['detail_perjalanan']);
    $this->db->bind('nip_ppk',$data['nip_ppk']);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function deleteLaporan($id){
    $query = "SELECT * FROM ".$this->table." WHERE id=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    $data = $this->db->single();
    
    unlink("dist/files/dasar_surat/".$data['dasar_surat']);

    $query = "DELETE FROM ".$this->table." WHERE id=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    $this->db->execute();

    return $this->db->rowCount();
  }
  
  public function validasiAtasan($data)
  {
      $waktu_validasi = date('Y-m-d H:i');

      $query = "UPDATE ".$this->table." SET validasi_atasan_langsung=:validasi_atasan_langsung,waktu_validasi_atasan_langsung=:waktu_validasi_atasan_langsung,alasan_ditolak=:alasan_ditolak WHERE id=:id";
      $this->db->query($query);
      $this->db->bind('id',$data['id']);
      $this->db->bind('validasi_atasan_langsung',$data['validasi']);
      $this->db->bind('waktu_validasi_atasan_langsung',$waktu_validasi);
      $this->db->bind('alasan_ditolak', $data['alasan_ditolak']);
  
      $this->db->execute();
      return $this->db->rowCount();
  }

  public function validasiPPK($data)
  {
      $waktu_validasi = date('Y-m-d H:i');
      $anggaran = NULL;
      if($data['anggaran']){
        $anggaran = $data['anggaran'];
      }

      $query = "UPDATE ".$this->table." SET validasi_ppk=:validasi_ppk,waktu_validasi_ppk=:waktu_validasi_ppk,anggaran=:anggaran,alasan_ditolak=:alasan_ditolak WHERE id=:id";
      $this->db->query($query);
      $this->db->bind('id',$data['id']);
      $this->db->bind('validasi_ppk',$data['validasi']);
      $this->db->bind('waktu_validasi_ppk',$waktu_validasi);
      $this->db->bind('anggaran',$anggaran);
      $this->db->bind('alasan_ditolak', $data['alasan_ditolak']);

      if($this->db->execute()){
        return true;
      }else{
        return false;
      }
  }

  

  public function validasiKB($data)
  {
      $waktu_validasi = date('Y-m-d H:i');

      $query = "UPDATE ".$this->table." SET validasi_kepala_balai=:validasi_kepala_balai,waktu_validasi_kepala_balai=:waktu_validasi_kepala_balai,alasan_ditolak=:alasan_ditolak WHERE id=:id";
      $this->db->query($query);
      $this->db->bind('id',$data['id']);
      $this->db->bind('validasi_kepala_balai',$data['validasi']);
      $this->db->bind('waktu_validasi_kepala_balai',$waktu_validasi);
      $this->db->bind('alasan_ditolak', $data['alasan_ditolak']);
  
      $this->db->execute();
      return $this->db->rowCount();
  }

  public function inputNomorSurat($data,$file)
  {
      $nama_file_st = NULL;
      $nama_file_spd = NULL;
      if($file['file_st']){
        $file_st = $file['file_st'];
        move_uploaded_file($file_st['tmp_name'], "../public/files/surat_tugas/". $file_st['name']);
        $nama_file_st = $file_st['name'];
      }
      if($file['file_spd']){
        $file_spd = $file['file_spd'];
        move_uploaded_file($file_spd['tmp_name'], "../public/files/surat_pd/". $file_spd['name']);
        $nama_file_spd = $file_spd['name'];
      }
      if($file['file_spd2']){
        $file_spd2 = $file['file_spd2'];
        move_uploaded_file($file_spd2['tmp_name'], "../public/files/surat_pd/". $file_spd2['name']);
        $nama_file_spd2 = $file_spd2['name'];
      }
      if($file['file_spd3']){
        $file_spd3 = $file['file_spd3'];
        move_uploaded_file($file_spd3['tmp_name'], "../public/files/surat_pd/". $file_spd3['name']);
        $nama_file_spd3 = $file_spd3['name'];
      }

      $nomor_surat = join('',$data['nomor_surat']);

      $query = "UPDATE ".$this->table." SET nomor_surat=:nomor_surat,disahkan=:disahkan,file_st=:file_st,file_spd=:file_spd,file_spd2=:file_spd2,file_spd3=:file_spd3 WHERE id=:id";
      $this->db->query($query);
      $this->db->bind('id',$data['id']);
      $this->db->bind('nomor_surat',$nomor_surat);
      $this->db->bind('disahkan',TRUE);
      $this->db->bind('file_st',$nama_file_st);
      $this->db->bind('file_spd',$nama_file_spd);
      $this->db->bind('file_spd2',$nama_file_spd2);
      $this->db->bind('file_spd3',$nama_file_spd3);
  
      if($this->db->execute()){
        return true;
      }else{
        return false;
      }
  }
  
  
  public function rekapAll()
  {
      $query = "SELECT surat_tugas.*,users.nama,users.jabatan,users.golongan FROM ".$this->table." LEFT JOIN users ON users.nip=surat_tugas.pemohon WHERE disahkan=:terbit ORDER BY id DESC";
      $this->db->query($query);
      $this->db->bind('terbit',TRUE);

      return $this->db->resultSet();
  }

  public function rekapAllByDate($date1,$date2)
  {
      $dateOne = date("Y-m-d", strtotime($date1));
      $dateTwo = date("Y-m-d", strtotime($date2));
      $query = "SELECT surat_tugas.*,users.nama,users.jabatan,users.golongan FROM ".$this->table." LEFT JOIN users ON users.nip=surat_tugas.pemohon WHERE disahkan=:terbit AND surat_tugas.tanggal_permohonan BETWEEN :start_date AND :end_date ORDER BY id DESC";
      $this->db->query($query);
      $this->db->bind('terbit',TRUE);
      $this->db->bind('start_date',$dateOne);
      $this->db->bind('end_date',$dateTwo);

      return $this->db->resultSet();
  }


  public function ianggaranAll()
  {
      $query = "SELECT surat_tugas.*,users.nama,users.jabatan,users.golongan FROM ".$this->table." LEFT JOIN users ON users.nip=surat_tugas.pemohon WHERE disahkan=:terbit ORDER BY id DESC";
      $this->db->query($query);
      $this->db->bind('terbit',TRUE);

      return $this->db->resultSet();
  }
  
  public function getByAtasanNotValidate()
  {
    $query = "SELECT * FROM ".$this->table." WHERE pengusul=:nip_user AND validasi_atasan_langsung IS NULL";
    $this->db->query($query);
    $this->db->bind('nip_user',$_SESSION['nip']);

    return $this->db->resultSet();
  }

  public function getByPPKNotValidate()
  {
    $query = "SELECT * FROM ".$this->table." WHERE nip_ppk=:nip_user AND validasi_atasan_langsung=:disetujui AND validasi_ppk IS NULL";
    $this->db->query($query);
    $this->db->bind('nip_user',$_SESSION['nip']);
    $this->db->bind('disetujui','Disetujui');

    return $this->db->resultSet();
  }

  public function getByKBNotValidate()
  {
    $query = "SELECT * FROM ".$this->table." WHERE validasi_ppk=:disetujui AND validasi_kepala_balai IS NULL";
    $this->db->query($query);
    $this->db->bind('disetujui','Disetujui');

    return $this->db->resultSet();
  }

  public function getByNomorNotInput()
  {
    $query = "SELECT * FROM ".$this->table." WHERE validasi_kepala_balai=:disetujui AND nomor_surat IS NULL";
    $this->db->query($query);
    $this->db->bind('disetujui','Disetujui');

    return $this->db->resultSet();
  }
}

?>