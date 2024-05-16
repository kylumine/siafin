<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Rent</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .buttons {
            background: linear-gradient(to right, #ffd1dc, #ffb6c1, #ffa0b5, #ff91ab, #ff81a0, #ff7295, #ff628a);
            color: #ffffff;
            padding: 10px;
            text-align: center;
        }

        h1 {
            margin: 0;
            font-size: 30px;
            font-weight: bold;
        }

        ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            justify-content: space-around;
            margin-top: 10px;
        }

        li {
            margin-right: 10px;
        }

        a {
            text-decoration: none;
            color: #ffffff;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        a:hover, a.active {
            background: #ff2e62;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            margin-left: 6%;
            margin-top: 2%;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .btn-pink {
            background-color: #ff69b4; /* Replace with your preferred shade of pink */
            color: #ffffff; /* Text color */
        }

        .btn-pink1 {
            background-color: #ffa2d0; /* Replace with your preferred shade of pink */
            color: #ffffff; /* Text color */
        }

        .rent {
            margin-left: 5%;
        }

        .navv {
            margin-right: 3%;
        }
    </style>
</head>
<body>
    <div class="d-flex justify-content-between align-items-center buttons">
        <h1 class="rent">Rent a Movie</h1>
        <div class="navv">
            <ul>
                <li><a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ url('/movie') }}" class="{{ Request::is('movie') ? 'active' : '' }}">Movies</a></li>
                <li><a href="{{ url('/customer') }}" class="{{ Request::is('customer') ? 'active' : '' }}">Customers</a></li>
                <li><a href="{{ url('/rent') }}" class="{{ Request::is('rent') ? 'active' : '' }}">Rent</a></li>
                <li><a href="{{ url('/rentdetail') }}" class="{{ Request::is('rentdetail') ? 'active' : '' }}">Rent Details</a></li>
                <li><a href="{{ url('/scanner') }}" class="{{ Request::is('scanner') ? 'active' : '' }}">QR Scanner</a></li>
            </ul>
        </div>
    </div>

    <div class="container">
        @yield('content')
    </div>

    @yield('scripts')
</body>
</html>
