<?php
class Auth extends Controller{
    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
        $this->logUserModel = $this->model('LogUserModel');
    }

    public function register(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
           // process form
           $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '' 
            ];

            //valide name
            if(empty($data['name'])){
                $data['name_err'] = 'Please enter name';
            }

            //validate email
            if(empty($data['email'])){
                $data['email_err'] = 'Please enter email';
            }else{
                //check for email
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_err'] = 'Email already exist';
                }
            }

            //validate password 
            if(empty($data['password'])){
                $data['password_err'] = 'Please enter your password';
            }elseif(strlen($data['password']) < 6){
                $data['password_err'] = 'Password must be atleast six characters';
            }

            //validate confirm password
            if(empty($data['confirm_password'])){
                $data['confirm_password_err'] = 'Please confirm password';
            }else{
                if($data['password'] != $data['confirm_password'])
                {
                    $data['confirm_password_err'] = 'Password does not match';
                }
            }

            //make sure error are empty
            if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['password_confirm_err'])){
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                if($this->userModel->register($data)){
                    flash('register_success', 'you are registerd you can login now');
                    redirect('auth/login');
                }
            }else{
                $this->view('auth/register', $data);
            }
        }else{
            //init data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '' 
            ];
            //load view
            $this->view('auth/register', $data);          
        }
    }

    public function login(){
        if(isLoggedIn()){
            redirect('posts');
        }else{
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                // process form
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 
                $data = [
                    'username' => trim($_POST['username']),
                    'password' => trim($_POST['password']),
                    'username_err' => '',
                    'password_err' => ''
                ];
    
                //validate username
                if(empty($data['username'])){
                    $data['username_err'] = 'Please enter username';
                }else{
                    if($this->userModel->findUserByUsernameOrNIP($data['username'])){
                        //user found
                    }else{
                        $data['username_err'] = 'User not found';
                    }
                }
    
                //validate password 
                if(empty($data['password'])){
                    $data['password_err'] = 'Please enter your password';
                }elseif(strlen($data['password']) < 4){
                    $data['password_err'] = 'Password must be atleast four characters';
                }
                
                //make sure error are empty
                if(empty($data['username_err']) && empty($data['password_err'])){
                    $loggedInUser = $this->userModel->login($data['username'], $data['password']);
                    if($loggedInUser){
                        //create session
                        $this->createUserSession($loggedInUser);
                    }else{
                        $data['password_err'] = 'Password incorrect';
                        $this->view('auth/login', $data);
                    }
                }else{
                    $this->view('auth/login', $data);
                }
    
            }else{
                //init data f f
                $data = [
                    'username' => '',
                    'password' => '',
                    'username_err' => '',
                    'password_err' => ''
                ];
                //load view
                $this->view('auth/login', $data);          
            }
        }
    }

    //setting user section variable
    public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['nip'] = $user->nip;
        $_SESSION['nama'] = $user->nama;
        $_SESSION['email'] = $user->email;
        $_SESSION['jabatan'] = $user->jabatan_fungsi;
        $_SESSION['role'] = $user->role;
        $_SESSION['waktu_login'] = date('Y-m-d H:i:s');
        return redirect('dashboard');
    }

    //logout and destroy user session
    public function logout(){
        // add log user
        // $this->logUserModel->add();

        unset($_SESSION['user_id']);
        unset($_SESSION['name']);
        unset($_SESSION['email']);
        session_destroy();
        return redirect('auth/login');
    }
}