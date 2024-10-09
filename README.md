php artisan install:api

//Customize Password reset Notification
php artisan make:notification ResetPasswordCustom

FRONTEND_URL=http://localhost:8000/api


Refactored Docker Setup for Laravel 11 Application
This readme section provides instructions on setting up your Laravel 11 application using Docker.

Prerequisites:

Docker Desktop: Install Docker Engine and Docker Compose from https://www.docker.com/get-started/
Getting Started:

Clone the Repository:


git clone https://github.com/techbysameer/news-aggregator.git

cd your-repo


Configure Environment Variables:

Copy the .env.example file to create a .env file:


cp .env.example .env


Edit the .env file with your database credentials and other configurations specific to your project.

Build and Start Containers:

Run the following command to build and start the Docker containers in detached mode:


docker-compose up -d --build


This creates and runs the following containers:

app: The Laravel application container
db (default name): The PostgreSQL database container
Install Dependencies:

Once the containers are running, install Laravel dependencies within the app container:


docker-compose exec app composer install


Run Database Migrations:

Run the Laravel migrations to set up your database structure inside the app container:


docker-compose exec app php artisan migrate


Generate Application Key:

Generate a new application key within the app container:


docker-compose exec app php artisan key:generate


Access the Application:

The application will typically be accessible at http://localhost:8000. You might need to adjust the port based on your configuration.

Note:


The http://localhost:8000/api/register endpoint can be use to register the user and access the application.
