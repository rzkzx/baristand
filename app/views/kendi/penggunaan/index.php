<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
        <div class="table-responsive p-3">
            <?php flash(); ?>
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
            <thead class="thead-light">
                <tr>
                <th width="25">No.</th>
                <th>Keterangan Peminjaman</th>
                <th>Detail Peminjaman</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $index = 1;
                foreach ($data['peminjaman'] as $row) :
                ?>
                    <tr <?php if($row->selesai) echo 'style="background-color:#F9FFF7;"' ?>>
                        <td width="25"><?= $index ?></td>
                        <td>
                            <span style="color:#2980b9;"><?= $row->waktu ?></span>
                            <br>
                            <?= $row->nama ?> / <?= $row->pemohon ?>
                            <br><br>
                            <b>Status : </b> 
                            <?php 
                            if(!$row->validasi_atasan){
                                echo '<span class="text-success">Permohonan Dibuat</span> (<i><span style="color:#e67e22;">Menunggu validasi atasan</span></i>)';
                            }elseif($row->validasi_atasan && !$row->validasi_kasubagtu){
                                if($row->validasi_atasan == 'Diterima'){
                                    echo '<span class="text-success">Diterima Atasan Langsung</span> (<i><span style="color:#e67e22;">Menunggu validasi Kasubag TU</span></i>)';
                                }else{
                                    echo '<span class="text-danger">Ditolak Atasan Langsung</span><br>';
                                    echo 'Alasan Ditolak : '.$row->alasan_ditolak;
                                }
                            }elseif($row->validasi_atasan && $row->validasi_kasubagtu && !$row->diserahkan){
                                if($row->validasi_kasubagtu == 'Diterima'){
                                    echo '<span class="text-success">Diterima Kasubag TU</span> (<i><span style="color:#e67e22;">Menunggu kendaraan diserahkan</span></i>)';
                                }else{
                                    echo '<span class="text-danger">Ditolak Kasubag TU</span><br>';
                                    echo 'Alasan Ditolak : '.$row->alasan_ditolak;
                                }
                            }elseif($row->diserahkan && !$row->selesai){
                                echo 'Kendaraan telah diserahkan pada<span class="text-success"> '.$row->waktu_diserahkan.'</span>';
                            }elseif($row->selesai){
                                echo 'Peminjaman telah selesai pada<span class="text-success"> '.$row->waktu_selesai.'</span>';
                            }
                            ?>
                        </td>
                        <td>
                            Kendaraan :  
                            <?php
                                $kend = $data['kend'][$index];
                                echo '<b>'.$kend->merk.' / '.$kend->tipe.' / '.$kend->nopol.'</b>';
                            ?>
                            <br>
                            Keperluan : <b><?= $row->keperluan ?></b>
                            <?php
                            if($row->keterangan){
                                echo '<br>('.$row->keterangan.')';
                            }
                            ?>
                            <br><br>
                            Jenis Peminjaman : <b><?= $row->jenis_peminjaman ?></b>
                            <br>
                            <?php if($row->jenis_peminjaman == 'Jam'){ ?>
                                Tanggal : <b><?= dateID($row->tanggal) ?></b><br>
                                Jam : <b><?= timeID($row->jam_mulai) ?> - <?= timeID($row->jam_selesai) ?></b><br>
                            <?php }else{ ?>
                                Tanggal : <b><?= dateID($row->tgl_mulai) ?> - <?= dateID($row->tgl_selesai) ?></b><br>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php 
                    $index++;
                endforeach;
                ?>
            </tbody>
            </table>
        </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>