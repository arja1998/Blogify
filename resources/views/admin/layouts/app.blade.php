<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>

    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
</head>
<body>

<div class="container-scroller">

    @include('admin.partials.navbar')

    <div class="container-fluid page-body-wrapper">

        @include('admin.partials.sidebar')

        <div class="main-panel">
            <div class="content-wrapper">

                @yield('content')

            </div>

            @include('admin.partials.footer')
        </div>
    </div>
</div>

<script src="{{ asset('admin/assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('admin/assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('admin/assets/js/template.js') }}"></script>
</body>
</html>
