<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?= URLROOT; ?>/css/tombol.css">

<div class="tombol">
    <a href="#">
        <button class="btn-floating">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            <span>Keranjang</span>
        </button>
    </a>
    <a href="#">
        <button class="btn-floating riwayat">
            <i class="fa fa-history" aria-hidden="true"></i>
            <span>Riwayat</span>
        </button>
    </a>
</div>

<section class="products" id="products">
    <div class="row">
    <?php foreach ($data['persediaan'] as $row) { ?>
        <div class="card mr-2" style="width: 18rem;">
            <img class="card-img-top" src="<?= URLROOT; ?>/img/persediaan/<?php echo $row->gambar; ?>" style="height: 200px; max-width: 240px; margin: auto;  margin-top: 18px" alt="Card image cap">
            <div class="card-body">
                <?php
                    echo '<h5 class="card-title" style="text-align: center;">'.$row->namabarang.'</h5>';
                    echo '<p class="card-harga" style="text-align: center;">'.$row->keterangan.'</p>';
                    echo '<p class="card-stock" style="margin-left: 3px;">'.$row->stock.' '.$row->satuan.'</p>';
                    echo '<a href="#" class="btn btn-primary" style="width: 100%;">+ Keranjang</a>';
                ?>
            </div>
        </div>
        <?php } ?>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>