@extends('home')

@section('content')

@if (session('info'))
    <div class="alert alert-success">{{session('info')}}</div>
@endif

    <div class='d-grip gap-2 d-md-flex justify-content-between mb-3'>
        <a href="{{url('/customer/create')}}" class='btn btn-pink mo-md-2' type='button'>
            Add New Customer
        </a>
        <div class="text-md-end">
            <a href="#" class='btn btn-pink1 mo-md-2 import-csv-btn' type='button'>
                Import CSV
            </a>
            <form action="{{ route('customers.import-csv') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                @csrf
                <input type="file" name="csv_file" id="csv_file" accept=".csv" style="display: none;">
                <button type="submit" class="btn btn-pink1 mo-md-2">Submit</button>
            </form>
            <a href="/customers/csv-all" class='btn btn-pink1 mo-md-2' type='button'>
                Generate CSV
            </a>
            <a href="customers/pdf" class='btn btn-pink1 mo-md-2' type='button'>
                Generate PDF
            </a>
        </div>
    </div>

    <div class="table">
        <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Contact Number</th>
                <th>Address</th>
                <th>Email</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($customers as $customer): ?>

                <tr>
                    <td>{{$customer->id}}</td>
                    <td>{{$customer->name}}</td>
                    <td>{{$customer->connum}}</td>
                    <td>{{$customer->address}}</td>
                    <td>{{$customer->email}}</td>
                    <td class='text-center'>
                        <a href='{{url('/customer/'.$customer->id)}}' class='btn btn-pink'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                              </svg>
                        </a>
                        {{-- <a href="{{url('/delete/users/'.$user->id)}}" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                          </svg>    
                        </a> --}}
                    </td>
                </tr>

                <?php endforeach; ?>
        </tbody>
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
</body>
</html>