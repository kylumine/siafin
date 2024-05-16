<?php

namespace App\Http\Controllers;
use App\Models\RentDetail;
use App\Models\Rent;
use App\Models\Movie;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RentDetailController extends Controller
{
    public function view()
    {
        $ren = RentDetail::orderBy('id')->get();

        return view('detail.index',['rentds' => $ren]);
    }

    public function create(){

        $rent = Rent::list();
        $movie = Movie::list();
        return view('detail.create', ['rents' => $rent], ['movies' => $movie]);
    }

    public function store(Request $request){
        $request->validate([
            'days_rented' => 'required',
            'total' => 'required',
            'rent_id' => 'required',
            'movie_id' => 'required'
        ]);

        RentDetail::create([
            'total' => $request->total,
            'days_rented' => $request->days_rented,
            'rent_id' => $request->rent_id,
            'movie_id' => $request->movie_id

        ]);

        return redirect('/rentdetail')->with('info', 'Rent details saved.');
    }

    public function edit($id)
    {
        $rentdetail = RentDetail::findOrFail($id);
        $rents = Rent::list(); // Assuming you have a method to get a list of rents
        $movies = Movie::list(); // Assuming you have a method to get a list of movies

        return view('detail.edit', compact('rentdetail', 'rents', 'movies'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'days_rented' => 'required',
            'total' => 'required',
            'rent_id' => 'required',
            'movie_id' => 'required'
        ]);

        $rentdetail = RentDetail::findOrFail($id);

        $rentdetail->update([
            'total' => $request->total,
            'days_rented' => $request->days_rented,
            'rent_id' => $request->rent_id,
            'movie_id' => $request->movie_id
        ]);

        return redirect('/rentdetail')->with('info', 'Rent details updated.');
    }

    public function delete(RentDetail $rentdetail) {
        $rentdetail->delete();

        return redirect('/rentdetail')->with('info', "Detail with the ID# $rentdetail->id has been deleted successfully");
    }


    public function pdf() {
        $rent = RentDetail::orderBy('id')->get();

        $pdf = Pdf::loadView('detail.pdf', compact('rent'));

        return $pdf->download('rentdetail.pdf');
    }

    public function generateCSV() {
        $rentd = RentDetail::with(['rent.customer', 'movie'])->orderBy('id')->get();
    
        $filename = '../storage/rentdetails.csv';
    
        $file = fopen($filename, 'w+');
    
        foreach($rentd as $o) {
            fputcsv($file, [
                $o->rent->customer->name,
                $o->movie->title,
                $o->days_rented,
                $o->total
            ]);
        }
        fclose($file);
    
        return response()->download($filename);
    }
    
}
