<?php

namespace App\Http\Controllers;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function view()
    {
        $mov = Movie::orderBy('id')->get();

        return view('movie.index',['movies' => $mov]);
    }

    public function create(){
        return view('movie.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'genre' => 'required',
            'rate_per_day' => 'required',
        ]);

        Movie::create([
            'title' => $request->title,
            'genre' => $request->genre,
            'rate_per_day' => $request->rate_per_day,

        ]);

        return redirect('/movie')->with('info', 'A new movie has been added.');
    }

    public function edit(Movie $movie){
        return view('movie.edit', compact('movie'));
    }

    public function update(Movie $movie, Request $request ){
        $request->validate([
            'title' => 'nullable',
            'genre' => 'required',
            'rate_per_day' => 'required',
        ]);

        $movie->update($request->all());
        return redirect('/movie')->with('info', "Movie with the ID# $movie->id has been updated.");
    }

    // public function destroy($id) {
    //     $data = Movie::find($id);
    
    //     if (!$data) {
    //         return response()->json(['info' => 'Data not found'], 404);
    //     }
    
    //     $data->delete();
    
    //     return redirect('/movie')->with('info', 'Movie Deleted successfully');
    // }

    public function delete(Movie $movie) {
        $movie->delete();

        return redirect('/movie')->with('info', "Movie with the ID# $movie->id has been deleted successfully");
    }
}
