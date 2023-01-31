<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <title> customer</title>
    @livewireStyles
    @include('layouts.head-home')
    @include('layouts.navbar-home_customer')
    {{-- @include('layouts.search') --}}

</head>
<body>
    {{$slot}}

    @livewireScripts
    @include('layouts.footer-home')
    @include('layouts.footer-script-home')
</body>
</html>
