
<div class="container-fluid">
  <!-- Header -->
  <header>
    <!-- Thanh chuyển hướng -->
    <div class="logo">
      <?php
      if (mysqli_num_rows($header["header_icon"]) > 0):
        while ($rows = mysqli_fetch_array($header["header_icon"])):
          $header_icon = $rows['image'];
          $image_path = "/dmc_global/public/images/" . $header_icon;
          if (file_exists($_SERVER['DOCUMENT_ROOT'] . $image_path)):
            ?>
            <div class="logo_ic">
              <img src="<?= $image_path ?>" class="img-fluid" alt="DMC Global">
            </div>
            <?php
          endif;
        endwhile;
      endif;
      ?>
      <div class="toogle">
        <i class="fa-solid fa-bars"></i>
      </div>
      <nav>

        <ul>

          <?php if (!empty($header["menu_items"])): ?>
            <?php foreach ($header["menu_items"] as $row): ?>
              <li><a href="#<?= htmlspecialchars($row['slug']) ?>"><?= htmlspecialchars($row['name']) ?>
            </a>
                <?php if (!empty($row['child_items'])): ?>
                  <i class="fa fa-caret-down"></i>
                  <ul class="dropdown">
                    <?php foreach ($childItems=json_decode($row['child_items'],true) as $childItem): ?>
                      <li><a href="<?= htmlspecialchars($childItem['id']) ?>"><?= htmlspecialchars($childItem['name']) ?></a>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>
              </li>

            <?php endforeach; ?>
          <?php endif; ?>
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