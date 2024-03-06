<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request) : UserCollection
    {
        $users = User::all();

		return new UserCollection($users);
    }

    public function store(UserRequest $request)
    {
        $validated = $request->validated();

		$validated['password'] = Hash::make($validated['password']);

		$user = User::create($validated);

		return response()->json([
			'success' => true,
			'message' => 'User succesfully added',
		]);
    }

    public function show(Request $request, User $user) : UserResource {

        return new UserResource($user);
    }

    public function update(UserRequest $request, User $user)
    {
        $validated = $request->validated();

		if (empty($validated['password'])) {
			unset($validated['password']);
		} else {
			$validated['password'] = Hash::make($validated['password']);
		}

		$user->update($validated);

		return response()->json([
			'success' => true,
			'message' => 'User succesfully update',
		]);
    }

    public function destroy(User $user)
    {
		$user->delete();

		return response()->json([
			'success' => true,
			'message' => 'User succesfully delete ',
		]);
    }
}
