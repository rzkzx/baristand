<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
          <img src="<?= URLROOT; ?>/img/logo/logo.png">
        </div>
        <div class="sidebar-brand-text mx-3">BSPJI BANJARBARU</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item <?php if($data['title'] == 'Dashboard') echo 'active'; ?>">
        <a class="nav-link" href="<?= URLROOT; ?>/dashboard">
          <i class="fa fa-th-large"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
        <?php if($_SESSION['role'] == 'ADMIN'){ ?>
        <li class="nav-item <?php if($data['menu'] == 'Admin') echo 'active'?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdmin" aria-expanded="true"
            aria-controls="collapseAdmin">
            <i class="fa fa-cog"></i>
            <span>Master</span>
            </a>
            <div id="collapseAdmin" class="collapse <?php if($data['menu'] == 'Admin') echo 'show'?>" aria-labelledby="headingForm" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">SETTING</h6>
                <a class="collapse-item <?php if(stripos($data['title'],'Jenis Pelanggaran') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/jenispelanggaran">Jenis Pelanggaran</a>
                <a class="collapse-item <?php if(stripos($data['title'],'Jenis Penerimaan') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/jenispenerimaan">Jenis Penerimaan</a>
                <a class="collapse-item <?php if(stripos($data['title'],'Jenis Peristiwa') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/jenisperistiwa">Jenis Peristiwa</a>
                <a class="collapse-item <?php if(stripos($data['title'],'Formulir') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/formulir">Formulir</a>
                <a class="collapse-item <?php if(stripos($data['title'],'Kirim Pesan') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/kirimpesan">Kirim Pesan</a>
            </div>
            </div>
        </li>
        <?php } ?>

        <?php if(Middleware::admin('kepegawaian') || $_SESSION['role'] == 'ADMIN'){ ?>
        <li class="nav-item <?php if($data['menu'] == 'Pegawai') echo 'active'?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePegawai" aria-expanded="true"
            aria-controls="collapsePegawai">
            <i class="fa fa-users"></i>
            <span>Pegawai</span>
            </a>
            <div id="collapsePegawai" class="collapse <?php if($data['menu'] == 'Pegawai') echo 'show'?>" aria-labelledby="headingForm" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">PEGAWAI</h6>
                <a class="collapse-item <?php if(stripos($data['title'],'Pegawai') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/pegawai">Daftar Pegawai</a>
                <a class="collapse-item <?php if(stripos($data['title'],'Jabatan') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/jabatan">Daftar Jabatan</a>
                <a class="collapse-item <?php if(stripos($data['title'],'Admin') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/admin">Daftar Admin</a>
                <h6 class="collapse-header">HISTORY</h6>
                <a class="collapse-item <?php if(stripos($data['title'],'Log User') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/loguser">Log User</a>
            </div>
            </div>
        </li>
        <?php } ?>

        <li class="nav-item <?php if($data['menu'] == 'Whistleblowing') echo 'active'; ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseWhistle" aria-expanded="true"
            aria-controls="collapseWhistle">
            <i class="fa fa-flag"></i>
            <span>Whistleblowing</span>
            </a>
            <div id="collapseWhistle" class="collapse <?php if($data['menu'] == 'Whistleblowing') echo 'show'; ?>" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?php if(stripos($data['title'],'Input Laporan') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/whistle">Input Laporan</a>
                <?php if(Middleware::jabatan('kepala_balai') || Middleware::jabatan('kasubag_tu') || $_SESSION['role'] == 'ADMIN'){ ?>
                    <a class="collapse-item <?php if(stripos($data['title'],'Daftar Laporan') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/whistle/laporan">Daftar Laporan</a>
                <?php } ?>
            </div>
            </div>
        </li>

        <li class="nav-item <?php if($data['menu'] == 'Gratifikasi') echo 'active'; ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGratifikasi" aria-expanded="true"
            aria-controls="collapseGratifikasi">
            <i class="fa fa-flag"></i>
                <span>Anti Gratifikasi</span>
            </a>
            <div id="collapseGratifikasi" class="collapse <?php if($data['menu'] == 'Gratifikasi') echo 'show'; ?>" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?php if(stripos($data['title'],'Input Laporan Anti Gratifikasi') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/gratifikasi">Input Laporan</a>
                <?php if(Middleware::jabatan('koordinator') || Middleware::jabatan('kasubag_tu')){ ?>
                    <a class="collapse-item <?php if(stripos($data['title'],'Daftar Laporan Anti Gratifikasi') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/gratifikasi/laporan">Daftar Laporan</a>
                <?php } ?>
                <?php if($_SESSION['role'] == 'ADMIN' || Middleware::jabatan('kasubag_tu') || Middleware::jabatan('koordinator')){ ?>
                    <a class="collapse-item <?php if(stripos($data['title'],'Rekap Laporan Anti Gratifikasi') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/gratifikasi/rekap">Rekap Laporan</a>
                <?php } ?>
            </div>
            </div>
        </li>

        <li class="nav-item <?php if($data['menu'] == 'Ijin Keluar') echo 'active'; ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseIjinKeluar" aria-expanded="true"
            aria-controls="collapseIjinKeluar">
            <i class="fas fa-calendar"></i>
            <span>Ijin Keluar </span> 
            </a>
            <div id="collapseIjinKeluar" class="collapse <?php if($data['menu'] == 'Ijin Keluar') echo 'show'; ?>" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?php if(stripos($data['title'],'Input Ijin Keluar') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/ijinkeluar">Input Ijin Keluar</a>
                <?php if(Middleware::jabatan('kasubag_tu') || Middleware::jabatan('koordinator') || Middleware::jabatan('kepala_balai')){ ?>
                    <a class="collapse-item <?php if(stripos($data['title'],'Validasi Ijin Keluar') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/ijinkeluar/listvalidasi">Validasi Ijin Keluar <span class="badge badge-danger badge-counter"><?php if($ijin_keluar = $this->model('IjinKeluarModel')->getByAtasanNotValidate()) echo count($ijin_keluar) ?></span></a>
                <?php } ?>
                <?php if($_SESSION['role'] == 'ADMIN' || Middleware::jabatan('kasubag_tu') || Middleware::admin('kepegawaian') || Middleware::jabatan('kepala_balai')){ ?>
                    <a class="collapse-item <?php if(stripos($data['title'],'Rekap Ijin Keluar') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/ijinkeluar/rekap">Rekap Ijin Keluar</a>
                <?php } ?>
            </div>
            </div>
        </li>

        <li class="nav-item <?php if($data['menu'] == 'Ijin Lembur') echo 'active'; ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseIjinLembur" aria-expanded="true"
            aria-controls="collapseIjinLembur">
            <i class="fas fa-calendar"></i>
            <span>Ijin Lembur</span>
            </a>
            <div id="collapseIjinLembur" class="collapse <?php if($data['menu'] == 'Ijin Lembur') echo 'show'; ?>" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?php if(stripos($data['title'],'Input Ijin Lembur') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/ijinlembur">Input Ijin Lembur</a>
                <?php if(Middleware::jabatan('kasubag_tu') || Middleware::jabatan('koordinator') || Middleware::jabatan('kepala_balai') || Middleware::admin('kepegawaian')){ ?>
                    <a class="collapse-item <?php if(stripos($data['title'],'Validasi Ijin Lembur') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/ijinlembur/listvalidasi">
                    Validasi Ijin Lembur 
                        <?php  
                        $kb = 0; $atasan = 0; $nmr = 0;
                        $atasan = count($this->model('IjinLemburModel')->getByAtasanNotValidate());
                        if(Middleware::jabatan('kepala_balai')){
                            $kb = count($this->model('IjinLemburModel')->getByKBNotValidate());
                        }
                        if(Middleware::admin('kepegawaian')){
                            $nmr = count($this->model('IjinLemburModel')->getByNomorNotInput());
                        }
                        $total = $atasan + $kb + $nmr;
                        if($total > 0){
                            echo '<span class="badge badge-danger badge-counter">'.$total.'</span>';
                        }
                        ?>
                    </a>
                <?php } ?>
                <?php if($_SESSION['role'] == 'ADMIN' || Middleware::jabatan('kasubag_tu') || Middleware::admin('kepegawaian') || Middleware::jabatan('kepala_balai')){ ?>
                    <a class="collapse-item <?php if(stripos($data['title'],'Rekap Ijin Lembur') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/ijinlembur/rekap">Rekap Ijin Lembur</a>
                <?php } ?>
            </div>
            </div>
        </li>

        <li class="nav-item <?php if($data['menu'] == 'Surat Tugas') echo 'active'; ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSuratTugas" aria-expanded="true"
            aria-controls="collapseSuratTugas">
            <i class="fa fa-envelope"></i>
            <span>Surat Tugas</span>
            </a>
            <div id="collapseSuratTugas" class="collapse <?php if($data['menu'] == 'Surat Tugas') echo  'show'; ?>" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?php if(stripos($data['title'],'Pengajuan Surat Tugas') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/surattugas">
                Pengajuan Surat Tugas
                <?php  
                        $atasan = 0; $kb = 0; $ppk = 0; $kp = 0;
                        $atasan = count($this->model('SuratTugasModel')->getByAtasanNotValidate());
                        $ppk = count($this->model('SuratTugasModel')->getByPPKNotValidate());
                        if(Middleware::jabatan('kepala_balai')){
                            $kb = count($this->model('SuratTugasModel')->getByKBNotValidate());
                        }
                        if(Middleware::admin('surat_tugas')){
                            $kp = count($this->model('SuratTugasModel')->getByNomorNotInput());
                        }
                        $total = $atasan + $kb + $ppk + $kp;
                        if($total > 0){
                            echo '<span class="badge badge-danger badge-counter">'.$total.'</span>';
                        }
                        ?>
                </a>
                <?php if($_SESSION['role'] == 'ADMIN' || Middleware::admin('surat_tugas') || Middleware::admin('sekretariat') || Middleware::jabatan('kasubag_tu') || Middleware::jabatan('koordinator') || Middleware::jabatan('kepala_balai')){ ?>
                    <a class="collapse-item <?php if(stripos($data['title'],'Rekap Surat Tugas') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/surattugas/rekap">Rekap Surat Tugas</a>
                <?php } ?>
            </div>
            </div>
        </li>

        <li class="nav-item <?php if($data['menu'] == 'Pengadaan') echo 'active'; ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengadaan" aria-expanded="true"
            aria-controls="collapsePengadaan">
            <i class="fa fa-archive"></i>
            <span>Pengadaan</span>
            </a>
            <div id="collapsePengadaan" class="collapse <?php if($data['menu'] == 'Pengadaan') echo 'show'; ?>" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <?php if($_SESSION){ ?>
                <a class="collapse-item <?php if(stripos($data['title'],'Daftar Pengadaan') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/pengadaan">
                Pengajuan Pengadaan
                <?php  
                        $atasan = 0; $ks = 0; $kb = 0; $pk = 0; $p = 0; $ts = 0; $h = 0;
                        $atasan = count($this->model('PengadaanModel')->getByAtasanNotValidate());
                        if(Middleware::jabatan('kasubag_tu')){
                            $ks = count($this->model('PengadaanModel')->getByKSNotValidate());
                        }
                        if(Middleware::jabatan('kepala_balai')){
                            $kb = count($this->model('PengadaanModel')->getByKBNotValidate());
                        }
                        if(Middleware::jabatan('ppk')){
                            $pk = count($this->model('PengadaanModel')->getByPKNotValidate());
                        }
                        if(Middleware::admin('pengadaan')){
                            $p = count($this->model('PengadaanModel')->getByPNotValidate());
                        }
                        $ts = $this->model('PengadaanModel')->getByTSNotValidate();
                        $h = count($this->model('PengadaanModel')->getByHNotValidate());
                        $total = $atasan + $ks + $kb + $pk + $p + $ts + $h;
                        if($total > 0){
                            echo '<span class="badge badge-danger badge-counter">'.$total.'</span>';
                        }
                        ?>
            </a>
                <?php } ?>
              
                <?php if(Middleware::jabatan('ppk') || Middleware::jabatan('kasubag_tu') || Middleware::admin('pengadaan') || $_SESSION['role'] == 'ADMIN' || Middleware::jabatan('kepala_balai')){ ?>
                    <a class="collapse-item <?php if(stripos($data['title'],'Rekap Pengadaan') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/pengadaan/rekap">Rekap Pengadaan</a>
                <?php } ?>
            </div>
            </div>
        </li>

        <li class="nav-item <?php if($data['menu'] == 'Perbaikan') echo 'active'; ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePerbaikan" aria-expanded="true"
            aria-controls="collapsePerbaikan">
            <i class="fa fa-wrench"></i>
            <span>Perbaikan</span>
            </a>
            <div id="collapsePerbaikan" class="collapse <?php if($data['menu'] == 'Perbaikan') echo 'show'; ?>" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <?php if($_SESSION){ ?>
                <a class="collapse-item <?php if(stripos($data['title'],'Daftar Perbaikan') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/perbaikan">
                Pengajuan Perbaikan
                <?php  
                        $atasan = 0; $kb = 0; $ks = 0; $p = 0; $ts = 0; $h = 0;
                        $atasan = count($this->model('PerbaikanModel')->getByAtasanNotValidate());
                        if(Middleware::jabatan('kepala_balai')){
                            $kb = count($this->model('PerbaikanModel')->getByKBNotValidate());
                        }
                        if(Middleware::jabatan('kasubag_tu')){
                            $ks = count($this->model('PerbaikanModel')->getByKSNotValidate());
                        }
                        if(Middleware::admin('perbaikan')){
                            $p = count($this->model('PerbaikanModel')->getByPNotValidate());
                        }
                        $ts = $this->model('PerbaikanModel')->getByTSNotValidate();
                        $h = count($this->model('PerbaikanModel')->getByHNotValidate());
                        $total = $atasan + $kb + $ks + $p + $ts + $h;
                        if($total > 0){
                            echo '<span class="badge badge-danger badge-counter">'.$total.'</span>';
                        }
                        ?>
            </a>
                <?php } ?>
                <?php if(Middleware::jabatan('ppk') || Middleware::jabatan('kasubag_tu') || Middleware::admin('perbaikan') || $_SESSION['role'] == 'ADMIN' || Middleware::jabatan('kepala_balai')){ ?>
                    <a class="collapse-item <?php if(stripos($data['title'],'Rekap Perbaikan') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/perbaikan/rekap">Rekap Perbaikan</a>
                <?php } ?>
            </div>
            </div>
        </li>

        <li class="nav-item <?php if($data['menu'] == 'persediaan') echo 'active'; ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsepersediaan" aria-expanded="true"
            aria-controls="collapsepersediaan">
            <i class="fa fa-shopping-basket" aria-hidden="true"></i>
            <span>Persediaan</span>
            </a>
            <div id="collapsepersediaan" class="collapse <?php if($data['menu'] == 'persediaan') echo 'show'; ?>" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <?php if($_SESSION){ ?>
                <a class="collapse-item <?php if(stripos($data['title'],'Daftar persediaan') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/persediaan">
                Daftar Persediaan</a>
                <a class="collapse-item <?php if (stripos($data['title'], 'Master gudang') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/persediaan/gudang">
                Master Gudang</a>
                <a class="collapse-item <?php if (stripos($data['title'], 'Master barang') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/persediaan/barang">
                Master Barang</a>
                <?php } ?>
            </div>
            </div>
        </li>

        <li class="nav-item <?php if($data['menu'] == 'Kendi') echo 'active'; ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKendi" aria-expanded="true"
            aria-controls="collapseKendi">
            <i class="fas fa-motorcycle"></i>
            <span>Kendaraan Dinas</span> 
            </a>
            <div id="collapseKendi" class="collapse <?php if($data['menu'] == 'Kendi') echo 'show'; ?>" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <?php if($_SESSION['role'] == 'ADMIN' ||  Middleware::admin('bmn')){ ?>
                    <a class="collapse-item <?php if(stripos($data['title'],'Data Kendaraan') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/kendi/kendaraan">Data Kendaraan</a>
                <?php } ?>
                <a class="collapse-item <?php if(stripos($data['title'],'Peminjaman Kendaraan') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/kendi">Peminjaman Kendaraan</a>
                <a class="collapse-item <?php if(stripos($data['title'],'Penggunaan Kendaraan') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/kendi/penggunaan">Penggunaan Kendaraan</a>
                <?php if($_SESSION['role'] == 'ADMIN' || Middleware::admin('kendi')){ ?>
                    <a class="collapse-item <?php if(stripos($data['title'],'Kondisi Harian') !== FALSE) echo 'active'; ?>" href="<?= URLROOT; ?>/kendi/kondisi">Kondisi Harian</a>
                <?php } ?>
            </div>
            </div>
        </li>
        
        <hr class="sidebar-divider">
        <div class="version">BSPJI - VERSION <?= APPVERSION; ?></div>
        <li class="nav-item <?php if($data['title'] == 'Help') echo 'active'; ?>">
            <a class="nav-link" href="<?= URLROOT; ?>/help">
            <i class="fa fa-question-circle"></i>
            <span>Help Desk</span></a>
        </li>
        </ul>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <!-- TopBar -->
            <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
            <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
            <ul class="navbar-nav ml-auto">
                <div class="topbar-divider d-none d-sm-block"></div>
                <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <img class="img-profile rounded-circle" src="<?= URLROOT; ?>/img/avatar/<?php echo ($_SESSION['avatar']) ? $_SESSION['avatar'] : 'boy.png'; ?>" style="max-width: 60px">
                    <span class="ml-2 d-none d-lg-inline text-white small"><?= $_SESSION['nama'] ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?= URLROOT ?>/user">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                    </a>
                </div>
                </li>
            </ul>
            </nav>
            <!-- Topbar -->

            <!-- Container Fluid-->
            <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                <h1 class="h3 mb-0 text-gray-800"><?= $data['title'] ?></h1>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= URLROOT; ?>">Home</a></li>
                <?php if(isset($data['menu'])){?>
                    <li class="breadcrumb-item"><?= $data['menu'] ?></li>
                <?php } ?>
                <li class="breadcrumb-item active"><?= $data['title'] ?></li>
                <!-- <li class="breadcrumb-item active" aria-current="page">Blank Page</li> -->
                </ol>
            </div>
