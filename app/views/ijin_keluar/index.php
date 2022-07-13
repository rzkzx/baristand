<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-lg-12">
            <!-- Main content -->
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <a href="<?= URLROOT;?>/ijinkeluar/add" class="btn float-right btn-xs btn btn-primary"><i class="fa fa-plus-square"></i> Buat Ijin Keluar</a>
                        </div>
                        <div class="table-responsive p-3">
                            <?php flash(); ?>
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Ijin</th>
                                        <th>Jam Ijin</th>
                                        <th>Keperluan</th>
                                        <th class="col-4">Detail / Atasan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php 
                                    $index = 0;
                                    foreach ($data['ijin_keluar'] as $row) {
                                    ?>
                                    <tr>
                                        <td><?= $index+1; ?></td>
                                        <td>
                                            <span style="color:#2980b9;"><?= $row->tanggal_ijin ?></span>
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
                                                    echo '<span style="color:#e67e22;">Menunggu divalidasi</span> <br/> ('.$data['pejabat_validasi'][$index]->nama.')';
                                                }else{
                                                    if($row->validasi == 'Ditolak'){
                                                        echo 'Validasi : <span class="text-danger">'.$row->validasi.'</span>, ('.$data['pejabat_validasi'][$index]->nama.') <br/>'.$row->waktu_validasi;
                                                        echo '<br/>Alasan : '.$row->alasan_ditolak;
                                                    }else{
                                                        echo 'Validasi : <span class="text-success">'.$row->validasi.'</span>, ('.$data['pejabat_validasi'][$index]->nama.') <br/>'.$row->waktu_validasi;
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
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>