<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\JokeResource;
use App\Repositories\Joke\Contracts\JokeInterface;

class JokeController extends Controller
{
    public function __construct(private JokeInterface $jokeInterface) {}

    /**
     * Get random jokes
     */
    public function random()
    {
        $jokes =  $this->jokeInterface->random(3);

        return JokeResource::collection($jokes);
    }
}
