<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="row">
        <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <a href="<?= URLROOT; ?>/surattugas/add" class="btn float-right btn-xs btn btn-primary">Input Pengajuan Surat Tugas</a>
                            </div>
                            <div class="table-responsive p-3">
                                <?php flash(); ?>
                                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal Permohonan / Pemohon, Detail</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    <?php 
                                    $no = 1;
                                    foreach ($data['laporan'] as $row) 
                                    {
                                    ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= "<span class='text-primary'>". $row->tanggal_permohonan ."</span> / ".$row->nama?> 
                                        <br>
                                        <br/>
                                        <b> Detail : </b>
                                        <br/>
                                                <?php
                                                if($row->nomor_surat && $row->disahkan){
                                                    echo '<span>Surat Tugas telah disahkan dengan nomor :</span>';
                                                    echo '<br/><b>'.$row->nomor_surat.'</b>';                                               
                                                }else{
                                                ?>
                                                Atasan Langsung :
                                                <?php 
                                                    if(!$row->validasi_atasan_langsung){
                                                        if($row->pengusul == $_SESSION['nip']){
                                                            echo '<a href="'.URLROOT.'/surattugas/validasial/'.$row->id.'" class="btn btn-primary btn-sm">Validasi</a>';
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
                                                Pejabat Pembuat Komitmen : 
                                                <?php 
                                                    if(!$row->validasi_atasan_langsung){
                                                        echo '<span style="color:#e67e22;">Belum divalidasi</span>'; 
                                                    }else{
                                                        if($row->validasi_ppk){
                                                            if($row->validasi_ppk == 'Ditolak'){
                                                                echo '<span class="text-danger">'.$row->validasi_ppk.'</span>, '.$row->waktu_validasi_ppk;
                                                                echo '</br>Alasan : '.$row->alasan_ditolak;
                                                            }else{
                                                                echo '<span class="text-success">'.$row->validasi_ppk.'</span>, '.$row->waktu_validasi_ppk;
                                                            }
                                                        }else{
                                                            if($row->nip_ppk == $_SESSION['nip']){
                                                                echo '<a href="'.URLROOT.'/surattugas/validasippk/'.$row->id.'" class="btn btn-primary btn-sm">Validasi</a>';
                                                            }else{
                                                                echo '<span style="color:#e67e22;">Menunggu divalidasi</span>';
                                                            }
                                                        }
                                                    }
                                                ?>
                                                
                                                <br/>
                                                Kepala Balai : 
                                                <?php 
                                                    if(!$row->validasi_ppk){
                                                        echo '<span style="color:#e67e22;">Belum divalidasi</span>'; 
                                                    }else{
                                                        if($row->validasi_kepala_balai){
                                                            if($row->validasi_kepala_balai == 'Ditolak'){
                                                                echo '<span class="text-danger">'.$row->validasi_kepala_balai.'</span>, '.$row->waktu_validasi_kepala_balai;
                                                                echo '</br>Alasan : '.$row->alasan_ditolak;
                                                            }else{
                                                                echo '<span class="text-success">'.$row->validasi_kepala_balai.'</span>, '.$row->waktu_validasi_kepala_balai;
                                                            }
                                                        }else{
                                                            if(Middleware::jabatan('kepala_balai')){
                                                                echo '<a href="'.URLROOT.'/surattugas/validasikb/'.$row->id.'" class="btn btn-primary btn-sm">Validasi</a>';
                                                            }else{
                                                                echo '<span style="color:#e67e22;">Menunggu divalidasi</span>';
                                                            }
                                                        }
                                                    }
                                                ?>
                                                <?php 
                                                    if($row->validasi_kepala_balai == 'Disetujui'){
                                                            if(Middleware::admin('surat_tugas')){
                                                                echo '<br/><a href="'.URLROOT.'/surattugas/nomorsurat/'.$row->id.'" class="btn btn-primary btn-sm">Input Nomor Surat Tugas</a>';
                                                            }else{
                                                                echo '<br/><span style="color:#e67e22;">Menunggu nomor surat tugas...</span>';
                                                            }
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td>
                                            <a href="<?= URLROOT; ?>/surattugas/detail/<?= $row->id ?>"
                                                class="btn btn-primary btn-md"><i class="fa fa-eye"></i></a>
                                            <?php if($row->pemohon == $_SESSION['nip']){ ?>
                                                <?php if(!$row->nomor_surat && !$row->disahkan){ ?>
                                                    <a href="<?= URLROOT; ?>/surattugas/delete/<?= $row->id ?>"
                                                        class="btn btn-danger btn-md"
                                                        onclick="return confirm('Hapus Laporan?');"><i class="fa fa-trash"></i></a>
                                                    </td>
                                            <?php 
                                                }
                                            }
                                            ?>
                                        </tr>
                                    <?php 
                                    $no++;
                                    }
                                    ?>                                              
                                    </tbody>
                                </table>
                            </div>
                        </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>