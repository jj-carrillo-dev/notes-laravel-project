### Notes Manager

A simple, user-friendly notes management application built with the Laravel 12 framework. This project demonstrates core Laravel features, including authentication, CRUD operations, database relationships, and component-based design.

-----

### Key Features

* **Authentication:** Secure user registration and login are handled by **Laravel Breeze**.
* **Notes & Notebooks:** Organize your notes by assigning them to notebooks.
* **CRUD Functionality:** Easily create, read, update, and delete notes.
* **Soft Deletion:** Notes are "soft-deleted" (moved to trash) before being permanently deleted.
* **Responsive UI:** A clean and responsive user interface built with **Tailwind CSS**.
* **Component-Based Architecture:** Reusable Blade components for a DRY (Don't Repeat Yourself) codebase.
* **Policy-Based Authorization:** Secure and centralized authorization logic to ensure users can only access their own data.
* **Form Request Validation:** Clean, separate validation logic for incoming requests.

-----

### Technologies

* **Backend:** PHP 8.3, Laravel 12.0
* **Database:** MySQL or MariaDB
* **Frontend:** Blade, Tailwind CSS, Alpine.js
* **Development Tools:** Composer, NPM

-----

### Installation on Linux

1.  **Clone the repository:**

    ```bash
    git clone https://github.com/jj-carrillo-dev/notes-laravel-project
    ```

2.  **Install PHP dependencies:**

    ```bash
    composer install
    ```

3.  **Install Node.js dependencies:**

    ```bash
    npm install
    ```

4.  **Database Setup:**
    * Make sure you have a MySQL or MariaDB server running.
    * Create a new database named `notes_manager_laravel`.
    * Duplicate `.env.example` and rename it to `.env`.
    * Configure your database connection in the `.env` file, ensuring `DB_DATABASE` is set to `notes_manager_laravel`.

5.  **Run database migrations:**

    ```bash
    php artisan migrate
    ```

6.  **Generate the application key:**

    ```bash
    php artisan key:generate
    ```

7.  **Compile front-end assets:**

    ```bash
    npm run dev
    ```

8.  **Run the application:**

    ```bash
    php artisan serve
    ```
    Your application will be available at `http://127.0.0.1:8000`.
-----

### Required PHP Extensions

This project requires a few common PHP extensions. If you encounter errors during installation, ensure the following are installed:

* **`php8.3-mysql`:** Required for MySQL database connectivity.
* **`php8.3-mbstring`:** Required for multibyte string handling.
* **`php8.3-xml`:** Required by various Composer packages.

-----

### How to Use

1.  Register a new user account.
2.  Navigate to the **Notes** section.
3.  Click **New Note** to create your first note.
4.  You can also create notebooks to organize your notes.
5.  Deleted notes are sent to the **Trash** and can be restored or permanently deleted.