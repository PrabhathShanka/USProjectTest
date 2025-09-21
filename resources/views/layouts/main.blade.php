<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('meta_description', 'Default description for your site.')">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" href="favicon.ico">
    @vite(['resources/css/landing.css'])
</head>

<body x-data="{ page: 'home', 'darkMode': true, 'stickyMenu': false, 'navigationOpen': false, 'scrollTop': false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{ 'b eh': darkMode === true }">
    <!-- Fixed Header -->
    <header class="g s r vd ya cj" :class="{ 'hh sm _k dj bl ll': stickyMenu }"
        @scroll.window="stickyMenu = (window.pageYOffset > 20) ? true : false" >
        @include('layouts.navigationTemplate')
    </header>

    <!-- Scrollable Content -->
    <div>
        @yield('content')
    </div>

    <!-- Fixed Footer -->
    <div>
        @include('layouts.footer')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/js/landing.js'])
    @stack('scripts')
</body>

</html>
