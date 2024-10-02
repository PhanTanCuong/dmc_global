

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
    <div class="btn2-container">
      <?php use Mvc\Utils\SlugHelper?>
      <a class="btn2 text-center" href="<?=$_ENV['BASE_URL'].'/list-product-by-category'.'/'.SlugHelper::getSlugFromURL()?>"><b>View more</b></a>
    </div>
  </div>
  </div>
  </div>

</section>