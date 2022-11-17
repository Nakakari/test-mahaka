<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Tentang Project Ini
Jawaban Test Fullstack Programmer CV. Mahaka Digital Indonesia

## Instalasi
1. Clone repositori ini
   ```
    git clone https://github.com/Nakakari/test-mahaka.git
   ```
2. Masuk pada folder
    ```
    cd test-mahaka
    ```
3. Install semua package yang diperlukan
    ```
     composer install
    ```
    Apabila terdapat error dalam menjalankan ini, dapat menggunakan alternatif berikut:
    ```
    composer install --ignore-platform-reqs 
    ```
4. Buat database dengan nama 'test-mahaka'.
   
5.  Silakan buka file .env pada IDE Anda, kemudian cek kodingan berikut:
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=test-mahaka
    DB_USERNAME=root
    DB_PASSWORD=
    ```
6. Generate migration
    ```
     php artisan migrate
    ```
7. Generate data dummy
    ```
    php artisan db:seed
    ```
8. Buka aplikasi melalui browser!
    ```
    php artisan serve
    ```