# Backend part

## Installation

1. Upload this directory into a `module_c_solution` subfolder in the document root on the web server
2. Copy `.env.example` to `.env`
3. Update the database credentials in the `.env` file
4. Run `php artisan migrate && php artisan db:seed` or alternatively import the provided `database-dump.sql` manually
5. Make sure the web server has read and write access to `storage/` and all subfolders

The admin backend is then available at `http://<your-host>/module_c_solution/`
and the API at `http://<your-host>/module_c_solution/api/v1/`
