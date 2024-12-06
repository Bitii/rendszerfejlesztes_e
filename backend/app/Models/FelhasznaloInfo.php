<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FelhasznaloInfo extends Model
{
    use HasFactory;

    protected $table = 'felhasznalo_info';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'movie_id',
        'favorite',
        'bookmark',
        'seen',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
