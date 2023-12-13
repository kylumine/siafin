<?php

namespace App\Http\Controllers;
use App\Models\Rent;
use App\Models\Customer;
use Illuminate\Http\Request;

class RentApiController extends Controller
{
    public function index() {
        $rents = Rent::orderBy('id')->get();

        return response()->json($rents);
    }

    public function view(Rent $rent) {
        $rent->load('customer');
        return response()->json($rent);
    }
    

    public function update(Request $request, Rent $rent) {
        $fields = $request->validate([
            'total' => 'numeric|regex:/^\d+(\.\d{1,2})?$/',
            'rented_on' => 'date',
            'return_by' => 'date|nullable',
            'customer_id' => 'exists:customer,id',
        ]);

        // return response()->json($fields);
        $rent->update($fields);

        return response()->json([
            'status' => 'OK',
            'message' => 'Rent with ID# ' . $rent->id . ' has been updated.'
        ]);
    }
    public function store(Request $request, Rent $rent) {
        $fields = $request->validate([
            'total' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'rented_on' => 'required',
            'return_by' => 'nullable',
            'customer_id' => 'required|exists:customer,id'
        ]);
    
        $rent = Rent::create($fields);
    
        return response()->json([
            'status' => 'OK',
            'message' => 'New rent created with the ID# '.$rent->id
        ]);
    }

    public function destroy(Rent $rent){
        $rent->delete();

        return response()->json([
            'status' => "OK",
            'message' => 'Rent with the rent# ' .$rent->id . ' has been deleted'
        ]);
    }
}
