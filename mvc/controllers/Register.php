<?php

namespace Mvc\Controllers;

use Core\Controller;
use Core\Exception;

class Register extends Controller
{
    function display()
    {
        $this->view("register", []);
    }

    //add new user account
    function signup($username = null, $email = null, $password = null, $role = null)
    {
        try {
            if (isset($_POST["signup_btn"])) {
                //real_escape_string(): Hàm cơ bản giúp tránh bị tấn công SQL Injection
                $username = strip_tags($_POST['username']);
                $email = strip_tags($_POST['email']);
                $password = strip_tags($_POST['password']);
                $confirmpassword = strip_tags($_POST['confirmpassword']);
                

                if ($password !== $confirmpassword) {
                    $_SESSION['status'] = 'Password and Confirm Pass';
                    header('Location: ');
                }

                $account = $this->model('AccountModel');
                $success = $account->addAccount($username, $email, $password, 'user');

                if (!$success) {
                    echo "Not save";
                    $_SESSION['status'] = 'Fail create a new account';
                    header('Location: ');
                }

                echo "Saved";
                header('Location: ../Signin/');
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:display');
        }
    }
}
