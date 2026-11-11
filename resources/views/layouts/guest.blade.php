<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="h-full bg-[#111214]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'تسجيل الدخول' }} — {{ __('app.academy_name') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('images/academy-logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-gray-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8 selection:bg-red-600 selection:text-white">
    @yield('content')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.lucide && window.lucide.createIcons) {
                window.lucide.createIcons();
            }
        });
    </script>
</body>
</html>

