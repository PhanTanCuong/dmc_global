<?php foreach ($data["cooperation"] as $cooperation): ?>
    <div class="container-fluid">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><?= $cooperation['title'] ?> information</h5>
        </div>
    </div>
    <div class="card shadow mb-4 mx-4">
        <form action="editCooperation" method="POST" enctype="multipart/form-data">

            <div class="modal-body">
                <div class="form-group">
                    <label> Title </label>
                    <input type="text" name="edit_cooperation_title" id="edit_cooperation_title" class="form-control" placeholder="Enter Title"
                        value="<?= $cooperation['title'] ?>">
                </div>
                <div class="form-group">
                    <label>URL/Domain</label>
                    <input type="text" name="edit_cooperation_slug" id="edit_cooperation_slug" class="form-control" placeholder="Enter Url/Domain"
                        value="<?= $cooperation['slug'] ?>">
                </div>
                <div class="form-group">
                    <label>Long Description</label>
                    <textarea name="edit_cooperation_long_description" class="form-control summernote"
                        rows="5"><?= $cooperation['long_description'] ?></textarea>
                </div>
                <h5 class="modal-title" id="exampleModalLabel">SEO Settings</h5>
                <div class="form-group">
                    <label>Meta Keyword</label>
                    <input type="text" name="edit_cooperation_meta_keyword" id="edit_cooperation_meta_keyword" class="form-control"
                        placeholder="Enter Description" value="<?= $cooperation['meta_keyword'] ?>">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="editCooperationBtn" class="btn btn-primary">Save</button>
            </div>
    </div>
    </form>
    </div>
<?php endforeach; ?>

<script type="text/javascript" src="/dmc_global/public/js/admin/slug.js?v=<?= microtime() ?>"></script>

<!-- Inline script to initialize the function -->
<script type="text/javascript">
    $(document).ready(function () {
        generateToSlug('edit_cooperation_title', 'edit_cooperation_slug');
        generateToMeta('edit_cooperation_title', 'edit_cooperation_meta_keyword');
        generateToMeta('edit_cooperation_description', 'edit_cooperation_meta_description');
    });

</script>