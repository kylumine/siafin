@extends('home')

@section('content')

@if (session('info'))
    <div class="alert alert-success">{{ session('info') }}</div>
@endif

<div class='d-grip gap-2 d-md-flex justify-content-between mb-3'>
    <a href="{{ url('/movie/create') }}" class='btn btn-pink mo-md-2' type='button'>
        Add New Movie
    </a>
    <div class="text-md-end">
        <a href="#" class='btn btn-pink1 mo-md-2 import-csv-btn' type='button'>
            Import CSV
        </a>
        <form action="{{ route('movies.import-csv') }}" method="POST" enctype="multipart/form-data" style="display: none;"> 
            @csrf
            <input type="file" name="csv_file" id="csv_file" accept=".csv" style="display: none;">
            <button type="submit" class="btn btn-pink1 mo-md-2">Submit</button>
        </form>
        
        <a href="{{ url('/movies/csv-all') }}" class='btn btn-pink1 mo-md-2' type='button'>
            Generate CSV
        </a>
        <a href="{{ url('/movies/pdf') }}" class='btn btn-pink1 mo-md-2' type='button'>
            Generate PDF
        </a>
    </div>
</div>

<div class="row">
    @foreach($movies as $movie)
        <div class="col-md-6 mb-4">
            <div class="card position-relative">
                <div class="row g-0">
                    <div class="col-md-4">
                        <div class="card-body">
                            <div class="m-2">
                                <img src="{{$movie->imageUrl}}" alt="Portfolio Image" class="w-full rounded" style="height: 160px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mt-[2%]">{{ $movie->title }}</h5>
                            <p class="card-text">Genre: {{ $movie->genre }}</p>
                            <p class="card-text">Rate per day: ₱{{ $movie->rate_per_day }}</p>
                            <a href="{{ url('/movie/'.$movie->id) }}" class="btn btn-pink">Edit</a>
                        </div>
                    </div>
                </div>
                <div class="position-absolute bottom-0 end-0 m-2">
                    <div style="color: pink;">
                        {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(50)->generate($movie->title) !!}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var importCsvBtn = document.querySelector('.import-csv-btn');
        var fileInput = document.querySelector('#csv_file');

        importCsvBtn.addEventListener('click', function(event) {
            event.preventDefault();
            fileInput.click();
        });

        fileInput.addEventListener('change', function() {
            this.parentElement.submit();
        });
    });
</script>

@endsection
