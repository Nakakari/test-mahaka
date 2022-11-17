<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

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
    Silakan buka file .env pada IDE Anda, kemudian cek kodingan berikut:
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=test-mahaka
    DB_USERNAME=root
    DB_PASSWORD=
    ```
5. Generate app key
    ```
     php artisan key:generate
    ```
6. Generate migration
    ```
     php artisan migrate
    ```
7. Input data dummy
    ```
    php artisan db:seed
    ```
8. Buka aplikasi melalui browser!
    ```
    php artisan serve
    ```