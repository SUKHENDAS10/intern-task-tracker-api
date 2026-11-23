
# Biswas IT Firm - Intern Task Tracker API

## Project Overview

A RESTful API developed using Laravel and MySQL
to manage internship tasks.

## Technologies Used

- PHP
- Laravel
- MySQL
- REST API
- Postman

## Installation

1. Clone the repository.

2. Install dependencies:

   composer install

3. Configure your .env file.

4. Create MySQL database:

   intern_tracker

5. Run migration:

   php artisan migrate

6. Start server:

   php artisan serve

## API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | /api/tasks | Create Task |
| GET | /api/tasks | Get All Tasks |
| GET | /api/tasks/{id} | Get Single Task |
| PUT | /api/tasks/{id} | Update Task |
| DELETE | /api/tasks/{id} | Delete Task |

## Validation

- Title is required.
- Status must be pending, in_progress or completed.
- Priority must be low, medium or high.
- Deadline must be a valid date.

## HTTP Status Codes

- 200: Successful request
- 201: Resource created
- 404: Task not found
- 422: Validation error

## Features

- Create tasks
- View all tasks
- View individual tasks
- Update tasks
- Delete tasks
- Input validation
- Pagination
- JSON responses


## API Testing

Automated API testing is implemented using
Laravel PHPUnit Feature Tests.

### Test Coverage

1. Create Task - Successful Request
2. Create Task - Missing Title
3. Get All Tasks
4. Get Single Task
5. Get Task - Invalid ID
6. Update Task - Successful Request
7. Update Task - Invalid Status
8. Delete Task - Successful Request
9. Delete Task - Invalid ID
10. Create Task - Invalid Status

### Run Tests

```bash
php artisan test --filter=TaskApiTest
```

### Testing Results

Testing results are available in:

task2-test-results.txt

The test results should be updated
after running the automated tests.
