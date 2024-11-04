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
                        <a href="javascript:void(0);" onclick="location.reload(true)">
                            <button type="button" name="addNavbarItemBtn" class="btn btn-primary ">Tạo</button>
                        </a>
                    </div>
                    <div class="table-responsive nav_table">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <?php foreach ($data['item'] as $item): ?>
                                <tbody>
                                    <tr>
                                        <td><a href="javascript:void(0)" onclick="fetchInforBySlug()" class="item-link"
                                                data-slug="<?= $item['slug'] ?>"><?= $item['name'] ?></a>
                                        </td>
                                        <td >
                                            <div class="action_column">
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
                            <?php endforeach; ?>
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
                                <input type="hidden" name="news_id" id="news_id" class="form-control" required>
                            </div>
                            <div class="form-group category_selection">
                                <label for="category">Danh mục cha</label>
                                <select class="form-control " name="category" id="news_category">
                                    <option value="0">None</option>
                                    <?php foreach ($data[ "category"] as $category): ?>
                                        <option value="<?= $category['id'] ?>">
                                            <?= $category['name'] ?>
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
                addRecord(this, function(){
                    console.log('1');
                    // refreshTable('.nav_table','Add');

                    $('.nav_table').load('Add'+ ' .nav_table')
                    
                    console.log('2');
                    $('.category_selection').load('Add'+ ' .category_selection')
                    console.log('3');
                    $('form[action="addNews"]')[0].reset(); // reset lại các trường
                    $('.summernote').summernote('code', '<p><br></p>');
                });
            });

            //delete Record

            $('.nav_table').on('click','#delete_btn', function(e){
                e.preventDefault();
                deleteRecord(this,'deletePost',function(){
                    console.log('1');
                    // refreshTable('.table-bordered','Add');
                    $('.nav_table').load('Add'+ " .nav_table")
                    
                    console.log('2');
                    $('.category_selection').load('Add'+ ' .category_selection')
                    console.log('3');
                });
            })


            //edit Record

            $(document).on('submit', 'form[action="editNews"]', function (e) {
                e.preventDefault();
                editRecord (this, function(){
                    console.log('1');
                    // refreshTable('.nav_table','Add');

                    $('.nav_table').load('Add'+ ' .nav_table')
                    $('.category_selection').load('Add'+ ' .category_selection')
                });
            });
           //fetch post 
            $('.item-link').on('click', function (event) {
                event.preventDefault();

                var slug = $(this).data('slug');
                // console.log(slug);

                $.ajax({
                    url: 'fetchPage',
                    type: 'POST',
                    data: {
                        slug: slug,
                    },
                    success: function (response) {
                        // console.log("Response from server: ", response);

                        const data = JSON.parse(JSON.stringify(response));

                        $('#news_id').val(data.id);
                        $('#news_category').val(data.category_id);
                        $('#news_title').val(data.title);
                        $('#news_description').val(data.description);
                        if (typeof data.long_description !== 'undefined') {
                            $('#news_long_description').summernote('code', data.long_description);
                        }else{
                            $('.summernote').summernote('code', '<p><br></p>'); 
                        }
                        $('#news_slug').val(data.slug);
                        $('#news_meta_keyword').val(data.meta_keyword);
                        $('#news_meta_description').val(data.meta_description);
                        $('form[action="addNews"]').attr('action', 'editNews');

                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                        console.log(status);
                        console.log(error);
                    }
                })
            });
        })
    </script>