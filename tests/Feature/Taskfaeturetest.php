<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Taskfaeturetest extends TestCase
{
    use RefreshDatabase; 

    /** @test */
    public function user_can_register_and_login()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticated();
    }

    /** @test */
    public function authenticated_user_can_create_a_task()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/tasks', [
            'title' => 'Test Task',
            'description' => 'Task description',
        ]);

        $response->assertRedirect('/tasks'); // adjust route if needed
        $this->assertDatabaseHas('tasks', [
            'title' => 'Test Task',
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function authenticated_user_can_view_their_task_list()
    {
        $user = User::factory()->create();

        Task::factory()->count(2)->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->get('/tasks');

        $response->assertStatus(200);
        $response->assertSee('Tasks'); // Adjust heading or text based on your blade file
    }
}
