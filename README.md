# Simple Blog

This repository contains a Docker Compose setup for a Laravel project. It includes services for the Laravel application, Nginx web server, MySQL database, and Adminer for database management.

## Prerequisites

Make sure you have Docker and Docker Compose installed on your machine.

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)

## Setup Instructions

1. Clone this repository:
   ```bash
   git clone https://github.com/winkersco/simple-blog
   ```

2. Create a `.env` file in `laravel` folder:
   ```bash
   cd simple-blog/laravel
   cp .env.example .env
   ```

3. Get back to project folder and Start docker containers:
   ```bash
   cd ..
   docker compose up -d
   ```

4. Install laravel dependencies:
   ```bash
   docker compose exec app composer install
   ```

5. Generate laravel application Key:
   ```bash
   docker compose exec app php artisan key:generate
   ```

6. Run migrations and seeders:
   ```bash
   docker compose exec app php artisan migrate --seed
   ```
7. Now, open your browser and navigate to [http://localhost:8080](http://localhost:8080).

## Default Credentials

You can use the following default credentials for logging into the application:

- **User:**
  - Email: `user@gmail.com`
  - Password: `password`

- **Admin:**
  - Email: `admin@gmail.com`
  - Password: `password`

## Adminer - Database Management

You can use `Adminer` to manage your database. To access Adminer, follow these steps:

1. Open your browser and navigate to [http://localhost:8081](http://localhost:8081).
2. Use the following default database credentials or change them in configurations:
   - System: `MySQL`
   - Server: `db`
   - Username: `default`
   - Password: `secret`
   - Database: `default`
    

