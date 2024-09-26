<div class="breadcrumb_section bg-main-color page-title-mini">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5">
                <?php foreach ($data["breadcrumb_data"] as $column): ?>
                    <div class="page-title">
                        <h2 class="text-white"><?= $column['name'] ?></h2>
                    </div>
                <?php endforeach; ?>
                <?php unset($column); ?>
            </div>
            <div class="col-md-7">
                <ol class="breadcrumb justify-content-md-start"></ol>
            </div>
        </div>
    </div>
</div>