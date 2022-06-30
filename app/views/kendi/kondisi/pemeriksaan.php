<?php require APPROOT . '/views/inc/header.php'; ?>
<style>
    input[type='checkbox']{
        width: 20px;
        height: 20px;
    }
</style>

<div class="row">
    <div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-body">
            <div class="col-md-12">
                <?php flash(); ?>
            </div>
            <form action="<?= URLROOT; ?>/kendi/pemeriksaan" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $data['id']; ?>">
            <div class="form-group row">
                <label for="merk" class="col-sm-2 col-form-label"><b>Tanggal :</b></label>
                <div class="col-sm-6">
                <label for="merk" class="col col-form-label"><?php echo dateID(date('Y-m-d')) ?></label>
                </div>
            </div>
            <div class="form-group row">
                <label for="tipe" class="col-sm-2 col-form-label"><b>Tipe, Nopol :</b></label>
                <div class="col-sm-6">
                <label for="merk" class="col col-form-label"><?= $data['kend']->tipe ?>, <?= $data['kend']->nopol ?></label>
                </div>
            </div>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                    <th scope="col" width="20">No</th>
                    <th scope="col">Item</th>
                    <th scope="col" width="20">Kondisi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mesin</td>
                        <td>
                            <input type="checkbox" name="kondisi[]" value="1"/>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>BBM lebih dari setengah</td>
                        <td>
                            <input type="checkbox" name="kondisi[]" value="1"/>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Tekanan ban depan kanan</td>
                        <td>
                            <input type="checkbox" name="kondisi[]" value="1"/>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>Tekanan ban depan kiri</td>
                        <td>
                            <input type="checkbox" name="kondisi[]" value="1"/>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td>Tekanan ban belakang kanan</td>
                        <td>
                            <input type="checkbox" name="kondisi[]" value="1"/>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">6</th>
                        <td>Tekanan ban belakang kiri</td>
                        <td>
                            <input type="checkbox" name="kondisi[]" value="1"/>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">7</th>
                        <td>Wiper</td>
                        <td>
                            <input type="checkbox" name="kondisi[]" value="1"/>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">8</th>
                        <td>Rem Tangan</td>
                        <td>
                            <input type="checkbox" name="kondisi[]" value="1"/>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">9</th>
                        <td>Rem Belakang</td>
                        <td>
                            <input type="checkbox" name="kondisi[]" value="1"/>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">10</th>
                        <td>Lampu depan (utama) kanan</td>
                        <td>
                            <input type="checkbox" name="kondisi[]" value="1"/>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">11</th>
                        <td>Lampu depan (utama) kiri</td>
                        <td>
                            <input type="checkbox" name="kondisi[]" value="1"/>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">12</th>
                        <td>Lampu depan (utama-jauh) kanan</td>
                        <td>
                            <input type="checkbox" name="kondisi[]" value="1"/>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">13</th>
                        <td>Lampu depan (utama-jauh) kiri</td>
                        <td>
                            <input type="checkbox" name="kondisi[]" value="1"/>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">14</th>
                        <td>Lampu depan (senja) kanan</td>
                        <td>
                            <input type="checkbox" name="kondisi[]" value="1"/>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">15</th>
                        <td>Lampu depan (senja) kiri</td>
                        <td>
                            <input type="checkbox" name="kondisi[]" value="1"/>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">16</th>
                        <td>Lampu depan (sein) kanan</td>
                        <td>
                            <input type="checkbox" name="kondisi[]" value="1"/>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">17</th>
                        <td>Lampu depan (sein) kiri</td>
                        <td>
                            <input type="checkbox" name="kondisi[]" value="1"/>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">18</th>
                        <td>Lampu belakang (utama) kanan</td>
                        <td>
                            <input type="checkbox" name="kondisi[]" value="1"/>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">19</th>
                        <td>Lampu belakang (utama) kiri</td>
                        <td>
                            <input type="checkbox" name="kondisi[]" value="1"/>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">20</th>
                        <td>Lampu belakang (rem) kanan</td>
                        <td>
                            <input type="checkbox" name="kondisi[]" value="1"/>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">21</th>
                        <td>Lampu belakang (rem) kiri</td>
                        <td>
                            <input type="checkbox" name="kondisi[]" value="1"/>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">22</th>
                        <td>Lampu belakang (sein) kanan</td>
                        <td>
                            <input type="checkbox" name="kondisi[]" value="1"/>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">23</th>
                        <td>Lampu belakang (sein) kiri</td>
                        <td>
                            <input type="checkbox" name="kondisi[]" value="1"/>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">24</th>
                        <td>AC</td>
                        <td>
                            <input type="checkbox" name="kondisi[]" value="1"/>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">25</th>
                        <td>Jendela (depan) kanan</td>
                        <td>
                            <input type="checkbox" name="kondisi[]" value="1"/>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">26</th>
                        <td>Jendela (depan) kiri</td>
                        <td>
                            <input type="checkbox" name="kondisi[]" value="1"/>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">27</th>
                        <td>Jendela (belakang) kanan</td>
                        <td>
                            <input type="checkbox" name="kondisi[]" value="1"/>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">28</th>
                        <td>Jendela (belakang) kiri</td>
                        <td>
                            <input type="checkbox" name="kondisi[]" value="1"/>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="pb-4"></div>
            <div class="form-group row">
                <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= URLROOT; ?>/kendi/kondisi" class="btn btn-danger">Batal</a>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>