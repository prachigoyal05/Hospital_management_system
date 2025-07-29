<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2563eb;
            --primary-light: #3b82f6;
            --primary-dark: #1d4ed8;
            --secondary: #10b981;
            --accent: #f59e0b;
            --dark: #1e293b;
            --light: #f8fafc;
        }
        .sidebar-item.active {
            background-color: #e0e7ff;
            color: var(--primary-dark);
            border-left: 4px solid var(--primary);
        }
        .sidebar-item.active i {
            color: var(--primary-dark);
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-800">
    <div class="flex min-h-screen">
        <!-- Enhanced Sidebar -->
        <aside class="w-64 bg-white shadow-xl border-r border-gray-200 transform transition-all duration-300 ease-in-out">
            <div class="p-6 text-xl font-bold flex items-center space-x-3 text-gray-800">
                <i class="fas fa-hospital text-blue-600 text-2xl"></i>
                <span>MediCare Admin</span>
            </div>
            <nav class="p-4 mt-2">
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="sidebar-item flex items-center py-3 px-4 rounded-lg transition-all hover:bg-blue-50 group">
                            <i class="fas fa-tachometer-alt mr-3 text-gray-500 group-hover:text-blue-600"></i>
                            <span class="font-medium">Dashboard</span>
                            <i class="fas fa-chevron-right ml-auto text-xs text-gray-400"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.patients.index') }}" class="sidebar-item flex items-center py-3 px-4 rounded-lg transition-all hover:bg-blue-50 group">
                            <i class="fas fa-user-injured mr-3 text-gray-500 group-hover:text-blue-600"></i>
                            <span class="font-medium">Patients</span>
                            <span class="ml-auto bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded-full">24</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.lab-tests.index') }}" class="sidebar-item flex items-center py-3 px-4 rounded-lg transition-all hover:bg-blue-50 group">
                            <i class="fas fa-flask mr-3 text-gray-500 group-hover:text-blue-600"></i>
                            <span class="font-medium">Lab Tests</span>
                            <span class="ml-auto bg-yellow-100 text-yellow-800 text-xs font-semibold px-2 py-1 rounded-full">5</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.reports.index') }}" class="sidebar-item flex items-center py-3 px-4 rounded-lg transition-all hover:bg-blue-50 group">
                            <i class="fas fa-file-alt mr-3 text-gray-500 group-hover:text-blue-600"></i>
                            <span class="font-medium">Reports</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="sidebar-item flex items-center py-3 px-4 rounded-lg transition-all hover:bg-blue-50 group">
                            <i class="fas fa-users mr-3 text-gray-500 group-hover:text-blue-600"></i>
                            <span class="font-medium">Staff</span>
                        </a>
                    </li>
                    <li class="pt-4 mt-4 border-t border-gray-200">
                        <a href="#" class="sidebar-item flex items-center py-3 px-4 rounded-lg transition-all hover:bg-blue-50 group">
                            <i class="fas fa-cog mr-3 text-gray-500 group-hover:text-blue-600"></i>
                            <span class="font-medium">Settings</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="absolute bottom-0 w-full p-4 border-t border-gray-200">
                <div class="flex items-center space-x-3">
                    <img class="h-10 w-10 rounded-full object-cover" src="https://ui-avatars.com/api/?name=Admin&background=2563eb&color=fff" alt="Admin">
                    <div>
                        <p class="font-medium text-gray-800">Admin User</p>
                        <p class="text-xs text-gray-500">Administrator</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Navbar -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center space-x-4">
                        <button class="text-gray-500 focus:outline-none lg:hidden">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h2 class="text-xl font-semibold text-gray-800">Dashboard Overview</h2>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <button class="p-2 rounded-full text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <i class="fas fa-bell"></i>
                                <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors duration-200">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
                <div class="max-w-7xl mx-auto">
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Total Patients</p>
                                    <h3 class="text-2xl font-bold mt-1">1,248</h3>
                                    <p class="text-xs text-green-500 mt-2"><i class="fas fa-arrow-up mr-1"></i> 12.5% from last month</p>
                                </div>
                                <div class="p-3 rounded-full bg-blue-50 text-blue-600">
                                    <i class="fas fa-user-injured text-xl"></i>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Pending Tests</p>
                                    <h3 class="text-2xl font-bold mt-1">24</h3>
                                    <p class="text-xs text-red-500 mt-2"><i class="fas fa-arrow-down mr-1"></i> 3.2% from last week</p>
                                </div>
                                <div class="p-3 rounded-full bg-yellow-50 text-yellow-600">
                                    <i class="fas fa-flask text-xl"></i>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Today's Appointments</p>
                                    <h3 class="text-2xl font-bold mt-1">18</h3>
                                    <p class="text-xs text-green-500 mt-2"><i class="fas fa-arrow-up mr-1"></i> 2 new today</p>
                                </div>
                                <div class="p-3 rounded-full bg-green-50 text-green-600">
                                    <i class="fas fa-calendar-check text-xl"></i>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Staff Members</p>
                                    <h3 class="text-2xl font-bold mt-1">42</h3>
                                    <p class="text-xs text-gray-500 mt-2">3 on leave</p>
                                </div>
                                <div class="p-3 rounded-full bg-purple-50 text-purple-600">
                                    <i class="fas fa-users text-xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity and Charts Section -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                        <!-- Recent Patients -->
                        <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="font-semibold text-lg">Recent Patients</h3>
                                <a href="{{ route('admin.patients.index') }}" class="text-sm text-blue-600 hover:underline">View All</a>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Visit</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr>
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=John+Doe&background=3b82f6&color=fff" alt="">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">John Doe</div>
                                                        <div class="text-sm text-gray-500">ID: #P-1001</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">Today, 10:30 AM</td>
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="#" class="text-blue-600 hover:text-blue-900">View</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Jane+Smith&background=10b981&color=fff" alt="">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">Jane Smith</div>
                                                        <div class="text-sm text-gray-500">ID: #P-1002</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">Yesterday, 2:15 PM</td>
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="#" class="text-blue-600 hover:text-blue-900">View</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Robert+Johnson&background=f59e0b&color=fff" alt="">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">Robert Johnson</div>
                                                        <div class="text-sm text-gray-500">ID: #P-1003</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">2 days ago</td>
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">In Progress</span>
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="#" class="text-blue-600 hover:text-blue-900">View</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Upcoming Appointments -->
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="font-semibold text-lg">Upcoming Appointments</h3>
                                <a href="#" class="text-sm text-blue-600 hover:underline">View All</a>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-start p-3 border border-gray-100 rounded-lg hover:bg-gray-50 transition-colors">
                                    <div class="flex-shrink-0 p-2 bg-blue-50 rounded-lg text-blue-600">
                                        <i class="fas fa-calendar-day"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium">Annual Checkup</p>
                                        <p class="text-xs text-gray-500">Sarah Williams - 10:00 AM</p>
                                        <p class="text-xs mt-1"><span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full">Confirmed</span></p>
                                    </div>
                                </div>
                                <div class="flex items-start p-3 border border-gray-100 rounded-lg hover:bg-gray-50 transition-colors">
                                    <div class="flex-shrink-0 p-2 bg-green-50 rounded-lg text-green-600">
                                        <i class="fas fa-vial"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium">Blood Test</p>
                                        <p class="text-xs text-gray-500">Michael Brown - 11:30 AM</p>
                                        <p class="text-xs mt-1"><span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full">Pending</span></p>
                                    </div>
                                </div>
                                <div class="flex items-start p-3 border border-gray-100 rounded-lg hover:bg-gray-50 transition-colors">
                                    <div class="flex-shrink-0 p-2 bg-purple-50 rounded-lg text-purple-600">
                                        <i class="fas fa-x-ray"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium">X-Ray Examination</p>
                                        <p class="text-xs text-gray-500">Emily Davis - 2:00 PM</p>
                                        <p class="text-xs mt-1"><span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full">Confirmed</span></p>
                                    </div>
                                </div>
                                <div class="flex items-start p-3 border border-gray-100 rounded-lg hover:bg-gray-50 transition-colors">
                                    <div class="flex-shrink-0 p-2 bg-red-50 rounded-lg text-red-600">
                                        <i class="fas fa-procedures"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium">Follow-up Visit</p>
                                        <p class="text-xs text-gray-500">David Wilson - 3:45 PM</p>
                                        <p class="text-xs mt-1"><span class="bg-green-100 text-green-800 px-2 py-1 rounded-full">New</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>
</body>
</html>


