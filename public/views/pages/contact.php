<style>
    p {
        text-align: justify;
    }

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
        padding: 8px 15px;
    }

    .section__about ul {
        border-top: 1px solid #555;
        background-color: #fff;
        display: grid;
        grid-template-columns: 1fr 1fr;
        padding: 20px 10px 30px;
        margin-bottom: 4%;
        justify-items: center;
    }

    .section__map{
        padding-bottom: 2rem;
    }

    .section__about a {
        font-weight: 600;
    }

    .infor__mail h3 {
        color: #c92027;

    }

    .map__container {
        position: relative;
        width: 100%;
        height: 0;
        padding-bottom: 56.25%;
        /* Tỷ lệ khung hình 16:9 */
    }

     iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    @media only screen and (max-width: 768px) {
        .section__contact .grid {
            grid-template-columns: 1fr;
        }

        input {
            margin-bottom: 10px;
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
    <div class="section section__about pb-xl-0 pb-3">
        <h1 class="title  wow slideInLeft">MORE IN ABOUT US
            <p class="pseudo"></p>
        </h1>
        <div class="container">
            <ul>
                <?php foreach ($data["about_us"] as $rows): ?>

                    <li><a href="<?= $_ENV['BASE_URL'] . '/about-us' . '/' . $rows["slug"] ?>">
                            <?= $rows["name"] ?>
                        </a></li>
                <?php endforeach; ?>
                <?php unset($rows); ?>
            </ul>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-12">
                <div class="infor__mail text-justify">
                    <h3>Feel free to contact at any time </h3>
                    <p>We are always available for free, no obligation advice and assistance on our products, services
                        and other matters that concern.</p>
                </div>
                <?php foreach ($data["infor_mail"] as $rows): ?>
                    <?php if ($rows["json_data"] === "null"): ?>
                        <div class="infor__mail text-justify">
                            <h3><strong><?= $rows["title"] ?></strong></h3>
                            <p><?= $rows["description"] ?></p>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="col-xl-6 col-12">
                <p>Please leave your email address, we will update our important news to you.</p>
                <div class="contact__form">
                    <form action="sendContact" method="POST">
                        <div class="row p-xl-1 p-0">
                            <div class="col-md-6"><input type="text" name="name_field" placeholder="Name"></div>
                            <div class="col-md-6"><input type="text" name="email_field" placeholder="Email"></div>
                        </div>
                        <div class="row p-xl-1 p-0">
                            <div class="col-md-6"><input type="text" name="address_field" placeholder="Address"></div>
                            <div class="col-md-6"><input type="text" name="phone_field" placeholder="Phone"></div>
                        </div>
                        <div class="row p-xl-1 p-0">
                            <div class="col-md-12"><input type="text" name="subject_field" placeholder="Subject"></div>
                        </div>
                        <div class="row p-xl-1 p-0">
                            <div class="col-md-12"><textarea name="message" id="" rows="4"
                                    placeholder="Message"></textarea></div>
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
<section class="section section__map">
    <div class="container map__container">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.8354345097893!2d144.95592341528235!3d-37.81621897975153!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d43ef4e6a9f%3A0x2c0a27d235e531c9!2sInternational%20Plaza!5e0!3m2!1sen!2s!4v1616507362094!5m2!1sen!2s"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
</section>