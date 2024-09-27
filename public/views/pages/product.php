<style>
    .related-products :is(#product2,.btn2-container){
        margin-bottom: unset;
    }
    .product-body {
        padding-top: 10vh
    }

    /* Product Details */
    .product-header {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        align-items: center;
    }

    .product__thumbnail {
        border-right: 1px solid #ddd
    }

    .item {
        width: 100%;
    }

    .item img {
        padding: 10px
    }

    .product__infor {
        padding: 20px;
    }


    .product-details {
        padding-right: 20px;
    }

    .product-content {
        margin-top: clamp(0px, 2vw, 20px);
        padding: 10px;
    }

    .product-email,
    .product-content>h4 {
        border-bottom: 1px solid #ddd;
    }

    .product-title,
    .product-email>strong>a,
    .product-content>h4 {
        color: #b4171b;
    }

    .product-content>h4 {
        position: relative;
        font-weight: 700;
    }

    .product-content>h4::after {
        content: "";
        position: absolute;
        left: 0%;
        bottom: -.25%;
        width: 4rem;
        height: 1px;
        background-color: #b4171b;
    }

    .product-email>strong>a {
        text-decoration: none;
        font-weight: 700;
    }

    .product-email {
        padding-bottom: 10px;
    }

    .product-desc {
        margin-top: 10px;
    }

    /* Sidebar */
    .sidebar {
        padding-left: 20px;
    }



    /* Responsive Design */
    @media (max-width: 768px) {

        .product-details,
        .sidebar {
            padding: 0;
        }

        .row {
            flex-direction: column;
        }

        .related-products .related-item {
            flex: 1 1 calc(50% - 10px);
        }
    }

    @media (max-width: 576px) {
        .related-products .related-item {
            flex: 1 1 100%;
        }
    }
</style>
<main>
    <div class="container">
        <div class="product-body row">
            <?php foreach ($data["product_data"] as $product): ?>
                <!-- Left Section: Product Details -->
                <div class="col-lg-9 col-12 product-detailss">
                    <!-- Image and product info -->
                    <div class="product-header">
                        <div class="image product__thumbnail">
                            <div class="item">
                                <img src="<?= $_ENV["PICTURE_URL"] . '/' . $product['image'] ?>" alt="Product Image"
                                    class="product-image">
                            </div>
                        </div>
                        <div class="product__infor">
                            <div class="product__info-header">
                                <h1 class="product-title"><?= $product['title'] ?></h1>
                            </div>
                            <div class="product-email">
                                <strong>Contact: <a
                                        href="mailto:roberttaylor@dmcglobal.sg">roberttaylor@dmcglobal.sg</a></strong>
                            </div>
                            <div class="product-desc">
                                <p><?= $product['description'] ?></p>
                            </div>
                        </div>

                    </div>

                    <!-- Product Detail Section -->
                    <section class="product-content">

                        <h4>Detail</h4>
                        <p><?= $product['long_description'] ?></p>
                    </section>
                <?php endforeach; ?>
            </div>

            <?php include('partials/sideBar.php') ?>

        </div>
    </div>
    <!-- Related Products Section -->
    <section class="related-products">
        <h1 class="title  wow slideInLeft"> related products
            <p class="pseudo"></p>
        </h1>
        <?php include('partials/product_items.php') ?>
    </section>
</main>