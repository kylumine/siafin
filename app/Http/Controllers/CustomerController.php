<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function view()
    {
        $cus = Customer::orderBy('id')->get();

        return view('customer.index',['customers' => $cus]);
    }

    public function create(){
        return view('customer.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'connum' => 'required',
            'address' => 'nullable',
            'email' => 'required|email'
        ]);

        Customer::create([
            'name' => $request->name,
            'connum' => $request->connum,
            'address' => $request->address,
            'email' => $request->email
        ]);

        return redirect('/customer')->with('info', 'A new customer has been added.');
    }

    public function edit(Customer $customer){
        return view('customer.edit', compact('customer'));
    }

    public function update(Customer $customer, Request $request ){
        $request->validate([
            'name' => 'required',
            'connum' => 'required',
            'address' => 'nullable',
            'email' => 'required|email'
        ]);

        $customer->update($request->all());
        return redirect('/customer')->with('info', "Customer with the ID# $customer->id has been updated.");
    }

    // public function destroy($id) {
    //     $data = Customer::find($id);
    
    //     if (!$data) {
    //         return response()->json(['info' => 'Data not found'], 404);
    //     }
    
    //     $data->delete();
    
    //     return redirect('/customer')->with('info', 'Customer Deleted successfully');
    // }

    public function delete(Customer $customer) {
        $customer->delete();

        return redirect('/customer')->with('info', "Customer with the ID# $customer->id has been deleted successfully");
    }
}
