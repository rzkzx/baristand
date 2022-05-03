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
                          <form role="form" action="<?= URLROOT; ?>/ijinlembur/add" method="POST" enctype="multipart/form-data">
                              <div class="form-group row">
                                <label for="pengikut" class="col-lg-2 col-form-label">Pemohon<span class="text-danger">*</span></label>
                                <div class="col-sm-6">
                                <select class="select2-multiple form-control" name="pemohon[]" multiple="multiple"
                                  id="select2Multiple">
                                  <!-- <option value="">Select</option> -->
                                  <?php 
                                      foreach ($data['pemohon'] as $k) {
                                      ?>
                                          <option value="<?= $k->nip ?>" <?php if($_SESSION['nip'] == $k->nip) echo "selected" ?> ><?= $k->nama ?> / <?= $k->nip ?></option>
                                      <?php
                                      }
                                    ?>
                                </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="keperluan" class="col-sm-2 col-form-label">Keperluan<span class="text-danger">*</span></label>
                                <div class="col-sm-6">
                                  <textarea type="text" name="keperluan" required class="form-control" id="keperluan" placeholder="Tulis keperluan..."></textarea>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-6">
                                  <textarea type="text" name="keterangan" class="form-control" id="keterangan" placeholder="Tulis keterangan..."></textarea>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="tanggal_ijin" class="col-sm-2 col-form-label">Tanggal Ijin<span class="text-danger">*</span></label>
                                <div class="col-sm-6">
                                  <input type="date" name="tanggal_ijin" required class="form-control" id="tanggal_ijin" >
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="jam_mulai" class="col-sm-2 col-form-label">Jam Mulai<span class="text-danger">*</span></label>
                                <div class="col-sm-6">
                                  <input type="time" name="jam_mulai" required class="form-control" id="jam_mulai" >
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="jam_berakhir" class="col-sm-2 col-form-label">Jam Berakhir<span class="text-danger">*</span></label>
                                <div class="col-sm-6">
                                  <input type="time" name="jam_berakhir" required class="form-control" id="jam_berakhir" >
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="atasan" class="col-lg-2 col-form-label">Atasan Langsung<span class="text-danger">*</span></label>
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
                              <!-- /.card-body -->
                              <div class="card-footer">
                                  <button type="submit" class="btn btn-primary"> + Buat Ijin</button>
                                  <a href="<?= URLROOT; ?>/ijinlembur" class="btn btn-danger">Batal</a>
                              </div>
                          </form>
                      </div>
                  </div>
              <!-- /.content -->
      </div>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>