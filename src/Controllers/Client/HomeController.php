<?php

namespace Assignment\Php2News\Controllers\Client;

use Assignment\Php2News\Commons\Controller;
use Assignment\Php2News\Commons\Helper;
use Assignment\Php2News\Models\Posts;

class HomeController extends Controller
{

    private Posts $posts;

    public function __construct()
    {
        $this->posts = new Posts;
    }

    public function index()
    {

        $top3HotOnSocial = $this->posts->getTopByType(3, 3);
        
        $top2Hot = $this->posts->getTopByType(2, 2);

        $newsOfTheDay = array_chunk($this->posts->getAllCurrentDate(), 5);

        $top9NewPopular = $this->posts->getTopNewPopuler(9);
        
        return $this->renderViewClient(
            'home',
            [
                'top3HotOnSocial' => $top3HotOnSocial,
                'top2Hot' => $top2Hot,
                'newsOfTheDay' => $newsOfTheDay,
                'top9NewPopular' => $top9NewPopular
            ]
        );
    }

}
