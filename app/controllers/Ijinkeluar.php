<?php 
class IjinKeluar extends Controller{

    public function __construct()
    {
        if(!isLoggedIn()){
            return redirect('auth/login');
        }
        //new model instance
        $this->ijinKeluarModel = $this->model('IjinKeluarModel');
        $this->jabatanModel = $this->model('JabatanModel');
        $this->pegawaiModel = $this->model('PegawaiModel');
    }

    public function index(){
        $ijin_keluar = $this->ijinKeluarModel->getByUserLogin();
        $pejabat_validasi = $this->ijinKeluarModel->getPejabatValidasi();
        $data = [
            'title' => 'Input Ijin Keluar',
            'menu' => 'Ijin Keluar',
            'ijin_keluar' => $ijin_keluar,
            'pejabat_validasi' => $pejabat_validasi
        ];

        $this->view('ijin_keluar/index', $data);
    }

    public function listvalidasi(){
        if(Middleware::jabatan('kasubag_tu') || Middleware::jabatan('koordinator') || Middleware::jabatan('kepala_balai')){
            $ijin_keluar = $this->ijinKeluarModel->getByAtasan();
            $data = [
                'title' => 'Daftar Validasi Ijin Keluar',
                'menu' => 'Ijin Keluar',
                'ijin_keluar' => $ijin_keluar,
            ];

            $this->view('ijin_keluar/list_validasi', $data);
        }else{
            return redirect('ijinkeluar');
        }
    }

    public function rekap(){
        if($_SESSION['role'] == 'ADMIN' || Middleware::jabatan('kasubag_tu') || Middleware::admin('kepegawaian') || Middleware::jabatan('kepala_balai')){
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

    //add new jp
    public function add(){
        $data['title'] = 'Form Input Ijin Keluar';
        $data['menu'] = 'Ijin Keluar';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //validate error free
            if(empty($_POST['pejabat_validasi']) || empty($_POST['tanggal_ijin']) || empty($_POST['keperluan']) || empty($_POST['jam_keluar']) || empty($_POST['jam_kembali'])){
                //load view with error
                setFlash('Form input tidak boleh kosong','danger');
                return redirect('ijinkeluar/add');
            }else{
                if($this->ijinKeluarModel->add($_POST)){
                    //get atasan data
                    $ats = $this->pegawaiModel->getByNIP($_POST['pejabat_validasi']);
                    // send notification to whatsapp atasan
                    $data['no_telp'] = $ats->no_telp;
                    $data['isi_pesan'] = "[BRSBB:SIP-IjinKeluar] Harap Ditindaklanjuti";
                    notifWA($data);

                    //redirect and set notif flash
                    setFlash('Berhasil membuat permohonan ijin keluar.','success');
                    return redirect('ijinkeluar');
                }else{
                    setFlash('Gagal membuat permohonan ijin keluar.','danger');
                    return redirect('ijinkeluar');
                }
            }
        }else{
            // Atasan Langsung Koordinator,Kasubag TU dan Kepala Balai
            $kepalabalai = $this->jabatanModel->getPegawai('kepala_balai');
            $kasubag_tu = $this->jabatanModel->getPegawai('kasubag_tu');
            $koordinator = $this->jabatanModel->getPegawai('koordinator');

            //data 
            $data['atasan'] = array_merge($kepalabalai,$kasubag_tu,$koordinator);

            //render view
            $this->view('ijin_keluar/add', $data);
        }
    }

     // validasi control
     public function validasi($id = ''){
        $data['title'] = 'Validasi Ijin Keluar';
        $data['menu'] = 'Ijin Keluar';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            //validate error free
            if(empty($_POST['validasi'])){
                //load view with error
                setFlash('Form input tidak boleh kosong','danger');
                return redirect('ijinkeluar/validasi/'.$_POST['id']);
            }else{
                $ijk = $this->ijinKeluarModel->getById($_POST['id']);
                if($ijk && !$ijk->validasi && $ijk->pejabat_validasi == $_SESSION['nip']){
                    if($this->ijinKeluarModel->update($_POST)){
                        // send notification to whatsapp pegawai
                        // // '%0a' new line in whatsapp
                        $data['no_telp'] = $ijk->no_telp;
                        $data['isi_pesan'] = 
                        "*Izin Keluar Disetujui*%0aNama : ".$ijk->nama."%0aJam Keluar : ".timeID($ijk->jam_keluar)."%0aJam Kembali : ".timeID($ijk->jam_kembali)."%0aTanggal Izin : ".dayID($ijk->tanggal_ijin).", ".dateID($ijk->tanggal_ijin)."%0aKeperluan : ".$ijk->keperluan;
                        notifWA($data);

                        // redirect after success validate
                        setFlash('Berhasil validasi ijin keluar.','success');
                        return redirect('ijinkeluar/listvalidasi');
                    }else{
                        setFlash('Gagal validasi ijin keluar','danger');
                        return redirect('ijinkeluar/listvalidasi');
                    }
                }else{
                    setFlash('Gagal validasi ijin keluar','danger');
                    return redirect('ijinkeluar/listvalidasi');
                }
            }
        }else{
            $ijin_keluar = $this->ijinKeluarModel->getById($id);
            if($ijin_keluar && !$ijin_keluar->validasi && $ijin_keluar->pejabat_validasi == $_SESSION['nip']){
                $data['id'] = $id;
                $data['ijin_keluar'] = $ijin_keluar;
                
                $this->view('ijin_keluar/validasi', $data);
            }else{
                return redirect('ijinkeluar/listvalidasi');
            }
        }
    }
}                            
                        