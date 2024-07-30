<?php
 class Navbar extends Controller{
    function displayNavbar()
    {
        $item = $this->model('NavbarModel');

        $this->view('admin/home', [
            'item' => $item->getInforNavbar(),
            'page' => 'navbar'
        ]);
    }
 }
?>