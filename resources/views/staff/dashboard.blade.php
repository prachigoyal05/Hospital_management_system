@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Staff Dashboard</h1>
    <p>Welcome, {{ Auth::user()->name }} (Staff)</p>
</div>
@endsection
