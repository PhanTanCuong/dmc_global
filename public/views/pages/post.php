<link rel="stylesheet" type="text/css" href="/dmc_global/public/css/post.css?v=<?= microtime() ?>">

<!-- BREADCRUMB  -->
<?php include('partials/breadcrumb.php')?>

<!-- END BREADCRUMB  -->
<main>
    

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
                                    <?php foreach ($data["category_info"] as $column): ?>
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