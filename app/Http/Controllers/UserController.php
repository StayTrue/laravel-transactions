<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\User;

class UserController extends Controller
{
    /**
     * Create new user
     *
     * @param CreateUserRequest $request Request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateUserRequest $request)
    {
        $user = User::create($request->validated());

        return response()->json($user, 201);
    }
}
