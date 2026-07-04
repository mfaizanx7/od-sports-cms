<?php
if (!session()->isStarted()) {
    session()->start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{!! theme_option('global_site_title', 'OD SPORTS - Premium Sports Solutions') !!}</title>
    <link rel="icon" type="image/jpeg" href="{{ asset(theme_option('global_site_logo', 'favicon.jpeg')) }}">
    <link rel="stylesheet" href="{{ asset('landing-assets/style.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('landing-assets/global-bridge.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @yield('head')
</head>
<body class="dark-mode">
    @include('partials.landing.navbar')
    @yield('content')
    @include('partials.landing.footer')
    <script src="{{ asset('landing-assets/script.js') }}?v={{ time() }}"></script>
    @yield('script')
</body>
</html>