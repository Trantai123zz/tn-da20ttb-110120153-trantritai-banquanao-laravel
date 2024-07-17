<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Website Layout')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Thêm link tới Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        @include('partials.header')
    </header>
    
    <nav>
        @include('partials.navigation')
    </nav>

    <div class="container">
        <div class="content">
            @yield('content')
        </div>
    </div>

</body>
</html>
