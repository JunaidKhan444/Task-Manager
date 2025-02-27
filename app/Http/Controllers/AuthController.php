<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function  signUp(Request $request): JsonResponse
    {
        $request->validate(rules: [
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string', Password::min(8)->letters()->numbers()],
            'name' => ['required', 'string'],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return $this->success();
    }

    public function signIn(Request $request): JsonResponse
    {
        $request->validate(rules: [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return $this->error(message: 'Invalid credentials.');
        }

        if (!Hash::check($request->password, $user->password)) {
            return $this->error(message: 'Invalid credentials.');
        }

        return $this->success(['access_token' => $user->createToken('login')->plainTextToken]);
    }

    public function signOut(Request $request): JsonResponse
    {
        if ($request->user()) {
            $request->user()->currentAccessToken()->delete();
        }

        return $this->success();
    }
}
