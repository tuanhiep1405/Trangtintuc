<?php

session_start();

date_default_timezone_set('Asia/Ho_Chi_Minh');

require_once __DIR__ . "/vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__)->load();

$_SESSION['settings'] = (new Assignment\Php2News\Models\Settings)->get();

require_once __DIR__ . "/routes/index.php";
