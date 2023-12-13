<?php

namespace App\Http\Controllers;
use App\Models\RentDetail;
use App\Models\Rent;
use App\Models\Movie;
use Illuminate\Http\Request;

class RentDetailApiController extends Controller
{
    public function index() {
        $rents = RentDetail::orderBy('id')->get();

        return response()->json($rents);
    }

    public function view(RentDetail $rentDetail) {
        $rentDetail->load('rent','movie');
        return response()->json($rentDetail);
    }
    

    public function update(Request $request, RentDetail $rentDetail) {
        $fields = $request->validate([
            'days_rented' => 'integer',
            'total' => 'numeric|regex:/^\d+(\.\d{1,2})?$/',
            'rent_id' => 'exists:rent,id',
            'movie_id' => 'exists:movie,id'
        ]);

        // return response()->json($fields);
        $rentDetail->update($fields);

        return response()->json([
            'status' => 'OK',
            'message' => 'RentDetail with ID# ' . $rentDetail->id . ' has been updated.'
        ]);
    }
    public function store(Request $request, RentDetail $rentDetail) {
        $fields = $request->validate([
            'days_rented' => 'required',
            'total' => 'required',
            'rent_id' => 'required|exists:rent,id',
            'movie_id' => 'required|exists:movie,id'
        ]);
    
        $rentDetail = RentDetail::create($fields);
    
        return response()->json([
            'status' => 'OK',
            'message' => 'New rentDetail created with the ID# '.$rentDetail->id
        ]);
    }

    public function destroy(RentDetail $rentDetail){
        $rentDetail->delete();

        return response()->json([
            'status' => "OK",
            'message' => 'RentDetail with the rentDetail# ' .$rentDetail->id . ' has been deleted'
        ]);
    }
}
