<?php 
class JenisPelanggaran extends Controller{

    public function __construct()
    {
        if(!isLoggedIn()){
            return redirect('auth/login');
        }
        //new model instance
        $this->jenisPelanggaranModel = $this->model('JenisPelanggaranModel');
    }

    public function index(){
        $jenis_pelanggaran = $this->jenisPelanggaranModel->get();
        $data = [
            'title' => 'Daftar Jenis Pelanggaran',
            'menu' => 'Admin',
            'jenis_pelanggaran' => $jenis_pelanggaran
        ];

        $this->view('jenis_pelanggaran/index', $data);
    }

    //add new jp
    public function add(){
        $data['title'] = 'Tambah Jenis Pelanggaran';
        $data['menu'] = 'Admin';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => 'Tambah Jenis Pelanggaran',
                'menu' => 'Admin',
                'jenis_pelanggaran' => trim($_POST['jenis_pelanggaran']),
            ];

            //validate error free
            if(empty($data['jenis_pelanggaran'])){
                //load view with error
                setFlash('Form input tidak boleh kosong','danger');
                $this->view('jenis_pelanggaran/add', $data);
            }else{
                if($this->jenisPelanggaranModel->add($data)){
                    setFlash('Jenis Pelanggaran berhasil ditambahkan.','success');
                    return redirect('jenispelanggaran');
                }else{
                    die('something went wrong');
                }
            }
        }else{
            $this->view('jenis_pelanggaran/add', $data);
        }
    }

     //edit
     public function edit($id = ''){
        $data['title'] = 'Edit Jenis Pelanggaran';
        $data['menu'] = 'Admin';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => 'Edit Jenis Pelanggaran',
                'menu' => 'Admin',
                'id' => $_POST['id'],
                'jenis_pelanggaran' => trim($_POST['jenis_pelanggaran']),
            ];

            //validate error free
            if(empty($_POST['jenis_pelanggaran'])){
                //load view with error
                setFlash('Form input tidak boleh kosong','danger');
                $this->view('jenis_pelanggaran/edit', $data);
            }else{
                if($this->jenisPelanggaranModel->update($data)){
                    setFlash('Jenis Pelanggaran berhasil diperbarui.','success');
                    return redirect('jenispelanggaran');
                }else{
                    die('something went wrong');
                }
            }
        }else{
            $jp = $this->jenisPelanggaranModel->getById($id);
            if($jp){
                $data['id'] = $id;
                $data['jenis_pelanggaran'] = $jp->pelanggaran;
                
                $this->view('jenis_pelanggaran/edit', $data);
            }else{
                return redirect('jenispelanggaran');
            }
        }
    }
    
    //delete
    public function delete($id = ''){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($this->jenisPelanggaranModel->delete($id)){
                setFlash('Jenis Pelanggaran berhasil dihapus.','success');
            }else{
                die('something went wrong');
            }
        }else{
            return redirect('jenispelanggaran');
        }
    }
}                            
                        