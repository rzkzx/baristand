<?php require APPROOT . '/views/inc/header.php'; ?>
<section class="section">
    <div class="row">
        <div class="col-12">
            <div class="content-wrapper">
                <!-- Main content -->
                <section class="content">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="col-md-8">
                                <?php flash(); ?>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="<?= URLROOT; ?>/whistle/add" method="POST" enctype="multipart/form-data">
                                <div class="row mb-3">
                                  <label for="inputNama" class="col-sm-2 col-form-label">Nama :</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="nama" required class="form-control" id="inputNama">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="inputInstansi" class="col-sm-2 col-form-label">Instansi :</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="instansi" required class="form-control" id="inputInstansi">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat :</label>
                                  <div class="col-sm-6">
                                    <textarea type="text" name="alamat" required class="form-control" id="inputAlamat"></textarea>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="inputEmail" class="col-sm-2 col-form-label">Email :</label>
                                  <div class="col-sm-6">
                                    <input type="email" name="email" required class="form-control" id="inputEmail">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="inputNoTelp" class="col-sm-2 col-form-label">No. Hp/Wa :</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="no_telp" required class="form-control" id="inputNoTelp">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="inputJudul" class="col-sm-2 col-form-label">Judul Laporan :</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="judul_laporan" required class="form-control" id="inputJudul">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="inputUraian" class="col-sm-2 col-form-label">Uraian Laporan :</label>
                                  <div class="col-sm-6">
                                    <textarea type="text" name="uraian_laporan" required class="form-control" id="inputUraian"></textarea>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="inputNama" class="col-sm-2 col-form-label">Data Dukung Laporan :</label>
                                  <div class="col-sm-6">
                                    <input type="file" name="data_dukung" required class="form-control" id="file" onchange="return fileValidation()" placeholder=".......">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis Pelanggaran :</label>
                                  <div class="col-sm-10">
                                    <?php
                                      foreach ($data['jenis_pelanggaran'] as $row) {
                                    ?>
                                      <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="pelanggaran[]" id="<?= $row->id ?>" value="<?= $row->pelanggaran ?>">
                                        <label class="form-check-label" for="<?= $row->id ?>">
                                          <?= $row->pelanggaran ?>
                                        </label>
                                      </div>
                                    <?php } ?>
                                  </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Buat Laporan</button>
                                    <a href="<?= URLROOT; ?>/whistle" class="btn btn-danger">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
        </div>
    </div>
</section>
<?php require APPROOT . '/views/inc/footer.php'; ?>