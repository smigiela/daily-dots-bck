<?php

namespace Tests\Feature\Eloquent;


use App\Models\Diary\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_show_all_users_tasks(): void
    {
        $user = User::factory()->create();

        $task = Task::factory()->make(['user_id' => $user->id])->toArray();
        $task2 = Task::factory()->make(['user_id' => $user->id])->toArray();

        $user->tasks()->createMany([$task, $task2]);

        $response = $this->actingAs($user)->get('/api/tasks');

        $response->assertStatus(200);
        $response->assertJsonCount(2);
    }

    public function test_user_can_show_one_task(): void
    {
        $user = User::factory()->create();

        $task = Task::factory()->make(['user_id' => $user->id])->toArray();

        $task = $user->tasks()->create($task);

        $response = $this->actingAs($user)->get('/api/tasks/' . $task->id);

        $response->assertStatus(200);
        $response->assertJson(['title' => $task['title']]);
    }

    public function test_user_can_create_task(): void
    {
        $user = User::factory()->create();

        $data = Task::factory()->make(['user_id' => $user->id])->toArray();

        $response = $this->actingAs($user)->post('/api/tasks', $data);
        $response->assertStatus(201);
        $response->assertJson(['success' => true]);
    }

    public function test_user_can_update_task()
    {
        $user = User::factory()->create();

        $taskInDb = $user->tasks()->create(Task::factory()->make()->toArray());

        $newData = Task::factory()->make(['title' => 'edited title'])->toArray();

        $response = $this->actingAs($user)->put('/api/tasks/' . $taskInDb->id, $newData);
        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
dd(Task::findOrFail($taskInDb->id));
        self::assertSame(Task::findOrFail($taskInDb->id), $newData['title']);
    }
}
