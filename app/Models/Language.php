<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $table = 'language';
    public $timestamps = false;

    protected $fillable = ['title'];

    public function movies() {
        return $this->belongsToMany(
            Movie::class,
            'movies_languages',
            'language_id',
            'movie_id'
        );
    }
}
