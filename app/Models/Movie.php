<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $table = 'movie';
    public $timestamps = false;

    protected $fillable = ['title', 'release_date', 'length', 'description'];

    public function genres() {
        return $this->belongsToMany(
            Genre::class,
            'movies_genres',
            'movie_id',
            'genre_id'
        );
    }

    public function performers() {
        return $this->belongsToMany(
            Performer::class,
            'movies_performers',
            'movie_id',
            'performer_id'
        );
    }

    public function directors() {
        return $this->belongsToMany(
            Director::class,
            'movies_directors',
            'movie_id',
            'director_id'
        );
    }

    public function languages() {
        return $this->belongsToMany(
            Language::class,
            'movies_languages',
            'movie_id',
            'language_id'
        );
    }

    public function theaters() {
        return $this->belongsToMany(
            Theater::class,
            'movies_theaters',
            'movie_id',
            'theater_id'
        )->withPivot('room_no', 'start_time', 'end_time');
    }

    public function ratings(){
        return $this->hasMany(Rating::class);
    }
}
