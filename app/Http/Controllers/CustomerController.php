<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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


    public function delete(Customer $customer) {
        $customer->delete();

        return redirect('/customer')->with('info', "Customer with the ID# $customer->id has been deleted successfully");
    }

    public function generateCSV() {
        $customer = Customer::orderBy('id')->get();

        $filename = '../storage/customers.csv';

        $file = fopen($filename, 'w+');

        foreach($customer as $o) {
            fputcsv($file, [
                $o->name,
                $o->connum,
                $o->address,
                $o->email
            ]);
        }
        fclose($file);

        return response()->download($filename);
    }

    public function pdf() {
        $customer = Customer::orderBy('id')->get();

        $pdf = Pdf::loadView('customer.pdf', compact('customer'));

        return $pdf->download('customer.pdf');
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
            array_shift($rows);

            // Loop through each row and create a new Customer instance
            foreach ($rows as $row) {
                // Validate row data
                $validator = Validator::make([
                    'name' => $row[0] ?? null,
                    'connum' => $row[1] ?? null,
                    'address' => $row[2] ?? null,
                    'email' => $row[3] ?? null
                ], [
                    'name' => 'required',
                    'connum' => 'required',
                    'address' => 'required',
                    'email' => 'required'
                ]);

                if ($validator->fails()) {
                    continue; // Skip invalid rows
                }

                // Create a new Customer instance and save it to the database
                Customer::create([
                    'name' => $row[0],
                    'connum' => $row[1],
                    'address' => $row[2],
                    'email' => $row[3]
                ]);
            }

            return redirect('/customer')->with('info', 'CSV file imported successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage()); // Log and display any exceptions
        }
    }
    
}
