#!/bin/bash

# DiscoverFeed.net WordPress ローカル開発環境起動スクリプト

echo "=== DiscoverFeed.net WordPress ローカル環境 ==="
echo ""

# カレントディレクトリの確認
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
echo "プロジェクトディレクトリ: $SCRIPT_DIR"

# WordPressディレクトリの確認
if [ ! -d "$SCRIPT_DIR/wordpress" ]; then
    echo "エラー: wordpressディレクトリが見つかりません"
    exit 1
fi

echo "✓ WordPressディレクトリ確認完了"

# データベース接続確認（オプション）
echo ""
echo "データベース接続確認..."
php "$SCRIPT_DIR/local-setup.php" > /dev/null 2>&1
if [ $? -eq 0 ]; then
    echo "✓ PHP実行環境OK"
else
    echo "⚠ PHP実行環境に問題がある可能性があります"
fi

# ローカルサーバー起動オプション
echo ""
echo "ローカルサーバーを起動しますか？"
echo "1) PHP内蔵サーバーで起動 (推奨)"
echo "2) 環境確認のみ"
echo "3) 終了"
echo ""
read -p "選択してください [1-3]: " choice

case $choice in
    1)
        echo ""
        echo "PHP内蔵サーバーを起動中..."
        echo "URL: http://localhost:8080"
        echo "管理画面: http://localhost:8080/wp-admin/"
        echo ""
        echo "停止するには Ctrl+C を押してください"
        echo ""
        cd "$SCRIPT_DIR/wordpress"
        php -S localhost:8080
        ;;
    2)
        echo ""
        echo "環境確認を実行中..."
        php "$SCRIPT_DIR/local-setup.php"
        ;;
    3)
        echo "終了します"
        exit 0
        ;;
    *)
        echo "無効な選択です"
        exit 1
        ;;
esac
