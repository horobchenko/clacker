# API Documentation

## Overview

Clacker uses RESTful API design principles with JSON responses. The API is integrated with Inertia.js for server-side rendering with React.

## Base URL

```
http://localhost:8000/api
```

## Authentication

API uses Laravel's default session-based authentication. Include credentials in requests:

```javascript
axios.defaults.withCredentials = true;
```

## Response Format

All responses are in JSON format:

```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "John"
  },
  "message": "Request successful"
}
```

## Status Codes

| Code | Meaning |
|------|----------|
| 200 | OK |
| 201 | Created |
| 400 | Bad Request |
| 401 | Unauthorized |
| 403 | Forbidden |
| 404 | Not Found |
| 422 | Validation Error |
| 500 | Server Error |

## Endpoints

### Users

#### List Users

```
GET /users
```

Query Parameters:
- `page` - Page number (default: 1)
- `per_page` - Items per page (default: 15)
- `sort` - Sort field (default: created_at)
- `order` - Sort order (asc/desc, default: desc)

Response:

```json
{
  "data": [
    {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "created_at": "2024-01-01T12:00:00Z"
    }
  ],
  "pagination": {
    "total": 100,
    "per_page": 15,
    "current_page": 1,
    "last_page": 7
  }
}
```

#### Get User

```
GET /users/{id}
```

Response:

```json
{
  "data": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "posts": [
      {
        "id": 1,
        "title": "First Post",
        "body": "Content"
      }
    ],
    "created_at": "2024-01-01T12:00:00Z"
  }
}
```

#### Create User

```
POST /users
Content-Type: application/json

{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123"
}
```

Response (201 Created):

```json
{
  "data": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "created_at": "2024-01-01T12:00:00Z"
  },
  "message": "User created successfully"
}
```

#### Update User

```
PUT /users/{id}
Content-Type: application/json

{
  "name": "Jane Doe",
  "email": "jane@example.com"
}
```

#### Delete User

```
DELETE /users/{id}
```

Response (204 No Content)

### Posts

#### List Posts

```
GET /posts
```

Query Parameters:
- `page` - Page number
- `per_page` - Items per page
- `status` - Filter by status (draft, published, archived)
- `user_id` - Filter by user

#### Get Post

```
GET /posts/{id}
```

#### Create Post

```
POST /posts
Content-Type: application/json

{
  "title": "My First Post",
  "body": "Post content here",
  "status": "published"
}
```

#### Update Post

```
PUT /posts/{id}
Content-Type: application/json

{
  "title": "Updated Title",
  "body": "Updated content",
  "status": "published"
}
```

#### Delete Post

```
DELETE /posts/{id}
```

## Error Responses

### Validation Error (422)

```json
{
  "message": "The given data was invalid.",
  "errors": {
    "email": ["The email field is required."],
    "name": ["The name field is required."]
  }
}
```

### Unauthorized (401)

```json
{
  "message": "Unauthenticated."
}
```

### Server Error (500)

```json
{
  "message": "Server error occurred",
  "error": "Error details..."
}
```

## Rate Limiting

API endpoints are rate limited to prevent abuse.

Default: 60 requests per minute per IP

Headers:
- `X-RateLimit-Limit` - Maximum requests
- `X-RateLimit-Remaining` - Remaining requests
- `X-RateLimit-Reset` - Reset timestamp

## Pagination

List endpoints return paginated results:

```json
{
  "data": [...],
  "links": {
    "first": "http://localhost:8000/api/users?page=1",
    "last": "http://localhost:8000/api/users?page=5",
    "prev": "http://localhost:8000/api/users?page=1",
    "next": "http://localhost:8000/api/users?page=3"
  },
  "meta": {
    "current_page": 2,
    "from": 16,
    "last_page": 5,
    "per_page": 15,
    "to": 30,
    "total": 70
  }
}
```

## Filtering

Many endpoints support filtering:

```
GET /posts?status=published&user_id=1
```

## Sorting

Sort results using query parameters:

```
GET /users?sort=name&order=asc
GET /posts?sort=created_at&order=desc
```

## Including Relations

Include related data:

```
GET /users/1?include=posts,comments
```

## Code Examples

### Fetch All Users (JavaScript)

```javascript
import axios from 'axios';

const fetchUsers = async () => {
  try {
    const response = await axios.get('/api/users');
    console.log(response.data);
  } catch (error) {
    console.error('Error:', error.response.data);
  }
};
```

### Create User (cURL)

```bash
curl -X POST http://localhost:8000/api/users \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123"
  }'
```

### Update Post (React/Inertia)

```jsx
import { router } from '@inertiajs/react';

const updatePost = (id, data) => {
  router.patch(`/posts/${id}`, data);
};
```

## Testing API

Use these tools to test the API:

- **Postman** - https://www.postman.com
- **Insomnia** - https://insomnia.rest
- **Thunder Client** (VS Code Extension)
- **cURL** - Command line HTTP client

## Versioning

Current API version: v1

Future versions will be available at `/api/v2`, etc.
