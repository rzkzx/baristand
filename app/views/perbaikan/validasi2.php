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
                            <form role="form" action="<?= URLROOT; ?>/perbaikan/validasi2/<?= $data['perbaikan']->serial_number; ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="serial_number" value="<?= $data['perbaikan']->serial_number; ?>">
                                <div class="row mb-3">
                                  <label for="nip_pemohon" class="col-sm-2 col-form-label">Pemohon</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="nip_pemohon" required class="form-control" id="nip_pemohon" value="<?= $data['perbaikan']->nama ?>" readonly>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="waktu" class="col-sm-2 col-form-label">Waktu Validasi AL</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="tanggal" required class="form-control" id="tanggal" readonly value="<?= $data['perbaikan']->waktu_validasi1?>">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label class="col-sm-2 col-form-label"></label>
                                  <div class="col-sm-6">
                                  <table class="table">
                                  <thead class="thead-light">
                                  <tr>
                                    <th>#</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                   <th>Keterangan</th>
                                  </tr>
                                  <?php
                                  $array = explode('.',$data['perbaikan']->keterangan);
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
                                  <label for="nip_pemohon" class="col-sm-2 col-form-label">Atasan Langsung</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="nip_atasan" required class="form-control" id="nip_atasan" value="<?= $data['atasan']->nama ?>" readonly>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="validasi" class="col-sm-2 col-form-label">Validasi</label>
                                  <div class="col-sm-6">
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="status" id="status" value="Disetujui kepala balai" onchange="hideAlasanCatatan()" checked>
                                      <label class="form-check-label" for="validasih">
                                        Diterima
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="status" value="Ditolak kepala balai" id="status" onchange="showAlasanCatatan()">
                                      <label class="form-check-label" for="validasis">
                                        Ditolak
                                      </label>
                                    </div>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="alasan_catatan" class="col-sm-2 col-form-label">Catatan Kepada Kesubag</label>
                                  <div class="col-sm-6">
                                    <textarea type="text" name="validasi2" required class="form-control" id="validasi2" placeholder="Tulis Catatan..."></textarea>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="alasan_ditolak" class="col-sm-2 col-form-label">Alasan Ditolak</label>
                                  <div class="col-sm-6">
                                    <textarea type="text" name="alasan2" required class="form-control" id="alasan2" placeholder="Tulis Alasan ditolak..." readonly></textarea>
                                  </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="row mb-3">
                                  <label for="inputUraian" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="<?= URLROOT; ?>/perbaikan" class="btn btn-danger">Kembali</a>
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
<script>
  function showAlasanCatatan(){
    document.getElementById("validasi2").readOnly = true;
    document.getElementById("validasi2").value = "";
    document.getElementById("alasan2").readOnly = false;
  }
  function hideAlasanCatatan(){
    document.getElementById("validasi2").readOnly = false;
    document.getElementById("alasan2").readOnly = true;
    document.getElementById("alasan2").value = "";
  }
</script>