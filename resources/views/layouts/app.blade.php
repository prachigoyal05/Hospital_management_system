<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            :root {
                --primary-blue: #3b82f6;
                --light-blue: #f0f9ff;
                --border-blue: #e0f2fe;
            }
            .bg-light-blue {
                background-color: var(--light-blue);
            }
            .border-light-blue {
                border-color: var(--border-blue);
            }
            .text-primary-blue {
                color: var(--primary-blue);
            }
            * {
                transition: background-color 0.2s ease, color 0.2s ease;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-light-blue">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow-sm border-b border-light-blue">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <h2 class="font-semibold text-xl text-primary-blue">
                            {{ $header }}
                        </h2>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-lg shadow-sm border border-light-blue p-6">
                 
                </div>
            </main>
        </div>
    </body>
</html>