<?php

namespace App\Http\Controllers;

use App\Http\Requests\GrantUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return ['data' => UserResource::collection(User::get())];
    }

    public function show(User $user)
    {
        return ['data' => UserResource::make($user)];
    }

    public function store(StoreUserRequest $request)
    {
        $user = new User();
        $user->fill($request->validated());
        $user->slug = $this->generateSlug($request->validated()["name"]);
        $user->avatar = $request->file('avatar')->store('avatars');
        $user->save();

        return ['data' => UserResource::make($user)];
    }

    public function update(StoreUserRequest $request, User $user)
    {
        $user->fill($request->get());
        $user->save();
        return ['data' => UserResource::make($user)];
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->noContent();
    }

    public function grant(GrantUserRequest $request)
    {
        $user = User::where('id', '=', $request->uid)->first();
        $user->permissions_level = $request->permissions_level;
        $user->save();
        return ['data' => UserResource::make($user)];
    }

    public function getAvatar($filename)
    {
        return response()->file(storage_path('app/avatars/' . $filename));
    }

    private function generateSlug($name)
    {
        $countOfSlug = User::where('slug', $name)->count();
        if ($countOfSlug === 0) {
            return strtolower($name);
        }
        return $name->toLowerCase() . '-' . $countOfSlug;
    }
}
