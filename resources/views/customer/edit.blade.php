@extends('home')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>  
  <!-- Modal -->
  <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="deleteUserModalLabel">Delete Customer - {{$customer->name}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{url('customer/delete/'.$customer->id)}}" method="POST">
            @csrf 
            @method('DELETE')
        <div class="modal-body">
          Are you sure you want to delete this customer?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete Customer</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  
    <h1>Edit Customer</h1>
    <div class="row">
        <div class="col-md-5">
            <form action="{{url('customer/'.$customer->id)}}" method="POST">
            @csrf 
            <div class="form-group mt-2">
                <label for="name"> Name </label>
                <input type="text" name='name' class='form-control' value='{{$customer->name}}'>
                @error('name')
                    <p class='text-danger'>{{$message}}</p>
                @enderror
            </div>
            <div class="form-group mt-2">
                <label for="connum"> Contact Number </label>
                <input type="text" name='connum' class='form-control' value='{{$customer->connum}}'>
                @error('connum')
                <p class='text-danger'>{{$message}}</p>
            @enderror
            </div>
            <div class="form-group mt-2">
                <label for="address"> Address </label>
                <input type="text" name='address' class='form-control' value='{{$customer->address}}'>
                @error('address')
                <p class='text-danger'>{{$message}}</p>
            @enderror
            </div>
            <div class="form-group mt-2">
                <label for="email"> Email </label>
                <input type="text" name='email' class='form-control' value='{{$customer->email}}'>
                @error('email')
                <p class='text-danger'>{{$message}}</p>
            @enderror
            </div>
            <div class="form-group my-3 d-grid gap-2 d-md-flex justify-content-end">
                <!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUserModal">
    Delete Customer
  </button>
                <button class="btn btn-primary">
                    Update Customer
                </button>
            </div>
            </form>
        </div>
    </div>
    @endsection