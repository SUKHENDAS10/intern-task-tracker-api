
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
