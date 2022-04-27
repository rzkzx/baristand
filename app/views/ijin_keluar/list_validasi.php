<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-lg-12">
            <!-- Main content -->
                    <div class="card mb-4">
                        <div class="table-responsive p-3">
                            <?php flash(); ?>
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Tanggal Ijin / Pemohon</th>
                                        <th>Jam Ijin</th>
                                        <th>Keperluan</th>
                                        <th class="col-4">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php 
                                    foreach ($data['ijin_keluar'] as $row) {
                                    ?>
                                    <tr>
                                        <td>
                                            <span style="color:#2980b9;"><?= $row->tanggal_ijin ?></span>
                                            <?= '<p>'.$row->nama.'</p>'; ?>
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
                                                    echo '<a href="'.URLROOT.'/ijinkeluar/validasi/'.$row->id.'" class="btn btn-primary">Validasi</a>';
                                                }else{
                                                    if($row->validasi == 'Ditolak'){
                                                        echo 'Validasi : <span class="text-danger">'.$row->validasi.'</span>, '.$row->waktu_validasi;
                                                        echo '<br/>Alasan : '.$row->alasan_ditolak;
                                                    }else{
                                                        echo 'Validasi : <span class="text-success">'.$row->validasi.'</span>, '.$row->waktu_validasi;
                                                    }
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php 
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