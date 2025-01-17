<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    use HasFactory;

    protected $table = 'director';
    public $timestamps = false;

    protected $fillable = ['name'];

    public function movies() {
        return $this->belongsToMany(
            Movie::class,
            'movies_directors',
            'director_id',
            'movie_id'
        );
    }
}
