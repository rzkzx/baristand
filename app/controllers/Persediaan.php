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
    $this->tPersediaanModel = $this->model('TPersediaanModel');
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

    $this->tPersediaanModel->deleteAll();

    $persediaan = $this->persediaanModel->getAll();

    $data = [
        'title' => 'Master Barang',
        'menu' => 'Persediaan',
        'persediaan' => $persediaan
    ];

    $this->view('persediaan/barang', $data);
  }

  public function tambahbarang(){
    $data['title'] = 'Tambah Barang';
    $data['menu'] = 'Persediaan';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if($this->persediaanModel->add($_POST)){
                $this->tPersediaanModel->deleteAll();

                //redirect and set notif flash
                setFlash('Berhasil menambahkan barang','success');
                return redirect('persediaan/barang');
            }else{
                setFlash('Gagal menambahkan barang.','danger');
                return redirect('persediaan/tambahbarang');
            }
    }else{
      $data['tpersediaan'] = $this->tPersediaanModel->getAll();
      $data['gudang'] = $this->persediaanModel->getAllgudang();

        //render view
        $this->view('persediaan/tambahbarang', $data);
    }
  }

  public function addbarang(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      if (empty($_POST['gudang']) || empty($_POST['namab']) || empty($_POST['harga']) || empty($_POST['satuan']) || empty($_POST['stock']) || empty($_POST['permintaan']) || empty($_POST['keterangan'])) {
          setFlash('Form input tidak boleh kosong', 'danger');
          return redirect('persediaan/tambahbarang');
      }
      if ($this->tPersediaanModel->add($_POST,$_FILES)) {
          setFlash('Barang berhasil diinput.', 'success');
          return redirect('persediaan/tambahbarang');
      }else{
          setFlash('Barang gagal diinput', 'danger');
          return redirect('persediaan/tambahbarang');
      }
    }else{
      return redirect('persediaan/tambahbarang');
    }
  }

  public function deleteBarang($id = ''){
    if ($this->tPersediaanModel->delete($id)) {
      setFlash('Barang berhasil dihapus', 'success');
      return redirect('persediaan/tambahbarang');
    }else{
      setFlash('Barang gagal dihapus', 'danger');
      return redirect('persediaan/tambahbarang');
    }
  }

  public function deleteSemuaBarang(){
    if ($this->tPersediaanModel->deleteAll()) {
      setFlash('Barang berhasil dihapus', 'success');
      return redirect('persediaan/tambahbarang');
    }else{
      setFlash('Barang gagal dihapus', 'danger');
      return redirect('persediaan/tambahbarang');
    }
  }
}
?>