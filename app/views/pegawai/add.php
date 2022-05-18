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
                    <input type="text" class="form-control" id="nip" name="nip" placeholder="" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-lg-2 col-form-label">Username</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="username" name="username" placeholder="" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-lg-2 col-form-label">Nama Pegawai</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tgl_lahir" class="col-lg-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="" required>
                    </div>
                </div>
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin :</legend>
                        <div class="col-sm-6 d-flex">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="pria" name="jenis_kel" value="Laki-Laki" class="custom-control-input" checked>
                                <label class="custom-control-label" for="pria">Laki-Laki</label>
                            </div>
                            <div class="custom-control custom-radio ml-4">
                                <input type="radio" id="wanita" name="jenis_kel" value="Perempuan" class="custom-control-input" checked>
                                <label class="custom-control-label" for="wanita">Perempuan</label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="form-group row">
                    <label for="golongan" class="col-lg-2 col-form-label">Golongan / Ruang</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="golongan" name="golongan" placeholder="" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pangkat" class="col-lg-2 col-form-label">Pangkat</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="pangkat" name="pangkat" placeholder="" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jabatan" class="col-lg-2 col-form-label">Jabatan</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pendidikan" class="col-lg-2 col-form-label">Pendidikan</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="pendidikan" name="pendidikan" placeholder="" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_telp" class="col-lg-2 col-form-label">No. Telp</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-lg-2 col-form-label">Email</label>
                    <div class="col-sm-9">
                    <input type="email" class="form-control" id="email" name="email" placeholder="" required>
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