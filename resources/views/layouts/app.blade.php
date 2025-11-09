<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Palapala Dermatology')</title>

    @yield('meta')
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

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <style>

        button,
        a {
            transition: all 0.3s ease-in-out;
        }

        /* Smooth mobile menu animation */
        #mobile-menu {
            transition: max-height 0.3s ease-in-out;
            overflow: hidden;
        }
    </style>
</head>

<body class="text-gray-800">

    {{-- Navbar Component --}}
    <x-navbar />

    {{-- Page Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer Component --}}
    <x-footer-section />

    {{-- Menu Toggle Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const menuToggle = document.getElementById('menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');

            if (menuToggle && mobileMenu) {
                // Initialize state
                mobileMenu.style.maxHeight = '0px';
                let menuOpen = false;

                menuToggle.addEventListener('click', () => {
                    menuOpen = !menuOpen;
                    if (menuOpen) {
                        mobileMenu.classList.remove('hidden');
                        mobileMenu.style.maxHeight = mobileMenu.scrollHeight + 'px';
                        menuToggle.setAttribute('aria-expanded', 'true');
                    } else {
                        mobileMenu.style.maxHeight = '0px';
                        menuToggle.setAttribute('aria-expanded', 'false');
                        setTimeout(() => {
                            mobileMenu.classList.add('hidden');
                        }, 300); // match animation duration
                    }
                });
            }
        });
    </script>

    {{-- Stack Scripts from Components --}}
    @stack('scripts')
    @stack('styles')

</body>

</html>