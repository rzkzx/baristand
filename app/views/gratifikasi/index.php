<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <!-- Main content -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <a href="<?= URLROOT;?>/gratifikasi/add" class="btn float-right btn-xs btn btn-primary"><i class="fa fa-plus-square"></i> Buat Laporan</a>
                        </div>
                        <div class="card-body">
                            <?php flash(); ?>
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Pemberi</th>
                                        <th>Penerima</th>
                                        <th>Jenis Penerimaan</th>
                                        <th>Taksiran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php 
                                    foreach ($data['gratifikasi'] as $row) {
                                    ?>
                                    <tr <?php if($row->is_tindak) echo 'style="background-color:#f5f7ff;"'; ?>>
                                        <td><span style="color:#2980b9;"><?= $row->tanggal ?></span></td>
                                        <td><?= $row->pemberi ?></td>
                                        <td><?= $row->penerima ?></td>
                                        <td><?= $row->jenis_penerimaan ?></td>
                                        <td><?= rupiah($row->taksiran) ?></td>
                                        <td>
                                        <a href="<?= URLROOT; ?>/gratifikasi/detail/<?= $row->id ?>"
                                            class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                        <?php if(!$row->is_tindak && $row->pelapor == $_SESSION['nip']){ ?>
                                            <button class='btn btn-sm btn-danger btn-delete' data-id='<?= $row->id ?>' typle='button'><i class="fa fa-trash"></i></button>
                                        <?php } ?>
                                        </td>
                                        
                                    </tr>
                                    <?php 
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

        <!-- /.content-wrapper -->
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
<script>
function del() 
{
	$(document).delegate(".btn-delete", "click", function() {
		Swal.fire({
			icon: 'warning',
		  	title: 'Anda yakin menghapus data ini?',
		  	showDenyButton: false,
		  	showCancelButton: true,
		  	confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
		}).then((result) => {
		  /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {

                var id = $(this).attr('data-id');

		  	// Ajax config
			$.ajax({
		        type: "POST", //we are using GET method to get data from server side
		        url: '<?= URLROOT; ?>/gratifikasi/delete/'+id, // get the route value
		        beforeSend: function () {//We add this before send to disable the button once we submit it so that we prevent the multiple click
		            
		        },
		        success: function (response) {//once the request successfully process to the server side it will return result here
		            // Reload lists of employees
                    Swal.fire('Berhasil Hapus Data.', response, 'success').then((result)=>{
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