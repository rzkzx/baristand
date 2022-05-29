<?php require APPROOT . '/views/inc/header.php'; ?>
<style>
  .table th {
    text-align: center;
    vertical-align: middle;
  }

  .table td {
    text-align: center;
    vertical-align: middle;
  }
</style>
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
              <form role="form" action="<?= URLROOT; ?>/perbaikan/accDisposisi" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $data['perbaikan']->id; ?>">
                <div class="row mb-3">
                <label for="waktu" class="col-sm-2 col-form-label">Seri Perbaikan</label>
                  <div class="col-sm-10">
                    <input type="text" name="waktu" required class="form-control" id="waktu" readonly value="<?= $data['perbaikan']->serial_number?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="nama_petugas" class="col-sm-2 col-form-label">Pemohon</label>
                  <div class="col-sm-10">
                    <input type="text" name="pemohon" required class="form-control" id="waktu" readonly value="<?= $data['perbaikan']->nama ?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="waktu" class="col-sm-2 col-form-label">Waktu Permohonan</label>
                  <div class="col-sm-10">
                    <input type="text" name="waktu" required class="form-control" id="waktu" readonly value="<?= $data['perbaikan']->tanggal, ' ', $data['perbaikan']->jam ?>">
                  </div>
                </div>
                <?php if ($data['perbaikan']->waktu_validasi1) { ?>
                  <div class="row mb-3">
                    <label for="waktu" class="col-sm-2 col-form-label">Validasi atasan</label>
                    <div class="col-sm-10">
                      <input type="text" name="atasan" required class="form-control" id="deadline" readonly value="<?= $data['atasan']->nama . ' / ' . $data['perbaikan']->waktu_validasi1 ?>">
                    </div>
                  </div>
                <?php }
                if ($data['perbaikan']->waktu_validasi2) { ?>
                  <div class="row mb-3">
                    <label for="waktu" class="col-sm-2 col-form-label">Validasi kepala balai</label>
                    <div class="col-sm-10">
                      <input type="text" name="kasubag" required class="form-control" id="deadline" readonly value="<?= $data['perbaikan']->waktu_validasi2 ?>">
                    </div>
                  </div>
                <?php }
                if ($data['perbaikan']->disposisi) { ?>
                  <div class="row mb-3">
                    <label for="waktu" class="col-sm-2 col-form-label">Validasi kasubag</label>
                    <div class="col-sm-10">
                      <input type="text" name="kasubag" required class="form-control" id="deadline" readonly value="<?= $data['perbaikan']->waktu_disposisi ?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="waktu" class="col-sm-2 col-form-label">Penugasan penanggung jawab</label>
                    <div class="col-sm-10">
                      <input type="text" name="penugasan" required class="form-control" id="deadline" readonly value="<?= $data['penanggung']->nama . ' / ' . $data['perbaikan']->waktu_penugasan ?>">
                    </div>
                  </div>
                <?php }
                if (!$data['perbaikan']->penugasan) { ?>
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                      <table class="table">
                        <thead class="thead-light">
                          <tr>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                          </tr>
                        </thead>
                        <?php foreach ($data['barang'] as $b) : ?>
                          <tr>
                            <td>
                              <?= $b->nbarang; ?>
                            </td>
                            <td><?= $b->jumlah; ?></td>
                            <td><?= $b->keterangan; ?></td>
                          <?php endforeach; ?>
                          </tr>
                      </table>
                    </div>
                  </div>
                <?php } elseif (!$data['perbaikan']->waktu_diterima) { ?>
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                      <table class="table">
                        <thead class="thead-light">
                          <tr>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Petugas</th>
                            <th>Dealine</th>
                          </tr>
                        </thead>
                        <?php foreach ($data['barang'] as $b) : ?>
                          <tr>
                            <td>
                              <?= $b->nbarang; ?>
                              </td>
                            <td><?= $b->jumlah; ?></td>
                            <td><?= $b->keterangan; ?></td>
                            <td><?php
                                if (!$b->nip_petugas) {
                                  echo '<span class="text-danger">Belum dipilih</span>';
                                } else {
                                  echo $b->petugas_perbaikan;
                                }
                                ?>
                            <td><?php
                                if (!$b->nip_petugas) {
                                  echo '<span class="text-danger">Kosong</span>';
                                } else {
                                  echo $b->deadline;
                                }
                                ?></td>
                          <?php endforeach; ?>
                          </tr>
                      </table>
                    </div>
                  </div>
                <?php } elseif (!$data['perbaikan']->verifikasi_selesai) { ?>
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                      <table class="table">
                        <thead class="thead-light">
                          <tr>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Petugas</th>
                            <th>Dealine</th>
                            <th>Penugasan</th>
                          </tr>
                        </thead>
                        <?php foreach ($data['barang'] as $b) : ?>
                          <tr>
                            <td>
                              <?= $b->nbarang; ?>
                            </td>
                            <td><?= $b->jumlah; ?></td>
                            <td><?= $b->keterangan; ?></td>
                            <td><?php
                                if (!$b->nip_petugas) {
                                  echo '<span class="text-danger">Belum dipilih</span>';
                                } else {
                                  echo $b->petugas_perbaikan;
                                }
                                ?>
                            <td><?php
                                if (!$b->nip_petugas) {
                                  echo '<span class="text-danger">Kosong</span>';
                                } else {
                                  echo $b->deadline;
                                }
                                ?></td>
                            <td>
                              <?php
                              if (!$b->penerimaan) {
                                echo '<span class="text-danger">Belum diterima</span>';
                              } else {
                                echo '<span class="text-success">' . $b->waktu_diterima . '</span>';
                              }
                              ?>
                            </td>
                          <?php endforeach; ?>
                          </tr>
                      </table>
                    </div>
                  </div>
                <?php } elseif (!$data['perbaikan']->hasil) { ?>
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                      <table class="table">
                        <thead class="thead-light">
                          <tr>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Petugas</th>
                            <th>Dealine</th>
                            <th>Penugasan</th>
                            <th>Tugas Diterima</th>
                          </tr>
                        </thead>
                        <?php foreach ($data['barang'] as $b) : ?>
                          <tr>
                            <td>
                              <?= $b->nbarang; ?>
                            </td>
                            <td><?= $b->jumlah; ?></td>
                            <td><?= $b->keterangan; ?></td>
                            <td><?php
                                if (!$b->nip_petugas) {
                                  echo '<span class="text-danger">Belum dipilih</span>';
                                } else {
                                  echo $b->petugas_perbaikan;
                                }
                                ?>
                            <td><?php
                                if (!$b->nip_petugas) {
                                  echo '<span class="text-danger">Kosong</span>';
                                } else {
                                  echo $b->deadline;
                                }
                                ?></td>
                            <td>
                              <?php
                              if (!$b->penerimaan) {
                                echo '<span class="text-danger">Belum diterima</span>';
                              } else {
                                echo '<span class="text-success">' . $b->waktu_diterima . '</span>';
                              }
                              ?>
                            </td>
                            <td>
                              <?php
                              if (!$b->penerimaan) {
                                echo '<span class="text-danger">Belum selesasi</span>';
                              } else {
                                echo '<span class="text-success">' . $b->waktu_selesai. '</span>';
                              }
                              ?>
                            </td>
                          <?php endforeach; ?>
                          </tr>
                      </table>
                    </div>
                  </div>
                <?php } else { ?>
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                      <table class="table">
                        <thead class="thead-light">
                          <tr>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Petugas</th>
                            <th>Dealine</th>
                            <th>Penugasan</th>
                            <th>Tugas Diterima</th>
                            <th>Hasil</th>
                          </tr>
                        </thead>
                        <?php foreach ($data['barang'] as $b) : ?>
                          <tr>
                            <td>
                              <?= $b->nbarang; ?>
                            </td>
                            <td><?= $b->jumlah; ?></td>
                            <td><?= $b->keterangan; ?></td>
                            <td><?php
                                if (!$b->nip_petugas) {
                                  echo '<span class="text-danger">Belum dipilih</span>';
                                } else {
                                  echo $b->petugas_perbaikan;
                                }
                                ?>
                            <td><?php
                                if (!$b->nip_petugas) {
                                  echo '<span class="text-danger">Kosong</span>';
                                } else {
                                  echo $b->deadline;
                                }
                                ?></td>
                            <td>
                              <?php
                              if (!$b->penerimaan) {
                                echo '<span class="text-danger">Belum diterima</span>';
                              } else {
                                echo '<span class="text-success">' . $b->waktu_diterima . '</span>';
                              }
                              ?>
                            </td>
                            <td>
                              <?php
                              if (!$b->penerimaan) {
                                echo '<span class="text-danger">Belum selesasi</span>';
                              } else {
                                echo '<span class="text-success">' . $b->waktu_selesai . '</span>';
                              }
                              ?>
                            </td>
                            <td><?php
                                if (!$b->hasil) {
                                  echo '<span class="text-warning">Hasil belum diterima</span>';
                                } else {
                                  echo '<span class="text-success">Hasil diterima</span>';
                                } ?>
                            </td>
                          <?php endforeach; ?>
                          </tr>
                      </table>
                    </div>
                  </div>
                <?php } ?>
                <!-- /.card-body -->
                <div class="card-footer">
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
<?php require APPROOT . '/views/inc/footer.php'; ?>