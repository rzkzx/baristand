<div class="row">
    <div class="col-lg-12">
            <!-- Main content -->
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                            <form class="form-inline" method="POST" action="<?= base_url; ?>/ijinlembur/rekap">
                                <label class="mr-2">Filter Tanggal:</label>
                                <input type="date" class="form-control mr-2" placeholder="Start"  name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : '' ?>" />
                                <label class="mr-2">To</label>
                                <input type="date" class="form-control mr-2" placeholder="End"  name="date2" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : '' ?>"/>
                                <button class="btn btn-primary mr-2" name="search"><span class="fa fa-search"></span></button> 
                                <a href="<?= base_url; ?>/ijinlembur/rekap" type="button" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>
                            </form>
                        </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <?php Flasher::Message(); ?>
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Tanggal Ijin</th>
                                        <th class="col-2">Jam Ijin</th>
                                        <th class="col-4">Keperluan</th>
                                        <th class="col-4">Validasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                    $no = 1;
                    foreach ($data['ijinlembur'] as $row) {
                    ?>
                                    <tr>
                                        <td>
                                            <span style="color:#2980b9;"><?= $row['tanggal_ijin'] ?></span>
                                            <p><?= $row['nama'] ?></p>
                                        </td>
                                        <td>
                                            <?php
                                            $timeout = Helper::timeFilter($row['jam_mulai']);
                                            $timein = Helper::timeFilter($row['jam_berakhir']);
                                            echo $timeout." s/d ".$timein 
                                            ?>
                                        </td>
                                        <td><?= $row['keperluan'] ?></td>
                                        <td>
                                            Atasan Langsung :
                                            <?php 
                                                if(!$row['validasi_atasan_langsung']){
                                                    if($row['pejabat_validasi'] == $_SESSION['nip']){
                                                        echo '<span style="color:#e67e22;">Menunggu divalidasi</span>';
                                                    }
                                                }else{
                                                    if($row['validasi_atasan_langsung'] == 'Ditolak'){
                                                        echo '<span class="text-danger">'.$row['validasi_atasan_langsung'].'</span>, '.$row['waktu_validasi_atasan_langsung'];
                                                        echo '<br/>Alasan : '.$row['alasan_ditolak'];
                                                    }else{
                                                        echo '<span class="text-success">'.$row['validasi_atasan_langsung'].'</span>, '.$row['waktu_validasi_atasan_langsung'];
                                                    }
                                                }
                                            ?>
                                            <br/>
                                            Kepala Balai : 
                                            <?php 
                                                if(!$row['validasi_atasan_langsung']){
                                                    echo '<span style="color:#e67e22;">Belum divalidasi</span>';
                                                }else if($row['validasi_atasan_langsung'] == 'Diterima'){
                                                    if($row['validasi_kepala_balai']){
                                                        if($row['validasi_kepala_balai'] == 'Diterima'){
                                                            echo '<span class="text-success">'.$row['validasi_kepala_balai'].'</span>, '.$row['waktu_validasi_kepala_balai'];
                                                        }else{
                                                            echo '<span class="text-danger">'.$row['validasi_kepala_balai'].'</span>, '.$row['waktu_validasi_kepala_balai'];
                                                            echo '</br>Alasan : '.$row['alasan_ditolak'];
                                                        }
                                                    }else{
                                                        echo '<span style="color:#e67e22;">Menunggu divalidasi</span>';
                                                    }
                                                }else{
                                                    echo '<span style="color:#e67e22;">Gagal Validasi</span>';
                                                }
                                            ?>
                                            <?php 
                                                if($row['diterbitkan'] == TRUE){
                                                    if($data['kepegawaian']){
                                                        echo '</br><a href="'.base_url.'/ijinlembur/cetak/'.$row['id'].'" target="_blank" class="btn btn-success btn-sm">Cetak</a>';
                                                    }else{
                                                        echo '</br><b>Surat Izin Sudah Diterbitkan</b>';
                                                    }
                                                }else{
                                                    if($data['kepegawaian']){
                                                        if($row['validasi_atasan_langsung'] == 'Diterima' && $row['validasi_kepala_balai'] == 'Diterima'){
                                                            echo '</br><a href="'.base_url.'/ijinlembur/nomor_surat/'.$row['id'].'" class="btn btn-primary btn-sm">Input Nomor Surat</a>';
                                                        }
                                                    }
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php 
                        $no++;
                    }
                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
            <!-- /.content -->
    </div>
</div>