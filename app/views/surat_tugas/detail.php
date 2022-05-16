<?php require APPROOT . '/views/inc/header.php'; ?>
<section class="section">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <a href="<?= URLROOT;?>/surattugas/rekap" class="btn float-right btn-xs btn btn-danger">Kembali</a>
                  <?php if($data['laporan']->disahkan){ ?>
                    <a href="<?= URLROOT;?>/surattugas/cetak/<?= $data['laporan']->id ?>" target="_blank" class="btn float-right btn-xs btn btn-primary">Cetak</a>
                  <?php } ?>
                </div>
                <div class="card-body">
                <table class="table">
                <tbody>
                  <?php if($data['laporan']->nomor_surat && $data['laporan']->disahkan){ ?>
                    <tr>
                      <th scope="row">Nomor Surat</th>
                      <th scope="row">:</th>
                      <td><?= $data['laporan']->nomor_surat ?></td>
                    </tr>
                  <?php } ?>
                  <tr>
                    <th scope="row">Nama Pengusul</th>
                    <th scope="row">:</th>
                    <td><?= $data['laporan']->nama ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Jabatan Pengusul</th>
                    <th scope="row">:</th>
                    <td><?= $data['laporan']->jabatan ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Nama yang Ditugaskan</th>
                    <th scope="row">:</th>
                    <td><?= $data['laporan']->nip_ditugaskan ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Tujuan Tugas</th>
                    <th scope="row">:</th>
                    <td><?= $data['laporan']->tujuan_tugas ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Keperluan Tugas</th>
                    <th scope="row">:</th>
                    <td><?= $data['laporan']->keperluan_tugas ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Tanggal Berangkat</th>
                    <th scope="row">:</th>
                    <td><?= $data['laporan']->tanggal_berangkat ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Tanggal Kembali</th>
                    <th scope="row">:</th>
                    <td><?= $data['laporan']->tanggal_kembali ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Lama Tugas</th>
                    <th scope="row">:</th>
                    <td><?= $data['laporan']->lama_tugas ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Instansi Dituju</th>
                    <th scope="row">:</th>
                    <td><?= $data['laporan']->instansi_dituju ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Jenis Surat Tugas</th>
                    <th scope="row">:</th>
                    <td>
                      <?php 
                        if($data['laporan']->is_biaya){
                          echo 'Surat Tugas Dengan Biaya';
                        }else{
                          echo 'Surat Tugas Tanpa Biaya';
                        }
                      ?>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">Nama Pengikut</th>
                    <th scope="row">:</th>
                    <td>
                      <ul>
                      <?php
                      foreach ($data['pengikut'] as $p) {
                        echo '<li>'.$p->nama.' ('.$p->nip.')</li>';
                      }
                      ?>
                      </ul>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">Dasar Surat</th>
                    <th scope="row">:</th>
                    <td>
                      <a href="<?= URLROOT ?>/public/files/dasar_surat/<?= $data['laporan']->dasar_surat; ?>" style="background-color:#2980b9;color:white;border-radius:5px;padding:5px 10px;"><?= $data['laporan']->dasar_surat ?></a>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">Detail Perjalanan</th>
                    <th scope="row">:</th>
                    <td><?= $data['laporan']->detail_perjalanan ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Nama PPK</th>
                    <th scope="row">:</th>
                    <td><?= $data['ppk']->nama ?></td>
                  </tr>
                  <?php if($data['laporan']->anggaran){ ?>
                    <tr>
                      <th scope="row">Anggaran</th>
                      <th scope="row">:</th>
                      <td><?= rupiah($data['laporan']->anggaran); ?></td>
                    </tr>
                  <?php } ?>
                  <?php if($data['laporan']->file_st){ ?>
                    <tr>
                      <th scope="row">Surat Tugas</th>
                      <th scope="row">:</th>
                      <td>
                        <a href="<?= URLROOT ?>/public/files/surat_tugas/<?= $data['laporan']->file_st; ?>" style="background-color:#2980b9;color:white;border-radius:5px;padding:5px 10px;"><?= $data['laporan']->file_st ?></a>
                      </td>
                    </tr>
                  <?php } ?>
                  <?php if($data['laporan']->file_spd){ ?>
                    <tr>
                      <th scope="row">Surat Perjalanan Dinas</th>
                      <th scope="row">:</th>
                      <td>
                        <a href="<?= URLROOT ?>/public/files/surat_pd/<?= $data['laporan']->file_spd; ?>" style="background-color:#2980b9;color:white;border-radius:5px;padding:5px 10px;"><?= $data['laporan']->file_spd ?></a>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require APPROOT . '/views/inc/footer.php'; ?>