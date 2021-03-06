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
                            <form role="form" action="<?= URLROOT; ?>/surattugas/nomorsurat/<?= $data['laporan']->id; ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" value="<?= $data['laporan']->id ?>" name="id">
                                  <div class="form-group row">
                                <label for="nomor_surat" class="col-sm-2 col-form-label">Nomor Surat<span class="text-danger">*</span> :</label>
                                <div class="col-sm-1">
                                <input type="text" name="nomor_surat[]" required class="form-control" id="nomor_surat">
                                </div>
                                <div class="col-sm-3">
                                <input type="text" name="nomor_surat[]" required class="form-control" value="/BSKJI/BSPJI-BANJARBARU/KU/" readonly>
                                </div>
                                <div class="col-sm-2">
                                <input type="text" name="nomor_surat[]" required class="form-control" placeholder="ex: III" id="nomor_surat">
                                </div>
                                <div class="col-sm-2">
                               <input type="text" name="nomor_surat[]" required class="form-control" readonly value="/<?= date('Y') ?>">
                              </div>
                              </div>
                                <?php if($data['laporan']->is_biaya){ ?>
                                  <div class="form-group row">
                                    <label for="file" class="col-sm-2 col-form-label">Surat Tugas :</label>
                                    <div class="col-sm-6">
                                      <input type="file" name="file_st" required class="form-control" onchange="return fileValidation()" id="file" placeholder=".......">
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="file" class="col-sm-2 col-form-label">Surat Perjalanan Dinas :</label>
                                    <div class="col-sm-6">
                                      <input type="file" name="file_spd" required class="form-control" onchange="return fileValidation2()" id="file2" placeholder=".......">
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="file" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-6">
                                      <input type="file" name="file_spd2" required class="form-control" onchange="return fileValidation2()" id="file2" placeholder=".......">
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="file" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-6">
                                      <input type="file" name="file_spd3" required class="form-control" onchange="return fileValidation2()" id="file2" placeholder=".......">
                                    </div>
                                  </div>
                                <?php } ?>
                                <div class="row mb-3 text-center border-bottom-light">
                                  <label for="pengusul" class="col-sm-2 col-form-label"></label>
                                  <h4 class="col-sm-6">Detail Surat Tugas</h2>
                                </div>
                                <input type="hidden" name="id" value="<?= $data['laporan']->id; ?>">
                                <div class="row mb-3">
                                  <label for="pengusul" class="col-sm-2 col-form-label">Pengusul</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="pengusul" required class="form-control" id="pengusul" value="<?= $data['laporan']->nama ?> / <?= $data['laporan']->pengusul ?>" readonly>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="nama_ditugaskan" class="col-sm-2 col-form-label">Nama yang Ditugaskan</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="nama_ditugaskan" required class="form-control" id="nama_ditugaskan" value="<?= $data['ditugaskan']->nama ?> / <?= $data['laporan']->nip_ditugaskan ?>" readonly>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="tujuan_tugas" class="col-sm-2 col-form-label">Tujuan Tugas</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="tujuan_tugas" required class="form-control" id="tujuan_tugas" value="<?= $data['laporan']->tujuan_tugas ?>" readonly>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="keperluan_tugas" class="col-sm-2 col-form-label">Keperluan Tugas</label>
                                  <div class="col-sm-6">
                                    <textarea type="text" name="keperluan_tugas" required class="form-control" id="keperluan_tugas"  readonly><?= $data['laporan']->keperluan_tugas ?></textarea>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="waktu" class="col-sm-2 col-form-label">Tanggal Berangkat </label>
                                  <div class="col-sm-6">
                                    <input type="text" name="tanggal_berangkat" required class="form-control" id="tanggal_berangkat" readonly value="<?= $data['laporan']->tanggal_berangkat?>">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="waktu" class="col-sm-2 col-form-label">Tanggal Kembali </label>
                                  <div class="col-sm-6">
                                    <input type="text" name="tanggal_kembali" required class="form-control" id="tanggal_kembali" readonly value="<?= $data['laporan']->tanggal_kembali?>">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="waktu" class="col-sm-2 col-form-label">Lama Tugas </label>
                                  <div class="col-sm-6">
                                    <input type="text" name="lama_tugas" required class="form-control" id="lama_tugas" readonly value="<?= $data['laporan']->lama_tugas?>">
                                  </div>
                                </div>
                              <div class="form-group row">
                                <label for="inputInstansiDituju" class="col-sm-2 col-form-label">Instansi Dituju :</label>
                                <div class="col-sm-6">
                                  <input type="text" name="instansi_dituju" required class="form-control" id="inputInstansiDituju" value="<?= $data['laporan']->instansi_dituju?>" readonly>
                                </div>
                              </div>
                              <fieldset class="form-group">
                                <div class="row">
                                  <legend class="col-form-label col-sm-2 pt-0">Jenis Surat Tugas :</legend>
                                  <div class="col-sm-6">
                                      <label class="">
                                        <?php
                                        if($data['laporan']->is_biaya){
                                          echo 'Surat Tugas Dengan Biaya';
                                        }else{
                                          echo 'Surat Tugas Tanpa Biaya';
                                        }
                                        ?>
                                      </label>
                                  </div>
                                </div>
                              </fieldset>
                              <div class="form-group row">
                                <label for="pengikut" class="col-lg-2 col-form-label">Nama Pengikut :</label>
                                <div class="col-sm-6">
                                  <ul>
                                  <?php
                                  foreach ($data['pengikut'] as $p) {
                                    echo '<li>'.$p->nama.' / '.$p->nip.')</li>';
                                  }
                                  ?>
                                  </ul>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="file" class="col-sm-2 col-form-label">Dasar Surat :</label>
                                <div class="col-sm-6">
                                  <a href="<?= URLROOT ?>/public/files/dasar_surat/<?= $data['laporan']->dasar_surat; ?>" style="background-color:#2980b9;color:white;border-radius:5px;padding:5px 10px;"><?= $data['laporan']->dasar_surat ?></a>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="inputDetailPerjalanan" class="col-sm-2 col-form-label">Detail Perjalanan :</label>
                                <div class="col-sm-6">
                                  <textarea name="detail_perjalanan" required class="form-control" id="inputDetailPerjalanan" placeholder="Masukkan detail perjalanan..." readonly><?= $data['laporan']->detail_perjalanan ?></textarea>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="nama_ppk" class="col-sm-2 col-form-label">Nama PPK</label>
                                <div class="col-sm-6">
                                  <input type="text" name="nama_ppk" required class="form-control" id="nama_ppk" value="<?= $data['ppk']->nama?>" readonly>
                                </div>
                              </div>
                              <?php if($data['laporan']->is_biaya){ ?>
                                <div class="form-group row">
                                  <label for="anggaran" class="col-sm-2 col-form-label">Anggaran :</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="anggaran" required class="form-control" id="anggaran" value="<?=($data['laporan']->anggaran) ?>" readonly>
                                  </div>
                                </div>
                              <?php } ?>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="<?= URLROOT; ?>/surattugas" class="btn btn-danger">Kembali</a>
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
    document.getElementById("alasan_ditolak").value = "";
  }
</script>