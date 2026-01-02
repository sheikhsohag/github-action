<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_list_page_can_be_loaded()
    {
        $response = $this->get('/users');

        $response->assertStatus(200);
        $response->assertSee('User List');
    }

    /** @test */
    public function user_can_be_created()
    {
        $response = $this->post('/users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/users');

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);
    }
}
