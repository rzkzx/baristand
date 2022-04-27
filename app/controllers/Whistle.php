<?php 
class Whistle extends Controller{

    public function __construct()
    {
        if(!isLoggedIn()){
          return redirect('auth/login');
        }
        //new model instance
        $this->whistleModel = $this->model('WhistleModel');
        $this->jenisPelanggaranModel = $this->model('JenisPelanggaranModel');
    }

    public function index(){
        $whistle = $this->whistleModel->getAllByNIP();
        $data = [
            'title' => 'Input Laporan Whistleblowing System',
            'menu' => 'Whistleblowing',
            'whistle' => $whistle,
        ];

        $this->view('whistle/index', $data);
    }

    public function laporan(){
        if($_SESSION['role'] == 'ADMIN' || Middleware::jabatan('kasubag_tu') || Middleware::jabatan('kepala_balai')){
            if(ISSET($_POST['search'])){
              $whistle = $this->whistleModel->getAllByDate($_POST['date1'],$_POST['date2']);
            }else{
              $whistle = $this->whistleModel->get();
            }
            $data = [
                'title' => 'Daftar Laporan Whistleblowing System',
                'menu' => 'Whistleblowing',
                'whistle' => $whistle,
            ];

            $this->view('whistle/laporan', $data);
        }else{
          return redirect('whistle');
        }
    }

    public function detail($id = ''){
      $whistle = $this->whistleModel->getById($id);
      if($whistle){
        if($whistle->pelapor != $_SESSION['nip']){
          if($_SESSION['role'] == 'ADMIN' || Middleware::jabatan('kasubag_tu') || Middleware::jabatan('kepala_balai')){
            $data = [
              'title' => 'Detail Laporan Whistleblowing System',
              'menu' => 'Whistleblowing',
              'whistle' => $whistle,
            ];
            
            //render view
            $this->view('whistle/detail', $data);
          }else{
            return redirect('whistle');
          }
        }else{
          $data = [
            'title' => 'Detail Laporan Whistleblowing System',
            'menu' => 'Whistleblowing',
            'whistle' => $whistle,
          ];
          
          //render view
          $this->view('whistle/detail', $data);
        }
      }else{
        return redirect('whistle');
      }
    }

    public function cetak($id = ''){
      $whistle = $this->whistleModel->getById($id);
      if($whistle){
        $whistle->tanggal = dateID($whistle->tanggal);
        $whistle->sign = $whistle->id.'/'.$whistle->tanggal.'/'.$whistle->nama;

        $data = [
            'whistle' => $whistle,
        ];

        $this->view('whistle/cetak', $data);
      }else{
        return redirect('whistle');
      }
    }

    //add new
    public function add(){
        $data['title'] = 'Form Input Laporan Whistleblowing System';
        $data['menu'] = 'Whistleblowing';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //validate error free
            foreach($_POST['pelanggaran'] as $value) if(empty($value)) $_POST['pelanggaran'] = '';
            if(empty($_POST['nama']) || empty($_POST['pelanggaran']) || empty($_POST['instansi']) || empty($_POST['judul_laporan'])){
                //load view with error
                setFlash('Form input tidak boleh kosong','danger');
                return redirect('whistle/add');
            }else{
                if($this->whistleModel->add($_POST,$_FILES['data_dukung'])){
                    setFlash('Laporan Whistleblowing System berhasil dibuat.','success');
                    return redirect('whistle');
                }else{
                    setFlash('Laporan Whistleblowing System gagal dibuat.','danger');
                    return redirect('whistle');
                }
            }
        }else{
            // data load
            $data['jenis_pelanggaran'] = $this->jenisPelanggaranModel->get();

            //render view
            $this->view('whistle/add', $data);
        }
    }

    //delete
    public function delete($id = ''){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          if($this->whistleModel->delete($id)){
              setFlash('Laporan Whistleblowing System berhasil dihapus.','success');
          }else{
              setFlash('Gagal menghapus Laporan Whistleblowing System','danger');
          }
      }else{
          return redirect('whistle');
      }
    }
}                            
                        