<div class="container-fluid">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">post information</h5>
    </div>
</div>

<div class="card shadow mb-4 mx-4">
    <form action="editNews" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
            <?php foreach ($data["news"] as $row): ?>
                <input type="hidden" name="edit_product_id" value="<?= $row['id'] ?>">
                <div class="form-group">
                    <label for="category">Category</label>
                    <select id="edit_product_category" name="category" class="form-control">
                        <?php foreach($data["product_categories"] as $category):?>
                        <option value="<?= $category['id']?>"
                            <?=($category['id']==$row['category_id'])?'selected':''?>>
                            <?=$category['name']?>
                        </option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    <label> Title </label>
                    <input type="text" name="edit_product_title" class="form-control" placeholder="Enter Title"
                        value="<?= $row['title'] ?>">
                </div>
                <div class="form-group">
                    <label>URL/Domain</label>
                    <input type="text" name="edit_product_slug" class="form-control" placeholder="Enter Url/Domain"
                        value="<?= $row['slug'] ?>">
                </div>
                <div class="form-group">
                    <label>Small Description</label>
                    <textarea type="text" name="edit_product_description" class="form-control"
                        placeholder="Enter Small Description"><?= $row['description'] ?></textarea>
                </div>
                <div class="form-group">
                    <label>Long Description</label>
                    <textarea name="edit_product_long_description" class="form-control summernote"
                        rows="3"><?= $row['long_description'] ?></textarea>
                </div>
                <div class="form-group">
                    <label>Current Image</label><br>
                    <img class="icon_logo" src="/dmc_global/public/images/<?= $row['image']; ?>" alt="Image"><br>
                    <span>Current file: <?= $row['image']; ?></span>
                </div>
                <div class="form-group">
                    <label>Image </label>
                    <input type="file" name="product_image" id="product_image" class="form-control"
                        placeholder="Enter Meta Description">
                </div>
                <h5 class="modal-title" id="exampleModalLabel">SEO Settings</h5>
                <div class="form-group">
                    <label>Meta Keyword</label>
                    <input type="text" name="edit_product_meta_keyword" class="form-control" placeholder="Enter Description"
                        value="<?= $row["meta_keyword"] ?>">
                </div>
                <div class="form-group">
                    <label>Meta Description</label>
                    <textarea name="edit_product_meta_description" id="product_meta_description" class="form-control"
                        rows="3"><?= $row['meta_description'] ?></textarea>
                </div>
            <?php endforeach; ?>

        </div>
        <div class="modal-footer">
            <a href="../Product" class="btn btn-danger">Back</a>
            <button type="submit" name="product_updatebtn" class="btn btn-primary">Save</button>
        </div>
</div>
</form>
</div>