<?php

class HelpModel {
    private $table = 'help';
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function get(){
        $this->db->query('SELECT * FROM '.$this->table.' WHERE user=:user ORDER BY id ASC');
        $this->db->bind(':user', $_SESSION['nip']);
        $result = $this->db->resultSet();

        return $result;
    }

    public function add($data){
        $this->db->query('INSERT INTO '.$this->table.' (user,subjek,laporan) VALUES (:user,:subjek,:laporan)');
        $this->db->bind(':user', $_SESSION['nip']);
        $this->db->bind(':subjek', $data['subjek']);
        $this->db->bind(':laporan', $data['laporan']);

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
        $this->db->query('UPDATE '.$this->table.' SET pelanggaran = :pelanggaran WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':pelanggaran', $data['jenis_pelanggaran']);
        
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