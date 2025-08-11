<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Hospital System') }}</title>

    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Use Vite instead of mix --}}
    @livewireStyles
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation Bar -->
        @if(auth()->check() && auth()->user()->hasRole('staff'))
            <nav class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16 items-center">
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('staff.dashboard') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Dashboard</a>
                            <a href="{{ route('staff.samples.index') }}" class="text-gray-600 hover:text-blue-600">Samples</a>
                            <!-- Add more links as needed -->
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-600">Hello, {{ auth()->user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        @endif

        <!-- Page Header -->
        @hasSection('header')
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="flex-1 py-6 px-4 sm:px-6 lg:px-8">
            @yield('content')
        </main>
    </div>

    @livewireScripts
    @stack('scripts')
</body>
</html>
