<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\Mechanic;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Register user
     */
    public function registerUser(RegisterUserRequest $request)
    {
        dd(1);
        try{
            $user = User::query()->create($request->validated());
            return response()->json($user, 200);
        } catch (Exception $e) {
            Log::info('Register User Error');
        }
    }

    /**
     * Register user
     */
    public function testEloquent()
    {

    }
}
