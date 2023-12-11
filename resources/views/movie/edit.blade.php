@extends('home')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>  
  <!-- Modal -->
  <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="deleteUserModalLabel">Delete Movie - {{$movie->title}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{url('movie/delete/'.$movie->id)}}" method="POST">
            @csrf 
            @method('DELETE')
        <div class="modal-body">
          Are you sure you want to delete this movie?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete Movie</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  
    <h1>Edit Movie</h1>
    <div class="row">
        <div class="col-md-5">
            <form action="{{url('movie/'.$movie->id)}}" method="POST">
            @csrf 
            <div class="form-group mt-2">
                <label for="title"> Title </label>
                <input type="text" name='title' class='form-control' value='{{$movie->title}}'>
                @error('title')
                    <p class='text-danger'>{{$message}}</p>
                @enderror
            </div>
            <div class="form-group mt-2">
                <label for="genre"> Genre </label>
                <input type="text" name='genre' class='form-control' value='{{$movie->genre}}'>
                @error('genre')
                <p class='text-danger'>{{$message}}</p>
            @enderror
            </div>
            <div class="form-group mt-2">
                <label for="rate_per_day"> Rate per day </label>
                <input type="text" name='rate_per_day' class='form-control' value='{{$movie->rate_per_day}}'>
                @error('rate_per_day')
                <p class='text-danger'>{{$message}}</p>
            @enderror
            </div>
            <div class="form-group my-3 d-grid gap-2 d-md-flex justify-content-end">
                <!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUserModal">
    Delete Movie
  </button>
                <button class="btn btn-primary">
                    Update Movie
                </button>
            </div>
            </form>
        </div>
    </div>
    @endsection