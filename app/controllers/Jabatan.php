<?php 
class Jabatan extends Controller{
    public function __construct()
    {
        if(!isLoggedIn()){
            return redirect('auth/login');
        }
        //new model instance
        $this->jabatanModel = $this->model('JabatanModel');
        $this->pegawaiModel = $this->model('PegawaiModel');
    }

    public function index(){
        $jabatan = $this->jabatanModel->get();
        $no=0;
        $data = [
            'title' => 'Daftar Jabatan',
            'menu' => 'Pegawai',
            'jabatan' => $jabatan
        ];
        foreach ($jabatan as $jbt) {
            $data['pegawai'][$no] = $this->pegawaiModel->getAllNIP($jbt->nip_pegawai);
            $no++;
        }

        $this->view('jabatan/index', $data);
    }

     //edit
    public function edit($id = ''){
        $data['title'] = 'Edit Jabatan';
        $data['menu'] = 'Pegawai';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //validate error free
            if(empty($_POST['pegawai'])){
                //load view with error
                setFlash('Form input tidak boleh kosong','danger');
                return redirect('jabatan/edit/'.$_POST['id']);
            }else{
                if($this->jabatanModel->update($_POST)){
                    setFlash('Jabatan berhasil diperbarui.','success');
                    return redirect('jabatan/edit/'.$_POST['id']);
                }else{
                    setFlash('Gagal memperbarui Jabatan','danger');
                    return redirect('jabatan');
                }
            }
        }else{
            $jabatan = $this->jabatanModel->getById($id);
            if($jabatan){
                $data['id'] = $id;
                $data['jabatan'] = $jabatan;
                $data['pegawai'] = $this->pegawaiModel->getAllNIP($data['jabatan']->nip_pegawai);
                $data['daftar_pegawai'] = $this->pegawaiModel->get();
                
                $this->view('jabatan/edit', $data);
            }else{
                return redirect('jabatan');
            }
        }
    }

    public function deleteJabatan($data)
    {
        $array = explode('-',$data);
        $idAdmin = $array[0];
        $nip = $array[1];

        $admin = $this->jabatanModel->getById($idAdmin);
        $pegawai = explode(',',$admin->nip_pegawai);
        if (($key = array_search($nip, $pegawai)) !== false) {
            unset($pegawai[$key]);
        }
        $newdata['id'] = $idAdmin;
        $newdata['pegawai'] = $pegawai;
        if($this->jabatanModel->update($newdata) > 0){
            setFlash('Berhasil hapus jabatan.', 'success');
            return redirect('jabatan/edit/'.$idAdmin);
        }
    }
}                            
                        