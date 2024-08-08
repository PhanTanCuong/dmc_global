<?php

namespace Mvc\Controllers\Admin;

use Core\Controller;
use Core\Exception;
use Core\Middleware;

class NavBar extends Controller
{
    function __construct()
    {
        Middleware::checkAdmin();
    }

    function display()
    {
        $item = $this->model('NavBarModel');

        // Load view
        $this->view('admin/home', [
            'page' => 'customizeNavbar',
            'item' => $item->getInforNavBar()
        ]);
    }

    function addNavbarItem()
    {
        try {
            if (isset($_POST['addNavbarItemBtn'])) {
                $name = strip_tags($_POST['navbar_name']);

                $item=$this->model('NavBarModel');
                $success = $item->addNavBarInfor($name);
                if( $success ) {
                    $_SESSION['success'] ='Your data is added';
                    header('Location:NavBar'); 
                }else{
                    $_SESSION['status'] ='Your data is NOT added';
                    header('Location:NavBar');
                }
                
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:NavBar');
        }
    }


    //Child Navbar
    function displayChildNavBar()
    {
        $item = $this->model('NavBarModel');

        $this->view('admin/home', [
            'page' => 'customizeChildNavbar',
            'item' => $item->getInforChildNavBar()
        ]);
    }

    function addChildNavInfor()
    {
        try {
            if (isset($_POST['addChildNavInforBtn'])) {
                $name = strip_tags($_POST['child_nav_name']);

                $item=$this->model('NavBarModel');
                $success = $item->addChildNavBar($name);
                if( $success ) {
                    $_SESSION['success'] ='Your data is added';
                    header('Location:ChildNavBar'); 
                }else{
                    $_SESSION['status'] ='Your data is NOT added';
                    header('Location:ChildNavBar');
                }
                
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:ChildNavBar');
        }
    }
}
