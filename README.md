# DiscoverFeed Corporate Site 2025 - Local Development Archive

このリポジトリは、DiscoverFeed.net コーポレートサイトのローカル開発環境のアーカイブです。

## 📁 プロジェクト構成

```
discoverfeed_local/
├── wordpress/                    # WordPress本体
│   ├── wp-content/
│   │   ├── themes/
│   │   │   └── anthem_tcd083/    # メインテーマ（本番環境から取得）
│   │   └── uploads/              # 画像ファイル（本番環境から取得）
│   │       ├── 2023/08/         # 2023年8月の画像
│   │       ├── 2024/02/         # 2024年2月の画像
│   │       └── 2024/04/         # 2024年4月の画像
│   └── wp-config.php            # ローカル開発用設定
├── discoverfeed_database_backup.sql  # データベースバックアップ
├── local-setup.php              # 環境確認スクリプト
└── start-local.sh               # 起動スクリプト

```

## 🚀 セットアップ方法

### 前提条件
- PHP 8.4.11 以上
- MySQL 9.4.0 以上
- 十分なディスク容量（画像ファイル含め約2GB）

### 1. データベース設定

```bash
# MySQLサービス開始
brew services start mysql

# データベースとユーザー作成
mysql -u root -e "CREATE DATABASE IF NOT EXISTS discoverfeed_local;"
mysql -u root -e "CREATE USER IF NOT EXISTS 'wpuser_local'@'localhost' IDENTIFIED BY 'local_password';"
mysql -u root -e "GRANT ALL PRIVILEGES ON discoverfeed_local.* TO 'wpuser_local'@'localhost'; FLUSH PRIVILEGES;"

# データベース復元
mysql -u wpuser_local -plocal_password discoverfeed_local < discoverfeed_database_backup.sql
```

### 2. WordPress起動

```bash
# 起動スクリプト使用
./start-local.sh

# または手動起動
cd wordpress
php -S localhost:8080 -t /path/to/wordpress/
```

### 3. アクセス

- **フロントエンド**: http://localhost:8080
- **管理画面**: http://localhost:8080/wp-admin/
- **認証情報**: wpuser / wSDsvaJ9ceGDl61MtoPM3A

## 🛠️ 設定済み内容

### WordPress設定
- **テーマ**: anthem_tcd083（本番環境と同一）
- **デバッグモード**: 有効（ローカル開発用）
- **URL**: http://localhost:8080
- **タイムゾーン**: Asia/Tokyo

### データベース
- **名前**: discoverfeed_local
- **ユーザー**: wpuser_local
- **パスワード**: local_password
- **テーブル数**: 64（本番環境から復元）

### 画像ファイル
- **2023/08**: 640個のファイル（約1.68GB）
- **2024/02**: deepcoin.jpg、partnership.jpg等
- **2024/04**: HOUSE-240415.jpg、1750-1159-ima-2.jpg等

## 📋 実施済み修正

1. **テーマ復元**: 本番サーバーからanthem_tcd083テーマを取得
2. **画像置換**: プレースホルダーから本物の画像に置き換え
3. **URL修正**: 本番URLをローカルURLに一括変更
4. **警告修正**: WordPress Notice/Deprecated警告を抑制
5. **動的プロパティ修正**: PHP 8.4対応のクラス修正

## 🎯 次期開発計画

[[memory:6672683]] このローカル環境を参考に、Next.js + TypeScript + Tailwind CSSでの新コーポレートサイト開発を予定。

## 📝 技術仕様

- **PHP**: 8.4.11
- **MySQL**: 9.4.0
- **WordPress**: 6.8.2
- **テーマ**: TCD083 ANTHEM
- **画像総数**: 700+ ファイル
- **データベースサイズ**: 約23MB

## 🔗 関連リンク

- **本番サイト**: https://www.discoverfeed.net
- **本リポジトリ**: https://github.com/ttsllc/bk-discoverfeed-corp-site-2025

---

**作成日**: 2025年9月4日  
**最終更新**: WordPress 6.8.2環境での動作確認済み
