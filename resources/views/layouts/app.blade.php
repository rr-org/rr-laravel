<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Link ke stylesheet, script, atau resource lainnya -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <!-- Header situs web -->
        <h1>{{ config('app.name', 'Laravel') }}</h1>
        <!-- Navigasi situs web -->
        <nav>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('about') }}">About</a></li>
                <!-- Tambahkan link lain sesuai kebutuhan Anda -->
            </ul>
        </nav>
    </header>

    <main>
        <!-- Konten utama dari halaman akan disisipkan di sini -->
        @yield('content')
    </main>

    <footer>
        <!-- Footer situs web -->
        &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}
    </footer>

    <!-- Script atau resource lainnya -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>