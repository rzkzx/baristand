<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?= URLROOT; ?>/css/tombol.css">
<div class="row">
    <div class="col-lg-12">
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <a href="<?= URLROOT; ?>/persediaan/tambahbarang" class="btn float-right btn-xs btn btn-primary"><i class="fa fa-plus-square"></i> Tambah Barang</a>
                    <a href="<?= URLROOT; ?>/persediaan/tambahbarang" class="btn float-left btn-xs btn btn-primary"><i class="fa fa-table"></i> Riwayat Tambah Stock</a>
                </div>
                <div class="card-body">
                    <?php flash(); ?>
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Detail Barang</th>
                                <th>Keterangan</th>
                                <th>Stock</th>
                                <th>Edit Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['persediaan'] as $row) { ?>
                                <tr>
                                    <td>
                                        <?= $row->id ?>
                                    </td>
                                    <td>
                                        <span style="color:#2980b9;"> <?= timeFilter($row->jam), " - ", dateID($row->tanggal) ?> </span>
                                        <?=
                                        "<br/>", $row->nama," (",$row->nip_pegawai,")",
                                        "<br/>",
                                        "<br/>", "<b>" . $row->namabarang . "</b>",
                                        "<br/>", "Rp. " . $row->harga . " / " . $row->satuan,
                                        "<br/>", "Gudang : " . $row->gudang
                                        ?>
                                    </td>
                                    <td>
                                        <?= $row->keterangan ?>
                                    </td>
                                    <td>
                                        <?= $row->stock ?>
                                    </td>
                                    <td>
                                        <a href="<?= URLROOT; ?>/persediaan/barang" class="btn btn-success"><i class="fa fa-table"></i> Edit Stock</a>
                                    </td>
                                </tr>
                            <?php } ?>
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