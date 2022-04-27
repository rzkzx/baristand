<?php

class JenisPeristiwaModel {
    private $table = 'm_jenis_peristiwa';
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function get(){
        $this->db->query('SELECT * FROM '.$this->table.' ORDER BY id ASC');
        $result = $this->db->resultSet();

        return $result;
    }

    public function add($data){
        $this->db->query('INSERT INTO '.$this->table.' (jenis_peristiwa) VALUES (:jenis_peristiwa)');
        $this->db->bind(':jenis_peristiwa', $data['jenis_peristiwa']);

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
        $this->db->query('UPDATE '.$this->table.' SET jenis_peristiwa = :jenis_peristiwa WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':jenis_peristiwa', $data['jenis_peristiwa']);
        
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