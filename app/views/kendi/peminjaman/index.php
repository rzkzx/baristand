<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <a href="<?= URLROOT;?>/kendi/addpeminjaman" class="btn float-right btn-xs btn btn-primary"><i class="fa fa-plus-square"></i> Tambah Kendaraan</a>
        </div>
        <div class="table-responsive p-3">
            <?php flash(); ?>
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
            <thead class="thead-light">
                <tr>
                <th>No.</th>
                <th>Detail Peminjaman</th>
                <th>Kendaraan</th>
                <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                foreach ($data['kendi'] as $row) :
                ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $row->tipe ?></td>
                        <td><?= $row->nopol ?></td>
                        <td><?= $row->tgl_pajak ?></td>
                        <td>
                            <?php if($row->dipinjam){
                                echo '<span class="badge badge-danger">Kendaraan sedang digunakan</span>';
                            }else{ ?>
                                <a href="<?= URLROOT; ?>/kendi/pemeriksaan/<?= $row->id ?>"
                                class="btn btn-primary btn-sm"><i class="fa fa-check-square"></i> Check Kondisi</a>
                            <?php }?>
                        </td>
                    </tr>
                    <?php 
                    $no++;
                endforeach;
                ?>
            </tbody>
            </table>
        </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>