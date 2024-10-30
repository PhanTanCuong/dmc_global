<link rel="stylesheet" href="/dmc_global/public/css/admin/addPost.css?v=<?= microtime() ?>">
<div class="container-fluid">
    <div class="row justify-content-between">
        <!-- First Card (Add Navbar Item) -->
        <div id="addNavbarForm" class="card shadow mb-4 col-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Danh mục</h6>
            </div>
            <div class="card-body">
                <div class="d-flex mb-2 ">
                    <a href="javascript:void(0);" onclick="redirectTo('public/Admin/News/Add');">
                        <button type="button" name="addNavbarItemBtn" class="btn btn-primary ">Tạo</button>
                    </a>
                </div>
                <div class="table-responsive nav_table">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <?php while ($item = mysqli_fetch_assoc($data['item'])): ?>
                            <tbody>
                                <tr>
                                    <td><a href="javascript:void(0)" onclick="fetchInforBySlug()" class="item-link"
                                            data-slug="<?= $item['slug'] ?>"><?= $item['name'] ?></a>
                                    </td>
                                    <td >
                                        <div class="action_column">
                                            <!-- <div> <input type="hidden" name="edit_id" class="edit_id">
                                                <button href="#" type="button" name="edit_btn" id="edit_btn"
                                                    class="btn btn-warning edit_btn" onClick=""> <i class="fas fa-edit"></i>
                                                    </i></i></button>
                                            </div> -->
                                            <div>
                                                <button  type="button" name="delete_btn" id="delete_btn" data-id="<?=$item['slug']?>"
                                                    class="btn btn-danger delete_btn"> <i
                                                        class="fas fa-trash"></i>
                                                    </i></i></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        <?php endwhile; ?>
                    </table>
                </div>

            </div>
        </div>
        <!-- List of Navbar Items -->
        <div class="card shadow mb-4 col-8">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin bài viết</h6>
            </div>
            <div class="card-body">
                <form action="addNews" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category">Danh mục cha</label>
                            <select class="form-control " name="category" id="news_category">
                                <option value="0">None</option>
                                <?php foreach ($data["category"] as $category): ?>
                                    <option value="<?= $category['id'] ?>">
                                        <?= str_repeat('|---', $category['level']) . $category['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label> Tiêu đề </label>
                            <input type="text" name="news_title" id="news_title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Đường dẫn</label>
                            <input type="text" name="news_slug" id="news_slug" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Mô tả chung</label>
                            <textarea name="news_description" id="news_description" class="form-control" rows="3"
                                required></textarea>

                        </div>
                        <div class="form-group">
                            <label>Mô tả chi tiết</label>
                            <textarea name="news_long_description" id="news_long_description"
                                class="form-control summernote" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <input type="file" name="news_image" id="news_image" class="form-control">
                        </div>
                        <h5 class="modal-title" id="exampleModalLabel">SEO</h5>
                        <div class="form-group">
                            <label>Từ khóa SEO</label>
                            <input type="text" name="news_meta_keyword" id="news_meta_keyword" class="form-control"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Mô tả SEO</label>
                            <textarea id="news_meta_description" name="news_meta_description" class="form-control"
                                rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="addNewsBtn" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script style="text/javascript" src="/dmc_global/public/js/base.js?<?= microtime(); ?>"></script>
<script style="text/javascript" src="/dmc_global/public/js/admin/dragNdrop.js?<?= microtime(); ?>"></script>
<script type="text/javascript" src="/dmc_global/public/js/admin/slug.js?v=<?= microtime() ?>"></script>


<script>
    $(document).ready(function () {
        generateToSlug('news_title', 'news_slug');
        generateToMeta('news_title', 'news_meta_keyword');
        generateToMeta('news_description', 'news_meta_description');

        // addRecord
        $(document).on('submit', 'form[action="addNews"]', function (e) {
            e.preventDefault();
            addRecord(this, 'addNews');
        });

        //delete Record

        $('.nav_table').on('click','#delete_btn', function(e){
            e.preventDefault();
            deleteRecord(this,'deletePost','.nav_table','Admin/News/Add');
        })

    })
</script>