<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>DMC Global</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- .css file -->
  <link rel="stylesheet" type="text/css" href="/dmc_global/public/css/header.css">
  <link rel="stylesheet" href="/dmc_global/public/css/about.css">
  <link rel="stylesheet" href="/dmc_global/public/css/product.css">
  <link rel="stylesheet" href="/dmc_global/public/css/media.css">
  <link rel="stylesheet" href="/dmc_global/public/css/footer.css">

  <!-- lib -->
  <!-- slick -->
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

  <!-- boostrap -->
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

  <!-- Font-awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <style>
    .comp img {
      height: 18rem;
    }

    .item.slick-slide img{
      width:100%;
      height: auto;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <!-- Header -->
    <header>
      <!-- Thanh chuyển hướng -->
      <div class="logo">
        <div class="logo_ic">
          <img src="/dmc_global/public/images/Logo.png" class="img-fluid" alt="DMC Global">
        </div>
        <div class="toogle">
          <i class="fa-solid fa-bars"></i>
        </div>
        <nav>

          <ul>
            <li><a href="#about">About</a></li>
            <li>
              <a href="#product">Product</a>
              <i class="fa fa-caret-down"></i>
              <ul class="dropdown">
                <li><a href="#product1">Product1</a></li>
                <li><a href="#product2">Product2</a></li>
                <li><a href="#product2">Product3</a></li>
              </ul>
            </li>
            <li><a href="#media">Media</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="#compliance">Compliance</a></li>
            <li></button>
              <form action="" class="search-box">
                <input type="text" class="search-text" placeholder="Search..." required>
                <!-- required là thuộc tính bắt user nhập thông tin ới cho submit -->
                <button class="search-btn">
                  <i class="fas fa-search"></i></button>
              </form>
            </li>
          </ul>
      </div>
      </nav>
    </header>
  </div>

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
                  <img src="/dmc_global/public/images/banner.png" class="img-fluid">
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
          <div class="grid-container">
            <div class="img-container">
              <img src="/dmc_global/public/images/<?php echo $rows['parent_image']?>">
              <div class="chld-img-container">
                <img src="/dmc_global/public/images/<?php echo $rows['child_image']?>" class="img-fluid">
              </div>
            </div>
            <div class="txt-container">
              <h2><?php echo $rows['title']?></h2>
              <p><?php echo $rows['description']?></p>
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
        <div class="grid2-container">
          <div></div>
          <div class="txt2-container" style="background: transparent; color: aliceblue;">
            <img src="/dmc_global/public/images/abut2_child_img.png">
            <div class="text">
              <h2>DMC Global, perfect from planning to operations.</h2>
              <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut ab nemo commodi assumenda culpa officia
                ipsum itaque doloremque fugiat quo, iusto quod repudiandae sit illo voluptatibus blanditiis placeat?
                Quod, repellendus.</p>
            </div>

          </div>
        </div>

        <div class="grid2-container odd">

          <div></div>
          <div class="txt2-container">
            <img src="/dmc_global/public/images/abut2_child_img.png">
            <div class="text">
              <h2>DMC Global, perfect from planning to operations.</h2>
              <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut ab nemo commodi assumenda culpa officia
                ipsum itaque doloremque fugiat quo, iusto quod repudiandae sit illo voluptatibus blanditiis placeat?
                Quod, repellendus.</p>
            </div>

          </div>
        </div>
        <div class="grid2-container">

          <div></div>
          <div class="txt2-container" style="background: transparent; color: aliceblue;overflow: hidden;">
            <img src="/dmc_global/public/images/abut2_child_img.png">
            <div class="text">
              <h2>DMC Global, perfect from planning to operations.</h2>
              <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut ab nemo commodi assumenda culpa officia
                ipsum itaque doloremque fugiat quo, iusto quod repudiandae sit illo voluptatibus blanditiis placeat?
                Quod, repellendus.</p>
            </div>

          </div>
        </div>

      </section>
      <section id="product">
        <section class="product1" id="product1">
          <div class="our-products">
            <h1 style="color: white;">OUR PRODUCTS</h1>
            <p style="color: white;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam quod voluptates
              reiciendis rem debitis odit veniam laborum illum, exercitationem quos at a cupiditate. Explicabo accusamus
              voluptates nam illum, commodi praesentium?</p>
            <button>VIEW MORE</button>
          </div>
        </section>
        <section class='product2' id="product2">
          <div class="container">
            <h1 class="title">products
              <p class="pseudo"></p>
            </h1>

            <div class="grid">
              <?php
              if (mysqli_num_rows($data["product"]) > 0) {
                while ($rows = mysqli_fetch_array($data["product"])) {
              ?>
                  <div class="comp">
                    <img src="/dmc_global/mvc/uploads/<?php echo $rows['image'] ?>" alt="Image">
                    <h2><?php echo $rows['title'] ?></h2>
                    <p><?php echo $rows['description'] ?></p>
                    <div class="arrow"></div>
                  </div>
              <?php
                }
              }
              ?>
            </div>
          </div>

        </section>

        </div>
      </section>
      <section id="media">
        <section class="stats">
          <div class="stat-grid">
            <div class="stat">
              <div class="stat-ic">
                <img class="flash" src="/dmc_global/public/images/ic_1.png" alt="Icon">
              </div>
              <div class="stat-text">
                <h3>2202</h3>
                <p>Lorem Ipsum</p>
              </div>
            </div>
            <div class="stat">
              <div class="stat-ic">
                <img class="flash" src="/dmc_global/public/images/ic_2.png" alt="Icon">
              </div>
              <div class="stat-text">
                <h3>2202</h3>
                <p>Lorem Ipsum</p>
              </div>
            </div>
            <div class="stat">
              <div class="stat-ic">
                <img class="flash" src="/dmc_global/public/images/ic_3.png" alt="Icon">
              </div>
              <div class="stat-text">
                <h3>2202</h3>
                <p>Lorem Ipsum</p>
              </div>
            </div>
            <div class="stat">
              <div class="stat-ic">
                <img class="flash" src="/dmc_global/public/images/ic_4.png" alt="Icon">
              </div>
              <div class="stat-text">
                <h3>2202</h3>
                <p>Lorem Ipsum</p>
              </div>
            </div>
        </section>
      </section>
      <section class="latest-news">
        <div class="container">
          <h2 class="title">our latest news
            <p class="pseudo"></p>
          </h2>

          <div class="news-grid">
            <?php
            if (mysqli_num_rows($data['news']) > 0) {
              while ($rows = mysqli_fetch_array($data['news'])) {
            ?>
                <div class="news-item">
                  <img src="/dmc_global/mvc/uploads/<?php echo $rows['image'] ?>" alt="News">
                  <h3><?php echo $rows['title'] ?></h3>
                  <p><?php echo $rows['description'] ?></p>
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
      </section>

  </main>
  <footer>
    <section id="contact">
      <div class="container-footer">
        <div class="footer-content">
          <div class="footer-logo">
            <img src="/dmc_global/public/images/footer.png" class="img-fluid">
          </div>

          <div class="footer-info">
            <h3 class="footer-title">
              office
              <p class="underline-footer"></p>
            </h3>

            <p>337-339 Pham Van Bach Street,<br>Ward 15, Tan Binh District, HCMC</p>
            <h3 class="footer-title">
              support
              <p class="underline-footer"></p>
            </h3>
            <p>info.mblube@gmail.com</p>
            <span><img src="/dmc_global/public/images/footer_ic1.png"></span>
            <span><img src="/dmc_global/public/images/footer_ic2.png"></span>
            <span><img src="/dmc_global/public/images/footer_ic3.png"></span>
            <span><img src="/dmc_global/public/images/footer_ic4.png"></span>
            <span><img src="/dmc_global/public/images/footer_ic5.png"></span>

            <p>Copyright 2024 @ all rights reserve</p>

          </div>
          <div class="footer-links">
            <h3 class="footer-title">
              product
              <p class="underline-footer"></p>
            </h3>
            <ul>
              <li><a href="#">Premium Engine Oil</a></li>
              <li><a href="#">Lubricants</a></li>
              <li><a href="#">Additives</a></li>
            </ul>
          </div>
          <div class="footer-links">
            <h3 class="footer-title">
              quick links
              <p class="underline-footer"></p>
            </h3>
            <ul>
              <li><a href="#">Home</a></li>
              <li><a href="#">Media</a></li>
              <li><a href="#">Contact</a></li>
              <li><a href="#">Compliance</a></li>
            </ul>
          </div>
          <div class="footer-phone">
            <h3 class="footer-title">
              make an appointment
              <p class="underline-footer"></p>
            </h3>

            <p>Lorem, ipsum dolor sit amet consectetur<br> adipisicing elit.</p>
            <div id="phone">
              <ul>
                <li><img src="/dmc_global/public/images/footer_ic6.png" class="img-fluid"></li>
                <li>
                  <h3 class="phone-title">MORE INFORMATION</h3>
                  <p>0903754989</p>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  </footer>


  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <!-- <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.js"></script> -->
  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="/dmc_global/public/js/banner.js"></script>

  <script>
    $(document).ready(function() {
      $('.toogle').click(function() {
        $('nav').slideToggle();
      })
    })
  </script>
</body>

</html>