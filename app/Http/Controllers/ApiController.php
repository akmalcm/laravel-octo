<?php

namespace App\Http\Controllers;

use App\Models\Director;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Movie;
use App\Models\Performer;
use App\Models\Rating;
use App\Models\Theater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ApiController extends Controller {

    public function genre(Request $request) {

        if ($request->genre) {
            $genre = Genre::where('title', $request->genre)->firstOrFail();
            $data = array();

            foreach ($genre->movies as $movie) {
                array_push(
                    $data,
                    [
                        'Movie_ID' => $movie->id,
                        'Title' => $movie->title,
                        'Genre' => $genre->title,
                        'Description' => $movie->description
                    ]
                );
            }

            return response()->json($data, 200);
        }
    }

    public function timeslot(Request $request) {

        if ($request->theater_name && $request->time_start && $request->time_end) {
            $theater = Theater::where('name', $request->theater_name)->firstOrFail();
            $data = array();

            foreach ($theater->movies()->wherePivot('start_time', '>=', $request->time_start)->wherePivot('end_time', '<=', $request->time_end)->get() as $movie) {
                array_push(
                    $data,
                    [
                        'Movie_ID' => $movie->id,
                        'Title' => $movie->title,
                        'Theater_name' => $theater->name,
                        'Start_time' => $movie->pivot->start_time,
                        'End_time' => $movie->pivot->end_time,
                        'Description' => $movie->description,
                        'Theater_room_no' => $movie->pivot->room_no
                    ]
                );
            }

            return response()->json($data, 200);
        }
    }

    public function specificMovieTheater(Request $request) {

        if ($request->theater_name && $request->d_date) {
            $theater = Theater::where('name', $request->theater_name)->firstOrFail();
            $data = array();

            foreach ($theater->movies()->wherePivot('start_time', 'like', '%' . $request->d_date . '%')->get() as $movie) {
                array_push(
                    $data,
                    [
                        'Movie_ID' => $movie->id,
                        'Title' => $movie->title,
                        'Theater_name' => $theater->name,
                        'Start_time' => $movie->pivot->start_time,
                        'End_time' => $movie->pivot->end_time,
                        'Description' => $movie->description,
                        'Theater_room_no' => $movie->pivot->room_no
                    ]
                );
            }

            return response()->json($data, 200);
        }
    }

    public function searchPerformer(Request $request) {

        if ($request->performer_name) {
            $performer = Performer::where('name', $request->performer_name)->firstOrFail();
            $data = array();

            foreach ($performer->movies as $movie) {
                $overall_rating = 0;
                foreach ($movie->ratings as $rating) {
                    $overall_rating += $rating->rating;
                }
                $overall_rating = $overall_rating / sizeof($movie->ratings);

                array_push(
                    $data,
                    [
                        'Movie_ID' => $movie->id,
                        'Overall_Rating' => $overall_rating,
                        'Title' => $movie->title,
                        'Description' => $movie->description
                    ]
                );
            }

            return response()->json($data, 200);
        }
    }

    public function giveRating(Request $request) {
        if ($request->movie_title && $request->username && $request->rating && $request->r_description) {

            $movie = Movie::where('title', $request->title)->firstOrFail();

            $rating = Rating::create(['movie_id' => $movie->id, 'username' => $request->username, 'rating' => $request->rating, 'description' => $request->r_description]);

            return response(['message' => 'Successfully added review for ' . $request->movie_title . ' by user: ' . $request->username, 'success' => true], 201);
        }
    }

    public function newMovies(Request $request) {
        if ($request->r_date) {

            $movies = Movie::where('release_date', $request->r_date)->get();
            $data = [];

            foreach ($movies as $movie) {
                $overall_rating = 0;

                foreach ($movie->ratings as $rating) {
                    $overall_rating += $rating->rating;
                }
                $overall_rating = $overall_rating / sizeof($movie->ratings);

                array_push(
                    $data,
                    [
                        'Movie_ID' => $movie->id,
                        'Overall_Rating' => $overall_rating,
                        'Title' => $movie->title,
                        'Description' => $movie->description
                    ]
                );
            }

            return response()->json($data);
        }
    }

    public function addMovie(Request $request) {
        if (
            $request->title && $request->release && $request->length && $request->description && $request->mpaa_rating &&
            $request->input('genre') && $request->input('director') && $request->input('performer') && $request->input('language')
        ) {
            $genres = $request->input('genre');
            $directors = $request->input('director');
            $performers = $request->input('performer');
            $languages = $request->input('language');

            $movie = Movie::create([
                'title' => $request->title,
                'release_date' => $request->release,
                'length' => $request->length,
                'description' => $request->description,
                'mpaa_rating' => $request->mpaa_rating
            ]);

            foreach($genres as $genre){
                $genre = Genre::create([
                    'title' => $genre,
                ]);
            }

            foreach($directors as $director){
                $director = Director::create([
                    'name' => $director,
                ]);
            }

            foreach($performers as $performer){
                $performer = Performer::create([
                    'name' => $performer,
                ]);
            }

            foreach($languages as $language){
                $language = Language::create([
                    'title' => $language,
                ]);
            }

            $movie->genres()->attach($genres);
            $movie->directors()->attach($directors);
            $movie->performers()->attach($performers);
            $movie->languages()->attach($languages);

            return response(['message' => 'Successfully added movie ' . $request->title . ' with Movie_ID ' . $movie->id, 'success' => true], 201);
        }
    }
}
