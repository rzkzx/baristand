<?php 
class Dashboard extends Controller{

    public function __construct()
    {
        if(!isLoggedIn()){
            return redirect('auth/login');
        }
        //new model instance
        $this->pegawaiModel = $this->model('PegawaiModel');
        $this->ijinKeluarModel = $this->model('IjinKeluarModel');
        $this->ijinLemburModel = $this->model('IjinLemburModel');
    }

    public function index(){
        $user = $this->pegawaiModel->get();

        $ijin_keluar = $this->ijinKeluarModel->getAllCountByMonth();

        $ijin_lembur = $this->ijinLemburModel->getAllCountByMonth();

        // send data
        $data = [
            'title' => 'Dashboard',
            'user' => $user,
            'ijin_keluar' => $ijin_keluar,
            'ijin_lembur' => $ijin_lembur,
        ];

        $this->view('dashboard/index', $data);
    }
}