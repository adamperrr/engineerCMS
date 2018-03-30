<div align="center">
<h1>EngeenerCMS</h1>
</div>

## Description
This content management system is a project for my Engineering Thesis.
Title of the project: Content management system for managing academic publications using BibTeX.

## Installation
1. Download or clone repository to proper file.
2. In the console: 
    ```bash
    composer install 
    ```
3. Create database
4. In the console: 
    ```bash
    cp .env.example .enx
    php artisan key:generate
    ```
5. In the file .env set values of: APP_NAME, APP_URL, DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD, BROADCAST_DRIVER, CACHE_DRIVER, SESSION_DRIVER, QUEUE_DRIVER, REDIS_HOST, REDIS_PASSWORD, REDIS_PORT, QUEUE_DRIVER, MAIL_DRIVER, MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD, MAIL_ENCRYPTION, MAIL_FROM_ADDRESS, MAIL_FROM_NAME

6. Command which may be needed: 
    ```
    sudo chmod -R 777 app/storage
    ```

7. In the console:
    ```bash
    php artisan migrate
    ```
    
    If you work with XAMPP simple change in file app/Providers/AppServiceProvider.php is needed.
    ```php
    use Illuminate\Support\Facades\Schema;
    
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
    ```
    
8. htaccess file for public directory:
    ```
    <IfModule mod_rewrite.c>
        <IfModule mod_negotiation.c>
            Options -MultiViews
        </IfModule>

        RewriteEngine On
    
        # Redirect Trailing Slashes If Not A Folder...
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteCond %{REQUEST_URI} (.+)/$
        RewriteRule ^ %1 [L,R=301]

        # Handle Front Controller...
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteRule ^ index.php [L]

        # Handle Authorization Header
        RewriteCond %{HTTP:Authorization} .
        RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
    </IfModule>
    ```

Remember about allowing override:
```
    <Directory "/var/www">
        AllowOverride All
    </Directory>
```

And: 

```
sudo a2enmod rewrite
```
    
9. In the console:
      ```bash
      php artisan storage:link
      ```
10. In the console:
      ```bash
      php artisan serve
      ```
11. Register your account

## Used technologies

Laravel 5.5.21 - the [MIT license](http://opensource.org/licenses/MIT).

Vue.js v2.5.13 - the [MIT license](http://opensource.org/licenses/MIT).

