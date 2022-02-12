<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function movies() {
        return $this->belongsToMany(
            Movie::class,
            'movies_theaters',
            'theater_id',
            'movie_id'
        );
    }
}