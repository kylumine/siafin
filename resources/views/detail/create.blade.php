@extends('home')

@section('content')

<div class="row">
    <div class="col-md-5">
        <form action="{{url('rentdetail/create')}}" method="POST">
        @csrf 
        <div class="form-group mt-2">
            <label for="days_rented"> Days Rented </label>
            <input type="text" name='days_rented' class='form-control'>
            @error('days_rented')
                <p class='text-danger'>{{$message}}</p>
            @enderror
        </div>

        <div class="form-group mt-2">
            <label for="total"> Total </label>
            <input type="text" name='total' class='form-control'>
            @error('total')
                <p class='text-danger'>{{$message}}</p>
            @enderror
        </div>

        <div class="form-group mt-2">
            <label for="rent_id"> Select Rent </label>
            <select name='rent_id'id='rent_id' class='form-select'>
                <option hidden='true'>Select Rent</option>
                <option selected disabled>Select Rent</option>
                @foreach ($rents as $rentId => $rent)
                    <option value="{{$rentId}}">{{$rent}}</option>
                @endforeach
            </select>
            @error('rent_id')
            <p class='text-danger'>{{$message}}</p>
        @enderror
        </div>

        <div class="form-group mt-2">
            <label for="movie_id"> Select Movie </label>
            <select name='movie_id'id='movie_id' class='form-select'>
                <option hidden='true'>Select Movie</option>
                <option selected disabled>Select Movie</option>
                @foreach ($movies as $movieId => $movie)
                    <option value="{{$movieId}}">{{$movie}}</option>
                @endforeach
            </select>
            @error('movie_id')
            <p class='text-danger'>{{$message}}</p>
        @enderror
        </div>

        <div class="form-group my-3 d-grid gap-2 d-md-flex justify-content-end">
            <button class="btn btn-primary">
                Add Detail
            </button>
        </div>

        </form>
    </div>
</div>
@endsection