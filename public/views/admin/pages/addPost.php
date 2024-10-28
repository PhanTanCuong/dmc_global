<link rel="stylesheet" href="/dmc_global/public/css/admin/addPost.css?v=<?= microtime() ?>">
<div class="container-fluid">
    <div class="d-flex flex-wrap justify-content-between">
        <!-- First Card (Add Navbar Item) -->
        <div id="addNavbarForm" class="card shadow mb-4 flex-5 mr-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Danh mục</h6>
            </div>
            <div class="card-body">
                <label for="navbar_name">Tên danh mục</label>
                <div class="d-flex mb-2 ">
                    <button type="button" name="addNavbarItemBtn" class="btn btn-primary ">Tạo</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <?php while ($item = mysqli_fetch_assoc($data['item'])): ?>
                            <tbody>
                                <tr>
                                    <td><a href="" class="item-link"
                                            data-slug="<?= $item['slug'] ?>"><?= $item['name'] ?></a>
                                    </td>
                                    <td>
                                        <div class="action_column">
                                            <div> <input type="hidden" name="edit_id" class="edit_id">
                                                <button href="#" type="button" name="edit_btn" id="edit_btn"
                                                    class="btn btn-warning edit_btn" onClick=""> <i class="fas fa-edit"></i>
                                                    </i></i></button>
                                            </div>
                                            <div>
                                                <input type="hidden" name="edit_id" class="edit_id">
                                                <button href="#" type="button" name="edit_btn" id="edit_btn"
                                                    class="btn btn-danger delete_btn" onClick="deleteRecord(this)"> <i class="fas fa-trash"></i>
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
        <div class="card shadow mb-4 flex-fill ml-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin bài viết</h6>
            </div>
            <div class="card-body">
                <form action="addNews" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category">Danh mục cha</label>
                            <select class="form-control " name="category" id="news_category">
                                <?php foreach ($data["category"] as $category): ?>
                                    <option value="<?= $category['id'] ?>"><?= str_repeat('|---',$category['level']).$category['name'] ?></option>
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
                            <label>Mô tả chi tiết</label>
                            <textarea name="news_long_description" id="news_long_description"
                                class="form-control summernote" rows="3"></textarea>
                        </div>
                        <h5 class="modal-title" id="exampleModalLabel">SEO</h5>
                        <div class="form-group">
                            <label>Từ khóa SEO</label>
                            <input type="text" name="news_meta_keyword" id="news_meta_keyword" class="form-control"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Mô tả SEO</label>
                            <textarea id="news_meta_description" class="form-control" rows="3"></textarea>
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
<!-- <script style="text/javascript" src="/dmc_global/public/js/admin/NavbarItems.js?<?= microtime(); ?>"></script> -->
<script style="text/javascript" src="/dmc_global/public/js/admin/dragNdrop.js?<?= microtime(); ?>"></script>


<script>
    $(document).ready(function () {
        // Hàm hiển thị danh mục
        function displayCategories() {
            const categoryList = document.getElementById('categoryList');
            categoryList.innerHTML = ''; // Xóa nội dung cũ

            categories.forEach((category, index) => {
                const categoryDiv = document.createElement('div');
                categoryDiv.classList.add('category-item');
                categoryDiv.innerHTML = `
            <span>${category.name}</span>
            <div class="actions">
                <button onclick="editCategory(${index})">Edit</button>
                <button onclick="deleteCategory(${index})">Delete</button>
            </div>
        `;
                categoryList.appendChild(categoryDiv);
            });
        }

        // Hàm tạo danh mục mới
        function createCategory() {
            const categoryName = prompt('Enter the new category name:');
            if (categoryName) {
                categories.push({ id: categories.length + 1, name: categoryName });
                displayCategories();
            }
        }

        // Hàm sửa danh mục
        function editCategory(index) {
            const newCategoryName = prompt('Enter the new name for this category:', categories[index].name);
            if (newCategoryName) {
                categories[index].name = newCategoryName;
                displayCategories();
            }
        }

        // Hàm xóa danh mục
        function deleteCategory(index) {
            if (confirm('Are you sure you want to delete this category?')) {
                categories.splice(index, 1);
                displayCategories();
            }
        }

        // Hàm xem danh mục
        function viewCategory(index) {
            // Chuyển hướng đến một trang trống với thông tin danh mục
            window.location.href = `category_page.php?category=${categories[index].name}`;
        }


        //Fetch dữ liệu bào viết
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

                    $('#news_category').val(data.category_id);
                    $('#news_title').val(data.title);
                    $('#news_long_description').summernote('code', data.long_description);
                    $('#news_slug').val(data.slug);
                    $('#news_meta_keyword').val(data.meta_keyword);
                    $('#news_meta_description').val(data.meta_description);

                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                    console.log(status);
                    console.log(error);
                }
            })
        });


        //delete Navbar Item 

        // delete Navbar Item 
        $('#deleteNavBar').on('click', function (event) {
            event.preventDefault();

            // Lấy giá trị slug từ input hidden
            var slug = $('input[name="delete_id"]').val();
            console.log(slug);

            $.ajax({
                url: 'deleteNavBar',
                type: 'POST',
                contentType: 'application/json', // Đúng format JSON
                data: JSON.stringify({ slug: slug }), // Dữ liệu gửi dưới dạng JSON
                success: function (response) {
                    if (response.success === true) { // Kiểm tra điều kiện thành công
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                    console.log(status);
                    console.log(error);
                }
            });
        });

    });
</script>