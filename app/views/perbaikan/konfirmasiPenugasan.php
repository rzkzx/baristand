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
                              <?php                            
                              foreach($data['barang'] as $b):?>
                                <div class="row mb-3">
                                  <label for="waktu" class="col-sm-2 col-form-label">Penanggung jawab</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="waktu" required class="form-control" id="waktu" readonly value="<?= $b->penanggung?>">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="waktu" class="col-sm-2 col-form-label">Waktu penugasan</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="waktu" required class="form-control" id="waktu" readonly value="<?= $b->waktu_penugasan?>">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="waktu" class="col-sm-2 col-form-label">Deadline</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="waktu" required class="form-control" id="waktu" readonly value="<?= $b->deadline?>">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="nip_pemohon" class="col-sm-2 col-form-label">Catatan dari Penanggung jawab</label>
                                  <div class="col-sm-6">
                                    <textarea  type="text" name="disposisi" required class="form-control" id="disposisi"readonly><?= $b->penugasan?></textarea >
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label class="col-sm-2 col-form-label"></label>
                                  <div class="col-sm-6">
                                  <table class="table">
                                  <thead class="thead-light">
                                  <tr>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                  </tr>
                                  </thead>
                                  <tr> 
                                  <td>
                                    <?= $b->nbarang; ?>
                                  </td>
                                  <td><?= $b->jumlah; ?></td>
                                  <td><?= $b->keterangan; ?></td>
                                  </tr>                                                   
                                  </table>
                                  </div>
                                </div>
                                <!-- /.card-body -->
                                <?php                            
                              if(!$b->verifikasi_selesai){
                                if(!$b->penerimaan){?>
                                  <form role="form" action="<?= URLROOT; ?>/perbaikan/accKonfirmasiDiterima" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $b->id ?>">
                                    <input type="hidden" name="penerimaan" value="Tugas diterima">
                                    <input type="hidden" name="seri_perbaikan" value="<?= $b->seri_perbaikan ?>">
                                    <div class="row mb-3">
                                      <label for="inputUraian" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">    
                                      <button type="submit" class="btn btn-primary" onclick="return confirm('Menerima penugasan!')">Konfirmasi penugasan Diterima</button>
                                      <a href="<?= URLROOT; ?>/perbaikan" class="btn btn-danger">Kembali</a>
                                    </div>
                                    </div>
                                  </form><?php
                                }else{?>
                                  <form role="form" action="<?= URLROOT; ?>/perbaikan/accKonfirmasiSelesai" method="POST" enctype="multipart/form-data">
                                    <div class="row mb-3">
                                      <label for="catatan" class="col-sm-2 col-form-label">Catatan perbaikan</label>
                                      <div class="col-sm-6">
                                        <textarea type="text" name="catatan" required class="form-control" id="disposisi" placeholder="Tulis Catatan..."></textarea>
                                      </div>
                                    </div>
                                    <input type="hidden" name="id" value="<?= $b->id ?>">
                                    <input type="hidden" name="seri_perbaikan" value="<?= $b->seri_perbaikan ?>">
                                    <input type="hidden" name="verifikasi_selesai" value="Perbaikan selesai">
                                    <div class="row mb-3">
                                    <label for="catatan" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                    <a><span class="text-success">*Tugas perbaikan diterima, menunggu konfirmasi selesasi...</span></a>
                                    </div>
                                    </div>
                                    <div class="row mb-3">
                                      <label for="inputUraian" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">    
                                      <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah semua perbaikan telah terkonfirmasi selesai?')">Konfirmasi perbaikan selesai</button>
                                      <a href="<?= URLROOT; ?>/perbaikan" class="btn btn-danger">Kembali</a>
                                    </div>
                                    </div>
                                  </form><?php
                                }
                              }else{ ?>
                              <div class="row mb-3">
                                <label for="catatan" class="col-sm-2 col-form-label">Catatan perbaikan</label>
                                <div class="col-sm-6">
                                  <textarea type="text" name="catatan" required class="form-control" id="disposisi" placeholder="Tulis Catatan..." readonly><?= $b->verifikasi_selesai ?></textarea>
                                </div>
                              </div>
                              <div class="row mb-3">
                                <label for="catatan" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <a><span class="text-success">*Tugas perbaikan anda telah selesai...</span></a>
                                </div>
                              </div>
                              <div class="row mb-3">
                                <label for="inputUraian" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                  <a href="<?= URLROOT; ?>/perbaikan" class="btn btn-danger">Kembali</a>
                                </div>
                              </div><?php } ?>
                          <?php endforeach;?>    
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