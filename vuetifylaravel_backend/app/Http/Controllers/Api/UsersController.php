<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function user()
    {
        return new UserResource(Auth::user());
    }
}
