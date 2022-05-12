<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


## About the Project

The project is a simple record management system intended for the EDC in Calibr8 Systems Inc.

### Requirements 

*Please ensure you have the latest versions*
- PHP
- Composer
- Nodejs
- MySQL
- Docker *(Optional)*

## Installing without Docker

 **Step 1.** Clone this repository and cd into the project folder.
 ```bash
 git clone https://github.com/beemerproj/c8-web.git
 cd c8-web/
 ```

 **Step 2.** Next is to install the dependencies using composer.

 ```bash
 composer install
 ```

If the above command throws an error, you may use this:

 ```bash
 composer install --ignore-platform-reqs
 ```

 **Step 3.** Next is to create a copy of *.env.example* with the name *.env*.

 **Step 4.** Open the file and change the *DB* to match your MySQL credentials.

 **Step 5.** Run the following commands for seting up the project.

 ```bash
 php artisan key:generate
 php artisan config:clear
 php artisan migrate
 php artisan db:seed --class=AdminSeeder
 php artisan serve
 ```
 And you are done!

 You can check if the web-app is running by browsing using this:
 ```
 http://localhost/c8-web/public/
 ``` 
## Installing with Laravel Sail (Docker)

Laravel Framework uses the **Laravel Sail** for easier interaction with docker. To read more about Laravel Sail, [click here.](https://laravel.com/docs/9.x/sail)

 **Step 1.** Clone this repository and cd into the project folder.
 ```bash
 git clone https://github.com/beemerproj/c8-web.git
 cd c8-web/
 ```

 **Step 2.** Run this command to install the composer dependencies provided in the laravel documentation. 
 [Read more](https://laravel.com/docs/9.x/sail#installing-composer-dependencies-for-existing-projects)
 ```bash
 docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
 ```
 **Step 3.** Next is to create a copy of *.env.example* with the name *.env*.

 **Step 4.** Open the file and change the *DB* to match your MySQL credentials.

 **Step 5.** Finally, you may start Laravel Sail with this command:
 ```bash
 ./vendor/bin/sail up
 ```
 You can check if the web-app is running by browsing using this:
 ```
 http://localhost/
 ``` 
<!-- Coming Soon. Too Lazy to add -->
<!-- ## Troubleshooting -->

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
