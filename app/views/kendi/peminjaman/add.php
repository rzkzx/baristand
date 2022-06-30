<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><?= $data['title']; ?></h6>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <?php flash(); ?>
            </div>
            <form action="<?= URLROOT; ?>/kendi/addkendaraan" method="POST" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="atasan" class="col-sm-2 col-form-label">Kendaraan</label>
                <label for="col-sm-2">:</label>
                <div class="col-sm-6">
                    <select class="select2-kend form-control" name="kendaraan" id="select2SinglePlaceholder">
                    <option value=""></option>
                    <?php 
                        foreach ($data['kend'] as $k) {
                        ?>
                            <option value="<?= $k->id ?>"><?= $k->merk ?> / <?= $k->tipe ?> / <?= $k->nopol ?></option>
                        <?php
                        }
                    ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="validasi" class="col-sm-2 col-form-label">Keperluan</label>
                <label for="col-sm-2">:</label>
                <div class="col-sm-6">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="keperluan" id="kedinasan" value="Kedinasan" onchange="showKeterangan()" checked>
                        <label class="form-check-label" for="kedinasan">
                        Kedinasan
                        </label>
                        <textarea type="text" name="keterangan" required class="form-control" id="keterangan" placeholder="Masukkan keterangan"></textarea>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="keperluan" value="Pemeliharaan/Perbaikan" id="pemeliharaan" onchange="hideKeterangan()">
                        <label class="form-check-label" for="pemeliharaan">
                        Pemeliharaan / Perbaikan
                        </label>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="validasi" class="col-sm-2 col-form-label">Lama Peminjaman</label>
                <label for="col-sm-2">:</label>
                <div class="col-sm-6">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_peminjaman" id="jam" value="jam" onchange="showJam()" checked>
                        <label class="form-check-label" for="jam">
                        Jam
                        </label>
                        <textarea type="text" name="keterangan" required class="form-control" id="keterangan" placeholder="Masukkan keterangan"></textarea>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_peminjaman" value="harian" id="harian" onchange="hideHarian()">
                        <label class="form-check-label" for="harian">
                        Harian
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="tgl_pajak" class="col-sm-2 col-form-label">Tgl. Bayar Pajak :</label>
                <label for="col-sm-2">:</label>
                <div class="col-sm-6">
                <input type="date" class="form-control" id="tgl_pajak" name="tgl_pajak" required>
                </div>
            </div>
            <div class="pb-4"></div>
            <div class="form-group row">
                <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Tambah</button>
                <a href="<?= URLROOT; ?>/kendi/kendaraan" class="btn btn-danger">Kembali</a>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
<script>
  function showKeterangan(){
    document.getElementById("keterangan").value = "";
    document.getElementById("keterangan").readOnly = false;
    document.getElementById("keterangan").style.display = 'block';
  }
  function hideKeterangan(){
    document.getElementById("keterangan").readOnly = true;
    document.getElementById("keterangan").value = "";
    document.getElementById("keterangan").style.display = 'none';
  }
</script>