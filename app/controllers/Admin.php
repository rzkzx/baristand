<?php 
class Admin extends Controller{
    public function __construct()
    {
        if(!isLoggedIn()){
            return redirect('auth/login');
        }
        //new model instance
        $this->adminModel = $this->model('AdminModel');
        $this->pegawaiModel = $this->model('PegawaiModel');
    }

    public function index(){
        $admin = $this->adminModel->get();
        $no=0;
        $data = [
            'title' => 'Daftar Admin',
            'menu' => 'Pegawai',
            'admin' => $admin
        ];
        foreach ($admin as $adm) {
          $data['pegawai'][$no] = $this->pegawaiModel->getAllNIP($adm->nip_pegawai);
          $no++;
        }

        $this->view('admin/index', $data);
    }

     //edit
     public function edit($id = ''){
        $data['title'] = 'Edit Admin';
        $data['menu'] = 'Pegawai';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //validate error free
            if(empty($_POST['pegawai'])){
                //load view with error
                setFlash('Form input tidak boleh kosong','danger');
                return redirect('admin/edit/'.$_POST['id']);
            }else{
                if($this->adminModel->update($_POST)){
                    setFlash('Admin berhasil diperbarui.','success');
                    return redirect('admin/edit/'.$_POST['id']);
                }else{
                    setFlash('Gagal memperbarui Admin','danger');
                    return redirect('admin');
                }
            }
        }else{
            $admin = $this->adminModel->getById($id);
            if($admin){
                $data['id'] = $id;
                $data['admin'] = $admin;
                $data['pegawai'] = $this->pegawaiModel->getAllNIP($data['admin']->nip_pegawai);
                $data['daftar_pegawai'] = $this->pegawaiModel->get();
                
                $this->view('admin/edit', $data);
            }else{
                return redirect('admin');
            }
        }
    }

    public function deleteAdmin($data)
    {
      $array = explode('-',$data);
      $idAdmin = $array[0];
      $nip = $array[1];

      $admin = $this->adminModel->getById($idAdmin);
      $pegawai = explode(',',$admin->nip_pegawai);
      if (($key = array_search($nip, $pegawai)) !== false) {
          unset($pegawai[$key]);
      }
      $newdata['id'] = $idAdmin;
      $newdata['pegawai'] = $pegawai;
      if($this->adminModel->update($newdata) > 0){
        setFlash('Berhasil hapus admin.', 'success');
        return redirect('admin/edit/'.$idAdmin);
      }
    }
}                            
                        