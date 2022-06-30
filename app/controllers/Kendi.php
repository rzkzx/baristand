<?php 
class Kendi extends Controller{

    public function __construct()
    {
        if(!isLoggedIn()){
            return redirect('auth/login');
        }
        //new model instance
        $this->kendiModel = $this->model('KendiModel');

        $this->pegawaiModel = $this->model('PegawaiModel');
        $this->jabatanModel = $this->model('JabatanModel');
        $this->adminModel = $this->model('AdminModel');
    }

    // Peminjaman Kendaraan Controller
    public function index(){
        $kendiModel = $this->kendiModel->getPeminjaman();
        $data = [
            'title' => 'Peminjaman Kendaraan',
            'menu' => 'Kendi',
            'kendi' => $kendiModel
        ];

        $this->view('kendi/peminjaman/index', $data);
    }

    public function addpeminjaman(){
        $data['title'] = 'Buat Permohonan Peminjaman Kendaraan';
        $data['menu'] = 'Kendi';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //validate error free
            if(empty($_POST['merk']) || empty($_POST['tipe']) || empty($_POST['nopol']) || empty($_POST['tgl_pajak'])){
                //load view with error
                setFlash('Form input tidak boleh kosong','danger');
                $this->view('kendi/peminjaman/add', $data);
            }else{
                if($this->kendiModel->addKendaraan($_POST)){
                    setFlash('Kendaraan Dinas berhasil ditambahkan.','success');
                    return redirect('kendi/kendaraan');
                }else{
                    die('something went wrong');
                }
            }
        }else{
            $data['kend'] = $this->kendiModel->getKendaraan();
            $data['pemohon'] = $this->pegawaiModel->get();

            // Atasan Langsung Koordinator,Kasubag TU dan Kepala Balai
            $kepalabalai = $this->jabatanModel->getPegawai('kepala_balai');
            $kasubag_tu = $this->jabatanModel->getPegawai('kasubag_tu');
            $koordinator = $this->jabatanModel->getPegawai('koordinator');
            $data['atasan'] = array_merge($kepalabalai,$kasubag_tu,$koordinator);

            $this->view('kendi/peminjaman/add', $data);
        }
    }


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

    //Kondisi harian Controller
    public function kondisi(){
        $kendi = $this->kendiModel->getKendaraan();
        $data = [
            'title' => 'Kondisi Harian',
            'menu' => 'Kendi',
            'kendi' => $kendi
        ];
  
        $this->view('kendi/kondisi/index', $data);
    }

    public function pemeriksaan($id = ''){
        $data['title'] = 'Pemeriksaan Rutin Kendaraan Dinas BSPJI Banjarbaru';
        $data['menu'] = 'Kendi';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //cek kondisi pemeriksaaan
            $kondisi = count($_POST['kondisi']);
            if($kondisi < 27){
                $layak = 0;
            }else{
                $layak = 1;
            }

            if($this->kendiModel->pemeriksaanKendaraan($_POST['id'],$layak)){
                setFlash('Pemeriksaan Rutin Kendaraan berhasil.','success');
                return redirect('kendi/kondisi');
            }else{
                die('something went wrong');
            }
        }else{
            $kend = $this->kendiModel->getKendaraanById($id);
            if($kend){
                $data['id'] = $id;
                $data['kend'] = $kend;
                
                $this->view('kendi/kondisi/pemeriksaan', $data);
            }else{
                return redirect('kendi/kondisi');
            }
        }
    }

}