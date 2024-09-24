<!-- Main -->
<main>
    <section id="about">
        <section class="about1">

            <div class="slideshow-container">
                <?php
                if (mysqli_num_rows($data["banner"]) > 0) {
                    while ($rows = mysqli_fetch_array($data["banner"])) {

                        $banner_pic = $rows['image'];
                        $image_path = "/dmc_global/public/images/" . $banner_pic;
                        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $image_path)) {
                            ?>
                            <div class="item" style="position:relative;">
                                <img src="<?= $image_path ?>" class="img-fluid">
                                <div class="text-banner">
                                    <h1><?= $rows['title'] ?></h1>
                                    <p><?= $rows['description'] ?></p>
                                    <button>View more</button>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
                ?>

        </section>
        <section class="about2">
            <div class="container">
                <?php
                if (mysqli_num_rows($data["about2Infor"]) > 0) {
                    while ($rows = mysqli_fetch_array($data["about2Infor"])) {
                        ?>
                        <div class="grid-container wow fadeInRight" data-wow-delay="400ms">
                            <div class="image img-container">
                                <img src="/dmc_global/public/images/<?= $rows['image'] ?>" class="lazy" alt="image">
                                <div class="chld-img-container">
                                    <img src="/dmc_global/public/images/5-canh.gif" class="lazy img-fluid" alt="image">
                                </div>
                            </div>
                            <div class="txt-container wow pulse" data-wow-delay="400ms">
                                <h2><?= $rows['title'] ?></h2>
                                <p><?= $rows['description'] ?></p>
                                <button>View more</button>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </section>
        <section class="about3">
                <div class="container"></div>
            <div class="banner">
                <?php $isOdd = true; ?>
                <?php if (mysqli_num_rows($data["about3Infor"]) > 0): ?>
                    <?php while ($rows = mysqli_fetch_array($data["about3Infor"])): ?>
                        <?php if ($isOdd) {
                            $class = "odd";
                            $pos = "right";
                            $animation = "fadeInRight";
                        } else {
                            $class = "even";
                            $pos = "left";
                            $animation = "fadeInLeft";
                        }
                        $isOdd = !$isOdd; ?>
                        <div class="grid2-container <?= $class ?>"
                            style="background:url(/dmc_global/public/images/<?= $rows['image'] ?>)">
                            <div class="image-container wow <?= $animation; ?>" data-wow-delay="400ms">
                                <div class="image">
                                    <img src="/dmc_global/public/images/<?= $rows['image'] ?>" alt="img">
                                </div>
                            </div>
                            <div class="txt2-container wow <?= $animation; ?>" data-wow-delay="400ms"
                                style="background: transparent; color: aliceblue;">
                                <div class="image">
                                    <img src="/dmc_global/public/images/backgrud_banner.png" alt="img">
                                </div>
                                <div class="text">
                                    <h2><?= $rows['title'] ?></h2>
                                    <p><?= $rows['description'] ?></p>
                                </div>
                            </div>
                        </div>

                    <?php endwhile; ?>
                <?php endif; ?>
            </div>

        </section>
        <section id="product">
            <?php
            if (mysqli_num_rows($data["product1"]) > 0) {
                while ($rows = mysqli_fetch_array($data["product1"])) {
                    ?>
                    <section class="product1" id="product1"
                        style="background-image:url(/dmc_global/public/images/<?= $rows['image'] ?>)">
                        <div class="our-products wow pulse">
                            <h1><?= $rows['title'] ?></h1>
                            <p><?= $rows['description'] ?></p>
                            <button>VIEW MORE</button>
                        </div>
                    </section>
                    <?php
                }
            }
            ?>

            <?php include('partials/Product_items.php') ?>

            </div>
        </section>
        <section id="media">
            <?php
            if (mysqli_num_rows($data["bg_stat"]) > 0) {
                while ($rows = mysqli_fetch_array($data["bg_stat"])) {
                    $stat_bg = $rows['image'];
                    $image_path = "/dmc_global/public/images/" . $stat_bg;
                    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $image_path)) {
                        ?>
                        <section class="stats" style="background:url(<?= $image_path ?>); ">
                            <div class="stat-grid wow fadeI">
                                <?php
                                if (mysqli_num_rows($data["stats"]) > 0) {
                                    while ($rows = mysqli_fetch_array($data["stats"])) {
                                        ?>
                                        <div class="stat">
                                            <div class="stat-ic wow flipInY">
                                                <img class="flash" src="/dmc_global/public/images/<?= $rows['image'] ?>" alt="Icon">
                                            </div>
                                            <div class="stat-text wow fadeInDown">
                                                <h3><?= $rows['title'] ?></h3>
                                                <p><?= $rows['description'] ?></p>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                        </section>
                        <?php
                    }
                }
            }
            ?>
        </section>
        <?php include('partials/News_items.php') ?>
</main>