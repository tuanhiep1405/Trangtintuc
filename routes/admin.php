<?php

use Assignment\Php2News\Controllers\Admin\DashboardController;
use Assignment\Php2News\Controllers\Admin\CategoriesController;
use Assignment\Php2News\Controllers\Admin\CommentsController;
use Assignment\Php2News\Controllers\Admin\PostsController;
use Assignment\Php2News\Controllers\Admin\ProfileController;
use Assignment\Php2News\Controllers\Admin\SettingsController;
use Assignment\Php2News\Controllers\Admin\TagsController;
use Assignment\Php2News\Controllers\Admin\UsersController;

// Check login to /admin
$router->before('GET|POST', '/admin/*.*', function() {

    if (!isset($_SESSION['user'])) {
        $thongbao = "You need to login to admin";
        header("Location: /auth/?thongbao=$thongbao");
        die;
    }

    if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 0) {
        $thongbao = "You do not have access to admin";
        header("Location: /?thongbao=$thongbao");
        die;
    }

});


// ROUTES ADMIN

$router->mount('/admin', function () use ($router) {

    // DASHBOARD
    $router->get(  '/'          , DashboardController::class . '@dashboard');

    // SETTINGS
    $router->mount('/settings'  , function () use ($router) {

        // Settings index
        $router->get    (               '/'                 ,       SettingsController::class       .   '@index');

        // Settings Edit
        $router->match  ('GET|POST',    '/edit'             ,       SettingsController::class       .   '@edit');
        
    });

    // PROFILE
    $router->mount('/profile'   , function () use ($router) {

        // Profile index
        $router->get    (               '/'                 ,       ProfileController::class        .   '@index');

        // Profile Edit
        $router->match  ('GET|POST',    '/edit'             ,       ProfileController::class        .   '@edit');
        
    });

    // CATEGORIES
    $router->mount('/categories', function () use ($router) {

        // Categories List
        $router->match  ('GET|POST',    '/'                 ,       CategoriesController::class     .   '@list');

        // Categories Edit
        $router->match  ('GET|POST',    '/edit/{id}'        ,       CategoriesController::class     .   '@edit');

        // Categories Hide
        $router->get    (               '/hide/{id}'        ,       CategoriesController::class     .   '@hide');

        // Categories Show
        $router->get    (               '/show/{id}'        ,       CategoriesController::class     .   '@show');

        // Categories Delete
        $router->get    (               '/delete/{id}'      ,       CategoriesController::class     .   '@delete');

        // Categories List Hide
        $router->get    (               '/list-hide'        ,       CategoriesController::class     .   '@listHide');

    });

    // TAGS
    // TAGS
    $router->mount('/tags'      , function () use ($router) {

        // Tags List
        $router->match  ('GET|POST',    '/'                 ,       TagsController::class           .   '@list');

        // Tags Edit
        $router->match  ('GET|POST',    '/edit/{id}'             ,       TagsController::class           .   '@edit');

        // Tags Hide
        $router->get    (               '/hide/{id}'     ,       TagsController::class          .   '@hide');

        // Tags Show
        $router->get    (               '/show/{id}'      ,       TagsController::class          .   '@show');

        // Tags Delete
        $router->get    (               '/delete/{id}'           ,       TagsController::class           .   '@delete');

        // Tags List Hide
        $router->get    (               '/list-hide'        ,       TagsController::class           .   '@listHide');
   
    });

    // POSTS
    $router->mount('/posts'     , function () use ($router) {

        // Posts List
        $router->match  ('GET|POST',    '/'         ,       PostsController::class          .   '@list');

        // Posts Add
        $router->match  ('GET|POST',    '/add'              ,       PostsController::class          .   '@add');
        
        // Posts Detail
        $router->match  ('GET|POST',    '/detail/{id}'      ,       PostsController::class          .   '@detail');

        // Posts Edit
        $router->match  ('GET|POST',    '/edit/{id}'        ,       PostsController::class          .   '@edit');

        // Posts Hide
        $router->get    (                '/hide/{id}'       ,       PostsController::class          .   '@hide');

        // Posts Show
        $router->get    (               '/show/{id}'         ,       PostsController::class          .   '@show');

        // Posts Delete
        $router->get    (               '/delete/{id}'       ,       PostsController::class          .   '@delete');
 
        // Posts List Hide
        $router->get    (               '/list-hide'         ,       PostsController::class          .   '@listHide');
   
    });

    // USERS
    $router->mount('/users'     , function () use ($router) {

        // Users List

        $router->match  ('GET|POST',    '/'                         ,       UsersController::class          .   '@list');

        // Users Restore Password
        $router->get    (               '/restore-password/{id}'    ,       UsersController::class          .   '@restorePassword');

        // Users Edit
        $router->match  ('GET|POST',    '/edit/{id}'                ,       UsersController::class          .   '@edit');

        // Users lock
        $router->get    (               '/lock/{id}'                ,       UsersController::class          .   '@lock');

        // Users Unlock
        $router->get    (               '/unlock/{id}'              ,       UsersController::class          .   '@unlock');

        // Users List lock
        $router->get    (               '/list-lock'                ,       UsersController::class          .   '@listLock');
   
    });

    // COMMENTS
    $router->mount('/comments'  , function () use ($router) {
        
        // Preview Comments List
        $router->match  ('GET|POST',    '/'                 ,       CommentsController::class       .   '@index');

        // Comments List
        $router->match  ('GET|POST',    '/list/{id}'                 ,       CommentsController::class       .   '@list');

        // Comments Detail Comment
        $router->match  ('GET|POST',    '/detail-comment/{idPost}/{idComment}'   ,       CommentsController::class       .   '@detailComment');
   
    });

});
