<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Bootstrap CSS - LOAD FIRST -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Vite Assets -->
    @vite(['resources/js/app.js'])

    <!-- Custom Styles - LOAD AFTER BOOTSTRAP -->
    <style>
        /* Sticky Footer Styles */
        html, body 
        {
            height: 100%;
            margin: 0;
            padding: 0;
            min-height:100vh
        }

        body 
        {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main 
        {
            flex: 1 0 auto;
        }

        footer {
            flex-shrink: 0;
        }

        /* Your existing styles */
        .roboto {
            font-family: "Roboto", sans-serif;
            font-optical-sizing: auto;
            font-style: normal;
            font-variation-settings: "wdth" 100;
        }

        .form-control:focus {
            box-shadow: none !important;
            border-color: inherit !important;
        }

        .nav_text {
            color: white !important;
            font-weight: bold !important;
        }

        h1 {
            font-size: 2rem;
            margin: 2rem 0rem !important;
        }

        .navbar-toggler:focus {
            box-shadow: none !important;
        }

        h4 {
            color: gray !important;
        }

        a {
            text-decoration: none;
        }

        .rating-badge {
            background-color: green;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-flex;
            align-items: center;
            font-weight: bold;
            font-size: 14px;
            gap: 3px;
        }

        .btn:hover {
            background-color: inherit !important;
        }
    </style>

    @stack('styles')
</head>

<body>
    <x-frontend.header />

    <main>
        @yield('content')
    </main>

    <footer>
        <x-frontend.footer />
    </footer>

    <!-- Scripts -->
    <!-- jQuery - LOAD FIRST (Bootstrap depends on it for some features) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Swiper -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>

    @stack('scripts')

</body>

</html>