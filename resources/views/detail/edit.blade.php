@extends('home')

@section('content')

  
  <!-- Modal -->
  <div class="modal fade" id="deleteRentdModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Rent Detail with the ID# - {{$rentdetail->id}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{url('rentdetail/delete/'.$rentdetail->id)}}" method="POST">
            @csrf 
            @method('DELETE')
        <div class="modal-body">
            Are you sure you want to delete this record?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Delete Detail</button>
        </div>
        </form>
      </div>
    </div>
  </div>


<div class="row">
    <div class="col-md-5">
        <form action="{{ url('rentdetail/'.$rentdetail->id) }}" method="POST">
            @csrf 
            <div class="form-group mt-2">
                <label for="days_rented">Days Rented</label>
                <input type="text" name='days_rented' class='form-control' value="{{ $rentdetail->days_rented }}">
                @error('days_rented')
                    <p class='text-danger'>{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group mt-2">
                <label for="total">Total</label>
                <input type="text" name='total' class='form-control' value="{{ $rentdetail->total }}">
                @error('total')
                    <p class='text-danger'>{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group mt-2">
                <label for="rent_id">Select Rent</label>
                <select name='rent_id' id='rent_id' class='form-select'>
                    @foreach ($rents as $rentId => $rent)
                        <option value="{{ $rentId }}" {{ $rentId == $rentdetail->rent_id ? 'selected' : '' }}>
                            {{ $rent }}
                        </option>
                    @endforeach
                </select>
                @error('rent_id')
                    <p class='text-danger'>{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group mt-2">
                <label for="movie_id">Select Movie</label>
                <select name='movie_id' id='movie_id' class='form-select'>
                    @foreach ($movies as $movieId => $movie)
                        <option value="{{ $movieId }}" {{ $movieId == $rentdetail->movie_id ? 'selected' : '' }}>
                            {{ $movie }}
                        </option>
                    @endforeach
                </select>
                @error('movie_id')
                    <p class='text-danger'>{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group my-3 d-grid gap-2 d-md-flex justify-content-end">
                <!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteRentdModal">
    Delete Detail
  </button>
                <button class="btn btn-primary">
                    Update Detail
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
