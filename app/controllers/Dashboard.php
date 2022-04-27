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
    }

    public function index(){
        $user = $this->pegawaiModel->get();
        $user_percent = $this->pegawaiModel->getAllCountPercent();

        $ijin_keluar = $this->ijinKeluarModel->getAllCountByMonth();
        $ijinkeluar_percent = $this->ijinKeluarModel->getAllCountPercent();

        // send data
        $data = [
            'title' => 'Dashboard',
            'user' => $user,
            'user_percent' => $user_percent,
            'ijin_keluar' => $ijin_keluar,
            'ijinkeluar_percent' => $ijinkeluar_percent
        ];

        $this->view('dashboard/index', $data);
    }
}