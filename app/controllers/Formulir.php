<?php 
class Formulir extends Controller{

    public function __construct()
    {
        if(!isLoggedIn()){
            return redirect('auth/login');
        }
        //new model instance
        $this->formulirModel = $this->model('FormulirModel');
    }

    public function index(){
        $formulir = $this->formulirModel->get();
        $data = [
            'title' => 'Formulir',
            'menu' => 'Admin',
            'formulir' => $formulir
        ];

        $this->view('formulir/index', $data);
    }

     //edit
     public function edit($id = ''){
        $data['title'] = 'Edit Formulir';
        $data['menu'] = 'Admin';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //validate error free
            if(empty($_POST['nama']) || empty($_POST['kode'])){
                //load view with error
                setFlash('Form input tidak boleh kosong','danger');
                return redirect('formulir/edit/'.$_POST['id']);
            }else{
                if($this->formulirModel->update($_POST)){
                    setFlash('Formulir berhasil diperbarui.','success');
                    return redirect('formulir');
                }else{
                    setFlash('Formulir gagal diperbarui.','danger');
                    return redirect('formulir');
                }
            }
        }else{
            $formulir = $this->formulirModel->getById($id);
            if($formulir){
                $data['id'] = $id;
                $data['formulir'] = $formulir;
                
                $this->view('formulir/edit', $data);
            }else{
                return redirect('formulir');
            }
        }
    }
}                            
                        