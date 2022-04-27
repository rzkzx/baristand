<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <a href="<?= URLROOT;?>/gratifikasi/rekap" class="btn float-right btn-xs btn btn-danger">Kembali</a>
                <?php if($data['gratifikasi']->is_tindak){ ?>
                  <a href="<?= URLROOT;?>/gratifikasi/cetak/<?= $data['gratifikasi']->id ?>" target="_blank" class="btn float-right btn-xs btn btn-primary">Cetak</a>
                <?php } ?>
            </div>
            <div class="card-body">
            <table class="table">
            <tbody>
              <tr>
                <th scope="row">Pelapor</th>
                <th scope="row">:</th>
                <td><?= $data['gratifikasi']->nama ?></td>
              </tr>
              <tr>
                <th scope="row" colspan="3" class="text-center alert-warning">Data Pemberian Gratifikasi</th>
              </tr>
              <tr>
                <th scope="row">Jenis Penerimaan</th>
                <th scope="row">:</th>
                <td><?= $data['gratifikasi']->jenis_penerimaan ?></td>
              </tr>
              <tr>
                <th scope="row">Uraian</th>
                <th scope="row">:</th>
                <td><?= $data['gratifikasi']->uraian ?></td>
              </tr>
              <tr>
                <th scope="row">Taksiran</th>
                <th scope="row">:</th>
                <td><?= rupiah($data['gratifikasi']->taksiran) ?></td>
              </tr>
              <tr>
                <th scope="row">Jenis Peristiwa</th>
                <th scope="row">:</th>
                <td><?= $data['gratifikasi']->jenis_peristiwa ?></td>
              </tr>
              <tr>
                <th scope="row">Tempat Penerimaan</th>
                <th scope="row">:</th>
                <td><?= $data['gratifikasi']->tempat_penerimaan ?></td>
              </tr>
              <tr>
                <th scope="row">Tanggal</th>
                <th scope="row">:</th>
                <td><?= dateID($data['gratifikasi']->tanggal) ?></td>
              </tr>
              <tr>
                <th scope="row" colspan="3" class="text-center alert-warning">Data Penerima dan Pemberi Gratifikasi</th>
              </tr>
              <tr>
                <th scope="row">Nama Penerima</th>
                <th scope="row">:</th>
                <td><?= $data['gratifikasi']->penerima ?></td>
              </tr>
              <tr>
                <th scope="row">Pemberi</th>
                <th scope="row">:</th>
                <td><?= $data['gratifikasi']->pemberi ?></td>
              </tr>
              <tr>
                <th scope="row">Pekerjaan</th>
                <th scope="row">:</th>
                <td><?= $data['gratifikasi']->pekerjaan ?></td>
              </tr>
              <tr>
                <th scope="row">Jabatan</th>
                <th scope="row">:</th>
                <td><?= $data['gratifikasi']->jabatan ?></td>
              </tr>
              <tr>
                <th scope="row">Alamat</th>
                <th scope="row">:</th>
                <td><?= $data['gratifikasi']->alamat ?></td>
              </tr>
              <tr>
                <th scope="row">Telepon</th>
                <th scope="row">:</th>
                <td><?= $data['gratifikasi']->telepon ?></td>
              </tr>
              <tr>
                <th scope="row">Email</th>
                <th scope="row">:</th>
                <td><?= $data['gratifikasi']->email ?></td>
              </tr>
              <tr>
                <th scope="row">Hubungan</th>
                <th scope="row">:</th>
                <td><?= $data['gratifikasi']->hubungan ?></td>
              </tr>
              <tr>
                <th scope="row" colspan="3" class="text-center alert-warning">Alasan dan Kronologi</th>
              </tr>
              <tr>
                <th scope="row">Alasan Pemberian</th>
                <th scope="row">:</th>
                <td><?= $data['gratifikasi']->alasan_pemberian ?></td>
              </tr>
              <tr>
                <th scope="row">Kronologi Penerimaan</th>
                <th scope="row">:</th>
                <td><?= $data['gratifikasi']->kronologi_penerimaan ?></td>
              </tr>
              <tr
              <?php 
                if($data['gratifikasi']->is_tindak){
                  echo 'class="alert-success"';
                }
              ?>
              >
                <th scope="row" colspan="3" class="text-center">Tindakan oleh TIM FKAP</th>
              </tr>
              <tr 
              <?php 
                if($data['gratifikasi']->is_tindak){
                  echo 'class="alert-success"';
                }
              ?>
              >
                <th scope="row">Tindakan</th>
                <th scope="row">:</th>
                <td>
                  <?php 
                  if($data['gratifikasi']->is_tindak){
                    echo $data['gratifikasi']->tindakan;
                  }else{
                    echo '<span class="text-danger">Belum ditinjak lanjuti oleh Tim FKAP</span>';
                  } 
                  ?>
                </td>
              </tr>
            </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>