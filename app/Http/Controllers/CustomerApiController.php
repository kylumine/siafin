<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Rent;
use Illuminate\Http\Request;

class CustomerApiController extends Controller
{
    public function index() {
        $customers = Customer::orderBy('id')->get();

        return response()->json($customers);
    }

    public function view(Customer $customer) {
        $customer->load('rent');
        return response()->json($customer);
    }

    public function store(Request $request, Customer $customer) {
        $fields = $request->validate([
            'name' => 'required',
            'connum' => 'required',
            'address' => 'nullable',
            'email' => 'required|email'
        ]);

        $customer = Customer::create($fields);

        return response()->json([
            'status' => "OK",
            'message' => 'Customer with ID# ' .$customer->id . ' has been created'
        ]);
    }

    public function update(Request $request, Customer $customer) {
        $fields = $request->validate([
            'name' => 'string',
            'connum' => 'string',
            'address' => 'string',
            'email' => 'string',
        ]);

        // return response()->json($fields);
        $customer->update($fields);

        return response()->json([
            'status' => 'OK',
            'message' => 'Customer with ID# ' . $customer->id . ' has been updated.'
        ]);
    }

    public function destroy(Customer $customer) {
        $details = $customer->last_name.", ".$customer->first_name;
        $customer->delete();

        return response()->json([
            'status' => 'OK',
            'message' => 'The customer '. $details.  ' has been deleted.'
        ]);
    }
}
