<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>

        <title>LearnPro @yield('title')</title>

        @yield('stylesheets')

        {{-- <link href="/prism.css" rel="stylesheet" /> --}}
    </head>
    <body>
        <div id="app">
            @include('layouts.header')
            @yield('content')
        </div>

        {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script> --}}
        <script src="{{ asset('js/app.js') }}"></script>
        {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> --}}
        {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> --}}
    </body>
</html>