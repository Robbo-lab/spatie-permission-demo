#### **Objective:**

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

9. **Configure Sanctum for session-based authentication**:
    - Add your app’s domain to `SANCTUM_STATEFUL_DOMAINS` in `.env`:
        ```env
        SANCTUM_STATEFUL_DOMAINS=localhost,127.0.0.1
        ```

### Step 2: Set Up Spatie Laravel Permission for Roles and Permissions

1. **Install Spatie Laravel Permission**:

    ```bash
    composer require spatie/laravel-permission
    ```

2. **Publish Spatie configuration** and migrate to create the necessary tables:

    ```bash
    php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
    php artisan migrate
    ```

3. **Add the `HasRoles` trait** to the `User` model in `app/Models/User.php`:

    ```php
    use Spatie\Permission\Traits\HasRoles;

    class User extends Authenticatable
    {
        use HasRoles;
        // Other model properties and methods
    }
    ```

### Step 3: Define Roles and Permissions in a Seeder

1. **Update the seeder**

2. **Define roles and permissions** in `RolesAndPermissionsSeeder.php`:

3. **Register the seeder** in `DatabaseSeeder.php` and run it:
    ```php
    php artisan db:seed
    ```

### Step 4: Set Up User Authentication with Sanctum

1. **Create an AuthController** for login and logout functionality:

    ```bash
    php artisan make:controller AuthController
    ```

2. **Define login and logout methods** in `AuthController`:

    ```php
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate(['email' => 'required|email', 'password' => 'required']);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
    ```

3. **Create login and logout routes** in `web.php`:

    ```php
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    ```

4. **Create a Blade view for the login form** in `resources/views/auth/login.blade.php`.

### Step 5: Create an Article Model, Controller, and Migration

1. **Generate Article model and migration**:

    ```bash
    php artisan make:model Article -m
    ```

2. **Define the Article migration schema** (e.g., title, content, user_id foreign key) and run migrations:

    ```php
    Schema::create('articles', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('content');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
    php artisan migrate
    ```

3. **Create an ArticleController with resource methods**:

    ```bash
    php artisan make:controller ArticleController --resource
    ```

4. **Implement the methods** to display a single article:

    ```php
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.show', compact('article'));
    }
    ```

5. **Define resource routes for articles** in `web.php`:
    ```php
    Route::resource('articles', ArticleController::class)->middleware('auth');
    ```

### Step 6: Create Blade Views for Articles

1. **Create the `show.blade.php` view** for displaying a single article in `resources/views/articles/show.blade.php`For example:

    ```blade
    @extends('layout.app')

    @section('title', $article->title)

    @section('content')
        <h1>{{ $article->title }}</h1>
        <p>By {{ $article->user->name }} on {{ $article->created_at->format('F j, Y') }}</p>
        <div>{{ $article->content }}</div>
        <a href="{{ route('articles.index') }}">Back to Articles</a>
    @endsection
    ```

2. **Add any other necessary views** (e.g., `index`, `create`, `edit`) for listing and managing articles.

### Step 7: Run and Test the Application

1. **Start the Laravel server**:

    ```bash
    php artisan serve
    ```

2. **Access the application** at `http://127.0.0.1:8000` and test the following:
    - **Login and logout** functionality.
    - **Article CRUD operations**.
    - **Role and permission checks** (e.g., only users with the `publish articles` permission can create articles).

This setup should provide a fully functional application with Sanctum-based authentication, Spatie permissions, and CRUD operations for articles.

php artisan make:component FlashMessage

When you use `with('error', '...')` or `with('success', '...')` in your controller, Laravel stores these messages in the session. You can then retrieve and display them in your Blade views.


### Step 1: Set Messages in the Controller

In your controller, you’re already using `with()` to set flash messages. For example:

```php
public function destroy(Article $article)
{
    if (!Auth::user()->can('delete articles')) {
        return redirect()->route('articles.index')->with('error', 'You do not have permission to delete articles.');
    }

    $article->delete();

    return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
}
```

### Step 2: Display Messages in Your Blade View

In your Blade layout or a specific view where you want to display these messages, use the following code to show them:

```blade
<!-- Displaying success and error messages -->
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
```

Place this code in your main layout file (e.g., `resources/views/layout/app.blade.php`) or directly in a specific view where you want to show the messages.

### Step 3: Optional: Create a Blade Component for Flash Messages

If you want to reuse the message display code, you can create a Blade component, making it easier to include in multiple views.

1. **Create the Component**:

    ```bash
    php artisan make:component FlashMessage
    ```

2. **Edit the Component View**: Open `resources/views/components/flash-message.blade.php` and add the session message display logic.

    ```blade
    <!-- resources/views/components/flash-message.blade.php -->

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    ```

3. **Include the Component in Your Blade Layout or Views**:
   In your layout file (e.g., `app.blade.php`), or in specific views where you want to show flash messages, use the component:

    ```blade
    <!-- Example in a layout or specific view -->
    <x-flash-message />
    ```