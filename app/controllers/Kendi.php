<?php 
class Kendi extends Controller{

    public function __construct()
    {
        if(!isLoggedIn()){
            return redirect('auth/login');
        }
        //new model instance
        $this->kendiModel = $this->model('KendiModel');
    }

    // public function index(){
    //   $kendiModel = $this->kendiModel->get();
    //   $data = [
    //       'title' => 'Daftar Jenis Pelanggaran',
    //       'menu' => 'Admin',
    //       'kendi' => $kendiModel
    //   ];

    //   $this->view('kendi/index', $data);
    // }

    //Data Kendaraan Controller
    public function kendaraan(){
      $kendi = $this->kendiModel->getKendaraan();
      $data = [
          'title' => 'Data Kendaraan',
          'menu' => 'Kendi',
          'kendi' => $kendi
      ];

      $this->view('kendi/kendaraan/index', $data);
    }

    public function addkendaraan(){
        $data['title'] = 'Tambah Kendaraan';
        $data['menu'] = 'Kendi';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //validate error free
            if(empty($_POST['merk']) || empty($_POST['tipe']) || empty($_POST['nopol']) || empty($_POST['tgl_pajak'])){
                //load view with error
                setFlash('Form input tidak boleh kosong','danger');
                $this->view('kendi/kendaraan/add', $data);
            }else{
                if($this->kendiModel->addKendaraan($_POST)){
                    setFlash('Kendaraan Dinas berhasil ditambahkan.','success');
                    return redirect('kendi/kendaraan');
                }else{
                    die('something went wrong');
                }
            }
        }else{
            $this->view('kendi/kendaraan/add', $data);
        }
    }

    //edit
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
  
    //delete
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