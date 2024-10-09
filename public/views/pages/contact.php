<style>
    .item-infor {
        padding: 20px;
        margin: 0px 10px;
        background-color: #fff;
        position: absolute;
        bottom: -25px;
        right: 10px;
        left: 10px;
        border-bottom: 1px solid #555;
    }

    .section__contact .item-infor {
        height: 40%;
    }

    .section__connect .item-infor {
        height: 70%;
    }

    .title {
        margin: unset;
        margin-bottom: 4rem;
        padding-top: 2rem
    }

    .section__contact .grid {
        grid-template-columns: 1fr 1fr;
    }

    .col-md-6 input,
    .col-md-12 input,
    .col-md-12 textarea {
        width: 100%;
    }

    @media only screen and (max-width: 768px) {
        .section__contact .grid {
            grid-template-columns: 1fr;
        }
    }

    @media only screen and (max-width: 720px) {
        .grid {
            grid-template-columns: 1fr;
        }
    }
</style>
<section class="section__contact pb-xl-0 pb-3">
    <h1 class="title  wow slideInLeft">CONTACT DMC GLOBAL IN SINGAPORE
        <p class="pseudo"></p>
    </h1>
    <?php $product_url = $_ENV['BASE_URL'] . '/product'; ?>
    <section class='product2 mb-xl-0 pb-3' id="product2">
        <div class="container">
            <div class="grid">
                <?php if (mysqli_num_rows($data["contact"]) > 0): ?>
                    <?php while ($rows = mysqli_fetch_array($data["contact"])): ?>
                        <div class="comp wow fadeIn">
                            <div class="image-container">
                                <img src=<?= $imageUrl . '/' . $rows['image'] ?> alt="Image">
                                <div class="item-infor">
                                    <h3 class="item-title"><?= $rows['title'] ?> </h3>
                                    <p><?= $rows['description'] ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>

    </section>
</section>
<section class="section section__connect pb-xl-0 pb-3">
    <h1 class="title  wow slideInLeft">CONNECT WITH GLOBAL DMC
        <p class="pseudo"></p>
    </h1>
    <?php $product_url = $_ENV['BASE_URL'] . '/product'; ?>
    <section class='product2 mb-xl-0 pb-3' id="product2">
        <div class="container">
            <div class="grid">
                <?php if (mysqli_num_rows($data["connect"]) > 0): ?>
                    <?php while ($rows = mysqli_fetch_array($data["connect"])): ?>
                        <div class="comp wow fadeIn">
                            <div class="image-container">
                                <img src=<?= $imageUrl . '/' . $rows['image'] ?> alt="Image">
                                <div class="item-infor">
                                    <h3 class="item-title"><?= $rows['title'] ?> </h3>
                                    <p><?= $rows['description'] ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>

    </section>
</section>
<section class="section">
    <div class="section section_about pb-xl-0 pb-3">
        <h1 class="title  wow slideInLeft">MORE IN ABOUT US
            <p class="pseudo"></p>
        </h1>
    </div>
    <ul>
        <li><a href=""></a></li>
    </ul>
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-12">
                <div class="text-justify">
                    <h3>Feel free to contact at any time </h3>
                    <p>We are always available for free, no obligation advice and assistance on our products, services
                        and other matters that concern.</p>
                </div>
                <div class="text-justify">
                    <h3></h3>
                    <p></p>
                </div>
            </div>
            <div class="col-xl-6 col-12">
                <p>Please leave your email address, we will update our important news to you.</p>
                <div class="contact__form">
                    <form action="sendContact" method="POST">
                        <div class="row p-1">
                            <div class="col-md-6"><input type="text"></div>
                            <div class="col-md-6"><input type="text"></div>
                        </div>
                        <div class="row p-1">
                            <div class="col-md-6"><input type="text"></div>
                            <div class="col-md-6"><input type="text"></div>
                        </div>
                        <div class="row p-1">
                            <div class="col-md-12"><input type="text"></div>
                        </div>
                        <div class="row p-1">
                            <div class="col-md-12"><textarea name="" id="" rows="4"></textarea></div>
                        </div>
                        <div class="btn2-container d-flex justify-content-center font-weight-bolder">
                        <button type="submit" name="sendContact" class="btn2">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>