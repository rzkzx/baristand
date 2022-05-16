<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
      <div class="col-lg-12">
                  <div class="card mb-4">
                      <div class="card-body">
                          <div class="col-md-8">
                              <?php flash(); ?>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          <form role="form" action="<?= URLROOT; ?>/surattugas/add" method="POST" enctype="multipart/form-data">
                              <div class="form-group row">
                                <label for="pengusul" class="col-lg-2 col-form-label">Nama Pengusul :<span class="text-danger">*</span> :</label>
                                <div class="col-sm-6">
                                  <select class="select2-pengusul form-control" style="width:100%;" name="pengusul" id="select2SinglePlaceholder">
                                        <option></option>
                                    <?php 
                                      foreach ($data['pengusul'] as $k) {
                                      ?>
                                          <option value="<?= $k->nip ?>"><?= $k->nama ?> / <?= $k->nip ?></option>
                                      <?php
                                      }
                                    ?>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="pengusul" class="col-lg-2 col-form-label">Nama yang Ditugaskan :<span class="text-danger">*</span> :</label>
                                <div class="col-sm-6">
                                  <select class="select2-pemohon form-control" style="width:100%;" name="nip_ditugaskan" id="select2SinglePlacehold">
                                        <option></option>
                                    <?php 
                                      foreach ($data['pemohon'] as $k) {
                                      ?>
                                          <option value="<?= $k->nip ?>"><?= $k->nama ?> / <?= $k->nip ?></option>
                                      <?php
                                      }
                                    ?>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="inputTujuanTugas" class="col-sm-2 col-form-label">Tujuan Tugas :</label>
                                <div class="col-sm-6">
                                  <input type="text" name="tujuan_tugas" required class="form-control" id="inputTujuanTugas" placeholder="Masukkan Tujuan Tugas...">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="inputKeperluanTugas" class="col-sm-2 col-form-label">Keperluan Tugas :</label>
                                <div class="col-sm-6">
                                  <textarea name="keperluan_tugas" required class="form-control" id="inputKeperluanTugas" placeholder="Masukkan Keperluan Tugas..."></textarea>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="inputtanggalberangkat" class="col-sm-2 col-form-label">Tanggal Berangkat :</label>
                                <div class="col-sm-6">
                                  <input type="date" name="tanggal_berangkat" required class="form-control" id="inputtanggalberangkat" placeholder="Masukkan tanggal berangkat...">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="inputtanggalkembali" class="col-sm-2 col-form-label">Tanggal Kembali :</label>
                                <div class="col-sm-6">
                                  <input type="date" name="tanggal_kembali" required class="form-control" id="inputtanggalkembali" placeholder="Masukkan tanggal kembali...">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="inputInstansiDituju" class="col-sm-2 col-form-label">Instansi Dituju :</label>
                                <div class="col-sm-6">
                                  <input type="text" name="instansi_dituju" required class="form-control" id="inputInstansiDituju" placeholder="Masukkan instansi yang dituju...">
                                </div>
                              </div>
                              <fieldset class="form-group">
                                <div class="row">
                                  <legend class="col-form-label col-sm-2 pt-0">Jenis Surat Tugas :</legend>
                                  <div class="col-sm-6">
                                    <div class="custom-control custom-radio">
                                      <input type="radio" id="isBiaya" name="is_biaya" value="1" class="custom-control-input" checked>
                                      <label class="custom-control-label" for="isBiaya">ST Dengan Biaya(Sampling)</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                      <input type="radio" id="isBiaya" name="is_biaya" value="1" class="custom-control-input" checked>
                                      <label class="custom-control-label" for="isBiaya">ST Dengan Biaya(Non Sampling)</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                      <input type="radio" id="isNotBiaya" name="is_biaya" value="0" class="custom-control-input">
                                      <label class="custom-control-label" for="isNotBiaya">ST Tanpa Biaya</label>
                                    </div>
                                  </div>
                                </div>
                              </fieldset>
                              <div class="form-group row">
                                <label for="pengikut" class="col-lg-2 col-form-label">Nama Pengikut :</label>
                                <div class="col-sm-6">
                                <select class="select2-multiple form-control" name="pengikut[]" multiple="multiple"
                                  id="select2Multiple">
                                  <?php 
                                      foreach ($data['pengikut'] as $k) {
                                      ?>
                                          <option value="<?= $k->nip ?>"><?= $k->nama ?> / <?= $k->nip ?></option>
                                      <?php
                                      }
                                    ?>
                                </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="file" class="col-sm-2 col-form-label">Dasar Surat :</label>
                                <div class="col-sm-6">
                                  <input type="file" name="dasar_surat" required class="form-control" onchange="return fileValidation()" id="file" placeholder=".......">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="inputDetailPerjalanan" class="col-sm-2 col-form-label">Detail Perjalanan :</label>
                                <div class="col-sm-6">
                                  <textarea name="detail_perjalanan" required class="form-control" id="inputDetailPerjalanan" placeholder="Masukkan detail perjalanan..."></textarea>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="nip_ppk" class="col-lg-2 col-form-label">Nama PPK :<span class="text-danger">*</span> :</label>
                                <div class="col-sm-6">
                                  <select class="select2-ppk form-control" style="width:100%;" name="nip_ppk">
                                        <option></option>
                                    <?php 
                                      foreach ($data['ppk'] as $k) {
                                      ?>
                                          <option value="<?= $k->nip ?>"><?= $k->nama ?> / <?= $k->nip ?></option>
                                      <?php
                                      }
                                    ?>
                                  </select>
                                </div>
                              </div>

                              <!-- /.card-body -->
                              <div class="card-footer">
                                  <button type="submit" class="btn btn-primary">Buat Pengajuan</button>
                                  <a href="<?= URLROOT; ?>/surattugas" class="btn btn-danger">Kembali</a>
                              </div>
                          </form>
                      </div>
                  </div>
      </div>
  </div>
  <?php require APPROOT . '/views/inc/footer.php'; ?>