<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-lg-12">
            <!-- Main content -->
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                            <form class="form-inline" method="POST" action="<?= URLROOT; ?>/surattugas/rekap">
                                <label class="mr-2">Filter Tanggal:</label>
                                <input type="date" class="form-control mr-2" placeholder="Start"  name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : '' ?>" />
                                <label class="mr-2">To</label>
                                <input type="date" class="form-control mr-2" placeholder="End"  name="date2" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : '' ?>"/>
                                <button class="btn btn-primary mr-2" name="search"><span class="fa fa-search"></span></button> 
                                <a href="<?= URLROOT; ?>/surattugas/rekap" type="button" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>
                            </form>
                        </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <?php flash(); ?>
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                <thead class="thead-light">
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal Permohonan, Pemohon </th>
                                            <th>Detail Surat Tugas </th>
                                            <th>Action</th>
                                        </tr>
                                </thead>
                                <tbody>
                                <?php 
                    $no = 1;
                    foreach ($data['surattugas'] as $row) {
                        {
                            ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= "<span class='text-primary'>". $row->tanggal_permohonan ."</span></br>".$row->nama?></td> 
                                            <td>
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
                                                class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                            <?php if($row->pemohon == $_SESSION['nip']){ ?>
                                                <?php if(!$row->nomor_surat && !$row->disahkan){ ?>
                                                    <a href="<?= URLROOT; ?>/surattugas/delete/<?= $row->id ?>"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Hapus Laporan?');">Delete</a>
                                                    </td>
                                            <?php 
                                                }
                                            }
                                            ?>
                                        <?php 
                                    $no++;
                                    }
                                }
                                    ?>                                              
                                    </tbody>
                                </table>
                            </div>
                        </div>
        </div>
    </div>                       
<?php require APPROOT . '/views/inc/footer.php'; ?>