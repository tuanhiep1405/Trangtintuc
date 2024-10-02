<?php

namespace Assignment\Php2News\Controllers\Client;

use Assignment\Php2News\Commons\Controller;
use Assignment\Php2News\Models\Comments;
use Assignment\Php2News\Models\Posts;
use Assignment\Php2News\Models\ReplyComment;
use Assignment\Php2News\Models\TagPosts;

class DetailPostController extends Controller
{
    private Posts $posts;
    private Comments $comments;
    private TagPosts $tagPosts;
    private ReplyComment $replyComment;

    public function __construct()
    {
        $this->posts = new Posts;
        $this->comments = new Comments;
        $this->tagPosts = new TagPosts;
        $this->replyComment = new ReplyComment;
    }

    public function index($id)
    {


        //insert comment 
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] ==  'POST') {

            $id = $_POST['idPost'];

            if (!isset($_SESSION['user'])) {
                $_SESSION['notify']['danger'][] = 'You need to log in to comment';
            } else {
                try {   
                    if (isset($_POST['replyContent']) && !empty($_POST['replyContent'])) {
                        // debug()
                        $this->replyComment->addReply([
                            'content'       =>   $_POST['replyContent'],
                            'idUser'        =>   $_SESSION['user']['id'],
                            'idReplyUser'   =>   $_POST['idReplyUser'],
                            'idComment'     =>   $_POST['idComment'],
                        ]);
                        $_SESSION['notify']['success'][] = 'Comment successful';
                    } elseif (isset($_POST['content']) && !empty($_POST['content'])) {
                        $this->comments->addComment([
                            'content'  =>   $_POST['content'],
                            'idUser'   =>   $_SESSION['user']['id'],
                            'idPost'   =>   $id,
                        ]);
                        $_SESSION['notify']['success'][] = 'Comment successful';
                    } else {
                        $_SESSION['notify']['danger'][] = 'Comments are empty';
                    }                    
                } catch (\Throwable $e) {
                    $_SESSION['notify']['danger'][] = 'Comments are empty';
                    // $_SESSION['notify']['danger']  = $e->getMessage();
                }
            }
        }
       
        // Lấy tin tức theo id
        $post = $this->posts->getByID($id);

        // Update views tin tức
        $this->posts->update($id, ['views' => ((int)$post['views'] + 1)]);

        // Lấy ra tổng comments trong bài viết và gán thêm vào $post
        $post['totalCommentInPost'] = $this->comments->getAllCommentByIDPost($id);
        // $comment = $this->comments->getAllCommentByIDPost($id);

        $commentsA = $this->comments->getAllByIdPost($id);
        // debug($commentA);

        foreach ($commentsA as $key => $commentA) {

            $commentsA[$key]['totalReply'] = $this->replyComment->getReplyCommentByIDComment($commentA['id']);
        }
        // debug($commentsA);

        // Lấy tất cả tags trong post
        $tagsInPost = $this->tagPosts->getAllTagByIDPost($id);

        // Lấy top 10 tin tức phổ biến
        $topPostPopular = $this->posts->getTopNewPopuler(10);

        // Lấy những bài viết liên quan
        $relatedPosts = $this->posts->getAllByIDCategory($post['idCategory']);

        $relatedPostsExceptThisPost = array_filter($relatedPosts, fn ($post) => $post['id'] !== (int)$id);

        return $this->renderViewClient(
            'pages.detail-post',
            [
                'post' => $post,
                'tagsInPost' => $tagsInPost,
                'topPostPopular' => $topPostPopular,
                'relatedPostsExceptThisPost' => $relatedPostsExceptThisPost,
                'commentsA' => $commentsA,
                // 'commentB'=>  $commentB,
            ]
        );
    }
}
