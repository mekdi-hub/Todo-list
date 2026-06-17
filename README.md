# Todo List API

A Laravel REST API for managing tasks and categories with authentication.

## Technologies

- Laravel 11
- SQLite/MySQL
- Laravel Sanctum (Authentication)
- REST API
- Postman

## Installation

### Clone project:
```bash
git clone your-project-url
cd backend
```

### Install dependencies:
```bash
composer install
```

### Create environment:
```bash
copy .env.example .env
```

### Generate key:
```bash
php artisan key:generate
```

### Run migrations:
```bash
php artisan migrate
```

### Start server:
```bash
php artisan serve
```

The API will be available at `http://127.0.0.1:8000`

## API Documentation

### Base URL
```
http://127.0.0.1:8000/api
```

---

## Authentication APIs

### Register
**POST** `/api/register`

**Body:**
```json
{
  "name": "Abebe",
  "email": "abebe@gmail.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

**Response:**
```json
{
  "message": "registered successfully",
  "token": "xxxxx"
}
```

---

### Login
**POST** `/api/login`

**Body:**
```json
{
  "email": "abebe@gmail.com",
  "password": "password123"
}
```

**Response:**
```json
{
  "token": "xxxxx"
}
```

---

### Logout
**POST** `/api/logout`

**Headers:**
```
Authorization: Bearer {token}
```

**Response:**
```json
{
  "message": "Logged out successfully"
}
```

---

## Authentication Setup in Postman

For protected routes, add the token in Postman:

1. Go to **Authorization** tab
2. Select **Bearer Token**
3. Paste your token

---

## Category APIs

### Create Category
**POST** `/api/categories`

**Headers:**
```
Authorization: Bearer {token}
```

**Body:**
```json
{
  "name": "Programming",
  "description": "Programming tasks",
  "image": "programming.png"
}
```

---

### Get All Categories
**GET** `/api/categories`

**Headers:**
```
Authorization: Bearer {token}
```

**Response:**
```json
{
  "data": [
    {
      "id": 1,
      "name": "Programming",
      "description": "Programming tasks",
      "image": "programming.png"
    }
  ]
}
```

---

### Get Single Category
**GET** `/api/categories/{id}`

**Headers:**
```
Authorization: Bearer {token}
```

---

### Update Category
**PUT** `/api/categories/{id}`

**Headers:**
```
Authorization: Bearer {token}
```

**Body:**
```json
{
  "name": "Updated Programming",
  "description": "Updated description"
}
```

---

### Delete Category
**DELETE** `/api/categories/{id}`

**Headers:**
```
Authorization: Bearer {token}
```

---

## Task APIs

### Create Task
**POST** `/api/tasks`

**Headers:**
```
Authorization: Bearer {token}
```

**Body:**
```json
{
  "title": "Learn Laravel",
  "description": "CRUD practice",
  "category_id": 1,
  "status": "Pending",
  "priority": "High",
  "due_date": "2026-06-30",
  "due_time": "12:00"
}
```

**Status Options:** `Pending`, `In Progress`, `Completed`

**Priority Options:** `Low`, `Medium`, `High`

---

### Get All Tasks
**GET** `/api/tasks`

**Headers:**
```
Authorization: Bearer {token}
```

---

### Get Single Task
**GET** `/api/tasks/{id}`

**Headers:**
```
Authorization: Bearer {token}
```

---

### Update Task
**PUT** `/api/tasks/{id}`

**Headers:**
```
Authorization: Bearer {token}
```

**Body:**
```json
{
  "title": "Updated title",
  "description": "Updated description",
  "status": "In Progress",
  "priority": "Medium"
}
```

---

### Delete Task
**DELETE** `/api/tasks/{id}`

**Headers:**
```
Authorization: Bearer {token}
```

---

### Complete Task
**PATCH** `/api/tasks/{id}/complete`

**Headers:**
```
Authorization: Bearer {token}
```

**Response:**
```json
{
  "message": "Task marked as completed"
}
```

---

## Task Filtering & Search

### Search Tasks
**GET** `/api/tasks?search=Laravel`

Search by title or description.

---

### Filter by Status
**GET** `/api/tasks?status=Pending`

**GET** `/api/tasks?status=In Progress`

**GET** `/api/tasks?status=Completed`

---

### Filter by Priority
**GET** `/api/tasks?priority=High`

**GET** `/api/tasks?priority=Medium`

**GET** `/api/tasks?priority=Low`

---

### Filter by Category
**GET** `/api/tasks?category_id=1`

---

## Task Sorting

### Latest First
**GET** `/api/tasks?sort=latest`

---

### Oldest First
**GET** `/api/tasks?sort=oldest`

---

### Sort by Priority
**GET** `/api/tasks?sort=priority`

(High → Medium → Low)

---

## Pagination

**GET** `/api/tasks?page=1`

**GET** `/api/tasks?page=2`

**Response:**
```json
{
  "data": [...],
  "current_page": 1,
  "per_page": 10,
  "total": 25,
  "last_page": 3
}
```

---

## Combined Filters

You can combine multiple query parameters:

**GET** `/api/tasks?status=Pending&priority=High&search=Laravel&sort=latest&page=1`

---

## Dashboard

### Get Dashboard Statistics
**GET** `/api/dashboard`

**Headers:**
```
Authorization: Bearer {token}
```

**Response:**
```json
{
  "total_tasks": 10,
  "completed_tasks": 4,
  "pending_tasks": 6,
  "high_priority_tasks": 3,
  "total_categories": 2
}
```

---

## Error Responses

### Validation Error (422)
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "email": ["The email field is required."]
  }
}
```

### Unauthorized (401)
```json
{
  "message": "Unauthenticated."
}
```

### Not Found (404)
```json
{
  "message": "Task not found"
}
```

---

## Testing with Postman

1. **Register** a new user or **Login**
2. Copy the returned **token**
3. For all protected routes:
   - Go to **Authorization** tab
   - Select **Bearer Token**
   - Paste your token
4. Test the endpoints

---

## Project Structure

```
backend/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Api/
│   │   │       ├── Authcontroller.php
│   │   │       ├── CategoryController.php
│   │   │       ├── TaskController.php
│   │   │       └── DashboardController.php
│   │   ├── Requests/
│   │   │   └── storetaskrequest.php
│   │   └── Resources/
│   │       ├── CategoryResource.php
│   │       └── TaskResource.php
│   └── Models/
│       ├── User.php
│       ├── Category.php
│       └── Task.php
├── database/
│   └── migrations/
├── routes/
│   └── api.php
└── README.md
```

---

## Features

✅ User Authentication (Register, Login, Logout)  
✅ Task CRUD Operations  
✅ Category Management  
✅ Task Search & Filtering  
✅ Task Sorting (Latest, Oldest, Priority)  
✅ Task Pagination  
✅ Dashboard Statistics  
✅ Complete Task Feature  
✅ API Resource Transformers  

---

## License

This project is open-sourced software.
