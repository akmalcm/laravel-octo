<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performer extends Model
{
    use HasFactory;

    protected $table = 'performer';
    public $timestamps = false;

    protected $fillable = ['name'];

    public function movies() {
        return $this->belongsToMany(
            Movie::class,
            'movies_performers',
            'performer_id',
            'movie_id'
        );
    }
}
