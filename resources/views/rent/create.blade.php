@extends('home')

@section('content')

    <h1>New Rent</h1>
    <div class="row">
        <div class="col-md-5">
            <form action="{{url('rent/create')}}" method="POST">
            @csrf 
            <div class="form-group mt-2">
                <label for="customer_id"> Select Rentee </label>
                <select name='customer_id'id='customer_id' class='form-select'>
                    <option hidden='true'>Select Rentee</option>
                    <option selected disabled>Select Rentee</option>
                    @foreach ($customers as $customerId => $customer)
                        <option value="{{$customerId}}">{{$customer}}</option>
                    @endforeach
                </select>
                @error('customer_id')
                <p class='text-danger'>{{$message}}</p>
            @enderror
            </div>
            <div class="form-group mt-2">
                <label for="rented_on">Rented On</label>
                <input type="date" name="rented_on" class="form-control">
                @error('rented_on')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mt-2">
                <label for="return_by">Return By</label>
                <input type="date" name="return_by" class="form-control">
                @error('return_by')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mt-2">
                <label for="total"> Total </label>
                <input type="text" name='total' class='form-control'>
                @error('total')
                <p class='text-danger'>{{$message}}</p>
            @enderror
            </div>
            <div class="form-group my-3 d-grid gap-2 d-md-flex justify-content-end">
                <button class="btn btn-primary">
                    Add Rent
                </button>
            </div>
            </form>
        </div>
    </div>
    @endsection