<?php 
class Gratifikasi extends Controller{

    public function __construct()
    {
        if(!isLoggedIn()){
          return redirect('auth/login');
        }
        //new model instance
        $this->gratifikasiModel = $this->model('GratifikasiModel');
        $this->jenisPeristiwaModel = $this->model('JenisPeristiwaModel');
        $this->jenisPenerimaanModel = $this->model('JenisPenerimaanModel');
    }

    public function index(){
        $gratifikasi = $this->gratifikasiModel->getAllByNIP();
        $data = [
            'title' => 'Input Laporan Anti Gratifikasi',
            'menu' => 'Gratifikasi',
            'gratifikasi' => $gratifikasi,
        ];

        $this->view('gratifikasi/index', $data);
    }

    public function laporan(){
        if(Middleware::jabatan('kasubag_tu') || Middleware::jabatan('koordinator')){
              $gratifikasi = $this->gratifikasiModel->getAllNotTindakan();
            $data = [
                'title' => 'Daftar Laporan Anti Gratifikasi',
                'menu' => 'Gratifikasi',
                'gratifikasi' => $gratifikasi,
            ];

            $this->view('gratifikasi/laporan', $data);
        }else{
          return redirect('gratifikasi');
        }
    }

    public function rekap(){
      if($_SESSION['role'] == 'ADMIN' || Middleware::jabatan('kasubag_tu') || Middleware::jabatan('koordinator')){
          if(ISSET($_POST['search'])){
            $gratifikasi = $this->gratifikasiModel->getRekapAllByDate($_POST['date1'],$_POST['date2']);
          }else{
            $gratifikasi = $this->gratifikasiModel->getAllRekap();
          }
          $data = [
              'title' => 'Rekap Laporan Anti Gratifikasi',
              'menu' => 'Gratifikasi',
              'gratifikasi' => $gratifikasi,
          ];

          $this->view('gratifikasi/rekap', $data);
      }else{
        return redirect('gratifikasi');
      }
  }

    public function detail($id = ''){
      $gratifikasi = $this->gratifikasiModel->getById($id);
      if($gratifikasi){
        if($gratifikasi->pelapor != $_SESSION['nip']){
          if($_SESSION['role'] == 'ADMIN' || Middleware::jabatan('kasubag_tu') || Middleware::jabatan('koordinator')){
            $data = [
              'title' => 'Detail Laporan Anti Gratifikasi',
              'menu' => 'Gratifikasi',
              'gratifikasi' => $gratifikasi,
            ];
            
            //render view
            $this->view('gratifikasi/detail', $data);
          }else{
            return redirect('gratifikasi');
          }
        }else{
          $data = [
            'title' => 'Detail Laporan Anti Gratifikasi',
            'menu' => 'Gratifikasi',
            'gratifikasi' => $gratifikasi,
          ];
          
          //render view
          $this->view('gratifikasi/detail', $data);
        }
      }else{
        return redirect('gratifikasi');
      }
    }

    public function cetak($id = ''){
      $gratifikasi = $this->gratifikasiModel->getById($id);
      if($gratifikasi){
        $gratifikasi->tanggal = dateID($gratifikasi->tanggal);
        $gratifikasi->sign = $gratifikasi->id.'/'.$gratifikasi->tanggal.'/'.$gratifikasi->nama;

        $data = [
            'gratifikasi' => $gratifikasi,
        ];

        $this->view('gratifikasi/cetak', $data);
      }else{
        return redirect('gratifikasi');
      }
    }

    //add new
    public function add(){
        $data['title'] = 'Form Input Laporan Anti Gratifikasi';
        $data['menu'] = 'Gratifikasi';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //validate error free
            if(empty($_POST['taksiran']) || empty($_POST['tempat_penerimaan']) || empty($_POST['tanggal']) || empty($_POST['penerima']) || empty($_POST['pemberi'])){
                //load view with error
                setFlash('Form input tidak boleh kosong','danger');
                return redirect('gratifikasi/add');
            }else{
                if($this->gratifikasiModel->add($_POST)){
                    setFlash('Laporan Anti Gratifikasi Berhasil dibuat.','success');
                    return redirect('gratifikasi');
                }else{
                    setFlash('Laporan Anti Gratifikasi Gagal dibuat.','danger');
                    return redirect('gratifikasi');
                }
            }
        }else{
            // data load
            $data['jenis_peristiwa'] = $this->jenisPeristiwaModel->get();
            $data['jenis_penerimaan'] = $this->jenisPenerimaanModel->get();

            //render view
            $this->view('gratifikasi/add', $data);
        }
    }

    // validasi control
    public function tindakan($id = ''){
      $data['title'] = 'Tindak Lanjuti Laporan Anti Gratifikasi';
      $data['menu'] = 'Gratifikasi';
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          
          //validate error free
          if(empty($_POST['tindakan'])){
              //load view with error
              setFlash('Form input tidak boleh kosong','danger');
              return redirect('gratifikasi/tindakan/'.$_POST['id']);
          }else{
              $grt = $this->gratifikasiModel->getById($_POST['id']);
              if($grt && !$grt->is_tindak && Middleware::jabatan('kasubag_tu') || Middleware::jabatan('koordinator')){
                  if($this->gratifikasiModel->tindakan($_POST)){

                      // redirect after success validate
                      setFlash('Berhasil Menindak Lanjuti Laporan Anti Gratifikasi.','success');
                      return redirect('gratifikasi/rekap');
                  }else{
                      setFlash('Gagal Menindak Lanjuti Laporan Anti Gratifikasi','danger');
                      return redirect('gratifikasi/laporan');
                  }
              }else{
                  setFlash('Gagal Menindak Lanjuti Laporan Anti Gratifikasi','danger');
                  return redirect('gratifikasi/laporan');
              }
          }
      }else{
          $gratifikasi = $this->gratifikasiModel->getById($id);
          if($gratifikasi && !$gratifikasi->is_tindak && Middleware::jabatan('kasubag_tu') || Middleware::jabatan('koordinator')){
              $data['id'] = $id;
              $data['gratifikasi'] = $gratifikasi;
              
              $this->view('gratifikasi/tindakan', $data);
          }else{
              return redirect('gratifikasi/laporan');
          }
      }
  }


    //delete
    public function delete($id = ''){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $gratifikasi = $this->gratifikasiModel->getById($id);
        if($gratifikasi && !$gratifikasi->is_tindak && $gratifikasi->pelapor == $_SESSION['nip']){
          if($this->gratifikasiModel->delete($id)){
              setFlash('Laporan Anti Gratifikasi berhasil dihapus.','success');
          }else{
              setFlash('Gagal menghapus Laporan Anti Gratifikasi','danger');
          }
        }else{
          setFlash('Gagal menghapus Laporan Anti Gratifikasi','danger');
        }
      }else{
          return redirect('gratifikasi');
      }
    }
}                            
                        