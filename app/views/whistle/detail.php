<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
      <div class="col-lg-12">
          <div class="card">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <a href="<?= URLROOT;?>/whistle/laporan" class="btn float-right btn-xs btn btn-danger">Kembali</a>
                  <a href="<?= URLROOT;?>/whistle/cetak/<?= $data['whistle']->id ?>" target="_blank" class="btn float-right btn-xs btn btn-primary">Cetak</a>
              </div>
              <div class="card-body">
              <table class="table">
              <tbody>
                <tr>
                  <th scope="row">Pelapor</th>
                  <th scope="row">:</th>
                  <td><?= $data['whistle']->nama ?></td>
                </tr>
                <tr>
                  <th scope="row">Nama</th>
                  <th scope="row">:</th>
                  <td><?= $data['whistle']->nama_pelaporan ?></td>
                </tr>
                <tr>
                  <th scope="row">Instansi</th>
                  <th scope="row">:</th>
                  <td><?= $data['whistle']->instansi ?></td>
                </tr>
                <tr>
                  <th scope="row">Alamat</th>
                  <th scope="row">:</th>
                  <td><?= $data['whistle']->alamat ?></td>
                </tr>
                <tr>
                  <th scope="row">Email</th>
                  <th scope="row">:</th>
                  <td><?= $data['whistle']->email ?></td>
                </tr>
                <tr>
                  <th scope="row">Telepon</th>
                  <th scope="row">:</th>
                  <td><?= $data['whistle']->telepon ?></td>
                </tr>
                <tr>
                  <th scope="row">Judul Laporan</th>
                  <th scope="row">:</th>
                  <td><?= $data['whistle']->judul_laporan ?></td>
                </tr>
                <tr>
                  <th scope="row">Uraian Laporan</th>
                  <th scope="row">:</th>
                  <td><?= $data['whistle']->uraian_laporan ?></td>
                </tr>
                <tr>
                  <th scope="row">Data Dukung</th>
                  <th scope="row">:</th>
                  <td>
                    <a href="<?= URLROOT ?>/public/files/whistle/<?= $data['whistle']->data_dukung; ?>" target="_blank" style="background-color:#2980b9;color:white;border-radius:5px;padding:5px 10px;"><?= $data['whistle']->data_dukung ?></a>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Pelanggaran</th>
                  <th scope="row">:</th>
                  <td>
                    <ul>
                    <?php 
                    $pelanggaran = explode(',',$data['whistle']->pelanggaran);
                    foreach ($pelanggaran as $v) {
                    ?>
                      <li><?= $v ?></li>
                    <?php
                    }
                    ?>
                    </ul>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Tanggal</th>
                  <th scope="row">:</th>
                  <td><?= dateID($data['whistle']->tanggal); ?></td>
                </tr>
              </tbody>
              </table>
              </div>
          </div>
      </div>
  </div>
  <?php require APPROOT . '/views/inc/footer.php'; ?>