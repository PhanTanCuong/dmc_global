<div class="container-fluid">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?=$data['name']?> information</h5>
    </div>
</div>

<div class="card shadow mb-4 mx-4">
    <form action="editNews" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
            <?php $display= $data["display"]?>
            <?php foreach ($data["news"] as $row): ?>
                <input type="hidden" name="edit_news_id" value="<?= $row['id'] ?>">
                <div class="form-group" style="display:<?=$display?>">
                    <label for="category">Category</label>
                    <select id="edit_news_category" name="category" class="form-control">
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
                    <input type="text" name="edit_news_title" class="form-control" placeholder="Enter Title"
                        value="<?= $row['title'] ?>">
                </div>
                <div class="form-group">
                    <label>URL/Domain</label>
                    <input type="text" name="edit_news_slug" class="form-control" placeholder="Enter Url/Domain"
                        value="<?= $row['slug'] ?>">
                </div>
                <div class="form-group">
                    <label>Small Description</label>
                    <textarea type="text" name="edit_news_description" class="form-control"
                        placeholder="Enter Small Description"><?= $row['description'] ?></textarea>
                </div>
                <div class="form-group">
                    <label>Long Description</label>
                    <textarea name="edit_news_long_description" class="form-control summernote"
                        rows="3"><?= $row['long_description'] ?></textarea>
                </div>
                <div class="form-group" style="display:<?=$display?>">
                    <label>Current Image</label><br>
                    <img class="icon_logo" src="/dmc_global/public/images/<?= $row['image']; ?>" alt="Image"><br>
                    <span>Current file: <?= $row['image']; ?></span>
                </div>
                <div class="form-group" style="display:<?=$display?>">
                    <label>Image </label>
                    <input type="file" name="news_image" id="news_image" class="form-control"
                        placeholder="Enter Meta Description">
                </div>
                <h5 class="modal-title" id="exampleModalLabel">SEO Settings</h5>
                <div class="form-group">
                    <label>Meta Keyword</label>
                    <input type="text" name="edit_news_meta_keyword" class="form-control" placeholder="Enter Description"
                        value="<?= $row["meta_keyword"] ?>">
                </div>
                <div class="form-group">
                    <label>Meta Description</label>
                    <textarea name="edit_news_meta_description" id="news_meta_description" class="form-control"
                        rows="3"><?= $row['meta_description'] ?></textarea>
                </div>
            <?php endforeach; ?>

        </div>
        <div class="modal-footer">
            <a href="../News" class="btn btn-danger">Back</a>
            <button type="submit" name="news_updatebtn" class="btn btn-primary">Save</button>
        </div>
</div>
</form>
</div>