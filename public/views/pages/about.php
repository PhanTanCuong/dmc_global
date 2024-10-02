<style>
    .about {
        background-color: #f5f5f5;
    }

    .about .mb-5 img {
        width: 100%;
        height: auto;
        max-height: 400px;
        object-fit: cover;
    }


    /* Responsive Grid System */
    /* .row {
        --bs-gutter-x: unset !important;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    } */

    .col-lg-9 {
        flex: 0 0 100%;
        max-width: 80%;
        margin: 0 20px 10px;
    }

    .title {
        margin: unset;
        margin-bottom: 1em;
    }

    .shadow>.table-reponsive>h3 {
        color: #c92027;
        font-weight: 700;
    }

    .shadow {
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        background-color: white;
        margin-bottom: 20px;
        border-radius: 8px;
        overflow-x: auto;
    }

    .shadow p {
        font-size: 1rem;
        line-height: 1.5;
    }

    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }

    img {
        max-width: 100%;
        height: auto;
    }


    p {
        font-size: 16px;
        line-height: 1.6;
        word-wrap: break-word;
        /* Đảm bảo các từ dài không phá vỡ bố cục */
    }

    h3 {
        font-size: 20px;
        margin-bottom: 20px;
    }

    @media (max-width: 768px) {
        .shadow {
            padding: 15px;
        }

        p,
        h3 {
            font-size: 14px;
        }


    }

    /* Media Queries */
    @media (max-width: 768px) {
        .title {
            font-size: 2rem;
        }

        .pseudo {
            font-size: 0.9rem;
        }

        .shadow {
            padding: 10px;
        }

        .shadow p {
            font-size: 0.9rem;
        }

        .row{
            flex-direction: column;
            align-items: center;
        }
        .col-9{
            width: 100%;
        }

        .col-3{
            width: 80%;
        }
    }

    @media (max-width: 576px) {
        .title {
            font-size: 1.5rem;
        }

        .shadow {
            padding: 15px;
        }

        .about .mb-5 img {
            max-height: 300px;
        }
    }
</style>
<?php if (mysqli_num_rows($data['about']) > 0): ?>
    <?php while ($row = mysqli_fetch_assoc($data['about'])): ?>
        <section class="about pb-5">
            <div class="mb-5"><img src="<?= $_ENV['PICTURE_URL'] . '/background_about.jpg' ?>" alt="background picture"></div>
            <div class="container">
                <div class="mb-5">
                    <h1 class="title  wow slideInLeft"> <?= $row['title'] ?>
                        <p class="pseudo"></p>
                    </h1>
                </div>
                <div class="row">
                    <div class="col-<?= ($row['slug'] === 'company') ? '9' : '12' ?>">
                        <div class="shadow bg-white p-4">
                            <div class="table-reponsive">
                                <?php (strip_tags($row['long_description'])) ?
                                    (print '<p>' . $row['long_description'] . '</p>') :
                                    (print '<h3> We are now updating ...</h3>') ?>
                            </div>
                        </div>
                    </div>
                    <?php if ($row['slug'] === 'company'): ?>
                        <div class="col-3"><img src="<?= $_ENV['PICTURE_URL'] . '/banner-company.png' ?>" alt="company banner">
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </section>
    <?php endwhile; ?>
<?php endif ?>