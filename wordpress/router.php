<?php
/**
 * WordPress PHP Built-in Server Router
 * 
 * このファイルはPHPの内蔵サーバーでWordPressを動作させるためのルーターです。
 */

$root = $_SERVER['DOCUMENT_ROOT'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// 静的ファイルの処理
if (file_exists($root . $path)) {
    if (is_dir($root . $path) && substr($path, -1) !== '/') {
        header('Location: ' . $path . '/');
        exit;
    }
    if (strpos($path, '.') !== false) {
        return false; // PHPの内蔵サーバーに静的ファイルを処理させる
    }
}

// WordPressのindex.phpにリダイレクト
$_SERVER['SCRIPT_FILENAME'] = $root . '/index.php';
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['PHP_SELF'] = '/index.php';

require_once $root . '/index.php';
?>
