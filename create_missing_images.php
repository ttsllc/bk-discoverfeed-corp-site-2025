<?php
/**
 * 不足している画像ファイルのプレースホルダー作成スクリプト
 */

$missing_images = [
    // 2023/08 ディレクトリ
    'wordpress/wp-content/uploads/2023/08/back-top-f1.jpg' => [1920, 1080],
    'wordpress/wp-content/uploads/2023/08/back-top3s.jpg' => [1920, 1080],
    'wordpress/wp-content/uploads/2023/08/bl-2.jpg' => [450, 300],
    'wordpress/wp-content/uploads/2023/08/club-logo-jack-570x360.jpg' => [570, 360],
    'wordpress/wp-content/uploads/2023/08/club-logo-livin-570x360.jpg' => [570, 360],
    'wordpress/wp-content/uploads/2023/08/club-logo-maharaja-570x360.jpg' => [570, 360],
    'wordpress/wp-content/uploads/2023/08/club-logo-muin-570x360.jpg' => [570, 360],
    'wordpress/wp-content/uploads/2023/08/club-logo-octagon-570x360.jpg' => [570, 360],
    'wordpress/wp-content/uploads/2023/08/club-logo-royal-570x360.jpg' => [570, 360],
    'wordpress/wp-content/uploads/2023/08/club-logo-warp-570x360.jpg' => [570, 360],
    'wordpress/wp-content/uploads/2023/08/DF-logo-03.jpg' => [400, 200],
    'wordpress/wp-content/uploads/2023/08/DiscoverFeed-logo-n1.png' => [300, 100],
    'wordpress/wp-content/uploads/2023/08/icon-discord-2.png' => [100, 100],
    'wordpress/wp-content/uploads/2023/08/image_top-slider1.png' => [1200, 800],
    'wordpress/wp-content/uploads/2023/08/image_top-slider1s.png' => [600, 400],
    'wordpress/wp-content/uploads/2023/08/para-pi-1.jpg' => [1450, 1450],
    'wordpress/wp-content/uploads/2023/08/Philip-room001.jpg' => [800, 600],
    'wordpress/wp-content/uploads/2023/08/rlogomark-2.png' => [200, 200],
    'wordpress/wp-content/uploads/2023/08/SHIRO-NAGOYA-s.png' => [400, 200],
    'wordpress/wp-content/uploads/2023/08/SHIRO-NAGOYA.png' => [800, 400],
    
    // 2024/02 ディレクトリ
    'wordpress/wp-content/uploads/2024/02/deepcoin.jpg' => [600, 400],
    'wordpress/wp-content/uploads/2024/02/partnership.jpg' => [600, 400],
    
    // 2024/04 ディレクトリ
    'wordpress/wp-content/uploads/2024/04/1750-1159-ima-2.jpg' => [1750, 1159],
    'wordpress/wp-content/uploads/2024/04/HOUSE-240415.jpg' => [800, 600],
];

function createImagePlaceholder($filepath, $width, $height) {
    $image = imagecreate($width, $height);
    
    // 背景色（薄いグレー）
    $bg_color = imagecolorallocate($image, 245, 245, 245);
    
    // テキスト色（濃いグレー）
    $text_color = imagecolorallocate($image, 100, 100, 100);
    
    // 枠線色
    $border_color = imagecolorallocate($image, 220, 220, 220);
    
    // 背景塗りつぶし
    imagefill($image, 0, 0, $bg_color);
    
    // 枠線描画
    imagerectangle($image, 0, 0, $width-1, $height-1, $border_color);
    
    // ファイル名とサイズのテキスト
    $filename = basename($filepath);
    $text = "PLACEHOLDER\n{$width} x {$height}\n" . pathinfo($filename, PATHINFO_FILENAME);
    
    // テキストサイズを動的に調整
    $font_size = min(12, max(8, $width / 25));
    
    // 中央配置でテキスト描画
    $lines = explode("\n", $text);
    $line_height = $font_size + 2;
    $start_y = ($height - (count($lines) * $line_height)) / 2 + $font_size;
    
    foreach ($lines as $i => $line) {
        $text_width = strlen($line) * ($font_size * 0.6);
        $x = max(5, ($width - $text_width) / 2);
        $y = $start_y + ($i * $line_height);
        imagestring($image, 3, $x, $y, $line, $text_color);
    }
    
    // ディレクトリが存在しない場合は作成
    $dir = dirname($filepath);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    
    // 拡張子に応じて保存
    $extension = strtolower(pathinfo($filepath, PATHINFO_EXTENSION));
    switch ($extension) {
        case 'png':
            imagepng($image, $filepath);
            break;
        case 'gif':
            imagegif($image, $filepath);
            break;
        default:
            imagejpeg($image, $filepath, 85);
    }
    
    imagedestroy($image);
    return file_exists($filepath);
}

echo "不足している画像ファイルのプレースホルダーを作成中...\n\n";

$created = 0;
$skipped = 0;

foreach ($missing_images as $filepath => $dimensions) {
    if (file_exists($filepath)) {
        echo "- スキップ: " . basename($filepath) . " (既存)\n";
        $skipped++;
        continue;
    }
    
    list($width, $height) = $dimensions;
    
    if (createImagePlaceholder($filepath, $width, $height)) {
        echo "✓ 作成: " . basename($filepath) . " ({$width}x{$height})\n";
        $created++;
    } else {
        echo "✗ 失敗: " . basename($filepath) . "\n";
    }
}

echo "\n作成完了: {$created}個, スキップ: {$skipped}個\n";
?>
