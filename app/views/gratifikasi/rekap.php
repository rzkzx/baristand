<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-lg-12">
            <!-- Main content -->
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <form class="form-inline" method="POST" action="<?= URLROOT; ?>/gratifikasi/rekap">
                            <label class="mr-2">Filter Tanggal:</label>
                            <input type="date" class="form-control mr-2" placeholder="Start"  name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : '' ?>" />
                            <label class="mr-2">To</label>
                            <input type="date" class="form-control mr-2" placeholder="End"  name="date2" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : '' ?>"/>
                            <button class="btn btn-primary mr-2" name="search"><span class="fa fa-search"></span></button> 
                            <a href="<?= URLROOT; ?>/gratifikasi/rekap"type="button" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>
                        </form>
                    </div>
                    <div class="card mb-4">
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
                                    <tr>
                                        <td><span style="color:#2980b9;"><?= $row->tanggal ?></span> <br/> <?= $row->nama ?></td>
                                        <td><?= $row->pemberi ?></td>
                                        <td><?= $row->penerima ?></td>
                                        <td><?= $row->jenis_penerimaan ?></td>
                                        <td><?= rupiah($row->taksiran) ?></td>
                                        <td>
                                            <a href="<?= URLROOT; ?>/gratifikasi/detail/<?= $row->id ?>"
                                                class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
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