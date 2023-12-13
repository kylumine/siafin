<?php

namespace App\Http\Controllers;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieApiController extends Controller
{
    public function index() {
        $movies = Movie::orderBy('id')->get();

        return response()->json($movies);
    }

    public function view(Movie $movie) {
        return response()->json($movie);
    }
    

    public function update(Request $request, Movie $movie) {
        $fields = $request->validate([
            'title' => 'string',
            'genre' => 'string',
            'rate_per_day' => 'decimal',
        ]);

        // return response()->json($fields);
        $movie->update($fields);

        return response()->json([
            'status' => 'OK',
            'message' => 'Movie with ID# ' . $movie->id . ' has been updated.'
        ]);
    }
    public function store(Request $request, Movie $movie) {
        $fields = $request->validate([
            'title' => 'required',
            'genre' => 'required',
            'rate_per_day' => 'required',
        ]);
    
        $movie = Movie::create($fields);
    
        return response()->json([
            'status' => 'OK',
            'message' => 'New movie created with the ID# '.$movie->id
        ]);
    }

    public function destroy(Movie $movie){
        $movie->delete();

        return response()->json([
            'status' => "OK",
            'message' => 'Movie with the movie# ' .$movie->id . ' has been deleted'
        ]);
    }
}
