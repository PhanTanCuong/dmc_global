<?php
class Customize extends Controller
{
    // Navigation bar
    function displayNavbar()
    {
        $item = $this->model('CustomModel');

        $this->view('admin/home', [
            'item' => $item->getInforNavbar(),
            'page' => 'navbar'
        ]);
    }


    function customNavbar()
    {
        try {
            if (isset($_POST['add-new-field'])) {
                $name = $_POST['field'];
                foreach ($name as $item) {
                    $success = $this->model('CustomModel')->addInfor2Navbar($item);
                    if ($success) {
                        $_SESSION['success'] = 'Navbar sections are added successfully';
                        header('Location: displayNavbar');
                    } else {
                        $_SESSION['status'] = 'Navbar sections are NOT added';
                        header('Location: displayNavbar');
                    }
                }
            }
        } catch (Exception $e) {
            $_SESSION['_status'] = $e->getMessage();
            header('Location: displayNavbar');
        }
    }

    function deleteNavbarItems()
    {
    }
    // Footer
    function displayFooter()
    {
        try {

            $item = $this->model('CustomModel');
            $this->view('admin/home', [
                'item' => $item->getFooterInfor(),
                'page' => 'footer'
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
