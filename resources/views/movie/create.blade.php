@extends('home')

@section('content')

    <h1>Add New Movie</h1>
    <div class="row">
        <div class="col-md-5">
            <form action="{{url('movie/create')}}" method="POST">
            @csrf 
            <div class="form-group mt-2">
                <label for="imageUrl"> Image </label>
                <input type="text" name='imageUrl' class='form-control'>
                @error('imageUrl')
                    <p class='text-danger'>{{$message}}</p>
                @enderror
            </div>
            <div class="form-group mt-2">
                <label for="title"> Title </label>
                <input type="text" name='title' class='form-control'>
                @error('title')
                    <p class='text-danger'>{{$message}}</p>
                @enderror
            </div>
            <div class="form-group mt-2">
                <label for="genre"> Genre </label>
                <input type="text" name='genre' class='form-control'>
                @error('genre')
                    <p class='text-danger'>{{$message}}</p>
                @enderror
            </div>
            <div class="form-group mt-2">
                <label for="rate_per_day"> Rate per day </label>
                <input type="text" name='rate_per_day' class='form-control'>
                @error('rate_per_day')
                <p class='text-danger'>{{$message}}</p>
            @enderror
            <div class="form-group my-3 d-grid gap-2 d-md-flex justify-content-end">
                <a href="{{url('/movie')}}" class='btn btn-danger mo-md-2' type='button'>
                    Back
                </a>
                <button class="btn btn-primary">
                    Add Movie
                </button>
            </div>
            </form>
        </div>
    </div>
    @endsection