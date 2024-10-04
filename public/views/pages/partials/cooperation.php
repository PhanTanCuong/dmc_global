<!-- <link rel="stylesheet" type="text/css" href="/dmc_global/public/css/post.css?v=<?= microtime() ?>"> -->
<main style="padding:unset">
    <div class="container">
        <div class="section">
            <div class="container">
                <div class="single-post">
                    <?php foreach ($data['post'] as $post): ?>
                        <h2 class="blog-title" style=" margin:unset ;"><?= $post['title'] ?></h2>
                        <div class="post-detail"><?= $post['long_description'] ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>