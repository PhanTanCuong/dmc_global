<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <?php
  if (mysqli_num_rows($data["head"]) > 0) {
    while ($row = mysqli_fetch_assoc($data["head"])) {
  ?>
      <title><?php echo $row['title'] ?></title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Favicon -->
      <link rel="icon" href="/dmc_global/public/images/<?php echo $row['image'] ?>" type="image/x-icon">
  <?php
    }
  }
  ?>
  <!-- .css file -->
  <link rel="stylesheet" type="text/css" href="/dmc_global/public/css/header.css?v=<?php echo microtime() ?>">
  <link rel="stylesheet" type="text/css" href="/dmc_global/public/css/about.css?v=<?php echo microtime() ?>">
  <link rel="stylesheet" type="text/css" href="/dmc_global/public/css/product.css?v=<?php echo microtime() ?>">
  <link rel="stylesheet" type="text/css" href="/dmc_global/public/css/media.css?v=<?php echo microtime() ?>">
  <link rel="stylesheet" type="text/css" href="/dmc_global/public/css/footer.css?v=<?php echo microtime() ?>">

  <!-- lib -->
  <!-- WoW -->
  <link rel="stylesheet" type="text/css" href="/dmc_global/public/lib/WOW-master/css/animate.css" />
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
    .item.slick-slide img {
      width: 100%;
      height: auto;
    }

    .flipInYRepeat {
      animation: flipInYRepeat 1s ease-in-out 3;
      /* Lặp lại 3 lần */
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <!-- Header -->
    <header>
      <!-- Thanh chuyển hướng -->
      <div class="logo">
        <?php
        if (mysqli_num_rows($data["header_icon"]) > 0) {
          while ($rows = mysqli_fetch_array($data["header_icon"])) {
            $header_icon = $rows['image'];
            $image_path = "/dmc_global/public/images/" . $header_icon;
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . $image_path)) {
        ?>
              <div class="logo_ic">
                <img src="<?php echo $image_path ?>" class="img-fluid" alt="DMC Global">
              </div>
        <?php
            }
          }
        }
        ?>
        <div class="toogle">
          <i class="fa-solid fa-bars"></i>
        </div>
        <nav>

          <ul>
            <?php
            if (mysqli_num_rows($data["menu_items"]) > 0) {
              while ($row = mysqli_fetch_assoc($data["menu_items"])) {
                $id_dropdown = $row['id'];
            ?>
                <li><a href="#<?php echo $row['name'] ?>"><?php echo $row['name'] ?>
                    <?php if (in_array($id_dropdown, explode(',', $data["checkDropdownMenu"]))) { ?>
                      <i class="fa fa-caret-down"></i></a>
                  <ul class="dropdown">
                    <?php
                      // Fetch child_navbar items based on navbar_id
                      $childItems = $data['getChildNavbarbyId']($id_dropdown);
                      if (mysqli_num_rows($childItems) > 0) {
                        while ($child = mysqli_fetch_assoc($childItems)) {
                    ?>
                        <li><a href="#<?php echo $child['name'] ?>"><?php echo $child['name'] ?></a></li>
                    <?php
                        }
                      }
                    ?>

                  </ul>

                <?php
                    }
                ?>
                </a>
                </li>

            <?php
              }
            }
            ?>
            <li></button>
              <form action="" class="search-box">
                <input type="text" class="search-text" placeholder="Search..." required>
                <!-- required là thuộc tính bắt user nhập thông tin khi submit  -->
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
  if (mysqli_num_rows($data["bg_footer"]) > 0) {
    while ($rows = mysqli_fetch_array($data["bg_footer"])) {
      $footer_bg = $rows['image'];
      $image_footer_path = "/dmc_global/public/images/" . $footer_bg;
      if (file_exists($_SERVER['DOCUMENT_ROOT'] . $image_footer_path)) {
  ?>
        <footer style="background:url(<?php echo $image_footer_path ?>)no-repeat center/cover;">
          <div class="container-footer">
            <div class="footer-content">
              <div class="footer-logo">
                <?php
                if (mysqli_num_rows($data["footer_icon"]) > 0) {
                  while ($rows = mysqli_fetch_array($data["footer_icon"])) {
                    $footer_icon = $rows['image'];
                    $path = "/dmc_global/public/images/" . $footer_icon;
                    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $path)) {
                ?>
                      <img src="<?php echo $path ?>" class="img-fluid">
                <?php
                    }
                  }
                }
                ?>
              </div>
              <div class="footer-info">
                <?php
                $titles = [];
                $descriptions = [];

                // Fetch all rows from the result
                while ($row = mysqli_fetch_array($data['footer_data'])) {
                  $titles[] = $row['title'];
                  $descriptions[] = $row['description'];
                }

                ?>
                <h3 class="footer-title">
                  <?php echo $titles[0] ?>
                  <p class="underline-footer"></p>
                </h3>

                <p><?php echo $descriptions[0] ?></p>
                <h3 class="footer-title">
                  <?php echo $titles[1] ?>
                  <p class="underline-footer"></p>
                </h3>
                <p><?php echo $descriptions[1] ?></p>
                <?php
                if (mysqli_num_rows($data['icons']) > 0) {
                  while ($rows = mysqli_fetch_array($data['icons'])) {
                ?>
                    <span><img src="/dmc_global/public/images/<?php echo $rows['image'] ?>"></span>
                <?php
                  }
                }
                ?>
                <p><?php echo $descriptions[6] ?></p>

              </div>
              <div class="footer-links">
                <h3 class="footer-title">
                  <?php echo $titles[2] ?>
                  <p class="underline-footer"></p>
                </h3>
                <?php
                if (mysqli_num_rows($data['productCategory']) > 0) {
                  while ($rows = mysqli_fetch_array($data['productCategory'])) {
                ?>
                    <ul>
                      <li><a href="#"><?php echo $rows['type'] ?></a></li>
                    </ul>
                <?php
                  }
                }
                ?>
              </div>
              <div class="footer-links">
                <h3 class="footer-title">
                  <?php echo $titles[3] ?>
                  <p class="underline-footer"></p>
                </h3>
                <ul>
                  <?php
                  if (mysqli_num_rows($data['navbar_footer']) > 0) {
                    while ($rows = mysqli_fetch_array($data['navbar_footer'])) {
                  ?>
                      <li><a href="#"> <?php echo $rows['name'] ?></a></li>
                  <?php
                    }
                  }
                  ?>
                </ul>

              </div>
              <div class="footer-phone">
                <h3 class="footer-title">
                  <?php echo $titles[5] ?>
                  <p class="underline-footer"></p>
                </h3>

                <p><?php echo $descriptions[5] ?></p>
                <div id="phone">
                  <ul>
                    <?php
                    if (mysqli_num_rows($data['phone_icon']) > 0) {
                      while ($rows = mysqli_fetch_array($data['phone_icon'])) {
                    ?>
                        <li><img src="/dmc_global/public/images/<?php echo $rows['image'] ?>" class="img-fluid"></li>
                    <?php
                      }
                    }
                    ?>
                    <li>
                      <h3 class="phone-title"><?php echo $titles[4] ?></h3>
                      <p><?php echo $descriptions[4] ?></p>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          </section>
        </footer>
  <?php
      }
    }
  }

  ?>


  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <!-- <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.js"></script> -->
  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="/dmc_global/public/js/banner.js"></script>
  <script src="https://unpkg.com/scrollreveal"></script>
  <script src="/dmc_global/public/lib/WOW-master/js/wow.js"></script>
  <script>
    $(document).ready(function() {
      document.addEventListener('DOMContentLoaded', function() {
        let lazyImages = [].slice.call(document.querySelectorAll('img.lazy'));

        if ('IntersectionObserver' in window) {
          let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
              if (entry.isIntersecting) {
                let lazyImage = entry.target;
                lazyImage.src = lazyImage.dataset.src;
                lazyImage.classList.remove('lazy');
                lazyImageObserver.unobserve(lazyImage);
              }
            });
          });

          lazyImages.forEach(function(lazyImage) {
            lazyImageObserver.observe(lazyImage);
          });
        }
      });

      new WOW().init();
    })
  </script>
  <!-- <script>
    $(document).ready(function() {
      ScrollReveal().reveal('.logo');
      ScrollReveal().reveal('.grid-container', {
        delay: 500
      });
      ScrollReveal().reveal('.comp', {
        delay: 200
      });
      ScrollReveal().reveal('.news-item ', {
        delay: 200
      });

    })
  </script> -->

  <script>
    $(document).ready(function() {
      $('.toogle').click(function() {
        $('nav').slideToggle();
      })
    })
  </script>
</body>

</html>