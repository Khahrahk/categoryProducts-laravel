<!-- PROJECT LOGO -->
<br />
<div align="center">
  <h3 align="center">Category and Products</h3>

  <p align="center">
    Simple project for categories and their products.
    <br />
  </p>
</div>

<!-- ABOUT THE PROJECT -->
## Features

* [Docker](https://www.docker.com/)
* [Dockerfile with Alpine](https://hub.docker.com/_/alpine)
* [Nginx](https://www.nginx.com)
* [Laravel 10](https://laravel.com/)
* [MySQL](https://www.mysql.com/)
* [PHP 8.2](https://nodejs.org)

<!-- GETTING STARTED -->
## Getting Started

Follow the instruction below to setting up your project.

### Prerequisites

- Download and Install [Docker](https://docs.docker.com/engine/install/)

<!-- USAGE EXAMPLES -->
## Run App Manually


- Run command ```docker-compose build``` on your terminal
- Run command ```docker-compose up -d``` on your terminal
- Run command ```composer install``` on your terminal after went into php container on docker
- Run command ```docker exec -it php /bin/sh``` on your terminal
- Run command ```chmod -R 777 storage``` on your terminal after went into php container on docker
- If app:key still empty on .env run ```php artisan key:generate``` on your terminal after went into php container on docker
- Run command ```npm install``` and then ```npm install dev```
- Run command ```php artisan migrate```
- Run command ```php artisan scout:sync-index-settings"```
- Run command ```php artisan scout:import "App\Models\Product"```
- Run command ```php artisan scout:import "App\Models\Category"```
- If your ordering or searching doesn't work, try to ```scout:import``` this model
- If you recieving sh: mix: not found - try to: ```rm -rf node_modules``` and then ```npm install```
- To run artisan command like migrate, etc. go to php container using ```docker exec -it php /bin/sh```
- Go to http://localhost:8001 or any port you set to open laravel

**Note: if you got a permission error when running docker, try running it as an admin or use sudo in linux**
