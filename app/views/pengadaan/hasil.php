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
                                  <label for="waktu" class="col-sm-1 col-form-label">Seri Pengadaan</label>
                                  <div class="col-sm-11">
                                    <input type="text" name="waktu" required class="form-control" id="waktu" readonly value="<?= $data['pengadaan']->serial_number?>">
                                  </div>
                                </div>
    </br>
                                <div class="row mb-3">
                                  <table class="table">
                                  <thead class="thead-light">
                                  <tr>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                    <th>Deadline</th>
                                    <th>Petugas</th>
                                    <th>Penugasan</th>
                                    <th>Tugas diterima</th>
                                    <th>Catatan</th>
                                    <th>Hasil</th>
                                  </tr>
                                  </thead>
                                  <?php
                                  foreach($data['bahan'] as $b): 
                                  
                                  if($b->nip_petugas){?>
                                  <tr> 
                                  <td>
                                    <?= $b->nbahan; ?>
                                  </td>
                                  <td><?= $b->jumlah; ?></td>
                                  <td><?= $b->keterangan; ?></td>
                                  <td><?= $b->deadline ?></td>
                                  <td><?= $b->petugas_pengadaan ?></td>
                                  <td>
                                  <?php
                                    if(!$b->penerimaan){
                                      echo '<span class="text-danger">Belum diterima</span>';
                                    }else{
                                      echo '<span class="text-success">'.$b->waktu_diterima.'</span>';
                                    }
                                  ?>
                                  </td>
                                  <td>
                                  <?php
                                  if(!$b->penerimaan){
                                    echo '<span class="text-success">Menunggu tugas diterima</span>';
                                  }else{
                                    if(!$b->verifikasi_selesai){
                                      echo '<span class="text-danger">Belum selesai</span>';
                                    }else{
                                      echo '<span class="text-success">'.$b->waktu_selesai.'</span>';
                                    }
                                  }
                                  ?>
                                  </td>
                                  <td>
                                  <?php
                                    if(!$b->catatan){
                                      echo '<span class="text-warning">Kosong</span>';
                                    }else{ 
                                      ?><textarea type="text" name="catatan" required class="form-control" id="catatan" readonly><?= $b->catatan ?></textarea><?php
                                      }?>
                                  </td>
                                  <td><?php
                                  if(!$b->hasil){
                                    if($b->waktu_selesai){?>
                                      <form role="form" action="<?= URLROOT; ?>/pengadaan/accKonfirmasiHasil" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?= $b->id ?>">
                                        <input type="hidden" name="seri_pengadaan" value="<?= $b->seri_pengadaan ?>">
                                        <input type="hidden" name="hasil" value="Hasil diterima">
                                        <button type="submit" class="btn btn-success">Konfirmasi</button>
                                      </form>
                                    <?php }else{ ?>
                                      <span class="text-warning">Belum Selesai</span>
                                    <?php } ?>
                                  <?php
                                  }else{
                                    echo '<span class="text-success">Hasil diterima</span>';
                                  }?>
                                  </td>
                                  </tr>
                                  <?php } ?>
                                  <?php 
                                  endforeach; 
                                  ?>                                                            
                                  </table>
                                </div>
                                <!-- /.card-body -->
                                <form role="form" action="<?= URLROOT; ?>/pengadaan/accHasil" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="serial_number" value="<?= $data['pengadaan']->serial_number; ?>">
                                <input type="hidden" name="hasil" value="Hasil diterima">
                                <div class="col-sm-10">    
                                    <a href="<?= URLROOT; ?>/pengadaan" class="btn btn-danger">Kembali</a>
                                    <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah semua pengadaan telah terkonfirmasi selesai?')">Tutup Pengadaan</button>
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