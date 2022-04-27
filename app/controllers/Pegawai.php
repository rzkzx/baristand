<?php 
class Pegawai extends Controller{

    public function __construct()
    {
        if(!isLoggedIn()){
            return redirect('auth/login');
        }
        //new model instance
        $this->pegawaiModel = $this->model('PegawaiModel');
    }

    public function index(){
        $pegawai = $this->pegawaiModel->get();
        $data = [
            'title' => 'Daftar Pegawai',
            'menu' => 'Pegawai',
            'pegawai' => $pegawai
        ];

        $this->view('pegawai/index', $data);
    }

    //add new
    public function add(){
        $data['title'] = 'Tambah Pegawai';
        $data['menu'] = 'Pegawai';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //validate error free
            if(empty($_POST['nama']) || empty($_POST['nip']) || empty($_POST['username'])){
                //load view with error
                setFlash('Form input tidak boleh kosong','danger');
                return redirect('pegawai/add');
            }else{
                if($this->pegawaiModel->add($_POST)){
                    setFlash('Pegawai berhasil ditambahkan.','success');
                    return redirect('pegawai');
                }else{
                    setFlash('Gagal menambahkan pegawai','danger');
                    return redirect('pegawai');
                }
            }
        }else{
            $this->view('pegawai/add', $data);
        }
    }

     //edit
     public function edit($id = ''){
        $data['title'] = 'Edit Pegawai';
        $data['menu'] = 'Pegawai';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //validate error free
            if(empty($_POST['nama']) || empty($_POST['nip']) || empty($_POST['username'])){
                //load view with error
                setFlash('Form input tidak boleh kosong','danger');
                return redirect('pegawai/edit/'.$_POST['id']);
            }else{
                if($this->pegawaiModel->update($_POST)){
                    setFlash('Pegawai berhasil diperbarui.','success');
                    return redirect('pegawai');
                }else{
                    setFlash('Gagal memperbarui pegawai','danger');
                    return redirect('pegawai');
                }
            }
        }else{
            $pegawai = $this->pegawaiModel->getById($id);
            if($pegawai){
                $data['id'] = $id;
                $data['pegawai'] = $pegawai;
                
                $this->view('pegawai/edit', $data);
            }else{
                return redirect('pegawai');
            }
        }
    }
    
    //delete
    public function delete($id = ''){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($this->pegawaiModel->delete($id)){
                setFlash('Pegawai berhasil dihapus.','success');
            }else{
                setFlash('Gagal menghapus pegawai.','success');
            }
        }else{
            return redirect('pegawai');
        }
    }
}                            
                        