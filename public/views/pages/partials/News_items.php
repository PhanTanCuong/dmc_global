<section class="latest-news">
    <div class="container">
        <h2 class="title wow slideInLeft">our latest news
            <p class="pseudo"></p>
        </h2>

        <div class="grid">
            <?php if (mysqli_num_rows($data["news"]) > 0): ?>
                <?php while ($rows = mysqli_fetch_array($data["news"])): ?>
                    <div class="comp wow fadeIn">
                        <?php $links="http://localhost/dmc_global/public/News/". $rows['slug']?>
                        <a href="<?=$links?>">
                            <img src="/dmc_global/public/images/<?= $rows['image'] ?>" alt="Image">
                        </a>
                        <h3 class="item-title">
                            <a href="<?=$links?>"><?= $rows['title'] ?></a>
                        </h3>
                        <p class="description"><?= $rows['description'] ?></p>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
</section>
<main>
    
</main>