<?php

namespace Tests\Feature\API\AuthController;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MeTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Success test to get the authenticated user
     */
    public function test_success_me(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->getJson(route('auth.me'));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                ]
            ]);
    }
}
