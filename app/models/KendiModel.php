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