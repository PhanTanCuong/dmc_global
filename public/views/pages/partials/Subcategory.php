<div class="comp wow fadeIn">
  <a href="<?= $_ENV["PRODUCT_URL"] . '/' . $items['slug'] ?>">
    <img src=<?= $imageUrl . '/' . $items['image'] ?> alt="Image">
  </a>
  <div class="item-infor">
    <h3 class="item-title">
      <a href="<?= $_ENV["PRODUCT_URL"] . '/' . $items['slug'] ?>"><?= $items['title'] ?></a>
    </h3>
    <p class="description"><?= $items['description'] ?></p>
    <p class="arrow"><i class="fas fa-arrow-right"></i></p>
  </div>
</div>