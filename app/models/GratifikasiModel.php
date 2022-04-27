<?php

Class GratifikasiModel
{
    private $table = 'gratifikasi';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function get()
    {
        $query = "SELECT gratifikasi.*, m_jenis_penerimaan.jenis_penerimaan, m_jenis_peristiwa.jenis_peristiwa FROM ".$this->table. " JOIN m_jenis_penerimaan ON m_jenis_penerimaan.id = gratifikasi.jenis_penerimaan JOIN m_jenis_peristiwa ON m_jenis_peristiwa.id = gratifikasi.jenis_peristiwa";
        $this->db->query($query);

        return $this->db->resultSet();
    }

    public function getById($id)
    {
        $query = "SELECT gratifikasi.*, m_jenis_penerimaan.jenis_penerimaan, m_jenis_peristiwa.jenis_peristiwa,users.nama FROM ".$this->table. " JOIN m_jenis_penerimaan ON m_jenis_penerimaan.id = gratifikasi.jenis_penerimaan JOIN m_jenis_peristiwa ON m_jenis_peristiwa.id = gratifikasi.jenis_peristiwa LEFT JOIN users ON users.nip=gratifikasi.pelapor WHERE gratifikasi.id=:id";
        $this->db->query($query);
        $this->db->bind('id',$id);

        return $this->db->single();
    }

    public function getAllByNIP()
    {
        $query = "SELECT gratifikasi.*, m_jenis_penerimaan.jenis_penerimaan, m_jenis_peristiwa.jenis_peristiwa FROM ".$this->table. " JOIN m_jenis_penerimaan ON m_jenis_penerimaan.id = gratifikasi.jenis_penerimaan JOIN m_jenis_peristiwa ON m_jenis_peristiwa.id = gratifikasi.jenis_peristiwa  WHERE pelapor=:pelapor";
        $this->db->query($query);
        $this->db->bind('pelapor',$_SESSION['nip']);

        return $this->db->resultSet();
    }

    public function getAllNotTindakan()
    {
        $query = "SELECT gratifikasi.*, m_jenis_penerimaan.jenis_penerimaan, m_jenis_peristiwa.jenis_peristiwa,users.nama FROM ".$this->table. " JOIN m_jenis_penerimaan ON m_jenis_penerimaan.id = gratifikasi.jenis_penerimaan JOIN m_jenis_peristiwa ON m_jenis_peristiwa.id = gratifikasi.jenis_peristiwa LEFT JOIN users ON users.nip=gratifikasi.pelapor WHERE is_tindak=:tindakan";
        $this->db->query($query);
        $this->db->bind('tindakan',FALSE);

        return $this->db->resultSet();
    }

    public function getAllRekap()
    {
        $query = "SELECT gratifikasi.*, m_jenis_penerimaan.jenis_penerimaan, m_jenis_peristiwa.jenis_peristiwa,users.nama FROM ".$this->table. " JOIN m_jenis_penerimaan ON m_jenis_penerimaan.id = gratifikasi.jenis_penerimaan JOIN m_jenis_peristiwa ON m_jenis_peristiwa.id = gratifikasi.jenis_peristiwa LEFT JOIN users ON users.nip=gratifikasi.pelapor WHERE is_tindak=:tindakan";
        $this->db->query($query);
        $this->db->bind('tindakan',TRUE);

        return $this->db->resultSet();
    }

    public function getRekapAllByDate($date1,$date2)
    {
        $dateOne = date("Y-m-d", strtotime($date1));
        $dateTwo = date("Y-m-d", strtotime($date2));
        $query = "SELECT gratifikasi.*, m_jenis_penerimaan.jenis_penerimaan, m_jenis_peristiwa.jenis_peristiwa,users.nama FROM ".$this->table. " JOIN m_jenis_penerimaan ON m_jenis_penerimaan.id = gratifikasi.jenis_penerimaan JOIN m_jenis_peristiwa ON m_jenis_peristiwa.id = gratifikasi.jenis_peristiwa LEFT JOIN users ON users.nip=gratifikasi.pelapor WHERE is_tindak=:tindakan AND gratifikasi.tanggal BETWEEN :start_date AND :end_date";
        $this->db->query($query);
        $this->db->bind('tindakan',TRUE);
        $this->db->bind('start_date',$dateOne);
        $this->db->bind('end_date',$dateTwo);

        return $this->db->resultSet();
    }

    public function add($data)
    {
        $taksiran = (int) filter_var($data['taksiran'], FILTER_SANITIZE_NUMBER_INT);

        $query = "INSERT INTO ".$this->table." (pelapor,jenis_penerimaan, uraian, taksiran, jenis_peristiwa, tempat_penerimaan, tanggal, penerima, pemberi, pekerjaan, jabatan, alamat, telepon, email, hubungan, alasan_pemberian, kronologi_penerimaan) 
        VALUES (:pelapor,:jenis_penerimaan, :uraian, :taksiran, :jenis_peristiwa, :tempat_penerimaan, :tanggal, :penerima, :pemberi, :pekerjaan, :jabatan, :alamat, :telepon, :email, :hubungan, :alasan_pemberian, :kronologi_penerimaan)";

        $this->db->query($query);
        $this->db->bind('pelapor',$_SESSION['nip']);
        $this->db->bind('jenis_penerimaan',$data['jenis_penerimaan']);
        $this->db->bind('uraian',$data['uraian']);
        $this->db->bind('taksiran',$taksiran);
        $this->db->bind('jenis_peristiwa',$data['jenis_peristiwa']);
        $this->db->bind('tempat_penerimaan',$data['tempat_penerimaan']);
        $this->db->bind('tanggal',$data['tanggal']);
        $this->db->bind('penerima',$data['penerima']);
        $this->db->bind('pemberi', $data['pemberi']);
        $this->db->bind('pekerjaan', $data['pekerjaan']);
        $this->db->bind('jabatan', $data['jabatan']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('telepon', $data['telepon']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('hubungan', $data['hubungan']);
        $this->db->bind('alasan_pemberian', $data['alasan_pemberian']);
        $this->db->bind('kronologi_penerimaan', $data['kronologi_penerimaan']);
        
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function tindakan($data)
    {
        $query = "UPDATE ".$this->table." SET tindakan=:tindakan,is_tindak=:is_tindak WHERE id=:id";
        $this->db->query($query);
        $this->db->bind('id',$data['id']);
        $this->db->bind('tindakan',$data['tindakan']);
        $this->db->bind('is_tindak',TRUE);
    
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function delete($id){
        $query = "DELETE FROM ".$this->table." WHERE id=:id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}

?>