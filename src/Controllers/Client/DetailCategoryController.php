<?php

namespace Assignment\Php2News\Controllers\Client;

use Assignment\Php2News\Commons\Controller;
use Assignment\Php2News\Models\Categories;
use Assignment\Php2News\Models\Posts;

class DetailCategoryController extends Controller
{

    private Categories $categories;
    private Posts $posts;

    public function __construct()
    {
        $this->categories = new Categories;
        $this->posts = new Posts;
    }


    public function index($id)
    {
        $page = $_GET['page'] ?? 1;
        $perPage = $_GET['per-page'] ?? 5;

        // Lấy danh mục theo ID
        $category = $this->categories->getByID($id, ['id', 'nameCategory']);
        
        // Lấy các tin tức trong 1 danh mục
        [$postsInCategory, $totalPagePosts] = $this->posts->getAllByIDCategoryPaginate($id, $page, $perPage);

        // Lấy top 5 tin tức phổ biến
        $topPostPopular = $this->posts->getTopNewPopuler(5);
        
        return $this->renderViewClient(
            'pages.detail-category',
            [
                'category' => $category,
                'postsInCategory' => $postsInCategory,
                'totalPagePosts' => $totalPagePosts,
                'page' => $page,
                'topPostPopular' => $topPostPopular
            ]
        );
    }
}
