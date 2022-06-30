<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
        <div class="table-responsive p-3">
            <?php flash(); ?>
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
            <thead class="thead-light">
                <tr>
                <th>No.</th>
                <th>Merk</th>
                <th>Tipe</th>
                <th>Nomor Polisi</th>
                <th>Tgl. Bayar Pajak</th>
                <th>Status</th>
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
                        <td><?= $row->merk ?></td>
                        <td><?= $row->tipe ?></td>
                        <td><?= $row->nopol ?></td>
                        <td><?= $row->tgl_pajak ?></td>
                        <td><?php echo ($row->layak) ? '<span class="badge badge-success">Layak pakai</span>' : '<span class="badge badge-danger">Tidak Layak Pakai</span>'; ?></td>
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