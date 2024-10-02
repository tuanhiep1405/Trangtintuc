<?php

namespace Assignment\Php2News\Controllers\Admin;

use Assignment\Php2News\Commons\Controller;
use Assignment\Php2News\Commons\Helper;
use Assignment\Php2News\Models\Categories;
use Assignment\Php2News\Models\Comments;
use Assignment\Php2News\Models\Posts;

class DashboardController extends Controller
{
    private Categories $categories;
    private Posts  $posts;
    private Comments  $comment;

    public function __construct()
    {
        $this->categories = new Categories;
        $this->posts = new Posts;
        $this->comment = new Comments;
    }
    public function dashboard()
    {

        $statisticBy = $_GET['statisticBy'] ?? '7day';

        $dataStatistic = [];

        switch($statisticBy)
        {

            case '7day':
            {
                $dataStatistic = $this->categories->get7DayLastestByView();

                break;
            }

            case '1month':
            {
                $dataStatistic = $this->categories->get1MonthLastestByView();

                break;
            }

            case '6month':
            {
                $dataStatistic = $this->categories->get6MonthLastestByView();

                break;
            }

        }


        $dataStatisticRedo = [];

        for($i = 0; $i < count($dataStatistic[0]); $i++) {
            foreach ($dataStatistic as $element) {
                if($i === 0) {
                    $dataStatisticRedo['date'][] = $element[$i]['date'];
                }
                $dataStatisticRedo['data'][$i][] = (int)$element[$i]['totalPost'] ?? 0;
            }

            if($i === 0) {
                $dataStatisticRedo['date'] = array_reverse($dataStatisticRedo['date']);
            }

            array_push($dataStatisticRedo['data'][$i], $dataStatistic[0][$i]['nameCategory']);
            $dataStatisticRedo['data'][$i] = array_reverse($dataStatisticRedo['data'][$i]);
        }


        $cateSum = $this->categories->categoryNumber();

        $postSum = $this->posts->postSum();

        $postHotSum = $this->posts->postHotSum();

        $commentSum = $this->comment->Commentsum();

        $categoriesAndTotalPost = $this->categories->getAllAndTotalPost();

        $this->renderViewAdmin(__FUNCTION__, [
            "cateSum" => $cateSum,
            "postSum" => $postSum,
            "postHotSum" => $postHotSum,
            "commentSum" => $commentSum,
            'categoriesAndTotalPost' => $categoriesAndTotalPost,
            'dataStatistic' => $dataStatisticRedo,
            'statisticBy' => $statisticBy
        ]);
    }
   
}
