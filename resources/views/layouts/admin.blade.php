<!DOCTYPE html>                     
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 h-screen bg-white shadow-md">
            <div class="p-6 text-xl font-bold border-b">Hospital Admin</div>
            <nav class="p-4">
                 <ul class="space-y-2">
                    <li><a href="{{ route('admin.dashboard') }}" class="block py-2 px-3 rounded hover:bg-gray-200">Dashboard</a></li>
                    <li class="mb-2"><a href="{{ route('admin.patients.index') }}" class="block py-2 px-3 rounded hover:bg-gray-200">Patients</a></li>
                    <li class="mb-2"><a href="{{ route('admin.lab-tests.index') }}" class="block py-2 px-3 rounded hover:bg-gray-200">Lab Tests</a></li>
                    <li class="mb-2"><a href="{{ route('admin.reports.index') }}" class="block py-2 px-3 rounded hover:bg-gray-200">Reports</a></li>
                    <li><a href="#" class="block py-2 px-3 rounded hover:bg-gray-200">Staff</a></li>
                    <li><a href="#" class="block py-2 px-3 rounded hover:bg-gray-200">Settings</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen">
            <!-- Navbar -->
            <header class="bg-white shadow p-4 flex justify-between items-center">
                <h2 class="text-lg font-semibold">Admin Panel</h2>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-red-500 hover:underline">Logout</button>
                </form>
            </header>

            <!-- Content -->
            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>


