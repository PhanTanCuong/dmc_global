<style>
    
    .box-item {
        border: 1px solid #ddd;
        margin-bottom: 20px;
    }

    .box-item :is(h5, a, p) {
        letter-spacing: .3px;
    }

    .box__title h5 {
        background-color: #b4171b;
        color: #fff;
        text-align: center;
        padding: 10px 20px;
        text-transform: uppercase;
        font-weight: 700;
    }

    .box__infor {
        padding: 10px 20px;
    }

    .sticky-sidebar {
        position: -webkit-sticky;
        position: sticky;
        top: 10px;
    }

    .box-item ul {
        list-style: none;
        padding: 0;
    }

    .box-item li {
        margin-bottom: 10px;
    }

    .box-item a {
        color: unset;
        text-decoration: none;
    }

    .social-icons {
        display: flex;
        gap: 10px;
    }
</style>
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
                            <li><a href="<?=$_ENV["PRODUCT_URL"].'/'.$link['id']?>"><?=$link['name']?></a></li>
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
