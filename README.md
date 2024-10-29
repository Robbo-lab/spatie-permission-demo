# spatie-permission-demo

Diploma Front End Demo of Spatie installation
repo: https://github.com/Robbo-lab/spatie-permission-demo
Spatie Permission Docs: https://spatie.be/docs/laravel-permission/v6/installation-laravel

## Stage 1

Basic installation, role assignment and model attachment(articles)

## Proposed stage 2

Role assignment route

### Stage 1 - project setup and auth installation with Sanctum

### **Step 1: Create a New Laravel Project**

1. **Open Laragon and Start Services:**

   - Start Apache/Nginx and MySQL from the Laragon interface.

2. **Open Terminal in Laragon:**

   - Click on **Terminal** in Laragon to open the command prompt in the Laragon environment.

3. **Create Laravel Project:**

   ```bash
   composer create-project --prefer-dist laravel/laravel spatie-permission-demo
   ```

4. **Set up Environment File:**

   - Navigate to the project folder:
     ```bash
     cd spatie-permission-demo
     ```
   - Copy `.env.example` to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Generate an application key:
     ```bash
     php artisan key:generate
     ```
   - Open `.env` and configure your database settings.

5. **Create a Database in Laragon:**

   - Open **phpMyAdmin** in Laragon.
   - Create a database named `spatie_permission_demo`.

6. **Run Migrations:**

   - Run the initial migrations to set up Laravel’s default tables.
     ```bash
     php artisan migrate
     ```

7. **Install Sanctum** for API-based authentication:

   ```bash
   composer require laravel/sanctum
   ```

8. **Publish Sanctum configuration** and run migrations:

   ```bash
   php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
   php artisan migrate
   ```
