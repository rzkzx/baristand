<?php 
class Help extends Controller{

    public function __construct()
    {
        if(!isLoggedIn()){
            return redirect('auth/login');
        }
        //new model instance
        $this->helpModel = $this->model('HelpModel');
    }

    public function index(){
        $help = $this->helpModel->get();
        $data = [
            'title' => 'Daftar Help Desk',
            'menu' => 'help',
            'help' => $help
        ];

        $this->view('help/index', $data);
    }

    public function add(){
      $data['title'] = 'Form Laporan Error';
      $data['menu'] = 'help';
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          //validate error free
          if(empty($_POST['subjek']) || empty($_POST['laporan'])){
              //load view with error
              setFlash('Form input tidak boleh kosong','danger');
              $this->view('help/add', $data);
          }else{
              if($this->helpModel->add($_POST)){
                  setFlash('Laporan Error telah dikirim kepada admin.','success');
                  return redirect('help');
              }else{
                  die('something went wrong');
              }
          }
      }else{
          $this->view('help/add', $data);
      }
  }

  public function editkendaraan($id = ''){
      $data['title'] = 'Edit Data Kendaraan';
      $data['menu'] = 'Kendi';
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      //validate error free
          if(empty($_POST['merk']) || empty($_POST['tipe']) || empty($_POST['nopol']) || empty($_POST['tgl_pajak'])){
              //load view with error
              setFlash('Form input tidak boleh kosong','danger');
              $this->view('kendi/kendaraan/edit', $data);
          }else{
              if($this->kendiModel->updateKendaraan($_POST)){
                  setFlash('Data Kendaraan berhasil diperbarui.','success');
                  return redirect('kendi/kendaraan');
              }else{
                  die('something went wrong');
              }
          }
      }else{
          $kend = $this->kendiModel->getKendaraanById($id);
          if($kend){
              $data['id'] = $id;
              $data['kend'] = $kend;
              
              $this->view('kendi/kendaraan/edit', $data);
          }else{
              return redirect('kendi/kendaraan');
          }
      }
  }

  public function deletekendaraan($id = ''){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          if($this->kendiModel->deleteKendaraan($id)){
              setFlash('Data Kendaraan berhasil dihapus.','success');
          }else{
              die('something went wrong');
          }
      }else{
          return redirect('kendi/kendaraan');
      }
  }
}                            
                        