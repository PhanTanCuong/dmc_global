<div class="container-fluid">
  <!-- Header -->
  <header>
    <!-- Thanh chuyển hướng -->
    <div class="logo">
      <?php if (mysqli_num_rows($header["header_icon"]) > 0): ?>
        <?php while ($rows = mysqli_fetch_array($header["header_icon"])): ?>
          <?php $header_icon = $rows['image'];
          $image_path = $imageUrl . '/' . $header_icon;
          if (file_exists($_SERVER['DOCUMENT_ROOT'] . $image_path)): ?>
            <div class="logo_ic">
              <img src="<?= $image_path ?>" class="img-fluid" alt="DMC Global">
            </div>
          <?php endif; ?>
        <?php endwhile; ?>
      <?php endif; ?>
      <div class="toogle">
        <i class="fa-solid fa-bars"></i>
      </div>
      <nav>

        <ul>

          <?php if (!empty($header["menu_items"])): ?>
            <?php foreach ($header["menu_items"] as $row): ?>
              <li>
                <?php if ($row['status'] === 'active') {
                  $url = $_ENV["BASE_URL"] . '/' . htmlspecialchars($row['slug']);
                } else {
                  $url = '#';
                } ?>
                <a href="<?= $url ?>"><?= htmlspecialchars($row['name']) ?>
                </a>
                <?php if (!empty($row['child_items'])): ?>
                  <i class="fa fa-caret-down"></i>
                  <ul class="dropdown">
                    <?php foreach ($childItems = json_decode($row['child_items'], true) as $childItem): ?>
                      <li><a
                          href="<?= $_ENV["BASE_URL"] . '/' . htmlspecialchars($row['slug']) . '/' . ($childItem['id']) ?>"><?= htmlspecialchars($childItem['name']) ?></a>
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