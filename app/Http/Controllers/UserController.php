<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Lang;

class UserController extends Controller
{
    public function index()
    {
        return response()->json([User::paginate()], 200);
    }

    public function store(StoreUserRequest $request)
    {
        return response()->json(['data' => [User::createOrUpdateItem($request)]], 200);
    }

    public function show(User $user)
    {
        return response()->json(['data' => [$user]], 200);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        return response()->json(['data' => [User::createOrUpdateItem($request, $user)]], 200);
    }

    public function destroy(User $user)
    {
        return $user->delete()
            ? response()->json(['message' => Lang::get('messages.deleted.success', ['name' => $user->name])], 200)
            : response()->json(["message" =>  Lang::get('messages.deleted.fail', ['name' => $user->name]), "errors" => []], 400);
    }

    public function restore(User $user)
    {
        return $user->restore()
            ? response()->json(['message' => Lang::get('messages.restored.success', ['name' => $user->name])], 200)
            : response()->json(['message' => Lang::get('messages.restored.fail', ['name' => $user->name]), 'errors' => []], 400);
    }
}
