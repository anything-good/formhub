# FormHub

A Laravel-based form management application.

## Setup and Installation

1.  **Clone the repository:**
    ```bash
    git clone <repository-url>
    cd formhub
    ```

2.  **Install PHP dependencies:**
    ```bash
    composer install
    ```

3.  **Install Node dependencies:**
    ```bash
    npm install
    ```

## Environment Configuration

1.  **Create `.env` file:**
    Copy the example environment file:
    ```bash
    cp .env.example .env
    ```

2.  **Generate Application Key:**
    ```bash
    php artisan key:generate
    ```

3.  **Database Configuration:**
    By default, the application uses SQLite. Ensure the database file exists:
    ```bash
    touch database/database.sqlite
    ```
    Run migrations:
    ```bash
    php artisan migrate
    ```

## How to Run

1.  **Start the backend server:**
    ```bash
    php artisan serve
    ```

2.  **Start the frontend development server:**
    ```bash
    npm run dev
    ```

Access the application at `http://localhost:8000`.

## Technology Stack

-   **Framework:** Laravel 12
-   **Admin Panel:** Filament 4
-   **Frontend Build Tool:** Vite
-   **Database:** SQLite (Default)

## Multi-tenant Strategy

This application uses a **Single Database, Row-Level Tenancy** strategy.

-   **Data Isolation:** All tenants (users) share the same database tables.
-   **Ownership:** Records (e.g., Forms) are associated with a specific `User` via a foreign key (`user_id`).
-   **Access Control:** Queries are scoped to the authenticated user to ensure they can only access their own data.

---

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects.

[Laravel Documentation](https://laravel.com/docs)
