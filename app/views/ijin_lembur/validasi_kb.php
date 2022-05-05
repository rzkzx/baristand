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
                            <form role="form" action="<?= URLROOT; ?>/ijinlembur/validasi_kb/<?= $data['id'] ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $data['ijin_lembur']->id; ?>">
                                <div class="row mb-3">
                                  <label for="pemohon" class="col-sm-2 col-form-label">Pemohon :</label>
                                  <div class="col-sm-6">
                                    <ul style="padding: 0; margin: 0;">
                                      <?php foreach ($data['pemohon'] as $k) {
                                          echo '<li style="list-style-type:none;">'.$k->nama.' / '. $k->nip .'</li>';
                                      } ?>
                                    </ul>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="keperluan" class="col-sm-2 col-form-label">Keperluan :</label>
                                  <div class="col-sm-6">
                                    <textarea type="text" name="keperluan" required class="form-control" id="keperluan" placeholder="Tulis keperluan..." readonly><?= $data['ijin_lembur']->keperluan; ?></textarea>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="keterangan" class="col-sm-2 col-form-label">Keterangan :</label>
                                  <div class="col-sm-6">
                                    <textarea type="text" name="keterangan" required class="form-control" id="keterangan" placeholder="-" readonly><?= $data['ijin_lembur']->keterangan ?></textarea>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="tanggal_ijin" class="col-sm-2 col-form-label">Tanggal Ijin :</label>
                                  <div class="col-sm-6">
                                    <input type="date" name="tanggal_ijin" required class="form-control" id="tanggal_ijin" readonly value="<?= $data['ijin_lembur']->tanggal_ijin ?>">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="jam_mulai" class="col-sm-2 col-form-label">Jam Mulai :</label>
                                  <div class="col-sm-6">
                                    <input type="time" name="jam_mulai" required class="form-control" id="jam_mulai" readonly value="<?= $data['ijin_lembur']->jam_mulai ?>">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="jam_kembali" class="col-sm-2 col-form-label">Jam Berakhir :</label>
                                  <div class="col-sm-6">
                                    <input type="time" name="jam_kembali" required class="form-control" id="jam_kembali" readonly value="<?= $data['ijin_lembur']->jam_berakhir ?>">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="jam_kembali" class="col-sm-2 col-form-label">Validasi Atasan :</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="validasi_atasan_langsung" required class="form-control" id="validasi_atasan_langsung" readonly value="<?= $data['ijin_lembur']->validasi_atasan_langsung.', '.$data['ijin_lembur']->waktu_validasi_atasan_langsung ?>">
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
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="<?= URLROOT; ?>/ijinlembur" class="btn btn-danger">Kembali</a>
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