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

    public function addPeminjaman($data){
        $tanggal = date('Y-m-d');

        $waktu = date('H:i').' - '.dateID(date('Y-m-d'));
    
        $query = "INSERT INTO ".$this->table." (user,id_kendaraan,waktu,keperluan,keterangan,jenis_peminjaman,tanggal,jam_mulai,jam_selesai,tgl_mulai,tgl_selesai,pemohon,atasan) VALUES 
        (:user,:id_kendaraan,waktu,:keperluan,:keterangan,:jenis_peminjaman,:tanggal,:jam_mulai,:jam_selesai,:tgl_mulai,:tgl_selesai,:pemohon,:atasan)";
        $this->db->query($query);
        $this->db->bind('user',$_SESSION['nip']);
        $this->db->bind('id_kendaraan',$data['kendaraan']);
        $this->db->bind('waktu',$waktu);
        $this->db->bind('keperluan',$data['jam_kembali']);
        $this->db->bind('keterangan',$data['tanggal_ijin']);
        $this->db->bind('pejabat_validasi',$data['pejabat_validasi']);
        $this->db->bind('tanggal_dibuat',$tanggal);
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