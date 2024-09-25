<style>
    .container {
        background-color: #f5f5f5;
    }

    .section {
        padding-top: 20vh;
    }

    .blog-title {
        color: #c92027;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .list_none {
        display: flex;
        gap: 10px;
    }

    a {
        color: #292b2c;
        transition: all .3s ease-in-out;
        text-decoration: none;
    }

    a:hover {
        color: #c92027;
    }

    ul {
        padding-left: 0;
        margin-bottom: 1.5rem;
    }

    .fas.fa-calendar {
        margin: 5px 5px 0 0;
    }

    .social_icons li {
        display: inline-block;
        margin-right: 10px;
        font-size: x-large;
    }

    .social_icons li a {
        text-decoration: none;
        color: #333;
        transition: transform 0.3s ease, color 0.3s ease;
    }

    .social_icons li a:hover {
        color: #007bff;
        transform: scale(1.2);
    }

    .social_icons li a.facebook:hover {
        color: #3b5998;
    }

    .social_icons li a.twitter:hover {
        color: #1da1f2;
    }

    .social_icons li a.linkedin:hover {
        color: #0077b5;
    }

    /* Repomsive */
    @media (max-width: 768px) {
        .single-post h2.blog-title {
            font-size: 1.5rem;
            text-align: center;
        }

        .blog_meta {
            flex-direction: column;

            align-items: center;
        }

        .blog_meta li {
            margin-bottom: 10px;
        }

        .social_icons {
            text-align: center;
            margin-top: 20px;
        }

        .social_icons li {
            display: inline-block;
            margin-right: 10px;
        }
    }


    @media (max-width: 576px) {
        .single-post h2.blog-title {
            font-size: 1.2rem;
        }

        .post-detail {
            padding: 0 10px;
            font-size: 0.9rem;
        }

        .container,
        .section {
            padding: 10px;
        }

        .social_icons li {
            margin-right: 5px;
        }
    }

    /* Styles cho các thiết bị lớn hơn 768px (tablet, desktop) */
    @media (min-width: 768px) {
        .social_icons {
            text-align: right;
        }

        .social_icons li {
            display: inline-block;
            margin-right: 15px;
        }
    }
</style>
<main>
    <!--  -->

    <div class="container">
        <div class="section">
            <div class="container">
                <div class="single-post">
                    <?php foreach ($data['post'] as $post): ?>
                        <h2 class="blog-title"><?= $post['title'] ?></h2>
                        <ul class="list_none blog_meta">
                            <li style="display:flex;">
                                <i class="fas fa-calendar"></i>
                                <?= date('M d, Y', strtotime($post['created_at'])) ?>
                            </li>
                            <li>
                                <span>
                                    <i class="far fa-edit"></i>
                                    <?php foreach ($data["news"] as $column): ?>
                                        <a
                                            href="<?= $_ENV["BASE_URL"] . '/' . $column['slug'] ?>"><?= $column['name'] . ',' ?></a>
                                    <?php endforeach; ?>
                                    <?php unset($column); ?>
                                    <!-- <p>, </p> -->
                                    <?php foreach ($data["category"] as $column): ?>
                                        <a href="<?= $_ENV["BASE_URL"] . '/' . $column['slug'] ?>"><?= $column['name'] ?></a>
                                    <?php endforeach; ?>
                                </span>
                            </li>
                        </ul>
                        <div class="post-detail"><?= $post['long_description'] ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- FOOTER BLOG -->
        <div class="row justify-content-between align-items-center">
            <div class="col-md-8 mb-3 mb-md-0">
                <div></div>
            </div>
            <div class="col-md-4">
                <ul class="social_icons text-md-right">
                    <li><a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#" class="twitter"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#" class="linkedin"><i class="fab fa-linkedin-in"></i></a></li>
                </ul>
            </div>
        </div>
    </div>

</main>