<?php
include ('includes/head.php');
include ('includes/nav.php');
?>
<div class="container-fluid">

</div>
<!-- Main -->
<main>
  <section id="about">
    <section class="about1">
      <?php
      if (mysqli_num_rows($data["banner"]) > 0) {
        while ($rows = mysqli_fetch_array($data["banner"])) {

          $banner_pic = $rows['image'];
          $image_path = "/dmc_global/public/images/" . $banner_pic;
          if (file_exists($_SERVER['DOCUMENT_ROOT'] . $image_path)) {
      ?>
            <div class="slideshow-container">
              <div class="item">
                <img src="<?php echo $image_path ?>" class="img-fluid">
              </div>
              <div class="item">
                <img src="<?php echo $image_path ?>" class="img-fluid">
              </div>
              <div class="item">
                <img src="<?php echo $image_path ?>" class="img-fluid">
              </div>
            </div>
            <div class="banner-text-container">
              <div class="container h-100">
                <div class="banner-text">
                  <div class="text">
                    <h1><?php echo $rows['title'] ?></h1>
                    <p><?php echo  $rows['description'] ?></p>
                    <button>View more</button>
                  </div>
                  <div class="text"></div>
                </div>
              </div>
            </div>
            </div>
      <?php
          }
        }
      }
      ?>
    </section>
    <section class="about2">
      <div class="container">
        <?php
        if (mysqli_num_rows($data["about2Infor"]) > 0) {
          while ($rows = mysqli_fetch_array($data["about2Infor"])) {
        ?>
            <div class="grid-container wow fadeInRight" data-wow-delay="400ms">
              <div class="img-container">
                <img src="/dmc_global/public/images/<?php echo $rows['parent_image'] ?>">
                <div class="chld-img-container">
                  <img src="/dmc_global/public/images/<?php echo $rows['child_image'] ?>" class="lazy img-fluid">
                </div>
              </div>
              <div class="txt-container wow pulse" data-wow-delay="400ms">
                <h2><?php echo $rows['title'] ?></h2>
                <p><?php echo $rows['description'] ?></p>
                <button>View more</button>
              </div>
            </div>
        <?php
          }
        }
        ?>
      </div>
    </section>
    <section class="about3">
      <?php
      $isOdd = false;
      if (mysqli_num_rows($data["about3Infor"]) > 0) {
        while ($rows = mysqli_fetch_array($data["about3Infor"])) {
          if ($isOdd) {
            $class = "odd";
            $pos = "right";
            $animation = "fadeInRight";
          } else {
            $class = "even";
            $pos = "left";
            $animation = "fadeInLeft";
          }
          $isOdd = !$isOdd;
      ?>
          <div class="grid2-container <?php echo $class ?>">
            <div>
              <img class="wow <?php echo $animation; ?>" data-wow-delay="400ms" style="height:27rem;" src="/dmc_global/public/images/<?php echo $rows['image'] ?>" alt="about3_image">
            </div>
            <div class="txt2-container wow <?php echo $animation; ?>" data-wow-delay="400ms" style="background: transparent; color: aliceblue;">
              <div class="image"><img src="/dmc_global/public/images/backgrud_banner.png" alt="img"></div>
              <div class="text">
                <h2><?php echo $rows['title'] ?></h2>
                <p><?php echo $rows['description'] ?></p>
              </div>
            </div>
          </div>
      <?php
        }
      }
      ?>
    </section>
    <section id="product">
      <?php
      if (mysqli_num_rows($data["product1"]) > 0) {
        while ($rows = mysqli_fetch_array($data["product1"])) {
      ?>
          <section class="product1" id="product1" style="background-image:url(/dmc_global/public/images/<?php echo $rows['image'] ?>)">
            <div class="our-products wow pulse">
              <h1><?php echo $rows['title'] ?></h1>
              <p><?php echo $rows['description'] ?></p>
              <button>VIEW MORE</button>
            </div>
          </section>
      <?php
        }
      }
      ?>
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
                  <img src="/dmc_global/public/images/<?php echo $rows['image'] ?>" alt="Image">
                  <h2><?php echo $rows['title'] ?></h2>
                  <p><?php echo $rows['description'] ?></p>
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

      </div>
    </section>
    <section id="media">
      <?php
      if (mysqli_num_rows($data["bg_stat"]) > 0) {
        while ($rows = mysqli_fetch_array($data["bg_stat"])) {
          $stat_bg = $rows['image'];
          $image_path = "/dmc_global/public/images/" . $stat_bg;
          if (file_exists($_SERVER['DOCUMENT_ROOT'] . $image_path)) {
      ?>
            <section class="stats" style="background:url(<?php echo $image_path ?>); ">
              <div class="stat-grid wow fadeI">
                <?php
                if (mysqli_num_rows($data["stats"]) > 0) {
                  while ($rows = mysqli_fetch_array($data["stats"])) {
                ?>
                    <div class="stat">
                      <div class="stat-ic wow flipInY">
                        <img class="flash" src="/dmc_global/public/images/<?php echo $rows['image'] ?>" alt="Icon">
                      </div>
                      <div class="stat-text wow fadeInDown">
                        <h3><?php echo $rows['title'] ?></h3>
                        <p><?php echo $rows['description'] ?></p>
                      </div>
                    </div>
                <?php
                  }
                }
                ?>
            </section>
      <?php
          }
        }
      }
      ?>
    </section>
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
                <img src="/dmc_global/public/images/<?php echo $rows['image'] ?>" alt="News">
                <h3><?php echo $rows['title'] ?></h3>
                <p><?php echo $rows['description'] ?></p>
              </div>
          <?php
            }
          }
          ?>
    </section>

</main>


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>