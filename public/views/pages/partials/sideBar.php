<link rel="stylesheet" type="text/css" href="/dmc_global/public/css/sidebar.css?v=<?= microtime() ?>">
<style>
    .icons__container {
        display: flex;
        justify-content: space-around;
        align-items: center;
        padding: 0 20px;
    }
    .icons__container img{
        background-color: #b4171b;
        border-radius: 100%;
    }

</style>
<!-- Right Section: Sidebar -->
<?php $sideBar = $headerController->fetchSideBarData(); ?>

<div class="col-lg-3 col-12 sidebar">
    <div class="sticky-sidebar">
        <?php if (mysqli_num_rows($sideBar["sidebar_data"]) > 0): ?>
            <?php foreach ($sideBar["sidebar_data"] as $sidebar_data): ?>
                <section class="box-item">
                    <div class="box__title">
                        <h5><?= $sidebar_data['title'] ?></h5>
                    </div>
                    <div class="box__infor">
                        <?php if ($sidebar_data['json_data'] !== 'null'): ?>
                            <ul>
                                <?php foreach (json_decode($sidebar_data['json_data'], true) as $link): ?>
                                    <li><a
                                            href="<?= $_ENV["BASE_URL"] . '/product-categories' . '/' . $link['id'] ?>"><?= $link['name'] ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <p><?= $sidebar_data['description'] ?></p>
                        <?php if (strpos($sidebar_data['description'], '@')): ?>
                            <div class="icons__container">
                                <?php while ($rows = mysqli_fetch_array($sideBar['icon'])): ?>
                                    <span> <a href="#" style=" text-decoration: none;">
                                            <img src=<?= $imageUrl . '/' . $rows['image'] ?> alt="Image">
                                        </a></span>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>

                    </div>
                </section>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>