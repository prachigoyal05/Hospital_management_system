@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Import Patients</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.patients.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="file">CSV File</label>
                    <input type="file" name="file" class="form-control" required>
                    <small class="form-text text-muted">
                        File should have columns: Name, Email, Phone, Date of Birth, Address
                    </small>
                </div>
                <button type="submit" class="btn btn-primary">Import</button>
            </form>
        </div>
    </div>
@endsection