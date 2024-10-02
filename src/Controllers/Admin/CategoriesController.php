<?php

namespace Assignment\Php2News\Controllers\Admin;

use Assignment\Php2News\Commons\Controller;
use Assignment\Php2News\Commons\Helper;
use Assignment\Php2News\Models\Categories;

class CategoriesController extends Controller
{
    private string $folder = 'pages.categories.';
    private Categories $categories;

    public function __construct()
    {
        $this->categories = new Categories;
    }
    // Categories List
    public function list()
    {
        // Categories Add
        if (isset($_POST['btn-add'])) {
            if (empty($_POST['nameCategory'])) {
                $_SESSION['notify']['danger'][] = "Vui lòng nhập dữ liệu cho trường Name Category !";
            } else {
                try {
                    $this->categories->add($_POST['nameCategory']);
                    $_SESSION['notify']['success'][] = "Đã thêm danh mục mới {$_POST['nameCategory']}!";
                } catch (\Throwable $e) {
                    $_SESSION['notify']['danger'][] = $e->getMessage();
                }
            }
        }


        // Categories List
        $category = $this->categories->getByStatus(1);
        // Helper::debug($cate);
        return $this->renderViewAdmin($this->folder . __FUNCTION__, ['categories' => $category]);
    }

    // Categories Edit
    public function edit($id)
    {

        if (isset($_POST['btn-edit'])) {
            if (empty($_POST['nameCategory'])) {
                $_SESSION['notify']['danger'][] = "Please enter name category";
            } else {
                $categories = $this->categories->getByID($id, ['id', 'nameCategory', 'status']);
                if ($categories['nameCategory'] !== (string)$_POST['nameCategory']) {
                    try {
                        $this->categories->updateName(
                            $id,
                            [
                                'nameCategory' => $_POST['nameCategory']
                            ]
                        );
                        $_SESSION['notify']['success'][] = "Updated !";
                    } catch (\Throwable $e) {
                        $_SESSION['notify']['danger'][] = $e->getMessage();
                    }
                } else {
                    $_SESSION['notify']['warning'][] = "No changes";
                }
            }
        }
        $category = $this->categories->getByID($id, ['id', 'nameCategory']);
        return $this->renderViewAdmin(
            $this->folder . __FUNCTION__,
            [
                'category' => $category
            ]
        );
    }

    // Categories Hiden
    public function hide($id)
    {
        $categories = $this->categories->getByID($id, ['id', 'nameCategory']);

        try {

            // Cập nhật trạng thái categories
            $this->categories->updateStatus(
                $categories['id'],
                [
                    'status'      =>    0
                ]
            );

            // tạo thông báo thành công
            $_SESSION['notify']['success'][] = "Hidden {$categories['nameCategory']} !";
        } catch (\Throwable $e) {

            // tạo thông báo error
            $_SESSION['notify']['danger'][] = $e->getMessage();
        }

        header('Location: /admin/categories');
        die;
    }

    // Categories Show
    public function show($id)
    {
        $cateHide = $this->categories->getByID($id, ['id', 'nameCategory']);

        try {

            // Cập nhật trạng thái categories
            $this->categories->updateStatus(
                $cateHide['id'],
                [
                    'status'      =>    1
                ]
            );

            // tạo thông báo thành công
            $_SESSION['notify']['success'][] = "Showed {$cateHide['nameCategory']} !";
        } catch (\Throwable $e) {

            // tạo thông báo error
            $_SESSION['notify']['danger'][] = $e->getMessage();
        }

        header('Location: /admin/categories/list-hide');
        die;
    }

    // Categories Delete
    public function delete($id)
    {
        $categories = $this->categories->getByID($id, ['id', 'nameCategory']);
        try {
            $this->categories->delete($categories['id']);
            $_SESSION['notify']['success'][] = "Deleted {$categories['nameCategory']} !";
        } catch (\Throwable $e) {
            $_SESSION['notify']['danger'][] = $e->getMessage();
        }
        header('location: /admin/categories/list-hide');
        die;
    }

    // Categories List Hiden
    public function listHide()
    {
        $cateHide = $this->categories->getByStatus(0);
        if (empty($cateHide)) {
            $message = "Không có dữ liệu.";
            return $this->renderViewAdmin($this->folder . 'list-hide', ['message' => $message]);
        }
        return $this->renderViewAdmin($this->folder . 'list-hide', ['cateHide' => $cateHide]);
    }
}
