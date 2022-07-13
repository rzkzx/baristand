<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-lg-12">
            <!-- Main content -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <?php flash(); ?>
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="10">No</th>
                                        <th class="col-3">Tanggal Ijin / Pemohon</th>
                                        <th class="col-2">Jam Ijin</th>
                                        <th class="col-4">Keperluan</th>
                                        <th class="col-3">Validasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                    $index = 0;
                    foreach ($data['ijin_lembur'] as $row) {
                    ?>
                                    <tr>
                                        <td><?= $index+1; ?></td>
                                        <td>
                                            <span style="color:#2980b9;"><?= $row->tanggal_ijin ?></span>
                                            <br/>
                                            <?php foreach ($data['pemohon'][$index] as $k) {
                                                echo $k->nama. '<br/>';
                                            } ?>
                                        </td>
                                        <td>
                                            <?php
                                            $timeout = timeFilter($row->jam_mulai);
                                            $timein = timeFilter($row->jam_berakhir);
                                            echo $timeout." s/d ".$timein 
                                            ?>
                                        </td>
                                        <td><?= $row->keperluan ?></td>
                                        <td>
                                            Atasan Langsung :
                                            <?php 
                                                if(!$row->validasi_atasan_langsung){
                                                    if($row->pejabat_validasi == $_SESSION['nip']){
                                                        echo '<a href="'.URLROOT.'/ijinlembur/validasi_atasan/'.$row->id.'" class="btn btn-primary btn-sm">Validasi</a>';
                                                    }else{
                                                        echo '<span style="color:#e67e22;">Menunggu divalidasi</span>';
                                                    }
                                                }else{
                                                    if($row->validasi_atasan_langsung == 'Ditolak'){
                                                        echo '<span class="text-danger">'.$row->validasi_atasan_langsung.'</span>, '.$row->waktu_validasi_atasan_langsung;
                                                        echo '<br/>Alasan : '.$row->alasan_ditolak;
                                                    }else{
                                                        echo '<span class="text-success">'.$row->validasi_atasan_langsung.'</span>, '.$row->waktu_validasi_atasan_langsung;
                                                    }
                                                }
                                            ?>
                                            <br/>
                                            Kepala Balai : 
                                            <?php 
                                                if(!$row->validasi_atasan_langsung){
                                                    echo '<span style="color:#e67e22;">Belum divalidasi</span>';
                                                }else if($row->validasi_atasan_langsung == 'Diterima'){
                                                    if($row->validasi_kepala_balai){
                                                        if($row->validasi_kepala_balai == 'Diterima'){
                                                            echo '<span class="text-success">'.$row->validasi_kepala_balai.'</span>, '.$row->waktu_validasi_kepala_balai;
                                                        }else{
                                                            echo '<span class="text-danger">'.$row->validasi_kepala_balai.'</span>, '.$row->waktu_validasi_kepala_balai;
                                                            echo '</br>Alasan : '.$row->alasan_ditolak;
                                                        }
                                                    }else{
                                                        if(Middleware::jabatan('kepala_balai')){
                                                            echo '<a href="'.URLROOT.'/ijinlembur/validasi_kb/'.$row->id.'" class="btn btn-primary btn-sm">Validasi</a>';
                                                        }else{
                                                            echo '<span style="color:#e67e22;">Menunggu divalidasi</span>';
                                                        }
                                                    }
                                                }else{
                                                    echo '<span style="color:#e67e22;">Gagal Validasi</span>';
                                                }
                                            ?>
                                            <?php 
                                                if($row->diterbitkan == TRUE){
                                                    if(Middleware::admin('kepegawaian')){
                                                        echo '</br><a href="'.URLROOT.'/ijinlembur/cetak/'.$row->id.'" target="_blank" class="btn btn-success btn-sm">Cetak</a>';
                                                        echo '<a href="'.URLROOT.'/ijinlembur/terbitkan/'.$row->id.'" class="ml-2 btn btn-primary btn-sm">Ubah Nomor Surat</a>';
                                                    }else{
                                                        echo '</br><b>Surat Ijin Sudah Diterbitkan</b>';
                                                    }
                                                }else{
                                                    if(Middleware::admin('kepegawaian')){
                                                        if($row->validasi_atasan_langsung == 'Diterima' && $row->validasi_kepala_balai == 'Diterima'){
                                                            echo '</br><a href="'.URLROOT.'/ijinlembur/terbitkan/'.$row->id.'" class="btn btn-primary btn-sm">Input Nomor Surat</a>';
                                                        }
                                                    }else{
                                                        echo '</br><b class="text-danger">Surat ijin dalam proses...</b>';
                                                    }
                                                }
                                            ?>
                                        </td>
                                    </track>
                                    <?php 
                        $index++;
                    }
                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
            <!-- /.content -->
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>