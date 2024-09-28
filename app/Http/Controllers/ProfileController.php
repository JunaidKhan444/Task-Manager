<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function getProfile(): JsonResponse
    {
        $user = Auth::user();
        return $this->success([
            'profile' => new UserResource($user),
        ]);
    }

    public function updateProfile(Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['required', 'string']
        ]);

        /** @var User */
        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        return $this->success([
            'profile' => new UserResource($user),
        ]);
    }
}
