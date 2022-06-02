<?php

Class PengadaanModel
{
  private $table = 'pengadaan';
  private $table2 = 'tbahan';
  private $tablebp = 'bahan_pengadaan';
  private $db;

  public function __construct()
  {
      $this->db = new Database;
  }

  public function getAll()
  {
      $query = "SELECT pengadaan.*,users.nama FROM ".$this->table. " LEFT JOIN users ON users.nip=pengadaan.nip_pemohon";
      $this->db->query($query);

      return $this->db->resultSet();
  }

  public function getByNIP($nip)
  {
    $query = "SELECT pengadaan.*,users.nama FROM ".$this->table." LEFT JOIN users ON users.nip=pengadaan.nip_pemohon
    WHERE pengadaan.user=:nip_user or pengadaan.nip_pemohon=:nip_user or pengadaan.nip_atasan=:nip_user or pengadaan.nip_penanggung=:nip_user or pengadaan.nip_petugas_pengadaan=:nip_user ORDER BY id DESC";
    $this->db->query($query);
    $this->db->bind('nip_user',$nip);

    return $this->db->resultSet();
  }

  public function getPenugasanAll()
  {
      $query = "SELECT * FROM ".$this->tablebp;
      $this->db->query($query);

      return $this->db->resultSet();
  }

  public function getAllSelesai()
  {
      $query = "SELECT pengadaan.*, users.nama FROM ".$this->table. " JOIN users ON users.nip=pengadaan.nip_pemohon WHERE pengadaan.nip_pemohon AND hasil IN (:hasil)";
      $this->db->query($query);
      $this->db->bind('hasil',"Hasil diterima");

      return $this->db->resultSet();
  }

  public function getAllSelesaiByDate($date1,$date2)
  {
    $dateOne = date("Y-m-d", strtotime($date1));
    $dateTwo = date("Y-m-d", strtotime($date2));
    $query= "SELECT pengadaan.*,users.nama FROM ".$this->table." JOIN users ON users.nip=pengadaan.nip_pemohon WHERE pengadaan.nip_pemohon AND hasil IN (:hasil) AND pengadaan.tanggal BETWEEN :start_date AND :end_date ORDER BY id DESC";
    $this->db->query($query);
    $this->db->bind('start_date',$dateOne);
    $this->db->bind('end_date',$dateTwo);
    $this->db->bind('hasil',"Pengadaan selesai");

    return $this->db->resultSet();
  }

public function cek()
  {
    $query = "SELECT tbahan.* FROM ".$this->table2;
    $this->db->query($query);

      return $this->db->rowCount();
  }

public function getBySerial($serial_number){
  $query = "SELECT pengadaan.*, users.nama, users.no_telp FROM ".$this->table." LEFT JOIN users ON users.nip=pengadaan.nip_pemohon WHERE pengadaan.serial_number=:serial_number";
  $this->db->query($query);
  $this->db->bind('serial_number', $serial_number);

  return $this->db->single();
}

public function getBahanBySerial($serial_number){
  $query = "SELECT pengadaan.*, bahan_pengadaan.* FROM ".$this->table." JOIN bahan_pengadaan ON bahan_pengadaan.seri_pengadaan=pengadaan.serial_number WHERE pengadaan.serial_number=:serial_number";
  $this->db->query($query);
  $this->db->bind(':serial_number', $serial_number);

  $pengadaan = $this->db->resultSet();

  $no = 0;
      foreach ($pengadaan as $k) {
        if($k->nip_petugas){
          $query2 = "SELECT * FROM users WHERE nip=:nip";
          $this->db->query($query2);
          $this->db->bind('nip',$k->nip_petugas);
          $petugas = $this->db->single();
          $pengadaan[$no]->petugas_pengadaan = $petugas->nama;
        }
        $no++;
      }
      return $pengadaan;
}

public function getByPetugass($nip){
  $query = "SELECT bahan_pengadaan.*, pengadaan.nip_penanggung, pengadaan.waktu_penugasan, pengadaan.penugasan FROM ".$this->tablebp." RIGHT JOIN pengadaan ON pengadaan.serial_number=bahan_pengadaan.seri_pengadaan WHERE nip_petugas=:nip_petugas";
  $this->db->query($query);
  $this->db->bind('nip_petugas', $nip);
  $pengadaan = $this->db->resultSet();

  $no = 0;
      foreach ($pengadaan as $k) {
        if($k->nip_penanggung){
          $query2 = "SELECT * FROM users WHERE nip=:nip";
          $this->db->query($query2);
          $this->db->bind('nip',$k->nip_penanggung);
          $petugas = $this->db->single();
          $pengadaan[$no]->penanggung = $petugas->nama;
        }
        $no++;
      }
      return $pengadaan;
}

public function getByPetugas($serial_number){
  $query = "SELECT bahan_pengadaan.*, pengadaan.nip_penanggung, pengadaan.waktu_penugasan, pengadaan.penugasan FROM ".$this->tablebp." RIGHT JOIN pengadaan ON pengadaan.serial_number=bahan_pengadaan.seri_pengadaan WHERE pengadaan.serial_number=:serial_number AND nip_petugas=:nip_petugas";
  $this->db->query($query);
  $this->db->bind(':serial_number', $serial_number);
  $this->db->bind(':nip_petugas', $_SESSION['nip']);
  $pengadaan = $this->db->resultSet();

  $no = 0;
      foreach ($pengadaan as $k) {
        if($k->nip_penanggung){
          $query2 = "SELECT * FROM users WHERE nip=:nip";
          $this->db->query($query2);
          $this->db->bind(':nip',$k->nip_penanggung);
          $petugas = $this->db->single();
          $pengadaan[$no]->penanggung = $petugas->nama;
        }
        $no++;
      }
      return $pengadaan;
}

public function getBySerialAtasan($serial_number){
  $query = "SELECT pengadaan.*, users.nama FROM ".$this->table." LEFT JOIN users ON users.nip=pengadaan.nip_atasan WHERE pengadaan.serial_number=:serial_number";
  $this->db->query($query);
  $this->db->bind('serial_number', $serial_number);

  return $this->db->single();
}

public function getBySerialPenanggung($serial_number){
  $query = "SELECT pengadaan.*, users.nama FROM ".$this->table." LEFT JOIN users ON users.nip=pengadaan.nip_penanggung WHERE pengadaan.serial_number=:serial_number";
  $this->db->query($query);
  $this->db->bind('serial_number', $serial_number);

  return $this->db->single();
}

  public function add($data)
  {
      $user = $_SESSION['nip'];
      $tanggal = date('Y-m-d');
      $jam = date('H:i');
      $keterangan = '';
      foreach($data['ketbahan'] as $bahan){
        $keterangan .= $bahan;
      }
      $seri = '';
      foreach($data['serial'] as $nomer){
        $seri .= $nomer;
      }

      $query = "UPDATE ".$this->table2." SET seri_pengadaan=:seri_pengadaan";
      $this->db->query($query);
      $this->db->bind('seri_pengadaan', $seri) ;
      $this->db->execute();

      $query2 = "INSERT INTO ".$this->table." (serial_number, user, tanggal, jam, nip_pemohon, nip_atasan, keterangan) 
      VALUES (:serial_number, :user, :tanggal, :jam, :nip_pemohon, :nip_atasan, :keterangan)";

      $this->db->query($query2);
      $this->db->bind('serial_number', $seri) ;
      $this->db->bind('user',$user);
      $this->db->bind('tanggal',$tanggal);
      $this->db->bind('jam',$jam);
      $this->db->bind('nip_pemohon',$data['nip_pemohon']);
      $this->db->bind('nip_atasan',$data['nip_atasan']);
      $this->db->bind('keterangan', $keterangan) ;
      $this->db->execute();

      $query3 = "INSERT INTO ".$this->tablebp."(id,nbahan,jumlah,keterangan,seri_pengadaan) SELECT id,nbahan,jumlah,keterangan,seri_pengadaan FROM tbahan";
      $this->db->query($query3);
      $this->db->execute();

      return $this->db->rowCount();
  }

  public function addId($data)
  {
      $user = $_SESSION['nip'];
      $tanggal = date('Y-m-d');
      $jam = date('H:i:s');
      $keterangan = '';
      foreach($data['ketbahan'] as $bahan){
        $keterangan .= $bahan;
      }

      $query = "INSERT INTO ".$this->table." (user, tanggal, jam, nip_pemohon, nip_atasan, keterangan) 
      VALUES (:user, :tanggal, :jam, :nip_pemohon, :nip_atasan, :keterangan)";

      $this->db->query($query);
      $this->db->bind('user',$user);
      $this->db->bind('tanggal',$tanggal);
      $this->db->bind('jam',$jam);
      $this->db->bind('nip_pemohon',$data['nip_pemohon']);
      $this->db->bind('nip_atasan',$data['nip_atasan']);
      $this->db->bind('keterangan', $keterangan);
      $this->db->execute();

      return $this->db->rowCount();
  }

  public function tambahan1($data)
  {
    $waktu = date('Y-m-d H:i');

    $query = "UPDATE ".$this->table." SET validasi1=:validasi1, alasan1=:alasan1, waktu_validasi1=:waktu_validasi1 WHERE serial_number=:serial_number";
    $this->db->query($query);
    $this->db->bind('waktu_validasi1',$waktu);
    $this->db->bind('serial_number',$data['serial']);
    $this->db->bind('validasi1',$data['validasi1']);
    $this->db->bind('alasan1',$data['alasan1']);

    if($this->db->execute()){
      return true;
    }else{
      return false;
    }
  }


  public function tambahan2($data)
  {
    $waktu_validasi2 = date('Y-m-d H:i');

    $query = "UPDATE ".$this->table." SET  alasan2=:alasan2, waktu_validasi2=:waktu_validasi2 WHERE serial_number=:serial_number";
    $this->db->query($query);
    $this->db->bind('waktu_validasi2',$waktu_validasi2);
    $this->db->bind('serial_number',$data['serial']);
    
    $this->db->bind('alasan2',$data['alasan2']);
    if($this->db->execute()){
      return true;
    }else{
      return false;
    }
  }

  
  public function tambahan3($data)
  {
    $waktu_validasi3 = date('Y-m-d H:i');

    $query = "UPDATE ".$this->table." SET  alasan3=:alasan3, waktu_validasi3=:waktu_validasi3 WHERE serial_number=:serial_number";
    $this->db->query($query);
    $this->db->bind('waktu_validasi3',$waktu_validasi3);
    $this->db->bind('serial_number',$data['serial']);
    $this->db->bind('alasan3',$data['alasan3']);

    if($this->db->execute()){
      return true;
    }else{
      return false;
    }
  }

  public function tambahanPpk($data)
  {
    $waktu = date('Y-m-d H:i');
    
    $query = "UPDATE ".$this->table." SET alasan_dispo=:alasan_dispo, waktu_disposisi=:waktu_disposisi WHERE serial_number=:serial_number";
    $this->db->query($query);
    $this->db->bind('serial_number',$data['serial']);
    $this->db->bind('waktu_disposisi',$waktu);
    $this->db->bind('alasan_dispo',$data['alasan_dispo']);

    if($this->db->execute()){
      return true;
    }else{
      return false;
    }
  }

  public function tambahanDispo($data)
  {
    $waktu = date('Y-m-d H:i');

    $query = "UPDATE ".$this->table." SET nip_penanggung=:nip_penanggung, disposisi=:disposisi, waktu_disposisi=:waktu_disposisi WHERE serial_number=:serial_number";
    $this->db->query($query);
    $this->db->bind('waktu_disposisi',$waktu);
    $this->db->bind('serial_number',$data['serial']);
    $this->db->bind('nip_penanggung',$data['nip_penanggung']);
    $this->db->bind('disposisi',$data['disposisi']);

    if($this->db->execute()){
      return true;
    }else{
      return false;
    }
  }

  public function tambahanPetugas($data)
  {
    $nip_petugas = end($data['nip_petugas']);
    $query = "UPDATE ".$this->tablebp." SET deadline=:deadline, nip_petugas=:nip_petugas WHERE id=:id";
    $this->db->query($query);
    $this->db->bind('id',$data['idb']);
    $this->db->bind('deadline',$data['deadline']);
    $this->db->bind('nip_petugas',$nip_petugas);

    if($this->db->execute()){
      return true;
    }else{
      return false;
    }
  }

  public function tambahanPetugasPengadaan($data)
  {
      $petugas = implode(',',$data['nip_petugas']);
      $query = "UPDATE ".$this->table." SET nip_petugas_pengadaan=:nip_petugas WHERE id=:id";
      $this->db->query($query);
      $this->db->bind('id',$data['id']);
      $this->db->bind('nip_petugas',$petugas);

      if($this->db->execute()){
        return true;
      }else{
        return false;
      }
  }

  public function tambahanPenugasan($data)
  {
    $waktu = date('Y-m-d H:i');

    $query = "UPDATE ".$this->table." SET waktu_penugasan=:waktu_penugasan, penugasan=:penugasan WHERE serial_number=:serial_number";
    $this->db->query($query);
    $this->db->bind('waktu_penugasan',$waktu);
    $this->db->bind('penugasan',$data['penugasan']);
    $this->db->bind('serial_number',$data['serial_number']);

    $this->db->execute();
    return $this->db->rowCount();
  }

  public function konfirmasiDiterima($data)
  {
    $waktu = date('Y-m-d H:i');

    $query = "UPDATE ".$this->tablebp." SET penerimaan=:penerimaan, waktu_diterima=:waktu_diterima WHERE id=:id";
    $this->db->query($query);
    $this->db->bind('id',$data['id']);
    $this->db->bind('penerimaan',$data['penerimaan']);
    $this->db->bind('waktu_diterima',$waktu);

    $this->db->execute();

    $query2 = "UPDATE ".$this->table." SET waktu_diterima=:waktu_diterima WHERE serial_number=:seri_pengadaan";
    $this->db->query($query2);
    $this->db->bind('seri_pengadaan',$data['seri_pengadaan']);
    $this->db->bind('waktu_diterima',$waktu);

    $this->db->execute();
    return $this->db->rowCount();
  }

  public function konfirmasiSelesai($data)
  {
    $waktu = date('Y-m-d H:i');

    $query = "UPDATE ".$this->tablebp." SET catatan=:catatan, verifikasi_selesai=:verifikasi_selesai, waktu_selesai=:waktu_selesai WHERE id=:id";
    $this->db->query($query);
    $this->db->bind('id',$data['id']);
    $this->db->bind('catatan',$data['catatan']);
    $this->db->bind('verifikasi_selesai',$data['verifikasi_selesai']);
    $this->db->bind('waktu_selesai',$waktu);

    $this->db->execute();
    
    $query2 = "UPDATE ".$this->table." SET verifikasi_selesai=:verifikasi_selesai, waktu_selesai=:waktu_selesai WHERE serial_number=:seri_pengadaan";
    $this->db->query($query2);
    $this->db->bind('seri_pengadaan',$data['seri_pengadaan']);
    $this->db->bind('verifikasi_selesai',$data['verifikasi_selesai']);
    $this->db->bind('waktu_selesai',$waktu);

    $this->db->execute();
    return $this->db->rowCount();
  }

  public function tambahanHasil($data)
  {
    $waktu = date('Y-m-d H:i');

    $query = "UPDATE ".$this->tablebp." SET hasil=:hasil, waktu_hasil=:waktu_hasil WHERE id=:id";
    $this->db->query($query);
    $this->db->bind('id',$data['id']);
    $this->db->bind('hasil',$data['hasil']);
    $this->db->bind('waktu_hasil',$waktu);

    $this->db->execute();
    return $this->db->rowCount();
  }

  public function tambahanHasilAkhir($data)
  {
    $waktu = date('Y-m-d H:i');

    $query = "UPDATE ".$this->table." SET hasil=:hasil, waktu_hasil=:waktu_hasil WHERE serial_number=:serial_number";
    $this->db->query($query);
    $this->db->bind('serial_number',$data['serial_number']);
    $this->db->bind('hasil',$data['hasil']);
    $this->db->bind('waktu_hasil',$waktu);

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

  public function getByAtasanNotValidate()
  {
    $query = "SELECT * FROM ".$this->table." WHERE nip_atasan=:nip_user AND waktu_validasi1 IS NULL";
    $this->db->query($query);
    $this->db->bind('nip_user',$_SESSION['nip']);

    return $this->db->resultSet();
  }

  public function getByKSNotValidate()
  {
    $query = "SELECT * FROM ".$this->table." WHERE waktu_validasi1 IS NOT NULL AND validasi2 IS NULL AND alasan2 IS NULL";
    $this->db->query($query);

    return $this->db->resultSet();
  }

  public function getByKBNotValidate()
  {
    $query = "SELECT * FROM ".$this->table." WHERE waktu_validasi2 IS NOT NULL AND validasi3 IS NULL AND alasan3 IS NULL";
    $this->db->query($query);

    return $this->db->resultSet();
  }

  public function getByPKNotValidate()
  {
    $query = "SELECT * FROM ".$this->table." WHERE waktu_validasi3 IS NOT NULL AND disposisi IS NULL AND alasan_dispo IS NULL";
    $this->db->query($query);

    return $this->db->resultSet();
  }

  public function getByPNotValidate()
  {
    $query = "SELECT * FROM ".$this->table." WHERE disposisi IS NOT NULL AND penugasan IS NULL";
    $this->db->query($query);

    return $this->db->resultSet();
  }
  public function getByTSNotValidate()
  {
    $query = "SELECT * FROM ".$this->table." WHERE nip_petugas_pengadaan IS NOT NULL AND verifikasi_selesai IS NULL AND waktu_hasil IS NULL";
    $this->db->query($query);
    $data = $this->db->resultSet();

    $total = 0;

    foreach ($data as $k) {
      $nip_petugas = explode(',',$k->nip_petugas_pengadaan);
      if(in_array($_SESSION['nip'],$nip_petugas,TRUE)){
        $total++;
      }
    }

    return $total;
  }

  public function getByHNotValidate()
  {
    $query = "SELECT * FROM ".$this->table." WHERE nip_pemohon=:nip_user AND verifikasi_selesai='Pengadaan selesai' AND hasil IS NULL ORDER BY id DESC";
    $this->db->query($query);
    $this->db->bind('nip_user',$_SESSION['nip']);

    return $this->db->resultSet();
  }


  
}

?>