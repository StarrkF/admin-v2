<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - V2</title>

    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/app-dark.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/shared/iconly.css') }}">
    @yield('css')
    @stack('widget-css')
    @vite('resources/js/app.js')


</head>

<body>
    <div>
        @include('Admin.includes.sidebar')
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3">Admin - V2</i>
                </a>
            </header>
            @yield('admin.content')
            @include('Admin.includes.footer')
        </div>
    </div>


    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
    @yield('js')
    @stack('widget-js')

</body>

</html>
