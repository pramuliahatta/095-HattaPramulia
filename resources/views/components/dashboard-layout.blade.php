<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    @vite(['./resources/css/app.css', './resources/js/app.js'])
    <link rel="icon" type="image/png" href="/img/logo.png">
    <title>2cing</title>
</head>

<body class="h-full">

    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
            class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>

        <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
            class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-white lg:translate-x-0 lg:static lg:inset-0 border-r">
            <div class="flex items-center justify-center mt-8">
                <div class="flex items-center">
                    <img class="w-8 h-8" src="/img/logo.png" alt="">

                    <span class="mx-2 text-2xl font-semibold">Admin Page</span>
                </div>
            </div>

            <nav class="mt-10">
                <a class="flex items-center px-6 py-3 text-gray-500 @if (request()->route()->getName() == 'dashboard') bg-gray-300 @endif hover:bg-gray-300"
                    href="{{ route('dashboard') }}">
                    <i class="fa-solid fa-home"></i>

                    <span class="mx-3">Dashboard</span>
                </a>

                <a class="flex items-center px-6 py-3 text-gray-500 @if (request()->route()->getName() == 'dashboard.user.index') bg-gray-300 @endif hover:bg-gray-300"
                    href="{{ route('dashboard.user.index') }}">
                    <i class="fa-solid fa-users"></i>

                    <span class="mx-3">Users</span>
                </a>

                <a class="flex items-center px-6 py-3 text-gray-500 @if (request()->route()->getName() == 'dashboard.post.index') bg-gray-300 @endif hover:bg-gray-300"
                    href="{{ route('dashboard.post.index') }}">
                    <i class="fa-solid fa-image"></i>

                    <span class="mx-3">Posts</span>
                </a>

                <a class="flex items-center px-6 py-3 text-gray-500 @if (request()->route()->getName() == 'dashboard.comment.index') bg-gray-300 @endif hover:bg-gray-300"
                    href="{{ route('dashboard.comment.index') }}">
                    <i class="fa-solid fa-comment"></i>

                    <span class="mx-3">Comments</span>
                </a>
            </nav>
        </div>
        <div class="flex flex-col flex-1 overflow-hidden">
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-300">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>
                </div>

                <div class="flex items-center">
                    <div x-data="{ dropdownOpen: false }" class="relative">
                        <button @click="dropdownOpen = ! dropdownOpen"
                            class="relative block w-8 h-8 overflow-hidden rounded-full shadow focus:outline-none">
                            <img class="object-cover w-full h-full" src="/img/profile.png" alt="Your avatar">
                        </button>

                        <div x-show="dropdownOpen" @click="dropdownOpen = false"
                            class="fixed inset-0 z-10 w-full h-full" style="display: none;"></div>

                        <div x-show="dropdownOpen"
                            class="absolute right-0 z-10 w-48 mt-2 overflow-hidden bg-white rounded-md shadow-xl"
                            style="display: none;">
                            <a href="{{ route('home') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Home</a>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Sign
                                out</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container px-6 py-8 mx-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

</body>

</html>

