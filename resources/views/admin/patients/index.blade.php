@extends('layouts.admin')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-semibold">Patients</h1>
        <div class="space-x-2">
            <!-- Add Import Button -->
            <button onclick="document.getElementById('import-modal').classList.remove('hidden')" 
                    class="px-4 py-2 bg-green-500 text-black rounded hover:bg-blue-600">
                Bulk Import
            </button>
            <a href="{{ route('admin.patients.create') }}" class="px-4 py-2 bg-green-500 text-black rounded hover:bg-green-600">
                Add Patient
            </a>
        </div>
    </div>

    <!-- Import Modal -->
    <div id="import-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Bulk Import Patients</h3>
                <div class="mt-2 px-7 py-3">
                    <form action="{{ route('admin.patients.import') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">CSV/Excel File</label>
                            <input type="file" name="file" accept=".csv, .xlsx, .xls" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div class="text-xs text-gray-500">
                            <p>File should have columns: Name, Email, Phone, Date of Birth, Address</p>
                            <a href="{{ asset('sample_patients_import.csv') }}" class="text-blue-500 hover:underline">Download sample CSV</a>
                        </div>
                        <div class="flex justify-end space-x-3 pt-2">
                            <button type="button" onclick="document.getElementById('import-modal').classList.add('hidden')" 
                                    class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-black rounded hover:bg-blue-600">
                                Import
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('import_errors'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <strong>Import completed with some errors:</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach(session('import_errors') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<table class="w-full table-fixed border bg-white rounded">
    <thead>
        <tr class="bg-green-200">
            <th class="p-2 text-left">Name</th>
            <th class="p-2">Email</th>
            <th class="p-2 text-left">Phone</th>
            <th class="p-2 text-left">Date of birth</th>
            <th class="p-2 text-left">Address</th>
            <th class="p-2 text-left">Status</th>
            <th class="p-2 text-left">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($patients as $patient)
            <tr class="{{ $patient->is_active ? '' : 'bg-gray-100' }}">
                <td class="p-2">{{ $patient->name }}</td>
                <td class="p-2">{{ $patient->email }}</td>
                <td class="p-2">{{ $patient->phone }}</td>
                <td class="p-2">{{ $patient->dob }}</td>
                <td class="p-2">{{ $patient->address }}</td>
                <td class="p-2">
                    <form action="{{ route('admin.patients.toggle-status', $patient->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="px-3 py-1 rounded-full text-xs font-semibold 
                            {{ $patient->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $patient->is_active ? 'Active' : 'Inactive' }}
                        </button>
                    </form>
                </td>
                <td class="p-2">
    <div class="flex space-x-2">
        <a href="{{ route('admin.patients.edit', $patient->id) }}" class="text-blue-600 hover:underline">Edit</a>
        <form action="{{ route('admin.patients.toggle-status', $patient->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit" 
                    class="{{ $patient->is_active ? 'text-red-600 hover:text-red-800' : 'text-green-600 hover:text-green-800' }} hover:underline"
                    onclick="return confirm('Are you sure you want to {{ $patient->is_active ? 'deactivate' : 'activate' }} this patient?')">
                {{ $patient->is_active ? 'Deactivate' : 'Activate' }}
            </button>
        </form>
    </div>
</td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="p-4 text-center">No patients found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    @if ($patients->hasPages())
        <div class="flex justify-between items-center mt-4">
            @if ($patients->onFirstPage())
                <span class="px-4 py-2 border rounded text-gray-400">&laquo; Previous</span>
            @else
                <a href="{{ $patients->previousPageUrl() }}" class="px-4 py-2 border rounded text-blue-600 hover:bg-blue-50">&laquo; Previous</a>
            @endif
            
            @if ($patients->hasMorePages())
                <a href="{{ $patients->nextPageUrl() }}" class="px-4 py-2 border rounded text-blue-600 hover:bg-blue-50">Next &raquo;</a>
            @else
                <span class="px-4 py-2 border rounded text-gray-400">Next &raquo;</span>
            @endif
        </div>
    @endif
</div>
    <script>
document.querySelectorAll('.toggle-status-btn').forEach(button => {
    button.addEventListener('click', (e) => {
        if (!confirm('Are you sure you want to change this patient\'s status?')) {
            e.preventDefault();
        }
    });
});
</script>


    <script>
        // Modal functions
        function openImportModal() {
            document.getElementById('import-modal').classList.remove('hidden');
        }

        function closeImportModal() {
            document.getElementById('import-modal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('import-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImportModal();
            }
        });

        // File validation
        document.getElementById('import-file').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const errorElement = document.getElementById('file-error');
            const allowedTypes = ['text/csv', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
            
            if (!allowedTypes.includes(file.type)) {
                errorElement.textContent = 'Please upload a valid CSV or Excel file';
                errorElement.classList.remove('hidden');
                e.target.value = '';
            } else {
                errorElement.classList.add('hidden');
            }
        });

        // Status toggle confirmation
        document.querySelectorAll('form[action*="toggle-status"] button').forEach(button => {
            button.addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to change this patient\'s status?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endsection

