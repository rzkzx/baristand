<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-lg-12">
            <!-- Main content -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <?php flash(); ?>
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Tanggal / Pelapor</th>
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
                                    <tr>
                                        <td><span style="color:#2980b9;"><?= $row->tanggal ?></span> <br/> <?= $row->nama ?></td>
                                        <td><?= $row->pemberi ?></td>
                                        <td><?= $row->penerima ?></td>
                                        <td><?= $row->jenis_penerimaan ?></td>
                                        <td><?= rupiah($row->taksiran) ?></td>
                                        <td>
                                        <a href="<?= URLROOT; ?>/gratifikasi/tindakan/<?= $row->id ?>"
                                            class="btn btn-warning btn-sm"><i class="fa fa-exclamation-triangle"></i></a>
                                        </td>
                                        
                                    </tr>
                                    <?php 
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