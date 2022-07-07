<?php

    Class PersediaanModel
    {
    private $table = 'persediaan';
    private $tablegd = 'gudang';

    public function __construct()
    {
            $this->db = new Database;
    }

    public function getAll()
    {
        $query =  "SELECT persediaan.*,users.nama FROM ".$this->table. " JOIN users ON users.nip=persediaan.nip_pegawai";
        $this->db->query($query);

        return $this->db->resultSet();
    }

    public function getAllgudang()
    {
        $query = "SELECT * FROM ".$this->tablegd;
        $this->db->query($query);

        return $this->db->resultSet();
    }

    public function addGudang($data)
    {
        $waktu = date('Y-m-d H:i');
        $petugas = implode(',',$data['petugas']);

        $query = "INSERT INTO ".$this->tablegd." (namagudang, petugas, tanggal, keterangan) 
        VALUES (:namagudang, :petugas, :tanggal, :keterangan)";

        $this->db->query($query);
        $this->db->bind('namagudang',$data['nama']);
        $this->db->bind('petugas',$petugas);
        $this->db->bind('tanggal',$waktu);
        $this->db->bind('keterangan',$data['keterangan']) ;
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function add($data)
    {

        $query = "INSERT INTO ".$this->table."(namabarang,keterangan,satuan,harga,stock,permintaan,gudang,gambar,tanggal,jam,nip_pegawai) 
        SELECT namab,keterangan,satuan,harga,stock,permintaan,gudang,gambar,tanggal,jam,nip_pegawai FROM tpersediaan";
        $this->db->query($query);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
?>