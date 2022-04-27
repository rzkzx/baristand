<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        </div>
        <div class="table-responsive p-3">
            <?php flash(); ?>
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Admin</th>
                    <th>Pegawai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Admin</th>
                    <th>Pegawai</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
            <tbody>
                <?php 
                $no=0;
                $number=1;
                foreach ($data['admin'] as $row) {
                ?>
                    <tr>
                        <td><?= $number ?></td>
                        <td><?= $row->nama_admin ?></td>
                        <td>
                        <?php
                        if(!$data['pegawai'][$no]){
                            ?>
                            <ul>
                            <li style="list-style-type: none;color:red;">Tidak ada pegawai terdaftar.</li>
                            </ul>
                            <?php
                        }else{
                            foreach($data['pegawai'][$no] as $k){
                                ?>
                                <ul>
                                <li>
                                    <?= $k->nama ?> (<?=$k->nip?>)
                                </li>
                                </ul>
                                <?php
                            }
                        }
                        ?>
                        </td>
                        <td>
                            <a href="<?= URLROOT; ?>/admin/edit/<?= $row->id ?>"
                            class="btn btn-primary"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                    <?php 
                    $no++;
                    $number++;
                }
                ?>
            </tbody>
            </table>
        </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>