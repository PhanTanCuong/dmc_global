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

    .service-card{
        background-color: #f5f5f5;
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
                </div>
            </div>
            <?php include('partials/sideBar.php') ?>

        </div>
    </div>
</main>