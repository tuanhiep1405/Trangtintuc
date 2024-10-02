<?php

namespace Assignment\Php2News\Controllers\Client;

use Assignment\Php2News\Commons\Controller;
use Assignment\Php2News\Commons\Helper;
use Assignment\Php2News\Models\User;

class AuthController extends Controller
{

    private User $user;

    public function __construct()
    {
        $this->user = new User;
    }
    
    // Hàm logIn: Đăng nhập
    public function logIn()
    {
        if(isset($_POST['btn-login'])) {
            $validation = Helper::validate(
                $_POST,
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );

            if(empty($validation)) {
                if($user = $this->user->getByEmail($_POST['email'])) {
                    if(password_verify($_POST['password'], $user['password'])) {
                        if($user['status'] === 0) {
                            $_SESSION['notify']['danger'][] = 'Your account has been locked';
                        }

                        if($user['status'] === 1) {
                            $_SESSION['notify']['warning'][] = 'Your account has not been verified';
                        }

                        if($user['status'] === 2) {
                            $_SESSION['user'] = $user;
                            header("Location: /");
                            die;
                        }
                    }
                    else {
                        $_SESSION['error']['password'] = 'Invalid email or password';
                    }
                }
                else {
                    $_SESSION['error']['password'] = 'Invalid email or password';
                }

            }
            else {
                foreach($validation as $name => $error) {
                    $_SESSION['error'][$name] = $error;
                }
            }
        }


        return $this->renderViewClient('pages.auth.login');
    }


    // Hàm signUp: Đăng ký
    public function signUp()
    {
        if(isset($_POST['btn-sign-up'])) {

            $validation = Helper::validate(
                $_POST + $_FILES,
                [
                    'name'                  => 'required',
                    'email'                 => 'required|email',
                    'password'              => 'required|min:6',
                    'confirm_password'      => 'required|same:password',
                    'avatar'                => 'uploaded_file:0,500K,png,jpg,jpeg'
                ]
            );

            if(empty($validation)) {

                $this->user->connect->beginTransaction();

                try {

                    if($_FILES['avatar']['error'] == 0) {
                        if(!($nameAvatar = Helper::uploadFile($_FILES['avatar'], 'users/'))) {

                           $_SESSION['notify']['danger'][] = "Upload Avatar Fail";

                           return $this->renderViewClient('pages.auth.sign-up');
                           
                        }
                    }
    
                    $token = Helper::createToken();
    
                    $id = $this->user->insert(
                        [
                            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                            'email' => $_POST['email'],
                            'name' => $_POST['name'],
                            'role' => 0,
                            'avatar' => isset($nameAvatar) ? $nameAvatar : 'uploads/users/default.png',
                            'status' => 1,
                            'token' => $token
                        ]
                    );
    
                    $user = $this->user->getByID($id, ['id', 'name', 'email']);
    
                    // Config email
                    $title = "Welcome to website PHP2 News";
                    $content = "
                                Dear {$user['name']},
                                <br>
                                Welcome to website PHP2 News
                                <br> <br>
                                Please click here to confirm your account.
                                <h4><a href='{$_ENV['BASE_URL']}auth/confirm-token?email={$user['email']}&act=confirm-account&token=$token'>Confirm Account</a></h4>
                    ";
    
                    if(Helper::sendEmail( $user['email'], $title, $content)) {
                        
                        $this->user->connect->commit();
    
                        $_SESSION['notify']['success'][] = "Registered. Please check {$user['email']} to cofirm account.";

                        return $this->renderViewClient(
                            'pages.auth.page-success',
                            [
                                'button' => '<a href="/" class="btn btn-primary">Back to Home</a>'
                            ]
                        );

                    };

                }
                catch(\Throwable $e) {

                    $this->user->connect->rollBack();

                    $_SESSION['notify']['danger'][] = $e->getMessage();

                }

            }
            else {
                foreach($validation as $name => $error) {
                    $_SESSION['error'][$name] = $error;
                }
            }
        }
        return $this->renderViewClient('pages.auth.sign-up');
    }


    // Hàm forgotPassword: Quên mật khẩu
    public function forgotPassword()
    {
        if(isset($_POST['btn-continue'])) {
            $validation = Helper::validate(
                $_POST,
                [
                    'email' => 'required|email'
                ]
            );

            if(empty($validation)) {

                try {

                    // Lấy user theo id
                    if($user = $this->user->getByEmail($_POST['email'], ['id', 'email', 'name'])) {

                        // Tạo token
                        $token = Helper::createToken();

                        // Config email
                        $title = "Restore Password For PHP2 News";
                        $content = "
                                    Dear {$user['name']},
                                    <br> <br>
                                    Please click here to restore your password.
                                    <h4><a href='{$_ENV['BASE_URL']}auth/confirm-token?email={$user['email']}&act=restore-account&token=$token'>Restore password</a></h4>
                        ";

                        // Nếu gửi mail thành công thì sẽ update token và tạo thông báo thành công
                        if(Helper::sendEmail( $user['email'], $title, $content)) {

                            // update token
                            $this->user->update($user['id'], [ "token" => $token ]);

                            // tạo thông báo thành công
                            $_SESSION['notify']['success'][] = "Please check {$user['email']} to restore password.";

                            return $this->renderViewClient(
                                'pages.auth.page-success',
                                [
                                    'button' => '<a href="/" class="btn btn-primary">Back to Home</a>'
                                ]
                            );
                        }

                    }
                    else {
                        $_SESSION['error']['email'] = "Email does not exist";
                    }
            
                }
                catch(\Throwable $e) {
                    $_SESSION['notify']['danger'][] = $e->getMessage();
                }
                
            }
            else {

                $_SESSION['error']['email'] = $validation['email'];

            }
        }

        return $this->renderViewClient('pages.auth.password-forgot');
    }

    // Hàm resetPassword: Update mật khẩu mới
    public function resetPassword()
    {
        if(isset($_POST['btn-ok'])) {
            $validation = Helper::validate(
                $_POST,
                [
                    "password" => "required|min:6",
                    "confirm_password" => "required|same:password"
                ]
            );

            if(empty($validation)) {

                $user = $this->user->getByEmail($_GET['email'], ['id', 'email']);

                $this->user->update(
                    $user['id'],
                    [
                        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                        'updated_at' => date('Y-m-d H:i:s', time())
                    ]
                );

                $_SESSION['notify']['success'][] = "Changed password for {$user['email']}";

                return $this->renderViewClient(
                    'pages.auth.page-success',
                    [
                        'button' => "<a href='/auth/' class='btn btn-primary'>Login Now</a>"
                    ]
                );
            }
            else {
                foreach($validation as $name => $error) {
                    $_SESSION['error'][$name] = $error;
                }
            }
        }

        return $this->renderViewClient('pages.auth.reset-password');
    }

    // Hàm confirmToken: xác nhận token và điều hướng trang
    public function confirmToken()
    {

        // Dang ky
        if(isset($_GET['act']) && $_GET['act'] === 'confirm-account') {
            
            $email = $_GET['email'];

            $user = $this->user->getByEmail($email, ['id', 'email', 'token']);

            if($user['token'] === $_GET['token']) {

                $this->user->update(
                    $user['id'],
                    [
                        'status' => 2
                    ]
                );

                $_SESSION['notify']['success'][] = "Confirmed your account: {$user['email']}";
                return $this->renderViewClient(
                    'pages.auth.page-success',
                    [
                        'button' => "<a href='/auth/' class='btn btn-primary'>Login Now</a>"
                    ]
                );
                
            }
            else {
                $_SESSION['notify']['danger'][] = "Confirm failed";
                return $this->renderViewClient('pages.auth.page-error');
            }

        }

        // Khoi phuc mat khau
        if(isset($_GET['act']) && $_GET['act'] === 'restore-account') {
            $email = $_GET['email'];

            $user = $this->user->getByEmail($email, ['id', 'email', 'token']);

            if($user['token'] === $_GET['token']) {

                header("Location: /auth/reset-password/?email={$user['email']}");
                die;
                
            }
            else {
                $_SESSION['notify']['danger'][] = "Confirm failed";
                return $this->renderViewClient('pages.auth.page-error');
            }
        }

        die;
    }


    // Hàm logout: đăng xuất
    public function logout()
    {
       unset($_SESSION['user']);
       header('Location: /');
       die;
    } 
}
