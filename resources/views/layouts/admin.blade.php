<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(to bottom right, #f5eee3, #f8f5ef);
        }

        .lux-shadow {
            box-shadow: 0 4px 20px rgba(92, 67, 38, 0.15);
        }

        .lux-hover:hover {
            box-shadow: 0 6px 30px rgba(90, 65, 40, 0.25);
            transform: translateY(-3px);
        }

        .sidebar-item-active {
            background: linear-gradient(90deg, #fdf7ef, #f1e7d7);
            color: #7a5638 !important;
            font-weight: 600;
        }

        /* ✅ Fix Sidebar & Header */
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 50;
        }

        #sidebar {
            position: fixed;
            top: 75px;
            /* Matches header height */
            left: 0;
            height: calc(100vh - 75px);
            overflow-y: auto;
        }

        main {
            margin-top: 75px;
            margin-left: 290px;
            /* Sidebar width */
            height: calc(100vh - 75px);
            overflow-y: auto;
            padding-bottom: 40px;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <header class="h-[75px] bg-white border-b border-[#d4c5b3] flex items-center justify-between px-6 lux-shadow">
        <div class="text-3xl py-4 font-extrabold tracking-wide text-[#6e4e31]">
            Admin Panel
        </div>

        <div class="relative">
            <button id="userDropdown"
                class="flex items-center gap-3 bg-[#7a5a3a] text-white px-4 py-2 rounded-xl shadow-md hover:bg-[#6a4f33] transition">
                <i class="fa-solid fa-user text-lg"></i>
                {{ auth()->user()->name }}
                <i class="fa-solid fa-chevron-down text-sm"></i>
            </button>

            <div id="dropdownMenu"
                class="hidden absolute right-0 mt-2 w-48 bg-white border border-[#e9dcc9] shadow-xl rounded-xl overflow-hidden z-50">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-4 py-3 hover:bg-[#b35b55] hover:text-white flex items-center gap-3 transition">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <aside id="sidebar"
        class="w-[290px] bg-[#d7c4ac] shadow-xl border-r border-[#cbb399] flex flex-col py-6 px-4">

        @php
        function activeMenu($route){
        return request()->routeIs($route) ? 'sidebar-item-active' : 'text-[#3c2c20]';
        }
        @endphp

        <nav class="space-y-1">

            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition lux-hover {{ activeMenu('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>

            <a href="{{ route('admin.treatments.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition lux-hover {{ activeMenu('admin.treatments.*') }}">
                <i class="fas fa-users"></i> Treatments
            </a>

            <a href="{{ route('admin.services.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition lux-hover {{ activeMenu('admin.services.*') }}">
                <i class="fas fa-list"></i> Services
            </a>

            <a href="{{ route('admin.categories.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition lux-hover {{ activeMenu('admin.categories.*') }}">
                <i class="fas fa-tags"></i> Categories
            </a>

            <a href="{{ route('admin.blogs.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition lux-hover {{ activeMenu('admin.blogs.*') }}">
                <i class="fas fa-blog"></i> Blogs
            </a>

            <a href="{{ route('admin.doctors.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition lux-hover {{ activeMenu('admin.doctors.*') }}">
                <i class="fas fa-user-md"></i> Doctors
            </a>

            <a href="{{ route('admin.slots.all') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition lux-hover {{ activeMenu('admin.slots.*') }}">
                <i class="fas fa-clock"></i> Slots
            </a>

            <a href="{{ route('admin.appointments.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition lux-hover {{ activeMenu('admin.appointments.*') }}">
                <i class="fas fa-calendar-check"></i> Appointments
            </a>

            <a href="{{ route('admin.consultations.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition lux-hover {{ activeMenu('admin.consultations.*') }}">
                <i class="fas fa-comments"></i> Consultations
            </a>

            <a href="{{ route('admin.enquiries.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition lux-hover {{ activeMenu('admin.enquiries.*') }}">
                <i class="fas fa-envelope"></i> Enquiries
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <script>
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('dropdownMenu');
            const button = document.getElementById('userDropdown');
            if (button && dropdown && !button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            } else if (button.contains(event.target)) {
                dropdown.classList.toggle('hidden');
            }
        });
    </script>

</body>

</html>