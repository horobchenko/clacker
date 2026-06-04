# Contributing Guide

Thank you for your interest in contributing to Clacker! This document provides guidelines and instructions for contributing.

## Code of Conduct

We are committed to providing a welcoming and inspiring community for all. Please treat everyone with respect:

- Be inclusive and welcoming
- Be respectful of differing opinions
- Focus on constructive criticism
- Show empathy towards other community members

## Getting Started

### Prerequisites

- PHP 8.1+
- Node.js 16+
- Git
- Composer
- npm

### Setup Development Environment

1. Fork the repository on GitHub
2. Clone your fork locally:
   ```bash
   git clone https://github.com/YOUR_USERNAME/clacker.git
   cd clacker
   ```

3. Add upstream remote:
   ```bash
   git remote add upstream https://github.com/horobchenko/clacker.git
   ```

4. Create a development branch:
   ```bash
   git checkout -b feature/your-feature-name
   ```

5. Install dependencies:
   ```bash
   composer install
   npm install
   ```

6. Set up environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

## How to Report Issues

### Before Creating an Issue

1. Check existing issues to avoid duplicates
2. Review the documentation
3. Try to reproduce the issue

### Creating an Issue

Provide:

- Clear title describing the problem
- Description of the issue
- Steps to reproduce
- Expected behavior
- Actual behavior
- Your environment (PHP version, OS, etc.)
- Screenshots/error logs if applicable

### Issue Title Format

```
[BUG] Short description
[FEATURE] Short description
[DOCUMENTATION] Short description
```

## Making Changes

### Branch Naming Convention

```
feature/description       # New feature
bugfix/description        # Bug fix
docs/description          # Documentation
refactor/description      # Code refactoring
test/description          # Adding tests
```

### Commit Message Format

```
<type>(<scope>): <subject>

<body>

<footer>
```

#### Types

- `feat` - New feature
- `fix` - Bug fix
- `docs` - Documentation changes
- `style` - Code style changes
- `refactor` - Code refactoring
- `perf` - Performance improvements
- `test` - Test additions or changes
- `ci` - CI/CD changes

#### Example

```
feat(auth): add two-factor authentication

Implement TOTP-based two-factor authentication for user accounts.
Users can enable/disable 2FA in their settings.

Closes #123
```

## Code Style

### PHP Code Style

Follow PSR-12 standard. Use Laravel conventions:

```php
// Good
class UserController extends Controller
{
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        
        return Inertia::render('Users/Show', [
            'user' => $user,
        ]);
    }
}

// Bad
class UserController extends Controller {
    public function store(StoreUserRequest $request) {
        $user = User::create($request->all());
        return Inertia::render('Users/Show', ['user' => $user]);
    }
}
```

### JavaScript Code Style

Follow Airbnb style guide:

```jsx
// Good
import React, { useState } from 'react';

const UserForm = ({ onSubmit }) => {
  const [formData, setFormData] = useState({ name: '' });

  const handleSubmit = (e) => {
    e.preventDefault();
    onSubmit(formData);
  };

  return (
    <form onSubmit={handleSubmit}>
      <input
        type="text"
        value={formData.name}
        onChange={(e) => setFormData({ ...formData, name: e.target.value })}
      />
      <button type="submit">Submit</button>
    </form>
  );
};

export default UserForm;
```

## Testing

### Writing Tests

Write tests for new features and bug fixes.

#### PHP Tests

```php
// tests/Feature/UserTest.php
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_can_view_users(): void
    {
        $response = $this->get('/users');
        $response->assertStatus(200);
    }

    public function test_can_create_user(): void
    {
        $response = $this->post('/users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);
        
        $response->assertStatus(201);
        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);
    }
}
```

#### JavaScript Tests

```javascript
// tests/UserForm.test.jsx
import { render, screen, userEvent } from '@testing-library/react';
import UserForm from '../UserForm';

describe('UserForm', () => {
  it('submits form data', async () => {
    const handleSubmit = jest.fn();
    render(<UserForm onSubmit={handleSubmit} />);
    
    const input = screen.getByDisplayValue('');
    await userEvent.type(input, 'John Doe');
    
    const button = screen.getByRole('button');
    await userEvent.click(button);
    
    expect(handleSubmit).toHaveBeenCalledWith({ name: 'John Doe' });
  });
});
```

### Running Tests

```bash
# PHP tests
php artisan test

# JavaScript tests
npm test
```

## Pull Request Process

### Before Submitting

1. Update your branch with latest changes:
   ```bash
   git fetch upstream
   git rebase upstream/master
   ```

2. Run tests:
   ```bash
   php artisan test
   npm test
   ```

3. Check code style:
   ```bash
   npm run lint
   ```

4. Build frontend:
   ```bash
   npm run build
   ```

### Creating Pull Request

1. Push your branch:
   ```bash
   git push origin feature/your-feature
   ```

2. Create PR on GitHub

3. Fill out PR template with:
   - Description of changes
   - Related issues (Closes #123)
   - Type of change (Feature/Bug fix/Documentation)
   - Testing performed
   - Screenshots (if UI changes)

### PR Title Format

```
[FEATURE] Add user authentication
[BUGFIX] Fix database connection error
[DOCS] Update installation guide
```

### Review Process

- Maintainers will review your PR
- Respond to feedback and make requested changes
- Mark conversations as resolved
- Request re-review after changes
- PR will be merged once approved

## Documentation

When adding features, update documentation:

- Update relevant .md files in `/docs`
- Add code examples
- Update API documentation
- Add to README if significant feature

## Additional Resources

- [Laravel Contributing Guide](https://laravel.com/docs/contributions)
- [React Contributing Guide](https://react.dev/learn/contributing)
- [Git Workflow](https://git-scm.com/book/en/v2)

## Questions?

- Check existing discussions
- Ask in GitHub Discussions
- Create an issue to discuss

## Recognition

Contributors will be recognized in:

- README.md contributors section
- GitHub contributors page
- Release notes

Thank you for contributing to Clacker! 🎉
