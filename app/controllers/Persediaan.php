<?php

class Persediaan extends Controller
{
  public function __construct()
  {
    if(!isLoggedIn()){
      return redirect('auth/login');
    }
    //new model instance
    $this->pegawaiModel = $this->model('PegawaiModel');
    $this->persediaanModel = $this->model('PersediaanModel');
  }

  public function index(){

    $persediaan = $this->persediaanModel->getAll();

    $data = [
        'title' => 'Daftar Persediaan',
        'menu' => 'Persediaan',
        'persediaan' => $persediaan
    ];

    $this->view('persediaan/index', $data);
  }

  public function gudang(){

    $gudang = $this->persediaanModel->getAllgudang();

    $data = [
        'title' => 'Master Gudang',
        'menu' => 'Persediaan',
        'gudang' => $gudang
    ];

    $no = 1;
    foreach ($gudang as $g) {
      $data['petugas'][$no] = $this->pegawaiModel->getAllNIP($g->petugas);
      $no++;
    }

    $this->view('persediaan/gudang', $data);
  }

  public function tambahgudang(){

    $data = [
        'title' => 'Tambah Gudang',
        'menu' => 'Persediaan',
    ];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      //validate error free
      foreach($_POST['petugas'] as $value) if(empty($value)) $_POST['petugas'] = '';
      if(empty($_POST['nama']) || empty($_POST['keterangan']) || empty($_POST['petugas']) || empty($_POST['petugas'])){
          //load view with error
          setFlash('Form input tidak boleh kosong','danger');
          $this->view('persediaan/tambahgudang', $data);
      }else{
          if($this->persediaanModel->addGudang($_POST)){
              setFlash('Gudang berhasil ditambahkan.','success');
              return redirect('persediaan/gudang');
          }else{
              die('something went wrong');
          }
      }
  }else {

          $pegawai = $this->pegawaiModel->get();

          $data['petugas'] = $pegawai;
          $this->view('persediaan/tambahgudang', $data);
        }
  }

  public function barang(){

    $persediaan = $this->persediaanModel->getAll();

    $data = [
        'title' => 'Master Barang',
        'menu' => 'Persediaan',
        'persediaan' => $persediaan
    ];

    $this->view('persediaan/barang', $data);
  }

}
?>