@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-2xl bg-white p-6 rounded shadow-sm border border-light-blue">
    <h2 class="text-2xl font-semibold text-primary-blue mb-6">Register New Sample</h2>

    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0 pl-4 list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('staff.samples.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label for="patient_id" class="block text-sm font-medium text-gray-700 mb-1">Patient</label>
            <select name="patient_id" id="patient_id" class="form-select w-full rounded border-gray-300" required>
                <option value="">Select Patient</option>
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
    <label for="sample_type" class="block text-gray-700 font-bold mb-2">Sample Type</label>
    <select name="sample_type" id="sample_type" class="w-full border border-gray-300 rounded px-3 py-2">
    <option value="">Sample Type</option>
    <option value="urine">Urine</option>
        <option value="blood">Blood</option>
    </select>
</div>

        <div>
            <label for="test_type" class="block text-sm font-medium text-gray-700 mb-1">Test Type</label>
            <input type="text" name="test_type" id="test_type" class="form-input w-full rounded border-gray-300" required>
        </div>

        <div>
            <label for="collection_date" class="block text-sm font-medium text-gray-700 mb-1">Collection Date</label>
            <input type="date" name="collection_date" id="collection_date" class="form-input w-full rounded border-gray-300" required>
        </div>

        <div>
            <label for="submission_date" class="block text-sm font-medium text-gray-700 mb-1">Submission Date</label>
            <input type="date" name="submission_date" id="submission_date" class="form-input w-full rounded border-gray-300" required>
        </div>

        <div class="mb-4">
    <label for="status" class="block text-gray-700 font-bold mb-2">Status</label>
    <select name="status" id="status" class="w-full border border-gray-300 rounded px-3 py-2">
    <option value="">Select Status</option>
        <option value="pending">Pending</option>
        <option value="in_progress">In Progress</option>
        <option value="completed">Completed</option>
    </select>
</div>

        <div>
            <label for="remarks" class="block text-sm font-medium text-gray-700 mb-1">Remarks</label>
            <textarea name="remarks" id="remarks" class="form-textarea w-full rounded border-gray-300" rows="3"></textarea>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                Submit Sample
            </button>
        </div>
    </form>
</div>
@endsection
