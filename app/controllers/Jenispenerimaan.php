<?php 
class JenisPenerimaan extends Controller{

    public function __construct()
    {
        if(!isLoggedIn()){
            return redirect('auth/login');
        }
        //new model instance
        $this->jenisPenerimaanModel = $this->model('JenisPenerimaanModel');
    }

    public function index(){
        $jenis_penerimaan = $this->jenisPenerimaanModel->get();
        $data = [
            'title' => 'Daftar Jenis Penerimaan',
            'menu' => 'Admin',
            'jenis_penerimaan' => $jenis_penerimaan
        ];

        $this->view('jenis_penerimaan/index', $data);
    }

    //add new jp
    public function add(){
        $data['title'] = 'Tambah Jenis Penerimaan';
        $data['menu'] = 'Admin';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => 'Tambah Jenis Penerimaan',
                'menu' => 'Admin',
                'jenis_penerimaan' => trim($_POST['jenis_penerimaan']),
            ];

            //validate error free
            if(empty($data['jenis_penerimaan'])){
                //load view with error
                setFlash('Form input tidak boleh kosong','danger');
                $this->view('jenis_penerimaan/add', $data);
            }else{
                if($this->jenisPenerimaanModel->add($data)){
                    setFlash('Jenis Penerimaan berhasil ditambahkan.','success');
                    return redirect('jenispenerimaan');
                }else{
                    die('something went wrong');
                }
            }
        }else{
            $this->view('jenis_penerimaan/add', $data);
        }
    }

     //edit
     public function edit($id = ''){
        $data['title'] = 'Edit Jenis Penerimaan';
        $data['menu'] = 'Admin';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => 'Edit Jenis Penerimaan',
                'menu' => 'Admin',
                'id' => $_POST['id'],
                'jenis_penerimaan' => trim($_POST['jenis_penerimaan']),
            ];

            //validate error free
            if(empty($_POST['jenis_penerimaan'])){
                //load view with error
                setFlash('Form input tidak boleh kosong','danger');
                $this->view('jenis_penerimaan/edit', $data);
            }else{
                if($this->jenisPenerimaanModel->update($data)){
                    setFlash('Jenis Penerimaan berhasil diperbarui.','success');
                    return redirect('jenispenerimaan');
                }else{
                    die('something went wrong');
                }
            }
        }else{
            $jp = $this->jenisPenerimaanModel->getById($id);
            if($jp){
                $data['id'] = $id;
                $data['jenis_penerimaan'] = $jp->jenis_penerimaan;
                
                $this->view('jenis_penerimaan/edit', $data);
            }else{
                return redirect('jenispenerimaan');
            }
        }
    }
    
    //delete
    public function delete($id = ''){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($this->jenisPenerimaanModel->delete($id)){
                setFlash('Jenis Penerimaan berhasil dihapus.','success');
            }else{
                die('something went wrong');
            }
        }else{
            return redirect('jenispenerimaan');
        }
    }
}                            
                        