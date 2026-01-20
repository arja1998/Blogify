<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'My Blog')</title>

    <!-- Bootstrap & Theme CSS -->
    <link href="{{ asset('user/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/css/styles.css') }}" rel="stylesheet">
</head>
<body>

@include('user.partials.navbar')
@include('user.partials.header')

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            @yield('content')
        </div>
    </div>
</div>

@include('user.partials.footer')

<script src="{{ asset('user/js/scripts.js') }}"></script>
</body>
</html>
