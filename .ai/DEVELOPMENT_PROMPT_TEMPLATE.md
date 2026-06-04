# Clacker Development Prompt Template

> **Purpose:** This template provides a standardized prompt format for AI assistants to understand and modify the Clacker project.

## How to Use This Template

1. Copy this entire template
2. Fill in the bracketed sections [LIKE THIS]
3. Add specific details about what you want built
4. Provide context from the project documentation
5. Submit to your AI assistant

---

## Template Start Here

### Project Context

I'm working on the **Clacker** project - a full-stack Laravel + React application with Inertia.js integration. Please review:

- **Repository:** horobchenko/clacker
- **Tech Stack:** Laravel 11, React 18.2, Tailwind CSS, Vite
- **Key Docs:** README.md, docs/ARCHITECTURE.md, .ai/PROJECT_SPEC.md

### Architecture Reference

The project uses:
- **Backend:** Laravel with Eloquent ORM, RESTful routing
- **Frontend:** React components with Inertia.js for server props
- **Database:** MySQL/PostgreSQL with migrations
- **Styling:** Tailwind CSS utility classes
- **Build:** Vite for fast development and production builds

---

## Task Definition

### What I Want to Build

**Feature Name:** [e.g., User Comments System, Post Scheduling, Advanced Search]

**Description:**
[Provide 2-3 sentences explaining what this feature does]

**User Stories:**
- [ ] [As a user, I can...]
- [ ] [As a user, I can...]
- [ ] [As an admin, I can...]

### Requirements

#### Backend Requirements
- [ ] [Create/Update Model: ModelName]
- [ ] [Create migration for: table_name]
- [ ] [Create controller: ControllerName]
- [ ] [Add routes for: routes]
- [ ] [Implement validation in: RequestClass]
- [ ] [Add business logic in: ServiceClass]

#### Frontend Requirements
- [ ] [Create React component: ComponentName]
- [ ] [Create page: PageName]
- [ ] [Add form with fields: field1, field2]
- [ ] [Style with Tailwind: describe layout]

#### Database Requirements
- [ ] Table: table_name
  - Columns: [column1, column2, ...]
  - Relationships: [relationship1, relationship2]

---

## Technical Specifications

### Database Schema

```php
Schema::create('[table_name]', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('[column_name]');
    $table->text('[column_name]');
    $table->timestamps();
    $table->index('[column_name]');
});
```

### API Endpoints

```
[METHOD] /api/[resource]      → [Description]
[METHOD] /api/[resource]/{id} → [Description]
```

### React Component Structure

```
Pages/
├── [PageName].jsx
Components/
├── [ComponentName].jsx
├── [FormName].jsx
```

---

## Validation Checklist

Before submitting code, ensure:

- [ ] Code follows PSR-12 (PHP) and Airbnb (JS) standards
- [ ] All routes defined in routes/web.php or routes/api.php
- [ ] Database migration created
- [ ] Eloquent relationships defined in models
- [ ] Form validation in Request classes
- [ ] React components use functional components with hooks
- [ ] Tailwind CSS used for styling
- [ ] Error handling implemented
- [ ] Tests written (>80% coverage)
- [ ] Documentation updated in docs/
- [ ] Inertia props properly passed
- [ ] API responses follow RESTful conventions

---

## Expected Deliverables

1. **Backend Code**
   - Migration file
   - Model with relationships
   - Request validation class
   - Controller with methods
   - Routes configuration
   - Tests

2. **Frontend Code**
   - React components
   - Page component
   - Form components
   - Tests

3. **Documentation**
   - Update relevant docs/ files
   - Add inline code comments

4. **Database**
   - Migration file
   - Seeder (if needed)
   - Factory (if needed)

---

## Quick Reference Commands

```bash
npm run dev                          # Start dev servers
npm run build                        # Build for production
php artisan make:model ModelName -m  # Create model with migration
php artisan make:controller ControllerName
php artisan migrate                  # Run migrations
php artisan test                     # Run PHP tests
npm test                             # Run JavaScript tests
```

---

**Replace all [BRACKETED] sections with your specific information and submit to your AI assistant.**
