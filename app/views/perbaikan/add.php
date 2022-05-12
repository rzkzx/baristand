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
                            <div class="col-md-8">
                                <?php flash(); ?>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="<?= URLROOT; ?>/perbaikan/addbarang" method="POST" enctype="multipart/form-data">
                                <div class="row mb-3">
                                  <label for="inputNama" class="col-sm-2 col-form-label">Nama Barang</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="nbarang" required class="form-control" id="inputNama" placeholder="Masukkan nama barang...">
                                  </div>
                                </div>

                                <div class="row mb-3">
                                  <label for="inputNama" class="col-sm-2 col-form-label">jumlah</label>
                                  <div class="col-sm-6">
                                    <input type="number" name="jumlah" required class="form-control" id="inputNama" placeholder="Masukkan jumlah barang...">
                                  </div>
                                </div>

                                <div class="row mb-3">
                                  <label for="inputUraian" class="col-sm-2 col-form-label">Keterangan</label>
                                  <div class="col-sm-6">
                                    <textarea type="text" name="keterangan" required class="form-control" id="inputUraian" placeholder="Masukan keterangan..."></textarea>
                                    <button type="submit" class="btn btn-primary mt-3 float:right">Tambah</button>
                                    <a href="<?= URLROOT; ?>/perbaikan/deleteSemuaBarang/" class="btn btn-danger mt-3">Hapus Semua</a>
                                  </div>
                                </div>
                                
                                </form>
                                <form role="form" action="<?= URLROOT; ?>/perbaikan/add" method="POST" enctype="multipart/form-data">
                                <div class="row mb-3">
                                </div>
                                
                            <div class="row mb-3">
                               <label class="col-sm-2 col-form-label"></label>
                              <div class="col-sm-6">
                               
                              <?php flash(); ?>
                                <table class="table" id="table1">
                                <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php 
                        $no = 1;
                        foreach ($data['tbarang'] as $row) {
                        ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $row->nbarang ?></td>
                                            <td><?= $row->jumlah ?></td>
                                            <td><?= $row->keterangan ?></td>
                                            <td>
                                            <a href="<?= URLROOT; ?>/perbaikan/deleteBarang/<?= $row->id ?>"
                                                class="btn btn-danger"
                                                onclick="return confirm('Hapus Laporan?');"><i class="fa fa-trash"></i></a>
                                            </td>
                                            
                                        </tr>
                                        <?php 
                        }
                        ?>
                                    </tbody>
                                </table>
                              </div>
                            </div>
                        <?php 
                        $no = 1;
                        foreach ($data['tbarang'] as $row) {
                        ?>
                        <input type="hidden" name="ketbarang[]" value="<?= $no.','.$row->nbarang.','.$row->jumlah.','.$row->keterangan.'.' ?>">
                                        <?php 
                            $no++;
                        }
                        ?>
                                                <?php
                                $str = array();
                                for($i = 0; $i < 20; $i++){
                                      if($letter_OR_number = rand(0,1)){ // true: alphabet chosen
                                         $str[] = chr(rand(65, 90));
                                      } else { // false: number chosen
                                         $str[] = rand(0,9);
                                      }
                                      if($i % 4 == 3){
                                        ($i < 19)? $str[] = '-': $str[] = ' ';
                                     }
                                }
                                
                                foreach($str as $val){
                                  ?>
                                  <input type="hidden" name="serial[]" value="<?= $val ?>"> <?php
                                }
                                ?>
                                </br>
                                <div class="form-group row">
                                <label for="select2" class="col-lg-2 col-form-label">Nama Pemohon<span class="text-danger">*</span></label>
                                <div class="col-sm-6">
                                  <select class="select2-pemohon form-control" name="nip_pemohon" id="select2">
                                  <option value=""></option>
                                    <?php 
                                      foreach ($data['nama'] as $k) {
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
                                  <select class="select2-atasan form-control" name="nip_atasan" id="select2SinglePlaceholder">
                                      <option value=""></option>
                                    <?php 
                                      foreach ($data['jabatan'] as $k) {
                                      ?>
                                          <option value="<?= $k->nip ?>"><?= $k->nama ?> / <?= $k->nip ?></option>
                                      <?php
                                      }
                                    ?>
                                  </select>
                                </div>
                              </div>
                                <input type="hidden" name="status" value="<span class='text-warning'>Menunggu validasi</span>">
                                
                                <!-- /.card-body -->
                                <div class="row mb-3">
                                  <label for="inputUraian" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary">Buat</button>
                                    <a href="<?= URLROOT; ?>/perbaikan" class="btn btn-danger">Kembali</a>
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