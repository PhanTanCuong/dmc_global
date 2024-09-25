<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <?php
    if (mysqli_num_rows($header["head"]) > 0) {
        while ($row = mysqli_fetch_assoc($header["head"])) {
    ?>
            <title><?= $row['title'] ?></title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <!-- Favicon -->
            <link rel="icon" href="/dmc_global/public/images/<?= $row['image'] ?>" type="image/x-icon">
    <?php
        }
    }
    ?>
    <!-- .css file -->
    <link rel="stylesheet" type="text/css" href="/dmc_global/public/css/header.css?v=<?= microtime() ?>">
    <link rel="stylesheet" type="text/css" href="/dmc_global/public/css/about.css?v=<?= microtime() ?>">
    <link rel="stylesheet" type="text/css" href="/dmc_global/public/css/product.css?v=<?= microtime() ?>">
    <link rel="stylesheet" type="text/css" href="/dmc_global/public/css/media.css?v=<?= microtime() ?>">
    <link rel="stylesheet" type="text/css" href="/dmc_global/public/css/footer.css?v=<?= microtime() ?>">

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
</style>
</head>

<body>
