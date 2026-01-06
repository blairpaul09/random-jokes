<?php

namespace App\Exceptions;

use Exception;

class UnauthorizedException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'success' => false,
            'message' => 'Unauthrorized.'
        ], 401);
    }
}
