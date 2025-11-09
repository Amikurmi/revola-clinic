<header class="sticky top-0 z-50 bg-[#fffaf6]/80 backdrop-blur-sm shadow-sm">
    <div class="mx-auto px-4 py-1 md:py-4 flex justify-between items-center">

        <!-- Logo -->
        <a href="/">
            <img src="{{ asset($logo) }}" alt="Palapala Logo" class="h-12 md:h-16 w-auto">
        </a>

        <!-- Desktop Info + Navigation -->
        <div class="hidden lg:flex flex-col items-center w-full max-w-4xl">
            <div class="flex space-x-8 items-center justify-center text-sm text-[#7a5a3a]">
                <span>Connect with us</span>
                <span>|</span>
                <span>{{ $hours }}</span>
                <span>|</span>
                <span>Call Us — {{ $phone }}</span>
            </div>

            <hr class="border-[#e7d8c9] my-2 w-full">

            <nav class="flex space-x-8 justify-center text-[#7a5a3a] font-medium items-center">
                @foreach($links as $name => $route)
                @php
                $currentUrl = request()->path();
                $isActive =
                request()->is(trim($route, '/')) ||
                Str::startsWith($currentUrl, trim($route, '/').'-details') ||
                ($route === '/' && $currentUrl === '/');
                @endphp
                <a href="{{ url($route) }}"
                    class="relative hover:text-[#b18457] transition {{ $isActive ? 'text-[#c2410c] font-semibold after:absolute after:left-0 after:-bottom-1 after:w-full after:h-[2px] after:bg-red-500 after:content-[\'\']' : '' }}">
                    {{ $name }}
                </a>
                @endforeach
            </nav>
        </div>

        <!-- Desktop User Dropdown + Appointment -->
        <div class="hidden md:flex space-x-4 items-center">
            @auth
            <div class="relative">
                <button id="user-menu-button"
                    class="flex items-center gap-2 bg-[#7a5a3a] text-white px-4 py-2 rounded-full font-medium hover:bg-[#6a4f33] transition focus:outline-none">
                    <i class="fa-solid fa-user"></i>
                    {{ Auth::user()->name }}
                    <i class="fa-solid fa-caret-down"></i>
                </button>
                <div id="user-dropdown"
                    class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-md text-[#7a5a3a] font-medium hidden transition-all duration-200">
                    <a href="/user/appointments"
                        class="block px-4 py-2 hover:bg-[#fdf7ef] hover:text-[#b18457]">
                        Appointments
                    </a>
                    <a href="/profile" class="block px-4 py-2 hover:bg-[#fdf7ef] hover:text-[#b18457]">Profile</a>
                    <!-- <a href="/settings" class="block px-4 py-2 hover:bg-[#fdf7ef] hover:text-[#b18457]">Settings</a> -->
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 hover:bg-red-50 hover:text-red-600">Logout</button>
                    </form>
                </div>
            </div>
            @endauth

            {{-- Appointment Button --}}
            <a href="/user/appointments"
                class="inline-flex items-center gap-2 bg-[#7a5a3a] text-white px-5 py-2 md:py-3 rounded-full font-medium hover:bg-[#6a4f33] transition">
                <i class="fa-solid fa-tty"></i> Appointment
            </a>
        </div>

        <!-- Mobile Menu Toggle -->
        <button id="menu-toggle"
            class="md:hidden text-2xl text-[#7a5a3a] focus:outline-none"
            aria-label="Toggle menu"
            aria-expanded="false">
            ☰
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu"
        class="hidden flex-col mt-4 text-[#7a5a3a] font-medium md:hidden transition-all duration-300 ease-in-out overflow-hidden bg-[#fffaf6] rounded-lg shadow-md">

        <!-- Contact Info -->
        <div class="flex justify-between border-b border-[#e7d8c9] p-3">
            <div class="flex flex-col space-y-1 text-xs">
                <span>Connect with us</span>
                <span>{{ $hours }}</span>
                <span>Call Us — {{ $phone }}</span>
            </div>
            {{-- User Dropdown --}}
            @auth
            <details class="rounded-lg">
                <summary
                    class="flex items-center justify-between px-4 py-2 text-[#7a5a3a] font-medium cursor-pointer hover:bg-[#f9f1e6] rounded-lg">
                    <span><i class="fa-solid fa-user mr-2"></i>{{ Auth::user()->name }}</span>
                    <i class="fa-solid fa-caret-down"></i>
                </summary>
                <div class="flex flex-col border-t border-[#e7d8c9]">
                    <a href="/user/appointments"
                        class="px-4 py-2 hover:bg-[#fffaf6] hover:text-[#b18457]">
                        My appointments
                    </a>
                    <a href="/profile" class="px-4 py-2 hover:bg-[#fffaf6] hover:text-[#b18457]">Profile</a>
                    <!-- <a href="/settings" class="px-4 py-2 hover:bg-[#fffaf6] hover:text-[#b18457]">Settings</a> -->
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 hover:bg-red-50 hover:text-red-600">Logout</button>
                    </form>
                </div>
            </details>
            @endauth
        </div>

        <!-- Navigation Links -->
        <nav class="flex flex-col">
            @foreach($links as $name => $route)
            @php
            $currentUrl = request()->path();
            $isActive =
            request()->is(trim($route, '/')) ||
            Str::startsWith($currentUrl, trim($route, '/').'-details') ||
            ($route === '/' && $currentUrl === '/');
            @endphp
            <a href="{{ url($route) }}"
                class="block w-full text-sm px-4 py-3 border-b border-[#e7d8c9] hover:bg-[#fdf7ef] hover:text-[#b18457] transition relative {{ $isActive ? 'text-[#c2410c] font-semibold after:absolute after:left-0 after:bottom-0 after:w-full after:h-[2px] after:bg-red-500 after:content-[\'\']' : '' }}">
                {{ $name }}
            </a>
            @endforeach
        </nav>


        <!-- Mobile User Dropdown + Appointment -->
        <div class="flex flex-col space-y-2 px-4 py-3">
            {{-- Appointment Button --}}
            <a href="/user/appointments"
                class="w-full inline-flex items-center justify-center gap-2 bg-[#7a5a3a] text-white px-4 py-2 rounded-lg font-medium hover:bg-[#6a4f33] transition">
                <i class="fa-solid fa-tty"></i> Appointment
            </a>

        </div>
    </div>

    <!-- Menu + Dropdown Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Mobile menu toggle
            const menuToggle = document.getElementById('menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');
            let isOpen = false;

            function toggleMenu() {
                isOpen = !isOpen;
                menuToggle.setAttribute('aria-expanded', isOpen);
                if (isOpen) {
                    mobileMenu.classList.remove('hidden');
                    requestAnimationFrame(() => {
                        mobileMenu.style.maxHeight = mobileMenu.scrollHeight + "px";
                    });
                } else {
                    mobileMenu.style.maxHeight = mobileMenu.scrollHeight + "px";
                    requestAnimationFrame(() => {
                        mobileMenu.style.maxHeight = "0px";
                    });
                    setTimeout(() => mobileMenu.classList.add('hidden'), 300);
                }
            }

            menuToggle.addEventListener('click', toggleMenu);

            // Close mobile menu on link click
            mobileMenu.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    if (isOpen) toggleMenu();
                });
            });

            // Desktop user dropdown toggle
            const userMenuButton = document.getElementById('user-menu-button');
            const userDropdown = document.getElementById('user-dropdown');

            if (userMenuButton && userDropdown) {
                userMenuButton.addEventListener('click', (e) => {
                    e.stopPropagation();
                    userDropdown.classList.toggle('hidden');
                });

                document.addEventListener('click', (e) => {
                    if (!userDropdown.contains(e.target) && !userMenuButton.contains(e.target)) {
                        userDropdown.classList.add('hidden');
                    }
                });
            }

            mobileMenu.style.maxHeight = "0px";
        });
    </script>
</header>