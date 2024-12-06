<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FelhasznaloInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:felhasznalok,email',
            'nev' => 'required',
            'jelszo' => 'required',
        ]);

        $user = User::create([
            'email' => $request->input('email'),
            'nev' => $request->input('nev'),
            'jelszo' => Hash::make($request->input('jelszo')),
        ]);

        return response([
            'user' => $user,
        ], 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'jelszo' => 'required',
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if (!$user || !Hash::check($request->input('jelszo'), $user->jelszo)) {
            return response(['message' => 'Invalid email or password'], 401);
        }

        $user->tokens()->delete();
        $user->token = $user->createToken('access')->plainTextToken;

        return response([
            'user' => $user,
        ]);
    }

    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->tokens()->delete();

            return response(['message' => 'Logged out successfully'], 200);
        }

        return response(['message' => 'No authenticated user found'], 401);
    }

    public function updateMovieInfo(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:felhasznalok,id',
            'movie_id' => 'required',
        ]);

        $updated = FelhasznaloInfo::updateOrCreate(
            [
                'user_id' => $request->input('user_id'),
                'movie_id' => $request->input('movie_id'),
            ],
            [
                'favorite' => $request->input('favorite') ?? false,
                'bookmark' => $request->input('bookmark') ?? false,
                'seen' => $request->input('seen') ?? false,
            ]
        );

        if ($updated) {
            return response(['message' => 'Movie info updated successfully'], 200);
        }

        return response(['message' => 'Failed to update movie info'], 500);
    }

    public function getMovieInfo($user_id)
    {
        $movies = FelhasznaloInfo::where('user_id', $user_id)->get();

        return response(['movies' => $movies], 200);
    }
}
