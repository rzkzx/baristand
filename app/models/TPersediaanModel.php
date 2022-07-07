<?php

Class TPersediaanModel
{
  private $table = 'tpersediaan';
  private $db;

  public function __construct()
  {
      $this->db = new Database;
  }

  public function getAll()
  {
      $query = "SELECT tpersediaan.*, namab, stock, keterangan FROM ".$this->table;
      $this->db->query($query);

      return $this->db->resultSet();
  }

  public function add($data,$files)
  {   
      $user = $_SESSION['nip'];
      $tanggal = date('Y-m-d');
      $jam = date('H:i');

      $newGambarName = $files['gambar']['name'];
        if($files['gambar']['size'] > 0){
            $file_extension = pathinfo($files['gambar']['name'], PATHINFO_EXTENSION);
            $allowed_extension = array(
                "png",
                "jpg",
                "jpeg"
            );

            if(!in_array($file_extension, $allowed_extension)) {
                return false;
            }


            if($files['gambar']['size'] < 2000 * 1000){
                  move_uploaded_file($files['gambar']['tmp_name'], "../public/img/persediaan/". $newGambarName);
            }else{
                return false;
            }
        }

      $query = "INSERT INTO ".$this->table." (gudang, namab, harga, satuan, stock, permintaan, keterangan, tanggal, jam, nip_pegawai, gambar) 
      VALUES (:gudang, :namab, :harga, :satuan, :permintaan, :stock, :keterangan, :tanggal, :jam, :nip_pegawai, :gambar)";

      $this->db->query($query);
      $this->db->bind('gudang',$data['gudang']);
      $this->db->bind('namab',$data['namab']);
      $this->db->bind('harga',$data['harga']);
      $this->db->bind('satuan',$data['satuan']);
      $this->db->bind('stock',$data['stock']);
      $this->db->bind('permintaan',$data['permintaan']);
      $this->db->bind('keterangan',$data['keterangan']);
      $this->db->bind('tanggal',$tanggal);
      $this->db->bind('jam',$jam);
      $this->db->bind('nip_pegawai',$user);
      $this->db->bind('gambar', $newGambarName);
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

  public function deleteAll(){
    $query = "DELETE FROM ".$this->table;
    $this->db->query($query);
    $this->db->execute();

    return $this->db->rowCount();
  }
}

?>