<?php
namespace Tests\Feature;
use Tests\TestCase;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskApiTest extends TestCase
{
    use RefreshDatabase;

    // Reusable Task Data
    private function createTask()
    {
        return Task::create([
            'title' => 'Learn Laravel API',
            'description' => 'Practice CRUD operations',
            'status' => 'pending',
            'priority' => 'medium',
            'deadline' => now()->addDays(5)->toDateString(),
        ]);
    }

    // Test 1: Create Task Successfully
    public function test_task_can_be_created(): void
    {
        $response = $this->postJson('/api/tasks', [
            'title' => 'Learn Laravel API',
            'description' => 'Practice CRUD operations',
            'status' => 'pending',
            'priority' => 'high',
            'deadline' => now()->addDays(5)->toDateString(),
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'Task created successfully.',
            ]);

        $this->assertDatabaseHas('tasks', [
            'title' => 'Learn Laravel API',
            'priority' => 'high',
        ]);
    }

    // Test 2: Create Task Without Title
    public function test_task_cannot_be_created_without_title(): void
    {
        $response = $this->postJson('/api/tasks', [
            'description' => 'Practice CRUD operations',
            'status' => 'pending',
            'priority' => 'medium',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['title']);

        $this->assertDatabaseCount('tasks', 0);
    }

    // Test 3: Get All Tasks
    public function test_all_tasks_can_be_retrieved(): void
    {
        $task = $this->createTask();

        $response = $this->getJson('/api/tasks');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Tasks retrieved successfully.',
            ])
            ->assertJsonFragment([
                'title' => $task->title,
            ]);
    }

    // Test 4: Get Single Task
    public function test_single_task_can_be_retrieved(): void
    {
        $task = $this->createTask();

        $response = $this->getJson(
            "/api/tasks/{$task->id}"
        );

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ])
            ->assertJsonFragment([
                'title' => 'Learn Laravel API',
            ]);
    }

    // Test 5: Get Non-existing Task
    public function test_non_existing_task_returns_404(): void
    {
        $response = $this->getJson('/api/tasks/999999');

        $response->assertStatus(404)
            ->assertJson([
                'success' => false,
                'message' => 'Task not found.',
            ]);
    }

    // Test 6: Update Task Successfully
    public function test_task_can_be_updated(): void
    {
        $task = $this->createTask();

        $response = $this->putJson(
            "/api/tasks/{$task->id}",
            [
                'title' => 'Updated Laravel Task',
                'description' => 'Task updated successfully',
                'status' => 'completed',
                'priority' => 'high',
                'deadline' => now()->addDays(10)->toDateString(),
            ]
        );

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Task updated successfully.',
            ]);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Updated Laravel Task',
            'status' => 'completed',
            'priority' => 'high',
        ]);
    }

    // Test 7: Update Task With Invalid Status
    public function test_task_cannot_be_updated_with_invalid_status(): void
    {
        $task = $this->createTask();

        $response = $this->putJson(
            "/api/tasks/{$task->id}",
            [
                'status' => 'wrong_status',
            ]
        );

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['status']);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'status' => 'pending',
        ]);
    }

    // Test 8: Delete Task Successfully
    public function test_task_can_be_deleted(): void
    {
        $task = $this->createTask();

        $response = $this->deleteJson(
            "/api/tasks/{$task->id}"
        );

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Task deleted successfully.',
            ]);

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }

    // Test 9: Delete Non-existing Task
    public function test_non_existing_task_cannot_be_deleted(): void
    {
        $response = $this->deleteJson('/api/tasks/999999');

        $response->assertStatus(404)
            ->assertJson([
                'success' => false,
                'message' => 'Task not found.',
            ]);
    }

    // Test 10: Create Task With Invalid Priority
    public function test_task_cannot_be_created_with_invalid_priority(): void
    {
        $response = $this->postJson('/api/tasks', [
            'title' => 'Invalid Priority Task',
            'description' => 'Testing invalid priority',
            'status' => 'pending',
            'priority' => 'urgent',
            'deadline' => now()->addDays(5)->toDateString(),
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['priority']);

        $this->assertDatabaseCount('tasks', 0);
    }
}
