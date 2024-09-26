<style>
    /* post body */
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


    /* Repomsive */
    @media (max-width: 768px) {
        .single-post h2.blog-title {
            font-size: 1.5rem;
            text-align: center;
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

    }
</style>

<main>
    <div class="container">
        <div class="section">
            <div class="container">
                <div class="single-post">
                    <?php foreach ($data['post'] as $post): ?>
                        <h1 class="title  wow slideInLeft"><?= $post['title'] ?>
                            <p class="pseudo"></p>
                        </h1>
                        </ul>
                        <div class="post-detail"><?= $post['long_description'] ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>