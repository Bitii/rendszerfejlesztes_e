<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'felhasznalok';
    public $timestamps = false;

    protected $fillable = [
        'email',
        'nev',
        'jelszo',
    ];

    protected $hidden = [
        'jelszo', 
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'jelszo' => 'hashed', 
        ];
    }

    public function getMovieInfo($user_id)
    {
        $movies = FelhasznaloInfo::where('user_id', $user_id)
            ->join('movies', 'felhasznalo_info.movie_id', '=', 'movies.id')
            ->select(
                'felhasznalo_info.id as info_id',
                'felhasznalo_info.favorite',
                'felhasznalo_info.bookmark',
                'felhasznalo_info.seen',
                'movies.title',
                'movies.image'
            )
            ->get();
    
        return response()->json(['movies' => $movies], 200);
    }
    
    
}
