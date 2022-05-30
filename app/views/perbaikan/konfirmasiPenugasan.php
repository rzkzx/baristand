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
                                  <label for="waktu" class="col-sm-2 col-form-label">Penanggung jawab</label>
                                  <div class="col-sm-10">
                                    <input type="text" name="waktu" required class="form-control" id="waktu" readonly value="<?= $data['barang'][0]->penanggung?>">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="nip_pemohon" class="col-sm-2 col-form-label">Catatan dari Penanggung jawab</label>
                                  <div class="col-sm-10">
                                    <textarea  type="text" name="disposisi" required class="form-control" id="disposisi"readonly><?= $data['barang'][0]->penugasan?></textarea >
                                  </div>
                                </div>
                                <div class="row mb-3">
                                <label for="isi" class="col-sm-2 col-form-label">Penugasan</label>
                                  <div class="col-sm-10">
                                  <table class="table">
                                  <thead class="thead-light">
                                  <tr>
                                    <th>Nama Barang</th>
                                    <th>Keterangan</th>
                                    <th>Jumlah</th>
                                    <th>Waktu Penugasan</th>
                                    <th>Deadline</th>
                                    <th>Aksi</th>
                                  </tr>
                                  </thead>
                                  <?php                            
                              foreach($data['barang'] as $b):?>
                                  <tr> 
                                  <td>
                                    <?= $b->nbarang; ?>
                                  </td>
                                  <td><?= $b->jumlah; ?></td>
                                  <td><?= $b->keterangan; ?></td>
                                  <td><?= $b->waktu_penugasan; ?></td>
                                  <td><?= $b->deadline; ?></td>
                                  <td>
                                  <?php if(!$b->penerimaan){?>
                                    <form role="form" action="<?= URLROOT; ?>/perbaikan/accKonfirmasiDiterima" method="POST" enctype="multipart/form-data">
                                      <input type="hidden" name="id" value="<?= $b->id ?>">
                                      <input type="hidden" name="penerimaan" value="Tugas diterima">
                                      <input type="hidden" name="seri_perbaikan" value="<?= $b->seri_perbaikan ?>">
                                      <div class="row mb-3">
                                        <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Menerima penugasan!')">Konfirmasi Diterima</button>
                                      </div>
                                    </form>
                                    <?php }else{ ?>
                                      <?php if(!$b->verifikasi_selesai){ ?>
                                    <form role="form" action="<?= URLROOT; ?>/perbaikan/accKonfirmasiSelesai" method="POST" enctype="multipart/form-data">
                                      <div class="row mb-3">
                                          <textarea type="text" name="catatan" required class="form-control" id="disposisi" placeholder="Tulis Catatan..."></textarea>
                                      </div>
                                      <input type="hidden" name="id" value="<?= $b->id ?>">
                                      <input type="hidden" name="seri_perbaikan" value="<?= $b->seri_perbaikan ?>">
                                      <input type="hidden" name="verifikasi_selesai" value="Perbaikan selesai">
                                      <input type="hidden" name="no_telp" value="<?= $data['perbaikan']->no_telp?>">
                                      <div class="row mb-3">
                                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Apakah semua perbaikan telah terkonfirmasi selesai?')">Konfirmasi perbaikan selesai</button>
                                      </div>
                                    </form><?php
                                      }else{
                                        echo '<span class="text-success">Perbaikan Selesai</span>';
                                      }
                                  }
                                  ?>
                                  </td>
                                  </tr>    
                              <?php endforeach;?>                                               
                                  </table>
                                  </div>
                                </div>
                                
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