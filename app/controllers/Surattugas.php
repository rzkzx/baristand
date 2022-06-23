<?php
    class SuratTugas extends Controller {
        public function __construct()
        {
            if(!isLoggedIn()){
                return redirect('auth/login');
            }
            //new model instance
            $this->suratTugasModel = $this->model('SuratTugasModel');

            $this->jabatanModel = $this->model('JabatanModel');
            $this->adminModel = $this->model('AdminModel');
            $this->pegawaiModel = $this->model('PegawaiModel');
        }

        public function index(){
            $data = [
                'title' => 'Daftar Pengajuan Surat Tugas',
                'menu' => 'Surat Tugas'
            ];

            if($_SESSION['role'] == 'ADMIN' || Middleware::admin('surat_tugas') || Middleware::admin('sekretariat') || Middleware::jabatan('kasubag_tu') || Middleware::jabatan('koordinator') || Middleware::jabatan('kepala_balai')){
                $data['laporan'] = $this->suratTugasModel->getAll();
            }else{
                $data['laporan'] = $this->suratTugasModel->getByNIP();
            }

            $this->view('surat_tugas/index', $data);
        }

        public function detail($id = ''){
            $laporan = $this->suratTugasModel->getById($id);

            if($laporan){
                //data send to view
                if($laporan->pemohon == $_SESSION['nip'] || $_SESSION['role'] == 'ADMIN' || Middleware::admin('surat_tugas') || Middleware::admin('sekretariat') || Middleware::jabatan('kasubag_tu') || Middleware::jabatan('koordinator') || Middleware::jabatan('kepala_balai')){
                    $data = [
                        'title' => 'Detail Laporan Permohonan Surat Tugas',
                        'menu' => 'Surat Tugas',
                        'laporan' => $laporan
                    ];
                    $data['pengikut'] = $this->pegawaiModel->getAllNIP($data['laporan']->pengikut);
                    $data['ditugaskan'] = $this->suratTugasModel->getTugasById($id);
                    $data['ppk'] = $this->suratTugasModel->getPPKById($id);
    
                    $this->view('surat_tugas/detail', $data);
                }else{
                    return redirect('surattugas');
                }
            }else{
                return redirect('surattugas');
            }
        }

        public function add(){
            $data['title'] = 'Buat Laporan Pengajuan Surat Tugas';
            $data['menu'] = 'Surat Tugas';
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
                //validate error free
                foreach($_POST['pengikut'] as $value) if(empty($value)) $_POST['pengikut'] = '';
                if(empty($_POST['pengikut']) || empty($_POST['nip_ditugaskan']) || empty($_POST['pengusul']) || empty($_POST['tujuan_tugas']) || empty($_POST['keperluan_tugas'])){
                    //load view with error
                    setFlash('Form input tidak boleh kosong','danger');
                    return redirect('surattugas/add');
                }else{
                    if($this->suratTugasModel->add($_POST,$_FILES['dasar_surat'])){
                        // get atasan data
                        $ats = $this->pegawaiModel->getByNIP($_POST['pengusul']);
                        // send notification to whatsapp atasan
                        $data['no_telp'] = $ats->no_telp;
                        $data['isi_pesan'] = "[BRSBB:SIP-SuratTugas] Harap Ditindaklanjuti";
                        notifWA($data);
    
                        //redirect and set notif flash
                        setFlash('Berhasil membuat Laporan Permohonan Surat Tugas','success');
                        return redirect('surattugas');
                    }else{
                        setFlash('Gagal membuat Laporan Permohonan Surat Tugas','danger');
                        return redirect('surattugas');
                    }
                }
            }else{
                // Atasan Langsung Koordinator,Kasubag TU dan Kepala Balai
                $kepalabalai = $this->jabatanModel->getPegawai('kepala_balai');
                $kasubag_tu = $this->jabatanModel->getPegawai('kasubag_tu');
                $koordinator = $this->jabatanModel->getPegawai('koordinator');
                $ppk = $this->jabatanModel->getPegawai('ppk');
                $pegawai = $this->pegawaiModel->get();
    
                //data 
                $data['pemohon'] = $this->pegawaiModel->get();
                $data['pengusul'] = array_merge($kepalabalai,$kasubag_tu,$koordinator);
                $data['pengikut'] = $pegawai;
                $data['ppk'] = $ppk;
    
                //render view
                $this->view('surat_tugas/add', $data);
            }
        }

        
        public function validasial($id = ''){
            $data = [
                'title' => 'Surat Tugas - Validasi Atasan Langsung',
                'menu' => 'Surat Tugas',
            ];

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
                //validate error free
                if(empty($_POST['validasi'])){
                    //load view with error
                    setFlash('Form input tidak boleh kosong','danger');
                    return redirect('surattugas/validasial/'.$_POST['id']);
                }else{
                    $st = $this->suratTugasModel->getById($_POST['id']);
                    if($st && !$st->validasi_atasan_langsung && $st->pengusul == $_SESSION['nip']){
                        if($this->suratTugasModel->validasiAtasan($_POST)){
                            if($_POST['validasi'] == 'Disetujui'){
                                //get atasan data
                                $kb = $this->pegawaiModel->getByNIP($_POST['nip_ppk']);
                                // send notification to whatsapp atasan
                                $data['isi_pesan'] = "[BRSBB:SIP-SuratTugas] Harap Ditindaklanjuti";
                                $data['no_telp'] = $kb->no_telp;
                                notifWA($data);
                            }
                            
                            // redirect after success validate
                            setFlash('Berhasil memvalidasi permohonan surat tugas.','success');
                            return redirect('surattugas');
                        }else{
                            setFlash('Gagal memvalidasi permohonan surat tugas.','danger');
                            return redirect('surattugas');
                        }
                    }else{
                        setFlash('Gagal memvalidasi permohonan surat tugas.','danger');
                        return redirect('surattugas');
                    }
                }
            }else{
                $st = $this->suratTugasModel->getById($id);
                if($st && !$st->validasi_atasan_langsung && $st->pengusul == $_SESSION['nip']){
                    //load data
                    $data['laporan'] = $st;
                    $data['pengikut'] = $this->pegawaiModel->getAllNIP($st->pengikut);
                    $data['ditugaskan'] = $this->suratTugasModel->getTugasById($id);
                    $data['ppk'] = $this->suratTugasModel->getPPKById($id);
        
                    $this->view('surat_tugas/validasial', $data);
                }else{
                    return redirect('surattugas');
                }
            }
        }

         
        public function validasippk($id = ''){
            $data = [
                'title' => 'Surat Tugas - Validasi PPK',
                'menu' => 'Surat Tugas',
            ];

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
                //validate error free
                if(empty($_POST['validasi'])){
                    //load view with error
                    setFlash('Form input tidak boleh kosong','danger');
                    return redirect('surattugas/validasippk/'.$_POST['id']);
                }else{
                    $st = $this->suratTugasModel->getById($_POST['id']);
                    if($st && $st->validasi_atasan_langsung && $st->nip_ppk == $_SESSION['nip']){
                        if($this->suratTugasModel->validasiPPK($_POST)){
                            if($_POST['validasi'] == 'Disetujui'){
                                //get atasan data
                                $kb = $this->jabatanModel->getPegawai('kepala_balai');
                                // send notification to whatsapp atasan
                                $data['isi_pesan'] = "[BRSBB:SIP-SuratTugas] Harap Ditindaklanjuti";
                                foreach ($kb as $k) {
                                    $data['no_telp'] = $k->no_telp;
                                    notifWA($data);
                                }
                            }
                            
                            // redirect after success validate
                            setFlash('Berhasil memvalidasi permohonan surat tugas.','success');
                            return redirect('surattugas');
                        }else{
                            setFlash('Gagal memvalidasi permohonan surat tugas.','danger');
                            return redirect('surattugas');
                        }
                    }else{
                        setFlash('Gagal memvalidasi permohonan surat tugas.','danger');
                        return redirect('surattugas');
                    }
                }
            }else{
                $st = $this->suratTugasModel->getById($id);
                if($st && $st->validasi_atasan_langsung && $st->nip_ppk == $_SESSION['nip']){
                    //load data
                    $data['laporan'] = $st;
                    $data['pengikut'] = $this->pegawaiModel->getAllNIP($st->pengikut);
                    $data['ditugaskan'] = $this->suratTugasModel->getTugasById($id);
                    $data['ppk'] = $this->suratTugasModel->getPPKById($id);

                    $this->view('surat_tugas/validasippk', $data);
                }else{
                    return redirect('surattugas');
                }
            }
        }
        
         
        public function validasikb($id = ''){
            $data = [
                'title' => 'Surat Tugas - Validasi Kepala Balai',
                'menu' => 'Surat Tugas',
            ];

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //validate error free
                if(empty($_POST['validasi'])){
                    //load view with error
                    setFlash('Form input tidak boleh kosong','danger');
                    return redirect('surattugas/validasikb/'.$_POST['id']);
                }else{
                    $st = $this->suratTugasModel->getById($_POST['id']);
                    if($st && $st->validasi_ppk == 'Disetujui' && !$st->validasi_kepala_balai && Middleware::jabatan('kepala_balai')){
                        if($this->suratTugasModel->validasiKB($_POST)){
                            if($_POST['validasi'] == 'Disetujui'){
                                //get atasan data
                                $kb = $this->adminModel->getPegawai('surat_tugas');
                                // send notification to whatsapp atasan
                                $data['isi_pesan'] = "[BRSBB:SIP-SuratTugas] Harap Ditindaklanjuti";
                                foreach ($kb as $k) {
                                    $data['no_telp'] = $k->no_telp;
                                    notifWA($data);
                                }
                            }
                            
                            // redirect after success validate
                            setFlash('Berhasil memvalidasi permohonan surat tugas.','success');
                            return redirect('surattugas');
                        }else{
                            setFlash('Gagal memvalidasi permohonan surat tugas.','danger');
                            return redirect('surattugas');
                        }
                    }else{
                        setFlash('Gagal memvalidasi permohonan surat tugas.','danger');
                        return redirect('surattugas');
                    }
                }
            }else{
                $st = $this->suratTugasModel->getById($id);
                if($st && $st->validasi_ppk == 'Disetujui' && !$st->validasi_kepala_balai && Middleware::jabatan('kepala_balai')){
                    //load data
                    $data['laporan'] = $st;
                    $data['pengikut'] = $this->pegawaiModel->getAllNIP($st->pengikut);
                    $data['ditugaskan'] = $this->suratTugasModel->getTugasById($id);
                    $data['ppk'] = $this->suratTugasModel->getPPKById($id);

                    $this->view('surat_tugas/validasikb', $data);
                }else{
                    return redirect('surattugas');
                }
            }
        }

        public function nomorsurat($id = ''){
            $data = [
                'title' => 'Surat Tugas - Input Nomor Surat Tugas',
                'menu' => 'Surat Tugas',
            ];
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //validate error free
                if(empty($_POST['nomor_surat'])){
                    //load view with error
                    setFlash('Form input tidak boleh kosong','danger');
                    return redirect('surattugas/nomorsurat/'.$_POST['id']);
                }else{
                    $st = $this->suratTugasModel->getById($_POST['id']);
                    if($st && $st->validasi_kepala_balai == 'Disetujui' && !$st->disahkan && Middleware::admin('surat_tugas')){
                        if($this->suratTugasModel->inputNomorSurat($_POST,$_FILES)){
                            //get atasan data
                            $kb = $this->pegawaiModel->getByNIP($st->pemohon);
                            // send notification to whatsapp atasan
                            $data['isi_pesan'] = "[BRSBB:SIP-SuratTugas] Surat Tugas sudah diterbitkan";
                            $data['no_telp'] = $kb->no_telp;
                            notifWA($data);
                            
                            // redirect after success validate
                            setFlash('Berhasil input Nomor Surat permohonan surat tugas.','success');
                            return redirect('surattugas');
                        }else{
                            setFlash('Gagal input Nomor Surat permohonan surat tugas.','danger');
                            return redirect('surattugas');
                        }
                    }else{
                        setFlash('Gagal input Nomor Surat permohonan surat tugas.','danger');
                        return redirect('surattugas');
                    }
                }
            }else{
                $st = $this->suratTugasModel->getById($id);
                if($st && $st->validasi_kepala_balai == 'Disetujui' && !$st->disahkan && Middleware::admin('surat_tugas')){
                    //load data
                    $data['laporan'] = $st;
                    $data['pengikut'] = $this->pegawaiModel->getAllNIP($st->pengikut);
                    $data['ditugaskan'] = $this->suratTugasModel->getTugasById($id);
                    $data['ppk'] = $this->suratTugasModel->getPPKById($id);
    
                    $this->view('surat_tugas/nomor_surat', $data);
                }else{
                    return redirect('surattugas');
                }
            }
        }

    public function delete($id=''){
        $row = $this->model('SuratTugasModel')->getById($id);
        if($row && $row->pemohon == $_SESSION['nip'] && !$row->nomor_surat && !$row->disahkan){
            if ($this->suratTugasModel->deleteLaporan($id)) {
                setFlash('Laporan deleted successfully', 'success');
                return redirect(URLROOT.'/surattugas');
            }else{
                setFlash('Failed to delete Laporan', 'danger');
                return redirect(URLROOT.'/surattugas');
            }
        }
    }

    public function rekap()
    {
        if($_SESSION['role'] == 'ADMIN' || Middleware::admin('surat_tugas') || Middleware::admin('sekretariat') || Middleware::jabatan('kasubag_tu') || Middleware::jabatan('koordinator') || Middleware::jabatan('kepala_balai')){
            if(ISSET($_POST['search'])){
                $surattugas = $this->suratTugasModel->rekapAllByDate($_POST['date1'],$_POST['date2']);
            }else{
                $surattugas = $this->suratTugasModel->rekapAll();
            }

            // data send to view
            $data = [
                'title' => 'Rekap Surat Tugas',
                'menu' => 'Surat Tugas',
                'surattugas' => $surattugas,
            ];

            $data['kepala_balai'] = $this->jabatanModel->getPegawai('kepala_balai');
            $data['kepegawaian'] = $this->adminModel->getPegawai('kepegawaian');

            $this->view('surat_tugas/rekap', $data);
        }else{
            return redirect('surattugas');
        }
    }

    public function cetak($id = '')
    {
        $data['title'] = 'Cetak Surat Tugas';
        $st = $this->suratTugasModel->getById($id);
        if($st && $st->disahkan){
            if(Middleware::admin('surat_tugas') || Middleware::admin('sekretariat') || $st->pemohon == $_SESSION['nip']){
                // load data
                $data['surattugas'] = $st;
                $data['kepala_balai'] = $this->jabatanModel->getPegawai('kepala_balai');
                $data['ditugaskan'] = $this->suratTugasModel->getTugasById($id);
                $data['pengikut'] = $this->pegawaiModel->getAllNIP($st->pengikut);
                //ttd
                $nomor = explode('/',$st->nomor_surat);
                $data['sign'] = $nomor[0].'/'.$st->tanggal_permohonan.'/'.$data['kepala_balai'][0]->nama;

                $this->view('surat_tugas/cetak', $data);
            }else{
                return redirect('surattugas');
            }
        }else{
            return redirect('surattugas');
        }
    }

}

?>