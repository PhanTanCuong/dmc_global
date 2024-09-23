<section class="latest-news">
    <div class="container">
        <h2 class="title wow slideInLeft">our latest news
            <p class="pseudo"></p>
        </h2>

        <div class="news-grid wow fadeIn">
            <?php
            if (mysqli_num_rows($data['news']) > 0) {
                while ($rows = mysqli_fetch_array($data['news'])) {
            ?>
                    <div class="news-item ">
                        <img src="/dmc_global/public/images/<?= $rows['image'] ?>" alt="News">
                        <h3><?= $rows['title'] ?></h3>
                        <p><?= $rows['description'] ?></p>
                    </div>
            <?php
                }
            }
            ?>
</section>