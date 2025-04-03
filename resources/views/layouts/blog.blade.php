<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Blog') }} - @yield('title', 'Home')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">
    {{-- Navigation --}}
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}"
                            class="text-xl font-bold text-gray-800">{{ config('app.name', 'Laravel Blog') }}</a>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ route('home') }}"
                            class="border-indigo-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Home
                        </a>

                        @foreach (App\Models\Category::take(5)->get() as $category)
                            <a href="{{ route('blog.category', $category->slug) }}"
                                class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    {{-- Navigation End --}}

    {{-- Page Content --}}
    <main>
        @yield('content')
    </main>
    {{-- Page Content end --}}

    {{-- Footer --}}
    <footer class="bg-white shadow mt-8 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-600">&copy; {{ date('Y') }} {{ config('app.name', 'Laravel Blog') }}. All
                        rights reserved.</p>
                </div>
                <div>
                    <a href="#" class="text-gray-600 hover:text-gray-900">Terms</a>
                    <a href="#" class="ml-4 text-gray-600 hover:text-gray-900">Privacy</a>
                </div>
            </div>
        </div>
    </footer>
    {{-- Footer end --}}
</body>

</html>
