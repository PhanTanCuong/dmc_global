<style>
    .title{
        margin:unset !important;
        padding: 10vh 0;
    }

    .pseudo{
        bottom: -0.5rem;
    }
</style>
<?php include('partials/breadcrumb.php') ?>

<?php $count = count($data['news']); ?>
<?php for ($i = 0; $i < $count; $i++): ?>
    <section class="product-category">
        <h1 class="title  wow slideInLeft"><?= $data['news'][$i]['name'] ?>
            <p class="pseudo"></p>
        </h1>
        <?php $items = [] ?>
        <?php $columnCount = count($data['news'][$i]['items']); ?>
        <section class='product2' id="product2">
            <div class="container">
                <div class="grid">
                    <?php for ($j = 0; $j < $columnCount; $j++): ?>
                        <?php $items = $data['news'][$i]['items'][$j]; ?>
                        <div class="comp wow fadeIn">
                            <a href="<?= $_ENV["NEWS_URL"] . '/' . $items['slug'] ?>">
                                <img src=<?= $imageUrl . '/' . $items['image'] ?> alt="Image">
                            </a>
                            <div class="item-infor">
                                <h3 class="item-title">
                                    <a href="<?= $_ENV["NEWS_URL"] . '/' . $items['slug'] ?>"><?= $items['title'] ?></a>
                                </h3>
                                <p class="description"><?= $items['description'] ?></p>
                                <a href="<?= $_ENV["NEWS_URL"] . '/' . $items['slug'] ?>" class="btn-custom">Read
                                    more</a>
                            </div>
                        </div> <?php endfor ?>
                </div>
            </div>
            </div>
        </section>
    </section>

<?php endfor; ?>