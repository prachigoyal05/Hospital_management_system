@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header with action buttons -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div class="mb-4 md:mb-0">
            <h2 class="text-2xl font-semibold text-blue-600">Staff Management</h2>
            <p class="text-sm text-blue-500">Manage all hospital staff members</p>
        </div>
        <a href="{{ route('admin.staff.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add New Staff
        </a>
    </div>

    <!-- Staff Table -->
    <div class="bg-white rounded-lg shadow-sm border border-blue-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-blue-200">
                <thead class="bg-blue-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-blue-600 uppercase tracking-wider">#</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-blue-600 uppercase tracking-wider">Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-blue-600 uppercase tracking-wider">Email</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-blue-600 uppercase tracking-wider">Role</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-blue-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-blue-200">
                    @forelse ($staff as $index => $member)
                    <tr class="hover:bg-blue-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600">
                            {{ $index + 1 }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                    <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-blue-900">{{ $member->name }}</div>
                                    <div class="text-sm text-blue-500">ID: {{ $member->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600">
                            {{ $member->email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                {{ $member->role ?? 'Staff' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.staff.edit', $member->id) }}" class="inline-flex items-center px-3 py-1 border border-blue-300 rounded-md shadow-sm text-sm font-medium text-blue-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Edit
                                </a>
                                <form action="{{ route('admin.staff.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this staff member?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-blue-500">
                            No staff members found. <a href="{{ route('admin.staff.create') }}" class="text-blue-600 hover:text-blue-800">Create one now</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
       <!-- Pagination -->
@if ($staff->hasPages())
    <div class="bg-blue-50 px-6 py-3 border-t border-blue-100">
        <nav class="flex items-center justify-between">
            <div class="flex-1 flex justify-between items-center space-x-2">
                <!-- Previous Page Link -->
                @if ($staff->onFirstPage())
                    <span class="relative inline-flex items-center px-4 py-2 border border-blue-200 text-sm font-medium rounded-md text-blue-300 bg-white cursor-default">
                        Previous
                    </span>
                @else
                    <a href="{{ $staff->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-blue-200 text-sm font-medium rounded-md text-blue-700 bg-white hover:bg-blue-50">
                        Previous
                    </a>
                @endif

                <!-- Page Numbers -->
                <div class="hidden md:flex space-x-1">
                    @foreach ($staff->getUrlRange(1, $staff->lastPage()) as $page => $url)
                        @if ($page == $staff->currentPage())
                            <span class="relative inline-flex items-center px-4 py-2 border border-blue-500 text-sm font-medium rounded-md text-white bg-blue-600">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 border border-blue-200 text-sm font-medium rounded-md text-blue-700 bg-white hover:bg-blue-50">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                </div>

                <!-- Next Page Link -->
                @if ($staff->hasMorePages())
                    <a href="{{ $staff->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-blue-200 text-sm font-medium rounded-md text-blue-700 bg-white hover:bg-blue-50">
                        Next
                    </a>
                @else
                    <span class="relative inline-flex items-center px-4 py-2 border border-blue-200 text-sm font-medium rounded-md text-blue-300 bg-white cursor-default">
                        Next
                    </span>
                @endif
            </div>
        </nav>
    </div>
@endif
    </div>
</div>
@endsection