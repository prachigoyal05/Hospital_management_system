@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-6xl bg-white p-6 rounded shadow-sm border border-light-blue">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-primary-blue">All Registered Samples</h2>
        <a href="{{ route('staff.samples.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
            Register New Sample
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($samples->count())
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 border border-gray-300 rounded shadow-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 border">#</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 border">Patient</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 border">Sample Type</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 border">Test Type</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 border">Status</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 border">Submitted</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($samples as $sample)
                        <tr>
                            <td class="px-4 py-2 border text-sm text-gray-700">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 border text-sm text-gray-700">{{ $sample->patient->name 
                                ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border text-sm text-gray-700 capitalize">{{ $sample->sample_type }}</td>
                            <td class="px-4 py-2 border text-sm text-gray-700">{{ $sample->test_type }}</td>
                            <td class="px-4 py-2 border text-sm text-gray-700 capitalize">
                                @if($sample->status == 'pending')
                                    <span class="text-yellow-600 font-medium">{{ ucfirst($sample->status) }}</span>
                                @elseif($sample->status == 'in_progress')
                                    <span class="text-blue-600 font-medium">In Progress</span>
                                @else
                                    <span class="text-green-600 font-medium">Completed</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 border text-sm text-gray-700">
                                {{ \Carbon\Carbon::parse($sample->submission_date)->format('Y-m-d') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-500 text-sm">No samples found.</p>
    @endif

</div>
@endsection
