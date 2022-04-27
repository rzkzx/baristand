<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><?= $data['title']; ?></h6>
        </div>
        <div class="card-body">
            <div class="alert alert-warning col-lg-11" role="alert">
            Tidak perlu mengisi input password apabila tidak ingin merubah !
            </div>
            <div class="col-md-12">
                <?php flash(); ?>
            </div>
            <form action="<?= URLROOT; ?>/pegawai/edit" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $data['pegawai']->id; ?>">
                <div class="form-group row">
                    <label for="nip" class="col-lg-2 col-form-label">NIP :</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="nip" name="nip" value="<?= $data['pegawai']->nip ?>" placeholder="input NIP...">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-lg-2 col-form-label">Username :</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="username" name="username" value="<?= $data['pegawai']->username ?>" placeholder="input username...">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-lg-2 col-form-label">Nama Pegawai :</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['pegawai']->nama ?>" placeholder="input nama pegawai...">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="golongan" class="col-lg-2 col-form-label">Golongan :</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="golongan" name="golongan" value="<?= $data['pegawai']->golongan ?>" placeholder="input golongan...">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jabatan" class="col-lg-2 col-form-label">Jabatan :</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= $data['pegawai']->jabatan ?>" placeholder="input jabatan...">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_telp" class="col-lg-2 col-form-label">No. Telp :</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= $data['pegawai']->no_telp ?>" placeholder="input no telp...">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-lg-2 col-form-label">Email : </label>
                    <div class="col-sm-9">
                    <input type="email" class="form-control" id="email" name="email" value="<?= $data['pegawai']->email ?>" placeholder="input email...">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-lg-2 col-form-label">Password : </label>
                    <div class="col-sm-9">
                    <input type="password" class="form-control" id="password" name="password" placeholder="input password...">
                    </div>
                </div>
            <div class="pb-4"></div>
            <div class="form-group row">
                <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a href="<?= URLROOT; ?>/pegawai" class="btn btn-danger">Kembali</a>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>