<?php 
    class Account extends Controller{
      
        function displayAccount(){
            //Model
            $user=$this->model("AccountModel");
            
            //View
            $this->view("admin/home",[
                "user" => $user->getAccount(),
                "page"=>"displayAccount"
            ]);
        }
        //add new user account
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

        //display detail infor user account
        public function displayDetailAccount(){
            if(isset($_POST["edit_btn"])){
            //Model
            $user=$this->model("AccountModel");
          
            //View
            $this->view("admin/home",[
                "user" => $user->getAccountbyId($_POST['edit_id']),
                "page"=>"editAccount"
            ]);
        }
        }
        //edit  user account

        public function editAccount(){
            try{

                if(isset($_POST["user_updatebtn"])){
                    $username = strip_tags($_POST['username']);
                    $email = strip_tags($_POST['email']);
                    $role = strip_tags($_POST['role']);
                    $password = strip_tags($_POST['password']);
                    $id = $_POST['edit_id'];
                    $account = $this->model('AccountModel');
                    $success= $account->editAccount($id,$username,$email,$password,$role);
                    if ($success) {
                        $_SESSION['success'] = 'Your data is updated';
                        header('Location: displayAccount');
            
                    } else {
                        $_SESSION['status'] = 'Your data is NOT updated';
                        header('Location: displayAccount');
            
                    }
                   
                }

            }catch(Exception $e){
                $_SESSION['status'] = $e->getMessage();
                header('Location:../View/login.php');
            }
        }
           

        //delete user account

    }
?>