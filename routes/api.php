<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;

// Task 2: Task Tracker API
Route::apiResource('tasks', TaskController::class);
