<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">

        <div class="header bg-dark">
            <div class="container">
                <div class="row p-2">
                    <div class="col-md-4">
                        <a href="/" style="text-decoration: none; color: #fff;"><h3 class="text-white m-0 p-0">Job Board</h3></a>
                    </div>
                    <div class="col-md-4">

                    </div>
                    @if (Auth::check())
                    <div class="col-md-4 text-end" >
                        <span class="text-white pe-5">Welcome {{ Auth::user()->name }}</span>
                        <a href="/candidate/logout"><button class="btn btn-danger">Logout</button></a>
                    </div>
                    @else
                    <div class="col-md-4 text-end" >
                        <a href="{{ route('login') }}" class="btn btn-success me-3">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
