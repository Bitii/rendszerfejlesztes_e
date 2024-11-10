<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function register(Request $request)
    {
        $email = $request->input('email');
        $nev = $request->input('nev');
        $jelszo = $request->input('jelszo');

        $request->validate([
            'email' => 'required|email',
            'nev' => 'required',
            'jelszo' => 'required',
        ]);

        if(User::where('email', $email)->exists()) {
            return response([
                'message' => 'Email already exists'
            ], 409);
        }

        $user = User::create([
            'email' => $email,
            'nev' => $nev,
            'jelszo' => Hash::make($jelszo),
            'profil_kep' => null,
            'regisztracios_datum' => now(),
        ]);

        return response([
            'user' => $user,
        ], 200);
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('jelszo');

        $request->validate([
            'email' => 'required|email',
            'jelszo' => 'required',
        ]);
        $user = User::where('email', $email)->first();
        if (!$user || !Hash::check($password, $password ? $user->jelszo : '')) {
            return response([
                'message' => 'Invalid email or password'
            ], 401);
        }

        //régi token törlése és új létrehozása
        $user->tokens()->delete();
        $user->token = $user->createToken('acces')->plainTextToken;
        //abilities can be set https://laravel.com/docs/11.x/sanctum#token-abilities
        //$token = $user->createToken('token-name', ['server:update']);
        return response([
            'user' => $user,
        ]);
    }

    public function logout(Request $request)
    {
        // ellerőrizni, hogy van-e bejelentkezett user
        if ($request->user()) {
            // token törlése
            $request->user()->tokens()->delete();

            return response([
                'message' => 'Logged out successfully'
            ], 200);
        }
            // ha nincs bejelentkezett user
        return response([
            'message' => 'No authenticated user found'
        ], 401);
    }
}
