<style>
    .product2{
        margin-bottom: 0px;
    }
    .grid {
        grid-template-columns: repeat(4, 1fr);
        padding: 4em 2em;
        
    }
    .title{
        margin:unset !important;
        padding :2rem 0;
    }
    @media only screen and (max-width: 720px) {
        .pseudo {
            width: 1.5rem;
            height: 3px;
            bottom: -2rem;
        }

        .title {
            font-size: 1.5rem;
            margin:2.5rem 0;
        }

        .grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
<?php include('partials/breadcrumb.php') ?>

<?php $count = count($data['product_category']); ?>
<?php for ($i = 0; $i < $count; $i++): ?>
    <section class="product-category">
        <h1 class="title  wow slideInLeft"><?= $data['product_category'][$i]['name'] ?>
            <p class="pseudo"></p>
        </h1>
        <?php $items = [] ?>
        <?php $columnCount = count($data['product_category'][$i]['items']); ?>
        <section class='product2' id="product2">
            <div class="container">
                <div class="grid">
                    <?php for ($j = 0; $j < $columnCount; $j++): ?>
                        <?php $items = $data['product_category'][$i]['items'][$j]; ?>
                        <?php include('partials/Subcategory.php'); ?>
                    <?php endfor ?>
                </div>
            </div>
            </div>
        </section>
    </section>

<?php endfor; ?>