<style>
    .container {
        background-color: #f5f5f5;
    }

    .blog-title {
        color: #c92027;
    }

    ul{
        display: flex;
        gap:10px;
    }
</style>
<main>
    <div class="container">
        <div class="section">
            <div class="container">
                <div class="single-post">
                    <?php if (mysqli_num_rows($data['post']) > 0): ?>
                        <?php while ($post = mysqli_fetch_array($data['post'])): ?>
                            <h2 class="blog-title"><?= $post['title'] ?></h2>
                            <ul>
                                <li>
                                    <i class="fas fa-calendar-alt"></i>
                                </li>
                                <li><i class="far fa-edit"></i></li>
                            </ul>
                            <div class="post-detail"><?= $post['long_description'] ?></div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>