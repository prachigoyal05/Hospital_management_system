<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        
        body {
            font-family: 'Inter', sans-serif;
        }
        .sidebar-link {
            transition: all 0.3s ease;
            position: relative;
        }
        .sidebar-link:hover {
            transform: translateX(3px);
        }
        .sidebar-link::after {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background-color: #30e87a;
            transform: scaleY(0);
            transition: transform 0.2s ease;
        }
        .sidebar-link:hover::after {
            transform: scaleY(1);
        }
        .active-link {
            background-color: rgba(48, 232, 122, 0.1);
            color: #003d3d;
            font-weight: 500;
        }
        .active-link::after {
            transform: scaleY(1);
        }
        /* Main header styling to match sidebar */

    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <body style="background-color: #f0f4f8;">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 min-h-screen bg-[#003d3d] shadow-lg border-r border-[#006666] flex flex-col">
            <div class="p-6 text-xl font-bold text-white border-b border-[#006666] flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2 text-[#30e87a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <span>Hospital Admin</span>
            </div>
            <nav class="flex-1 p-4 overflow-y-auto">
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center py-3 px-4 rounded-lg text-gray-300 hover:text-white hover:bg-[#005555]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-[#30e87a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.patients.index') }}" class="sidebar-link flex items-center py-3 px-4 rounded-lg text-gray-300 hover:text-white hover:bg-[#005555]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-[#30e87a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Patients
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.lab-tests.index') }}" class="sidebar-link flex items-center py-3 px-4 rounded-lg text-gray-300 hover:text-white hover:bg-[#005555]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-[#30e87a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                            Lab Tests
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.reports.index') }}" class="sidebar-link flex items-center py-3 px-4 rounded-lg text-gray-300 hover:text-white hover:bg-[#005555]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-[#30e87a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Reports
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.staff.index') }}" class="sidebar-link flex items-center py-3 px-4 rounded-lg text-gray-300 hover:text-white hover:bg-[#005555]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-[#30e87a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                           Staff
                        </a>
                    </li>
                    <li>
                        <a href="#" class="sidebar-link flex items-center py-3 px-4 rounded-lg text-gray-300 hover:text-white hover:bg-[#005555]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-[#30e87a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg> 
                            Settings
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="p-4 border-t border-[#006666]">
                <div class="flex items-center">
                    <div class="relative">
                        <img class="h-10 w-10 rounded-full object-cover border-2 border-[#30e87a]" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Admin profile">
                        <span class="absolute bottom-0 right-0 h-3 w-3 rounded-full bg-green-500 border-2 border-white"></span>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-white">Admin User</p>
                        <p class="text-xs font-medium text-gray-300">Super Admin</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Navbar -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center">
                        <h2 class="text-xl font-semibold text-gray-800">@yield('title', 'Dashboard')</h2>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="p-2 rounded-full text-gray-500 hover:text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-[#30e87a] relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                        </button>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center text-sm font-medium text-gray-600 hover:text-[#30e87a] transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>