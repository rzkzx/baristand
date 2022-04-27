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
            <form action="<?= URLROOT; ?>/jenisperistiwa/edit" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $data['id']; ?>">
            <div class="form-group row">
                <label for="inputJenisPeristiwa" class="col-sm-2 col-form-label">Jenis Peristiwa :</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="inputJenisPeristiwa" name="jenis_peristiwa" 
                value="<?= $data['jenis_peristiwa'] ?>" placeholder="input jenis peristiwa...">
                </div>
            </div>
            <div class="pb-4"></div>
            <div class="form-group row">
                <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a href="<?= URLROOT; ?>/jenisperistiwa" class="btn btn-danger">Kembali</a>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>