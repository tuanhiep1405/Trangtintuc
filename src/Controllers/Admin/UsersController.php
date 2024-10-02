<?php

namespace Assignment\Php2News\Controllers\Admin;

use Assignment\Php2News\Commons\Controller;
use Assignment\Php2News\Commons\Helper;
use Assignment\Php2News\Models\User;

class UsersController extends Controller
{
    private string $folder = 'pages.users.';
    private User $user;

    public function __construct()
    {
        $this->user = new User;
    }


    // USERS LIST
    public function list()
    {
        $page = $_GET['page'] ?? 1;
        $perPage = $_GET['per-page'] ?? 5;

        // Lấy danh sách users theo trạng thái
        [$users, $totalPage] = $this->user->getByStatusPanigate(
            [1, 2],
            ['id', 'email', 'role', 'avatar', 'status'],
            ['id', 'DESC'],
            $page,
            $perPage,
            $_SESSION['user']['id']
        );


        return $this->renderViewAdmin (

            $this->folder . __FUNCTION__,
            [
                'users' => $users,
                'totalPage' => $totalPage,
                'page' => $page,
                'perPage' => $perPage
            ]

        );

    }


    // USERS RESTORE PASSWORD
    public function restorePassword($id)
    {

        // Lấy user theo id
        $user = $this->user->getByID($id, ['id', 'email', 'name']);

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
            $_SESSION['notify']['success'][] = "Password restore for {$user['email']} has been confirmed";
        }

        header("Location: /admin/users");
        die;
   
    }


    // USERS EDIT
    public function edit($id)
    {

        // Kiểm tra nhấn nút update nếu có nhấn sẽ chạy vào đây
        if(isset($_POST['btn-update'])) {

            // Lấy user theo id
            $user = $this->user->getByID($id, ['id', 'role']);

            /**
             * Có thay đổi thì chạy vào if
             * Không có thay đổi gì thì chạy vào else
             */
            if($user['role'] !== (int)$_POST['role']) {

                /**
                 * Update thành công thì tạo thông báo success 
                 * Còn không thì tạo thông báo error
                 */
                try {

                    $this->user->update(
                        $user['id'],
                        [
                            'role' => $_POST['role'],
                            'updated_at' => date('Y-m-d H:i:s', time())
                        ]
                    );

                    // tạo thông báo success
                    $_SESSION['notify']['success'][] = "Updated !";

                }
                catch(\Throwable $e) {

                    // tạo thông báo error
                    $_SESSION['notify']['danger'][] = $e->getMessage(); 
                }
                
            }
            else {

                // tạo cảnh cáo không có thay đổi
                $_SESSION['notify']['warning'][] = "No changes";
            }

        }


        $user = $this->user->getByID($id, ['id', 'email', 'name', 'avatar', 'role']);

        return $this->renderViewAdmin(
            $this->folder . __FUNCTION__,
            [
                'user' => $user
            ]
        );

    }


    // USERS LOCK
    public function lock($id)
    {
        // Lấy user theo id
        $user = $this->user->getByID($id, ['id', 'email']);

        try {

            // Cập nhật trạng thái user
            $this->user->update(
                $user['id'],
                [
                    'status'      =>    0,
                    'updated_at'  =>    date('Y-m-d H:i:s', time())
                ]
            );

            // tạo thông báo thành công
            $_SESSION['notify']['success'][] = "Locked {$user['email']} !";
        }
        catch(\Throwable $e) {

            // tạo thông báo error
            $_SESSION['notify']['danger'][] = $e->getMessage();
        }

        header('Location: /admin/users');
        die;

    }


    // USERS UNLOCK
    public function unlock($id)
    {
        // Lấy user theo id
        $user = $this->user->getByID($id, ['id', 'email']);

        try {

            // Cập nhật trạng thái user
            $this->user->update(
                $user['id'],
                [
                    'status' => 2,
                    'updated_at' => date('Y-m-d H:i:s', time())
                ]
            );

            // tạo thông báo thành công
            $_SESSION['notify']['success'][] = "Unlocked {$user['email']} !";

        }
        catch(\Throwable $e) {

            // tạo thông báo error
            $_SESSION['notify']['danger'][] = $e->getMessage();
        }

        header('Location: /admin/users/list-lock');
        die;
    }


    // USERS LISTLOCK
    public function listLock()
    {
        $page = $_GET['page'] ?? 1;
        $perPage = $_GET['per-page'] ?? 5;

        // Lấy users theo trạng thái
        [$usersLock, $totalPage] = $this->user->getByStatusPanigate(
            [0],
            ['id', 'email', 'role', 'avatar', 'status'],
            ['updated_at', 'DESC'],
            $page,
            $perPage
        );

        return $this->renderViewAdmin(
            $this->folder . 'list-lock',
            [
                'usersLock' => $usersLock,
                'totalPage' => $totalPage,
                'page' => $page,
                'perPage' => $perPage
            ]
        );

    }
}
