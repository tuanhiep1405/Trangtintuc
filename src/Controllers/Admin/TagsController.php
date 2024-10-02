<?php

namespace Assignment\Php2News\Controllers\Admin;

use Assignment\Php2News\Commons\Controller;
use Assignment\Php2News\Commons\Helper;
use Assignment\Php2News\Models\Tags;

class TagsController extends Controller
{
    private string $folder = 'pages.tags.';

    private Tags $tags;

    public function __construct()
    {
        $this->tags = new Tags();
    }
    // Tags List
    public function list()
    {

        if (isset($_POST['btn-add'])) {

            try {
                if (empty($_POST['nameTag'])) {
                    $_SESSION['notify']['danger'][] = "Please enter name Tags";
                } else {
                    $this->tags->insert($_POST['nameTag']);
                    $_SESSION['notify']['success'][] = "Đã thêm danh mục mới {$_POST['nameTag']}!";
                }
            } catch (\Throwable $e) {
                $_SESSION['notify']['danger'][] = $e->getMessage();
            }
        }

        //getByStatusPaginate
        $page = $_GET['page'] ?? 1;
        $perPage = $_GET['per-page'] ?? 5;
        $search = $_GET['search'] ?? NULL;

        // tags List
        [$tags, $totalPage] = $this->tags->getByStatusPaginate(1, $page, $perPage, $search);

        // debug($tags);

        return $this->renderViewAdmin(
            $this->folder . 'list',
            [
                'tags' => $tags,
                'totalPage' => $totalPage,
                'page' => $page,
                'perPage' => $perPage,
                'search' => $search
            ]
        );
    }

    // Tags Edit
    public function edit($id)
    {
        if (isset($_POST['btn-edit'])) {
            if (empty($_POST['nameTag'])) {
                $_SESSION['notify']['danger'][] = "Please enter name Tags";
            } else {
                $tags = $this->tags->getByID($id, ['id', 'nameTag', 'status']);
                if ($tags['nameTag'] !== (string)$_POST['nameTag']) {
                    try {
                        $this->tags->updateName(
                            $id,
                            [
                                'nameTag' => $_POST['nameTag']
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
        $tags = $this->tags->getByID($id, ['id', 'nameTag']);
        return $this->renderViewAdmin(
            $this->folder . __FUNCTION__,
            ['tags' => $tags]
        );
    }

    // Tags Hiden
    public function hide($id)
    {

        // HIDE code...
        try {
            
            $this->tags->getShow($id, ['status' => '0']);

            $_SESSION['notify']['success'][] = "Hide nameTag !";
        } catch (\Throwable $e) {
            $_SESSION['notify']['danger'][] = $e->getMessage();
        }
        $data = $this->tags->getAll('*');
        return $this->renderViewAdmin($this->folder . 'list', ['data' => $data]);
    }

    // Tags Show
    public function show($id)
    {
        try {
            $this->tags->getShow($id, ['status' => '1']);

            $_SESSION['notify']['success'][] = "Showed nameTag !";
        } catch (\Throwable $e) {
            $_SESSION['notify']['danger'][] = $e->getMessage();
        }
        $data = $this->tags->getAllHide('*');
        return $this->renderViewAdmin($this->folder . 'list-hide', ['data' => $data]);
    }

    // Tags Delete
    public function delete($id)
    {


        $tags = $this->tags->getByID($id, ['id', 'nameTag']);
        try {
            $this->tags->delete($tags['id']);
            $_SESSION['notify']['success'][] = "Deleted {$tags['nameTag']} !";
        } catch (\Throwable $e) {
            $_SESSION['notify']['danger'][] = $e->getMessage();
        }
        header('location: /admin/tags/list-hide');
        die;
    }

    // Tags List Hiden
    public function listHide()
    {
        $page = $_GET['page'] ?? 1;
        $perPage = $_GET['per-page'] ?? 5;
        $search = $_GET['search'] ?? NULL;


        [$tagsHide, $totalPage] = $this->tags->getByStatusPaginate(
            0,
            $page,
            $perPage,
            $search
        );

        return $this->renderViewAdmin(
            $this->folder . 'list-hide',
            [
                'tagsHide' => $tagsHide,
                'totalPage' => $totalPage,
                'page' => $page,
                'perPage' => $perPage,
                'search' => $search
            ]
        );
    }
}
