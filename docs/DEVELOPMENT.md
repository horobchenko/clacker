# Development Guide

## Development Workflow

This guide covers the day-to-day development practices for the Clacker project.

## Running Development Environment

### Start Development Server

```bash
npm run dev
```

This starts:
- **Vite** on `http://localhost:5173` (with HMR)
- **Laravel** on `http://localhost:8000`

### Code Editors

Recommended setup:

- **VS Code** with extensions:
  - PHP Intelephense
  - Laravel Extension Pack
  - ES7+ React/Redux/React-Native
  - Tailwind CSS IntelliSense
  - Prettier
  - ESLint

## Frontend Development

### Component Structure

React components are located in `resources/js/Components/`:

```
resources/js/
├── Components/
│   ├── Button.jsx
│   ├── Card.jsx
│   └── ...
├── Pages/
│   ├── Dashboard.jsx
│   ├── Profile.jsx
│   └── ...
├── Layouts/
│   ├── AppLayout.jsx
│   └── GuestLayout.jsx
└── app.jsx  # Main entry point
```

### Component Best Practices

```jsx
// ✅ Good
import React from 'react';

export default function Button({ onClick, children, variant = 'primary' }) {
  return (
    <button
      onClick={onClick}
      className={`px-4 py-2 rounded ${variant === 'primary' ? 'bg-blue-500' : 'bg-gray-500'}`}
    >
      {children}
    </button>
  );
}
```

### Styling with Tailwind CSS

Always use Tailwind classes:

```jsx
<div className="bg-white shadow rounded-lg p-6">
  <h1 className="text-2xl font-bold mb-4">Title</h1>
  <p className="text-gray-600">Description</p>
</div>
```

### Using Inertia.js

```jsx
import { usePage, Link } from '@inertiajs/react';

export default function Dashboard() {
  const { props } = usePage();
  const { user } = props;

  return (
    <div>
      <h1>Welcome, {user.name}</h1>
      <Link href="/profile">Go to Profile</Link>
    </div>
  );
}
```

## Backend Development

### Creating a Controller

```bash
php artisan make:controller UserController --model=User
```

### Controller Example

```php
namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('Users/Index', [
            'users' => User::all(),
        ]);
    }

    public function show(User $user)
    {
        return Inertia::render('Users/Show', [
            'user' => $user,
        ]);
    }
}
```

### Creating Models

```bash
php artisan make:model Post -m  # Create model with migration
```

### Creating Migrations

```bash
php artisan make:migration create_posts_table
```

```php
Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('title');
    $table->text('body');
    $table->timestamps();
});
```

### Creating Routes

Edit `routes/web.php`:

```php
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
```

### Validation

```php
class StorePostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
```

## Database Development

### Running Migrations

```bash
php artisan migrate              # Run all migrations
php artisan migrate:rollback    # Rollback last batch
php artisan migrate:fresh       # Drop and recreate
php artisan migrate:refresh     # Rollback and re-run
```

### Database Seeders

```bash
php artisan make:seeder UserSeeder
```

```php
public function run()
{
    User::factory(10)->create();
}
```

### Tinker Shell

Interactive Laravel shell:

```bash
php artisan tinker

# Then in the shell:
>>> User::count()
>>> User::find(1)
>>> User::create(['name' => 'Test', 'email' => 'test@example.com'])
```

## Testing

### Running Tests

```bash
php artisan test                    # Run all tests
php artisan test tests/Feature      # Run feature tests
php artisan test --filter=UserTest  # Run specific test
```

### Writing Tests

```php
class UserTest extends TestCase
{
    public function test_can_view_users()
    {
        $response = $this->get('/users');
        $response->assertStatus(200);
    }
}
```

## Code Style & Linting

### PHP Code Style

Follows PSR-12 standard via Laravel.

### JavaScript Linting

Run ESLint:

```bash
npm run lint  # Check linting issues
```

## Debugging

### Laravel Debugging

Use `dd()` (dump and die) or `dump()`:

```php
dd($user);  // Dumps and stops execution
dump($user); // Dumps and continues
```

### React Debugging

Use browser DevTools:

```jsx
console.log('Debug info', data);
```

Or use React DevTools extension.

## Common Tasks

### Cache Management

```bash
php artisan cache:clear        # Clear all caches
php artisan cache:clear --tag=users  # Clear specific tag
php artisan optimize           # Optimize for production
```

### Queue Processing

```bash
php artisan queue:work         # Process jobs
php artisan queue:failed       # Check failed jobs
php artisan queue:retry all    # Retry failed jobs
```

## Performance Tips

1. **Eager Loading**: Use `with()` to prevent N+1 queries
   ```php
   $users = User::with('posts')->get();
   ```

2. **Lazy Loading**: For large datasets
   ```php
   $users = User::lazy();
   ```

3. **Caching**: Cache expensive queries
   ```php
   $users = Cache::remember('users', 3600, fn() => User::all());
   ```

4. **Database Indexing**: Index frequently searched columns

5. **Code Splitting**: In React, use dynamic imports
   ```jsx
   const Component = React.lazy(() => import('./Component'));
   ```

## Resources

- [Laravel Documentation](https://laravel.com/docs)
- [React Documentation](https://react.dev)
- [Inertia.js Documentation](https://inertiajs.com)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
