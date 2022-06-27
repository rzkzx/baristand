<?php

class Persediaan extends Controller
{
  public function __construct()
  {
    if(!isLoggedIn()){
      return redirect('auth/login');
    }
    //new model instance
  }

  public function index(){

    $data = [
        'title' => 'Daftar Persediaan',
        'menu' => 'Persediaan',
    ];

    $this->view('persediaan/index', $data);
  }

}
?>