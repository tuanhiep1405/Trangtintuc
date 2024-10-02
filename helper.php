<?php


const BASE_URL_ABSOLUTE = __DIR__;
const PATH_ASSET = __DIR__ . '/assets/';


if (!function_exists('show_upload')) {
    function show_upload($path) {
        return $_ENV['BASE_URL'] . 'assets/' . $path;
    }
}


if (!function_exists('url')) {
    function url($uri) {
        return $_ENV . $uri;
    }
}


if (!function_exists('debug')) {

    // Hàm debug: hiển thị ra dữ liệu và die luôn

    function debug($data) {
        echo "<pre>";

        print_r($data);

        die;
    }
}