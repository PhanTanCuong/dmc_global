<style>
    .img-container img{
        border-radius: 20px;
    }
    .txt-container {
        flex: 0 0 45%;
    }

    .image-container {
        position: relative;
    }

    .item-title {
        position: absolute;
        bottom: 2em;
        left: .5em;
    }

    .item-title a {
        color: #fff !important;

    }

    .item-title a:hover {
        text-decoration: underline !important;
    }

    .section__contact .our-products h2 {
        color: #fff
    }

    .section__contact .our-products p {
        font-size: unset !important;
    }

    .section__contact {
        padding: 0 10vw;
    }

    .section__contact .product1 {
        border-radius: 20px;
    }

    .media__items:first-child{
        grid-row: span 2;
    }
</style>
<main>
    <section class="about1">

        <div class="slideshow-container"> <?php
        if (mysqli_num_rows($data["banner"]) > 0) {
            while ($rows = mysqli_fetch_array($data["banner"])) {

                $banner_pic = $rows['image'];
                $image_path = $_ENV["PICTURE_URL"] . '/' . $banner_pic;
                if (file_exists($_SERVER['DOCUMENT_ROOT'] . $image_path)) {
                    ?>
                        <div class="item" style="position:relative;">
                            <img src="<?= $image_path ?>" class="img-fluid">
                        </div>
                        <?php
                }
            }
        }
        ?>

    </section>
    <section class="about2">
        <div class="container">
            <?php if (mysqli_num_rows($data["about2Infor"]) > 0): ?>
                <?php while ($rows = mysqli_fetch_array($data["about2Infor"])): ?>
                    <div class="grid-container flex-xl-row-reverse flex-column mb-3 wow fadeInRight" data-wow-delay="400ms">
                        <div class="image img-container col-xl-6 col-12">
                            <img src="<?= $imageUrl . '/' . $rows['image'] ?>" alt="image">
                            <div class="chld-img-container">
                                <img src="<?= $imageUrl . '/5-canh.gif' ?>" class="lazy img-fluid" alt="image">
                            </div>
                        </div>
                        <div class="txt-container col-xl-6 col-12 wow pulse" data-wow-delay="400ms">
                            <h2><?= $rows['title'] ?></h2>
                            <p><?= $rows['description'] ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
            <div>
                <div class="section_icon d-flex flex-wrap align-items-center justify-content-around">
                    <div class="icon_items d-grid text-center">
                        <h5>Base Oil</h5>
                        <img src="" alt="icon image">
                    </div>
                    <div class="icon_items d-grid text-center">
                        <h5>Base Oil</h5>
                        <img src="" alt="icon image">
                    </div>
                    <div class="icon_items d-grid text-center">
                        <h5>Base Oil</h5>
                        <img src="" alt="icon image">
                    </div>
                </div>
            </div>
        </div>
        <section class="section__product">
            <h1 class="title  wow slideInLeft">products
                <p class="pseudo"></p>
            </h1>
            <?php $product_url = $_ENV['BASE_URL'] . '/product'; ?>
            <section class='product2' id="product2">
                <div class="container">
                    <div class="grid">
                        <?php if (mysqli_num_rows($data["product"]) > 0): ?>
                            <?php while ($rows = mysqli_fetch_array($data["product"])): ?>
                                <div class="comp wow fadeIn">
                                    <div class="image-container">
                                        <img src=<?= $imageUrl . '/' . $rows['image'] ?> alt="Image">
                                        <div class="item-infor">
                                            <h3 class="item-title">
                                                <a
                                                    href="<?= $_ENV["PRODUCT_URL"] . '/' . $rows['slug'] ?>"><?= $rows['title'] ?></a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                    <div class="btn2-container">
                        <a class="btn2 text-center" href="<?= $product_url ?>"><b>View more</b></a>
                    </div>
                </div>

            </section>
        </section>
    </section>
    <section class="section__media">
        <h1 class="title  wow slideInLeft">media
            <p class="pseudo"></p>
        </h1>
        <?php $product_url = $_ENV['BASE_URL'] . '/product'; ?>
        <section class='product2' id="product2">
            <div class="container">
                <div class="grid">
                    <?php if (mysqli_num_rows($data["media"]) > 0): ?>
                        <?php while ($rows = mysqli_fetch_array($data["media"])): ?>
                            <div class="comp media__items wow fadeIn">
                                <div class="image-container">
                                    <img src=<?= $imageUrl . '/' . $rows['image'] ?> alt="Image">
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>


    </section>
    <section class="section__contact">
        <?php if (mysqli_num_rows($data["contact"]) > 0): ?>
            <?php while ($rows = mysqli_fetch_array($data["contact"])): ?>
                <section class="product1" id="product1"
                    style="background-image:url(/dmc_global/public/images/<?= $rows['image'] ?>)">
                    <div class="our-products wow pulse">
                        <h2><?= $rows['title'] ?></h2>
                        <p><?= $rows['description'] ?></p>
                        <a href="<?= $_ENV["BASE_URL"] . '/contact' ?>" class="btn btn-custom">
                            VIEW MORE
                        </a>
                    </div>
                </section>
            <?php endwhile; ?>
        <?php endif; ?>
        <section class="text__contact">
            <div>
                <h1></h1>
                <p></p>
            </div>
            <div>
                <div class="section_icon d-flex flex-wrap align-items-center justify-content-around">
                    <div class="icon_items d-flex gap-3 text-center">
                        <div class="d-grid">
                            <h2>Base Oil</h2>
                            <p></p>
                            <p></p>
                        </div>
                        <div class="d-grid align-items-center">
                            <img src="" alt="icon image">
                        </div>
                    </div>
                    <div class="icon_items d-flex gap-3 text-center">
                        <div class="d-grid">
                            <h2>Base Oil</h2>
                            <p></p>
                            <p></p>
                        </div>
                        <div class="d-grid align-items-center">
                            <img src="" alt="icon image">
                        </div>
                    </div>
                    <div class="icon_items d-flex gap-3 text-center">
                        <div class="d-grid">
                            <h2>Base Oil</h2>
                            <p></p>
                            <p></p>
                        </div>
                        <div class="d-grid align-items-center">
                            <img src="" alt="icon image">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</main>