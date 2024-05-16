<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFriendRequest;
use App\Http\Resources\FriendResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function index(Request $request)
    {
        return ['data' => FriendResource::collection($request->user()->friends())];
    }

    public function store(User $user, Request $request)
    {
        $request->user()->makeFriend($user);
        return ['data' => FriendResource::collection($request->user()->friends())];
    }
}
