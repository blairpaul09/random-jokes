<?php

namespace Tests\Feature\API\JokeController;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RandomTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Success test to get random jokes
     */
    public function test_success_random_jokes(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->getJson(route('get.random-jokes'));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'type',
                        'setup',
                        'punchline',
                    ],
                ],
            ]);
    }
}
