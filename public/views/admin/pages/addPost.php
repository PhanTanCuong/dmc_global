<div class="container-fluid">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?= $data['name'] ?> information</h5>
    </div>
</div>
<div class="card shadow mb-4 mx-4">
    <form action="addNews" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-group" style="display:<?= (int)$_COOKIE['parent_id'] === 44 ? "none" : "block" ?>">
                <label for="category">Category</label>
                <select class="form-control " name="category" id="news_category">
                    <?php foreach ($data["product_categories"] as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label> Title </label>
                <input type="text" name="news_title" id="news_title" class="form-control" placeholder="Enter Title"
                    required>
            </div>
            <div class="form-group">
                <label>URL/Domain</label>
                <input type="text" name="news_slug" id="news_slug" class="form-control" placeholder="Enter Url/Domain"
                    required>
            </div>
            <div class="form-group">
                <label>Small Description</label>
                <textarea name="news_description" id="news_description" class="form-control"
                    placeholder="Enter Small Description" rows="3" required></textarea>

            </div>
            <div class="form-group">
                <label>Long Description</label>
                <textarea name="news_long_description" class="form-control summernote" rows="3"></textarea>
            </div>
            <div class="form-group" style="display:<?= $data['display'] ?>">
                <label>Image </label>
                <input type="file" name="news_image" id="news_image" class="form-control"
                    placeholder="Enter Meta Description">
            </div>
            <h5 class="modal-title" id="exampleModalLabel">SEO Settings</h5>
            <div class="form-group">
                <label>Meta Keyword</label>
                <input type="text" name="news_meta_keyword" id="news_meta_keyword" class="form-control"
                    placeholder="Enter Description" required>
            </div>
            <div class="form-group">
                <label>Meta Description</label>
                <textarea name="news_meta_description" id="news_meta_description" class="form-control"
                    rows="3"></textarea>
            </div>


        </div>
        <div class="modal-footer">
            <a href="../News" class="btn btn-danger">Back</a>
            <button type="submit" name="addNewsBtn" class="btn btn-primary">Save</button>
        </div>
</div>
</form>
</div>

<script type="text/javascript" src="/dmc_global/public/js/admin/slug.js?v=<?= microtime() ?>"></script>

<!-- Inline script to initialize the function -->
<script type="text/javascript">
    $(document).ready(function () {
        generateToSlug('news_title', 'news_slug');
        generateToMeta('news_title', 'news_meta_keyword');
        generateToMeta('news_description', 'news_meta_description');
    });

</script>