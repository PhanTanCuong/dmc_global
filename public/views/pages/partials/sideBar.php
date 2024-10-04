<link rel="stylesheet" type="text/css" href="/dmc_global/public/css/sidebar.css?v=<?= microtime() ?>">

<!-- Right Section: Sidebar -->
<?php $sideBar = $footerController->fetchFooterData(); ?>

<div class="col-lg-3 col-12 sidebar">
    <div class="sticky-sidebar">
        <?php if (mysqli_num_rows($sideBar["bg_footer"]) > 0): ?>
            <?= $breakLoop=false ?>
            <?php foreach ($sideBar["footer_data"] as  $sidebar_data): ?>    
                <?php if ($breakLoop==true) break; ?>
                <section class="box-item">
                    <div class="box__title">
                        <h5><?= $sidebar_data['title']?></h5>
                    </div>
                    <div class="box__infor">
                        <?php if($sidebar_data['title']==='PRODUCT'):   ?>
                        <ul>
                            <?php foreach(json_decode($sidebar_data['json_data'],true) as $link ):?>
                            <li><a href="<?=$_ENV["BASE_URL"].'/product-categories'.'/' .$link['id']?>"><?=$link['name']?></a></li>
                            <?php endforeach; ?>
                            <?php unset($link)?>
                            <?php $breakLoop=true; ?>
                        </ul>
                        <?php endif;?>
                        <p><?= $sidebar_data['description']?></p>
                    </div>
                </section>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
