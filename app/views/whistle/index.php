<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-lg-12">
            <!-- Main content -->
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <a href="<?= URLROOT;?>/whistle/add" class="btn float-right btn-xs btn btn-primary"><i class="fa fa-plus-square"></i> Buat Laporan</a>
                        </div>
                            <?php flash(); ?>
                            <div class="card-body">
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Nama</th>
                                        <th>Instansi</th>
                                        <th>Judul Laporan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php 
                                    $no = 1;
                                    foreach ($data['whistle'] as $row) {
                                    ?>
                                    <tr>
                                        <td><span style="color:#2980b9;"><?= $row->tanggal ?></span></td>
                                        <td><?= $row->nama_pelaporan ?></td>
                                        <td><?= $row->instansi ?></td>
                                        <td><?= $row->judul_laporan ?></td>
                                        <td>
                                        <a href="<?= URLROOT; ?>/whistle/detail/<?= $row->id ?>"
                                            class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                        <button class='btn btn-sm btn-danger btn-delete' data-id='<?= $row->id ?>' typle='button'><i class="fa fa-trash"></i></button>
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
		        url: '<?= URLROOT; ?>/whistle/delete/'+id, // get the route value
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