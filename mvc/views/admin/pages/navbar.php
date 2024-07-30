<div class="container-fluid">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color:#4a6fdc;text-transform: uppercase;font-weight: 600;">
            Custom Navbarigation Bar Information</h5>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4" style="padding: 2em 0;">
        <?php
        if (isset($_SESSION['success']) && $_SESSION['success'] != "") {
            echo '<h2 class="bg-primary text-white">' . $_SESSION['success'] . '</h2>';
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['status']) && $_SESSION['status'] != "") {
            echo '<h2 class="bg-danger text-white">' . $_SESSION['status'] . '</h2>';
            unset($_SESSION['status']);
        }
        ?>
        <div class="card-body">
            <form action="customNavbar" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="navbar_name">Name</label>

                    <div class="input-wrapper">
                        <?php
                        foreach ($data["item"] as $row) {
                        ?>
                            <div class="input-field">
                                <input type="text" value="<?php echo $row['name']; ?>" class="form-control">
                                <a href="javascript:void(0);" data-id="<?php echo $row['id']?>"class="remove-ic-btn" title="Delete input" style="color:#c81c1c;"> <i class="fas fa-minus-circle"></i></a>
                                <a href="javascript:void(0);" data-id="<?php echo $row['id']?>"class="edit-ic-btn" title="Add input" style="color:#e4b555;"> <i class="fas fa-edit"></i></a>
                            </div>

                        <?php
                        }
                        ?>
                        <div class="input-field odd">
                            <input type="text" name="field[]" class="form-control">
                            <a href="javascript:void(0);" class="add-input" title="Add input" style="color:#1cc88a;"> <i class="fas fa-plus-circle"></i></a>
                        </div>
                    </div>
                    <button type="submit" name="add-new-field" class="btn btn-success">Submit</button>
                </div>
            </form>
            <div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var max_input_fields = 8;
        var add_input = $('.add-input');
        var input_wrapper = $('.input-wrapper');
        var new_input = `<div class="input-field">
                            <input type="text" name="field[]" value="" class="form-control">
                            <a href="javascript:void(0);" class="add-input" title="Add input" style="color:#e4b555;"> <i class="fas fa-edit"></i></a>
                            <a href="javascript:void(0);" class="remove-input" title="Add input"style="color:#c81c1c;"> <i class="fas fa-minus-circle"></i></a>
                        </div>`
        var add_input_count = 1;

        $(add_input).click(function() {
            if (add_input_count < max_input_fields) {
                add_input_count++;
                $('.input-field.odd').first().before(new_input);
                // $(input_wrapper).prepend(new_input);
                //append: hiễn thị html sau vật thể
                //depend: hiễn thị html trước vật thể
            } else {
                alert('You can only add up to ' + max_input_fields + ' items');
            }

        });

        $(input_wrapper).on('click', '.remove-input', function() {
            // e.PreventDefault(); 
            $(this).parent('.input-field').remove();
            add_input_count--;
        });

        $(input_wrapper).on('click', '.remove-ic-btn', function() {
            var id =$(this).data('id');


            $.ajax({
                url: 'Navbar/deleteNavbarItems',
                type: 'POST',
                data: {id: id},
                success: function(response) {
                    if(response.success) {
                        $(this).parent('.input-field').remove();
                        add_input_count--;
                    }else{
                        alert('Delete failed');
                    }
                }.bind(this)
            });
        });
    });
</script>