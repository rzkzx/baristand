<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row mb-3">
    <!-- New User Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Pegawai</div>
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= count($data['user']) ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-users fa-2x text-info"></i>
                </div>
                </div>
            </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Ijin Keluar (<?php echo dateID(date('-m-')) ?>)</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($data['ijin_keluar']) ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-warning"></i>
                </div>
                </div>
            </div>
            </div>
        </div>
        <!-- Earnings (Annual) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Ijin Lembur (<?php echo dateID(date('-m-')) ?>)</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($data['ijin_lembur']) ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-success"></i>
                </div>
                </div>
            </div>
            </div>
        </div>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Surat Tugas (<?php echo dateID(date('-m-')) ?>)</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($data['surat_tugas']) ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-primary"></i>
                </div>
                </div>
            </div>
            </div>
        </div>

        </div>
        <!--Row-->
<?php require APPROOT . '/views/inc/footer.php'; ?>
