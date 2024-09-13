<div class="container-fluid">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">post information</h5>
    </div>
</div>

<div class="card shadow mb-4 mx-4">
    <form action="addNews" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-group">
                <label> Title </label>
                <input type="text" name="news_title" class="form-control" placeholder="Enter Title" required>
            </div>
            <div class="form-group">
                <label>URL/Domain</label>
                <input type="text" name="news_slug" class="form-control" placeholder="Enter Url/Domain" required>
            </div>
            <div class="form-group">
                <label>Small Description</label>
                <input type="text" name="news_description" class="form-control" placeholder="Enter Small Description"
                    required>
            </div>
            <div class="form-group">
                <label>Long Description</label>
                <textarea name="news_long_description" class="form-control summernote" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label>Image </label>
                <input type="file" name="news_image" id="news_image" class="form-control"
                    placeholder="Enter Meta Description" required>
            </div>
            <h5 class="modal-title" id="exampleModalLabel">SEO Settings</h5>
            <div class="form-group">
                <label>Meta Description</label>
                <textarea name="news_meta_description" id="news_meta_description" class="form-control"
                    rows="3"></textarea>
            </div>
            <div class="form-group">
                <label>Meta Keyword</label>
                <input type="text" name="news_meta_keyword" class="form-control" placeholder="Enter Description"
                    required>
            </div>

        </div>
        <div class="modal-footer">
            <a href="../News" class="btn btn-danger">Back</a>
            <button type="submit" name="addNewsBtn" class="btn btn-primary">Save</button>
        </div>
</div>
</form>
</div>