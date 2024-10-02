<?php

use Assignment\Php2News\Controllers\Client\HomeController;
use Assignment\Php2News\Controllers\Client\AuthController;
use Assignment\Php2News\Controllers\Client\DetailCategoryController;
use Assignment\Php2News\Controllers\Client\DetailPostController;
use Assignment\Php2News\Controllers\Client\ProfileController;

// Check login to /profile
$router->before('GET|POST', '/profile/*.*', function() {
    
    if (!isset($_SESSION['user'])) {
        $thongbao = "You cannot access that link";
        header("Location: /?thongbao=$thongbao");
        die;
    }

});

// Check logined to /auth
$router->before('GET|POST', '/auth(?!/logout)(/*.*)', function() {

    if (isset($_SESSION['user'])) {
        $thongbao = "You cannot access that link";
        header("Location: /?thongbao=$thongbao");
        die;
    }
    
});


// ROUTES CLIENT

$router->get  (              "/"                       ,       HomeController::class              .  "@index");
$router->get  (              "/detail-category/{id}"   ,       DetailCategoryController::class    .  "@index");
$router->match('GET|POST',   "/detail-post/{id}"       ,       DetailPostController::class        .  "@index");
// $router->get  (              "/detail-post/add{id}"    ,       DetailPostController::class        .  "@addComment");
$router->get  (              "/profile"                ,       ProfileController::class           .  "@index");
$router->match("GET|POST",   "/profile/edit"           ,       ProfileController::class           .  "@edit");

$router->mount( "/auth"              ,       function () use ($router) {

    $router->match('GET|POST'   ,   "/"                 ,       AuthController::class    .  "@logIn");
    $router->match('GET|POST'   ,   "/sign-up"          ,       AuthController::class    .  "@signUp");
    $router->match('GET|POST'   ,   "/forgot-password"  ,       AuthController::class    .  "@forgotPassword");
    $router->match('GET|POST'   ,   "/reset-password"   ,       AuthController::class    .  "@resetPassword");
    $router->get  (                 "/confirm-token"    ,       AuthController::class    .  "@confirmToken");
    $router->get  (                 "/logout"           ,       AuthController::class    .  "@logout");

});