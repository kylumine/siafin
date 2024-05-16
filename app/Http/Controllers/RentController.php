<?php

namespace App\Http\Controllers;
use App\Models\Rent;
use App\Models\Customer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RentController extends Controller
{
    public function view()
    {
        $ren = Rent::orderBy('id')->get();

        return view('rent.index',['rents' => $ren]);
    }

    public function create(){

        $customer = Customer::list();
        return view('rent.create', ['customers' => $customer]);
    }

    public function store(Request $request){
        $request->validate([
            'total' => 'required',
            'rented_on' => 'required',
            'return_by' => 'nullable',
            'customer_id' => 'required'
        ]);

        Rent::create([
            'total' => $request->total,
            'rented_on' => $request->rented_on,
            'return_by' => $request->return_by,
            'customer_id' => $request->customer_id

        ]);

        return redirect('/rent')->with('info', 'A new rent has been made.');
    }

    public function edit(Rent $rent){

        $customer = Customer::list();
        return view('rent.edit',['customers' => $customer], compact('rent'));
    }

    public function update(Rent $rent, Request $request ){
        $request->validate([
            'total' => 'required',
            'rented_on' => 'required',
            'return_by' => 'nullable',
            'customer_id' => 'required'
        ]);

        $rent->update($request->all());
        return redirect('/rent')->with('info', "Rent with the ID# $rent->id has been updated.");
    }

    public function delete(Rent $rent) {
        $rent->delete();

        return redirect('/rent')->with('info', "Rent with the ID# $rent->id has been deleted successfully");
    }

    public function generateCSV() {
        $rent = Rent::orderBy('rents.id')
                    ->join('customers', 'rents.customer_id', '=', 'customers.id')
                    ->select('rents.*', 'customers.name as customer_name')
                    ->get();
    
        $filename = '../storage/rents.csv';
    
        $file = fopen($filename, 'w+');
    
 
        foreach($rent as $o) {
            fputcsv($file, [
                $o->customer_name, 
                $o->total,
                $o->rented_on,
                $o->return_by,
            ]);
        }
        fclose($file);
    
        return response()->download($filename);
    }

    public function pdf() {
        $rent = Rent::orderBy('id')->get();

        $pdf = Pdf::loadView('rent.pdf', compact('rent'));

        return $pdf->download('rent.pdf');
    }

    
}
