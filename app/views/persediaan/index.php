<?php require APPROOT . '/views/inc/header.php'; ?>
<style>
    :root {
        --black: #130f40;
        --light-color: #666;
        --box-shadow: 0 .5rem 1.5rem rgba(0, 0, 0, .1);
        --border: .2rem solid rgba(0, 0, 0, .1);
        --outline: .1rem solid rgba(0, 0, 0, .1);
        --outline-hover: .2rem solid var(--black);
    }

    section {
        padding: 2rem 9%;
    }

    .btnper {
        margin-top: 1rem;
        display: inline-block;
        padding: .8rem 3rem;
        font-size: 1.7rem;
        border-radius: .5rem;
        border: .2rem solid var(--black);
        color: var(--black);
        cursor: pointer;
        background: none;
    }

    .btnper:hover {
        background: var(--blue);
        color: #fff;
    }

    .products .product-slider {
        padding: 1rem;
    }

    .products .product-slider:first-child {
        margin-bottom: 2rem;
    }

    .products .product-slider .box {
        background: #fff;
        border-radius: .5rem;
        text-align: center;
        padding: 3rem 2rem;
        outline-offset: -1rem;
        outline: var(--outline);
        box-shadow: var(--box-shadow);
        transition: .2s linear;
    }

    .products .product-slider .box:hover {
        outline-offset: 0rem;
        outline: var(--outline-hover);
    }

    .products .product-slider .box img {
        height: 20rem;
    }

    .products .product-slider .box h3 {
        font-size: 2.5rem;
        color: var(--black);
    }

    .products .product-slider .box .price {
        font-size: 2rem;
        color: var(--light-color);
        padding: .5rem 0;
    }

</style>
<section class="products" id="products">

    <div class="swiper product-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide box">
                <img src="persediaan/image/product-1.png" alt="">
                <h3>Kertas</h3>
                <div class="harga"> RP. 1.000 </div>
            </div>
            <a href="#" class="btnper">add to cart</a>
        </div>

    </div>

</section>
<script>
    var swiper = new Swiper(".product-slider", {
        loop: true,
        spaceBetween: 20,
        autoplay: {
            delay: 7500,
            disableOnInteraction: false,
        },
        centeredSlides: true,
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            1020: {
                slidesPerView: 3,
            },
        },
    });
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>