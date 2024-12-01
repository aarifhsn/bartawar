# Barta - Social Networking Application

Barta is a simple social networking platform where users can post content, update profiles, and interact with each other, similar to platforms like Facebook. The platform is built using Laravel and includes features like user registration, authentication, profile management, and a search feature to find posts based on users' name, username, or email.

## Features

-   User registration, login, and logout functionality
-   Profile management (bio, avatar, etc.)
-   Post creation with image uploads
-   Search functionality to find posts by users' full name, username, or email
-   User-friendly interface with responsive design
-   Comments and Like options
-   Realtime notifications Feature

## Prerequisites

Before setting up the project, make sure you have the following installed:

-   **PHP (>= 8.1 recommended)**
-   **Composer**
-   **Laravel 8.x or higher**
-   **Node.js (>= 14.0.0)**
-   **NPM (or Yarn)**
-   **A configured MySQL database**
-   **Pusher credentials for real-time events**

## Installation

1. **Clone the repository:**

    ```bash
    git clone https://github.com/aarifhsn/bartawar.git
    ```

2. **Navigate to the Project Directory**

    ```bash
    cd bartawar
    ```

3. **Install PHP dependencies**

    ```bash
    composer install
    ```

4. **Install JavaScript dependencies:**

    ```bash
    npm install
    ```

5. **Configure the .env file**

    **Copy the example environment file and set up your environment variables:**

    ```bash
    cp .env.example .env
    ```

    **Set up database credentials:**

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```

    **Set up Pusher credentials:**

    ```bash
    BROADCAST_DRIVER=pusher
    PUSHER_APP_ID=your_pusher_app_id
    PUSHER_APP_KEY=your_pusher_app_key
    PUSHER_APP_SECRET=your_pusher_app_secret
    PUSHER_APP_CLUSTER=your_pusher_app_cluster
    ```

6. **Generate an application key:**
    ```bash
    php artisan key:generate
    ```
7. **Run database migrations:**

    ```bash
    php artisan migrate
    ```

8. **Link the storage directory: Laravel uses symbolic links to access files stored in the** storage **directory from the public directory.**

    ```bash
    php artisan storage:link
    ```

9. **Start the Laravel queue worker: Laravel uses queues to process notifications asynchronously.**

    ```bash
    php artisan queue:work
    ```

10. **Compile Frontent Assets**

    ```bash
    npm run dev
    ```

11. **php artisan serve**

    ```bash
    php artisan serve
    ```

12. **Access the application:**

    Open your browser and navigate to [http://localhost:8000](http://localhost:8000) to start using the platform.
