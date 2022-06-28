<?php

class KendiModel {
    private $kendaraan = 'data_kendaraan';
    private $peminjaman = 'peminjaman_kenadaraan';
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getKendaraan(){
        $this->db->query('SELECT * FROM '.$this->kendaraan.' ORDER BY id ASC');
        $result = $this->db->resultSet();

        return $result;
    }

    public function add($data){
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

    public function getById($id){
        $this->db->query('SELECT * FROM '.$this->table.' WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();

        return $row;
    }

    public function update($data){
        $this->db->query('UPDATE '.$this->table.' SET jenis_penerimaan = :jenis_penerimaan WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':jenis_penerimaan', $data['jenis_penerimaan']);
        
        //execute 
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function delete($id){
        $this->db->query('DELETE FROM '.$this->table.' WHERE id = :id');
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}