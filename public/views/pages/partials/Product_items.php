<section class='product2' id="product2">
  <div class="container">
    <h1 class="title  wow slideInLeft">products
      <p class="pseudo"></p>
    </h1>

    <div class="grid">
      <?php
      if (mysqli_num_rows($data["product"]) > 0) {
        while ($rows = mysqli_fetch_array($data["product"])) {
          ?>
          <div class="comp wow fadeIn">
            <a href="<?= $rows['slug'] ?>">
              <img src="/dmc_global/public/images/<?= $rows['image'] ?>" alt="Image">
            </a>
            <a href="<?= $row['slug'] ?>"><?= $rows['title'] ?></a>
            <p><?= $rows['description'] ?></p>
            <div class="arrow"></div>
          </div>
          <?php
        }
      }
      ?>
    </div>
    <div class="btn2-container">
      <button class="btn2"><b>View more</b></button>
    </div>
  </div>
  </div>
  </div>

</section>