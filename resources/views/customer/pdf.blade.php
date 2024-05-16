<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        *{
            font-family: Arial, Helvetica, sans-serif
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td{
            border: 1px solid #333;
        }
    </style>
</head>
<body>
    <h1>Customers List</h1>

    <hr>

    <table class="table table-bordered table-striped">
        <thead class="table-pink">
            <tr>
                <th>Name</th>
                <th>Contact #</th>
                <th>Address</th>
                <th> Email </th>
                <th> QR code </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customer as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->connum }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>{{ $customer->email }}</td>
                   <td><img src="data:image/png;base64,{{ base64_encode(QrCode::size(100)->generate($customer->id)) }}" alt="QR Code"></td>
                </tr>
            @endforeach
          
        </tbody>
    </table>

</body>
</html>