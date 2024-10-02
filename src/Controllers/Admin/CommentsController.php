<?php

namespace Assignment\Php2News\Controllers\Admin;
use Assignment\Php2News\Commons\Helper;
use Assignment\Php2News\Commons\Controller;
use Assignment\Php2News\Models\Categories;
use Assignment\Php2News\Models\Comments;
use Assignment\Php2News\Models\Posts;
use Assignment\Php2News\Models\ReplyComment;

class CommentsController extends Controller
{
    private string $folder = 'pages.comments.';

    private Comments $comment;
    private ReplyComment $replyComment;
    private Posts $posts;
    private Categories $categories;

    public function __construct()
    {
        $this->comment = new Comments;
        $this->replyComment = new ReplyComment;
        $this->posts = new Posts;
        $this->categories = new Categories;
    }


    public function index($status = 1)
    {
       
        $page = $_GET['page'] ?? 1;
        $perPage = $_GET['per-page'] ?? 5;
        $idCategorySelected = $_GET['id_category'] ?? NULL;
        $search = $_GET['search'] ?? NULL;

        $categories = $this->categories->getAll('*');
        

        [$posts, $totalPage] = $this->posts->getAllByPaginate(
            $status,
            ['p.id', 'p.title', 'image', 'u.name userName', 'c.nameCategory', 't.name typeName'],
            $page,
            $perPage,
            $idCategorySelected,
            $search
        );

        return $this->renderViewAdmin($this->folder . __FUNCTION__, [
            'categories' => $categories,
            'idCategorySelected' => $idCategorySelected,
            'posts' => $posts,
            'totalPage' => $totalPage,
            'page' => $page,
            'perPage' => $perPage,
            'search' => $search
        ]);
    }

    // Comments List
    public function list($idPost)
    {   
        if(isset($_POST['btn-delete-comment'])) {

            try {

                $this->replyComment->deleteByIDComment($_POST['btn-delete-comment']);
    
                $this->comment->deleteByID($_POST['btn-delete-comment']);
    
                $_SESSION['notify']['success'][] = "Deleted Comment !";
    
            } catch (\Throwable $e) {
    
                $_SESSION['notify']['danger'][] = $e->getMessage();
            }
            
        }
       
        $comments = $this->comment->getCommentsByIDPost($idPost);
        // debug($comments);
        // debug($comments);
        return $this->renderViewAdmin(
            $this->folder . __FUNCTION__, 
            [
                'comments' => $comments,
                'idPost' => $idPost
            ]
        );
    }

    // Comments Detail Comment
    public function detailComment($idPost, $idComment)
    {

        if(isset($_POST['btn-delete-reply'])) {
            try {

                $this->replyComment->deleteByID($_POST['btn-delete-reply']);
    
                $_SESSION['notify']['success'][] = "Deleted Reply Comment !";
    
            } catch (\Throwable $e) {
    
                $_SESSION['notify']['danger'][] = $e->getMessage();
            }
        }

        $detail = $this->replyComment->getReplyCommentByIDComment($idComment);
        // debug($detail);
        return $this->renderViewAdmin(
            $this->folder . 'detail-comment',
            [
                'detail' => $detail,
                'idPost' => $idPost
            ]
        );
    }
    
}
