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
                            <form role="form" action="<?= URLROOT; ?>/pengadaan/accDisposisi" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="serial" value="<?= $data['pengadaan']->serial_number; ?>">
                                <div class="row mb-3">
                                  <label for="nip_pemohon" class="col-sm-2 col-form-label">Pemohon</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="nip_pemohon" required class="form-control" id="nip_pemohon" value="<?= $data['pengadaan']->nama ?>" readonly>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="waktu" class="col-sm-2 col-form-label">Waktu Validasi Kepala Balai</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="tanggal" required class="form-control" id="tanggal" readonly value="<?= $data['pengadaan']->waktu_validasi3?>">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="nip_pemohon" class="col-sm-2 col-form-label">Catatan</label>
                                  <div class="col-sm-6">
                                    <textarea  type="text" name="validasi1" required class="form-control" id="validasi1"readonly><?= $data['pengadaan']->validasi1 ?></textarea >
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label class="col-sm-2 col-form-label"></label>
                                  <div class="col-sm-6">
                                  <table class="table table-striped">
                                  <tr>
                                    <th>#</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                   <th>Keterangan</th>
                                  </tr>
                                  <?php
                                  $array = explode('.',$data['pengadaan']->keterangan);
                                    foreach($array as $k){
                                    if($k){
                                      $v = explode(',',$k);?>

                                  <tr>
                                    <td><?php echo $v[0] ?></td>
                                    <td><?php echo $v[1] ?></td>
                                    <td><?php echo $v[2] ?></td>
                                    <td><?php echo $v[3] ?></td>
                                  </tr>
                                  <?php } }?>
                                  </table>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="inputNama" class="col-sm-2 col-form-label">Pejabat Pengadaan<span class="text-danger">*</span></label>
                                  <div class="col-sm-6">
                                    <select class="select2-penanggung form-control" name="nip_penanggung" id="select2">
                                    <option value=""></option>
                                      <?php 
                                        foreach ($data['penanggung'] as $k) {
                                        ?>
                                            <option value="<?= $k->nip ?>"><?= $k->nama ?> (<?= $k->nip ?>)</option>
                                        <?php
                                        }
                                      ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="catatan" class="col-sm-2 col-form-label">Catatan kepada Pejabat Pegadaan</label>
                                  <div class="col-sm-6">
                                    <textarea type="text" name="disposisi" required class="form-control" id="disposisi" placeholder="Tulis Catatan..."></textarea>
                                  </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="row mb-3">
                                  <label for="inputUraian" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="<?= URLROOT; ?>/pengadaan" class="btn btn-danger">Kembali</a>
                                </div>
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