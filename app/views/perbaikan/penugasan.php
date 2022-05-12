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
                                  <label for="waktu" class="col-sm-2 col-form-label">Waktu Disposisi</label>
                                  <div class="col-sm-10">
                                    <input type="text" name="waktu" required class="form-control" id="waktu" readonly value="<?= $data['perbaikan']->waktu_disposisi ?>">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="nip_pemohon" class="col-sm-2 col-form-label">Catatan dari Kesubag TU</label>
                                  <div class="col-sm-10">
                                    <textarea  type="text" name="disposisi" required class="form-control" id="disposisi"readonly><?= $data['perbaikan']->disposisi ?></textarea >
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label class="col-sm-2 col-form-label">Penugasan<span class="text-danger">*</span></label>
                                  <div class="col-sm-10">
                                  <table class="table">
                                  <thead class="thead-light">
                                  <tr>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                    <th>Deadline</th>
                                    <th>Petugas</th>
                                    <th>Aksi</th>
                                  </tr>
                                  </thead>
                                  <?php
                                  foreach($data['barang'] as $b): 
                                  ?>
                                  <form role="form" action="<?= URLROOT; ?>/perbaikan/accPetugas" method="POST" enctype="multipart/form-data">
                                  <tr>
                                  <td>
                                    <?= $b->nbarang; ?><input type="hidden" name="idb" value="<?= $b->id; ?>">
                                    <input type="hidden" name="seri_perbaikan" value="<?= $b->seri_perbaikan; ?>">
                                    <input type="hidden" name="id" value="<?= $data['perbaikan']->id; ?>">
                                  </td>
                                  <td><?= $b->jumlah; ?></td>
                                  <td><?= $b->keterangan; ?></td>
                                  <td>
                                      <?php
                                      if(!$b->nip_petugas){
                                      ?> <input type="date" name="deadline" required class="form-control" id="deadline"> <?php
                                      }else{
                                      echo $b->deadline;
                                      }
                                      ?>
                                  </td>
                                  <td>
                                  <?php
                                      if(!$b->nip_petugas){
                                      ?><select class="form-control" name="nip_petugas[]" id="select2">
                                      <option value="" disabled selected>Pilih Petugas</option>
                                    <?php 
                                      foreach ($data['timperbaikan'] as $k) {
                                      ?>
                                          <option value="<?= $k->nip ?>"><?= $k->nama ?> / <?= $k->nip ?></option>
                                      <?php
                                      }
                                    ?>
                                    
                                    </select><?php
                                      }else{
                                      echo '<input type="hidden" name="nip_petugas[]" value="'.$b->nip_petugas.'">';
                                      echo $b->petugas_perbaikan;
                                      }
                                      ?> 
                                  </td>
                                    <td>
                                    <?php
                                      if(!$b->nip_petugas){
                                      ?>
                                        <button type="submit" class="btn btn-success">Konfirmasi</button></form>
                                        <?php
                                      }else{
                                      echo '<span class="text-success">Dipilih</span>';
                                      }
                                    ?>                            
                                  </td>    
                                  </tr>
                                  <?php  
                                  endforeach;
                                  ?>                                                      
                                  </table>
                                  </div>
                                </div>
                                </form>
                                <form role="form" action="<?= URLROOT; ?>/perbaikan/penugasan" method="POST" enctype="multipart/form-data">
                                <?php
                                  if(!$data['perbaikan']->penugasan){
                                  ?>
                                  <div class="row mb-3">
                                  <label for="catatan" class="col-sm-2 col-form-label">Catatan kepada Petugas</label>
                                  <div class="col-sm-10">
                                  <textarea type="text" name="penugasan" required class="form-control" id="penugasan" placeholder="Tulis Catatan..."></textarea> 
                                  </div>
                                  </div>
                                  <div class="row mb-3">
                                  <label for="catatan" class="col-sm-2 col-form-label"></label>
                                  <div class="col-sm-10">
                                  <a><span class="text-warning">*Input semua petugas sebelum menekan tombol Simpan</span></a>
                                  </div>
                                  </div><?php 
                                  }else{ ?>
                                  <div class="row mb-3">
                                  <label for="catatan" class="col-sm-2 col-form-label">Catatan kepada Petugas</label>
                                  <div class="col-sm-10">
                                  <textarea type="text" name="penugasan" required class="form-control" id="penugasan" readonly><?= $data['perbaikan']->penugasan ?></textarea>
                                  </div>
                                  </div>
                                  <?php
                                  } ?>                           
                                <!-- /.card-body -->
                                <input type="hidden" name="serial_number" value="<?= $data['perbaikan']->serial_number; ?>">
                                <div class="row mb-3">
                                  <label for="inputUraian" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">    
                                    <?php
                                    if($data['perbaikan']->penugasan){?>
                                    <a href="<?= URLROOT; ?>/perbaikan" class="btn btn-danger" onclick="return confirm('Pastikan semua petugas telah dipilih!')">Kembali</a> <?php
                                    }else{?>
                                    <a href="<?= URLROOT; ?>/perbaikan" class="btn btn-danger">Kembali</a>
                                    <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah semua petugas telah diinput?')">Simpan</button><?php
                                    }?>
                                </div>
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