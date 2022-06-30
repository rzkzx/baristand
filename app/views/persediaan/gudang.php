<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="content-wrapper">
            <!-- Main content -->
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <a href="<?= URLROOT;?>/persediaan/tambahgudang" class="btn float-right btn-xs btn btn-primary"><i class="fa fa-plus-square"></i> Tambah Gudang</a>
                        </div>
                        <div class="card-body">
                            <?php flash(); ?>
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Gudang</th>
                                        <th>Petugas Gudang</th>
                                        <th>Tanggal Input</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $no = 1; foreach ($data['gudang'] as $row) { ?>
                                    <tr>
                                        <td>
                                            <?= $no ?>
                                        </td>
                                        <td>
                                            <?= $row->namagudang ?>
                                        </td>
                                        <td>
                                            <ul>
                                                <?php
                                                    foreach ($data['petugas'][$no] as $p) {
                                                        echo '<li>'.$p->nama.' ('.$p->nip.')</li>';
                                                    }
                                                ?>
                                                </ul>
                                            </td>
                                        <td>
                                            <?= $row->tanggal ?>
                                        </td>
                                        <td>
                                            <?= $row->keterangan ?>
                                        </td>
                                    </tr>
                                <?php $no++; } ?>
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