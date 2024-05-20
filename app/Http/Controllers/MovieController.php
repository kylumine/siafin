<?php

namespace App\Http\Controllers;
use App\Models\Movie;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
            'imageUrl' => 'required'
        ]);

        Movie::create([
            'title' => $request->title,
            'genre' => $request->genre,
            'rate_per_day' => $request->rate_per_day,
            'imageUrl' => $request->imageUrl

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
            'imageUrl' => 'required'
        ]);

        $movie->update($request->all());
        return redirect('/movie')->with('info', "Movie with the ID# $movie->id has been updated.");
    }

    public function generateCSV() {
        $movie = Movie::orderBy('id')->get();

        $filename = '../storage/movies.csv';

        $file = fopen($filename, 'w+');

        foreach($movie as $o) {
            fputcsv($file, [
                $o->title,
                $o->genre,
                $o->rate_per_day,
                $o->imageUrl
            ]);
        }
        fclose($file);

        return response()->download($filename);
    }

    public function delete(Movie $movie) {
        $movie->delete();

        return redirect('/movie')->with('info', "Movie with the ID# $movie->id has been deleted successfully");
    }

    public function pdf() {
        $movie = Movie::orderBy('id')->get();

        $pdf = Pdf::loadView('movie.pdf', compact('movie'));

        return $pdf->download('movie.pdf');
    }

    public function importCSV(Request $request)
    {
        try {
            $request->validate([
                'csv_file' => 'required|mimes:csv,txt|max:2048' // Validate the uploaded file
            ]);

            $file = $request->file('csv_file'); // Get the uploaded file
            $csvData = file_get_contents($file); // Read the file content

            // Parse the CSV data
            $rows = array_map('str_getcsv', explode("\n", $csvData));
            
            // Remove the header row
            // array_shift($rows);

            // Loop through each row and create a new Movie instance
            foreach ($rows as $row) {
                // Validate row data
                $validator = Validator::make([
                    'title' => $row[0] ?? null,
                    'genre' => $row[1] ?? null,
                    'rate_per_day' => $row[2] ?? null,
                    'imageUrl' => $row[3] ?? null
                ], [
                    'title' => 'required',
                    'genre' => 'required',
                    'rate_per_day' => 'required|numeric',
                    'imageUrl' => 'required'
                ]);

                if ($validator->fails()) {
                    continue; // Skip invalid rows
                }

                // Create a new Movie instance and save it to the database
                Movie::create([
                    'title' => $row[0],
                    'genre' => $row[1],
                    'rate_per_day' => $row[2],
                    'imageUrl' => $row[3]
                ]);
            }

            return redirect('/movie')->with('info', 'CSV file imported successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage()); // Log and display any exceptions
        }
    }
    

}
