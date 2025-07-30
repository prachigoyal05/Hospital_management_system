<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-blue-50 text-gray-800">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 h-screen bg-white shadow-md border-r border-blue-100">
            <div class="p-6 text-xl font-bold border-b border-blue-100 text-blue-600">Hospital Admin</div>
            <nav class="p-4">
                 <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="block py-2 px-3 rounded hover:bg-blue-50 text-blue-600 hover:text-blue-700 transition">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.patients.index') }}" class="block py-2 px-3 rounded hover:bg-blue-50 text-blue-600 hover:text-blue-700 transition">
                            Patients
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.lab-tests.index') }}" class="block py-2 px-3 rounded hover:bg-blue-50 text-blue-600 hover:text-blue-700 transition">
                            Lab Tests
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.reports.index') }}" class="block py-2 px-3 rounded hover:bg-blue-50 text-blue-600 hover:text-blue-700 transition">
                            Reports
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.staff.index') }}" class="block py-2 px-3 rounded hover:bg-blue-50 text-blue-600 hover:text-blue-700 transition">
                            Staff
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 rounded hover:bg-blue-50 text-blue-600 hover:text-blue-700 transition">
                            Settings
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen">
            <!-- Navbar -->
            <header class="bg-white shadow-sm p-4 flex justify-between items-center border-b border-blue-100">
                <h2 class="text-lg font-semibold text-blue-600">Admin Panel</h2>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-blue-500 hover:text-blue-700 hover:underline transition">Logout</button>
                </form>
            </header>

            <!-- Content -->
            <main class="flex-1 p-6 bg-white m-6 rounded-lg shadow-sm border border-blue-100">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>