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

use function PHPSTORM_META\type;

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

            return response()->json(compact('data'), 200);
        }
    }

    public function timeslot(Request $request) {

        if ($request->theater_name && $request->time_start && $request->time_end) {
            $theater = Theater::where('name', $request->theater_name)->first();
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

            return response()->json(compact('data'), 200);
        }
    }

    public function specificMovieTheater(Request $request) {

        if ($request->theater_name && $request->d_date) {
            $theater = Theater::where('name', $request->theater_name)->first();
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

            return response()->json(compact('data'), 200);
        }
    }

    public function searchPerformer(Request $request) {

        if ($request->performer_name) {
            $performer = Performer::where('name', $request->performer_name)->first();
            $data = array();

            foreach ($performer->movies as $movie) {
                $overall_rating = 0;
                foreach ($movie->ratings as $rating) {
                    $overall_rating += $rating->rating;
                }
                $overall_rating = number_format($overall_rating / sizeof($movie->ratings), 1);

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

            return response()->json(compact('data'), 200);
        }
    }

    public function giveRating(Request $request) {

        if ($request->movie_title && $request->username && $request->rating && $request->r_description) {
            $movie = Movie::where('title', $request->movie_title)->firstOrFail();
            $rating = Rating::create(['movie_id' => $movie->id, 'username' => $request->username, 'rating' => $request->rating, 'description' => $request->r_description]);

            if ($rating)
                return response(['message' => 'Successfully added review for ' . $request->movie_title . ' by user: ' . $request->username, 'success' => true], 201);
            else
                return response(['message' => 'Failed adding review for ' . $request->movie_title . ' by user: ' . $request->username, 'success' => false], 500);
        }
        return response(['message' => 'Error input', 'success' => false], 500);
    }

    public function newMovies(Request $request) {
        if ($request->r_date) {

            $movies = Movie::where('release_date', '<=', $request->r_date)->orderBy('release_date', 'desc')->get();
            $data = [];

            foreach ($movies as $movie) {
                $overall_rating = 0;

                foreach ($movie->ratings as $rating) {
                    $overall_rating += $rating->rating;
                }
                
                if (sizeof($movie->ratings) != 0)
                    $overall_rating = number_format($overall_rating / sizeof($movie->ratings), 1);

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

            return response()->json(compact('data'));
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

            if (gettype($genres) == 'string') {
                $genres = array($genres);
            }
            if (gettype($directors) == 'string') {
                $directors = array($directors);
            }
            if (gettype($performers) == 'string') {
                $performers = array($performers);
            }
            if (gettype($languages) == 'string') {
                $languages = array($languages);
            }

            $movie = Movie::create([
                'title' => $request->title,
                'release_date' => $request->release,
                'length' => $request->length,
                'description' => $request->description,
                'mpaa_rating' => $request->mpaa_rating
            ]);

            foreach ($genres as $key => $val) {
                $genres[$key] = Genre::where(DB::raw('UPPER(title)'), strtoupper($val))->first();
                if (!$genres[$key]) {
                    $genres[$key] = Genre::create([
                        'title' => $val,
                    ]);
                }

                $genres[$key] = $genres[$key]->id;
            }

            foreach ($directors as $key => $val) {
                $directors[$key] = Director::where(DB::raw('UPPER(name)'), strtoupper($val))->first();
                if (!$directors[$key]) {
                    $directors[$key] = Director::create([
                        'name' => $val,
                    ]);
                }

                $directors[$key] = $directors[$key]->id;
            }

            foreach ($performers as $key => $val) {
                $performers[$key] = Performer::where(DB::raw('UPPER(name)'), strtoupper($val))->first();
                if (!$performers[$key]) {
                    $performers[$key] = Performer::create([
                        'name' => $val,
                    ]);
                }
                $performers[$key] = $performers[$key]->id;
            }

            foreach ($languages as $key => $val) {
                $languages[$key] = Language::where(DB::raw('UPPER(title)'), strtoupper($val))->first();
                if (!$languages[$key]) {
                    $languages[$key] = Language::create([
                        'title' => $val,
                    ]);
                }
                $languages[$key] = $languages[$key]->id;
            }

            $movie->genres()->attach($genres);
            $movie->directors()->attach($directors);
            $movie->performers()->attach($performers);
            $movie->languages()->attach($languages);

            return response(['message' => 'Successfully added movie ' . $request->title . ' with Movie_ID ' . $movie->id, 'success' => true], 201);
        }
    }
}
