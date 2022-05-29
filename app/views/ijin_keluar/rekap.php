<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-lg-12">
            <!-- Main content -->
                        <div class="card-header d-flex flex-row align-items-center justify-content-between">
                            <form class="form-inline" method="POST" action="<?= URLROOT; ?>/ijinkeluar/rekap">
                                <label class="mr-2">Filter Tanggal:</label>
                                <input type="date" class="form-control mr-2" placeholder="Start"  name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : '' ?>" />
                                <label class="mr-2">To</label>
                                <input type="date" class="form-control mr-2" placeholder="End"  name="date2" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : '' ?>"/>
                                <button class="btn btn-primary mr-2" name="search"><span class="fa fa-search"></span></button> 
                                <a href="<?= URLROOT; ?>/ijinkeluar/rekap" type="button" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>
                            </form>
                        </div>
                        <div class="card mb-4">
                        <div class="table-responsive p-3">
                            <?php flash(); ?>
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Tanggal Ijin / Pemohon</th>
                                        <th>Jam Ijin</th>
                                        <th>Keperluan</th>
                                        <th class="col-4">Detail / Atasan</th>
                                    </tr>
                                </thead>
                                <tfoot class="thead-light">
                                    <tr>
                                        <th>Tanggal Ijin / Pemohon</th>
                                        <th>Jam Ijin</th>
                                        <th>Keperluan</th>
                                        <th class="col-4">Detail / Atasan</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php 
                                    $index = 0;
                                    foreach ($data['ijin_keluar'] as $row) {
                                    ?>
                                    <tr>
                                        <td>
                                            <span style="color:#2980b9;"><?= $row->tanggal_ijin ?></span>
                                            <?= '<p>'.$row->nama.'</p>'?>
                                        </td>
                                        <td>
                                            <?php
                                            $timeout = timeFilter($row->jam_keluar);
                                            $timein = timeFilter($row->jam_kembali);
                                            echo $timeout." s/d ".$timein 
                                            ?>
                                        </td>
                                        <td><?= $row->keperluan ?></td>
                                        <td>
                                            <?php 
                                                if(!$row->validasi){
                                                    echo 'Validasi : <span class="text-warning">Belum divalidasi</span>';
                                                }else{
                                                    if($row->validasi == 'Ditolak'){
                                                        echo 'Validasi : <br/> <span class="text-danger">'.$row->validasi.'</span> ('.$data['pejabatvalidasi'][$index]->nama.') <br/>'.$row->waktu_validasi;
                                                        echo '<br/>Alasan : '.$row->alasan_ditolak;
                                                    }else{
                                                        echo 'Validasi : <br/> <span class="text-success">'.$row->validasi.'</span> ('.$data['pejabatvalidasi'][$index]->nama.') <br/>'.$row->waktu_validasi;
                                                    }
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
        <!-- /.content-wrapper -->
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>