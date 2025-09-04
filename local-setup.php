<?php
/**
 * ローカル開発環境セットアップ確認スクリプト
 * DiscoverFeed.net WordPress Local Development Setup
 */

echo "<h1>DiscoverFeed.net - ローカル開発環境確認</h1>";

// データベース接続確認
echo "<h2>データベース接続確認</h2>";
try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=discoverfeed_local;charset=utf8',
        'wpuser_local',
        'local_password'
    );
    echo "<p style='color: green;'>✓ データベース接続成功</p>";
    
    // テーブル一覧表示
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "<p>テーブル数: " . count($tables) . "</p>";
    
    if (count($tables) > 0) {
        echo "<details><summary>テーブル一覧</summary><ul>";
        foreach ($tables as $table) {
            echo "<li>$table</li>";
        }
        echo "</ul></details>";
    }
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>✗ データベース接続エラー: " . $e->getMessage() . "</p>";
}

// WordPressディレクトリ確認
echo "<h2>WordPressファイル確認</h2>";
$wp_files = [
    'wordpress/index.php',
    'wordpress/wp-config.php',
    'wordpress/wp-load.php',
    'wordpress/wp-admin/index.php',
    'wordpress/wp-content/themes/',
    'wordpress/wp-content/plugins/',
    'wordpress/wp-content/uploads/'
];

foreach ($wp_files as $file) {
    $full_path = __DIR__ . '/' . $file;
    if (file_exists($full_path)) {
        echo "<p style='color: green;'>✓ $file 存在</p>";
        if (is_dir($full_path)) {
            $count = count(scandir($full_path)) - 2; // . と .. を除く
            echo "<p style='margin-left: 20px;'>└ 項目数: $count</p>";
        }
    } else {
        echo "<p style='color: red;'>✗ $file 見つかりません</p>";
    }
}

// PHP設定確認
echo "<h2>PHP設定確認</h2>";
echo "<p>PHP バージョン: " . phpversion() . "</p>";
echo "<p>メモリ制限: " . ini_get('memory_limit') . "</p>";
echo "<p>最大アップロードサイズ: " . ini_get('upload_max_filesize') . "</p>";
echo "<p>最大POSTサイズ: " . ini_get('post_max_size') . "</p>";
echo "<p>タイムゾーン: " . date_default_timezone_get() . "</p>";

// 拡張モジュール確認
$required_extensions = ['mysql', 'mysqli', 'pdo_mysql', 'gd', 'curl', 'mbstring'];
echo "<h3>必要な拡張モジュール</h3>";
foreach ($required_extensions as $ext) {
    if (extension_loaded($ext)) {
        echo "<p style='color: green;'>✓ $ext</p>";
    } else {
        echo "<p style='color: red;'>✗ $ext</p>";
    }
}

// 権限確認
echo "<h2>ディレクトリ権限確認</h2>";
$dirs_to_check = [
    'wordpress/wp-content/',
    'wordpress/wp-content/themes/',
    'wordpress/wp-content/plugins/',
    'wordpress/wp-content/uploads/'
];

foreach ($dirs_to_check as $dir) {
    $full_path = __DIR__ . '/' . $dir;
    if (is_dir($full_path)) {
        $perms = substr(sprintf('%o', fileperms($full_path)), -4);
        $writable = is_writable($full_path) ? '書き込み可' : '書き込み不可';
        echo "<p>$dir - 権限: $perms ($writable)</p>";
    }
}

echo "<hr>";
echo "<p><strong>推奨アクション:</strong></p>";
echo "<ul>";
echo "<li>ローカルサーバーを起動: <code>php -S localhost:8080 -t wordpress/</code></li>";
echo "<li>ブラウザでアクセス: <a href='http://localhost:8080' target='_blank'>http://localhost:8080</a></li>";
echo "<li>管理画面: <a href='http://localhost:8080/wp-admin/' target='_blank'>http://localhost:8080/wp-admin/</a></li>";
echo "</ul>";
?>
