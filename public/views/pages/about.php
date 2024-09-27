<?php if(mysqli_num_rows($data['about'])>0):?>
    <?php while($row=mysqli_fetch_assoc($data['about'])):?>
<section class="about">
    <div class="mb-5"><img src="<?= $_ENV['PICTURE_URL'] . '/' ?>" alt="background picture"></div>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="title  wow slideInLeft"> <?=$row['title']?>
                <p class="pseudo"></p>
            </h1>
            <div class="shadow bg-white p-4"><p><?=$row['description']?></p></div>
        </div>
    </div>
</section>
<?php endwhile;?>
<?php endif?>