<?php 
class JenisPeristiwa extends Controller{

    public function __construct()
    {
        if(!isLoggedIn()){
            return redirect('auth/login');
        }
        //new model instance
        $this->jenisPeristiwaModel = $this->model('JenisPeristiwaModel');
    }

    public function index(){
        $jenis_peristiwa = $this->jenisPeristiwaModel->get();
        $data = [
            'title' => 'Daftar Jenis Peristiwa',
            'menu' => 'Admin',
            'jenis_peristiwa' => $jenis_peristiwa
        ];

        $this->view('jenis_peristiwa/index', $data);
    }

    //add new jp
    public function add(){
        $data['title'] = 'Tambah Jenis Peristiwa';
        $data['menu'] = 'Admin';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => 'Tambah Jenis Peristiwa',
                'menu' => 'Admin',
                'jenis_peristiwa' => trim($_POST['jenis_peristiwa']),
            ];

            //validate error free
            if(empty($data['jenis_peristiwa'])){
                //load view with error
                setFlash('Form input tidak boleh kosong','danger');
                $this->view('jenis_peristiwa/add', $data);
            }else{
                if($this->jenisPeristiwaModel->add($data)){
                    setFlash('Jenis Peristiwa berhasil ditambahkan.','success');
                    return redirect('jenisperistiwa');
                }else{
                    die('something went wrong');
                }
            }
        }else{
            $this->view('jenis_peristiwa/add', $data);
        }
    }

     //edit
     public function edit($id = ''){
        $data['title'] = 'Edit Jenis Peristiwa';
        $data['menu'] = 'Admin';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => 'Edit Jenis Peristiwa',
                'menu' => 'Admin',
                'id' => $_POST['id'],
                'jenis_peristiwa' => trim($_POST['jenis_peristiwa']),
            ];

            //validate error free
            if(empty($_POST['jenis_peristiwa'])){
                //load view with error
                setFlash('Form input tidak boleh kosong','danger');
                $this->view('jenis_peristiwa/edit', $data);
            }else{
                if($this->jenisPeristiwaModel->update($data)){
                    setFlash('Jenis Peristiwa berhasil diperbarui.','success');
                    return redirect('jenisperistiwa');
                }else{
                    die('something went wrong');
                }
            }
        }else{
            $jp = $this->jenisPeristiwaModel->getById($id);
            if($jp){
                $data['id'] = $id;
                $data['jenis_peristiwa'] = $jp->jenis_peristiwa;
                
                $this->view('jenis_peristiwa/edit', $data);
            }else{
                return redirect('jenisperistiwa');
            }
        }
    }
    
    //delete
    public function delete($id = ''){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($this->jenisPeristiwaModel->delete($id)){
                setFlash('Jenis Peristiwa berhasil dihapus.','success');
            }else{
                die('something went wrong');
            }
        }else{
            return redirect('jenisperistiwa');
        }
    }
}                            
                        