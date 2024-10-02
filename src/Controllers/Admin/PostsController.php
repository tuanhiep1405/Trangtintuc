<?php

namespace Assignment\Php2News\Controllers\Admin;

use Assignment\Php2News\Commons\Controller;
use Assignment\Php2News\Models\Categories;
use Assignment\Php2News\Models\Posts;
use Assignment\Php2News\Models\Type;
use Assignment\Php2News\Models\User;
use Rakit\Validation\Validator;

class PostsController extends Controller
{
    private string $folder = 'pages.posts.';

    private Posts $post;
    private Categories $categories;

    public function __construct()
    {
        $this->post = new Posts();
        $this->categories = new Categories();
    }
    // Posts List
    public function list($status = 1)
    {
        
        $page = $_GET['page'] ?? 1;
        $perPage = $_GET['per-page'] ?? 5;
        $idCategorySelected = $_GET['id_category'] ?? NULL;
        $search = $_GET['search'] ?? NULL;

        $categories = $this->categories->getAll('*');

        [$posts, $totalPage] = $this->post->getAllByPaginate(
            $status,
            ['p.id', 'p.title', 'image', 'u.name userName', 'c.nameCategory', 't.name typeName'],
            $page,
            $perPage,
            $idCategorySelected,
            $search
        );

        return $this->renderViewAdmin(
            $this->folder . __FUNCTION__,
            [
                'categories' => $categories,
                'idCategorySelected' => $idCategorySelected,
                'posts' => $posts,
                'totalPage' => $totalPage,
                'page' => $page,
                'perPage' => $perPage,
                'search' => $search
            ]
        );
    }

    // Posts Add  
    public function add()
    {
        if (isset($_POST['btn-add'])) {
            // Validato
            $validator = new Validator();
            $validation = $validator->make($_POST + $_FILES, [
                'title'         => 'required|min:3', // Tối thiểu 3 kí tự
                'description'   => 'required|min:5', // Tối thiểu 5 kí tự
                'content'       => 'required|min:10', // Tối thiểu 10
                'image'         => 'required|uploaded_file:0,2048K,png,jpeg,jpg', //tệp tải lên, max 2MB,....
                'idCategory'    => 'numeric',
                'idType'        => 'numeric',
            ]);
            $validation->validate();
            if ($validation->fails()) {
                $_SESSION['notify']['danger'] = $validation->errors()->firstOfAll();
                // Helper::debug(firstOfAll());
            } else {
                $data = [
                    'title'        =>  $_POST['title'],
                    'description'  => $_POST['description'],
                    'content'      =>  $_POST['content'],
                    'idAuthor'     =>  $_SESSION['user']['id'],
                    'idCategory'   =>  $_POST['idCategory'],
                    'idType'       =>  $_POST['idType'],
                    'status'       => 1,
                    'dateChange' => date('Y-m-d H:i:s', time())
                ];
                if (!empty($_FILES['image']) && $_FILES['image']['size'] > 0) {

                    $from = $_FILES['image']['tmp_name'];
                    $to = 'uploads/users/' . uniqid() . time() . $_FILES['image']['name'];

                    if (move_uploaded_file($from, PATH_ASSET . $to)) {
                        $data['image'] = $to;
                    }
                }
                $this->post->addPost($data);
                $_SESSION['notify']['success'][] = 'Add successful';
                header("Location: /admin/posts");
                die;
            }
        }
        // debug($_SESSION);
        $users = new User();
        $user = $users->getByStatus([2], ['id', 'name']);

        // lấy dữ liệu category
        $cates = new Categories();
        $cate  = $cates->getAll('*');

        // lấy dữ liệu type
        $types = new Type();
        $type  = $types->getAll('*');
        return $this->renderViewAdmin($this->folder . __FUNCTION__, [
            'cate' => $cate,
            'type' => $type,
            'user' => $user,
        ]);
    }

    // Posts Detail luminate\Http\Request
    public function detail($id)
    {
        //User
        $users = new User();
        $user = $users->getByStatus([2], ['id', 'name']);

        //Category
        $cates = new Categories();
        $cate = $cates->getAll('*');

        // $detailPost = new Post();
        $data = $this->post->getByIDDetail($id, 'p.id', 'p.title', 'description', 'image', 'idAuthor', 'p.content', 'u.name userName', 'c.nameCategory', 'c.id idCategory', 't.name typeName', 't.id idType');   // lưu ý thứ tự truyền vào tham số

        $types = new Type();
        $type = $types->getAll('*');
        // echo __CLASS__ . '@' . __FUNCTION__ . ' - ID = ' . $id;
        // Helper::debug($data);
        return $this->renderViewAdmin($this->folder . __FUNCTION__, [
            'user' => $user,
            'data' => $data,
            'cate' => $cate,
            'type' => $type
        ]);
    }

    // Posts Edit
    public function edit($id)
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] ==  'POST') {

            // Validato
            $validator = new Validator();
            $validation = $validator->make($_POST + $_FILES, [
                'title'         => 'required|min:3', // Tối thiểu 3 kí tự
                'description'   =>  'required|min:5',
                'content'       => 'required|min:10', // Tối thiểu 10
                'image'         => 'uploaded_file:0,2048K,png,jpeg,jpg', //tệp tải lên, max 2MB,....
                'idCategory'    => 'numeric',
                'idType'        => 'numeric',
            ]);
            $validation->validate();
            if ($validation->fails()) {
                $_SESSION['notify']['danger'] = $validation->errors()->firstOfAll();
                // header("Location: /admin/posts/edit/$id");
                // exit;
            } else {
                $data = [
                    'title'        =>  $_POST['title'],
                    'description'  =>  $_POST['description'],
                    'content'      =>  $_POST['content'],
                    'idAuthor'     =>  $_SESSION['user']['id'],
                    'idCategory'   =>  $_POST['idCategory'],
                    'idType'       =>  $_POST['idType'],
                    'status'       => 1,
                    'dateChange' => date('Y-m-d H:i:s', time())

                ];
                if (!empty($_FILES['image']) && $_FILES['image']['size'] > 0) {

                    $from = $_FILES['image']['tmp_name'];
                    $to = 'uploads/users/' . uniqid() . time() . $_FILES['image']['name'];

                    if (move_uploaded_file($from, PATH_ASSET . $to)) {
                        $data['image'] = $to;
                    }
                }
                $this->post->update($id, $data);
                $_SESSION['notify']['success'][] = 'Update successful';
                header("Location: /admin/posts");
                die;
            }
        }
        //user
        $users = new User();
        $user = $users->getByStatus([2], ['id', 'name']);

        // lấy dữ liệu category
        $cates = new Categories();
        $cate = $cates->getAll('*');

        // lấy dữ liệu chi tiết
        $data = $this->post->getByIDDetail($id, 'p.id', 'p.title', 'description', 'image', 'idAuthor', 'p.content', 'u.name userName', 'c.nameCategory', 'c.id idCategory', 't.name typeName', 't.id idType');   // lưu ý thứ tự truyền vào tham số

        // lấy dữ liệu type
        $types = new Type();
        $type = $types->getAll('*');
        // debug($data);

        return $this->renderViewAdmin($this->folder . __FUNCTION__, [
            'user' => $user,
            'cate' => $cate,
            'type' => $type,
            'data' => $data
        ]);
    }

    // Posts Hiden
    public function hide($id)
    {
        try {
            $this->post->update(
                $id,
                [
                    'status' => '0',
                    'dateChange' => date('Y-m-d H:i:s', time())
                ]
            );
            $_SESSION['notify']['success'][] = 'Successfully hidden';
        } catch (\Throwable $e) {
            $_SESSION['notify']['danger'][] = $e->getMessage();
        }
        header('Location: /admin/posts');
        die;
    }

    // Posts Show
    public function show($id)
    {
        try {
            $this->post->update(
                $id,
                [
                    'status' => '1',
                    'dateChange' => date('Y-m-d H:i:s', time())
                ]
            );
            $_SESSION['notify']['success'][] = 'Displayed successfully';
        } catch (\Throwable $th) {
            $_SESSION['notify']['danger'][] = $th->getMessage();
        }


        header('Location: /admin/posts/list-hide');
        die;
    }

    // Posts Delete
    public function delete($id)
    {
        try {
            $this->post->deletePost($id);
            $_SESSION['notify']['success'][] = 'Deleted successfully';
        } catch (\Throwable $th) {
            $_SESSION['notify']['danger'][] = $th->getMessage();
        }


        header('Location: /admin/posts/list-hide');
        die;
    }

    // Posts List Hiden
    public function listHide($status = 0)
    {

        $page = $_GET['page'] ?? 1;
        $perPage = $_GET['per-page'] ?? 5;
        $idCategorySelected = $_GET['id_category'] ?? NULL;
        $search = $_GET['search'] ?? NULL;

        $categories = $this->categories->getAll('*');

        [$posts, $totalPage] = $this->post->getAllByPaginate(
            $status,
            ['p.id', 'p.title', 'image', 'u.name userName', 'c.nameCategory', 't.name typeName'],
            $page,
            $perPage,
            $idCategorySelected,
            $search
        );


        return $this->renderViewAdmin(
            $this->folder . 'list-hide',
            [
                'categories' => $categories,
                'idCategorySelected' => $idCategorySelected,
                'posts' => $posts,
                'totalPage' => $totalPage,
                'page' => $page,
                'perPage' => $perPage,
                'search' => $search
            ]
        );
    }
}
