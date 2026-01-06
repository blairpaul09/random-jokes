<?php

namespace App\Repositories\Joke\Contracts;

interface JokeInterface
{
    /**
     * Get random jokes
     *
     * @param int $limit
     */
    public function random(int $limit) : array;
}
