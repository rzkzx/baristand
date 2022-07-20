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
        if(Middleware::jabatan('kasubag_tu') || Middleware::jabatan('koordinator') || Middleware::admin('kendi')){
            $kendiModel = $this->kendiModel->getPeminjaman();
        }else{
            $kendiModel = $this->kendiModel->getPeminjamanByNIP();
        }
        $data = [
            'title' => 'Peminjaman Kendaraan',
            'menu' => 'Kendi',
            'peminjaman' => $kendiModel
        ];

        $index=1;
        foreach ($kendiModel as $k) {
            $data['kend'][$index] = $this->kendiModel->getKendaraanById($k->id_kendaraan);
            $index++;
        }
        
        $this->view('kendi/peminjaman/index', $data);
    }

    public function addpeminjaman(){
        $data['title'] = 'Buat Permohonan Peminjaman Kendaraan';
        $data['menu'] = 'Kendi';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //validate error free
            if(empty($_POST['kendaraan']) || empty($_POST['keperluan']) || empty($_POST['jenis_peminjaman']) || empty($_POST['pemohon']) || empty($_POST['atasan'])){
                //load view with error
                setFlash('Form input tidak boleh kosong','danger');
                $this->view('kendi/peminjaman/add', $data);
            }else{
                if($this->kendiModel->addPeminjaman($_POST)){
                    // get atasan data
                    $ats = $this->pegawaiModel->getByNIP($_POST['atasan']);
                    // send notification to whatsapp atasan
                    $data['no_telp'] = $ats->no_telp;
                    $data['isi_pesan'] = "[BSPJI:SIP-Kendi] Mohon Validasi";
                    notifWA($data);

                    setFlash('Permohonan Peminjaman berhasil ditambahkan.','success');
                    return redirect('kendi');
                }else{
                    die('something went wrong');
                }
            }
        }else{
            $data['kend'] = $this->kendiModel->getKendaraanNotPinjam();
            $data['pemohon'] = $this->pegawaiModel->get();

            // Atasan Langsung Koordinator,Kasubag TU dan Kepala Balai
            $kepalabalai = $this->jabatanModel->getPegawai('kepala_balai');
            $kasubag_tu = $this->jabatanModel->getPegawai('kasubag_tu');
            $koordinator = $this->jabatanModel->getPegawai('koordinator');
            $data['atasan'] = array_merge($kepalabalai,$kasubag_tu,$koordinator);

            $this->view('kendi/peminjaman/add', $data);
        }
    }

    public function validasial($id = ''){
        $data['title'] = 'Peminjaman Kendaraan - Validasi Atasan Langsung';
        $data['menu'] = 'Kendi';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //validate error free
            if(empty($_POST['validasi'])){
                //load view with error
                setFlash('Form input tidak boleh kosong','danger');
                $this->view('kendi/peminjaman/validasi_al', $data);
            }else{
                if($this->kendiModel->validasiAtasan($_POST)){
                    if($_POST['validasi'] == 'Diterima'){
                        //get atasan data
                        $kb = $this->jabatanModel->getPegawai('kasubag_tu');
                        // send notification to whatsapp atasan
                        $data['isi_pesan'] = "[BSPJI:SIP-Kendi] Mohon Persetujuan";
                        foreach ($kb as $k) {
                            $data['no_telp'] = $k->no_telp;
                            notifWA($data);
                        }
                    }else{
                        $ats = $this->pegawaiModel->getByNIP($_POST['pemohon']);
                        // send notification to whatsapp atasan
                        $data['no_telp'] = $ats->no_telp;
                        $data['isi_pesan'] = "[BSPJI:SIP-Kendi] Mohon Maaf, Kendaraan tidak dapat dipergunakan";
                        notifWA($data);
                    }

                    setFlash('Peminjaman Kendaraan berhasil divalidasi.','success');
                    return redirect('kendi');
                }else{
                    die('something went wrong');
                }
            }
        }else{
            $pmj = $this->kendiModel->getPeminjamanById($id);
            if($pmj && $pmj->atasan == $_SESSION['nip'] && !$pmj->validasi_atasan){
                $data['id'] = $id;
                $data['peminjaman'] = $pmj;
                $data['kend'] = $this->kendiModel->getKendaraanById($pmj->id_kendaraan);
                
                $this->view('kendi/peminjaman/validasi_al', $data);
            }else{
                return redirect('kendi');
            }
        }
    }

    public function validasitu($id = ''){
        $data['title'] = 'Peminjaman Kendaraan - Validasi Kasubag TU';
        $data['menu'] = 'Kendi';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //validate error free
            if(empty($_POST['validasi'])){
                //load view with error
                setFlash('Form input tidak boleh kosong','danger');
                $this->view('kendi/peminjaman/validasi_tu', $data);
            }else{
                if($this->kendiModel->validasiKasubagTU($_POST)){
                    if($_POST['validasi'] == 'Diterima'){
                        //pemohon notif wa
                        $ats = $this->pegawaiModel->getByNIP($_POST['pemohon']);
                        $data['no_telp'] = $ats->no_telp;
                        $data['isi_pesan'] = "[BSPJI:SIP-Kendi] Kendaraan dapat dipergunakan";
                        notifWA($data);

                        // admin kendi notif wa
                        $kb = $this->adminModel->getPegawai('kendi');
                        $data['isi_pesan'] = "[BSPJI:SIP-Kendi] Kendaraan harap dipersiapkan";
                        foreach ($kb as $k) {
                            $data['no_telp'] = $k->no_telp;
                            notifWA($data);
                        }
                    }else{
                        $ats = $this->pegawaiModel->getByNIP($_POST['pemohon']);
                        // send notification to whatsapp atasan
                        $data['no_telp'] = $ats->no_telp;
                        $data['isi_pesan'] = "[BSPJI:SIP-Kendi] Mohon Maaf, Kendaraan tidak dapat dipergunakan";
                        notifWA($data);
                    }

                    setFlash('Peminjaman Kendaraan berhasil divalidasi.','success');
                    return redirect('kendi');
                }else{
                    die('something went wrong');
                }
            }
        }else{
            $pmj = $this->kendiModel->getPeminjamanById($id);
            if($pmj && Middleware::jabatan('kasubag_tu') && $pmj->validasi_atasan == 'Diterima' && !$pmj->validasi_kasubagtu){
                $data['id'] = $id;
                $data['peminjaman'] = $pmj;
                $data['kend'] = $this->kendiModel->getKendaraanById($pmj->id_kendaraan);
                
                $this->view('kendi/peminjaman/validasi_tu', $data);
            }else{
                return redirect('kendi');
            }
        }
    }

    public function serahkankendaraan($id = ''){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($this->kendiModel->serahkan($id)){
                setFlash('Kendaraan Berhasil diserahkan Kepada Pegawai','success');
            }else{
                die('something went wrong');
            }
        }else{
            return redirect('kendi');
        }
    }

    public function kendaraankembali($id = ''){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $pmj = $this->kendiModel->getPeminjamanById($id);
            $data['id'] = $id;
            $data['id_kendaraan'] = $pmj->id_kendaraan;
            if($this->kendiModel->kembalikan($data)){
                setFlash('Kendaraan telah dikembalikan dan peminjaman selesai','success');
            }else{
                die('something went wrong');
            }
        }else{
            return redirect('kendi');
        }
    }

    // Pengunaan Kendaraan Controller
    public function penggunaan(){
        $kendiModel = $this->kendiModel->getPeminjamanPenggunaan();
        $data = [
            'title' => 'Penggunaan Kendaraan',
            'menu' => 'Kendi',
            'peminjaman' => $kendiModel
        ];

        $index=1;
        foreach ($kendiModel as $k) {
            $data['kend'][$index] = $this->kendiModel->getKendaraanById($k->id_kendaraan);
            $index++;
        }
        
        $this->view('kendi/penggunaan/index', $data);
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