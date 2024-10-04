<style>
    .pagination {
        align-self: center;
        gap: .5rem;
    }

    .page-item>a {
        color: #000;
    }

    .card{
        gap:20px;
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

    @media (max-width: 992px) {
        .service_image {
            width: 100%;
            /* Make image take full width on smaller screens */
            padding: 0;
        }

        .service_content {
            padding: 20px;
            align-self: flex-start;
        }

        .service_text {
            border-radius: 8px;
        }

        .service-card {
            flex-direction: column;
            /* Stack content vertically */
            text-align: center;
        }

        .service_image img {
            border-radius: 8px 8px 0 0;
        }
    }

    @media (max-width: 720px) {
        .service-card {
            flex-direction: column;
            /* Ensure cards stack vertically on small devices */
        }

        .service_image {
            width: 100%;
            padding: 0;
        }

        .service_image img {
            width: 100%;
            height: auto;
            border-radius: 8px 8px 0 0;
        }

        .service_content {
            width: 100%;
            padding: 20px;
        }

        .btn-custom {
            font-size: 10px;
            padding: 8px 15px;
        }

        .sidebar{
            display: none;
        }
    }
</style>
<main>
    <div class="container">
        <div class="row pt-5">
            <div class="col-lg-9 services">
                <div class="grid-container flex-column">
                    <!-- Card 1 -->
                    <?php foreach ($data['service'] as $rows): ?>
                        <div class="card flex-xl-row flex-lg-row service-card">
                            <div class="service_image col-5">
                                <a href="<?= $_ENV['NEWS_URL'] . '/' . $rows['slug'] ?>">
                                    <img src="<?= $_ENV['PICTURE_URL'] . '/' . $rows['image'] ?>" alt="Service Picture"
                                        class="img-responsive">
                                </a>
                            </div>
                            <div class="service_content col-7 bg-white align-content-center">
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