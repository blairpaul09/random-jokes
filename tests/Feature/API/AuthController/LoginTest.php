<?php

namespace Tests\Feature\API\AuthController;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test success login
     */
    public function test_success_login(): void
    {
        $password = 'password';

        $user = User::factory()->create(['password' => $password]);

        $credentials = [
            'email' => $user->email,
            'password' => $password,
        ];

        $response = $this->postJson(route('auth.login'), $credentials);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'access_token',
                    'user' => [
                        'id',
                        'name',
                        'email',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ])
        ->assertJson([
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ]
            ]
        ]);
    }
}
