<?php

namespace App\Http\Controllers\API;

use App\Exceptions\UnauthorizedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Generate access token
     *
     * @param LoginRequest $request
     */
    public function login(LoginRequest $request)
    {
        $user = User::whereEmail($request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            throw new UnauthorizedException();
        }

        $token = $user->createToken($request->userAgent());

        return LoginResource::make(['access_token' => $token->plainTextToken, 'user' => $user]);
    }

    /**
     * Return current user
     */
    public function me()
    {
        $user = request()->user();

        return UserResource::make($user);
    }
}
