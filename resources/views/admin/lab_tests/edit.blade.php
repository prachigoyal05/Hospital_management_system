@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Edit Lab Test</h2>

    <form action="{{ route('admin.lab-tests.update', $labTest->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $labTest->name }}" required>
        </div>

        <div class="mb-3">
            <label>Category</label>
            <input type="text" name="category" class="form-control" value="{{ $labTest->category }}">
        </div>

        <div class="mb-3">
            <label>Price (₹)</label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ $labTest->price }}">
        </div>
        
         <div class="mb-3">
            <label>Turnaround_time</label>
            <input type="number" step="0.01" name="turnaround_time" class="form-control" value="{{ $labTest->turnaround_time }}">
        </div>

        
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3">{{ $labTest->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Test_requirements</label>
            <input type="text"  name="text" class="form-control" value="{{ $labTest->test_requirements }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.lab-tests.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
