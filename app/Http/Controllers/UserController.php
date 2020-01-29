<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return response()->json([
            User::paginate()
        ], 200);
    }

    public function store(Request $request, StoreUserRequest $validatedRequest)
    {
        return response()->json(User::createOrUpdateItem($validatedRequest), 200);
    }

    public function show(User $user)
    {
        return response()->json($user, 200);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        return response()->json(User::createOrUpdateItem($request, $user), 200);
    }

    public function destroy(User $user)
    {
        return $user->delete()
            ? response()->json([], 200)
            : response()->json([], 400);
    }

    public function restore(User $user)
    {
        return $user->restore()
            ? response()->json([], 200)
            : response()->json([], 400);
    }
}
