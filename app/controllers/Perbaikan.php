<?php

class Perbaikan extends Controller
{
  public function __construct()
  {
    if(!isLoggedIn()){
      return redirect('auth/login');
    }
    //new model instance
    $this->perbaikanModel = $this->model('PerbaikanModel');
    $this->tBarangModel = $this->model('TBarangModel');

    $this->pegawaiModel = $this->model('PegawaiModel');
    $this->jabatanModel = $this->model('JabatanModel');
    $this->adminModel = $this->model('AdminModel');
    $this->formulirModel = $this->model('FormulirModel');
  }

  public function index(){
    //delete barang
    $this->tBarangModel->deleteAll();

    $perbaikanAll = $this->perbaikanModel->getAll();
    if(Middleware::jabatan('kepala_balai') || Middleware::jabatan('kasubag_tu') || Middleware::jabatan('ppk') || Middleware::admin('perbaikan') || $_SESSION['role'] == 'ADMIN'){
      $perbaikan = $perbaikanAll;
    }else{
      $perbaikanNIP = $this->perbaikanModel->getByNIP($_SESSION['nip']);
      $no=0;
      foreach ($perbaikanAll as $k) {
        $petugas = explode(',',$k->nip_petugas_perbaikan);
        if(in_array($_SESSION['nip'],$petugas)){
        }else{
          $perbaikanAll[$no] = NULL;
        }
        $no++;
      }
      $perbaikanPetugas = array_filter($perbaikanAll); // menghapus value array yang kosong
      $perbaikan = array_merge($perbaikanNIP,$perbaikanPetugas);
    }

    $data = [
        'title' => 'Daftar Perbaikan',
        'menu' => 'Perbaikan',
        'perbaikan' => $perbaikan
    ];

    $this->view('perbaikan/index', $data);
  }

  public function rekap(){
    if(Middleware::jabatan('ppk') || Middleware::jabatan('kasubag_tu') || Middleware::admin('perbaikan') || $_SESSION['role'] == 'ADMIN'){
        if(ISSET($_POST['search'])){
          $rekap = $this->perbaikanModel->getAllSelesaiByDate($_POST['date1'],$_POST['date2']);
        }else{
          $rekap = $this->perbaikanModel->getAllSelesai();
        }

        $data = [
            'title' => 'Rekap Perbaikan',
            'menu' => 'Perbaikan',
            'rekap' => $rekap,
        ];

        $this->view('perbaikan/rekap', $data);
    }else{
        return redirect('perbaikan');
    }
  }

  public function add(){
    $data['title'] = 'Buat Permohonan Perbaikan';
    $data['menu'] = 'Perbaikan';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //validate error free
        if(empty($_POST['nip_pemohon'])||empty($_POST['nip_atasan'])){
            //load view with error
            setFlash('Form input tidak boleh kosong','danger');
            return redirect('perbaikan/add');
        }else{
            if($this->perbaikanModel->add($_POST)){
                $this->tBarangModel->deleteAll();
                // get atasan data
                $ats = $this->pegawaiModel->getByNIP($_POST['nip_atasan']);
                // send notification to whatsapp atasan
                $data['no_telp'] = $ats->no_telp;
                $data['isi_pesan'] = "[BSPJI:SIP-Perbaikan] Validasi Atasan - Harap Ditindaklanjuti";
                notifWA($data);

                //redirect and set notif flash
                setFlash('Berhasil membuat pengusulan perbaikan.','success');
                return redirect('perbaikan');
            }else{
                setFlash('Gagal membuat pengusulan perbaikan.','danger');
                return redirect('perbaikan');
            }
        }
    }else{
        // Atasan Langsung Koordinator,Kasubag TU dan Kepala Balai
        $kepalabalai = $this->jabatanModel->getPegawai('kepala_balai');
        $kasubag_tu = $this->jabatanModel->getPegawai('kasubag_tu');
        $koordinator = $this->jabatanModel->getPegawai('koordinator');

        
        //data 
        $data['jabatan'] = array_merge($kepalabalai,$kasubag_tu,$koordinator);
        $data['tbarang'] = $this->tBarangModel->getAll();
        $data['nama'] = $this->pegawaiModel->get();

        //render view
        $this->view('perbaikan/add', $data);
    }
  }

  public function detail_rekap($serial_number = ''){
    if(Middleware::jabatan('ppk') || Middleware::jabatan('kasubag_tu') || Middleware::jabatan('kepala_balai') || Middleware::admin('perbaikan') || $_SESSION['role'] == 'ADMIN'){
      $data = [
        'title' => 'Detail Rekap Perbaikan',
        'menu' => 'Perbaikan',
      ];

      $pb = $this->perbaikanModel->getBySerial($serial_number);

      if($pb && $pb->hasil){
        $data['perbaikan'] = $pb;
        $data['atasan'] = $this->perbaikanModel->getBySerialAtasan($serial_number);
        $data['penanggung'] = $this->perbaikanModel->getBySerialPenanggung($serial_number);
        $data['barang'] = $this->perbaikanModel->getBarangBySerial($serial_number);
      
        $this->view('perbaikan/detail_rekap', $data);
      }else{
        return redirect('perbaikan');
      }
    }else{
      return redirect('perbaikan');
    }
  }

  public function informasi($serial_number = ''){
    $data = [
      'title' => 'Informasi Perbaikan',
      'menu' => 'Perbaikan',
    ];

    $data['perbaikan'] = $this->perbaikanModel->getBySerial($serial_number);
    $data['atasan'] = $this->perbaikanModel->getBySerialAtasan($serial_number);
    $data['penanggung'] = $this->perbaikanModel->getBySerialPenanggung($serial_number);
    $data['barang'] = $this->perbaikanModel->getBarangBySerial($serial_number);
  
    $this->view('perbaikan/informasi', $data);
  }
  

  public function cetak($serial_number = '')
  {
    $data['form'] = $this->formulirModel->getByName('PPR');
    $data['title'] = 'Cetak Surat Ijin Lembur';
    $data['perbaikan'] = $this->perbaikanModel->getBySerial($serial_number);
    $data['kepala_balai'] = $this->jabatanModel->getPegawai('kepala_balai');
    $data['kasubag'] = $this->jabatanModel->getPegawai('kepala_balai');
    $data['perbaikan'] = $this->perbaikanModel->getBySerial($serial_number);
    $data['atasan'] = $this->perbaikanModel->getBySerialAtasan($serial_number);
    $data['penanggung'] = $this->perbaikanModel->getBySerialPenanggung($serial_number);
    $data['barang'] = $this->perbaikanModel->getBarangBySerial($serial_number);
    
    $this->view('perbaikan/cetak', $data);
  }

  public function validasi1($serial_number = ''){
    $data['title'] = 'Validasi Atasan Langsung';
    $data['menu'] = 'Perbaikan';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        //validate error free
        if(empty($_POST['status'])){
            //load view with error
            setFlash('Form input tidak boleh kosong','danger');
            return redirect('perbaikan/validasi1/'.$_POST['serial_number']);
        }else{
            $pb = $this->perbaikanModel->getBySerial($_POST['serial_number']);
            if($pb && !$pb->waktu_validasi1 && $pb->nip_atasan == $_SESSION['nip']){
                if($this->perbaikanModel->tambahan1($_POST)){
                  if($_POST['status'] == 'Disetujui atasan langsung'){
                    //get atasan data
                    $kb = $this->jabatanModel->getPegawai('kepala_balai');
                    // send notification to whatsapp atasan
                    $data['isi_pesan'] = "[BSPJI:SIP-Perbaikan] Validasi Kepala Balai - Harap Ditindaklanjuti";
                    foreach ($kb as $k) {
                        $data['no_telp'] = $k->no_telp;
                        notifWA($data);
                    }
                }
                    setFlash('Berhasil validasi perbaikan.','success');
                    return redirect('perbaikan');
                }else{
                    setFlash('Gagal validasi perbaikan','danger');
                    return redirect('perbaikan');
                }
            }else{
                setFlash('Gagal validasi perbaikan','danger');
                return redirect('perbaikan');
            }
        }
    }else{
        $pb = $this->perbaikanModel->getBySerial($serial_number);
        if($pb && !$pb->waktu_validasi1 && $pb->nip_atasan == $_SESSION['nip']){
            $data['serial'] = $serial_number;
            $data['perbaikan'] = $pb;
            
            $this->view('perbaikan/validasi1', $data);
        }else{
            return redirect('perbaikan');
        }
    }
  }

  public function validasi2($serial_number = ''){
    $data['title'] = 'Validasi Kepala Balai';
    $data['menu'] = 'Perbaikan';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        //validate error free
        if(empty($_POST['status'])){
            //load view with error
            setFlash('Form input tidak boleh kosong','danger');
            return redirect('perbaikan/validasi2/'.$_POST['serial_number']);
        }else{
            $pb = $this->perbaikanModel->getBySerial($_POST['serial_number']);
            if($pb && $pb->waktu_validasi1 && Middleware::jabatan('kepala_balai')){
                if($this->perbaikanModel->tambahan2($_POST)){
                  if($_POST['status'] == 'Disetujui kepala balai'){
                    //get atasan data
                    $ks = $this->jabatanModel->getPegawai('kasubag_tu');
                    // send notification to whatsapp atasan
                    $data['isi_pesan'] = "[BSPJI:SIP-Perbaikan] Validasi Kasubag - Harap Ditindaklanjuti";
                    foreach ($ks as $k) {
                        $data['no_telp'] = $k->no_telp;
                        notifWA($data);
                      }
                    }
                    setFlash('Berhasil validasi perbaikan.','success');
                    return redirect('perbaikan');
                }else{
                    setFlash('Gagal validasi perbaikan','danger');
                    return redirect('perbaikan');
                }
            }else{
                setFlash('Gagal validasi perbaikan','danger');
                return redirect('perbaikan');
            }
        }
    }else{
        $pb = $this->perbaikanModel->getBySerial($serial_number);
        if($pb && $pb->waktu_validasi1 && Middleware::jabatan('kepala_balai')){
            $data['serial'] = $serial_number;
            $data['perbaikan'] = $pb;
            $data['atasan'] = $this->perbaikanModel->getBySerialAtasan($serial_number);
            
            $this->view('perbaikan/validasi2', $data);
        }else{
            return redirect('perbaikan');
        }
    }
  }

  public function validasikasubag($serial_number = ''){
    $data['title'] = 'Disposisi Dari Kasubag TU';
    $data['menu'] = 'Perbaikan';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        //validate error free
        if(empty($_POST['status']) && empty($_POST['alasan_dispo'])){
            //load view with error
            setFlash('Form input tidak boleh kosong','danger');
            return redirect('perbaikan/validasikasubag/'.$_POST['serial_number']);
        }else{
            $pb = $this->perbaikanModel->getBySerial($_POST['serial_number']);
            if($pb && $pb->waktu_validasi2 && Middleware::jabatan('kasubag_tu')){
                if($this->perbaikanModel->tambahanKasubag($_POST)){

                    // redirect after success validate
                    setFlash('Berhasil disposisi perbaikan.','success');
                    return redirect('perbaikan/validasikasubag/'.$_POST['serial_number']);
                }else{
                    setFlash('Gagal disposisi perbaikan','danger');
                    return redirect('perbaikan');
                }
            }else{
                setFlash('Gagal disposisi perbaikan','danger');
                return redirect('perbaikan');
            }
        }
    }else{
        $pb = $this->perbaikanModel->getBySerial($serial_number);
        if($pb && $pb->waktu_validasi2 && Middleware::jabatan('kasubag_tu')){
            $data['serial'] = $serial_number;
            $data['perbaikan'] = $pb;
            
            if($pb->waktu_disposisi && !$pb->alasan_dispo){
              $data['penanggung'] = $this->adminModel->getPegawai('perbaikan');
              $this->view('perbaikan/disposisi', $data);
            }else{
              if(!$pb->alasan_dispo){
                $this->view('perbaikan/validasikasubag', $data);
              }else{
                return redirect('perbaikan');
              }
            }
        }else{
            return redirect('perbaikan');
        }
    }
  }

  public function accDisposisi($serial_number = ''){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      if (empty($_POST['nip_penanggung'])) {
        setFlash('Tolong pilih penanggung jawab', 'danger');
        return redirect('perbaikan/validasikasubag/'.$_POST['serial_number']);
      }  
      if ($this->perbaikanModel->tambahandispo($_POST) > 0) {
        // get atasan data
        $png = $this->pegawaiModel->getByNIP($_POST['nip_penanggung']);
        // send notification to whatsapp atasan
        $data['no_telp'] = $png->no_telp;
        $data['isi_pesan'] = "[BSPJI:SIP-Perbaikan] Penugasan Petugas - Harap Ditindaklanjuti";
        notifWA($data);
        setFlash('Penanggung jawab dipilih.', 'success');
        return redirect('perbaikan');
      }else{
        setFlash('Failed to disposition the data', 'danger');
        return redirect('perbaikan');
      }
    }else{
      return redirect('perbaikan');
    }
  }

  public function penugasan($serial_number = ''){
    $data['title'] = 'Penugasan Perbaikan';
    $data['menu'] = 'Perbaikan';
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          
          //validate error free
          //get data
          $pb = $this->perbaikanModel->getBySerial($_POST['serial_number']);
          $barang = $this->perbaikanModel->getBarangBySerial($_POST['serial_number']);

          $array = (explode(",",$pb->nip_petugas_perbaikan));
          $jumlah_petugas = count($array);
          $jumlah_barang = count($barang);
          
          if(empty($_POST['penugasan']) || $jumlah_petugas != $jumlah_barang){
              //load view with error
              setFlash('Semua petugas wajib diisi','danger');
              return redirect('perbaikan/penugasan/'.$_POST['serial_number']);
          }else{
              if($pb && $pb->disposisi && $pb->nip_penanggung == $_SESSION['nip']){
                  if($this->perbaikanModel->tambahanPenugasan($_POST)){

                      // redirect after success validate
                      setFlash('Penugasan perbaikan berhasil','success');
                      return redirect('perbaikan');
                  }else{
                      setFlash('Penugasan perbaikan gagal','danger');
                      return redirect('perbaikan');
                  }
              }else{
                  setFlash('Penugasan perbaikan gagal','danger');
                  return redirect('perbaikan');
              }
          }
      }else{
          $pb = $this->perbaikanModel->getBySerial($serial_number);
          if($pb && $pb->disposisi && $pb->nip_penanggung == $_SESSION['nip']){
              $data['serial'] = $serial_number;
              $data['perbaikan'] = $pb;

              $data['barang'] = $this->perbaikanModel->getBarangBySerial($serial_number);
              $data['timperbaikan'] = $this->pegawaiModel->get();
              
              $this->view('perbaikan/penugasan', $data);
          }else{
              return redirect('perbaikan');
          }
      }
  }

  public function accPetugas(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      foreach($_POST['nip_petugas'] as $value) if(empty($value)) $_POST['nip_petugas'] = '';
      if (empty($_POST['nip_petugas']) && empty($_POST['deadline'])) {
        setFlash('Tolong pilih petugas dan deadline', 'danger');
        return redirect('/perbaikan/penugasan/'.$_POST['seri_perbaikan']);
        }  
      if ($this->perbaikanModel->tambahanPetugas($_POST) &  $this->perbaikanModel->tambahanPetugasPerbaikan($_POST)) {
        $ptg = $this->pegawaiModel->getByNIP(end($_POST['nip_petugas']));
        // send notification to whatsapp
        $data['no_telp'] = $ptg->no_telp;
        $data['isi_pesan'] = "[BSPJI:SIP-Perbaikan] Penugasan Perbaikan - Harap Ditindaklanjuti";
        notifWA($data);
        setFlash('Petugas berhasil ditambahkan.', 'success');
        return redirect('/perbaikan/penugasan/'.$_POST['seri_perbaikan']);
      }else{
        setFlash('Petugas gagal ditambahkan.', 'danger');
        return redirect('/perbaikan/penugasan/'.$_POST['seri_perbaikan']);
      }
    }else{
      return redirect('perbaikan');
    }
  }

public function konfirmasiPenugasan($serial_number = ''){
  $data['title'] = 'Konfirmasi Perbaikan';
  $data['menu'] = 'Perbaikan';

  $pb = $this->perbaikanModel->getByPetugas($serial_number);
  if($pb){
      $data['serial'] = $serial_number;
      $data['barang'] = $pb;
      $data['timperbaikan'] = $this->pegawaiModel->get();
      $data['perbaikan'] = $this->perbaikanModel->getBySerial($serial_number);
      
      $this->view('perbaikan/konfirmasiPenugasan', $data);
  }else{
      return redirect('perbaikan');
  }
}

  public function accKonfirmasiDiterima(){ 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      if ($this->perbaikanModel->konfirmasiDiterima($_POST)) {
          setFlash('Tugas diterima', 'success');
          return redirect('perbaikan/konfirmasiPenugasan/'.$_POST['seri_perbaikan']);
      }else{
          setFlash('Konfirmasi diterima', 'success');
          return redirect('perbaikan/konfirmasiPenugasan/'.$_POST['seri_perbaikan']);
      }
    }else{
      return redirect('perbaikan');
    }
  }

  public function accKonfirmasiSelesai(){ 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      if ($this->perbaikanModel->konfirmasiSelesai($_POST)) {
        // send notification to whatsapp
        $data['no_telp'] = $_POST['no_telp'];
        $data['isi_pesan'] = "[BSPJI:SIP-Perbaikan] Perbaikan Selesasi - Harap Ditindaklanjuti";
        notifWA($data);
          setFlash('Perbaikan selesai dikerjakan', 'success');
          return redirect('perbaikan/konfirmasiPenugasan/'.$_POST['seri_perbaikan']);
      }else{
        // send notification to whatsapp
        $data['no_telp'] = $_POST['no_telp'];
        $data['isi_pesan'] = "[BSPJI:SIP-Perbaikan] Perbaikan Selesasi - Harap Ditindaklanjuti";
        notifWA($data);
          setFlash('Perbaikan selesai dikerjakan ', 'success');
          return redirect('perbaikan/konfirmasiPenugasan/'.$_POST['seri_perbaikan']);
      }
    }else{
      return redirect('perbaikan');
    }
  }

  public function hasil($serial_number = ''){
    $data['title'] = 'Konfirmasi hasil Perbaikan';
    $data['menu'] = 'Perbaikan';

    $pb = $this->perbaikanModel->getBySerial($serial_number);

    if($pb || $pb->nip_pemohon == $_SESSION['nip']){
      $data['perbaikan'] = $pb;
      $data['barang'] = $this->perbaikanModel->getBarangBySerial($serial_number);
      $data['timperbaikan'] = $this->pegawaiModel->get();

      $this->view('perbaikan/hasil', $data);
    }else{
      return redirect('perbaikan');
    }
  }

  public function accKonfirmasiHasil(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      if ($this->perbaikanModel->tambahanHasil($_POST)) {
          setFlash('Konfirmasi diterima', 'success');
          return redirect('perbaikan/hasil/'.$_POST['seri_perbaikan']);
      }else{
          setFlash('konfirmasi gagal', 'danger');
          return redirect('perbaikan/hasil/'.$_POST['seri_perbaikan']);
      }
    }else{
      return redirect('perbaikan');
    }
  }

  public function accHasil(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $barang = $this->perbaikanModel->getBarangBySerial($_POST['serial_number']);
      $invalid = 0;
      foreach ($barang as $k) {
        if(!$k->hasil){
          $invalid++;
        }
      }

      if($invalid > 0){
        setFlash('Pastikan semua barang telah dikonfirmasi', 'danger');
        return redirect('perbaikan/hasil/'.$_POST['serial_number']);
      }else{
        if($this->perbaikanModel->tambahanHasilAkhir($_POST)) {
          setFlash('Konfirmasi diterima', 'success');
          return redirect('perbaikan');
        }else{
          setFlash('konfirmasi gagal', 'danger');
          return redirect('perbaikan/hasil/'.$_POST['seri_perbaikan']);
        }
      }
    }else{
      return redirect('perbaikan');
    }
  }

  public function addbarang(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      if (empty($_POST['nbarang']) || empty($_POST['jumlah']) || empty($_POST['keterangan'])) {
          setFlash('Form input tidak boleh kosong', 'danger');
          return redirect('perbaikan/add');
      }
      if ($this->tBarangModel->add($_POST)) {
          setFlash('Success added Perbaikan.', 'success');
          return redirect('perbaikan/add');
      }else{
          setFlash('Failed to add Perbaikan', 'danger');
          return redirect('perbaikan/add');
      }
    }else{
      return redirect('perbaikan/add');
    }
  }

  public function deleteBarang($id = ''){
    if ($this->tBarangModel->delete($id)) {
      setFlash('Perbaikan deleted successfully', 'success');
      return redirect('perbaikan/add');
    }else{
      setFlash('Failed to delete Perbaikan', 'danger');
      return redirect('perbaikan/add');
    }
  }

  public function deleteSemuaBarang(){
    if ($this->tBarangModel->deleteAll()) {
      setFlash('Perbaikan deleted successfully', 'success');
      return redirect('perbaikan/add');
    }else{
      setFlash('Failed to delete Perbaikan', 'danger');
      return redirect('perbaikan/add');
    }
  }

}
?>