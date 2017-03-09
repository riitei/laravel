<?php
//
///**
// * Laravel - A PHP Framework For Web Artisans
// *
// * @package  Laravel
// * @author   Taylor Otwell <taylor@laravel.com>
// */
//
//$uri = urldecode(
//    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
//);
//
//// This file allows us to emulate Apache's "mod_rewrite" functionality from the
//// built-in PHP web server. This provides a convenient way to test a Laravel
//// application without having installed a "real" web server software here.
//if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
//    return false;
//}
//
//require_once __DIR__ . '/public/index.php';

//  如果沒有移動/public/index.php
//  此也面試入口網頁
// 要啟動原生phpsession_start(); 在此撰寫