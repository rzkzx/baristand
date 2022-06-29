<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><?= $data['title']; ?></h6>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <?php flash(); ?>
            </div>
            <form action="<?= URLROOT; ?>/kendi/editkendaraan" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $data['id']; ?>">
            <div class="form-group row">
                <label for="merk" class="col-sm-2 col-form-label">Merk :</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" id="merk" name="merk" value="<?= $data['kend']->merk ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="tipe" class="col-sm-2 col-form-label">Tipe :</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" id="tipe" name="tipe" value="<?= $data['kend']->tipe ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="nopol" class="col-sm-2 col-form-label">Nomor Polisi :</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" id="nopol" name="nopol" value="<?= $data['kend']->nopol ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="tgl_pajak" class="col-sm-2 col-form-label">Tgl. Bayar Pajak :</label>
                <div class="col-sm-6">
                <input type="date" class="form-control" id="tgl_pajak" name="tgl_pajak" value="<?= $data['kend']->tgl_pajak ?>" required>
                </div>
            </div>
            <div class="pb-4"></div>
            <div class="form-group row">
                <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a href="<?= URLROOT; ?>/kendi/kendaraan" class="btn btn-danger">Kembali</a>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>