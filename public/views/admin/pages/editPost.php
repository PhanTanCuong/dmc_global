<style>
    #exampleModalLabel {
        color: #4a6fdc;
        text-transform: uppercase;
        font-weight: 600;
    }
</style>
<div class="container-fluid">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tab</h5>
    </div>
</div>

<div class="card shadow mb-4">
    <form action="addNews" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-group">
                <label> Title </label>
                <input type="text" name="edit_news_title" class="form-control" placeholder="Enter Title" required>
            </div>
            <div class="form-group">
                <label>URL/Domain</label>
                <input type="text" name="edit_news_slug" class="form-control" placeholder="Enter Url/Domain" required>
            </div>
            <div class="form-group">
                <label>Small Description</label>
                <input type="text" name="edit_news_description" class="form-control" placeholder="Enter Small Description"
                    required>
            </div>
            <div class="form-group">
                <label>Image </label>
                <input type="file" name="edit_news_image" id="news_image" class="form-control" placeholder="Enter Meta Description" required>
            </div>
            <h5 class="modal-title">SEO Settings</h5>
            <div class="form-group">
                <label>Meta Description</label>
                <textarea name="edit_news_meta_description" id="news_meta_description" class="formcontrol"
                    rows="3"></textarea>
            </div>
            <div class="form-group">
                <label>Meta Keyword</label>
                <input type="text" name="edit_news_meta_keyword" class="form-control" placeholder="Enter Description"
                    required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="NewsBtn" class="btn btn-primary">Save</button>
        </div>
</div>
</form>
</div>