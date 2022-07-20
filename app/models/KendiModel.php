<?php

class KendiModel {
    private $kendaraan = 'data_kendaraan';
    private $peminjaman = 'peminjaman_kendaraan';
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    // Peminjaman Kendaraan Model
    public function getPeminjaman(){
        $this->db->query('SELECT peminjaman_kendaraan.*,users.nama FROM '.$this->peminjaman.' LEFT JOIN users ON users.nip=peminjaman_kendaraan.pemohon ORDER BY id DESC');
        $result = $this->db->resultSet();

        return $result;
    }

    public function getPeminjamanByNIP(){
        $this->db->query('SELECT peminjaman_kendaraan.*,users.nama FROM '.$this->peminjaman.' LEFT JOIN users ON users.nip=peminjaman_kendaraan.pemohon WHERE pemohon=:user OR user=:user ORDER BY id DESC');
        $this->db->bind('user',$_SESSION['nip']);
        $result = $this->db->resultSet();

        return $result;
    }

    public function getPeminjamanPenggunaan(){
        $this->db->query('SELECT peminjaman_kendaraan.*,users.nama FROM '.$this->peminjaman.' LEFT JOIN users ON users.nip=peminjaman_kendaraan.pemohon WHERE alasan_ditolak IS NULL ORDER BY id DESC');
        $result = $this->db->resultSet();

        return $result;
    }

    public function getPeminjamanById($id){
    $this->db->query('SELECT peminjaman_kendaraan.*,users.nama FROM '.$this->peminjaman.' LEFT JOIN users ON users.nip=peminjaman_kendaraan.pemohon WHERE peminjaman_kendaraan.id=:id');
        $this->db->bind(':id',$id);
        $row = $this->db->single();

        return $row;
    }

    public function addPeminjaman($data){
        $waktu = date('H:i').' - '.dateID(date('Y-m-d'));
    
        $query = "INSERT INTO ".$this->peminjaman." (user,id_kendaraan,waktu,keperluan,keterangan,jenis_peminjaman,tanggal,jam_mulai,jam_selesai,tgl_mulai,tgl_selesai,pemohon,atasan) VALUES 
        (:user,:id_kendaraan,:waktu,:keperluan,:keterangan,:jenis_peminjaman,:tanggal,:jam_mulai,:jam_selesai,:tgl_mulai,:tgl_selesai,:pemohon,:atasan)";
        $this->db->query($query);
        $this->db->bind('user',$_SESSION['nip']);
        $this->db->bind('id_kendaraan',$data['kendaraan']);
        $this->db->bind('waktu',$waktu);
        $this->db->bind('keperluan',$data['keperluan']);
        $this->db->bind('keterangan',$data['keterangan']);
        $this->db->bind('jenis_peminjaman',$data['jenis_peminjaman']);
        $this->db->bind('tanggal',$data['tanggal']);
        $this->db->bind('jam_mulai',$data['jam_mulai']);
        $this->db->bind('jam_selesai',$data['jam_selesai']);
        $this->db->bind('tgl_mulai',$data['tgl_mulai']);
        $this->db->bind('tgl_selesai',$data['tgl_selesai']);
        $this->db->bind('pemohon',$data['pemohon']);
        $this->db->bind('atasan',$data['atasan']);
        //execute 
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function validasiAtasan($data)
    {
        $waktu_validasi = date('Y-m-d').', '.date('H:i');
        $alasan_ditolak = $data['alasan_ditolak'];
        if($data['validasi'] == 'Diterima'){
            $alasan_ditolak = '';
        }

        $query = "UPDATE ".$this->peminjaman." SET validasi_atasan=:validasi_atasan,waktu_validasi_atasan=:waktu_validasi_atasan,alasan_ditolak=:alasan_ditolak WHERE id=:id";
        $this->db->query($query);
        $this->db->bind('id',$data['id']);
        $this->db->bind('validasi_atasan',$data['validasi']);
        $this->db->bind('waktu_validasi_atasan',$waktu_validasi);
        $this->db->bind('alasan_ditolak', $alasan_ditolak);
    
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function validasiKasubagTU($data)
    {
        $waktu_validasi = date('Y-m-d').', '.date('H:i');
        $alasan_ditolak = $data['alasan_ditolak'];
        if($data['validasi'] == 'Diterima'){
            $alasan_ditolak = '';
        }

        $this->db->query('UPDATE '.$this->kendaraan.' SET dipinjam=:dipinjam WHERE id=:id');
        $this->db->bind(':id', $data['id_kendaraan']);
        $this->db->bind(':dipinjam', TRUE);
        $this->db->execute();

        $query = "UPDATE ".$this->peminjaman." SET validasi_kasubagtu=:validasi_kasubagtu,waktu_validasi_kasubagtu=:waktu_validasi_kasubagtu,alasan_ditolak=:alasan_ditolak WHERE id=:id";
        $this->db->query($query);
        $this->db->bind('id',$data['id']);
        $this->db->bind('validasi_kasubagtu',$data['validasi']);
        $this->db->bind('waktu_validasi_kasubagtu',$waktu_validasi);
        $this->db->bind('alasan_ditolak', $alasan_ditolak);
    
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function serahkan($id){
        $waktu = date('Y-m-d').', '.date('H:i');
        $this->db->query('UPDATE '.$this->peminjaman.' SET diserahkan=:diserahkan,waktu_diserahkan=:waktu_diserahkan WHERE id=:id');
        $this->db->bind(':id', $id);
        $this->db->bind(':diserahkan', TRUE);
        $this->db->bind(':waktu_diserahkan', $waktu);
        
        //execute 
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function kembalikan($data){
        $this->db->query('UPDATE '.$this->kendaraan.' SET dipinjam=:dipinjam WHERE id=:id');
        $this->db->bind(':id', $data['id_kendaraan']);
        $this->db->bind(':dipinjam', FALSE);
        $this->db->execute();

        $waktu = date('Y-m-d').', '.date('H:i');
        $this->db->query('UPDATE '.$this->peminjaman.' SET selesai=:selesai,waktu_selesai=:waktu_selesai WHERE id=:id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':selesai', TRUE);
        $this->db->bind(':waktu_selesai', $waktu);
        
        //execute 
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    // Data Kendaraan Model
    public function getKendaraan(){
        $this->db->query('SELECT * FROM '.$this->kendaraan.' ORDER BY id ASC');
        $result = $this->db->resultSet();

        return $result;
    }

    public function getKendaraanNotPinjam(){
        $this->db->query('SELECT * FROM '.$this->kendaraan.' WHERE dipinjam=:dipinjam');
        $this->db->bind(':dipinjam', FALSE);
        $result = $this->db->resultSet();

        return $result;
    }

    public function addKendaraan($data){
        $this->db->query('INSERT INTO '.$this->kendaraan.' (merk,tipe,nopol,tgl_pajak) VALUES (:merk,:tipe,:nopol,:tgl_pajak)');
        $this->db->bind(':merk', $data['merk']);
        $this->db->bind(':tipe', $data['tipe']);
        $this->db->bind(':nopol', $data['nopol']);
        $this->db->bind(':tgl_pajak', $data['tgl_pajak']);

        //execute 
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getKendaraanById($id){
        $this->db->query('SELECT * FROM '.$this->kendaraan.' WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();

        return $row;
    }

    public function updateKendaraan($data){
        $this->db->query('UPDATE '.$this->kendaraan.' SET merk=:merk,tipe=:tipe,nopol=:nopol,tgl_pajak=:tgl_pajak WHERE id=:id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':merk', $data['merk']);
        $this->db->bind(':tipe', $data['tipe']);
        $this->db->bind(':nopol', $data['nopol']);
        $this->db->bind(':tgl_pajak', $data['tgl_pajak']);
        
        //execute 
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function deleteKendaraan($id){
        $this->db->query('DELETE FROM '.$this->kendaraan.' WHERE id = :id');
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


    //Kondisi harian Model
    public function pemeriksaanKendaraan($id,$layak){
        $this->db->query('UPDATE '.$this->kendaraan.' SET layak=:layak WHERE id=:id');
        $this->db->bind(':id', $id);
        $this->db->bind(':layak', $layak);

        //execute 
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}