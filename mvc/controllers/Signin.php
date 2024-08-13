<?php

namespace Mvc\Controllers;

use Core\Controller;
use Core\Exception;

class Signin extends Controller
{
    function display()
    {
        $this->view("login", []);
    }
    //login account
    function login($email_login = null, $password_login = null)
    {
        try {
            if (isset($_POST["login_btn"])) {
                $email_login = strip_tags($_POST['email']);
                $password_login = strip_tags($_POST['password']);

                $account = $this->model("AccountModel");
                $result = $account->login($email_login, $password_login);
                if (!$result) {
                    $_SESSION['status'] = 'Wrong email and password';
                    header('Location:../Signin/');
                } else {
                    $role = $result['role'];
                    if ($role === 'admin') {
                        $_SESSION['username'] = $email_login;
                        $_SESSION['isLogin'] = true;
                        header('Location: ../Admin/dashboard/');
                    } else if ($role === 'user') {
                        header('Location: ../Signin/');
                    }
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:../Signin');
        }
    }

    //logout account
    function logout()
    {
        if (isset($_POST['logout_btn'])) {
            // Unset all session variables
            // $_SESSION = array();
            session_destroy();
            unset($_SESSION['username']);

            // Prevent caching
            // header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            // header("Cache-Control: post-check=0, pre-check=0", false);
            // header("Pragma: no-cache");

            // Redirect to the login page
            header('Location: Signin/');
            exit();
        }
    }
}
