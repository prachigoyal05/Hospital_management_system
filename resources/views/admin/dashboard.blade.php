@extends('layouts.admin')

@section('title', 'Admin Dashboard')
<!-- @section('subtitle', 'Hospital Overview')
@section('description', '') -->

@section('content')

<div class="space-y-6">
    <!-- Welcome Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Welcome back, <span class="text-red-500">Admin</span>!</h1>
            <p class="text-gray-500 mt-1">Here's what's happening in your hospital today</p>
        </div>
        <div class="mt-4 md:mt-0">
            <div class="relative">
                <input type="text" placeholder="Search patients, reports..." 
                       class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 w-full md:w-64">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Patients Card -->
        <div class="bg-green p-6 rounded-xl shadow-sm border border-blue-100 hover:green-300 transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Patients</p>
                    <p class="mt-1 text-2xl font-semibold text-gray-800">1,248</p>
                    <p class="mt-1 text-xs text-green-600 flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i> 12% from last month
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center">
                    <i class="fas fa-user-injured text-blue-600"></i>
                </div>
            </div>
        </div>

        <!-- Appointments Card -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Today's Appointments</p>
                    <p class="mt-1 text-2xl font-semibold text-gray-800">42</p>
                    <div class="mt-1 flex items-center space-x-1">
                        <span class="text-xs text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full">8 upcoming</span>
                        <span class="text-xs text-green-600 bg-green-50 px-2 py-0.5 rounded-full">34 completed</span>
                    </div>
                </div>
                <div class="w-12 h-12 rounded-full bg-green-50 flex items-center justify-center">
                    <i class="fas fa-calendar-check text-green-600"></i>
                </div>
            </div>
        </div>

        <!-- Reports Card -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Pending Reports</p>
                    <p class="mt-1 text-2xl font-semibold text-gray-800">17</p>
                    <div class="mt-1 flex items-center">
                        <span class="text-xs text-red-600 bg-red-50 px-2 py-0.5 rounded-full">3 urgent</span>
                    </div>
                </div>
                <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center">
                    <i class="fas fa-file-medical text-red-600"></i>
                </div>
            </div>
        </div>

        <!-- Staff Card -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Active Staff</p>
                    <p class="mt-1 text-2xl font-semibold text-gray-800">86</p>
                    <p class="mt-1 text-xs text-gray-500">12 doctors on duty</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-purple-50 flex items-center justify-center">
                    <i class="fas fa-user-md text-purple-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="border-b border-gray-200 px-6 py-4">
            <h3 class="text-lg font-medium text-gray-800">Recent Activity</h3>
        </div>
        <div class="divide-y divide-gray-200">
            <!-- Activity Item -->
            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                <div class="flex items-start">
                    <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center mr-4 mt-1">
                        <i class="fas fa-file-medical text-blue-600"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <h4 class="font-medium text-gray-800">New lab report generated</h4>
                            <span class="text-xs text-gray-500">10 min ago</span>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">Patient: Sarah Johnson (ID: #P-2456)</p>
                        <div class="mt-2 flex items-center space-x-2">
                            <span class="text-xs bg-blue-50 text-blue-600 px-2 py-1 rounded">Lab Test</span>
                            <span class="text-xs bg-green-50 text-green-600 px-2 py-1 rounded">Completed</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- More activity items... -->
        </div>
        <!-- <div class="px-6 py-3 border-t border-gray-200 text-center">
            <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-800">View all activity</a>
        </div> -->
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Quick Stats -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Quick Stats</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-gray-500">Available Beds</span>
                    <span class="font-medium">24/120</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-blue-600 h-2 rounded-full" style="width: 20%"></div>
                </div>
                
                <div class="flex items-center justify-between">
                    <span class="text-gray-500">Pharmacy Stock</span>
                    <span class="font-medium">82%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-green-600 h-2 rounded-full" style="width: 82%"></div>
                </div>
            </div>
        </div>
        
        <!-- Recent Patients -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden md:col-span-2">
            <div class="border-b border-gray-200 px-6 py-4">
                <h3 class="text-lg font-medium text-gray-800">Recent Patients</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Visit</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Patient Row -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                        <i class="fas fa-user text-blue-600"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Michael Brown</div>
                                        <div class="text-sm text-gray-500">ID: #P-9876</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">Today, 10:30 AM</div>
                                <div class="text-sm text-gray-500">Dr. Smith</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Completed</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="#" class="text-blue-600 hover:text-blue-900">View</a>
                            </td>
                        </tr>
                        <!-- More patient rows... -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
