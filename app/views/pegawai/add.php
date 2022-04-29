<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><?= $data['title']; ?></h6>
        </div>
        <div class="card-body">
            <div class="alert alert-warning col-lg-11" role="alert">
                Password pegawai otomatis terinput menyesuaikan username !
            </div>
            <div class="col-md-11">
                <?php flash(); ?>
            </div>
            <form action="<?= URLROOT; ?>/pegawai/add" method="POST" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="nip" class="col-lg-2 col-form-label">NIP</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="nip" name="nip" placeholder="input NIP..." required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-lg-2 col-form-label">Username</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="username" name="username" placeholder="input username..." required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-lg-2 col-form-label">Nama Pegawai</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="input nama pegawai..." required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="golongan" class="col-lg-2 col-form-label">Golongan</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="golongan" name="golongan" placeholder="input golongan..." required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jabatan" class="col-lg-2 col-form-label">Jabatan</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="input jabatan..." required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_telp" class="col-lg-2 col-form-label">No. Telp</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="input no telp..." required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-lg-2 col-form-label">Email</label>
                    <div class="col-sm-9">
                    <input type="email" class="form-control" id="email" name="email" placeholder="input email..." required>
                    </div>
                </div>
            <div class="pb-4"></div>
            <div class="form-group row">
                <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">+ Tambah</button>
                <a href="<?= URLROOT; ?>/pegawai" class="btn btn-danger">Kembali</a>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>