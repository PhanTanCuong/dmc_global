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

    .service_text {
        padding: 20px;
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
                        <div class="card flex-row">
                            <div class="service_image col-5"> <img src="<?= $_ENV['PICTURE_URL'] . '/' . $rows['image'] ?>"
                                    alt="Service Picture">
                            </div>
                            <div class="service_content col-7">
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
                    <ul class="pagination justify-content-center">
                        <li class="page-item"><a class="page-link" href="#" id="prev-page">&lt;</a></li>
                        <li class="page-item"><a class="page-link" href="#" id="page-1">1</a></li>
                        <li class="page-item"><a class="page-link" href="#" id="page-2">2</a></li>
                        <li class="page-item"><a class="page-link" href="#" id="page-3">3</a></li>
                        <li class="page-item"><a class="page-link" href="#" id="next-page">&gt;</a></li>
                    </ul>
                </div>
            </div>
            <?php include('partials/sideBar.php') ?>

        </div>
    </div>
</main>