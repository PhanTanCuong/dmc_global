<div class="container-fluid">
    <div class="row justify-content-between">
              <!-- Danh mục -->
              <div class="card shadow mb-4 col-3" style="height:fit-content;">
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
                            <?php foreach ($data["product_categories"] as $item): ?>
                                <tbody>
                                    <tr>
                                        <td><a href="javascript:void(0)" class="item-link"
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
            <!-- Form thông tin sản phẩm  -->
        <div class="card shadow mb-4 col-8">
            <form action="addProduct" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group category_selection">
                        <label for="category">Danh mục cha</label>
                        <select class="form-control " name="category" id="product_category" required>
                            <option value="0">None</option>
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
                        <input type="text" name="product_slug" id="product_slug" class="form-control" required>
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
                        <input type="text" name="product_meta_keyword" id="product_meta_keyword" class="form-control"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Mô tả SEO</label>
                        <textarea name="product_meta_description" id="product_meta_description" class="form-control"
                            rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="../Product" class="btn btn-danger">Quay về</a>
                    <button type="submit" name="addProductBtn" class="btn btn-primary">Lưu</button>
                </div>
        </div>
    </div>
</div>



<script type="text/javascript" src="/dmc_global/public/js/admin/slug.js?v=<?= microtime() ?>"></script>

<!-- Inline script to initialize the function -->
<script type="text/javascript">
    $(document).ready(function () {
        generateToSlug('product_title', 'product_slug');
        generateToMeta('product_title', 'product_meta_keyword');
        generateToMeta('product_description', 'product_meta_description');

         // addRecord
         $(document).on('submit', 'form[action="addProduct"]', function (e) {
                e.preventDefault();
                addRecord(this, function(){
                    // refreshTable('.nav_table','reloadTable');
                    // reloadDiv('#product_category','reloadDiv')
                    $('form[action="addProduct"]')[0].reset(); // reset lại các trường
                    $('.summernote').summernote('code', '<p><br></p>');
                });
            });

            //delete Record
            $('.nav_table').on('click','#delete_btn', function(e){
                e.preventDefault();
                deleteRecord(this,'deletePost',function(){
                    refreshTable('.nav_table','reloadTable');
                    reloadDiv('#product_category','reloadDiv')
                });
            })


            //edit Record
            $(document).on('submit', 'form[action="editPost"]', function (e) {
                e.preventDefault();
                editRecord (this, function(){
                    refreshTable('.nav_table','reloadTable');
                    reloadDiv('#product_category','reloadDiv')
                    $('.category_selection').load('Add'+ ' .category_selection')
                });
            });
           //fetch post 
            $('.nav_table').on('click','.item-link', function (event) {
                event.preventDefault();
                var slug = $(this).data('slug');

                $.ajax({
                    url: 'fetchPage',
                    type: 'POST',
                    data: {
                        slug: slug,
                    },
                    success: function (response) {
                        const data = JSON.parse(JSON.stringify(response));

                        $('#product_id').val(data.id);
                        $('#product_category').val(data.category_id);
                        $('#product_title').val(data.title);
                        $('#product_description').val(data.description);
                        if (typeof data.long_description !== 'undefined') {
                            $('#product_long_description').summernote('code', data.long_description);
                        }else{
                            $('.summernote').summernote('code', '<p><br></p>'); 
                        }
                        $('#product_slug').val(data.slug);
                        $('#product_meta_keyword').val(data.meta_keyword);
                        $('#product_meta_description').val(data.meta_description);
                        $('form[action="addNews"]').attr('action', 'editPost');

                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                        console.log(status);
                        console.log(error);
                    }
                })
            });
    });

</script>