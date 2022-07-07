<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-body">
            <div class="col-md-12">
                <?php flash(); ?>
            </div>
            <form action="<?= URLROOT; ?>/kendi/validasitu/<?= $data['id'] ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $data['id'] ?>">
            <input type="hidden" name="id_kendaraan" value="<?= $data['peminjaman']->id_kendaraan ?>">
            <div class="form-group row">
                <label for="atasan" class="col-sm-2 col-form-label">Kendaraan</label>
                <label for="col-sm-2"> : </label>
                <div class="col-sm-6">
                  <?php $kend = $data['kend']; ?>
                  <input type="text" name="jam_kembali" required class="form-control" id="jam_kembali" readonly value="<?= $kend->merk.' / '.$kend->tipe.' / '.$kend->nopol ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="validasi" class="col-sm-2 col-form-label">Keperluan</label>
                <label for="col-sm-2">:</label>
                <div class="col-sm-6">
                  <b><?= $data['peminjaman']->keperluan ?></b>
                  <?php
                  if($data['peminjaman']->keterangan){
                      echo '<br>('.$data['peminjaman']->keterangan.')';
                  }
                  ?>
                </div>
            </div>
            <div class="row mb-3">
                <label for="validasi" class="col-sm-2 col-form-label">Lama Peminjaman</label>
                <label for="col-sm-2">:</label>
                <div class="col-sm-6">
                  Jenis Peminjaman : <b><?= $data['peminjaman']->jenis_peminjaman ?></b>
                  <br>
                  <?php if($data['peminjaman']->jenis_peminjaman == 'Jam'){ ?>
                      Tanggal : <b><?= dateID($data['peminjaman']->tanggal) ?></b><br>
                      Jam Mulai : <b><?= timeID($data['peminjaman']->jam_mulai) ?></b><br>
                      Jam Selesai : <b><?= timeID($data['peminjaman']->jam_selesai) ?></b><br>
                  <?php }else{ ?>
                      Tanggal Mulai : <b><?= dateID($data['peminjaman']->tgl_mulai) ?></b><br>
                      Tanggal Selesai : <b><?= dateID($data['peminjaman']->tgl_selesai) ?></b><br>
                  <?php } ?>
                </div>
            </div>
            <input type="hidden" name="pemohon" value="<?= $data['peminjaman']->pemohon ?>">
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
            <div class="pb-4"></div>
            <div class="form-group row">
                <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Validasi</button>
                <a href="<?= URLROOT; ?>/kendi" class="btn btn-danger">Kembali</a>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
<script>
  function showAlasan(){
    document.getElementById("alasan_ditolak").readOnly = false;
  }
  function hideAlasan(){
    document.getElementById("alasan_ditolak").readOnly = true;
  }
</script>