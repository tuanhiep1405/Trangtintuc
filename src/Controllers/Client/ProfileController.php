<?php

namespace Assignment\Php2News\Controllers\Client;

use Assignment\Php2News\Commons\Controller;
use Assignment\Php2News\Commons\Helper;
use Assignment\Php2News\Models\User;

class ProfileController extends Controller
{
    private User $user;

    public function __construct()
    {
        $this->user = new User;
    }


    public function index()
    {
        $totalComment = $this->user->getTotalComment($_SESSION['user']['id']);

        return $this->renderViewClient('pages.profile', ['totalComment' => $totalComment]);
    }

    public function edit()
    {
        if (isset($_POST['btn-save'])) {
            $validation = Helper::validate(
                $_POST + $_FILES,
                [
                    'name'  => 'required',
                    'avatar'    => 'uploaded_file:0,500K,png,jpg,jpeg'
                ]
            );

            if (empty($validation)) {

                try {
                    $data = [
                        'name' => $_POST['name']
                    ];

                    if ($_FILES['avatar']['error'] == 0) {

                        if ($avatarName = Helper::uploadFile($_FILES['avatar'], 'users/')) {

                            $data['avatar'] = $avatarName;

                        } else {

                            throw new \Exception("Upload avatar fail");
                        }
                    }

                    if(
                        $_SESSION['user']['name'] === $_POST['name']
                        && $_FILES['avatar']['error'] !== 0
                    ) {

                        $_SESSION['notify']['warning'][] = "No changes";

                    }
                    else {

                        $data['updated_at'] = date('Y-m-d H:i:s', time());

                        try {
                            $this->user->update($_SESSION['user']['id'], $data);

                            $_SESSION['notify']['success'][] = "Updated";

                            $_SESSION['user'] = $this->user->getByID($_SESSION['user']['id']);
                        }
                        catch(\Throwable $e) {

                            throw new \Exception("Username already exist");

                        }
                    }

                } catch (\Throwable $e) {

                    $_SESSION['notify']['danger'][] = $e->getMessage();
                }
                
            } else {

                $_SESSION['notify']['danger'] = $validation;
            }
        }

        return $this->renderViewClient('pages.profile-edit');
    }
}
