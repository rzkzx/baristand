<section class="section">
    <div class="row">
        <div class="col-12">
            <div class="content-wrapper">
                <!-- Main content -->
                <section class="content">
                    <div class="card card-primary">

                        <div class="card-body">
                            <div class="col-md-8">
                                <?php Flasher::Message(); ?>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="<?= URLROOT; ?>/perbaikan/save" method="POST" enctype="multipart/form-data">
                                <div class="row mb-3">
                                  <h4>Data Pemberian Gratifikasi</h4>
                                </div>
                                <div class="row mb-3">
                                  <label for="inputNama" class="col-sm-2 col-form-label">Jenis Penerimaan :</label>
                                  <div class="col-sm-6">
                                    <select class="form-select" name="jenis_penerimaan">
                                      <?php 
                                        foreach ($data['jenis_penerimaan'] as $k) {
                                        ?>
                                            <option value="<?= $k['id'] ?>"><?= $k['jenis_penerimaan'] ?></option>
                                        <?php
                                        }
                                      ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="inputUraian" class="col-sm-2 col-form-label">Uraian :</label>
                                  <div class="col-sm-6">
                                    <textarea type="text" name="uraian" required class="form-control" id="inputUraian" placeholder="Tulis uraian..."></textarea>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="inputHarga" class="col-sm-2 col-form-label">Harga/Nominal/Taksiran :</label>
                                  <div class="col-sm-6">
                                    <input type="number" name="taksiran" required class="form-control" id="inputHarga" placeholder="Tulis harga/nominal/taksiran...">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="inputNama" class="col-sm-2 col-form-label">Jenis Peristiwa :</label>
                                  <div class="col-sm-6">
                                    <select class="form-select" name="jenis_peristiwa">
                                      <?php 
                                        foreach ($data['jenis_peristiwa'] as $k) {
                                        ?>
                                            <option value="<?= $k['id'] ?>"><?= $k['jenis_peristiwa'] ?></option>
                                        <?php
                                        }
                                      ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="inputTempatPenerimaan" class="col-sm-2 col-form-label">Tempat Penerimaan :</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="tempat_penerimaan" required class="form-control" id="inputTempatPenerimaan" placeholder="Masukkan tempat penerimaan...">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="tanggal" class="col-sm-2 col-form-label">Tanggal :</label>
                                  <div class="col-sm-6">
                                    <input type="date" name="tanggal" required class="form-control" id="tanggal" placeholder="Masukkan tanggal...">
                                  </div>
                                </div>
                                <div class="row mb-3 mt-4">
                                  <h4>Data Penerima dan Pemberi Gratifikasi</h4>
                                </div>
                                <div class="row mb-3">
                                  <label for="penerima" class="col-sm-2 col-form-label">Nama Penerima :</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="penerima" required class="form-control" id="penerima" placeholder="Masukkan nama penerima...">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="pemberi" class="col-sm-2 col-form-label">Pemberi :</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="pemberi" required class="form-control" id="pemberi" placeholder="Masukkan pemberi...">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan :</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="pekerjaan" required class="form-control" id="pekerjaam" placeholder="Masukkan pekerjaan...">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="jabatan" class="col-sm-2 col-form-label">Jabatan :</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="jabatan" required class="form-control" id="jabatan" placeholder="Tulis jabatan...">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="alamat" class="col-sm-2 col-form-label">Alamat :</label>
                                  <div class="col-sm-6">
                                    <textarea type="text" name="alamat" required class="form-control" id="alamat" placeholder="Tulis alamat..."></textarea>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="telepon" class="col-sm-2 col-form-label">Telepon :</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="telepon" required class="form-control" id="telepon" placeholder="Masukkan telepon...">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="email" class="col-sm-2 col-form-label">Email :</label>
                                  <div class="col-sm-6">
                                    <input type="email" name="email" required class="form-control" id="email" placeholder="Masukkan email...">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="hubungan" class="col-sm-2 col-form-label">Hubungan :</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="hubungan" required class="form-control" id="hubungan" placeholder="Masukkan hubungan...">
                                  </div>
                                </div>
                                <div class="row mb-3 mt-4">
                                  <h4>Alasan dan Kronologi</h4>
                                </div>
                                <div class="row mb-3">
                                  <label for="alasan_pemberian" class="col-sm-2 col-form-label">Alasan Pemberian :</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="alasan_pemberian" required class="form-control" id="alasan_pemberian" placeholder="Tulis alasan pemberian...">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="kroonologi_penerimaan" class="col-sm-2 col-form-label">Kronologi Penerimaan :</label>
                                  <div class="col-sm-6">
                                    <textarea type="text" name="kronologi_penerimaan" required class="form-control" id="kroonologi_penerimaan" placeholder="Tulis kronologi penerimaan..."></textarea>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="tindakan" class="col-sm-2 col-form-label">Tindakan :</label>
                                  <div class="col-sm-6">
                                    <textarea type="text" name="tindakan" required class="form-control" id="tindakan" placeholder="Tulis tindakan..."></textarea>
                                  </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Buat</button>
                                    <a href="<?= URLROOT; ?>/perbaikan" class="btn btn-danger">Kembali</a>
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