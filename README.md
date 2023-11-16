# Rendering sidebar elements and User CRUD Operation using AJAX in Laravel

This repository contains a Laravel application that demonstrates how to render sidebar elements of homepage using service provider and perform CRUD operations for users using AJAX (Asynchronous JavaScript and XML). This is a step-by-step guide to help you understand and implement user management functionalities with real-time updates.

## Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP(v8.2) and Laravel(v10.29) are installed on your system.
- A basic understanding of Laravel and AJAX.
- Composer(v2.6.4) for PHP dependencies.

## Getting Started

1. Clone this repository to your local machine (In Windows go to the xampp/htdocs folder):

   ```bash
   git clone https://github.com/dhruv240901/User-Role-Permission-Module

2. Change to the project directory:

    ```bash
   cd User-Role-Permission-Module

3. Install Laravel dependencies:

   ```bash
   composer install

4. Create a .env file by copying the .env.example file and configure your database
   and mail settings:

   ```bash
   cp .env.example .env

5. Generate an application key:

   ```bash
   php artisan key:generate

6. Migrate and seed the database:

   ```bash
   php artisan migrate

7. Start the Laravel development server:

   ```bash
   php artisan serve

8. Access the application in your web browser at http://localhost:8000.
9. While adding the user and reseting the password perform the following steps:
    1. Set Mail Credential and Queue Connection in .env file

        ```bash
        MAIL_MAILER=smtp
        MAIL_HOST=mailpit
        MAIL_PORT=1025
        MAIL_USERNAME=null
        MAIL_PASSWORD=null
        MAIL_ENCRYPTION=null
        MAIL_FROM_ADDRESS="hello@example.com"
        MAIL_FROM_NAME="${APP_NAME}"

        QUEUE_CONNECTION=database

    2. Run the following command:

        ```bash
        php artisan queue:work

## Features
1. Role Management: Easily create, update, and delete user roles.
2. Permission Assignment: Assign permissions to specific roles.
3. User Role Association: Associate users with specific roles.
4. Fine-Grained Access Control: Define and manage granular permissions for different parts of your application.


