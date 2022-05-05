<?php 
class IjinLembur extends Controller{

    public function __construct()
    {
        if(!isLoggedIn()){
            return redirect('auth/login');
        }
        //new model instance
        $this->ijinLemburModel = $this->model('IjinLemburModel');
        $this->jabatanModel = $this->model('JabatanModel');
        $this->adminModel = $this->model('AdminModel');
        $this->pegawaiModel = $this->model('PegawaiModel');
    }

    public function index(){
        $ijin_lembur = $this->ijinLemburModel->getByUserLogin();
        $index = 0;
        $pemohon = [];
        foreach ($ijin_lembur as $k) {
            $pemohon[$index] = $this->pegawaiModel->getAllNIP($k->pemohon);
            $index++;
        }
        $data = [
            'title' => 'Input Ijin Lembur',
            'menu' => 'Ijin Lembur',
            'ijin_lembur' => $ijin_lembur,
            'pemohon' => $pemohon
        ];

        $this->view('ijin_lembur/index', $data);
    }

    public function listvalidasi(){
        if(Middleware::jabatan('kasubag_tu') || Middleware::jabatan('koordinator') || Middleware::jabatan('kepala_balai') || Middleware::admin('kepegawaian')){
            if(Middleware::jabatan('kepala_balai') || Middleware::admin('kepegawaian')){
                $ijin_lembur = $this->ijinLemburModel->getAll();
            }else{
                $ijin_lembur = $this->ijinLemburModel->getByAtasan();
            }
            $index = 0;
            $pemohon = [];
            foreach ($ijin_lembur as $k) {
                $pemohon[$index] = $this->pegawaiModel->getAllNIP($k->pemohon);
                $index++;
            }
            $data = [
                'title' => 'Daftar Validasi Ijin Lembur',
                'menu' => 'Ijin Lembur',
                'ijin_lembur' => $ijin_lembur,
                'pemohon' => $pemohon
            ];

            $this->view('ijin_lembur/list_validasi', $data);
        }else{
            return redirect('ijin_lembur');
        }
    }

    public function rekap(){
        if($_SESSION['role'] == 'ADMIN' || Middleware::jabatan('kasubag_tu') || Middleware::admin('kepegawaian')){
            if(ISSET($_POST['search'])){
                $ijin_keluar = $this->ijinKeluarModel->getAllByDate($_POST['date1'],$_POST['date2']);
                $pejabatvalidasi = $this->ijinKeluarModel->getAllPejabatValidasiByDate($_POST['date1'],$_POST['date2']);
            }else{
                $ijin_keluar = $this->ijinKeluarModel->get();
                $pejabatvalidasi = $this->ijinKeluarModel->getAllPejabatValidasi();
            }

            $data = [
                'title' => 'Rekap Ijin Keluar',
                'menu' => 'Ijin Keluar',
                'ijin_keluar' => $ijin_keluar,
                'pejabatvalidasi' => $pejabatvalidasi
            ];

            $this->view('ijin_keluar/rekap', $data);
        }else{
            return redirect('ijinkeluar');
        }
    }

    public function cetak($id = ''){
        $ijn = $this->ijinLemburModel->getById($id);
        if($ijn && $ijn->diterbitkan && Middleware::admin('kepegawaian')){
            $pemohon = $this->pegawaiModel->getAllNIP($ijn->pemohon);
            $data = [
                'ijinlembur' => $ijn,
                'pemohon' => $pemohon
            ];
            $data['kepala_balai'] = $this->jabatanModel->getOnlyPegawai('kepala_balai');
            
            $nomor = explode('/',$ijn->nomor_surat);
            $data['sign'] = $nomor[0].'/'.$ijn->tanggal_ijin.'/'.$data['kepala_balai']->nama;

            $data['ijinlembur']->tanggal_ijin = dateID($data['ijinlembur']->tanggal_ijin);
            $data['hari'] = dayID($data['ijinlembur']->tanggal_ijin);
            
            $this->view('ijin_lembur/cetak', $data);
        }else{
        return redirect('ijinlembur');
        }
    }

    //add new jp
    public function add(){
        $data['title'] = 'Form Input Ijin Lembur';
        $data['menu'] = 'Ijin Lembur';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //validate error free
            foreach($_POST['pemohon'] as $value) if(empty($value)) $_POST['pemohon'] = '';
            if(empty($_POST['pemohon']) || empty($_POST['keperluan']) || empty($_POST['tanggal_ijin']) || empty($_POST['pejabat_validasi']) || empty($_POST['jam_mulai']) || empty($_POST['jam_berakhir'])){
                //load view with error
                setFlash('Form input tidak boleh kosong','danger');
                return redirect('ijinlembur/add');
            }else{
                if($this->ijinLemburModel->add($_POST)){
                    // get atasan data
                    $ats = $this->pegawaiModel->getByNIP($_POST['pejabat_validasi']);
                    // send notification to whatsapp atasan
                    $data['no_telp'] = $ats->no_telp;
                    $data['isi_pesan'] = "[BRSBB:SIP-IjinLembur] Harap Ditindaklanjuti";
                    notifWA($data);

                    //redirect and set notif flash
                    setFlash('Berhasil membuat permohonan Ijin Lembur.','success');
                    return redirect('ijinlembur');
                }else{
                    setFlash('Gagal membuat permohonan Ijin Lembur.','danger');
                    return redirect('ijinlembur');
                }
            }
        }else{
            // Atasan Langsung Koordinator,Kasubag TU dan Kepala Balai
            $kepalabalai = $this->jabatanModel->getPegawai('kepala_balai');
            $kasubag_tu = $this->jabatanModel->getPegawai('kasubag_tu');
            $koordinator = $this->jabatanModel->getPegawai('koordinator');

            //data 
            $data['pemohon'] = $this->pegawaiModel->get();
            $data['atasan'] = array_merge($kepalabalai,$kasubag_tu,$koordinator);

            //render view
            $this->view('ijin_lembur/add', $data);
        }
    }

     // validasi atasan controller
    public function validasi_atasan($id = ''){
        $data['title'] = 'Validasi Atasan Ijin Lembur';
        $data['menu'] = 'Ijin Lembur';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            //validate error free
            if(empty($_POST['validasi'])){
                //load view with error
                setFlash('Form input tidak boleh kosong','danger');
                return redirect('ijinlembur/validasi_atasan/'.$_POST['id']);
            }else{
                $ijk = $this->ijinLemburModel->getById($_POST['id']);
                if($ijk && !$ijk->validasi_atasan_langsung && $ijk->pejabat_validasi == $_SESSION['nip']){
                    if($this->ijinLemburModel->validasiAtasan($_POST)){
                        if($_POST['validasi'] == 'Diterima'){
                            //get atasan data
                            $kb = $this->jabatanModel->getPegawai('kepala_balai');
                            // send notification to whatsapp atasan
                            $data['isi_pesan'] = "[BRSBB:SIP-IjinLembur] Harap Ditindaklanjuti";
                            foreach ($kb as $k) {
                                $data['no_telp'] = $k->no_telp;
                                notifWA($data);
                            }
                        }
                        
                        // redirect after success validate
                        setFlash('Berhasil validasi Ijin Lembur.','success');
                        return redirect('ijinlembur/listvalidasi');
                    }else{
                        setFlash('Gagal validasi Ijin Lembur','danger');
                        return redirect('ijinlembur/listvalidasi');
                    }
                }else{
                    setFlash('Gagal validasi Ijin Lembur','danger');
                    return redirect('ijinlembur/listvalidasi');
                }
            }
        }else{
            $ijin_lembur = $this->ijinLemburModel->getById($id);

            if($ijin_lembur && !$ijin_lembur->validasi_atasan_langsung && $ijin_lembur->pejabat_validasi == $_SESSION['nip']){
                $data['id'] = $id;
                $data['ijin_lembur'] = $ijin_lembur;
                $data['pemohon'] = $this->pegawaiModel->getAllNIP($ijin_lembur->pemohon);
                
                $this->view('ijin_lembur/validasi_atasan', $data);
            }else{
                return redirect('ijinlembur/listvalidasi');
            }
        }
    }

    // validasi kepala balai controller
    public function validasi_kb($id = ''){
        $data['title'] = 'Validasi Kepala Balai Ijin Lembur';
        $data['menu'] = 'Ijin Lembur';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            //validate error free
            if(empty($_POST['validasi'])){
                //load view with error
                setFlash('Form input tidak boleh kosong','danger');
                return redirect('ijinlembur/validasi_kb/'.$_POST['id']);
            }else{
                $ijk = $this->ijinLemburModel->getById($_POST['id']);
                if($ijk && $ijk->validasi_atasan_langsung && !$ijk->validasi_kepala_balai && Middleware::jabatan('kepala_balai')){
                    if($this->ijinLemburModel->validasiKB($_POST)){
                        if($_POST['validasi'] == 'Diterima'){
                            //get atasan data
                            $kb = $this->adminModel->getPegawai('kepegawaian');
                            // send notification to whatsapp atasan
                            $data['isi_pesan'] = "[BRSBB:SIP-IjinLembur] Harap Ditindaklanjuti";
                            foreach ($kb as $k) {
                                $data['no_telp'] = $k->no_telp;
                                notifWA($data);
                            }
                        }

                        // redirect after success validate
                        setFlash('Berhasil validasi Ijin Lembur.','success');
                        return redirect('ijinlembur/listvalidasi');
                    }else{
                        setFlash('Gagal validasi Ijin Lembur','danger');
                        return redirect('ijinlembur/listvalidasi');
                    }
                }else{
                    setFlash('Gagal validasi Ijin Lembur','danger');
                    return redirect('ijinlembur/listvalidasi');
                }
            }
        }else{
            $ijin_lembur = $this->ijinLemburModel->getById($id);

            if($ijin_lembur && $ijin_lembur->validasi_atasan_langsung && !$ijin_lembur->validasi_kepala_balai && Middleware::jabatan('kepala_balai')){
                $data['id'] = $id;
                $data['ijin_lembur'] = $ijin_lembur;
                $data['pemohon'] = $this->pegawaiModel->getAllNIP($ijin_lembur->pemohon);
                
                $this->view('ijin_lembur/validasi_kb', $data);
            }else{
                return redirect('ijinlembur/listvalidasi');
            }
        }
    }

    // terbitkan surat ijin controller
    public function terbitkan($id = ''){
        $data['title'] = 'Terbitkan Ijin Lembur';
        $data['menu'] = 'Ijin Lembur';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            //validate error free
            foreach($_POST['nomor_surat'] as $value) if(empty($value)) $_POST['nomor_surat'] = '';
            if(empty($_POST['nomor_surat'])){
                //load view with error
                setFlash('Form input tidak boleh kosong','danger');
                return redirect('ijinlembur/terbitkan/'.$_POST['id']);
            }else{
                $ijn = $this->ijinLemburModel->getById($_POST['id']);
                if($ijn && $ijn->validasi_kepala_balai && !$ijn->nomor_surat && Middleware::admin('kepegawaian')){
                    if($this->ijinLemburModel->terbitkan($_POST)){
                        //get atasan data
                        $ats = $this->pegawaiModel->getByNIP($_POST['penginput']);
                        // send notification to whatsapp atasan
                        $data['no_telp'] = $ats->no_telp;
                        $data['isi_pesan'] = "[BRSBB:SIP-IjinLembur] Surat Izin Telah Diterbitkan";
                        notifWA($data);

                        // redirect after success validate
                        setFlash('Berhasil terbitkan Ijin Lembur.','success');
                        return redirect('ijinlembur/listvalidasi');
                    }else{
                        setFlash('Gagal terbitkan Ijin Lembur','danger');
                        return redirect('ijinlembur/listvalidasi');
                    }
                }else{
                    setFlash('Gagal terbitkan Ijin Lembur','danger');
                    return redirect('ijinlembur/listvalidasi');
                }
            }
        }else{
            $ijn = $this->ijinLemburModel->getById($id);

            if($ijn && $ijn->validasi_kepala_balai && !$ijn->nomor_surat && Middleware::admin('kepegawaian')){
                $data['id'] = $id;
                $data['ijin_lembur'] = $ijn;
                $data['pemohon'] = $this->pegawaiModel->getAllNIP($ijn->pemohon);
                
                $this->view('ijin_lembur/terbitkan', $data);
            }else{
                return redirect('ijinlembur/listvalidasi');
            }
        }
    }

}                            
                        