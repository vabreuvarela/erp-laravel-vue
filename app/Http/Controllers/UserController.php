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

    public function store(StoreUserRequest $request)
    {
        return response()->json([ 'data' => [ User::createOrUpdateItem($request) ] ], 200);
    }

    public function show(User $user)
    {
        return response()->json([ 'data' => [ $user ] ], 200);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        return response()->json([ 'data' => [ User::createOrUpdateItem($request, $user) ] ], 200);
    }

    public function destroy(User $user)
    {
        return $user->delete()
            ? response()->json([ 'message' => $user->id . trans('messages.deleted.success') ], 200)
            : response()->json([
                "message" => $user->id . trans('messages.deleted.failed'),
                "errors" => []
            ], 400);
    }

    public function restore(User $user)
    {
        return $user->restore()
            ? response()->json([ 'message' => $user->id . trans('messages.restored.success') ], 200)
            : response()->json([
                    'message' => $user->id . trans('messages.restored.failed'),
                    'errors' => []
                ], 400);
    }
}
