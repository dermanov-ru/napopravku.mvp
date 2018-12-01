# install 
### requires 
- PHP >= 7.1 
```bash
laravel new napopravku-mvp.loc
cd new napopravku-mvp.loc
composer update
```

copy `.env.example` to `.env`

```bash
php artisan key:generate
# Application key set successfully.
```

Подключаем авторизацию
```bash
php artisan make:auth
php artisan migrate
```