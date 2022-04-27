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
                            <form role="form" action="<?= URLROOT; ?>/gratifikasi/tindakan/<?= $data['gratifikasi']->id ?>" method="POST" enctype="multipart/form-data">
                                <div class="row mb-3 ml-2 font-weight-bold sub-title">
                                  <h4>Data Pemberian Gratifikasi</h4>
                                </div>
                                <input type="hidden" name="id" value="<?= $data['gratifikasi']->id ?>">
                                <div class="row mb-3">
                                  <label for="inputNama" class="col-sm-2 col-form-label">Jenis Penerimaan :</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="jenis_penerimaan" required class="form-control" id="inputHarga" value="<?= $data['gratifikasi']->jenis_penerimaan ?>" readonly>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="inputUraian" class="col-sm-2 col-form-label">Uraian :</label>
                                  <div class="col-sm-6">
                                    <textarea type="text" name="uraian" required class="form-control" id="inputUraian" placeholder="Tulis uraian..." readonly><?= $data['gratifikasi']->uraian ?></textarea>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="inputHarga" class="col-sm-2 col-form-label">Harga/Nominal/Taksiran :</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="taksiran" required class="form-control" id="inputHarga" value="<?= rupiah($data['gratifikasi']->taksiran) ?>" readonly>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="inputNama" class="col-sm-2 col-form-label">Jenis Peristiwa :</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="jenis_peristiwa" required class="form-control" id="inputHarga" value="<?= $data['gratifikasi']->jenis_peristiwa ?>" readonly>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="inputTempatPenerimaan" class="col-sm-2 col-form-label">Tempat Penerimaan :</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="tempat_penerimaan" required class="form-control" id="inputTempatPenerimaan" value="<?= $data['gratifikasi']->tempat_penerimaan ?>" readonly>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="tanggal" class="col-sm-2 col-form-label">Tanggal :</label>
                                  <div class="col-sm-6">
                                    <input type="date" name="tanggal" required class="form-control" id="tanggal" value="<?= $data['gratifikasi']->tanggal ?>" readonly>
                                  </div>
                                </div>
                                <div class="row mb-3 mt-4 ml-2 font-weight-bold sub-title">
                                  <h4>Data Penerima dan Pemberi Gratifikasi</h4>
                                </div>
                                <div class="row mb-3">
                                  <label for="penerima" class="col-sm-2 col-form-label">Nama Penerima :</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="penerima" required class="form-control" id="penerima" value="<?= $data['gratifikasi']->penerima ?>" readonly>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="pemberi" class="col-sm-2 col-form-label">Pemberi :</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="pemberi" required class="form-control" id="pemberi" value="<?= $data['gratifikasi']->pemberi ?>" readonly>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan :</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="pekerjaan" required class="form-control" id="pekerjaam" value="<?= $data['gratifikasi']->pekerjaan ?>" readonly>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="jabatan" class="col-sm-2 col-form-label">Jabatan :</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="jabatan" required class="form-control" id="jabatan" value="<?= $data['gratifikasi']->jabatan ?>" readonly>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="alamat" class="col-sm-2 col-form-label">Alamat :</label>
                                  <div class="col-sm-6">
                                    <textarea type="text" name="alamat" required class="form-control" id="alamat" readonly><?= $data['gratifikasi']->alamat ?></textarea>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="telepon" class="col-sm-2 col-form-label">Telepon :</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="telepon" required class="form-control" id="telepon" value="<?= $data['gratifikasi']->telepon ?>" readonly>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="email" class="col-sm-2 col-form-label">Email :</label>
                                  <div class="col-sm-6">
                                    <input type="email" name="email" required class="form-control" id="email" value="<?= $data['gratifikasi']->email ?>" readonly>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="hubungan" class="col-sm-2 col-form-label">Hubungan :</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="hubungan" required class="form-control" id="hubungan" value="<?= $data['gratifikasi']->hubungan ?>" readonly>
                                  </div>
                                </div>
                                <div class="row mb-3 mt-4 ml-2 font-weight-bold sub-title">
                                  <h4>Alasan dan Kronologi</h4>
                                </div>
                                <div class="row mb-3">
                                  <label for="alasan_pemberian" class="col-sm-2 col-form-label">Alasan Pemberian :</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="alasan_pemberian" required class="form-control" id="alasan_pemberian" value="<?= $data['gratifikasi']->alasan_pemberian ?>" readonly>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="kroonologi_penerimaan" class="col-sm-2 col-form-label">Kronologi Penerimaan :</label>
                                  <div class="col-sm-6">
                                    <textarea type="text" name="kronologi_penerimaan" required class="form-control" id="kroonologi_penerimaan" readonly><?= $data['gratifikasi']->kronologi_penerimaan ?></textarea>
                                  </div>
                                </div>
                                <div class="row mb-3 mt-4 ml-2 font-weight-bold sub-title">
                                  <h4>Tindakan oleh Tim FKAP</h4>
                                </div>
                                <div class="row mb-3">
                                  <label for="tindakan" class="col-sm-2 col-form-label">Tindakan :</label>
                                  <div class="col-sm-6">
                                    <textarea type="text" name="tindakan" required class="form-control" id="tindakan"></textarea>
                                  </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Tindak Lanjuti</button>
                                    <a href="<?= URLROOT; ?>/gratifikasi/laporan" class="btn btn-danger">Kembali</a>
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