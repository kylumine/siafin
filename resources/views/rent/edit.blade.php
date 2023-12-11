@extends('home')

@section('content')

  
  <!-- Modal -->
  <div class="modal fade" id="deleteRentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Rent with the ID# - {{$rent->id}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{url('rent/delete/'.$rent->id)}}" method="POST">
            @csrf 
            @method('DELETE')
        <div class="modal-body">
            Are you sure you want to delete this record?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete Rent</button>
        </div>
    </form>
      </div>
    </div>
  </div>
    <h1>Edit Rent</h1>
    <div class="row">
        <div class="col-md-5">
            <form action="{{url('rent/'.$rent->id)}}" method="POST">
            @csrf 
            <div class="form-group mt-2">
                <label for="customer_id"> Select Rentee </label>
                <select name='customer_id'id='customer_id' class='form-select' value="{{$rent->customer_id}}">
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
                <input type="date" name="rented_on" class="form-control" value="{{$rent->rented_on}}">
                @error('rented_on')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mt-2">
                <label for="return_by">Return By</label>
                <input type="date" name="return_by" class="form-control" value="{{$rent->return_by}}">
                @error('return_by')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mt-2">
                <label for="total"> Total </label>
                <input type="text" name='total' class='form-control' value="{{$rent->total}}">
                @error('total')
                <p class='text-danger'>{{$message}}</p>
            @enderror
            </div>
            <!-- Button trigger modal -->
            <div class="form-group my-3 d-grid gap-2 d-md-flex justify-content-end">
                <!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteRentModal">
    Delete Rent
  </button>
                <button class="btn btn-primary">
                    Update Rent
                </button>
            </div>
            </form>
        </div>
    </div>
    @endsection