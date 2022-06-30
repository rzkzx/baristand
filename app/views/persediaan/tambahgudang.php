<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="card mb-4">
        <div class="card-body">
            <div class="col-md-12">
                <?php flash(); ?>
            </div>
            <form action="<?= URLROOT; ?>/persediaan/tambahgudang" method="POST" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Nama Gudang</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan Gudang</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                </div>
            </div>
            <div class="form-group row">
                                <label for="petugas" class="col-lg-2 col-form-label">Petugas Gudang</label>
                                <div class="col-sm-6">
                                <select class="select2-multiple form-control" name="petugas[]" multiple="multiple"
                                  id="select2Multiple">
                                  <?php 
                                      foreach ($data['petugas'] as $k) {
                                      ?>
                                          <option value="<?= $k->nip ?>"><?= $k->nama ?> / <?= $k->nip ?></option>
                                      <?php
                                      }
                                    ?>
                                </select>
                                </div>
                              </div>
            <div class="pb-4"></div>
            <div class="form-group row">
                <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Tambah</button>
                <a href="<?= URLROOT; ?>persediaan" class="btn btn-danger">Kembali</a>
                </div>
            </div>
            </form>
        </div>
        </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>