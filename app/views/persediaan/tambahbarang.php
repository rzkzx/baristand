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
                            <form role="form" action="<?= URLROOT; ?>/persediaan/addbarang" method="POST" enctype="multipart/form-data">
                              <div class="row mb-3">
                                  <label for="inpuGudang" class="col-sm-2 col-form-label">Gudang<span class="text-danger">*</span></label>
                                  <div class="col-sm-6">
                                    <select class="select2-gudang form-control" name="gudang" id="select2">
                                    <option value=""></option>
                                      <?php 
                                        foreach ($data['gudang'] as $k) {
                                        ?>
                                            <option value="<?= $k->namagudang ?>"><?= $k->namagudang ?></option>
                                        <?php
                                        }
                                      ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="inputNama" class="col-sm-2 col-form-label">Nama Barang</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="namab" required class="form-control input-filter" id="inputNama" placeholder="Masukkan nama barang...">
                                  </div>
                                </div>
                                
                                <div class="row mb-3">
                                  <label for="inputGambar" class="col-sm-2 col-form-label">Gambar</label>
                                  <div class="col-sm-6">
                                    <input type="file" id="imageUpload" name="gambar" accept=".png, .jpg, .jpeg" />
                                  </div>
                                </div>

                                <div class="row mb-3">
                                  <label for="inputHarga" class="col-sm-2 col-form-label">Harga</label>
                                  <div class="col-sm-6">
                                    <input type="number" name="harga" required class="form-control input-filter" id="inputNama" placeholder="Masukkan harga barang...">
                                  </div>
                                </div>

                                <div class="row mb-3">
                                  <label for="inputSatuan" class="col-sm-2 col-form-label">Satuan</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="satuan" required class="form-control input-filter" id="inputNama" placeholder="Masukkan satuan barang...">
                                  </div>
                                </div>

                                <div class="row mb-3">
                                  <label for="inputStock" class="col-sm-2 col-form-label">Stock</label>
                                  <div class="col-sm-6">
                                    <input type="number" name="stock" required class="form-control input-filter" id="inputNama" placeholder="Masukkan jumalh stock barang...">
                                  </div>
                                </div>

                                <div class="row mb-3">
                                  <label for="inputPermintaan" class="col-sm-2 col-form-label">Permintaan</label>
                                  <div class="col-sm-6">
                                    <input type="number" name="permintaan" required class="form-control input-filter" id="inputNama" placeholder="Masukkan jumalh Permintaan...">
                                  </div>
                                </div>

                                <div class="row mb-3">
                                  <label for="inputKeterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                  <div class="col-sm-6">
                                    <textarea type="text" name="keterangan" required class="form-control input" id="inputUraian" placeholder="Masukan keterangan..."></textarea>
                                    <button type="submit" class="btn btn-primary mt-3 float:right">Tambah</button>
                                    <a href="<?= URLROOT; ?>/perbaikan/deleteSemuaBarang/" class="btn btn-danger mt-3">Hapus Semua</a>
                                  </div>
                                </div>
                                
                                </form>
                                <form role="form" action="<?= URLROOT; ?>/persediaan/tambahbarang" method="POST" enctype="multipart/form-data">
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
                        foreach ($data['tpersediaan'] as $row) {
                        ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $row->namab ?></td>
                                            <td><?= $row->stock ?></td>
                                            <td><?= $row->keterangan ?></td>
                                            <td>
                                            <a href="<?= URLROOT; ?>/persediaan/deleteBarang/<?= $row->id ?>"
                                                class="btn btn-danger"
                                                onclick="return confirm('Hapus barang?');"><i class="fa fa-trash"></i></a>
                                            </td>
                                            
                                        </tr>
                                        <?php 
                        }
                        ?>
                                    </tbody>
                                </table>
                              </div>
                            </div>
                            
                                </br>
                                
                                <!-- /.card-body -->
                                <div class="row mb-3">
                                  <label for="inputUraian" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary">Buat</button>
                                    <a href="<?= URLROOT; ?>/persediaan/barang" class="btn btn-danger">Kembali</a>
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