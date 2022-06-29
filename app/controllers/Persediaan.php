<?php

class Persediaan extends Controller
{
  public function __construct()
  {
    if(!isLoggedIn()){
      return redirect('auth/login');
    }
    //new model instance
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

    $data = [
        'title' => 'Master Gudang',
        'menu' => 'Persediaan',
    ];

    $this->view('persediaan/gudang', $data);
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