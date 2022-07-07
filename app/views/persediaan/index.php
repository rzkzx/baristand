<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?= URLROOT; ?>/css/tombol.css">
<link rel="stylesheet" href="<?= URLROOT; ?>/css/popupimg.css">

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
    <?php foreach ($data['persediaan'] as $row) { 
        ?>
        <div class="card mr-2" style="width: 15rem;">
            <img class="card-img-top" id="<?= $row->id ?>" src="<?= URLROOT; ?>/img/persediaan/<?php echo $row->gambar; ?>" style="height: 165px; max-width: 200px; margin: auto;  margin-top: 18px" alt="<?= $row->namabarang ?>">
            <div class="card-body">
                <?php
                    echo '<h5 class="card-title" style="text-align: center;">'.$row->namabarang.'</h5>';
                    echo '<p class="card-harga" style="text-align: center;">'.$row->keterangan.'</p>';
                    echo '<p class="card-stock" style="margin-left: 3px;">'.$row->stock.' '.$row->satuan.'</p>';
                    echo '<a href="#" class="btn btn-primary" style="width: 100%;">+ Keranjang</a>';
                ?>
            </div>
            <!-- The Modal -->
            <div id="myModal" class="modal">

                <!-- The Close Button -->
                <span class="close">&times;</span>

                <!-- Modal Content (The Image) -->
                <img class="modal-content" id="img01">

                <!-- Modal Caption (Image Text) -->
                <div id="caption"></div>
            </div>
        </div>
            <script>
                // Get the modal
                var modal = document.getElementById("myModal");

                // Get the image and insert it inside the modal - use its "alt" text as a caption
                var img = document.getElementById("<?= $row->id ?>");
                var modalImg = document.getElementById("img01");
                var captionText = document.getElementById("caption");
                img.onclick = function(){
                    modal.style.display = "block";
                    modalImg.src = this.src;
                    captionText.innerHTML = this.alt;
                }

                // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("close")[0];

                // When the user clicks on <span> (x), close the modal
                span.onclick = function() { 
                    modal.style.display = "none";
                }
            </script>
        <?php } ?>
    </div>
</section>
<?php require APPROOT . '/views/inc/footer.php'; ?>