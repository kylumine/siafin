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
    <h1>Rents List</h1>

    <hr>

    <table class="table table-bordered table-striped">
        <thead class="table-pink">
            <tr>
                <th>Customer</th>
                <th>Total</th>
                <th>Rented On</th>
                <th> Return By </th>
                <th> QR code </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rent as $rent)
                <tr>
                    <td>{{ $rent->customer->name }}</td>
                    <td>₱{{ $rent->total }}</td>
                    <td>{{ $rent->rented_on }}</td>
                    <td>{{ $rent->return_by }}</td>
                   <td><img src="data:image/png;base64,{{ base64_encode(QrCode::size(100)->generate($rent->id)) }}" alt="QR Code"></td>
                </tr>
            @endforeach
          
        </tbody>
    </table>

</body>
</html>