<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    
    protected $table = 'genre';
    public $timestamps = false;
    
    protected $fillable = ['title'];

    public function movies() {
        return $this->belongsToMany(
            Movie::class,
            'movies_genres',
            'genre_id',
            'movie_id'
        );
    }
}
