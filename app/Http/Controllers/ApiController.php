<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ApiController extends Controller {

    public function genre(Request $request) {

        if ($request->genre) {
            
            $genre = Genre::find($request->genre);
            return $request->genre;
        }
    }

    public function timeslot() {
    }

    public function specificMovieTheater() {
    }

    public function searchPerformer() {
    }

    public function giveRating() {
    }

    public function newMovie() {
    }

    public function addMovie() {
    }
}
