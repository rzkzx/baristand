<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-body">
            <div class="col-md-12">
                <?php flash(); ?>
            </div>
            <form action="<?= URLROOT; ?>/kendi/addpeminjaman" method="POST" enctype="multipart/form-data">
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
                        <textarea type="text" name="keterangan" class="form-control" id="keterangan" placeholder="Masukkan keterangan"></textarea>
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
                        <input class="form-check-input" type="radio" name="jenis_peminjaman" id="jam" value="Jam" onchange="showJam()" checked>
                        <label class="form-check-label" for="jam">
                        Jam
                        </label>
                        <div class="jam-form" id="jam-form" style="margin-top: 10px;">
                            <div class="form-group row">
                                <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
                                <div class="col-sm-9">
                                    <input type="date" name="tanggal" class="form-control" id="tanggal" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jam_mulai" class="col-sm-3 col-form-label">Jam Mulai</label>
                                <div class="col-sm-9">
                                    <input type="time" name="jam_mulai" class="form-control" id="jam_mulai" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jam_selesai" class="col-sm-3 col-form-label">Jam Selesai</label>
                                <div class="col-sm-9">
                                    <input type="time" name="jam_selesai" class="form-control" id="jam_selesai" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_peminjaman" value="Harian" id="harian" onchange="showHarian()">
                        <label class="form-check-label" for="harian">
                        Harian
                        </label>
                        <div class="harian-form" id="harian-form" style="margin-top: 10px;display:none;">
                            <div class="form-group row">
                                <label for="tgl_mulai" class="col-sm-3 col-form-label">Mulai Tanggal</label>
                                <div class="col-sm-9">
                                    <input type="date" name="tgl_mulai" class="form-control" id="tgl_mulai" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tgl_selesai" class="col-sm-3 col-form-label">Sampai Mulai</label>
                                <div class="col-sm-9">
                                    <input type="date" name="tgl_selesai" class="form-control" id="tgl_selesai" >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="select2" class="col-lg-2 col-form-label">Nama Pemohon<span class="text-danger">*</span></label>
                <div class="col-sm-6">
                    <select class="select2-pemohon form-control" name="pemohon" id="select2">
                    <option value=""></option>
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
                <label for="select2SinglePlaceholder" class="col-lg-2 col-form-label">Nama Atasan<span class="text-danger">*</span></label>
                <div class="col-sm-6">
                    <select class="select2-atasan form-control" name="atasan" id="selectSinglePlaceholder">
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
                <button type="submit" class="btn btn-primary">Buat Permohonan</button>
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

  function showJam(){
    document.getElementById("jam-form").style.display = 'block';
    document.getElementById("harian-form").style.display = 'none';
  }
  function showHarian(){
    document.getElementById("jam-form").style.display = 'none';
    document.getElementById("harian-form").style.display = 'block';
  }
</script>