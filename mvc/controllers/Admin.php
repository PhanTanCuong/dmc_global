<?php 
    class Admin extends Controller{
        function display(){
            //Model
            $total=$this->model("AccountModel");
            //View
           $this->view("admin/home",[
            "totalUser"=>$total->totalUser(),
            "page"=>"main"
 
           ]);
        }

        
        function displayAccount(){
            //Model
            $user=$this->model("AccountModel");
            
            //View
            $this->view("admin/home",[
                "user" => $user->getAccount(),
                "page"=>"displayAccount"
            ]);
        }

        function addAccount($username=null,$email=null,$password=null,$role=null){
            try {
                if(isset($_POST["addAccountBtn"])){ 
                //real_escape_string(): Hàm cơ bản giúp tránh bị tấn công SQL Injection
                $username =strip_tags($_POST['username']);
                $email = strip_tags($_POST['email']);
                $password = strip_tags($_POST['password']);
                $confirmpassword = strip_tags($_POST['confirmpassword']);
                $role = strip_tags($_POST['role']);
                
                if ($password === $confirmpassword) {
                    $account =$this->model('AccountModel');
                    $success= $account->addAccount($username,$email,$password,$role);
                    if ($success) {
                        echo "Saved";
                        $_SESSION['success'] = 'Admin profile added';
                        header('Location: displayAccount');
                    } else {
                        echo "Not save";
                        $_SESSION['status'] = 'Admin profile NOT added';
                        header('Location: displayAccount');
                    }
                } else {
                    $_SESSION['status'] = 'Password and Confirm Pass';
                    header('Location: displayAccount');
                }
            }
            } catch (Exception $e) {
                $_SESSION['status'] = $e->getMessage();
                header('Location:displayAccount');
            }
            
        }
    }
?>