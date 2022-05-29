<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-lg-12">
            <!-- Main content -->
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                            <form class="form-inline" method="POST" action="<?= URLROOT; ?>/ijinlembur/rekap">
                                <label class="mr-2">Filter Tanggal:</label>
                                <input type="date" class="form-control mr-2" placeholder="Start"  name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : '' ?>" />
                                <label class="mr-2">To</label>
                                <input type="date" class="form-control mr-2" placeholder="End"  name="date2" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : '' ?>"/>
                                <button class="btn btn-primary mr-2" name="search"><span class="fa fa-search"></span></button> 
                                <a href="<?= URLROOT; ?>/ijinlembur/rekap" type="button" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>
                            </form>
                        </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <?php flash(); ?>
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
                                $index = 0;
                                foreach ($data['ijin_lembur'] as $row) {
                                ?>
                                    <tr>
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
                                                        echo '<span style="color:#e67e22;">Menunggu divalidasi</span>';
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
                                                        echo '<span style="color:#e67e22;">Menunggu divalidasi</span>';
                                                    }
                                                }else{
                                                    echo '<span style="color:#e67e22;">Gagal Validasi</span>';
                                                }
                                            ?>
                                            <?php 
                                                if($row->diterbitkan == TRUE){
                                                        echo '</br><b>Surat Ijin Sudah Diterbitkan</b>';
                                                }
                                            ?>
                                        </td>
                                    </tr>
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