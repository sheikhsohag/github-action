<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_list_page_shows_multiple_users()
    {
        // Arrange: 10 users create
        User::factory()->count(50)->create();

        // Act
        $response = $this->get('/users');

        // Assert
        $response->assertStatus(200);

        // database count check
        $this->assertEquals(50, User::count());
    }

    /** @test */
    public function user_can_be_created_using_factory_data()
    {
        // Arrange: fake data generate (but not saved)
        $userData = User::factory()->make(50)->toArray();

        // Act
        $response = $this->post('/users', [
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => 'password123',
        ]);

        // Assert
        $response->assertRedirect('/users');

        $this->assertDatabaseHas('users', [
            'email' => $userData['email'],
        ]);
    }

    /** @test */
    public function fifty_users_can_be_created_one_by_one()
    {
        // Arrange: create 50 fake users (make, not create)
        $usersData = User::factory()->count(50)->make()->map(function($user) {
            return [
                'name' => $user->name,
                'email' => $user->email,
                'password' => 'password123',
            ];
        });

        foreach ($usersData as $userData) {
            // Act: POST request for each user
            $response = $this->post('/users', [
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => $userData['password'],
            ]);

            // Assert redirect
            $response->assertRedirect('/users');

            // Optional: check DB has this user immediately
            $this->assertDatabaseHas('users', [
                'email' => $userData['email'],
            ]);
        }

        // Final DB count check
        $this->assertDatabaseCount('users', 50);
    }

}
