# Database Guide

## Overview

Clacker uses Laravel's Eloquent ORM for database interactions. This guide covers database structure, migrations, models, and relationships.

## Supported Databases

- **MySQL 8.0+** - Production recommended
- **PostgreSQL 12+** - Production alternative
- **SQLite 3** - Development only

## Configuration

Database configuration is in `config/database.php` and controlled via `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=clacker
DB_USERNAME=root
DB_PASSWORD=
```

## Migrations

### Creating Migrations

```bash
# Create migration file
php artisan make:migration create_users_table

# Create migration with model
php artisan make:migration create_posts_table --create=posts

# Create migration for existing table
php artisan make:migration add_status_to_users --table=users
```

### Migration Structure

```php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('body');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('user_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
```

### Running Migrations

```bash
php artisan migrate              # Run pending migrations
php artisan migrate:rollback    # Rollback last batch
php artisan migrate:rollback --step=3  # Rollback 3 steps
php artisan migrate:refresh     # Rollback all and re-run
php artisan migrate:fresh       # Drop all tables and re-run
```

## Models

### Creating Models

```bash
php artisan make:model Post
php artisan make:model Post -m  # With migration
php artisan make:model Post -mc # With migration and controller
```

### Model Example

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'body',
        'status',
        'user_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeRecent($query)
    {
        return $query->orderByDesc('created_at');
    }
}
```

## Relationships

### One to Many

```php
// In User model
public function posts()
{
    return $this->hasMany(Post::class);
}

// In Post model
public function user()
{
    return $this->belongsTo(User::class);
}

// Usage
$user = User::find(1);
$posts = $user->posts; // Get all user's posts
```

### Many to Many

```php
// In User model
public function roles()
{
    return $this->belongsToMany(Role::class, 'user_roles');
}

// In Role model
public function users()
{
    return $this->belongsToMany(User::class, 'user_roles');
}

// Usage
$user = User::find(1);
$user->roles()->attach($roleId);
$user->roles()->detach($roleId);
$user->roles()->sync([$roleId1, $roleId2]);
```

### One to One

```php
// In User model
public function profile()
{
    return $this->hasOne(Profile::class);
}

// In Profile model
public function user()
{
    return $this->belongsTo(User::class);
}
```

## Querying Data

### Basic Queries

```php
// Get all
$users = User::all();

// Get by ID
$user = User::find(1);
$user = User::findOrFail(1);

// Get first/last
$user = User::first();
$user = User::latest()->first();

// Where conditions
$activeUsers = User::where('active', true)->get();
$users = User::where('role', 'admin')->where('active', true)->get();

// Or conditions
$users = User::where('name', 'John')->orWhere('name', 'Jane')->get();

// In list
$users = User::whereIn('id', [1, 2, 3])->get();

// Like search
$users = User::where('email', 'like', '%@example.com')->get();
```

### Eager Loading

```php
// Avoid N+1 queries
$posts = Post::with('user', 'comments')->get();
$posts = Post::with(['user', 'comments' => fn($q) => $q->latest()])->get();
```

### Pagination

```php
$posts = Post::paginate(15);  // 15 items per page
$posts = Post::paginate(15, ['*'], 'page', 2); // Page 2
```

### Ordering

```php
$users = User::orderBy('created_at', 'desc')->get();
$users = User::latest('created_at')->get();
$users = User::oldest('created_at')->get();
```

## Seeders

### Creating Seeders

```bash
php artisan make:seeder UserSeeder
```

### Seeder Example

```php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(10)->create();
        
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
    }
}
```

### Running Seeders

```bash
php artisan db:seed                    # Run DatabaseSeeder
php artisan db:seed --class=UserSeeder # Run specific seeder
php artisan migrate:fresh --seed       # Migrate and seed
```

## Factories

### Creating Factories

```bash
php artisan make:factory UserFactory
```

### Factory Example

```php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ];
    }
}
```

### Using Factories

```php
// Create single record
$user = User::factory()->create();

// Create multiple records
$users = User::factory(10)->create();

// Create with specific attributes
$user = User::factory()->create([
    'name' => 'John Doe',
]);

// Create without saving
$user = User::factory()->make();
```

## Advanced Features

### Soft Deletes

```php
use SoftDeletes;

protected $dates = ['deleted_at'];

// Soft delete
$user->delete();

// Restore
$user->restore();

// Force delete
$user->forceDelete();

// Include soft deleted
User::withTrashed()->get();
```

### Accessors & Mutators

```php
// Mutator (set)
protected function name(): Attribute
{
    return Attribute::make(
        set: fn($value) => strtolower($value),
    );
}

// Accessor (get)
protected function createdAt(): Attribute
{
    return Attribute::make(
        get: fn($value) => Carbon::parse($value)->format('Y-m-d'),
    );
}
```

### Scopes

```php
public function scopeActive($query)
{
    return $query->where('active', true);
}

// Usage
$activeUsers = User::active()->get();
```

## Performance Optimization

### Indexing

Always index frequently searched columns:

```php
$table->index('user_id');
$table->unique('email');
$table->fullText('body');
```

### Query Optimization

```php
// Bad: N+1 query problem
foreach (User::all() as $user) {
    echo $user->posts->count();
}

// Good: Single query with eager loading
$users = User::withCount('posts')->get();
```

## Database Backup

```bash
# Backup
mysqldump -u root -p clacker > backup.sql

# Restore
mysql -u root -p clacker < backup.sql
```
