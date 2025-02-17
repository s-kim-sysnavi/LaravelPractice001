## このリポジトリについて

**LaravelPractice001**  
このプロジェクトは **Laravel** の学習を目的としており、以下の技術を学ぶためのものです。

- PHP と Laravel フレームワークの基本操作
- Web アプリケーションの構造の理解

## 実装内容

- **ユーザー情報の CRUD 機能**（登録・確認・修正・削除）
- **認証機能**（登録したユーザー情報を使用）
- **画像ファイルのアップロード**
- **JavaScript によるバリデーションと画像表示**

## 起動方法（Docker & WSL 環境）

### 1️⃣ プロジェクトのクローン
以下のコマンドのどちらかを実行してください。

#### 🔹 SSH の場合
```bash
git clone git@github.com:s-kim-sysnavi/LaravelPractice001.git
```

#### 🔹 HTTPS の場合
```bash
git clone https://github.com/s-kim-sysnavi/LaravelPractice001.git
```

### 2️⃣ ディレクトリ移動
```bash
cd LaravelPractice001
```

### 3️⃣ `.env` 設定（環境変数ファイル作成）
```bash
cp .env.example .env
```

### 4️⃣ 必要なパッケージのインストール
```bash
composer install
```

### 5️⃣ Docker コンテナの起動
```bash
./vendor/bin/sail up -d
```

### 6️⃣ データベースのマイグレーション
```bash
./vendor/bin/sail artisan migrate
```

これで `http://localhost` でアプリにアクセスできます。

## 環境設定

このプロジェクトでは **Docker + Laravel Sail** を使用しています。  
以下のファイルを適切に設定してください。

### 1️⃣ `docker-compose.yml` の設定
`docker-compose.yml` ファイルの内容を、以下のサンプルを参考に編集してください。

　 **[docker-compose.yml のサンプル](docker-compose.yml)**  

### 2️⃣ `.env` の設定
`.env` ファイルをプロジェクトルートに作成し、以下のように設定してください。

　 **[.env のサンプル](.env.example)**  

## ライセンス
このプロジェクトは [MIT ライセンス](LICENSE) のもとで公開されています。

