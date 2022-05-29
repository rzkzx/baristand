<?php

class Pengadaan extends Controller
{
  public function __construct()
  {
    if(!isLoggedIn()){
      return redirect('auth/login');
    }
    //new model instance
    $this->pengadaanModel = $this->model('PengadaanModel');
    $this->tBahanModel = $this->model('TBahanModel');

    $this->pegawaiModel = $this->model('PegawaiModel');
    $this->jabatanModel = $this->model('JabatanModel');
    $this->adminModel = $this->model('AdminModel');
    $this->formulirModel = $this->model('FormulirModel');
  }

  public function index(){
    // delete bahan
    $this->tBahanModel->deleteAll();


    if(Middleware::jabatan('kepala_balai') || Middleware::jabatan('kasubag_tu') || Middleware::jabatan('ppk') || Middleware::admin('pengadaan') || $_SESSION['role'] == 'ADMIN'){
      $pengadaan = $this->pengadaanModel->getAll();
    }else{
      $pengadaan = $this->pengadaanModel->getByNIP($_SESSION['nip']);
    }

    $data = [
      'title' => 'Daftar Pengadaan',
      'menu' => 'Pengadaan',
      'pengadaan' => $pengadaan
    ];

    $this->view('pengadaan/index', $data);
  }

  public function rekap(){
    if(Middleware::jabatan('kepala_balai') || Middleware::jabatan('kasubag_tu') || Middleware::jabatan('ppk') || Middleware::admin('pengadaan') || $_SESSION['role'] == 'ADMIN'){
      if(ISSET($_POST['search'])){
        $pengadaan = $this->pengadaanModel->getAllSelesaiByDate($_POST['date1'],$_POST['date2']);
      }else{
        $pengadaan = $this->pengadaanModel->getAllSelesai();
      }

      $data = [
        'title' => 'Rekap Pengadaan',
        'menu' => 'Pengadaan',
        'pengadaan' => $pengadaan
      ];
      

      $this->view('pengadaan/rekap', $data);
    }else{
      return redirect('pengadaan');
    }
  }

  public function cetak($serial_number = '')
  {
    $data['form'] = $this->formulirModel->getByName('PPR');
    $data['title'] = 'Cetak Surat Pengadaan';
    $data['pengadaan'] = $this->pengadaanModel->getBySerial($serial_number);
    $data['kepala_balai'] = $this->jabatanModel->getPegawai('kepala_balai');
    $data['ppk'] = $this->jabatanModel->getPegawai('ppk');
    $data['atasan'] = $this->pengadaanModel->getBySerialAtasan($serial_number);
    $data['penanggung'] = $this->pengadaanModel->getBySerialPenanggung($serial_number);
    $data['bahan'] = $this->pengadaanModel->getBahanBySerial($serial_number);    

    $this->view('pengadaan/cetak', $data);
  }

  public function validasi1($serial = ''){
    $data = [
        'title' => 'Pengadaan - Validasi Atasan Langsung',
        'menu' => 'Pengadaan',
    ];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
        //validate error free
        if(empty($_POST['status'])){
            //load view with error
            setFlash('Form input tidak boleh kosong','danger');
            return redirect('pengadaan/validasi1/'.$_POST['serial']);
        }else{
            $png = $this->pengadaanModel->getBySerial($_POST['serial']);
            if($png && !$png->waktu_validasi1 && $png->nip_atasan == $_SESSION['nip']){
                if($this->pengadaanModel->tambahan1($_POST)){
                    if($_POST['validasi'] == 'Disetujui'){
                        //get atasan data
                        $kb = $this->jabatanModel->getPegawai('kasubag_tu');
                        // send notification to whatsapp atasan
                        $data['isi_pesan'] = "[BRSBB:SIP-Pengadaan] Harap Ditindaklanjuti";
                        foreach ($kb as $k) {
                            $data['no_telp'] = $k->no_telp;
                            notifWA($data);
                        }
                    }
                    
                    // redirect after success validate
                    setFlash('Berhasil memvalidasi pengadaan','success');
                    return redirect('pengadaan');
                }else{
                    setFlash('Gagal memvalidasi pengadaan','danger');
                    return redirect('pengadaan');
                }
            }else{
                setFlash('Gagal memvalidasi pengadaan','danger');
                return redirect('pengadaan');
            }
        }
    }else{
        $png = $this->pengadaanModel->getBySerial($serial);
        if($png && !$png->waktu_validasi1 && $png->nip_atasan == $_SESSION['nip']){
            //load data
            $data['pengadaan'] = $png;
            $data['serial'] = $serial;

            $this->view('pengadaan/validasi1', $data);
        }else{
            return redirect('pengadaan');
        }
    }
  }

  public function validasi2($serial = ''){
    $data = [
        'title' => 'Pengadaan - Validasi Kasubag TU',
        'menu' => 'Pengadaan',
    ];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
        //validate error free
        if(empty($_POST['status'])){
            //load view with error
            setFlash('Form input tidak boleh kosong','danger');
            return redirect('pengadaan/validasi2/'.$_POST['serial']);
        }else{
            $png = $this->pengadaanModel->getBySerial($_POST['serial']);
            if($png && $png->waktu_validasi1 && !$png->waktu_validasi2 && Middleware::jabatan('kasubag_tu')){
                if($this->pengadaanModel->tambahan2($_POST)){
                    if($_POST['validasi'] == 'Disetujui'){
                        //get atasan data
                        $kb = $this->jabatanModel->getPegawai('kepala_balai');
                        // send notification to whatsapp atasan
                        $data['isi_pesan'] = "[BRSBB:SIP-Pengadaan] Harap Ditindaklanjuti";
                        foreach ($kb as $k) {
                            $data['no_telp'] = $k->no_telp;
                            notifWA($data);
                        }
                    }
                    
                    // redirect after success validate
                    setFlash('Berhasil memvalidasi pengadaan','success');
                    return redirect('pengadaan');
                }else{
                    setFlash('Gagal memvalidasi pengadaan','danger');
                    return redirect('pengadaan');
                }
            }else{
                setFlash('Gagal memvalidasi pengadaan','danger');
                return redirect('pengadaan');
            }
        }
    }else{
        $png = $this->pengadaanModel->getBySerial($serial);
        if($png && $png->waktu_validasi1 && !$png->waktu_validasi2 && Middleware::jabatan('kasubag_tu')){
            //load data
            $data['pengadaan'] = $png;
            $data['serial'] = $serial;
            $data['atasan'] = $this->pengadaanModel->getBySerialAtasan($serial);

            $this->view('pengadaan/validasi2', $data);
        }else{
            return redirect('pengadaan');
        }
    }
  }

  public function validasi3($serial = ''){
    $data = [
        'title' => 'Pengadaan - Validasi Kepala Balai',
        'menu' => 'Pengadaan',
    ];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
        //validate error free
        if(empty($_POST['status'])){
            //load view with error
            setFlash('Form input tidak boleh kosong','danger');
            return redirect('pengadaan/validasi3/'.$_POST['serial']);
        }else{
            $png = $this->pengadaanModel->getBySerial($_POST['serial']);
            if($png && $png->waktu_validasi2 && !$png->waktu_validasi3 && Middleware::jabatan('kepala_balai')){
                if($this->pengadaanModel->tambahan3($_POST)){
                    if($_POST['validasi'] == 'Disetujui'){
                        //get atasan data
                        $kb = $this->jabatanModel->getPegawai('ppk');
                        // send notification to whatsapp atasan
                        $data['isi_pesan'] = "[BRSBB:SIP-Pengadaan] Harap Ditindaklanjuti";
                        foreach ($kb as $k) {
                            $data['no_telp'] = $k->no_telp;
                            notifWA($data);
                        }
                    }
                    
                    // redirect after success validate
                    setFlash('Berhasil memvalidasi pengadaan','success');
                    return redirect('pengadaan');
                }else{
                    setFlash('Gagal memvalidasi pengadaan','danger');
                    return redirect('pengadaan');
                }
            }else{
                setFlash('Gagal memvalidasi pengadaan','danger');
                return redirect('pengadaan');
            }
        }
    }else{
        $png = $this->pengadaanModel->getBySerial($serial);
        if($png && $png->waktu_validasi2 && !$png->waktu_validasi3 && Middleware::jabatan('kepala_balai')){
            //load data
            $data['pengadaan'] = $png;
            $data['serial'] = $serial;
            $data['atasan'] = $this->pengadaanModel->getBySerialAtasan($serial);

            $this->view('pengadaan/validasi3', $data);
        }else{
            return redirect('pengadaan');
        }
    }
  }

  public function validasippk($serial = ''){
    $data = [
        'title' => 'Pengadaan - Disposisi Dari PPK',
        'menu' => 'Pengadaan',
    ];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
        //validate error free
        if(empty($_POST['status'])){
            //load view with error
            setFlash('Form input tidak boleh kosong','danger');
            return redirect('pengadaan/validasippk/'.$_POST['serial']);
        }else{
            $png = $this->pengadaanModel->getBySerial($_POST['serial']);
            if($png && $png->waktu_validasi3 && Middleware::jabatan('ppk')){
                if($this->pengadaanModel->tambahanPpk($_POST)){
                    // redirect after success validate
                    setFlash('Berhasil memvalidasi pengadaan','success');
                    return redirect('pengadaan/validasippk/'.$_POST['serial']);
                }else{
                    setFlash('Gagal memvalidasi pengadaan','danger');
                    return redirect('pengadaan');
                }
            }else{
                setFlash('Gagal memvalidasi pengadaan','danger');
                return redirect('pengadaan');
            }
        }
    }else{
        $png = $this->pengadaanModel->getBySerial($serial);
        if($png && $png->waktu_validasi3 && Middleware::jabatan('ppk')){
            //load data
            $data['pengadaan'] = $png;
            $data['serial'] = $serial;
            $data['atasan'] = $this->pengadaanModel->getBySerialAtasan($serial);

            if($png->waktu_disposisi && !$png->alasan_dispo){
              $data['penanggung'] = $this->adminModel->getPegawai('pengadaan');
              $this->view('pengadaan/disposisi', $data);
            }else{
              if(!$png->alasan_dispo){
                $this->view('pengadaan/validasippk', $data);
              }else{
                return redirect('pengadaan');
              }
            }
        }else{
            return redirect('pengadaan');
        }
    }
  }


public function accDisposisi(){
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if (empty($_POST['nip_penanggung'])) {
      setFlash('Pilih pejabat Pengadaan', 'danger');
      return redirect('pengadaan/disposisi/'.$_POST['serial']);
    }  
    if ($this->pengadaanModel->tambahandispo($_POST)) {
        setFlash('Pejabat Pengadaan Dipilih.', 'success');
        return redirect('pengadaan');
    }else{
        setFlash('Failed to disposition the data', 'danger');
        return redirect('pengadaan');
    }
  }else{
    return redirect('pengadaan');
  }
}

public function penugasan($serial = ''){
  $data['title'] = 'Penugasan Pengadaan';
  $data['menu'] = 'Pengadaan';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        //validate error free
        //get data
        $pb = $this->pengadaanModel->getBySerial($_POST['serial_number']);
        $barang = $this->pengadaanModel->getBahanBySerial($_POST['serial_number']);

        $array = (explode(",",$pb->nip_petugas_pengadaan));
        $jumlah_petugas = count($array);
        $jumlah_barang = count($barang);
        
        if(empty($_POST['penugasan']) || $jumlah_petugas != $jumlah_barang){
            //load view with error
            setFlash('Semua petugas wajib diisi','danger');
            return redirect('pengadaan/penugasan/'.$_POST['serial_number']);
        }else{
            if($pb && $pb->disposisi && $pb->nip_penanggung == $_SESSION['nip']){
                if($this->pengadaanModel->tambahanPenugasan($_POST)){

                    // redirect after success validate
                    setFlash('Penugasan pengadaan berhasil','success');
                    return redirect('pengadaan');
                }else{
                    setFlash('Penugasan pengadaan gagal','danger');
                    return redirect('pengadaan');
                }
            }else{
                setFlash('Penugasan pengadaan gagal','danger');
                return redirect('pengadaan');
            }
        }
    }else{
        $png = $this->pengadaanModel->getBySerial($serial);
        if($png && $png->disposisi && $png->nip_penanggung == $_SESSION['nip']){
            $data['serial'] = $serial;
            $data['pengadaan'] = $png;

            $data['bahan'] = $this->pengadaanModel->getBahanBySerial($serial);
            $data['timpengadaan'] = $this->pegawaiModel->get();
            
            $this->view('pengadaan/penugasan', $data);
        }else{
            return redirect('pengadaan');
        }
    }
  }

  public function accPetugas(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      foreach($_POST['nip_petugas'] as $value) if(empty($value)) $_POST['nip_petugas'] = '';
      if (empty($_POST['nip_petugas']) && empty($_POST['deadline'])) {
        setFlash('Tolong pilih petugas', 'danger');
        return redirect('pengadaan/penugasan/'.$_POST['seri_pengadaan']);
      }  
      if ($this->pengadaanModel->tambahanPetugas($_POST) &  $this->pengadaanModel->tambahanPetugasPengadaan($_POST)) {
          setFlash('Petugas ditambahkan.', 'success');
          return redirect('pengadaan/penugasan/'.$_POST['seri_pengadaan']);
      }else{
          setFlash('Petugas ditambahkan.', 'success');
          return redirect('pengadaan/penugasan/'.$_POST['seri_pengadaan']);
      }
    }else{
      return redirect('pengadaan');
    }
  }
  
  public function konfirmasiPenugasan($serial = ''){
    $data['title'] = 'Konfirmasi Pengadaan';
    $data['menu'] = 'Pengadaan';

    $pb = $this->pengadaanModel->getByPetugas($serial);
    if($pb){
        $data['bahan'] = $pb;
        $data['timpengadaan'] = $this->pegawaiModel->get();
        
        $this->view('pengadaan/konfirmasiPenugasan', $data);
    }else{
        return redirect('pengadaan');
    }
  }

  public function hasil($serial_number = ''){
    $data['title'] = 'Konfirmasi hasil Pengadaan';
    $data['menu'] = 'Pengadaan';

    $pb = $this->pengadaanModel->getBySerial($serial_number);

    if($pb || $pb->nip_pemohon == $_SESSION['nip']){
      $data['pengadaan'] = $pb;
      $data['bahan'] = $this->pengadaanModel->getBahanBySerial($serial_number);
      $data['timpengadaan'] = $this->pegawaiModel->get();

      $this->view('pengadaan/hasil', $data);
    }else{
      return redirect('pengadaan');
    }
  }

  public function informasi($serial_number = ''){
    $data = [
      'title' => 'Informasi Pengadaan',
      'menu' => 'Pengadaan',
    ];

    $data['pengadaan'] = $this->pengadaanModel->getBySerial($serial_number);
    $data['atasan'] = $this->pengadaanModel->getBySerialAtasan($serial_number);
    $data['penanggung'] = $this->pengadaanModel->getBySerialPenanggung($serial_number);
    $data['bahan'] = $this->pengadaanModel->getBahanBySerial($serial_number);

    $this->view('pengadaan/informasi', $data);
  }

  public function detail_rekap($serial_number = ''){
    if(Middleware::jabatan('ppk') || Middleware::jabatan('kasubag_tu') || Middleware::jabatan('kepala_balai') || Middleware::admin('perbaikan') || $_SESSION['role'] == 'ADMIN'){
      $data = [
        'title' => 'Detail Rekap Pengadaan',
        'menu' => 'Pengadaan',
      ];

      $pb = $this->pengadaanModel->getBySerial($serial_number);

      if($pb && $pb->hasil){
        $data['pengadaan'] = $pb;
        $data['atasan'] = $this->pengadaanModel->getBySerialAtasan($serial_number);
        $data['penanggung'] = $this->pengadaanModel->getBySerialPenanggung($serial_number);
        $data['bahan'] = $this->pengadaanModel->getBahanBySerial($serial_number);
      
        $this->view('pengadaan/detail_rekap', $data);
      }else{
        return redirect('pengadaan');
      }
    }else{
      return redirect('pengadaan');
    }
  }

  public function add(){
    $data['title'] = 'Buat Permohonan Pengadaan';
    $data['menu'] = 'Pengadaan';
    //load data
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //validate error free
        if(empty($_POST['nip_pemohon'])||empty($_POST['nip_atasan'])){
            //load view with error
            setFlash('Form input tidak boleh kosong','danger');
            return redirect('pengadaan/add');
        }else{
            if($this->pengadaanModel->add($_POST)){
                $this->tBahanModel->deleteAll();
                // get atasan data
                $ats = $this->pegawaiModel->getByNIP($_POST['nip_atasan']);
                // send notification to whatsapp atasan
                $data['no_telp'] = $ats->no_telp;
                $data['isi_pesan'] = "[BRSBB:SIP-Pengadaan] Harap Ditindaklanjuti";
                notifWA($data);

                //redirect and set notif flash
                setFlash('Berhasil membuat pengusulan pengadaan.','success');
                return redirect('pengadaan');
            }else{
                setFlash('Gagal membuat pengusulan pengadaan.','danger');
                return redirect('pengadaan');
            }
        }
    }else{
      $data['tbahan'] = $this->tBahanModel->getAll();
      $data['pemohon'] = $this->pegawaiModel->get();
  
      // Atasan Langsung Koordinator,Kasubag TU dan Kepala Balai
      $kepalabalai = $this->jabatanModel->getPegawai('kepala_balai');
      $kasubag_tu = $this->jabatanModel->getPegawai('kasubag_tu');
      $koordinator = $this->jabatanModel->getPegawai('koordinator');
      $data['atasan'] = array_merge($kepalabalai,$kasubag_tu,$koordinator);
  
      $this->view('pengadaan/add', $data);
    }
  }

  public function addbahan(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      if (empty($_POST['nbahan']) || empty($_POST['jumlah']) || empty($_POST['keterangan'])) {
        setFlash('Input field is required', 'danger');
        return redirect('pengadaan/add');
      }
      if ($this->tBahanModel->add($_POST)) {
          setFlash('Success added Pengadaan.', 'success');
          return redirect('pengadaan/add');
      }else{
          setFlash('Failed to add Pengadaan', 'danger');
          return redirect('pengadaan/add');
      }
    }else{
      return redirect('pengadaan');
    }
  }

  public function deleteBahan($id = ''){
    if ($this->tBahanModel->delete($id)) {
        setFlash('Pengadaan deleted successfully', 'success');
        return redirect('pengadaan/add');
    }else{
        setFlash('Failed to delete Pengadaan', 'danger');
          return redirect('pengadaan/add');
      }
  }

  public function deleteSemuaBahan(){
    if ($this->tBahanModel->deleteAll()) {
        setFlash('Pengadaan deleted successfully', 'success');
        return redirect('pengadaan/add');
    }else{
        setFlash('Failed to delete Pengadaan', 'danger');
        return redirect('pengadaan/add');
    }
  }

  public function accKonfirmasiDiterima(){ 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      if ($this->pengadaanModel->konfirmasiDiterima($_POST)) {
          setFlash('Tugas diterima', 'success');
          return redirect('pengadaan/konfirmasiPenugasan/'.$_POST['seri_pengadaan']);
      }else{
          setFlash('Konfirmasi gagal', 'danger');
          return redirect('pengadaan/konfirmasiPenugasan/'.$_POST['seri_pengadaan']);
      }
    }else{
      return redirect('pengadaan');
    }
  }

  public function accKonfirmasiSelesai(){ 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      if ($this->pengadaanModel->konfirmasiSelesai($_POST)) {
          setFlash('Pengadaan selesai dikerjakan', 'success');
          return redirect('pengadaan/konfirmasiPenugasan/'.$_POST['seri_pengadaan']);
      }else{
          setFlash('Konfirmasi gagal', 'danger');
          return redirect('pengadaan/konfirmasiPenugasan/'.$_POST['seri_pengadaan']);
      }
    }else{
      return redirect('pengadaan');
    }
  }

  public function accKonfirmasiHasil(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      if ($this->pengadaanModel->tambahanHasil($_POST)) {
          setFlash('Konfirmasi diterima', 'success');
          return redirect('pengadaan/hasil/'.$_POST['seri_pengadaan']);
      }else{
          setFlash('konfirmasi gagal', 'danger');
          return redirect('pengadaan/hasil/'.$_POST['seri_pengadaan']);
      }
    }else{
      return redirect('pengadaan');
    }
  }

  public function accHasil(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $bahan = $this->pengadaanModel->getBahanBySerial($_POST['serial_number']);
      $invalid = 0;
      foreach ($bahan as $k) {
        if(!$k->hasil){
          $invalid++;
        }
      }

      if($invalid > 0){
        setFlash('Pastikan semua bahan telah selesai', 'danger');
        return redirect('pengadaan/hasil/'.$_POST['serial_number']);
      }else{
        if($this->pengadaanModel->tambahanHasilAkhir($_POST)) {
          setFlash('Konfirmasi diterima', 'success');
          return redirect('pengadaan');
        }else{
          setFlash('konfirmasi gagal', 'danger');
          return redirect('pengadaan/hasil/'.$_POST['seri_pengadaan']);
        }
      }
    }else{
      return redirect('pengadaan');
    }
  }
   
}

?>