<?php 
class KirimPesan extends Controller{

    public function __construct()
    {
        if(!isLoggedIn() || $_SESSION['role'] != 'ADMIN'){
            return redirect('auth/login');
        }
    }

//add new jp
    public function index(){
        $data['title'] = 'Kirim Pesan Personal';
        $data['menu'] = 'Admin';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //validate error free
            if(empty($_POST['nomor']) || empty($_POST['pesan'])){
                //load view with error
                setFlash('Form input tidak boleh kosong','danger');
                return redirect('kirim_pesan/index');
            }else{
                // send notification to whatsapp
                $data['no_telp'] = $_POST['nomor'];
                $data['isi_pesan'] = $_POST['pesan'];
                if(notifWA($data)){
                    //redirect and set notif flash
                    setFlash('Berhasil mengirim pesan','success');
                    return redirect('kirimpesan');
                }else{
                    setFlash('Gagal mengirim pesan','danger');
                    return redirect('kirimpesan');
                }
            }
        }else{
            //render view
            $this->view('kirim_pesan/index', $data);
        }
    }

}