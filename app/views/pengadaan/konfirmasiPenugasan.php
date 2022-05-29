<?php require APPROOT . '/views/inc/header.php'; ?>
<style>
  .table th{
      text-align: center;
      vertical-align: middle;
      }
  .table td{
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
                            <div class="col-md-12">
                                <?php flash(); ?>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                                <div class="row mb-3">
                                  <label for="waktu" class="col-sm-2 col-form-label">Pejabat Pengadaan</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="waktu" required class="form-control" id="waktu" readonly value="<?= $data['bahan'][0]->penanggung?>">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="nip_pemohon" class="col-sm-2 col-form-label">Catatan Pejabat Pengadan</label>
                                  <div class="col-sm-6">
                                    <textarea  type="text" name="disposisi" required class="form-control" id="disposisi"readonly><?= $data['bahan'][0]->penugasan?></textarea >
                                  </div>
                                </div>
                                <div class="row mb-3">
                                <label for="isi" class="col-sm-2 col-form-label">Penugasan</label>
                                  <div class="col-sm-10">
                                  <table class="table">
                                  <thead class="thead-light">
                                  <tr>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                    <th>Waktu Penugasan</th>
                                    <th>Deadline</th>
                                    <th>Aksi</th>
                                  </tr>
                                  </thead>
                              <?php foreach($data['bahan'] as $b):?>
                                  <tr> 
                                  <td>
                                    <?= $b->nbahan; ?>
                                  </td>
                                  <td><?= $b->jumlah; ?></td>
                                  <td><?= $b->keterangan; ?></td>
                                  <td><?= $b->waktu_penugasan; ?></td>
                                  <td><?= $b->deadline; ?></td>
                                  <td>
                                    <?php if(!$b->penerimaan){?>
                                      <form role="form" action="<?= URLROOT; ?>/pengadaan/accKonfirmasiDiterima" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?= $b->id ?>">
                                        <input type="hidden" name="penerimaan" value="Tugas diterima">
                                        <input type="hidden" name="seri_pengadaan" value="<?= $b->seri_pengadaan ?>">
                                        <div class="row mb-3">
                                          <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Menerima penugasan!')">Konfirmasi Diterima</button>
                                        </div>
                                      </form>
                                      <?php }else{ ?>
                                      <?php if(!$b->verifikasi_selesai){ ?>
                                        <form role="form" action="<?= URLROOT; ?>/pengadaan/accKonfirmasiSelesai" method="POST" enctype="multipart/form-data">
                                          <div class="row mb-3">
                                              <textarea type="text" name="catatan" required class="form-control" id="disposisi" placeholder="Tulis Catatan..."></textarea>
                                          </div>
                                          <input type="hidden" name="id" value="<?= $b->id ?>">
                                          <input type="hidden" name="seri_pengadaan" value="<?= $b->seri_pengadaan ?>">
                                          <input type="hidden" name="verifikasi_selesai" value="Pengadaan selesai">
                                          <div class="row mb-3">
                                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Apakah semua pengadaan telah terkonfirmasi selesai?')">Konfirmasi pengadaan selesai</button>
                                          </div>
                                        </form>
                                      <?php
                                      }else{
                                        echo '<span class="text-success">Pengadaan Selesai</span>';
                                      }
                                    }
                                  ?>
                                  </td>
                                  </tr>     
                                <?php endforeach;?>                                               
                                  </table>
                                </div>
                                </div>
                                <!-- /.card-body -->
                              <a href="<?= URLROOT; ?>/perbaikan" class="btn btn-danger">Kembali</a>
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