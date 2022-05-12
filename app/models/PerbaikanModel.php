<?php

Class PerbaikanModel
{
  private $table = 'perbaikan';
  private $table2 = 'tbarang';
  private $tablebp = 'barang_perbaikan';
  private $db;

  public function __construct()
  {
      $this->db = new Database;
  }

  public function getAll()
  {
      $query = "SELECT perbaikan.*,users.nama FROM ".$this->table. " JOIN users ON users.nip=perbaikan.nip_pemohon";
      $this->db->query($query);

      return $this->db->resultSet();
  }

  public function getByNIP($nip)
  {
    $query = "SELECT perbaikan.*,users.nama,barang_perbaikan.nip_petugas FROM ".$this->table." LEFT JOIN users ON users.nip=perbaikan.nip_pemohon LEFT JOIN barang_perbaikan ON barang_perbaikan.seri_perbaikan=perbaikan.serial_number 
    WHERE perbaikan.user=:nip_user or perbaikan.nip_pemohon=:nip_user or perbaikan.nip_atasan=:nip_user or perbaikan.nip_penanggung=:nip_user or barang_perbaikan.nip_petugas=:nip_user ORDER BY id DESC";
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
      $query = "SELECT perbaikan.*, users.nama FROM ".$this->table. " JOIN users ON users.nip=perbaikan.nip_pemohon WHERE perbaikan.nip_pemohon AND hasil IN (:hasil)";
      $this->db->query($query);
      $this->db->bind('hasil',"Perbaikan selesai");

      return $this->db->resultSet();
  }

  public function getAllSelesaiByDate($date1,$date2)
  {
    $dateOne = date("Y-m-d", strtotime($date1));
    $dateTwo = date("Y-m-d", strtotime($date2));
    $query= "SELECT perbaikan.*,users.nama FROM ".$this->table." JOIN users ON users.nip=perbaikan.nip_pemohon WHERE perbaikan.nip_pemohon AND hasil IN (:hasil) AND perbaikan.tanggal BETWEEN :start_date AND :end_date ORDER BY id DESC";
    $this->db->query($query);
    $this->db->bind('start_date',$dateOne);
    $this->db->bind('end_date',$dateTwo);
    $this->db->bind('hasil',"Perbaikan selesai");

    return $this->db->resultSet();
  }

public function cek()
  {
    $query = "SELECT tbarang.* FROM ".$this->table2;
    $this->db->query($query);

      return $this->db->rowCount();
  }

public function getBySerial($serial_number){
  $query = "SELECT perbaikan.*, users.nama FROM ".$this->table." LEFT JOIN users ON users.nip=perbaikan.nip_pemohon WHERE perbaikan.serial_number=:serial_number";
  $this->db->query($query);
  $this->db->bind('serial_number', $serial_number);

  return $this->db->single();
}

public function getBarangBySerial($serial_number){
  $query = "SELECT perbaikan.*, barang_perbaikan.* FROM ".$this->table." JOIN barang_perbaikan ON barang_perbaikan.seri_perbaikan=perbaikan.serial_number WHERE perbaikan.serial_number=:serial_number";
  $this->db->query($query);
  $this->db->bind(':serial_number', $serial_number);

  $perbaikan = $this->db->resultSet();

  $no = 0;
      foreach ($perbaikan as $k) {
        if($k->nip_petugas){
          $query2 = "SELECT * FROM users WHERE nip=:nip";
          $this->db->query($query2);
          $this->db->bind(':nip',$k->nip_petugas);
          $petugas = $this->db->single();
          $perbaikan[$no]->petugas_perbaikan = $petugas->nama;
        }
        $no++;
      }
      return $perbaikan;
}

public function getByPetugas($serial_number){
  $query = "SELECT barang_perbaikan.*, perbaikan.nip_penanggung, perbaikan.waktu_penugasan, perbaikan.penugasan FROM ".$this->tablebp." RIGHT JOIN perbaikan ON perbaikan.serial_number=barang_perbaikan.seri_perbaikan WHERE perbaikan.serial_number=:serial_number AND nip_petugas=:nip_petugas";
  $this->db->query($query);
  $this->db->bind(':serial_number', $serial_number);
  $this->db->bind(':nip_petugas', $_SESSION['nip']);
  $perbaikan = $this->db->resultSet();

  $no = 0;
      foreach ($perbaikan as $k) {
        if($k->nip_penanggung){
          $query2 = "SELECT * FROM users WHERE nip=:nip";
          $this->db->query($query2);
          $this->db->bind(':nip',$k->nip_penanggung);
          $petugas = $this->db->single();
          $perbaikan[$no]->penanggung = $petugas->nama;
        }
        $no++;
      }
      return $perbaikan;
}

public function getBySerialAtasan($serial_number){
  $query = "SELECT perbaikan.*, users.nama FROM ".$this->table." LEFT JOIN users ON users.nip=perbaikan.nip_atasan WHERE perbaikan.serial_number=:serial_number";
  $this->db->query($query);
  $this->db->bind('serial_number', $serial_number);

  return $this->db->single();
}

public function getBySerialPenanggung($serial_number){
  $query = "SELECT perbaikan.*, users.nama FROM ".$this->table." LEFT JOIN users ON users.nip=perbaikan.nip_penanggung WHERE perbaikan.serial_number=:serial_number";
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
      foreach($data['ketbarang'] as $barang){
        $keterangan .= $barang;
      }
      $seri = '';
      foreach($data['serial'] as $nomer){
        $seri .= $nomer;
      }

      $query = "UPDATE ".$this->table2." SET seri_perbaikan=:seri_perbaikan";
      $this->db->query($query);
      $this->db->bind('seri_perbaikan', $seri) ;
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

      $query3 = "INSERT INTO ".$this->tablebp."(id,nbarang,jumlah,keterangan,seri_perbaikan) SELECT id,nbarang,jumlah,keterangan,seri_perbaikan FROM tbarang";
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
      foreach($data['ketbarang'] as $barang){
        $keterangan .= $barang;
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

    $query = "UPDATE ".$this->table." SET alasan1=:alasan1, waktu_validasi1=:waktu_validasi1 WHERE serial_number=:serial_number";
    $this->db->query($query);
    $this->db->bind('waktu_validasi1',$waktu);
    $this->db->bind('serial_number',$data['serial_number']);
    $this->db->bind('alasan1',$data['alasan1']);

    $this->db->execute();
    return $this->db->rowCount();
  }

  public function tambahan2($data)
  {
    $waktu_validasi2 = date('Y-m-d H:i');

    $query = "UPDATE ".$this->table." SET validasi2=:validasi2, alasan2=:alasan2, waktu_validasi2=:waktu_validasi2 WHERE serial_number=:serial_number";
    $this->db->query($query);
    $this->db->bind('waktu_validasi2',$waktu_validasi2);
    $this->db->bind('serial_number',$data['serial_number']);
    $this->db->bind('validasi2',$data['validasi2']);
    $this->db->bind('alasan2',$data['alasan2']);

    $this->db->execute();
    return $this->db->rowCount();
  }

  public function tambahanKasubag($data)
  {
    $waktu = date('Y-m-d H:i');
    
    $query = "UPDATE ".$this->table." SET alasan_dispo=:alasan_dispo, waktu_disposisi=:waktu_disposisi WHERE serial_number=:serial_number";
    $this->db->query($query);
    $this->db->bind('serial_number',$data['serial_number']);
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
    $this->db->bind('serial_number',$data['serial_number']);
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

  public function tambahanPetugasPerbaikan($data)
  {
      $petugas = implode(',',$data['nip_petugas']);
      $query = "UPDATE ".$this->table." SET nip_petugas_perbaikan=:nip_petugas WHERE id=:id";
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

    if($this->db->execute()){
      return true;
    }else{
        return false;
    }
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

    $query2 = "UPDATE ".$this->table." SET waktu_diterima=:waktu_diterima WHERE serial_number=:seri_perbaikan";
    $this->db->query($query2);
    $this->db->bind('seri_perbaikan',$data['seri_perbaikan']);
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
    
    $query2 = "UPDATE ".$this->table." SET verifikasi_selesai=:verifikasi_selesai, waktu_selesai=:waktu_selesai WHERE serial_number=:seri_perbaikan";
    $this->db->query($query2);
    $this->db->bind('seri_perbaikan',$data['seri_perbaikan']);
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
}

?>