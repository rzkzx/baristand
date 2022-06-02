<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="content-wrapper">
            <!-- Main content -->
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <a href="<?= URLROOT;?>/perbaikan/add" class="btn float-right btn-xs btn btn-primary"><i class="fa fa-plus-square"></i> Buat Permohonan</a>
                        </div>
                        <div class="card-body">
                            <?php flash(); ?>
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Keterangan Permohonan</th>
                                        <th>Detail Permohonan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php 
                    $no = 1;
                    foreach ($data['perbaikan'] as $row) {
                    ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td>
                                        <span style="color:#2980b9;"> <?= timeFilter($row->jam) , " - ", dateID($row->tanggal)?> </span> <?=
                                        "<br/>", $row->nama," (",$row->nip_pemohon,")",
                                        "<br/>", $row->serial_number,
                                        "<br/>",
                                        "<br/>","<b>Status : </b>"?>
                                        <?php 
                                            if(!$row->waktu_validasi1){
                                                echo '<span class="text-success">Permohonan dibuat '.$row->tanggal.'</span>';
                                            }
                                            elseif(!$row->waktu_validasi2 && $row->alasan1){
                                                echo '<span class="text-danger">Ditolak Atasan langsung '.$row->waktu_validasi1.'</span>';
                                            }
                                            elseif(!$row->waktu_validasi2){
                                                    echo '<span class="text-success">Disetujui Atasan langsung '.$row->waktu_validasi1.'</span>';
                                                }
                                            elseif(!$row->disposisi && $row->alasan2){
                                                    echo '<span class="text-danger">Ditolak Kepala balai'.$row->waktu_validasi2.'</span>';
                                                }
                                            elseif(!$row->disposisi && !$row->alasan_dispo){
                                                    echo '<span class="text-success">Disetujui Kepala balai'.$row->waktu_validasi2.'</span>';
                                                }
                                            elseif(!$row->penugasan && $row->alasan_dispo){
                                                    echo '<span class="text-danger">Ditolak Kasubag TU '.$row->waktu_disposisi.'</span>';
                                                }
                                            elseif(!$row->penugasan){
                                                    echo '<span class="text-success">Didisposisikan Kasubag TU '.$row->waktu_disposisi.'</span>';
                                                }
                                                elseif(!$row->waktu_diterima){
                                                    echo '<span class="text-success">Perbaikan telah ditugaskan Penanggung Jawab '.($row->waktu_penugasan).'</span>';
                                                }
                                            elseif(!$row->verifikasi_selesai){
                                                    echo '<span class="text-success">Sebagian perbaikan telah diterima Petugas '.$row->waktu_diterima.'</span>';
                                                }
                                            elseif(!$row->hasil){
                                                    echo '<span class="text-success">Sebagian perbaikan telah selesai diperbaiki '.$row->waktu_selesai.'</span>';
                                                }
                                                else{
                                                    echo '<span class="text-success">Hasil diterima Pemohon '.$row->waktu_hasil.'</span>';
                                                }
                                            ?>
                                        <?= "<br/>";
                                        ?>
                                        <?php 
                                                if(!$row->waktu_validasi1){
                                                    if($row->nip_atasan == $_SESSION['nip']){
                                                        echo '<br/>Validasi AL : <u><a href="'.URLROOT.'/perbaikan/validasi1/'.$row->serial_number.'">Validasi</a></u>';
                                                    }else{
                                                        echo '<br/>Validasi AL : <span class="text-warning">Menunggu validasi</span>';
                                                    }

                                                }else{
                                                    if($row->alasan1){
                                                        echo '<br/>Validasi AL : <span class="text-danger">Ditolak</span> karena '.$row->alasan1.'  <span>'.$row->waktu_validasi1.'</span>';
                                                    }else{
                                                        echo '<br/>Validasi AL : <span class="text-success">Diterima</span>';
                                                    }

                                                }
                                        //
                                                if(!$row->waktu_validasi1){
                                                    echo '<br/>Validasi Kepala Balai : <span class="text-warning">Menunggu validasi</span>';
                                                }else{
                                                    if($row->waktu_validasi2){
                                                        if(!$row->alasan2){
                                                            echo '<br/>Validasi Kepala Balai : <span class="text-success">Diterima</span>';
                                                        }else{
                                                            echo '<br/>Validasi Kepala Balai : <span class="text-danger">Ditolak</span> karena '.$row->alasan2.' <span style="color:#2980b9;">'.$row->waktu_validasi2.'</span>';
                                                        }
                                                    }else{
                                                        if(Middleware::jabatan('kepala_balai') && !$row->alasan1){
                                                            echo '<br/>Validasi Kepala Balai : <u><a href="'.URLROOT.'/perbaikan/validasi2/'.$row->serial_number.'">Validasi</a></u>';
                                                        }else{
                                                            echo '<br/>Validasi Kepala Balai : <span class="text-warning">Menunggu validasi</span>';
                                                        }
                                                    }
                                                }
                                    //
                                                if(!$row->validasi2){
                                                    echo '<br/>Validasi Kasubag : <span class="text-warning">Menunggu validasi</span>';
                                                }else{
                                                    if($row->alasan_dispo){
                                                        echo '<br/>Validasi Kasubag : <span class="text-danger">Ditolak</span> karena '.$row->alasan_dispo.' <span style="color:#2980b9;">'.$row->waktu_disposisi.'</span>';
                                                    }elseif($row->disposisi){
                                                        echo '<br/>Validasi Kasubag : <span class="text-success">Diterima</span>';
                                                    }else{
                                                        if(Middleware::jabatan('kasubag_tu') && !$row->alasan2){
                                                            echo '<br/>Disposisi Kesubag TU : <u><a href="'.URLROOT.'/perbaikan/validasikasubag/'.$row->serial_number.'">Disposisikan</a></u>';
                                                        }else{
                                                            echo '<br/>Validasi Kasubag : <span class="text-warning">Menunggu validasi</span>';
                                                        }
                                                    }
                                                }
                                // 
                                                if($row->disposisi){
                                                    if(!$row->penugasan){
                                                        if($_SESSION['nip'] == $row->nip_penanggung){
                                                            echo '<br/>Penugasan : <u><a href="'.URLROOT.'/perbaikan/penugasan/'.$row->serial_number.'">Pilih Petugas</a></u>';
                                                        }
                                                    }else{

                                                    }
                                                }else{
                                                    
                                                }
                                //
                                                if($row->penugasan){
                                                    if(!$row->hasil){
                                                        $petugas = explode(',',$row->nip_petugas_perbaikan);
                                                        if(in_array($_SESSION['nip'] , $petugas)){
                                                                echo '<br/>Penugasan : <u><a href="'.URLROOT.'/perbaikan/konfirmasiPenugasan/'.$row->serial_number.'">Konfirmasi penugasan</a></u>';
                                                        }else{

                                                        }
                                                    }else{

                                                    }
                                                }else{
                                    
                                                }
                                //      
                                        if($row->penugasan){
                                            if($row->hasil){
                                                echo '<br/>Validasi Hasil : <span class="text-success">Diterima</span>';
                                            }else{
                                                if($row->nip_pemohon == $_SESSION['nip']){
                                                    echo '<br/>Validasi hasil diterima : <u><a href="'.URLROOT.'/perbaikan/hasil/'.$row->serial_number.'">Validasi</a></u>';
                                                }else{
                                                    echo '<br/>Validasi hasil : <span class="text-warning">Menunggu validasi</span>';
                                                }
                                            }
                                        }else{
                                            echo '<br/>Validasi hasil : <span class="text-warning">Menunggu validasi</span>';
                                        }
                                    ?>
                                        </td>
                                        <td>
                                            <?php 
                                            $data = explode('.',$row->keterangan);
                                            foreach($data as $k){
                                                if($k){
                                                    $v = explode(',',$k);
                                                    echo $v[0].'. '.$v[1].' ['.$v[2].'] '.$v[3];
                                                    echo '<br/>';
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td>
                                        <a href="<?= URLROOT; ?>/perbaikan/informasi/<?= $row->serial_number ?>"class="btn btn-primary"><i class="fa fa-eye"></i></a>
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
        <!-- /.content-wrapper -->
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>