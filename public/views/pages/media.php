<style>
    .media__items:first-child {
        grid-row: span 2;
    }
</style>
<section class="section__media">
    <h1 class="title  wow slideInLeft">media
        <p class="pseudo"></p>
    </h1>
    <?php $product_url = $_ENV['BASE_URL'] . '/product'; ?>
    <section class='product2' id="product2">
        <div class="container">
            <div class="grid">
                <?php if (mysqli_num_rows($data["media"]) > 0): ?>
                    <?php while ($rows = mysqli_fetch_array($data["media"])): ?>
                        <div class="comp media__items wow fadeIn">
                            <div class="image-container">
                                <img src=<?= $imageUrl . '/' . $rows['image'] ?> alt="Image">
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>


</section>