<?php

namespace Mvc\Controllers\Admin;

use Core\Controller;
use Core\Exception;
use Core\Auth;
class Account extends Controller
{

    public function __construct()
    {
        Auth::checkAdmin();
    }
    function display()
    {
        //Model
        $user = $this->model("AccountModel");

        //View
        $this->view("admin/home", [
            "user" => $user->getAccount(),
            "page" => "displayAccount"
        ]);
    }
    //add new user account
    function addAccount($username = null, $email = null, $password = null, $role = null)
    {
        try {
            if (isset($_POST["addAccountBtn"])) {
                //real_escape_string(): Hàm cơ bản giúp tránh bị tấn công SQL Injection
                $username = strip_tags($_POST['username']);
                $email = strip_tags($_POST['email']);
                $password = strip_tags($_POST['password']);
                $confirmpassword = strip_tags($_POST['confirmpassword']);
                $role = strip_tags($_POST['role']);

                if ($password === $confirmpassword) {
                    $account = $this->model('AccountModel');
                    $success = $account->addAccount($username, $email, $password, $role);
                    if ($success) {
                        echo "Saved";
                        $_SESSION['success'] = 'Admin profile added';
                        header('Location: Account');
                    } else {
                        echo "Not save";
                        $_SESSION['status'] = 'Admin profile NOT added';
                        header('Location: Account');
                    }
                } else {
                    $_SESSION['status'] = 'Password and Confirm Pass';
                    header('Location: Account');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location: Account');
        }
    }

    //getAccountById()
    function getAccountById()
    {
        if(isset($_POST['checking_edit_btn'])) {
            $account_id=$_POST['account_id'];
            $result_array=[];
            $account= $this->model('AccountModel');
            $result = $account->getAccountById($account_id);
            if(mysqli_num_rows($result) > 0) {
                foreach ($result as $row) {
                    array_push($result_array, $row);
                    header('Content-Type: application/json');
                    echo json_encode($result_array);

                }

            }
        }
    }

    //edit  user account
    public function editAccount()
    {
        try {

            if (isset($_POST["editAccountBtn"])) {
                $username = strip_tags($_POST['edit_username']);
                $email = strip_tags($_POST['edit_email']);
                $role = strip_tags($_POST['edit_role']);
                $id = $_POST['edit_id'];
                $account = $this->model('AccountModel');
                $success = $account->editAccount($id, $username, $email,$role);
                if ($success) {
                    $_SESSION['success'] = 'Your data is updated';
                    header('Location: Account');
                } else {
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header('Location: Account');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location: Account');
        }
    }


    //delete user account
    function deleteAccount()
    {
        try {
            if (isset($_POST["delete_btn"])) {
                $id = $_POST['delete_id'];
                $account = $this->model('AccountModel');
                $result = $account->deleteAccount($id);
                if ($result) {
                    $_SESSION['success'] = 'Your data is deleted';
                    header('Location: Account');
                } else {
                    $_SESSION['status'] = 'Your data is NOT deleted';
                    header('Location: Account');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location: Account');
        }
    }
}
