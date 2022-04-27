<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <?php flash(); ?>
            </div>
            <form action="<?= URLROOT; ?>/jabatan/edit" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $data['jabatan']->id; ?>">
                <div class="form-group row">
                    <label for="nip" class="col-lg-2 col-form-label">Nama Jabatan :</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="nip" name="nip" value="<?= $data['jabatan']->nama_jabatan ?>" readonly>
                    </div>
                </div>
                <h6>Daftar Pejabat</h6>
                <ul>
                  <?php
                    foreach ($data['pegawai'] as $k) {
                      ?>
                      <input type="hidden" name="pegawai[]" value="<?= $k->nip; ?>">
                      <li><?= $k->nama ?> (<?= $k->nip ?>) <a href="<?= URLROOT; ?>/jabatan/deleteJabatan/<?php echo $data['jabatan']->id.'-'.$k->nip ?>">Hapus</a></li>
                      <?php
                    }
                  ?>
                </ul>
                <div class="form-group col-lg-6">
                    <select class="select2-pegawai-pejabat form-control" name="pegawai[]" id="select2SinglePlaceholder">
                      <option value="">Select</option>
                      <?php 
                        foreach ($data['daftar_pegawai'] as $pegi) {
                        ?>
                            <option value="<?= $pegi->nip ?>"><?= $pegi->nama ?> (<?= $pegi->nip ?>)</option>
                        <?php
                        }
                      ?>
                      
                    </select>
                  </div>
            <div class="pb-4"></div>
            <div class="form-group row">
                <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Tambah Jabatan</button>
                <a href="<?= URLROOT; ?>/jabatan" class="btn btn-danger">Kembali</a>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>