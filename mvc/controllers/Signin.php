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

            if (!isset($_POST["login_btn"])) {
                $_SESSION['status'] = 'Something went wrong!!!';
                header("Location: " . $_ENV['BASE_URL'] . "/Sigin");
            }

            $email_login = strip_tags($_POST['email']);
            $password_login = strip_tags($_POST['password']);

            $account = $this->model("AccountModel");
            $result = $account->login($email_login, $password_login);

            if (!$result) {
                $_SESSION['status'] = 'Wrong email and password';
                header("Location: " . $_ENV['BASE_URL'] . "/Signin");
            }
            $role = $result['role'];

            switch ($role) {
                case 'admin':
                    $_SESSION['username'] = $email_login;
                    $_SESSION['isLogin'] = true;
                    header("Location: " . $_ENV['BASE_URL'] . "/Admin/dashboard");
                    break;
                case 'user':
                    header("Location: " . $_ENV['BASE_URL'] . "/");
                    break;
                default:
                    $_SESSION['status'] = 'Wrong email or password!!!';
                    header("Location: " . $_ENV['BASE_URL'] . "/Signin");
                    break;
            }

        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header("Location: " . $_ENV['BASE_URL'] . "/Signin");
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
            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

            // Redirect to the login page
            header("Location: " . $_ENV['BASE_URL'] . " /Signin");
            exit();
        }
    }
}
