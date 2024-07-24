<?php 
    class Signin extends Controller{
        function display(){
           $this->view("login",[]);
        }

        function login($email_login=null,$password_login=null){
            try{
                if(isset($_POST["login_btn"])){
                    $email_login=strip_tags($_POST['email']);
                    $password_login=strip_tags($_POST['password']);

                    $account=$this->model("AccountModel");
                    $result=$account->login($email_login,$password_login);
                   if(!$result){
                    $_SESSION['status'] = 'Wrong email and password';
                    header('Location:display');
                   }else{
                    $role=$result['role'];
                    $_SESSION['username']=$email_login;
                    if($role==='admin'){
                        $_SESSION['username']=$email_login;
                        header('Location: ../Admin/');
                    }else if($role==='user'){
                        $_SESSION['username']=$email_login;
                        header('Location: ../Home/');
                    }
                   }
                }

            }catch(Exception $e){
                $_SESSION['status'] = $e->getMessage() ;
                header('Location:display');
            }
        }
    }
?>