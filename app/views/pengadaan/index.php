<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="content-wrapper">
            <!-- Main content -->
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <a href="<?= URLROOT;?>/pengadaan/add" class="btn float-right btn-xs btn btn-primary"><i class="fa fa-plus-square"></i> Buat Permohonan</a>
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
                    foreach ($data['pengadaan'] as $row) {
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
                                                echo '<span class="text-danger">Ditolak atasan langsung '.$row->waktu_validasi1.'</span>';
                                            }
                                            elseif(!$row->waktu_validasi2){
                                                    echo '<span class="text-success">Disetujui atasan langsung '.$row->waktu_validasi1.'</span>';
                                                }
                                            elseif(!$row->waktu_validasi3 && $row->alasan2){
                                                    echo '<span class="text-danger">Ditolak kasubag tu '.$row->waktu_validasi2.'</span>';
                                                }
                                            elseif(!$row->waktu_validasi3){
                                                        echo '<span class="text-success">Disetujui kasubag tu '.$row->waktu_validasi2.'</span>';
                                                    }
                                            elseif(!$row->disposisi && $row->alasan3){
                                                    echo '<span class="text-danger">Ditolak kepala balai '.$row->waktu_validasi3.'</span>';
                                                }
                                            elseif($row->waktu_validasi3 && !$row->alasan_dispo){
                                                    echo '<span class="text-success">Disetujui kepala balai '.$row->waktu_validasi3.'</span>';
                                                }
                                            elseif(!$row->penugasan && $row->alasan_dispo){
                                                    echo '<span class="text-danger">Ditolak PPK '.$row->waktu_disposisi.'</span>';
                                                }
                                            elseif(!$row->penugasan){
                                                    echo '<span class="text-success">Didisposisikan PPK '.$row->waktu_disposisi.'</span>';
                                                }
                                                elseif(!$row->waktu_diterima){
                                                    echo '<span class="text-success">Pengadaan telah ditugaskan Pejabat Pengadaan '.($row->waktu_penugasan).'</span>';
                                                }
                                            elseif(!$row->verifikasi_selesai){
                                                    echo '<span class="text-success">Sebagian pengadaan telah diterima petugas '.$row->waktu_diterima.'</span>';
                                                }
                                            elseif(!$row->hasil){
                                                    echo '<span class="text-success">Sebagian pengadaan telah selesai diadakan '.$row->waktu_selesai.'</span>';
                                                }
                                                else{
                                                    echo '<span class="text-success">Hasil diterima pemohon '.$row->waktu_hasil.'</span>';
                                                }
                                            ?>
                                        <?= "<br/>";
                                        ?>
                                        <?php 
                                                if(!$row->waktu_validasi1){
                                                    if($row->nip_atasan == $_SESSION['nip']){
                                                        echo '<br/>Validasi AL : <u><a href="'.URLROOT.'/pengadaan/validasi1/'.$row->serial_number.'">Validasi</a></u>';
                                                    }else{
                                                        echo '<br/>Validasi AL : <span class="text-warning">Menunggu validasi</span>';
                                                    }

                                                }else{
                                                    if($row->alasan1){
                                                        echo '<br/>Validasi AL : <span class="text-danger">Ditolak</span> karena '.$row->alasan1.'  <span style="color:#2980b9;">'.$row->waktu_validasi1.'</span>';
                                                    }else{
                                                        echo '<br/>Validasi AL : <span class="text-success">Diterima</span>';
                                                    }

                                                }

                                         //
                                                  if(!$row->waktu_validasi1){
                                                    echo '<br/>Validasi Kasubag TU : <span class="text-warning">Menunggu validasi</span>';
                                                }else{
                                                    if($row->waktu_validasi2){
                                                        if(!$row->alasan2){
                                                            echo '<br/>Validasi Kasubag TU : <span class="text-success">Diterima</span>';
                                                        }else{
                                                            echo '<br/>Validasi Kasubag TU : <span class="text-danger">Ditolak</span> karena '.$row->alasan2.' <span style="color:#2980b9;">'.$row->waktu_validasi2.'</span>';
                                                        }
                                                    }else{
                                                        if(Middleware::jabatan('kasubag_tu') && !$row->alasan1){
                                                            echo '<br/>Validasi Kasubag TU : <u><a href="'.URLROOT.'/pengadaan/validasi2/'.$row->serial_number.'">Validasi</a></u>';
                                                        }else{
                                                            echo '<br/>Validasi Kasubag TU : <span class="text-warning">Menunggu validasi</span>';
                                                        }
                                                    }
                                                }
                                        //
                                                if(!$row->waktu_validasi2){
                                                    echo '<br/>Validasi Kepala Balai : <span class="text-warning">Menunggu validasi</span>';
                                                }else{
                                                    if($row->waktu_validasi3){
                                                        if(!$row->alasan3){
                                                            echo '<br/>Validasi Kepala Balai : <span class="text-success">Diterima</span>';
                                                        }else{
                                                            echo '<br/>Validasi Kepala Balai : <span class="text-danger">Ditolak</span> karena '.$row->alasan3.' <span style="color:#2980b9;">'.$row->waktu_validasi3.'</span>';
                                                        }
                                                    }else{
                                                        if(Middleware::jabatan('kepala_balai') && !$row->alasan2){
                                                            echo '<br/>Validasi Kepala Balai : <u><a href="'.URLROOT.'/pengadaan/validasi3/'.$row->serial_number.'">Validasi</a></u>';
                                                        }else{
                                                            echo '<br/>Validasi Kepala Balai : <span class="text-warning">Menunggu validasi</span>';
                                                        }
                                                    }
                                                }
                                    //
                                                if(!$row->waktu_validasi3){
                                                    echo '<br/>Validasi PPK : <span class="text-warning">Menunggu validasi</span>';
                                                }else{
                                                    if($row->alasan_dispo){
                                                        echo '<br/>Validasi PPK : <span class="text-danger">Ditolak</span> karena '.$row->alasan_dispo.' <span style="color:#2980b9;">'.$row->waktu_disposisi.'</span>';
                                                    }elseif($row->disposisi){
                                                        echo '<br/>Validasi PPK : <span class="text-success">Diterima</span>';
                                                    }else{
                                                        if(Middleware::jabatan('ppk') && !$row->alasan3){
                                                            echo '<br/>Disposisi PPK : <u><a href="'.URLROOT.'/pengadaan/validasippk/'.$row->serial_number.'">Disposisikan</a></u>';
                                                        }else{
                                                            echo '<br/>Validasi PPK : <span class="text-warning">Menunggu validasi</span>';
                                                        }
                                                    }
                                                }
                                // 
                                                if($row->disposisi){
                                                    if(!$row->penugasan){
                                                        if($_SESSION['nip'] == $row->nip_penanggung){
                                                         echo '<br/>Penugasan : <u><a href="'.URLROOT.'/pengadaan/penugasan/'.$row->serial_number.'">Pilih Petugas</a></u>';
                                                        }
                                                    }else{

                                                    }
                                                }else{
                                                    
                                                }
                                //
                                                if($row->penugasan){
                                                    if(!$row->hasil){
                                                        $petugas = explode(',',$row->nip_petugas_pengadaan);
                                                        if(in_array($_SESSION['nip'] , $petugas)){
                                                                echo '<br/>Penugasan : <u><a href="'.URLROOT.'/pengadaan/konfirmasiPenugasan/'.$row->serial_number.'">Konfirmasi penugasan</a></u>';
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
                                                    echo '<br/>Validasi hasil diterima : <u><a href="'.URLROOT.'/pengadaan/hasil/'.$row->serial_number.'">Validasi</a></u>';
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
                                        <a href="<?= URLROOT; ?>/pengadaan/informasi/<?= $row->serial_number ?>"class="btn btn-primary"><i class="fa fa-eye"></i></a>
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