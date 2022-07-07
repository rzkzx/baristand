<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <a href="<?= URLROOT;?>/kendi/addpeminjaman" class="btn float-right btn-xs btn btn-primary"><i class="fa fa-plus-square"></i> Buat Permohonan Peminjaman Kendaraan</a>
        </div>
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
                    <tr>
                        <td width="25"><?= $index ?></td>
                        <td>
                            <span style="color:#2980b9;"><?= $row->waktu ?></span>
                            <br>
                            <?= $row->nama ?> (<?= $row->pemohon ?>)
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
                            }
                            ?>
                            <br><br>
                            Validasi AL :
                            <?php
                            if(!$row->validasi_atasan){
                                if($row->atasan == $_SESSION['nip']){
                                    echo '<a href="'.URLROOT.'/kendi/validasial/'.$row->id.'" class="btn btn-primary btn-sm">Validasi</a>';
                                }else{
                                    echo '<span style="color:#e67e22;">Menunggu divalidasi</span>';
                                }
                            }else{
                                if($row->validasi_atasan == 'Ditolak'){
                                    echo '<span class="text-danger">'.$row->validasi_atasan.'</span>, '.$row->waktu_validasi_atasan;
                                }else{
                                    echo '<span class="text-success">'.$row->validasi_atasan.'</span>, '.$row->waktu_validasi_atasan;
                                }
                            }
                            ?>
                            <br>
                            Validasi Kasubag TU :
                            <?php
                            if(!$row->validasi_atasan){
                                echo '<span style="color:#e67e22;">Belum divalidasi</span>';
                            }else if($row->validasi_atasan == 'Diterima'){
                                if($row->validasi_kasubagtu){
                                    if($row->validasi_kasubagtu == 'Diterima'){
                                        echo '<span class="text-success">'.$row->validasi_kasubagtu.'</span>, '.$row->waktu_validasi_kasubagtu;
                                    }else{
                                        echo '<span class="text-danger">'.$row->validasi_kasubagtu.'</span>, '.$row->waktu_validasi_kasubagtu;
                                    }
                                }else{
                                    if(Middleware::jabatan('kasubag_tu')){
                                        echo '<a href="'.URLROOT.'/kendi/validasitu/'.$row->id.'" class="btn btn-primary btn-sm">Validasi</a>';
                                    }else{
                                        echo '<span style="color:#e67e22;">Menunggu divalidasi</span>';
                                    }
                                }
                            }else{
                                echo '<span style="color:#e67e22;">Gagal Validasi</span>';
                            }
                            ?>
                            <?php 
                            if($row->validasi_atasan && $row->validasi_kasubagtu == 'Diterima' && !$row->diserahkan){
                                if(Middleware::admin('kendi')){
                                    echo '<br><button class="btn btn-sm btn-primary btn-serah" data-id="'.$row->id.'" typle="button"><i class="fa fa-motorcycle"></i> Serahkan Kendaraan</button>';
                                }
                            }
                            ?>
                            <?php 
                            if($row->validasi_atasan && $row->validasi_kasubagtu == 'Diterima' && $row->diserahkan && $_SESSION['nip'] == $row->pemohon){
                                if(!$row->selesai){
                                    echo '<br><button class="btn btn-sm btn-success btn-serah" data-id="'.$row->id.'" typle="button"><i class="fa fa-motorcycle"></i> Kendaraan Kembali</button>';
                                }
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
                                Jam Mulai : <b><?= timeID($row->jam_mulai) ?></b><br>
                                Jam Selesai : <b><?= timeID($row->jam_selesai) ?></b><br>
                            <?php }else{ ?>
                                Tanggal Mulai : <b><?= dateID($row->tgl_mulai) ?></b><br>
                                Tanggal Selesai : <b><?= dateID($row->tgl_selesai) ?></b><br>
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
<script>
function del() 
{
	$(document).delegate(".btn-serah", "click", function() {
		Swal.fire({
			icon: 'warning',
		  	title: 'Kendaraan akan diserahkan?',
		  	showDenyButton: false,
		  	showCancelButton: true,
		  	confirmButtonText: 'Serahkan',
            cancelButtonText: 'Batal'
		}).then((result) => {
		  /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {

                var id = $(this).attr('data-id');

		  	// Ajax config
			$.ajax({
		        type: "POST", //we are using GET method to get data from server side
		        url: '<?= URLROOT; ?>/kendi/serahkankendaraan/'+id, // get the route value
		        beforeSend: function () {//We add this before send to disable the button once we submit it so that we prevent the multiple click
		            
		        },
		        success: function (response) {//once the request successfully process to the server side it will return result here
		            // Reload lists of employees
                    Swal.fire('Kendaan telah diserahkan.', response, 'success').then((result)=>{
                        if(result.isConfirmed){
                            location.reload();
                        }
                    });
		        }
		    });
		    
		  } else if (result.isDenied) {
		    Swal.fire('Perubahan tidak disimpan', '', 'info')
		  }
		});

		
	});
}
</script>