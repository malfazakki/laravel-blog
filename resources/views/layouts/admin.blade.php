<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="font-sans antialiased">
        @include('layouts.navigation')

        {{-- Page Heading --}}
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif
        {{-- Page Heading end --}}

        {{-- Sidebar --}}
        <div class="flex">
            <div class="w-64 bg-white shadow h-screen">
                <div class="p-4">
                    <h2>Admin Panel</h2>
                    <nav class="mt-4">
                        <ul>
                            <li class="mb-2">
                                <a href="{{ route('dashboard') }}"
                                    class="block p-2 hover:bg-gray-100 rounded">Dashboard</a>
                            </li>

                            <li class="mb-2">
                                <a href="{{ route('admin.posts.index') }}"
                                    class="block p-2 hover:bg-gray-100 rounded">Posts</a>
                            </li>

                            <li class="mb-2">
                                <a href="{{ route('admin.categories.index') }}"
                                    class="block p-2 hover:bg-gray-100 rounded">Category</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        {{-- Sidebar end --}}

        {{-- Page Content --}}
        <main class="flex-1 p-6">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
        </main>
        {{-- Page Content end --}}
    </div>
</body>

</html>
