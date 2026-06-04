# AI Development Guide for Clacker

## Overview

This directory contains AI-readable specifications and templates for developing the Clacker project with the help of AI assistants (GitHub Copilot, ChatGPT, Claude, etc.).

## Files in This Directory

### 1. `PROJECT_SPEC.md`
**AI-Readable Project Specification**

Comprehensive, machine-friendly specification including:
- Technology stack details
- Project structure
- Code style standards
- Database conventions
- Component guidelines

**Use this when:** You want the AI to understand the complete project context.

### 2. `DEVELOPMENT_PROMPT_TEMPLATE.md`
**Template for AI Development Requests**

Structured template for communicating feature requirements:
- Project context section
- Task definition
- Requirements checklist
- Technical specifications
- Validation checklist

**Use this when:** Requesting new features or modifications.

---

## Quick Start for AI Development

### Step 1: Understand the Project

Ask your AI assistant to review the project spec:

```
"Please read .ai/PROJECT_SPEC.md to understand the Clacker 
project structure, conventions, and development patterns."
```

### Step 2: Request a Feature

Use the development prompt template:

```
"I want to build a new feature. Here's my detailed requirement:

[Paste filled template here]"
```

### Step 3: Review & Iterate

```
"Please review the code against PROJECT_SPEC.md for:
- Correct architecture patterns
- Proper naming conventions
- Database schema compliance
- Code style standards"
```

---

## Common AI Development Tasks

### Create a New Feature

```
Context: Clacker project (see .ai/PROJECT_SPEC.md)

Feature: [Name]
Requirements: [Use DEVELOPMENT_PROMPT_TEMPLATE.md]

Please provide:
1. Database migration
2. Eloquent model with relationships
3. Laravel controller
4. React components
5. Tests
6. Documentation updates
```

### Fix a Bug

```
Bug: [Description]
Current Behavior: [What happens]
Expected Behavior: [What should happen]

Please:
1. Identify root cause
2. Implement fix
3. Add regression tests
```

---

## Best Practices

### Before Making a Request

1. ✅ Review PROJECT_SPEC.md
2. ✅ Check existing code for similar implementations
3. ✅ Define requirements clearly
4. ✅ Specify database changes
5. ✅ Provide context from docs/

### When Requesting Code

1. ✅ Be specific - Not "make it better", but "optimize queries"
2. ✅ Reference docs - Point to relevant patterns
3. ✅ Include examples - Show existing code as reference
4. ✅ List requirements - Use checklist format
5. ✅ Specify deliverables - What files and tests to generate

### After Receiving Code

1. ✅ Validate against PROJECT_SPEC.md
2. ✅ Test locally
3. ✅ Review patterns
4. ✅ Check documentation
5. ✅ Run tests

---

## Key Points for AI Assistants

When an AI assistant is helping with Clacker development:

1. **Follow PROJECT_SPEC.md** - Source of truth for patterns
2. **Database migrations** - Always create proper migrations
3. **Test coverage** - Write tests for all code (>80%)
4. **Documentation** - Update relevant files in docs/
5. **Code style** - PSR-12 for PHP, Airbnb for JavaScript
6. **Architecture** - Follow Inertia.js patterns
7. **Type hints** - Use PHP type hints and JSDoc
8. **Relationships** - Define in models using Eloquent

---

## Resources

- **Project README:** `../README.md`
- **Architecture Guide:** `../docs/ARCHITECTURE.md`
- **Development Guide:** `../docs/DEVELOPMENT.md`
- **Database Guide:** `../docs/DATABASE.md`
- **Frontend Guide:** `../docs/FRONTEND.md`
- **API Documentation:** `../docs/API.md`
- **Contributing:** `../docs/CONTRIBUTING.md`

---

**Last Updated:** 2026-06-04

For support, refer to docs/CONTRIBUTING.md
