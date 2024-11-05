<div class="container-fluid">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thông tin sản phẩm</h5>
    </div>
</div>

<div class="card shadow mb-4 mx-4">
    <form action="addProduct" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-group">
                <label for="category">Danh mục</label>
                <select class="form-control " name="category" id="product_category" required>
                    <?php foreach ($data["product_categories"] as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label> Tiêu đề </label>
                <input type="text" name="product_title" id="product_title" class="form-control" required>
            </div>
            <div class="form-group">
                <label> Đường dẫn</label>
                <input type="text" name="product_slug" id ="product_slug" class="form-control" required>
            </div>
            <div class="form-group">
                <label> Mô tả ngắn</label>
                <textarea name="product_description" id="product_description" class="form-control" rows="3"
                     required></textarea>

            </div>
            <div class="form-group">
                <label> Mô tả chi tiết</label>
                <textarea name="product_long_description" class="form-control summernote" rows="3"></textarea>
            </div>
            <h5 class="modal-title" id="exampleModalLabel">SEO</h5>
            <div class="form-group">
                <label>Từ khóa SEO</label>
                <input type="text" name="product_meta_keyword" id="product_meta_keyword" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Mô tả SEO</label>
                <textarea name="product_meta_description" id="product_meta_description" class="form-control" rows="3"></textarea>
            </div>
            

        </div>
        <div class="modal-footer">
            <a href="../Product" class="btn btn-danger">Quay về</a>
            <button type="submit" name="addProductBtn" class="btn btn-primary">Lưu</button>
        </div>
</div>
</form>
</div>

<script type="text/javascript" src="/dmc_global/public/js/admin/slug.js?v=<?= microtime()?>"></script>

<!-- Inline script to initialize the function -->
<script type="text/javascript">
    $(document).ready(function(){
        generateToSlug('product_title', 'product_slug');
        generateToMeta('product_title', 'product_meta_keyword');
        generateToMeta('product_description', 'product_meta_description');
    });
    
</script>