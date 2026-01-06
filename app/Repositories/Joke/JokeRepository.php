<?php

namespace App\Repositories\Joke;

use App\Repositories\Joke\Contracts\JokeInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class JokeRepository implements JokeInterface
{
    private string $jokeApiBaseUrl = 'https://official-joke-api.appspot.com/jokes';

    /**
     * Get random jokes
     *
     * @param int $limit
     */
    public function random(int $limit) : array
    {
        $url = $this->jokeApiBaseUrl.'/programming/ten/';

        $response = Http::get($url);

        $jokes = Arr::random($response->json(), $limit);

        return $jokes;
    }
}
