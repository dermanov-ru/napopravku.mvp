# install 
### requires 
- PHP >= 7.1 
```bash
laravel new napopravku-mvp.loc
cd new napopravku-mvp.loc
composer update

cp .env.example .env
php artisan key:generate

php artisan cache:clear
php artisan migrate
php artisan db:seed
```

