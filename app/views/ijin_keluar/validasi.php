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
                            <form role="form" action="<?= URLROOT; ?>/ijinkeluar/validasi/<?= $data['id'] ?>" method="POST" enctype="multipart/form-data">
                                <div class="row mb-3">
                                </div>
                                <input type="hidden" name="id" value="<?= $data['id']; ?>">
                                <div class="row mb-3">
                                  <label for="pemohon" class="col-sm-2 col-form-label">Pemohon :</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="pemohon" required class="form-control" id="pemohon" value="<?= $data['ijin_keluar']->nama ?>" readonly>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="keperluan" class="col-sm-2 col-form-label">Keperluan :</label>
                                  <div class="col-sm-6">
                                    <textarea type="text" name="keperluan" required class="form-control" id="keperluan" placeholder="Tulis keperluan..." readonly><?= $data['ijin_keluar']->keperluan ?></textarea>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="tanggal_ijin" class="col-sm-2 col-form-label">Tanggal Ijin :</label>
                                  <div class="col-sm-6">
                                    <input type="date" name="tanggal_ijin" required class="form-control" id="tanggal_ijin" readonly value="<?= $data['ijin_keluar']->tanggal_ijin ?>">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="jam_keluar" class="col-sm-2 col-form-label">Jam Keluar :</label>
                                  <div class="col-sm-6">
                                    <input type="time" name="jam_keluar" required class="form-control" id="jam_keluar" readonly value="<?= $data['ijin_keluar']->jam_keluar ?>">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="jam_kembali" class="col-sm-2 col-form-label">Jam Kembali :</label>
                                  <div class="col-sm-6">
                                    <input type="time" name="jam_kembali" required class="form-control" id="jam_kembali" readonly value="<?= $data['ijin_keluar']->jam_kembali ?>">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="validasi" class="col-sm-2 col-form-label">Validasi :</label>
                                  <div class="col-sm-6">
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="validasi" id="validasi1" value="Diterima" onchange="hideAlasan()" checked>
                                      <label class="form-check-label" for="validasi1">
                                        Diterima
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="validasi" value="Ditolak" id="validasi2" onchange="showAlasan()">
                                      <label class="form-check-label" for="validasi2">
                                        Ditolak
                                      </label>
                                    </div>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="alasan_ditolak" class="col-sm-2 col-form-label">Alasan Ditolak :</label>
                                  <div class="col-sm-6">
                                    <textarea type="text" name="alasan_ditolak" required class="form-control" id="alasan_ditolak" placeholder="Tulis Alasan ditolak..." readonly></textarea>
                                  </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Validasi</button>
                                    <a href="<?= URLROOT; ?>/ijinkeluar/listvalidasi" class="btn btn-danger">Kembali</a>
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
<script>
  function showAlasan(){
    document.getElementById("alasan_ditolak").readOnly = false;
  }
  function hideAlasan(){
    document.getElementById("alasan_ditolak").readOnly = true;
  }
</script>