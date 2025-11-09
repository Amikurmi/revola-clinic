<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Palapala Dermatology')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(90deg, #fdf7f2 0%, #f8ece3 100%);
        }

        button,
        a {
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>

<body class="text-gray-800">

    {{-- Navbar Component --}}
    <x-navbar />


    {{-- Logout Button (visible only if logged in) --}}
    @auth
    <div class="flex justify-end p-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-lg shadow transition flex items-center gap-2">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
    @endauth

    {{-- Page Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer Component --}}
    <x-footer-section />

    @stack('scripts')
</body>

</html>