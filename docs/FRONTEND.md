# Frontend Guide

## Overview

The frontend of Clacker is built with React 18.2, styled with Tailwind CSS, and integrated with Laravel backend using Inertia.js.

## Project Structure

```
resources/js/
├── app.jsx                 # Entry point
├── Components/
│   ├── Button.jsx
│   ├── Card.jsx
│   ├── Modal.jsx
│   └── ...
├── Pages/
│   ├── Dashboard.jsx
│   ├── Profile.jsx
│   └── ...
├── Layouts/
│   ├── AppLayout.jsx
│   ├── GuestLayout.jsx
│   └── AuthLayout.jsx
└── utils/
    ├── api.js
    ├── helpers.js
    └── ...
```

## React Basics

### Component Structure

```jsx
import React, { useState } from 'react';

export default function Counter() {
  const [count, setCount] = useState(0);

  return (
    <div className="p-4">
      <h1 className="text-2xl font-bold">Count: {count}</h1>
      <button
        onClick={() => setCount(count + 1)}
        className="px-4 py-2 bg-blue-500 text-white rounded"
      >
        Increment
      </button>
    </div>
  );
}
```

### Hooks

#### useState

```jsx
const [value, setValue] = useState(initialValue);
```

#### useEffect

```jsx
useEffect(() => {
  // Side effect code
  return () => {
    // Cleanup code
  };
}, [dependencies]);
```

#### useContext

```jsx
const value = useContext(MyContext);
```

## Inertia.js Integration

### Rendering Pages from Controllers

```php
// In Laravel Controller
use Inertia\Inertia;

return Inertia::render('Dashboard', [
    'user' => $user,
    'posts' => $posts,
]);
```

### Accessing Props in React

```jsx
import { usePage } from '@inertiajs/react';

export default function Dashboard() {
  const { props } = usePage();
  const { user, posts } = props;

  return (
    <div>
      <h1>Welcome, {user.name}</h1>
      {posts.map(post => (
        <div key={post.id}>{post.title}</div>
      ))}
    </div>
  );
}
```

### Making Requests

```jsx
import { router } from '@inertiajs/react';

// GET request
router.get('/users');

// POST request
router.post('/users', {
  name: 'John',
  email: 'john@example.com',
});

// PUT/PATCH request
router.patch(`/users/${id}`, data);

// DELETE request
router.delete(`/users/${id}`);
```

### Forms with Inertia

```jsx
import { useForm } from '@inertiajs/react';

export default function CreateUser() {
  const { data, setData, post, processing, errors } = useForm({
    name: '',
    email: '',
  });

  const submit = (e) => {
    e.preventDefault();
    post('/users');
  };

  return (
    <form onSubmit={submit}>
      <input
        type="text"
        value={data.name}
        onChange={(e) => setData('name', e.target.value)}
      />
      {errors.name && <div>{errors.name}</div>}

      <button type="submit" disabled={processing}>
        Create
      </button>
    </form>
  );
}
```

## Tailwind CSS

### Common Utility Classes

```jsx
// Spacing
<div className="p-4 m-2 gap-4">Content</div>

// Text
<p className="text-lg font-bold text-gray-700">Text</p>

// Colors
<div className="bg-blue-500 text-white">Colored</div>

// Layout
<div className="flex gap-4 justify-between">Layout</div>

// Responsive
<div className="text-sm md:text-lg lg:text-xl">Responsive</div>

// Hover/Active
<button className="hover:bg-blue-600 active:bg-blue-700">Button</button>
```

### Creating Custom Components

```jsx
const Button = ({ children, variant = 'primary', ...props }) => {
  const baseStyles = 'px-4 py-2 rounded font-medium';
  const variants = {
    primary: 'bg-blue-500 text-white hover:bg-blue-600',
    secondary: 'bg-gray-200 text-gray-800 hover:bg-gray-300',
    danger: 'bg-red-500 text-white hover:bg-red-600',
  };

  return (
    <button className={`${baseStyles} ${variants[variant]}`} {...props}>
      {children}
    </button>
  );
};
```

## State Management

### useReducer for Complex State

```jsx
const initialState = { count: 0 };

function reducer(state, action) {
  switch (action.type) {
    case 'INCREMENT':
      return { count: state.count + 1 };
    case 'DECREMENT':
      return { count: state.count - 1 };
    default:
      return state;
  }
}

export default function Counter() {
  const [state, dispatch] = useReducer(reducer, initialState);

  return (
    <div>
      <div>Count: {state.count}</div>
      <button onClick={() => dispatch({ type: 'INCREMENT' })}>+</button>
      <button onClick={() => dispatch({ type: 'DECREMENT' })}>-</button>
    </div>
  );
}
```

## API Communication

### Using Axios

```jsx
import axios from 'axios';

const fetchUsers = async () => {
  try {
    const response = await axios.get('/api/users');
    console.log(response.data);
  } catch (error) {
    console.error('Error:', error);
  }
};
```

### Creating API Client

```js
// utils/api.js
import axios from 'axios';

const api = axios.create({
  baseURL: '/api',
  headers: {
    'Content-Type': 'application/json',
  },
});

export const fetchUsers = () => api.get('/users');
export const createUser = (data) => api.post('/users', data);
export const updateUser = (id, data) => api.put(`/users/${id}`, data);
export const deleteUser = (id) => api.delete(`/users/${id}`);

export default api;
```

## Layouts

### App Layout

```jsx
// Layouts/AppLayout.jsx
import { usePage } from '@inertiajs/react';
import Header from '@/Components/Header';
import Sidebar from '@/Components/Sidebar';

export default function AppLayout({ children }) {
  const { user } = usePage().props;

  return (
    <div className="flex h-screen bg-gray-100">
      <Sidebar user={user} />
      <div className="flex-1 flex flex-col">
        <Header user={user} />
        <main className="flex-1 overflow-auto p-4">
          {children}
        </main>
      </div>
    </div>
  );
}
```

### Using Layouts in Pages

```jsx
// Pages/Dashboard.jsx
import AppLayout from '@/Layouts/AppLayout';

export default function Dashboard() {
  return (
    <AppLayout>
      <div>
        <h1>Dashboard</h1>
      </div>
    </AppLayout>
  );
}

Dashboard.layout = (page) => <AppLayout children={page} />;
```

## Performance Optimization

### Code Splitting

```jsx
import React, { lazy, Suspense } from 'react';

const HeavyComponent = lazy(() => import('./HeavyComponent'));

export default function App() {
  return (
    <Suspense fallback={<div>Loading...</div>}>
      <HeavyComponent />
    </Suspense>
  );
}
```

### Memoization

```jsx
import { memo } from 'react';

const UserCard = memo(({ user }) => {
  return <div>{user.name}</div>;
});
```

### useCallback

```jsx
const handleClick = useCallback(() => {
  // Handler code
}, [dependencies]);
```

## Best Practices

1. **Component Organization** - Keep components small and focused
2. **Props Validation** - Document expected props
3. **Error Boundaries** - Handle errors gracefully
4. **Accessibility** - Use semantic HTML and ARIA labels
5. **Performance** - Use lazy loading and code splitting
6. **Testing** - Write unit and integration tests

## Resources

- [React Documentation](https://react.dev)
- [Inertia.js Guide](https://inertiajs.com/client-side-setup)
- [Tailwind CSS Docs](https://tailwindcss.com/docs)
- [Headless UI](https://headlessui.com)
