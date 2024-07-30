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
                        <div class="input-field">
                            <input type="text" name="field[]" value="" class="form-control">
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
                            <a href="javascript:void(0);" class="remove-input" title="Add input"style="color:#c81c1c;"> <i class="fas fa-minus-circle"></i></a>
                        </div>`
        var add_input_count = 1;

        $(add_input).click(function() {
            if(add_input_count < max_input_fields) {
                add_input_count++;
                $(input_wrapper).append(new_input);
            }else{
                alert('You can only add up to ' + max_input_fields + ' icons.');
            }
          
        });

        $(input_wrapper).on('click', '.remove-input', function() {
            // e.PreventDefault(); 
            $(this).parent('.input-field').remove();
            add_input_count--;
        });




    });
</script>