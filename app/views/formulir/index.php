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
                <th>Nama Formulir</th>
                <th>Kode Formulir</th>
                <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                foreach ($data['formulir'] as $row) {
                ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $row->nama ?></td>
                        <td><?= $row->kode ?></td>
                        <td>
                        <a href="<?= URLROOT; ?>/formulir/edit/<?= $row->id?>"
                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
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
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>