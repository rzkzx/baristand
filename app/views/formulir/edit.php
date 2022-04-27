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
            <form action="<?= URLROOT; ?>/formulir/edit" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $data['formulir']->id ?>">
            <div class="form-group row">
                <label for="nama" class="col-sm-3 col-form-label">Nama Formulir :</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="nama" name="nama" 
                value="<?= $data['formulir']->nama ?>" placeholder="input nama formulir...">
                </div>
            </div>
            <div class="form-group row">
                <label for="kode" class="col-sm-3 col-form-label">Kode Formulir :</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="kode" name="kode" 
                value="<?= $data['formulir']->kode ?>" placeholder="input kode formulir...">
                </div>
            </div>
            <div class="pb-4"></div>
            <div class="form-group row">
                <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a href="<?= URLROOT; ?>/formulir" class="btn btn-danger">Kembali</a>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>