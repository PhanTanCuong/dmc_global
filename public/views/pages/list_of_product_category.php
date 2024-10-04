<style>
    .product2 {
        margin-bottom: 0px;
    }

    .grid {
        grid-template-columns: repeat(4, 1fr);
        padding: 4em 2em;

    }

    /* Đặt mặc định */
    .product2 {
        margin-bottom: 0px;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        padding: 4em 2em;
        gap: 2rem;
    }

    .title {
        margin: unset !important;
        padding: 2rem 0;
        font-size: 2rem;
        position: relative;
    }

    .pseudo {
        width: 3rem;
        height: 3px;
        background: #b4171b;
        position: absolute;
        bottom: -1rem;
    }

    /* Media Queries cho iPad */
    @media only screen and (max-width: 1024px) {
        .grid {
            grid-template-columns: repeat(3, 1fr);
            padding: 3em 1em;
        }

        .title {
            font-size: 1.75rem;
            padding: 1.5rem 0;
        }
    }

    /* Media Queries cho Mobile */
    @media only screen and (max-width: 720px) {
        .grid {
            grid-template-columns: repeat(2, 1fr);
            padding: 2em 1em;
            gap: 1.5rem;
        }

        .title {
            font-size: 1.5rem;
            margin: 2.5rem 0;
        }

        .pseudo {
            width: 2rem;
            height: 2px;
            bottom: -1.5rem;
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