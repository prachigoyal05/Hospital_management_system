@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Register New Sample</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('staff.samples.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="patient_id">Patient</label>
            <select name="patient_id" id="patient_id" class="form-control" required>
                <option value="">Select Patient</option>
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="sample_type">Sample Type</label>
            <input type="text" name="sample_type" id="sample_type" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="test_type">Test Type</label>
            <input type="text" name="test_type" id="test_type" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="collection_date">Collection Date</label>
            <input type="date" name="collection_date" id="collection_date" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="submission_date">Submission Date</label>
            <input type="date" name="submission_date" id="submission_date" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="status">Status</label>
            <input type="text" name="status" id="status" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="remarks">Remarks</label>
            <textarea name="remarks" id="remarks" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Submit Sample</button>
    </form>
</div>
@endsection
