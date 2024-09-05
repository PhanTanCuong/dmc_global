
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
                        <li><a href="../Product/<?php echo $child['id'] ?>"><?php echo $child['name'] ?></a></li>
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