# Backend part

## Installation

1. Upload this directory into a `module_c_solution` subfolder in the document root on the web server.
2. Copy `.env.example` to `.env`.
3. Update the database credentials in the `.env` file.
4. Run `php artisan migrate && php artisan db:seed` or alternatively import the provided `database-dump.sql` manually.
5. Make sure the web server has read and write access to `storage/` and all subfolders

The admin backend is then available at `http://<your-host>/module_c_solution/`
and the API at `http://<your-host>/module_c_solution/api/v1/`

バックエンド部分
インストール
1. このディレクトリを、Web サーバーのドキュメントルートにある `module_c_solution`サブフォルダーに
アップロードしてください。

2.コピー `,env.example` を `.env` にコピーする。

3.`.env`ファイル内のデータベース認証情報を更新します。

4.Run `php artisan migrate && php artisan db:seed` を実行するか、または提供された `database -dump.sql` を手動でインポートします。

5. ウェブサーバーが `storage/` とすべての subfolders に対して読み取りと書き込みのアクセス権を持っていることを確認します。

管理者用バックエンドは `http://<your-host>/module-e-solution/` で、APIは `http://<your-host>/module-c-solution/api/v1で利用可能です。
