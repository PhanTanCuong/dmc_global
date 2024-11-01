<style>
    #myTable>tbody>tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>
<div class="container-fluid">
    <div class="row justify-content-between">
        <div id="addCategoryForm" class="card shadow mb-4 col-4 mr-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin sản phẩm</h6>
            </div>
            <div class="card-body">
                <form action="addCategory" method="POST">
                    <div class="form-group">
                        <label for="category_name">Tên danh mục</label>
                        <input type="text" class="form-control" id="category_name" name="category_name" required>
                    </div>
                    <div class="form-group">
                        <label for="category_slug">Đường dẫn</label>
                        <input type="text" class="form-control" id="category_slug" name="category_slug">
                    </div>
                    <div class="form-group">
                        <label for="category_parent">Danh mục cha</label>
                        <select name="category_parent" id="category_parent" class="form-control">
                            <option value="0">Trống</option>
                            <?php if (mysqli_num_rows($data["slug_parent"]) > 0): ?>
                                <?php while ($options = mysqli_fetch_array($data["slug_parent"])): ?>
                                    <option value="<?= $options['id'] ?>">
                                        <?= str_repeat('|---', $options['level']) . $options['name'] ?>
                                    </option>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category_type">Loại</label>
                        <select class="form-control" id="category_type" name="category_type" required>
                            <option value="category">Danh mục</option>
                            <option value="post">Bài viết</option>
                            <option value="product">Sản phẩm</option>
                        </select>
                    </div>
                    <button type="submit" name="addCategoryBtn" class="btn btn-primary">Lưu</button>
                </form>
            </div>
        </div>
        <div id="editCategoryForm" class="card shadow mb-4 col-4 mr-3 " style="display:none;">
            <div class="edit-navbar card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin danh mục</h6>
            </div>

            <div class="card-body">
                <form action="customizeCategory" method="POST">
                    <input type="hidden" id="edit_category_id" name="edit_category_id" value="">
                    <div class="form-group">
                        <label for="edit_category_name">Tên danh mục</label>
                        <input type="text" class="form-control" id="edit_category_name" name="edit_category_name"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="category_slug">Đường dẫn</label>
                        <input type="text" class="form-control" id="edit_category_slug" name="edit_category_slug">
                    </div>
                    <div class="form-group">
                        <label for="category_parent">Parent</label>
                        <select name="edit_category_parent" id="edit_category_parent" class="form-control">
                            <option value="0">None</option>
                                <?php foreach($data["edit_slug_parent"] as $options ): ?>
                                    <option value="<?= $options['id'] ?>">
                                        <?= str_repeat('|---', $options['level']) . $options['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_category_type">Loại</label>
                        <select class="form-control" id="edit_category_type" name="edit_category_type" required>
                        <option value="category">Danh mục</option>
                            <option value="post">Bài viết</option>
                            <option value="product">Sản phẩm</option>   
                        </select>
                    </div>
                    <button type="submit" name="category_updatebtn" class="btn btn-primary">Cập nhật</button>
                    <button type="button" id="cancelEdit" class="btn btn-danger">Quay về</button>
                </form>
            </div>
        </div>
        <div class="card shadow mb-4 col-7 ml-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Danh sách danh mục</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên danh mục</th>
                                <th>Đường dẫn</th>
                                <th>Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?= $counter = 1; ?>
                            <?php foreach ($data["item"] as $row): ?>
                                <tr>
                                    <td><?= $counter++; ?></td>
                                    <td><?= str_repeat('|---', $row['level']-1) . $row['name'] ?></td>
                                    <td><?= $row['slug'] ?></td>
                                    <td>
                                        <div class="action_column">
                                            <form action="getCategoryById" method="POST">
                                                <input type="hidden" name="edit_id" class="edit_id"
                                                    value="<?= $row['id']; ?>">
                                                <button href="#" type="button" name="edit_btn"
                                                    class="btn btn-warning edit_btn" data-toggle="modal"
                                                    data-target="#editCategory"> <i class="fas fa-edit"></i>
                                                    </i></i></button>
                                            </form>
                                            <form action="deleteCategory" method="POST">
                                                <input type="hidden" name="delete_category_id" value="<?= $row['id']; ?>">
                                                <button type="submit" name="delete_category_btn" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript" src="/dmc_global/public/js/admin/slug.js"></script>
<script>
    $(document).ready(function () {
        $('.edit_btn').click(function (e) {
            e.preventDefault();

            var category_id = $(this).closest('tr').find('.edit_id').val();

            // console.log(category_id);

            $.ajax({
                type: "POST",
                url: 'Category/getCategoryById/' + category_id,
                data: {
                    'checking_edit_btn': true,
                    'category_id': category_id,
                },
                dataType: 'json',
                success: function (response) {
                    if (response) {
                        $('#edit_category_id').val(response.id);
                        $('#edit_category_name').val(response.name)
                        $('#edit_category_slug').val(response.slug)
                        $('#edit_category_parent').val(response.parent_id)
                        $('#edit_category_type').val(response.type)

                        $('#addCategoryForm').hide();
                        $('#editCategoryForm').show();
                    } else {
                        console.log('Error fetching data.');
                    }
                },
                error: function () {
                    console.log('An error occurred.');
                }
            });
        });
        $('#cancelEdit').click(function () {
            // Hide the edit form and show the add form
            $('#editCategoryForm').hide();
            $('#addCategoryForm').show();
        });

        generateToSlug('category_name', 'category_slug');
    });
</script>