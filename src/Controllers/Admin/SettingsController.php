<?php

namespace Assignment\Php2News\Controllers\Admin;

use Assignment\Php2News\Commons\Controller;
use Assignment\Php2News\Models\Settings;
use Rakit\Validation\Validator;

class SettingsController extends Controller
{

    private string $folder = 'pages.settings.';

    private Settings $Setting;

    public function __construct()
    {
        $this->Setting = new Settings();
    }
    
    // Settings
    public function index()
    {

        $settings = $this->Setting->get();
        
        return $this->renderViewAdmin($this->folder . __FUNCTION__, ['settings' => $settings]);
    }

    // Settings Edit
    public function edit()
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

            // Validator
            $validator = new Validator();
            $validation = $validator->make($_POST + $_FILES, [
                'name'  => 'required|min:3',
                'email' => 'required|email',
                'logo'  => 'uploaded_file:0,2048K,png,jpeg,jpg', //tệp tải lên, max 2MB
                'icon'  => 'uploaded_file:0,2048K,png,jpeg,jpg', //tệp tải lên, max 2MB
            ]);
        
            $validation->validate();
            if ($validation->fails()) {
                $_SESSION['notify']['danger'] = $validation->errors()->firstOfAll();
            } else {
                $data = [
                    'name'  => $_POST['name'],
                    'email' => $_POST['email'],
                ];
        
                if (!empty($_FILES['logo']) && $_FILES['logo']['size'] > 0) {
                    $fromLogo = $_FILES['logo']['tmp_name'];
                    $toLogo = 'uploads/users/' . uniqid() . time() . '_' . $_FILES['logo']['name'];
        
                    if (move_uploaded_file($fromLogo, PATH_ASSET . $toLogo)) {
                        $data['logo'] = $toLogo;
                    }
                }
        
                if (!empty($_FILES['icon']) && $_FILES['icon']['size'] > 0) {
                    $fromIcon = $_FILES['icon']['tmp_name'];
                    $toIcon = 'uploads/users/' . uniqid() . time() . '_' . $_FILES['icon']['name'];
        
                    if (move_uploaded_file($fromIcon, PATH_ASSET . $toIcon)) {
                        $data['icon'] = $toIcon;
                    }
                }
        
                $this->Setting->update($data);
                $_SESSION['notify']['success'][] = 'Update successful';
                header("Location: /admin/settings/edit");
                die;
            }
        }
        
        $settings = $this->Setting->get();

        return $this->renderViewAdmin($this->folder . __FUNCTION__, ['settings' => $settings]);
    }
}
