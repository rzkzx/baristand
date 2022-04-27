<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="row">
      <div class="col-lg-12">
              <!-- Main content -->
                  <div class="card mb-4">
                      <div class="card-body">
                          <div class="col-md-8">
                              <?php flash(); ?>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          <form role="form" action="<?= URLROOT; ?>/ijinkeluar/add" method="POST" enctype="multipart/form-data">
                              <input type="hidden" name="pemohon" value="<?= $_SESSION['nip'] ?>">
                              <div class="form-group row">
                                <label for="keperluan" class="col-sm-2 col-form-label">Keperluan :</label>
                                <div class="col-sm-6">
                                  <textarea type="text" name="keperluan" required class="form-control" id="keperluan" placeholder="Tulis keperluan..."></textarea>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="tanggal_ijin" class="col-sm-2 col-form-label">Tanggal Ijin :</label>
                                <div class="col-sm-6">
                                  <input type="date" name="tanggal_ijin" required class="form-control" id="tanggal_ijin" >
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="jam_keluar" class="col-sm-2 col-form-label">Jam Keluar :</label>
                                <div class="col-sm-6">
                                  <input type="time" name="jam_keluar" required class="form-control" id="jam_keluar" >
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="jam_kembali" class="col-sm-2 col-form-label">Jam Kembali :</label>
                                <div class="col-sm-6">
                                  <input type="time" name="jam_kembali" required class="form-control" id="jam_kembali" >
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="atasan" class="col-sm-2 col-form-label">Atasan Langsung :</label>
                                <div class="col-sm-6">
                                  <select class="select2-atasan form-control" name="pejabat_validasi" id="select2SinglePlaceholder">
                                    <option value=""></option>
                                    <?php 
                                      foreach ($data['atasan'] as $k) {
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
                                <button type="submit" class="btn btn-primary">+ Buat Ijin</button>
                                <a href="<?= URLROOT; ?>/ijinkeluar" class="btn btn-danger">Batal</a>
                                </div>
                            </div>
                          </form>
                      </div>
                  </div>
              <!-- /.content -->
      </div>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>