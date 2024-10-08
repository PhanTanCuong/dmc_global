<style>
    .product2{
        margin: 0px;

    }

    .pagination{
        background-color: #f5f5f5;
        margin-bottom: 0px;
        padding: 30px 0;
    }

    @media only screen and  (max-width:720px) {
        .grid{
            margin:0px;
            padding-top: 20px;
        }
        
    }
</style>
<?php include('partials/breadcrumb.php') ?>


<section class='product2' id="product2">
    <div class="container">
        <div class="grid">
            <?php if (mysqli_num_rows($data["product"]) > 0): ?>
                <?php while ($rows = mysqli_fetch_array($data["product"])): ?>
                    <div class="comp wow fadeIn">
                        <a href="<?= $_ENV["PRODUCT_URL"] . '/' . $rows['slug'] ?>">
                            <img src=<?= $imageUrl . '/' . $rows['image'] ?> alt="Image">
                        </a>

                        <div class="item-infor">
                            <h3 class="item-title">
                                <a href="<?= $_ENV["PRODUCT_URL"] . '/' . $rows['slug'] ?>"><?= $rows['title'] ?></a>
                            </h3>
                            <p class="description"><?= $rows['description'] ?></p>
                            <p class="arrow"><i class="fas fa-arrow-right"></i></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>

</section>

<?php include('partials/pagination.php')?>