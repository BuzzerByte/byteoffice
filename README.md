# App
Byte Office 
Office Management System

### Prerequisites
Application Required
- Docker

Server Requirements
- PHP >= 7.2.3
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

OPTIONAL REQUIREMENTS:
- Composer
- NPM / YARN

### Login Credentials
Email: admin@byteoffice.com
Password: 123qwe

### Setup Local Development Environment

The project is develop using Laravel 7.30.4

1. First, setup typical laravel development environment on your local machine.
2. Go to your development environment root directory, (e.g /var/www/html/ for apache).
3. "git clone https://github.com/BuzzerByte/byteoffice.git < folder name >".
4. "cd < folder name >".
5. "composer install".
6. "php artisan key:generate".
7. "php artisan migrate --seed".
8. key in "localhost" in your web browser should see the login page

# Docker Installation
A pretty simplified docker-compose workflow that sets up a LEMP network of containers for local Laravel development. You can view the full article that inspired this repo [here](https://medium.com/@aschmelyun).

1. git clone git@github.com:BuzzerByte/byteoffice.git
2. docker-compose up -d —build
3. composer install
4. composer update
5. npm install
6. npm run dev/watch
7. cp .env.example .env
8. edit .env file
1. docker-composer exec php php artisan migrate —seed
2. php artisan key:generate

## Docker Usage

To get started, make sure you have [Docker installed](https://docs.docker.com/docker-for-mac/install/) on your system, and then clone this repository.

First add your entire Laravel project to the `src` folder, then open a terminal and from this cloned respository's root run `docker-compose up -d --build`. Open up your browser of choice to [http://localhost:8080](http://localhost:8080) and you should see your Laravel app running as intended. **Your Laravel app needs to be in the src directory first before bringing the containers up, otherwise the artisan container will not build, as it's missing the appropriate file.** 

**New:** Three new containers have been added that handle Composer, NPM, and Artisan commands without having to have these platforms installed on your local computer. Use the following command templates from your project root, modifiying them to fit your particular use case:

- `docker-compose run --rm composer update`
- `docker-compose run --rm npm run dev`
- `docker-compose run --rm artisan migrate` 

Containers created and their ports (if used) are as follows:

- **nginx** - `:8080`
- **mysql** - `:3306`
- **php** - `:9000`
- **npm**
- **composer**
- **artisan**

## Persistent MySQL Storage

By default, whenever you bring down the docker-compose network, your MySQL data will be removed after the containers are destroyed. If you would like to have persistent data that remains after bringing containers down and back up, do the following:

1. Create a `mysql` folder in the project root, alongside the `nginx` and `src` folders.
2. Under the mysql service in your `docker-compose.yml` file, add the following lines:

```
volumes:
  - ./mysql:/var/lib/mysql
```
