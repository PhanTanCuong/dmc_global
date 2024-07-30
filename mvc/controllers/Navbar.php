<?php
class Navbar extends Controller
{
    function displayNavbar()
    {
        $item = $this->model('NavbarModel');

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
                    $success = $this->model('NavbarModel')->addInfor2Navbar($item);
                    if ($success) {
                        $_SESSION['success'] = 'Field added successfully';
                        header('Location: displayNavbar');
                    } else {
                        $_SESSION['status'] = 'Field NOT added';
                        header('Location: displayNavbar');
                    }
                }
            }
        } catch (Exception $e) {
            $_SESSION['_status'] = $e->getMessage();
            header('Location: displayNavbar');
        }
    }
}
