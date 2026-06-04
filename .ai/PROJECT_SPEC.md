# Clacker - AI Project Specification

## Project Metadata

**Project Name:** Clacker
**Repository:** horobchenko/clacker
**Version:** 1.0.0
**Status:** Active Development
**Last Updated:** 2026-06-04

## Project Overview

Clacker is a full-stack web application built with Laravel (PHP backend) and React (JavaScript frontend), integrated using Inertia.js for seamless server-side routing with client-side reactivity.

## Technology Stack

### Backend
- **Framework:** Laravel 11+
- **Language:** PHP 8.1+
- **ORM:** Eloquent
- **Database:** MySQL 8.0+, PostgreSQL 12+, SQLite (dev)
- **API Style:** RESTful with Inertia.js

### Frontend
- **Framework:** React 18.2
- **Styling:** Tailwind CSS 3.2
- **Build Tool:** Vite 6.0
- **HTTP Client:** Axios 1.7
- **UI Components:** Headless UI 2.0
- **Server Integration:** Inertia.js 1.0

### Development Tools
- **Package Manager (PHP):** Composer
- **Package Manager (JS):** npm
- **Testing:** PHPUnit, Jest
- **Code Quality:** ESLint, PHP Code Style

## Project Structure

```
clacker/
├── app/                          # Laravel application code
│   ├── Http/
│   │   ├── Controllers/          # Request handlers
│   │   ├── Requests/             # Form request validation
│   │   └── Middleware/           # HTTP middleware
│   ├── Models/                   # Eloquent models
│   ├── Services/                 # Business logic layer
│   └── Events/                   # Application events
├── database/
│   ├── migrations/               # Database schema
│   ├── seeders/                  # Data seeders
│   └── factories/                # Model factories
├── resources/
│   ├── js/
│   │   ├── app.jsx              # React entry point
│   │   ├── Components/          # Reusable React components
│   │   ├── Pages/               # Page components
│   │   ├── Layouts/             # Layout components
│   │   └── utils/               # Utility functions
│   └── views/                   # Blade templates (if needed)
├── routes/
│   ├── web.php                  # Web routes
│   └── api.php                  # API routes
├── config/
│   ├── app.php                  # App configuration
│   └── database.php             # Database configuration
├── public/                      # Web root
├── tests/                       # Test files
├── docs/                        # Documentation
├── storage/                     # Logs, cache, uploads
├── bootstrap/                   # Framework bootstrap
├── .ai/                         # AI development guides
├── .env.example                 # Environment template
├── composer.json                # PHP dependencies
├── package.json                 # JavaScript dependencies
├── vite.config.js               # Vite configuration
├── tailwind.config.js           # Tailwind CSS configuration
└── README.md                    # Project documentation
```

## Key Features

### Implemented
- ✅ Full-stack architecture with Laravel + React
- ✅ Inertia.js integration for seamless routing
- ✅ Responsive UI with Tailwind CSS
- ✅ Database migrations and seeders
- ✅ RESTful API design
- ✅ Session-based authentication
- ✅ Request validation
- ✅ Comprehensive documentation

## Code Style Standards

### PHP (PSR-12)
- Use 4-space indentation
- Follow Laravel conventions
- Use type hints
- Write meaningful comments

### JavaScript/React (Airbnb)
- Use 2-space indentation
- Use functional components with hooks
- Use arrow functions
- Follow naming conventions

## Database Schema Guidelines

### Standard Tables
- `users` - User accounts
- `posts` - Main content
- Other domain-specific tables

### Timestamp Columns
- `created_at` - Record creation timestamp
- `updated_at` - Last update timestamp
- `deleted_at` - Soft delete timestamp (optional)

### Naming Conventions
- **Tables:** Plural, snake_case (users, blog_posts)
- **Columns:** Singular, snake_case (user_id, post_title)
- **Models:** Singular, PascalCase (User, BlogPost)
- **Controllers:** Plural, PascalCase (UserController)

## React Component Guidelines

### Component Structure
```jsx
import React, { useState, useEffect } from 'react';
import { usePage } from '@inertiajs/react';

export default function ComponentName({ prop1, prop2 }) {
  const [state, setState] = useState(null);
  const { props } = usePage();

  useEffect(() => {
    // Side effects
  }, [dependencies]);

  return (
    <div className="tailwind-classes">
      {/* JSX */}
    </div>
  );
}
```

### Component Organization
- **Pages:** Full-page components in `resources/js/Pages/`
- **Components:** Reusable components in `resources/js/Components/`
- **Layouts:** Layout wrappers in `resources/js/Layouts/`
- **Utils:** Helper functions in `resources/js/utils/`

## Laravel Controller Guidelines

### Controller Structure
```php
namespace App\\Http\\Controllers;

use App\\Models\\Model;
use Inertia\\Inertia;

class ModelController extends Controller
{
    public function index()  // GET /models
    public function show($id)  // GET /models/{id}
    public function create()  // GET /models/create
    public function store()  // POST /models
    public function edit($id)  // GET /models/{id}/edit
    public function update($id)  // PUT /models/{id}
    public function destroy($id)  // DELETE /models/{id}
}
```

## Important Notes for AI Development

1. **Always check:** README.md and docs/ for complete context
2. **Follow:** Architecture patterns described in ARCHITECTURE.md
3. **Respect:** Database schema migrations
4. **Use:** Existing models, controllers, and components as templates
5. **Test:** All changes with appropriate test files
6. **Document:** New features in relevant docs
7. **Validate:** Form requests with Laravel validators
8. **Secure:** Use middleware for authentication/authorization

## Quality Standards

- **Code Coverage:** Aim for >80% test coverage
- **Type Safety:** Use PHP and JavaScript type hints
- **Documentation:** All public methods should have docblocks
- **Performance:** Implement eager loading, caching
- **Security:** Validate input, escape output, use CSRF tokens
