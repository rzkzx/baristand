<div class="row">
    <div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-body">
            <div class="col-md-12">
                <?php Flasher::Message(); ?>
            </div>
            <form action="<?= base_url; ?>/ijinlembur/terbitkan" method="POST"  enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $data['ijinlembur']['id']; ?>">
            <div class="form-group row">
              <label for="pemohon" class="col-sm-2 col-form-label">Pemohon</label>
              <div class="col-sm-8">
                <input type="email" class="form-control" id="pemohon" value="<?= $data['ijinlembur']['nama'] ?>" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="nomor_surat" class="col-sm-2 col-form-label">Nomor Surat<span class="text-danger">*</span> :</label>
              <div class="col-sm-1">
                <input type="text" name="nomor_surat[]" required class="form-control" id="nomor_surat">
              </div>
              <div class="col-sm-3">
                <input type="text" name="nomor_surat[]" required class="form-control" value="/BSKJI/BSPJI-BANJARBARU/KP/" readonly>
              </div>
              <div class="col-sm-2">
                <input type="text" name="nomor_surat[]" required class="form-control" placeholder="ex: III" id="nomor_surat">
              </div>
              <div class="col-sm-2">
                <input type="text" name="nomor_surat[]" required class="form-control" readonly value="/<?= date('Y') ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="tanggal_surat" class="col-sm-2 col-form-label">Tanggal Surat<span class="text-danger">*</span> :</label>
              <div class="col-sm-8">
                <input type="text" name="tanggal_surat" class="form-control" id="tanggal_surat" placeholder="" value="" required>
              </div>
            </div>
            <div class="form-group row">
                <label for="keperluan" class="col-sm-2 col-form-label">Keperluan<span class="text-danger">*</span> :</label>
                <div class="col-sm-8">
                <textarea type="text" class="form-control" id="keperluan" name="keperluan" placeholder="Tulis keperluan..."><?= $data['ijinlembur']['keperluan'] ?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan :</label>
                <div class="col-sm-8">
                <textarea type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Tulis keterangan..."><?= $data['ijinlembur']['keterangan'] ?></textarea>
                </div>
            </div>
            <div class="form-group row">
              <label for="tanggal_ijin" class="col-sm-2 col-form-label">Tanggal Ijin<span class="text-danger">*</span> :</label>
              <div class="col-sm-8">
                <input type="date" name="tanggal_ijin" class="form-control" id="tanggal_ijin" placeholder="Email" value="<?= $data['ijinlembur']['tanggal_ijin'] ?>" required >
              </div>
            </div>
            <div class="form-group row">
              <label for="jam_mulai" class="col-sm-2 col-form-label">Jam Mulai<span class="text-danger">*</span> :</label>
              <div class="col-sm-8">
                <input type="time" name="jam_mulai" required class="form-control" id="jam_mulai" value="<?= $data['ijinlembur']['jam_mulai'] ?>" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="jam_berakhir" class="col-sm-2 col-form-label">Jam Berakhir<span class="text-danger">*</span> :</label>
              <div class="col-sm-8">
                <input type="time" name="jam_berakhir" required class="form-control" id="jam_berakhir" value="<?= $data['ijinlembur']['jam_berakhir'] ?>" required>
              </div>
            </div>
            <div class="pb-4"></div>
            <div class="form-group row">
                <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Terbitkan</button>
                <a href="<?= base_url; ?>/ijinlembur" class="btn btn-danger">Kembali</a>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>