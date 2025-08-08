@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header with action buttons -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div class="mb-4 md:mb-0">
            <h2 class="text-2xl font-semibold text-black-600">Lab Tests</h2>
            <p class="text-sm text-black-500">Manage all laboratory tests and their details</p>
        </div>
        <a href="{{ route('admin.lab-tests.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add New Test
        </a>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Search and Filter -->
    <div class="bg-white rounded-lg shadow-sm border border-green-100 p-4 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="search" class="block text-sm font-medium text-black-600 mb-1">Search</label>
                <input type="text" id="search" placeholder="Search tests..." class="block w-full rounded-md border-blue-200 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div>
                <label for="category" class="block text-sm font-medium text-black-600 mb-1">Category</label>
                <select id="category" class="block w-full rounded-md border-green shadow-sm focus:border-green-500 focus:ring-green-500">
                    <option value="">All Categories</option>
                    <option value="Hematology">Hematology</option>
                    <option value="Biochemistry">Biochemistry</option>
                    <option value="Microbiology">Microbiology</option>
                    <option value="Pathology">Pathology</option>
                </select>
            </div>
            <div class="flex items-end">
                <button class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Filter Results
                </button>
            </div>
        </div>
    </div>

    <!-- Tests Table -->
     <div id="tests-table-container">
    <div class="bg-white rounded-lg shadow-sm border border-blue-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-blue-200">
                <thead class="bg-blue-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black-600 uppercase tracking-wider">Test Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black-600 uppercase tracking-wider">Category</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black-600 uppercase tracking-wider">Price (₹)</th> 
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black-600 uppercase tracking-wider">Turnaround_time</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black-600 uppercase tracking-wider">Description</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black-600 uppercase tracking-wider">Test_requirements</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-blue-200">
                    @forelse ($tests as $test)
                        <tr class="hover:bg-blue-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-black-900">{{ $test->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-black-600">{{ $test->category ?? '—' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-black-600">{{ $test->price ? '₹'.number_format($test->price, 2) : 'N/A' }}</div>
                            </td>
                             <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-black-900">{{ $test->turnaround_time}}</div>
                            </td>
                             <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-black-900">{{ $test->description}}</div>
                            </td>
                             <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-black-900">{{ $test->test_requirements}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.lab-tests.edit', $test->id) }}" class="inline-flex items-center px-3 py-1 border border-blue-300 rounded-md shadow-sm text-sm font-medium text-blue-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.lab-tests.destroy', $test->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this test?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-1 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-black-500">
                                No lab tests found. <a href="{{ route('admin.lab-tests.create') }}" class="text-green-600 hover:text-blue-800">Create one now</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        </div>

        <!-- Pagination -->
        <!-- Pagination -->
@if ($tests->hasPages())
    <div class="bg-blue-50 px-6 py-3 border-t border-blue-100">
        <nav class="flex items-center justify-between">
            <div class="flex-1 flex justify-between items-center space-x-2">
                <!-- Previous Page Link -->
                @if ($tests->onFirstPage())
                    <span class="relative inline-flex items-center px-4 py-2 border border-blue-200 text-sm font-medium rounded-md text-blue-300 bg-white cursor-default">
                        Previous
                    </span>
                @else
                    <a href="{{ $tests->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-blue-200 text-sm font-medium rounded-md text-blue-700 bg-white hover:bg-blue-50">
                        Previous
                    </a>
                @endif

                <!-- Page Numbers -->
                <div class="hidden md:flex space-x-1">
                    @foreach ($tests->getUrlRange(1, $tests->lastPage()) as $page => $url)
                        @if ($page == $tests->currentPage())
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
                @if ($tests->hasMorePages())
                    <a href="{{ $tests->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-blue-200 text-sm font-medium rounded-md text-blue-700 bg-white hover:bg-blue-50">
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
<!-- script section -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButton = document.querySelector('button.bg-green-600');
    const searchInput = document.getElementById('search');
    const categorySelect = document.getElementById('category');
    const tableRows = document.querySelectorAll('tbody tr');

    function filterTests() {
        const searchTerm = searchInput.value.toLowerCase();
        const category = categorySelect.value;

        tableRows.forEach(row => {
            const name = row.querySelector('td:first-child').textContent.toLowerCase();
            const rowCategory = row.querySelector('td:nth-child(2)').textContent;
            
            const matchesSearch = name.includes(searchTerm);
            const matchesCategory = category === "" || rowCategory === category;

            if (matchesSearch && matchesCategory) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Initial event listeners
    filterButton.addEventListener('click', filterTests);
    searchInput.addEventListener('input', filterTests);
    categorySelect.addEventListener('change', filterTests);
});
</script>
@endsection