@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>All Samples</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($samples->count())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patient Name</th>
                        <th>Sample Type</th>
                        <th>Test Type</th>
                        <th>Collection Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($samples as $sample)
                        <tr>
                            <td>{{ $sample->id }}</td>
                            <td>{{ $sample->patient->name ?? 'N/A' }}</td>
                            <td>{{ $sample->sample_type }}</td>
                            <td>{{ $sample->test_type }}</td>
                            <td>{{ \Carbon\Carbon::parse($sample->collection_date)->format('d-m-Y') }}</td>
                            <td>{{ $sample->status }}</td>
                            <td>
                                <a href="{{ route('staff.samples.show', $sample->id) }}" class="btn btn-sm btn-primary">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No samples found.</p>
        @endif
    </div>
@endsection
