<style>
    .pagination {
        align-self: center;
        gap: .5rem;
    }

    .page-item>a {
        color: #000;
    }

    .service_content {
        padding: 35px;
        align-self: center;
    }

    /* Styling for the card background */
    .service-card {
        background-color: #f5f5f5;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 20px;
        transition: box-shadow 0.3s ease;
    }

    /* Styling for the content area */
    .service_text {
        background-color: #fff;
        padding: 15px;
        border-radius: 0 8px 8px 0;
    }

    /* Styling for the image */
    .service_image img {
        width: 100%;
        height: auto;
        transition: transform 0.4s ease;
    }

    /* Hover effect for the card - shadow effect */
    .service-card:hover {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    /* Hover effect for image */
    .service-card:hover .service_image img {
        transform: scale(1.05);
        /* Enlarge the image on hover */
    }





    .btn-custom {
        display: inline-block;
        padding: 4px 10px;
        font-size: 12px;
        color: #fff;
        background-color: #333;
        border: 2px solid transparent;
        text-decoration: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-custom:hover {
        background-color: #fff;
        color: #b4171b;
        border-color: #b4171b;
        box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);

    }

    .btn-custom::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 50%;
        width: 300%;
        height: 300%;
        background: rgba(255, 255, 255, 0.15);
        transition: all 0.75s cubic-bezier(0.25, 0.1, 0.25, 1);
        border-radius: 50%;
        z-index: 0;
        transform: translate(-50%, -50%) scale(0);
    }

    .btn-custom:hover::before {
        transform: translate(-50%, -50%) scale(1);
    }

    /* Ensure text is above the effect */
    .btn-custom span {
        position: relative;
        z-index: 1;
    }
</style>
<main>
    <div class="container">
        <div class="row pt-5">
            <div class="col-lg-9 col-12 services">
                <div class="grid-container flex-column">
                    <!-- Card 1 -->
                    <?php foreach ($data['service'] as $rows): ?>
                        <div class="card flex-row service-card">
                            <div class="service_image col-5">
                                <a href="<?= $_ENV['NEWS_URL'] . '/' . $rows['slug'] ?>">
                                    <img src="<?= $_ENV['PICTURE_URL'] . '/' . $rows['image'] ?>" alt="Service Picture"
                                        class="img-responsive">
                                </a>
                            </div>
                            <div class="service_content col-7 bg-white">
                                <div class="service_text">
                                    <h3><?= $rows['title'] ?></h3>
                                    <p><?= $rows['description'] ?></p>
                                    <a href="<?= $_ENV['NEWS_URL'] . '/' . $rows['slug'] ?>" class="btn-custom">Read
                                        more</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <!-- Repeat for other cards -->
                    <?php include('partials/pagination.php') ?>
                </div>
            </div>
            <?php include('partials/sideBar.php') ?>

        </div>
    </div>
</main>