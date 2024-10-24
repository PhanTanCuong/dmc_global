<link rel="stylesheet" type="text/css" href="/dmc_global/public/css/home.css?v=<?= microtime() ?>">
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

            <!-- Overview section  -->
    </section>
    <section class="about2 my-6">
        <?php $arrayData = json_decode($data["about2Infor"], true) ?>
        <div class="container">
            <div class="grid-container flex-xl-row-reverse flex-column mb-3 wow fadeInRight " data-wow-delay="400ms">
                <div class="image img-container col-xl-6 col-12">
                    <img src="<?= $arrayData['content'][0]['image'] ?>" alt="image">
                    <div class="chld-img-container">
                        <img src="<?= $imageUrl . '/5-canh.gif' ?>" class="lazy img-fluid" alt="image">
                    </div>
                </div>
                <div class="txt-container col-xl-6 col-12 wow pulse" data-wow-delay="400ms">
                    <h2><?= $arrayData['content'][0]['title'] ?></h2>
                    <p><?= $arrayData['content'][0]['description'] ?></p>
                </div>
            </div>

            <div>
                <div
                    class="section_icon d-flex flex-wrap align-items-center justify-content-around gap-xl-2 gap-3 mb-xl-0 mb-3">
                    <?php foreach ($arrayData['icon'] as $icon): ?>
                        <div
                            class="icon_items d-grid text-center d-flex flex-column justify-content-center align-items-center ">
                            <img src="<?= $icon['image'] ?>" alt="icon image">
                            <h5><?= $icon['title'] ?></h5>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </section>
    <!-- End overview section  -->

    <!-- product showcase section -->
    <?php $arrayData = json_decode($data["product"], true) ?>
    <?php foreach ($arrayData as $container => $rows): ?>
        <section class="section__product">
            <?php if ($container === 'title'): ?>
                <h1 class="title  wow slideInLeft"><?= $rows[0]['title'] ?>
                    <p class="pseudo"></p>
                </h1>
            <?php endif; ?>
            <?php if ($container === 'content'): ?>
                <?php $total = count($rows) ?>
                <section class='product2' id="product2">
                    <div class="container container-xl">
                        <div class="grid">
                            <?php for ($i = 0; $i < $total; $i++): ?>
                                <div class="comp wow fadeIn">
                                    <div class="image-container">
                                        <img src=<?= $rows[$i]['image'] ?> alt="Image">
                                        <div class="item-infor">
                                            <h3 class="item-title">
                                                <a
                                                    href="<?= $_ENV["BASE_URL"] . '/' . $rows[$i]['link'] ?>"><?= $rows[$i]['title'] ?></a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($container === 'button'): ?>
                        <div class="btn2-container ">
                            <a class="btn2 text-center"
                                href="<?= $_ENV["BASE_URL"] . $rows[0]['link'] ?>"><b><?= $rows[0]['title'] ?></b></a>
                        </div>
                    <?php endif; ?>
                </div>

            </section>
        </section>
    <?php endforeach; ?>
    <?php unset($rows); ?>
    <!-- end product showcase section -->

    <!-- media section -->

    <section class="section__media">
        <?php $arrayData = json_decode($data["media"], true) ?>
        <?php foreach ($arrayData as $container => $rows): ?>
            <?php if ($container === 'title'): ?>
                <h2 class="title  wow slideInLeft"><?= $rows[0]['title'] ?>
                </h2>
            <?php endif; ?>
            <?php if ($container === 'content'): ?>
                <?php $total = count($rows) ?>
                <section class='product2' id="product2">
                    <div class="container">
                        <div class="grid">
                            <?php for ($i = 0; $i < $total; $i++): ?>
                                <div class="comp media__items wow fadeIn">
                                    <div class="image-container">
                                        <a href="<?= $rows[$i]['link'] ?>">
                                            <img src=<?= $rows[$i]['image'] ?> alt="Image">
                                        </a>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php unset($rows) ?>
        <!-- end media section -->

        <!-- Vision section  -->
        <?php $arrayData = json_decode($data['vision'], true) ?>
        <section class="section__contact">
            <section class="product1" id="product1"
                style="background-image:url(<?= $arrayData['content'][0]['image'] ?>)">
                <div class="our-products wow pulse">
                    <h2><?= $arrayData['content'][0]['title'] ?></h2>
                    <p><?= $arrayData['content'][0]['description'] ?></p>
                    <a href="<?= $_ENV["BASE_URL"] . $arrayData['button'][0]['link'] ?>" class="btn btn-custom">
                        <?= $arrayData['button'][0]['title'] ?>
                    </a>
                </div>
            </section>
        </section>
        <!-- end vision section -->

        <!-- Second overrview section -->
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
        <!-- End second overview section -->
</main>