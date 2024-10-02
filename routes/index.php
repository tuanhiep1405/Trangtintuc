<?php

use Bramus\Router\Router;
use Assignment\Php2News\Commons\View;

// CREATE ROUTER INSTANCE
$router = new Router();



// SET UP
$router->set404(View::class . '@e404');



// DEFINE ROUTES

// Routes Admin
require_once __DIR__ . "/client.php";
// Routes Client
require_once __DIR__ . "/admin.php";



// RUN IT!
$router->run();
