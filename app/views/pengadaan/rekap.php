<?php require APPROOT . '/views/inc/header.php'; ?>
<section class="section">
    <div class="row">
        <div class="col-12">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <form class="form-inline" method="POST" action="<?= URLROOT; ?>/pengadaan/rekap">
                    <label class="mr-2">Filter Tanggal:</label>
                    <input type="date" class="form-control mr-2" placeholder="Start"  name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : '' ?>" />
                    <label class="mr-2">To</label>
                    <input type="date" class="form-control mr-2" placeholder="End"  name="date2" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : '' ?>"/>
                    <button class="btn btn-primary mr-2" name="search"><span class="fa fa-search"></span></button> 
                    <a href="<?= URLROOT; ?>/pengadaan/rekap" type="button" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>
                </form>
            </div>
            <div class="content-wrapper">
                <!-- Main content -->
                <section class="content">
                    <section class="section">
                        <div class="card">
                            <div class="card-body">
                                <?php flash(); ?>
                                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Keterangan Permohonan</th>
                                            <th>Detail Permohonana</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php 
                                        $no = 1;
                                        foreach ($data['pengadaan'] as $row) {
                                        ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td>
                                            <span style="color:#2980b9;"> <?= timeFilter($row->jam) , " - ", dateID($row->tanggal)?> </span> <?=
                                            "<br/>", $row->nama," / ",$row->nip_pemohon;
                                            ?></td>
                                            <td>
                                            <?php 
                                            $data = explode('.',$row->keterangan);
                                            foreach($data as $k){
                                                
                                                if($k){
                                                    $v = explode(',',$k);
                                                    echo $v[0].'. '.$v[1].' ['.$v[2].'] '.$v[3];
                                                    echo '<br/>';
                                                }
                                            }
                                            ?>
                                            </td>
                                            <td>
                                            <a href="<?= URLROOT; ?>/pengadaan/detail_rekap/<?= $row->serial_number ?>"
                                                class="btn btn-primary"><i class="fa fa-eye"></i></a>
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

                    </section>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
        </div>
    </div>
</section>
<?php require APPROOT . '/views/inc/footer.php'; ?>